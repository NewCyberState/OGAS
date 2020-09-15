<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вопросы и ответы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:support.faq",
	".default",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"EXPAND_LIST" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "ogas",
		"PATH_TO_USER" => "",
		"RATING_TYPE" => "",
		"SECTION" => "",
		"SEF_FOLDER" => "/faq/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("faq"=>"","section"=>"#SECTION_ID#/","detail"=>"#SECTION_ID#/#ELEMENT_ID#",),
		"SHOW_RATING" => ""
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>