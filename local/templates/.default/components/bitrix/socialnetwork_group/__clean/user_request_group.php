<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$componentParameters = [
	"PATH_TO_USER" => $arParams["PATH_TO_USER"],
	"PATH_TO_GROUP" => $arResult["PATH_TO_GROUP"],
	"PATH_TO_GROUP_REQUESTS" => $arResult["PATH_TO_GROUP_REQUESTS"],
	"PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
	"PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
	"PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
	"PAGE_VAR" => $arResult["ALIASES"]["page"],
	"USER_VAR" => $arResult["ALIASES"]["user_id"],
	"GROUP_VAR" => $arResult["ALIASES"]["group_id"],
	"SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
	"SET_TITLE" => $arResult["SET_TITLE"],
	"PATH_TO_SMILE" => $arResult["PATH_TO_SMILE"],
	"GROUP_ID" => $arResult["VARIABLES"]["group_id"],
	"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
	"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
	"DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
	"SHOW_YEAR" => $arParams["SHOW_YEAR"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"USE_THUMBNAIL_LIST" => "N",
	"INLINE" => "Y",
	"USE_AUTOSUBSCRIBE" => "N",
];

$APPLICATION->IncludeComponent(
	'bitrix:socialnetwork.group.card.menu',
	'',
	[
		'GROUP_ID' => $arResult['VARIABLES']['group_id'],
		'TAB' => 'join',
		'URLS' => \Bitrix\Socialnetwork\ComponentHelper::getWorkgroupSliderMenuUrlList($arResult),
	]
);

$APPLICATION->IncludeComponent(
	"bitrix:ui.sidepanel.wrapper",
	"",
	array(
		'POPUP_COMPONENT_NAME' => 'bitrix:socialnetwork.user_request_group',
		'POPUP_COMPONENT_TEMPLATE_NAME' => '',
		'POPUP_COMPONENT_PARAMS' => $componentParameters,
		'POPUP_COMPONENT_USE_BITRIX24_THEME' => 'Y',
		'POPUP_COMPONENT_BITRIX24_THEME_ENTITY_TYPE' => 'SONET_GROUP',
		'POPUP_COMPONENT_BITRIX24_THEME_ENTITY_ID' => $arResult['VARIABLES']['group_id'],
	)
);
