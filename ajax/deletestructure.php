<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");


if($_REQUEST["id"]) {

    CIBlockElement::Delete(intval($_REQUEST["id"]));

    return false;
}