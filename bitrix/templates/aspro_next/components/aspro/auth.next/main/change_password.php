<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $USER, $arTheme;
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
$APPLICATION->AddChainItem(GetMessage("TITLE"));
$APPLICATION->SetTitle(GetMessage("TITLE"));
$APPLICATION->SetPageProperty("TITLE_CLASS", "center");
?>
<style type="text/css">
	.left-menu-md, body .container.cabinte-page .maxwidth-theme .left-menu-md, .right-menu-md, body .container.cabinte-page .maxwidth-theme .right-menu-md{display:none !important;}
	.content-md{width:100%;}
</style>
<?if(!$USER->IsAuthorized()):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.changepasswd",
		"main",
		array(
			"AUTH_URL" => $arParams["SEF_FOLDER"],
			"URL" => $arParams["SEF_FOLDER"].$arParams["SEF_URL_TEMPLATES"]["change"],
			"~AUTH_RESULT" => $APPLICATION->arAuthResult,
		),
		false
	);?>
<?else:?>
	<?$url = ($arTheme["PERSONAL_PAGE_URL"]["VALUE"] ? $arTheme["PERSONAL_PAGE_URL"]["VALUE"] : $arParams["SEF_FOLDER"]);?>
	<?LocalRedirect($url);?>
<?endif;?>