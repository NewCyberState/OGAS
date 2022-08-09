<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");


//AddMessage2Log($_REQUEST);

if($_REQUEST["id"]) {

    CIBlockElement::SetPropertyValuesEx(intval($_REQUEST["id"]), false,
        array(
            "FACT_QTY" => floatval($_REQUEST["quantity"])));

    return false;
}
