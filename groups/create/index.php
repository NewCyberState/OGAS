<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создание группы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.group_create", 
	"template1", 
	array(
		"GROUP_ID" => $group_id,
		"GROUP_VAR" => "",
		"PAGE_VAR" => "",
		"PATH_TO_GROUP" => "",
		"PATH_TO_GROUP_CREATE" => "",
		"PATH_TO_GROUP_EDIT" => "",
		"PATH_TO_USER" => "",
		"SET_NAVCHAIN" => "Y",
		"SET_TITLE" => "N",
		"USER_ID" => "=CUSER:GetID()",
		"USER_VAR" => "",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>