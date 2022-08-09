<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");


if($_REQUEST["id"]) {

    $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PARENT", "PROPERTY_FACTOR");

    $arFilter = Array("IBLOCK_ID" => STRUCTURE_IBID, "ACTIVE" => "Y");

    $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while ($ob = $res->GetNext()) {
        if($ob[PROPERTY_PARENT_VALUE]==intval($_REQUEST["id"]))
            CIBlockElement::Delete($ob["ID"]);
        if($ob[PROPERTY_FACTOR_VALUE]==intval($_REQUEST["id"]))
            CIBlockElement::Delete($ob["ID"]);
    }

    CIBlockElement::Delete(intval($_REQUEST["id"]));


    return;
}