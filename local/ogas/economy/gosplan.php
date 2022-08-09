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
 * Class Gosplan
 * @package OGAS\Economy
 */
class Gosplan
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

    function __construct()
    {
    }

    public function GetCompanyList()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => COMPANY_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $companylist[$ob[ID]] = $ob[NAME];
        }

        asort($companylist);

        return $companylist;
    }


    public
    function GetSaleProductList($company_id)
    {

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRODUCT", "PROPERTY_PRODUCT.NAME", "PROPERTY_DATE", "PROPERTY_QUANTITY", "PROPERTY_TYPE", "PROPERTY_UNIT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y", "PROPERTY_COMPANY" => $company_id, "PROPERTY_TYPE" => "ZZM8X4af");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            if (!$productlist[$ob[ID]]) {
                $unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_UNIT_VALUE]);
                $productlist[$ob[ID]] = array($ob[NAME], $unit[UF_NAME]);
            }
        }

        return $productlist;
    }

    public function GetWorkerRate($COMPANY_ID, $FACTOR_ID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_CLASS");

        $arFilter = Array("IBLOCK_ID" => WORKERS_IBID, "ACTIVE" => "Y", "PROPERTY_COMPANY" => $COMPANY_ID, "PROPERTY_FACTOR" => $FACTOR_ID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            if ($ob["PROPERTY_CLASS_VALUE"]) {
                $rate = GetElement($ob["PROPERTY_CLASS_VALUE"])["PROPERTIES"]["RATE"]["VALUE"];
                return $rate;
            } else
                return false;
        }
    }

    public function ClearAllPrices()
    {

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COMPANY", "PROPERTY_TYPE", "PROPERTY_UNIT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            self::UpdatePrice($ob[ID],0);
        }

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            self::UpdatePrice($ob[ID],0);
        }
    }

    public function CalculatePrices()
    {
        self::ClearAllPrices();


        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COMPANY", "PROPERTY_TYPE", "PROPERTY_UNIT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y", "PROPERTY_TYPE" => "fwnKfPb7");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $factors[] = $ob["ID"];
            $rate = self::GetWorkerRate($ob["PROPERTY_COMPANY_VALUE"], $ob["ID"]);
            $price = $rate;

            self::UpdatePrice($ob["ID"],$price);
        }

        foreach ($factors as $factor)
            self::UpdateStructurePrices($factor);

        self::UpdateNotCalculatedFactors();

    }


    public function UpdateNotCalculatedFactors($IDS=false)
    {

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COMPANY", "PROPERTY_TYPE", "PROPERTY_UNIT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y", "!PROPERTY_TYPE" => "fwnKfPb7");

        if($IDS)
            $arFilter["PROPERTY_FACTOR"]=$IDS;


        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

                self::UpdateStructurePrices($ob["ID"]);

                $factorPrice2 = \CCatalogProduct::GetOptimalPrice($ob["ID"])[RESULT_PRICE][DISCOUNT_PRICE];

                if(!$factorPrice2)
                    $notCalculatedFactors[] = $ob["ID"];
        }

        if($notCalculatedFactors)
            self::UpdateNotCalculatedFactors($notCalculatedFactors);

    }

    public function UpdateStructurePrices($ID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y", "PROPERTY_FACTOR" => $ID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            $factorPrice = \CCatalogProduct::GetOptimalPrice($ob["PROPERTY_FACTOR_VALUE"])[RESULT_PRICE][DISCOUNT_PRICE];

            if ($factorPrice > 0) {
                $price = $factorPrice * floatval($ob["PROPERTY_QUANTITY_VALUE"]);

                self::UpdatePrice($ob["ID"],$price);

                self::UpdateFactorPrices($ob[PROPERTY_PARENT_VALUE]);
            }


        }
    }

    public function UpdateFactorPrices($ID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y", "PROPERTY_PARENT" => $ID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            $factorPrice = \CCatalogProduct::GetOptimalPrice($ob["ID"])[RESULT_PRICE][DISCOUNT_PRICE];

            if ($factorPrice)
                $parentPrice += $factorPrice;
            else {
                $factorPrice = \CCatalogProduct::GetOptimalPrice($ob["PROPERTY_FACTOR_VALUE"])[RESULT_PRICE][DISCOUNT_PRICE];
                if ($factorPrice) {
                    $parentPrice += $factorPrice * floatval($ob["PROPERTY_QUANTITY_VALUE"]);

                    self::UpdatePrice($ob["ID"],$factorPrice * floatval($ob["PROPERTY_QUANTITY_VALUE"]));

                }
                else
                    return;
            }

        }

        self::UpdatePrice($ID,$parentPrice);



    }

    public function UpdatePrice($ID,$price)
    {
        $PRODUCT_ID = $ID;
        $PRICE_TYPE_ID = 1;

        $arFields = Array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
            "PRICE" => $price,
            "CURRENCY" => "RUB",
        );

        $res = \CPrice::GetList(
            array(),
            array(
                "PRODUCT_ID" => $PRODUCT_ID,
                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
            )
        );

        if ($arr = $res->Fetch()) {
            \CPrice::Update($arr["ID"], $arFields);
        } else {
            \CPrice::Add($arFields);
        }
    }


    public function GetStat()
    {
        $result=array();

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        $result["FACTORS_CNT"]=$res->SelectedRowsCount();

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y",">PROPERTY_ENDPRODUCT"=>0);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        $result["ENDPRODUCT_CNT"]=$res->SelectedRowsCount();


        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_PLAN_QTY");

        $arFilter = Array("IBLOCK_ID" => PRODUCTIONPLANS_IBID, "ACTIVE" => "Y",">PROPERTY_DATE"=>date("Y-m-d"));

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $sum+=$ob["PROPERTY_PLAN_QTY_VALUE"];
        }

        $result["PLAN_QTY"]=intval($sum);

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR", "PROPERTY_PLAN_QTY","PROPERTY_PRODUCT_ID");

        $arFilter = Array("IBLOCK_ID" => PRODUCTIONPLANS_IBID, "ACTIVE" => "Y",">PROPERTY_DATE"=>date("Y-m-d"));

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $qty=$ob["PROPERTY_PLAN_QTY_VALUE"];
            $price=\CCatalogProduct::GetOptimalPrice($ob["PROPERTY_PRODUCT_ID_VALUE"]);
            $gross+=$qty*$price[DISCOUNT_PRICE];
        }

        $result["PLAN_GROSS"]=intval($gross);

        return $result;
    }

}

