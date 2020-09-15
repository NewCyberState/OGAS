<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Я делегат");
global $USER;
$arrFilter1=array("UF_DELEGATE"=>$USER->GetID());
?>
<?/*$APPLICATION->IncludeComponent("bitrix:highloadblock.list", "i_delegate", Array(
	"BLOCK_ID" => "3",	// ID highload блока
		"CHECK_PERMISSIONS" => "N",	// Проверять права доступа
		"COMPONENT_TEMPLATE" => "my_delegates",
		"DETAIL_URL" => "",	// Путь к странице просмотра записи
		"FILTER_NAME" => "arrFilter1",	// Идентификатор фильтра
		"PAGEN_ID" => "page",	// Идентификатор страницы
		"ROWS_PER_PAGE" => "",	// Разбить по страницам количеством
		"SORT_FIELD" => "UF_DATE",	// Поле сортировки
		"SORT_ORDER" => "DESC",	// Направление сортировки
	),
	false
);*/?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "idelegate",
    Array(
        "ADD_SECTIONS_CHAIN" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "COUNT_ELEMENTS" => "Y",
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
        "FILTER_NAME" => "sectionsFilter",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "ogas",
        "SECTION_CODE" => "",
        "SECTION_FIELDS" => array(0=>"",1=>"",),
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "2",
        "VIEW_MODE" => "LINE"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>