<?php

namespace OGAS\Economy;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('blog');
Loader::includeModule('socialnetwork');
Loader::includeModule('vote');

use NumPHP\LinAlg\LinAlg;

/**/


/**
 * Class MOB
 * @package OGAS\Economy
 */
class MOB
{

	public $matrix = array();
	public $matrix2 = array();
	public $header = array();
	public $netproduct = array();
	public $grossproduct = array();
	public $capacity = array();
	public $lack = array();
	public $addedcapacity = array();
	public $expansion = array();
	public $expansionperiod = array();


	private $razmer;
	private $operations;
	private $stopflag;
	private $starttime;
	private $endtime;


	public $errorrate = 0.01;

	function __construct($errorrate)
	{

		$this->starttime = time();

		$this->errorrate = $errorrate;

		$this->FillMatrix();

		$this->FillMatrix2();

		//$this->FillTestMatrix();

	}

	public function FillTestMatrix()
	{
		$this->razmer = 2;
		$this->header[0] = "Уголь";
		$this->header[1] = "Сталь";
		$this->netproduct[0] = 200000;
		$this->netproduct[1] = 50000;
		$this->matrix[0][0] = 0;
		$this->matrix[0][1] = 0.1;
		$this->matrix[1][0] = 3;
		$this->matrix[1][1] = 0;
	}


