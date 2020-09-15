<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Стать гражданином");
$APPLICATION->SetTitle("Стать гражданином");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"wizard", 
	array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_THEMATICS",
		),
		"USER_PROPERTY_NAME" => "",
		"COMPONENT_TEMPLATE" => "wizard"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>