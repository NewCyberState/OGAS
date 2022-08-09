<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

//$APPLICATION->IncludeComponent("bitrix:iblock.element.add.list", "", $arParams, $component);
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);


global $arrFilter;

$arrFilter=array("PROPERTY_COMPANY"=>$CID);

$arParams["PROPERTY_CODE"]=array("*");
$arParams["FILTER_NAME"]="arrFilter";

$APPLICATION->IncludeComponent("bitrix:news.list", "", $arParams, $component);

?>