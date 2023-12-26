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
 * Class Company
 * @package OGAS\Economy
 */
class Company
{
    protected $sales = array();
    protected $products = array();
    protected $saleproducts = array();

    protected $company_id;
    protected $minX;
    protected $maxX;
    protected $coordsN;
    protected $arX;
    protected $arY;
    protected $step;
    protected $arCoords;
    protected $errMsg = false;
    protected $curveCoords;
    public $name;

    private $factorialLookup;

    function __construct($COMPANY_ID)
    {

        $this->company_id = $COMPANY_ID;
        $this->name=GetElement($COMPANY_ID)["NAME"];


    }

    function GetNa($COMPANY_ID)
    {

        $this->company_id = $COMPANY_ID;

    }

    public function GetProducts()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $this->products[$ob[ID]]=$ob[NAME];
        }

        ksort($this->products);

        return $this->products;
    }

    public function GetEndProducts()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY", "PROPERTY_ENDPRODUCT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id, "!PROPERTY_ENDPRODUCT" => false);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $this->products[$ob[ID]]=$ob[NAME];
        }

        ksort($this->products);

        return $this->products;
    }

    public function GetProduct($PID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE","DATE_ACTIVE_FROM", "PROPERTY_UNIT","PROPERTY_TYPE","PROPERTY_ENDPRODUCT","PROPERTY_CAPACITY","PROPERTY_PERIOD","PROPERTY_EXPANSION","PROPERTY_EXPANSIONPERIOD");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","ID" => $PID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            return $ob;
        }
    }

    public function UpdateProduct($product)
    {
        global $USER;
        if($product[ID])
        {
            $el = new \CIBlockElement;
            $PROP = array();
            $PROP["TYPE"]=$product["PROPERTY_TYPE"];
            $PROP["COMPANY"]=$product["PROPERTY_COMPANY"];
            $PROP["UNIT"]=$product["PROPERTY_UNIT"];
            $PROP["ENDPRODUCT"]=$product["PROPERTY_ENDPRODUCT"];
            $PROP["CAPACITY"]=$product["PROPERTY_CAPACITY"];
            $PROP["PERIOD"]=$product["PROPERTY_PERIOD"];
            $PROP["EXPANSION"]=$product["PROPERTY_EXPANSION"];
            $PROP["EXPANSIONPERIOD"]=$product["PROPERTY_EXPANSIONPERIOD"];

            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $product["NAME"],
                "ACTIVE"         => "Y",            // активен
                "PREVIEW_TEXT"   => $product["PREVIEW_TEXT"],
            );

            if($_FILES[DETAIL_PICTURE])
                $arLoadProductArray["DETAIL_PICTURE"] =$_FILES[DETAIL_PICTURE];

            $res = $el->Update($product[ID], $arLoadProductArray);
        }
    }

    public function AddProduct($product)
    {
        global $USER;
        if(true)
        {
            $el = new \CIBlockElement;
            $PROP = array();
            $PROP["TYPE"]=$product["PROPERTY_TYPE"];
            $PROP["COMPANY"]=$product["PROPERTY_COMPANY"];
            $PROP["UNIT"]=$product["PROPERTY_UNIT"];
            $PROP["ENDPRODUCT"]=$product["PROPERTY_ENDPRODUCT"];
            $PROP["CAPACITY"]=$product["PROPERTY_CAPACITY"];
            $PROP["PERIOD"]=$product["PROPERTY_PERIOD"];
            $PROP["EXPANSION"]=$product["PROPERTY_EXPANSION"];
            $PROP["EXPANSIONPERIOD"]=$product["PROPERTY_EXPANSIONPERIOD"];

            $arLoadProductArray = Array(
                "CREATED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                "IBLOCK_ID" => FACTORS_IBID,          // элемент лежит в корне раздела
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $product["NAME"],
                "ACTIVE"         => "Y",            // активен
                "PREVIEW_TEXT"   => $product["PREVIEW_TEXT"],

            );

            if($_FILES[DETAIL_PICTURE])
                $arLoadProductArray["DETAIL_PICTURE"] =$_FILES[DETAIL_PICTURE];

            if($PRODUCT_ID = $el->Add($arLoadProductArray))
                LocalRedirect("/ipp/".$product["PROPERTY_COMPANY"]."/nomenclature/".$PRODUCT_ID."/edit/");
            else
                echo "Error: ".$el->LAST_ERROR;
        }
    }


    public function GetProductsByType($typeID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COMPANY", "PROPERTY_UNIT", "PROPERTY_TYPE", "PROPERTY_QUANTITY", "PROPERTY_ENDPRODUCT");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","PROPERTY_TYPE" => $typeID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            if($ob["PROPERTY_ENDPRODUCT_VALUE"] || $ob["PROPERTY_COMPANY_VALUE"]== $this->company_id)
                $products[$ob[ID]]=$ob[NAME];
        }

        asort($products);

        return $products;
    }

    public function GetProductTypes()
    {
        $hlbl = TYPES_HLID;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
        ));

        while ($arData = $rsData->Fetch())
            $data[$arData["UF_XML_ID"]]=$arData;

        return $data;
    }

    public function GetProductUnits()
    {
        $hlbl = UNITS_HLID;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
        ));

        while ($arData = $rsData->Fetch())
            $data[$arData["UF_XML_ID"]]=$arData;

        return $data;
    }

    public function GetPeriods()
    {
        $hlbl = PERIODS_HLID;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
        ));

        while ($arData = $rsData->Fetch())
            $data[$arData["UF_XML_ID"]]=$arData;

        return $data;
    }


    public function GetProductUnit($ID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","ID" => $ID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_UNIT_VALUE]);
            return $unit["UF_NAME"];
            break;
        }
    }

    public function GetStructure($productID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT","PROPERTY_FACTOR","PROPERTY_FACTOR.PROPERTY_TYPE", "PROPERTY_QUANTITY","PROPERTY_UNIT",);

        $arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y","PROPERTY_PARENT" => $productID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_UNIT_VALUE]);
            $type = GetHLElement(TYPES_HLID, $ob[PROPERTY_FACTOR_PROPERTY_TYPE_VALUE]);
            $structure[$ob[ID]]=array($ob[PROPERTY_FACTOR_VALUE],$ob[PROPERTY_QUANTITY_VALUE],$unit["UF_NAME"],$type["UF_NAME"]);
        }


        return $structure;
    }

    public function GetExpansion($productID)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT","PROPERTY_FACTOR","PROPERTY_FACTOR.PROPERTY_TYPE", "PROPERTY_QUANTITY","PROPERTY_UNIT",);

        $arFilter = Array("IBLOCK_ID" => EXPANSION_IBID, "ACTIVE" => "Y","PROPERTY_PARENT" => $productID);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $unit = GetHLElement(UNITS_HLID, $ob[PROPERTY_UNIT_VALUE]);
            $type = GetHLElement(TYPES_HLID, $ob[PROPERTY_FACTOR_PROPERTY_TYPE_VALUE]);
            $structure[$ob[ID]]=array($ob[PROPERTY_FACTOR_VALUE],$ob[PROPERTY_QUANTITY_VALUE],$unit["UF_NAME"],$type["UF_NAME"]);
        }


        return $structure;
    }



    public function GetSales()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $this->products[$ob[ID]]=$ob[NAME];
        }

        ksort($this->products);

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRODUCT", "PROPERTY_PRODUCT.NAME", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => SALES_IBID, "ACTIVE" => "Y", "PROPERTY_PRODUCT" => array_keys($this->products));

        $res = \CIBlockElement::GetList(Array("property_DATE" => "asc"), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {

            if(!$this->sales[ConvertDateTime($ob[PROPERTY_DATE_VALUE], "YYYYMM")])
                $this->sales[ConvertDateTime($ob[PROPERTY_DATE_VALUE], "YYYYMM")]=array( ConvertDateTime($ob[PROPERTY_DATE_VALUE], "MM.YYYY"));

            if(!$this->saleproducts[$ob[PROPERTY_PRODUCT_VALUE]])
                $this->saleproducts[$ob[PROPERTY_PRODUCT_VALUE]]=$this->products[$ob[PROPERTY_PRODUCT_VALUE]];

            $this->sales[ConvertDateTime($ob[PROPERTY_DATE_VALUE], "YYYYMM")][$ob[PROPERTY_PRODUCT_VALUE]]=intval($ob[PROPERTY_QUANTITY_VALUE]);

        }

        return $this->sales;
    }

    public
    function GetAjaxData()
    {
        $arr[0][] = 'Месяц';
        ksort($this->saleproducts);
        foreach($this->saleproducts as $product)
            $arr[0][] = $product;

        foreach ($this->sales as $key => $sale)
        {
            ksort($sale);
            $temp=array();
            foreach ($sale as $value)
                $temp[]=$value;

            array_push($arr,$temp);

        }
        echo json_encode($arr);
    }


    public function GetLabours()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

        $arFilter = Array("IBLOCK_ID" => FACTORS_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id, "PROPERTY_TYPE" => "fwnKfPb7");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $labours[$ob[ID]]=$ob[NAME];
        }

        asort($labours);

        return $labours;
    }

    public function GetClasses()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

        $arFilter = Array("IBLOCK_ID" => TARIFFGRID_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $classes[$ob[ID]]=$ob[NAME];
        }

        //asort($classes);

        return $classes;
    }

    public function GetPositions()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

        $arFilter = Array("IBLOCK_ID" => POSITION_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $positions[$ob[ID]]=$ob[NAME];
        }

        asort($positions);

        return $positions;
    }

    public function GetUsers()
    {
        $filter = Array(
            "GROUPS_ID" => Array(8),
            "ACTIVE" => "Y",
        );

        $rsUsers = \CUser::GetList(($by="last_name"), ($order="asc"), $filter);

        while ($ob = $rsUsers->Fetch()) {
            $users[$ob[ID]]="[".$ob[ID]."] ".$ob[NAME]." ".$ob[LAST_NAME];
        }

        //asort($users);

        return $users;
    }

    public function GetWorkers()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

        $arFilter = Array("IBLOCK_ID" => WORKERS_IBID, "ACTIVE" => "Y","PROPERTY_COMPANY" => $this->company_id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $workers[$ob[ID]]=$ob[NAME];
        }

        asort($workers);

        return $workers;
    }
}

