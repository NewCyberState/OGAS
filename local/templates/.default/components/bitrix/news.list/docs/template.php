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

if($arResult["ITEMS"]):
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));


    $rsFile = CFile::GetByID($arItem["PROPERTIES"]["FILE"]["VALUE"]);
    $arFile = $rsFile->Fetch();

    ?>
	<div class="mt-2 mb-2 font-size-lg" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=CFILE::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"])?>" target="_blank" download>
                    <i class="icon-file-text2  mr-2 icon-2x"></i>
                    <?=$arItem["NAME"]?> (<?=ToUpper(GetFileExtension(CFile::GetPath(
                        $arItem["PROPERTIES"]["FILE"]["VALUE"])))?>, <?=intval($arFile["FILE_SIZE"]/1024)?>кб)</a>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?else:
echo "<div class='font-size-lg text-muted mb-3'>Пока нет ни одного документа</div>";
endif;?>
