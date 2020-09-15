<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Авторизация");
global $USER;
if (!$USER->IsAuthorized()) {
    ?><? $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot-password/",
            "AUTH_REGISTER_URL" => "/auth/registration/",
            "AUTH_SUCCESS_URL" => "/lkg/gos/",
            "SHOW_ERRORS" => "Y",
        )
    ); ?><br><?
}
else
{
    LocalRedirect("/lkg/gos/");

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>