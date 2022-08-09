<?php

namespace OGAS\Economy;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('iblock');
Loader::includeModule('blog');
Loader::includeModule('socialnetwork');
Loader::includeModule('vote');

/**/


/**
 * Class Plan
 * @package OGAS\Economy
 */
class Plan
{

    private $sales = array();
    private $products = array();

    protected $product_id;
    protected $minX;
    protected $maxX;
    protected $coordsN;
    protected $arX;
    protected $arY;
    protected $step;
    protected $arCoords;
    protected $errMsg = false;
    protected $curveCoords;

    private $factorialLookup;

    function __construct($PRODUCT_ID)
    {
        $this->product_id = $PRODUCT_ID;
        $this->FillSales();

        $step = 5;

        $this->setCoords($this->sales, $step);

        if (!$this->getError()) {
            //Расчет координат кривой
            $this->curveCoords = $this->process();

        }
    }

    private function FillSales()
    {

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRODUCT", "PROPERTY_PRODUCT.NAME", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => SALES_IBID, "ACTIVE" => "Y", "PROPERTY_PRODUCT" => $this->product_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            $this->sales[ConvertDateTime($ob[PROPERTY_DATE_VALUE], "YYYYMM")] = $ob[PROPERTY_QUANTITY_VALUE];

        }
    }


    private
    function GetSaleProducts()
    {

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRODUCT", "PROPERTY_PRODUCT.NAME", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => SALES_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            if (!$this->products[$ob[PROPERTY_PRODUCT_VALUE]]) {
                $this->products[$ob[PROPERTY_PRODUCT_VALUE]] = $ob[PROPERTY_PRODUCT_NAME];
            }
        }

        return $this->products;
    }


    public
    function Planning($date)
    {
        $curve = $this->curveCoords;
        $intdate = ConvertDateTime($date, "YYYYMM");
        end($this->curveCoords);
        $lastkey = key($this->curveCoords);
        $t = $intdate - key($this->curveCoords);
        $r = key($this->curveCoords) - $t;

        reset($curve);

        foreach ($curve as $key => $value)
            if ($key >= $r) {
                $prevkey = $key;
                break;
            }
        $plan = $curve[$lastkey] + $curve[$lastkey] - $curve[$prevkey];

        return round($plan);
    }

    public
    function GetAjaxData($date)
    {
        $arr[] = array('Год', 'Объем продаж, шт', array('type' => 'string', 'role' => 'style'));
        foreach ($this->sales as $key => $value)
            $arr[] = array(intval($key), intval($value), null);

        $arr[] = array(ConvertDateTime($date, "YYYYMM"), $this->Planning($date), "point { shape-type: circle; fill-color: red; }");

        echo json_encode($arr);

    }

    public
    function setCoords(&$arCoords, $step = 1, $minX = -1, $maxX = -1)
    {
        if (count($arCoords) > 170) {
            $this->errMsg = 'Too many arguments: 170 max';
            return false;
        }

        if (count($arCoords) < 5) {
            $this->errMsg = 'Too few arguments: need 5 points at least.';
            return false;
        }

        $this->prepareCoords($arCoords, $step, $minX, $maxX);
    }

    public
    function process()
    {
        foreach ($this->arX as $k => $v) {
            $ptind[] = $v;
            $ptind[] = $this->arY[$k];
        }

        $this->Bezier2D($ptind, ($this->maxX - $this->minX) / $this->step, $p);

        for ($i = 0; $i < count($p) / 2; $i++) {
            $coords[$p[$i * 2]] = $p[$i * 2 + 1];
        }

        return $coords;
    }

    private
    function factorial($n)
    {
        if ($n > 170) exit;
        if (!isset($this->factorialLookup[$n])) {
            $f = 1;
            for ($i = 2; $i <= $n; $i++) {
                $f *= $i;
            }

            $this->factorialLookup[$n] = $f;
        }

        return $this->factorialLookup[$n];
    }

    private
    function Ni($n, $i)
    {
        $a1 = $this->factorial($n);
        $a2 = $this->factorial($i);
        $a3 = $this->factorial($n - $i);
        $ni = $a1 / ($a2 * $a3);
        return $ni;
    }

    private
    function Bernstein($n, $i, $t)
    {
        if ($t == 0.0 && $i == 0) $ti = 1.0;
        else $ti = pow($t, $i);
        if ($n == $i && $t == 1.0) $tni = 1.0;
        else $tni = pow((1 - $t), ($n - $i));

        $basis = $this->Ni($n, $i) * $ti * $tni;
        return $basis;
    }

    private
    function Bezier2D($b, $cpts, &$p)
    {
        $npts = (count($b)) / 2;

        $icount = 0;
        $t = 0;
        $step = 1.0 / ($cpts - 1);
        for ($i1 = 0; $i1 != $cpts; $i1++) {
            if ((1.0 - $t) < 5e-6) $t = 1.0;
            $jcount = 0;
            $p[$icount] = 0.0;
            $p[$icount + 1] = 0.0;
            for ($i = 0; $i != $npts; $i++) {
                $basis = $this->Bernstein($npts - 1, $i, $t);
                $p[$icount] += $basis * $b[$jcount];
                $p[$icount + 1] += $basis * $b[$jcount + 1];
                $jcount = $jcount + 2;
            }

            $icount += 2;
            $t += $step;
        }
    }

    protected
    function prepareCoords(&$arCoords, $step, $minX = -1, $maxX = -1)
    {
        $this->arX = array();
        $this->arY = array();
        $this->arCoords = array();

        try {
            if (count($arCoords) < 4) {
                throw Exception('Too few coordinates (' . count($arCoords) . ', min: .');
            }
        } catch (Exception $e) {
            die('Bad arguments: ' . $e->getMessage() . "\n");
        }

        ksort($arCoords);
        foreach ($arCoords as $x => $y) {
            $this->arX[] = $x;
            $this->arY[] = $y;
        }

        $this->coordsN = count($this->arX);

        $this->minX = $minX;
        $this->maxX = $maxX;

        if ($this->minX == -1) $this->minX = min($this->arX);
        if ($this->maxX == -1) $this->maxX = max($this->arX);
        $this->step = $step;
    }

    public
    function getError()
    {
        return $this->errMsg;
    }
}

