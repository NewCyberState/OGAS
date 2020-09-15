<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои делегаты");
global $USER;
$arrFilter1=array("UF_USER"=>$USER->GetID());
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "mydelegates",
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
	 <?/*$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list",
	"my_delegates",
	Array(
		"BLOCK_ID" => "3",
		"CHECK_PERMISSIONS" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"FILTER_NAME" => "arrFilter1",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "",
		"SORT_FIELD" => "UF_DATE",
		"SORT_ORDER" => "DESC"
	)
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>