<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Запрос пароля");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	"main",
	Array(
		"AUTH_AUTH_URL" => "/auth/",
		"AUTH_REGISTER_URL" => "/auth/registration/"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>