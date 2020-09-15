<?
if(isset($_POST['USER_LOGIN']) && $_POST['USER_LOGIN'])
	$arResult["USER_LOGIN"] = htmlspecialcharsbx($_POST['USER_LOGIN']);
if(isset($arParams["BACKURL"]) && $arParams["BACKURL"])
{
	$arResult["BACKURL"] = $arParams["BACKURL"];
	$arResult["AUTH_FORGOT_PASSWORD_URL"] = $arParams["FORGOT_PASSWORD_URL"]."&backurl=".$arParams["BACKURL"];
	$arResult["AUTH_REGISTER_URL"] = $arParams["REGISTER_URL"]."&backurl=".$arParams["BACKURL"];
}
?>