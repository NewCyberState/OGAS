<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Назначить делегатов");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "thematics",
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


	 <?/*$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", "choose_delegate", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"COLOR_NEW" => "3E74E6",	// Цвет более позднего тега (пример: "C0C0C0")
		"COLOR_OLD" => "C0C0C0",	// Цвет более раннего тега (пример: "FEFEFE")
		"COLOR_TYPE" => "Y",	// Плавное изменение цвета
		"FILTER_NAME" => "",	// Дополнительный фильтр
		"FONT_MAX" => "50",	// Максимальный размер шрифта (px)
		"FONT_MIN" => "10",	// Минимальный  размер шрифта (px)
		"PAGE_ELEMENTS" => "150",	// Количество тегов
		"PERIOD" => "",	// Период выборки тегов (дней)
		"PERIOD_NEW_TAGS" => "",	// Период,  в течение которого считать тег новым (дней)
		"SHOW_CHAIN" => "Y",	// Показывать цепочку навигации
		"SORT" => "NAME",	// Сортировка тегов
		"TAGS_INHERIT" => "Y",	// Сужать область поиска
		"URL_SEARCH" => "/search/index.php",	// Путь к странице поиска (от корня сайта)
		"WIDTH" => "100%",	// Ширина облака тегов (пример: "100%" или "100px", "100pt", "100in")
		"arrFILTER" => "",	// Ограничение области поиска
	),
	false
);*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>