<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой бюджет");
global $USER;

$arSelect = Array("ID", "IBLOCK", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_CODE"=>"budget", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_USERID"=>$USER->GetID());
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->Fetch())
{
    $_REQUEST["CODE"]=$ob[ID];
    break;
}
?><?$APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.form",
    "budget",
    array(
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_NAME" => "",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
        "CUSTOM_TITLE_TAGS" => "",
        "DEFAULT_INPUT_SIZE" => "30",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "ELEMENT_ASSOC" => "PROPERTY_ID",
        "GROUPS" => array(
            0 => "8",
        ),
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "ogas",
        "LEVEL_LAST" => "Y",
        "LIST_URL" => "/lkg/gos/budget/",
        "MAX_FILE_SIZE" => "0",
        "MAX_LEVELS" => "100000",
        "MAX_USER_ENTRIES" => "100000",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "PROPERTY_CODES" => array(
            0 => "20",
            1 => "21",
            2 => "22",
            3 => "23",
            4 => "24",
            5 => "25",
            6 => "26",
            7 => "27",
            8 => "28",
            9 => "29",
            10 => "30",
            11 => "31",
            12 => "32",
            13 => "33",
            14 => "34",
            15 => "35",
            16 => "NAME",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
        ),
        "RESIZE_IMAGES" => "N",
        "SEF_FOLDER" => "/lkg/gos/budget/",
        "SEF_MODE" => "Y",
        "STATUS" => "ANY",
        "STATUS_NEW" => "N",
        "USER_MESSAGE_ADD" => "",
        "USER_MESSAGE_EDIT" => "",
        "USE_CAPTCHA" => "N",
        "COMPONENT_TEMPLATE" => "budget",
        "ELEMENT_ASSOC_PROPERTY" => "20"
    ),
    false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>