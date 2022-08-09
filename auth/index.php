<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
global $USER;

    if ($_GET["back_url"])
        $success = $_GET["back_url"];
    else
        $success = "/lkg/";
    ?><? $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot-password/",
            "AUTH_REGISTER_URL" => "/auth/registration/",
            "BACK_URL" => $success,
            "SHOW_ERRORS" => "Y",
        )
    ); ?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>