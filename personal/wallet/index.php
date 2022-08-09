<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой кошелек");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.account", 
	"2022", 
	array(
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "2022"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>