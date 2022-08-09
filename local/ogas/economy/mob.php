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

/**/


/**
 * Class MOB
 * @package OGAS\Economy
 */
class MOB
{

    private $matrix = array();
    private $header = array();
    public $netproduct = array();
    public $grossproduct = array();
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


    }

    public function CalculateMOB($date)
    {

        foreach ($this->netproduct as $t => $q) {
            $this->MOB($t, $q);
        }

        ksort($this->grossproduct);

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

        $this->razmer = count($this->netproduct);
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

    public function PrintNetProduct()
    {

        echo "<h4 class='mt-3'>Конечный продукт</h4>Плановый объем продукции для конечного потребления,  который необходимо получить в результате работы всех отраслей экономики. Расчитывается программным алгоритмом на основании экстраполяции трендов конечного спроса по результатам продаж продукции конечного потребления в прошлом.";

        $this->PrintProduct($this->netproduct);

    }

    public function PrintGrossProduct()
    {
        if ($this->stopflag)
            echo "<br>Несовместная матрица<br><br>";
        else {
            echo "<h4 class='mt-3'>Валовый продукт</h4>Результат расчета межотраслевого баланса. Плановый объем валовой продукции (план по валу), который необходимо произвести во всех отраслях экономики для получения требуемого количества конечного продукта<br>";

            $this->PrintProduct($this->grossproduct);

            echo "<h4 class='mt-3'>Статистика</h4>Размерность матрицы МОБ: <b>" . $this->razmer . "х" . $this->razmer . "</b><br>Относительная погрешность вычислений: <b>" . strval($this->errorrate * 100) . "%</b><br>";

            $this->endtime = time();

            echo "Количество произведенных операций с плавающей точкой: <b>" . $this->operations . "</b>";

            echo "<br>Количество секунд, затраченных на вычисление плана: <b>" . strval($this->endtime - $this->starttime) . "</b>";
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
            echo "<b>" . $m[$i] . "</b>";
            echo "</td>";

        }
        echo "</tr>";
        echo "</table></div>";
    }

    private function MOB($t, $q)
    {
        if ($this->stopflag) return;

        if ($this->operations >= pow($this->razmer, 4)) {

            echo "<br>Перегрузка, слишком много операций. Возможно матрица несовместна<br>";
            exit;

        }

        foreach ($this->header as $i => $h) {

            if ($this->matrix[$t][$i] > 0) {

                $coeff = $this->matrix[$t][$i] * floor($q);
                $this->operations++;

            } else
                continue;

            if ($i == $t && $coeff >= $this->grossproduct[$i] * $this->errorrate) {

                $this->grossproduct[$t] += $coeff;
                $this->operations++;

            }

            if ($this->matrix[$t][$i] * $this->matrix[$i][$t] > 1 && $i <> $t) {

                echo "<br>Решение не может быть найдено! Несовместная матрица!<br>";
                pr($coeff);
                pr($final);
                pr($i);
                pr($t);
                $this->stopflag = true;
                return;

            }

            if ($i <> $t && $coeff >= $this->grossproduct[$i] * $this->errorrate) {

                $this->grossproduct[$i] += $coeff;
                $this->MOB($i, $coeff);

            } elseif ($i <> $t && $coeff < $this->grossproduct[$i] * $this->errorrate) {

                $this->grossproduct[$i] += $coeff;
                $this->operations++;

            }

        }
        return;
    }
}