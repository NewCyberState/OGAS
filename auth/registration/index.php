<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
if(CUSER::IsAUthorized()) LocalRedirect("/lkg/");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"main",
	Array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array("EMAIL","NAME","LAST_NAME","PERSONAL_PHOTO"),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array("EMAIL","NAME","SECOND_NAME","LAST_NAME","PERSONAL_BIRTHDAY","PERSONAL_PHOTO","PERSONAL_CITY","PERSONAL_STATE","PERSONAL_COUNTRY"),
		"SUCCESS_PAGE" => "/lkg/",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>