	private function FillMatrix()
	{

		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_PARENT.NAME", "PROPERTY_PARENT.PROPERTY_UNIT", "PROPERTY_FACTOR", "PROPERTY_FACTOR.NAME", "PROPERTY_FACTOR.PROPERTY_UNIT", "PROPERTY_QUANTITY", "PROPERTY_UNIT");

		$arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y");

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		while ($ob = $res->GetNext()) {

			$this->matrix[$ob[PROPERTY_PARENT_VALUE]][$ob[PROPERTY_FACTOR_VALUE]] = $ob[PROPERTY_QUANTITY_VALUE];

			if (!$this->header[$ob[PROPERTY_PARENT_VALUE]]) {
				$unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_PARENT_PROPERTY_UNIT_VALUE]);
				$this->header[$ob[PROPERTY_PARENT_VALUE]] = $ob[PROPERTY_PARENT_NAME] . ", " . $unit[UF_NAME];
			}
			if (!$this->header[$ob[PROPERTY_FACTOR_VALUE]]) {
				$unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_FACTOR_PROPERTY_UNIT_VALUE]);
				$this->header[$ob[PROPERTY_FACTOR_VALUE]] = $ob[PROPERTY_FACTOR_NAME] . ", " . $unit[UF_NAME];
			}

		}

		$copy = $this->header;

		foreach ($this->header as $i => $val)
			foreach ($copy as $j => $val2)
				if (!$this->matrix[$i][$j])
					$this->matrix[$i][$j] = 0;

		foreach ($this->header as $i => $val)
			$this->netproduct[$i] = 0;

		foreach ($this->header as $i => $val)
			$this->grossproduct[$i] = 0;

		foreach ($this->header as $i => $val)
			$this->capacity[$i] = 0;

		foreach ($this->header as $i => $val)
			$this->expansion[$i] = 0;

		$this->razmer = count($this->netproduct);
	}

	private function FillMatrix2()
	{

		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_PARENT.NAME", "PROPERTY_PARENT.PROPERTY_UNIT", "PROPERTY_FACTOR", "PROPERTY_FACTOR.NAME", "PROPERTY_FACTOR.PROPERTY_UNIT", "PROPERTY_QUANTITY", "PROPERTY_UNIT");

		$arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y");

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		while ($ob = $res->GetNext()) {

			if ($ob[PROPERTY_QUANTITY_VALUE] > 0)
				$this->matrix2[$ob[PROPERTY_FACTOR_VALUE]][$ob[PROPERTY_PARENT_VALUE]] = -$ob[PROPERTY_QUANTITY_VALUE];

			if (!$this->header[$ob[PROPERTY_PARENT_VALUE]] && $ob[PROPERTY_QUANTITY_VALUE] > 0) {
				$unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_PARENT_PROPERTY_UNIT_VALUE]);
				$this->header[$ob[PROPERTY_PARENT_VALUE]] = $ob[PROPERTY_PARENT_NAME] . ", " . $unit[UF_NAME];
			}
			if (!$this->header[$ob[PROPERTY_FACTOR_VALUE]] && $ob[PROPERTY_QUANTITY_VALUE] > 0) {
				$unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_FACTOR_PROPERTY_UNIT_VALUE]);
				$this->header[$ob[PROPERTY_FACTOR_VALUE]] = $ob[PROPERTY_FACTOR_NAME] . ", " . $unit[UF_NAME];
			}


		}

		$copy = $this->header;

		foreach ($this->header as $i => $val)
			foreach ($copy as $j => $val2) {
				if ($i == $j)
					$this->matrix2[$i][$j] = 1;
				if (!$this->matrix2[$i][$j])
					$this->matrix2[$i][$j] = 0;
			}

		ksort($this->matrix2);

		foreach ($this->matrix2 as $key => $val)
			ksort($this->matrix2[$key]);

	}


	public function FillCapacity()
	{

		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_CAPACITY", "PROPERTY_EXPANSION", "PROPERTY_EXPANSIONPERIOD");

		$arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y");

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		while ($ob = $res->GetNext()) {
			$this->capacity[$ob["ID"]] = $ob["PROPERTY_CAPACITY_VALUE"];
			$this->expansion[$ob["ID"]] = $ob["PROPERTY_EXPANSION_VALUE"];
			$this->expansionperiod[$ob["ID"]] = $ob["PROPERTY_EXPANSIONPERIOD_VALUE"];
		}
	}

	public function FillNetProduct($date)
	{

		foreach ($this->netproduct as $key => $value) {
			$plan = new \Ogas\Economy\Plan($key);
			$ar = $plan->Planning($date);

			$this->netproduct[$key] = $ar;

		}
	}

	public function SaveNetProduct($date)
	{
		global $USER;

		foreach ($this->netproduct as $key => $value) {
			if ($value == 0)
				continue;

			$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_DATE", "PROPERTY_PRODUCT_ID");

			$arFilter = Array("IBLOCK_ID" => PRODUCTIONPLANS_IBID, "ACTIVE" => "Y", "PROPERTY_DATE" => \CDatabase::FormatDate($date, "DD.MM.YYYY", "YYYY-MM-DD"), "PROPERTY_PRODUCT_ID" => $key);

			$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

			if ($res->SelectedRowsCount() > 0) {
				$arRes = $res->Fetch();

				$company = GetElement($key)["PROPERTIES"]["COMPANY"]["VALUE"];

				$prop = array("DATE" => $date, "PRODUCT_ID" => $key, "PLAN_QTY" => $value, "COMPANY_ID" => $company);

				\CIBlockElement::SetPropertyValuesEx($arRes["ID"], PRODUCTIONPLANS_IBID, $prop);

			} else {
				$company = GetElement($key)["PROPERTIES"]["COMPANY"]["VALUE"];

				$prop = array("DATE" => $date, "PRODUCT_ID" => $key, "PLAN_QTY" => $value, "COMPANY_ID" => $company);

				$arLoadProductArray = Array(
					"MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
					"IBLOCK_ID" => PRODUCTIONPLANS_IBID,
					"PROPERTY_VALUES" => $prop,
					"NAME" => $key,
					"ACTIVE" => "Y",            // активен
				);

				$el = new \CIBlockElement;
				$el->Add($arLoadProductArray);

			}
		}
	}

	public function SaveGrossProduct($date)
	{
		global $USER;

		foreach ($this->grossproduct as $key => $value) {
			if ($value == 0)
				continue;

			$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_DATE", "PROPERTY_PRODUCT_ID");

			$arFilter = Array("IBLOCK_ID" => PRODUCTIONPLANS_IBID, "ACTIVE" => "Y", "PROPERTY_DATE" => \CDatabase::FormatDate($date, "DD.MM.YYYY", "YYYY-MM-DD"), "PROPERTY_PRODUCT_ID" => $key);

			$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

			if ($res->SelectedRowsCount() > 0) {
				$arRes = $res->Fetch();

				$company = GetElement($key)["PROPERTIES"]["COMPANY"]["VALUE"];

				$prop = array("DATE" => $date, "PRODUCT_ID" => $key, "PLAN_QTY" => $value, "COMPANY_ID" => $company);

				\CIBlockElement::SetPropertyValuesEx($arRes["ID"], PRODUCTIONPLANS_IBID, $prop);

			} else {
				$company = GetElement($key)["PROPERTIES"]["COMPANY"]["VALUE"];

				$prop = array("DATE" => $date, "PRODUCT_ID" => $key, "PLAN_QTY" => $value, "COMPANY_ID" => $company);

				$arLoadProductArray = Array(
					"MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
					"IBLOCK_ID" => PRODUCTIONPLANS_IBID,
					"PROPERTY_VALUES" => $prop,
					"NAME" => $key,
					"ACTIVE" => "Y",            // активен
				);

				$el = new \CIBlockElement;
				$el->Add($arLoadProductArray);

			}
		}
	}

	public function GetWorkerByFactorId($factorId)
	{
		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

		$arFilter = Array("IBLOCK_ID" => WORKERS_IBID, "ACTIVE" => "Y", "PROPERTY_FACTOR" => $factorId);

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		if ($ob = $res->GetNext()) {
			return $ob["ID"];
		} else
			return false;
	}

	public function FillWorkingTime($date)
	{
		global $USER;

		$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

		$arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y", "PROPERTY_TYPE" => "fwnKfPb7");

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		while ($ob = $res->GetNext()) {
			$labours[$ob[ID]] = $ob[NAME];
		}


		foreach ($this->grossproduct as $key => $value) {
			if ($labours[$key]) {
				$hoursperday = round($value / 247);

				for ($i = 0; $i < 365; $i++) {
					$timestamp = strtotime("+" . $i . " day", MakeTimeStamp($date, "DD.MM.YYYY") - 86400 * 365);
					if (date("l", $timestamp) != "Saturday" && date("l", $timestamp) != "Sunday") {
						$d = date("d.m.Y", $timestamp);


						$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_DATE", "PROPERTY_WORKER");

						$arFilter = Array("IBLOCK_ID" => WORKINGTIME_IBID, "ACTIVE" => "Y", "PROPERTY_DATE" => \CDatabase::FormatDate($d, "DD.MM.YYYY", "YYYY-MM-DD"), "PROPERTY_WORKER" => $this->GetWorkerByFactorId($key));

						$r = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

						if ($r->SelectedRowsCount() > 0) {

							$a = $r->Fetch();

							$prop = array("DATE" => $d, "WORKER" => $this->GetWorkerByFactorId($key), "PLAN" => $hoursperday, "FACT" => $hoursperday);

							\CIBlockElement::SetPropertyValuesEx($a["ID"], WORKINGTIME_IBID, $prop);

						} else {

							$prop = array("DATE" => $d, "WORKER" => $this->GetWorkerByFactorId($key), "PLAN" => $hoursperday, "FACT" => $hoursperday);

							$arLoadProductArray = Array(
								"MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
								"IBLOCK_ID" => WORKINGTIME_IBID,
								"PROPERTY_VALUES" => $prop,
								"NAME" => $key,
								"ACTIVE" => "Y",            // активен
							);

							$el = new \CIBlockElement;
							$el->Add($arLoadProductArray);
						}
					}
				}


			}

		}
	}

	public function PrintNetProduct($date)
	{
		if ($date)
			$str = " на " . $date;

		echo "<h4 class='mt-3'>Конечный продукт$str</h4>Плановый объем продукции для конечного потребления,  который необходимо получить в результате работы всех отраслей экономики. Расчитывается программным алгоритмом на основании экстраполяции трендов конечного спроса по результатам продаж продукции конечного потребления в прошлом.";

		$this->PrintProduct($this->netproduct);

	}

	public function PrintGrossProduct($date, $showstats = true)
	{
		if ($date)
			$str = " на " . $date;

		if ($this->stopflag)
			echo "<br>Несовместная матрица<br><br>";
		else {
			echo "<h4 class='mt-3'>Валовый продукт$str</h4>Результат расчета межотраслевого баланса. Плановый объем валовой продукции (план по валу), который необходимо произвести во всех отраслях экономики для получения требуемого количества конечного продукта<br>";

			$this->PrintProduct($this->grossproduct);

			if ($showstats) {
				echo "<h4 class='mt-3'>Статистика</h4>Размерность матрицы МОБ: <b>" . $this->razmer . "х" . $this->razmer . "</b><br>Относительная погрешность вычислений: <b>" . strval($this->errorrate * 100) . "%</b><br>";

				$this->endtime = time();

				echo "Количество произведенных операций с плавающей точкой: <b>" . $this->operations . "</b>";

				echo "<br>Количество секунд, затраченных на вычисление плана: <b>" . strval($this->endtime - $this->starttime) . "</b>";
			}
		}
	}

	public function PrintMOB()
	{
		echo "<h4 class='mt-3'>Матрица межотраслевого баланса</h4>Квадратная матрица, содержщая коэффициенты производства продукции во всех отраслях экономики. На пересечении строк и столбцов находятся коэффициенты использования комплектующих для производства продукции. Например, если для производства единицы продукта №1 требуется 0.05 единиц продукта №2, то в ячейке [1,2] стоит число 0.05.<br>";
		$this->PrintMatrix($this->matrix);
	}


	private function PrintMatrix($m)
	{
		$copy = $this->header;

		echo "<div class='datatable-scroll overflow-auto  mt-2 mb-2'><table border=1 cellpadding=5 class='table table-bordered table-striped table-hover table-scrollable table-condensed datatable-highlight dataTable table-bordered'>";
		echo "<tr><td class='grey'></td>";
		foreach ($this->header as $i => $val) {
			echo "<td class='m grey'>" . strval($val) . "</td>";
		}
		echo "</tr>";
		foreach ($this->header as $i => $val) {
			echo "<tr>";
			echo "<td class='grey'>" . strval($this->header[$i]) . "</td>";
			foreach ($copy as $j => $val2) {
				echo "<td class=m>";
				echo "<b>" . $m[$i][$j] . "</b>";
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table></div>";
	}


	private function PrintProduct($m)
	{

		echo "<div class='datatable-scroll overflow-auto  mt-2 mb-2'><table border=1 cellpadding=5 class='table table-bordered table-striped table-hover table-scrollable table-condensed datatable-highlight dataTable table-bordered'>";
		echo "<tr>";
		foreach ($this->header as $i => $val) {
			echo "<td class='m grey'>" . strval($val) . "</td>";
		}
		echo "</tr>";
		echo "<tr>";
		foreach ($this->header as $i => $val) {
			echo "<td class=m>";
			if ($this->capacity[$i] > 0 && floatval($this->capacity[$i]) < floatval($m[$i]))
				echo "<b style='color:red'>" . $m[$i] . "</b>";
			else
				echo "<b>" . $m[$i] . "</b>";
			echo "</td>";

		}
		echo "</tr>";
		echo "</table></div>";
	}

	private function MOB($key, $val)
	{
		if ($this->stopflag) return;

		foreach ($this->header as $i => $h) {

			if ($this->matrix[$key][$i] > 0) {

				$coeff = $this->matrix[$key][$i] * $val;
				$this->grossproduct[$i] += $coeff;
				$this->operations++;

			} else
				continue;


			if ($this->matrix[$key][$i] * $this->matrix[$i][$key] > 1 && $i <> $key) {
				$this->stopflag = true;
				return;
			}

			if ($i <> $key && $coeff >= $this->grossproduct[$i] * $this->errorrate) {
				$this->MOB($i, $coeff);
			}

		}
		return;
	}

	public function CalculateMOB($date)
	{
		$this->operations = 0;

		//Проверка матрицы МОБа на сходимость;
		if ($this->Convergence()) {

			foreach ($this->netproduct as $key => $val) {
				$this->MOB($key, $val);
			}

			if ($this->stopflag) {
				echo "Матрица МОБа не сходится. Рассчитать МОБ невозможно.";
			} else {
				ksort($this->grossproduct);

				foreach ($this->netproduct as $key => $value)
					$this->grossproduct[$key] += $this->netproduct[$key];

				foreach ($this->grossproduct as $key => $value)
					$this->grossproduct[$key] = round($this->grossproduct[$key], 2);
			}
		} else
			echo "Матрица МОБа не сходится. Рассчитать МОБ невозможно.";
	}


	public function OverCapacity()
	{

		foreach ($this->netproduct as $key => $value) {
			if ($this->netproduct[$key] > $this->capacity[$key] && $this->capacity[$key] > 0)
				return true;
		}

		foreach ($this->grossproduct as $key => $value) {
			if ($this->grossproduct[$key] > $this->capacity[$key] && $this->capacity[$key] > 0)
				return true;
		}

		return false;

	}

	public function CalculateLackOfCapacity()
	{

		$this->lack = array();

		foreach ($this->netproduct as $key => $value) {
			if ($this->netproduct[$key] > $this->capacity[$key] && $this->capacity[$key] > 0)
				$this->lack[$key] = $this->netproduct[$key] - $this->capacity[$key];
		}

		foreach ($this->grossproduct as $key => $value) {
			if ($this->grossproduct[$key] > $this->capacity[$key] && $this->capacity[$key] > 0)
				$this->lack[$key] = $this->grossproduct[$key] - $this->capacity[$key];
		}
	}

	public function PlanNewCapitalFunds($date)
	{
		$expansionperiod = 0;
		$this->addedcapacity = array();

		foreach ($this->lack as $key => $value) {
			if ($this->lack[$key] > 0) {
				$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_PARENT.NAME", "PROPERTY_PARENT.PROPERTY_UNIT", "PROPERTY_FACTOR", "PROPERTY_FACTOR.NAME", "PROPERTY_FACTOR.PROPERTY_UNIT", "PROPERTY_QUANTITY", "PROPERTY_UNIT");

				$arFilter = Array("IBLOCK_ID" => EXPANSION_IBID, "ACTIVE" => "Y", "PROPERTY_PARENT_VALUE" => $key);

				$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

				while ($ob = $res->GetNext()) {

					if ($this->expansion[$key] > $this->lack[$key]) {
						$this->addedcapacity[$key] = $this->expansion[$key];
						$this->netproduct[$ob[PROPERTY_FACTOR_VALUE]] = $ob[PROPERTY_QUANTITY_VALUE];
					} else {
						$multiplier = ceil($this->lack[$key] / $this->expansion[$key]);

						$this->addedcapacity[$key] = $this->expansion[$key] * $multiplier;
						$this->netproduct[$ob[PROPERTY_FACTOR_VALUE]] += $ob[PROPERTY_QUANTITY_VALUE] * $multiplier;

					}

					$periodseconds = intval(GetHLElement(PERIODS_HLID, $this->expansionperiod[$key])["UF_DESCRIPTION"]);

					if ($periodseconds > $expansionperiod)
						$expansionperiod = $periodseconds;
				}


			}


		}

		return intval($expansionperiod / 86400);

	}


	public function ExtendCapacity()
	{
		foreach ($this->lack as $key => $value) {
			$this->capacity[$key] += $this->addedcapacity[$key];
		}

		echo "<h4 class='mt-3'>Производственные мощности расширены</h4>";
	}

	public function PrintCapacity($date)
	{
		if ($date)
			$str = " на " . $date;

		echo "<h4 class='mt-3'>Производственные мощности$str</h4>";
		$this->PrintProduct($this->capacity);
	}

	public function PrintLack($date)
	{
		if ($date)
			$str = " на " . $date;
		echo "<h4 class='mt-3'>Недостаток производственных мощностей$str</h4>";
		$this->PrintProduct($this->lack);
	}

	public function PrintAdded()
	{
		if ($date)
			$str = " на " . $date;
		echo "<h4 class='mt-3'>Дополнительные производственные мощности$str</h4>";
		$this->PrintProduct($this->addedcapacity);
	}


	public function CleanProduct()
	{
		foreach ($this->header as $i => $val)
			$this->netproduct[$i] = 0;

		foreach ($this->header as $i => $val)
			$this->grossproduct[$i] = 0;
	}

	public function Recalculate($date)
	{
		$this->CleanProduct();
		$this->FillNetProduct($date);
		$this->CalculateMOB($date);
	}


	public function Determinat()
	{

		foreach ($this->matrix2 as $key => $val)
			$this->matrix2[$key] = array_values($this->matrix2[$key]);

		$this->matrix2 = array_values($this->matrix2);

		return LinAlg::det($this->matrix2);
	}


	/**
	 * Метод определяет сходимость матрицы МОБа - имеет ли система линейных уравнений решение.
	 * @return bool
	 */
	public function Convergence()
	{
		if ($this->Determinat() > 0)
			return true;
		else
			return false;
	}
}