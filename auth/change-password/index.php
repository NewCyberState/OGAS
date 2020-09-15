<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Смена пароля");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.changepasswd",
	"main",
	Array(
		"AUTH_AUTH_URL" => "/auth/",
		"AUTH_REGISTER_URL" => "/auth/registration/"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>