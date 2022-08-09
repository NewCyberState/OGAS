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
<div class="table-responsive">
<table class="table table-bordered framed">
    <thead>
    <tr>
        <th>Название</th>
        <th>Предприятие</th>
        <th>Тип</th>
        <th>Единица измерения</th>
        <th>Конечный продукт</th>
        <th>Цена, руб.</th>
    </tr>
    </thead>
    <tbody>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
    $arPrice = CCatalogProduct::GetOptimalPrice($arItem["ID"], 1, $USER->GetUserGroupArray());
    $printPrice=CurrencyFormat($arPrice[RESULT_PRICE][DISCOUNT_PRICE],$arPrice[RESULT_PRICE][CURRENCY]);

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

        <tr data-id="<?=$arItem["ID"]?>">
            <?if($arItem["DISPLAY_PROPERTIES"]["ENDPRODUCT"][DISPLAY_VALUE]):?>
                <td><b><?echo $arItem["NAME"]?></b></td>
            <?else:?>
                <td><?echo $arItem["NAME"]?></td>
            <?endif;?>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["COMPANY"][DISPLAY_VALUE]?></td>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["TYPE"][DISPLAY_VALUE]?></td>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["UNIT"][DISPLAY_VALUE]?></td>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["ENDPRODUCT"][DISPLAY_VALUE]?></td>
            <td><?=$printPrice?></td>

        </tr>




<?endforeach;?>


    </tbody>
</table>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


