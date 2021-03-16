<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
?>
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>

	<?if($arResult["DETAIL_TEXT"] <> ''):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?if($arProperty["CODE"]=="ARTICLES"):pr($arProperty["VALUE"]);?>



        <?endif;?>
	<?endforeach; ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:iblock.element.add.form",
                "budgets",
                array(
                    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                    "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                    "CUSTOM_TITLE_DETAIL_TEXT" => "",
                    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                    "CUSTOM_TITLE_NAME" => "",
                    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                    "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                    "CUSTOM_TITLE_TAGS" => "",
                    "DEFAULT_INPUT_SIZE" => "30",
                    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                    "ELEMENT_ASSOC" => "PROPERTY_ID",
                    "GROUPS" => array(
                        0 => "8",
                    ),
                    "IBLOCK_ID" => "12",
                    "IBLOCK_TYPE" => "ogas",
                    "LEVEL_LAST" => "Y",
                    "LIST_URL" => "/lkg/gos/budget/",
                    "MAX_FILE_SIZE" => "0",
                    "MAX_LEVELS" => "100000",
                    "MAX_USER_ENTRIES" => "100000",
                    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                    "PROPERTY_CODES" => array(
                        0 => "46",
                        1 => "47",
                        2 => "48",

                    ),
                    "PROPERTY_CODES_REQUIRED" => array(
                    ),
                    "RESIZE_IMAGES" => "N",
                    "SEF_FOLDER" => "/lkg/gos/budget/",
                    "SEF_MODE" => "Y",
                    "STATUS" => "ANY",
                    "STATUS_NEW" => "N",
                    "USER_MESSAGE_ADD" => "",
                    "USER_MESSAGE_EDIT" => "",
                    "USE_CAPTCHA" => "N",
                    "COMPONENT_TEMPLATE" => "budgets",
		            "ELEMENT_ASSOC_PROPERTY" => "48",
                    "ID" => 178
                ),
                false
            );?>

        </div>
        </div>
    </div>
</div>