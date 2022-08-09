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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	//pr($arItem);
	?>
    <div class="col-lg-4">
    <div class="card">
        <?if($arItem["PROPERTIES"]["YOUTUBE"]["VALUE"][TEXT]):?>
        <div class="embed-responsive embed-responsive-16by9 card-img-top">
            <?=$arItem["PROPERTIES"]["YOUTUBE"]["~VALUE"][TEXT];?>
        </div>
    <?endif;?>

        <?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
        <div class="card-img-actions">
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
            <img class="card-img-top img-fluid" src="<?echo $arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
            </a>
        </div>
        <?endif;?>

        <div class="card-body">
            <h5 class="card-title"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h5>
            <p class="card-text"><?echo $arItem["PREVIEW_TEXT"];?></p>
        </div>

        <div class="card-footer bg-light d-flex justify-content-between">
            <span class="text-muted"><?=FormatDateFromDB ($arItem["DATE_ACTIVE_FROM"],"SHORT")?></span>
            <span class="text-muted"><?=intval($arItem["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"])?> комментариев</span>
        </div>
    </div>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>