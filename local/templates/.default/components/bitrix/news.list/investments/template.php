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

if($_REQUEST["curdate"]&$_REQUEST["plandate"])
    $period=intval(strtotime($_REQUEST["plandate"])-strtotime($_REQUEST["curdate"]));

?>
<h4>В таблице отображаются факторы производства, которые требует расширения производственных мощностей.</h4>

<div class="table-responsive">
<table class="table table-bordered framed">
    <thead>
    <tr>
        <th>Название</th>
        <th>Предприятие</th>
        <th>Тип</th>
        <th>Единица измерения</th>
        <th>Плановый выпуск</th>
        <th>Имеющиеся производственные мощности</th>
        <th>Дефицит мощностей</th>
        <th>Создать дополнительные мощности</th>
    </tr>
    </thead>
    <tbody>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?

    $product=GetElement($arItem["DISPLAY_PROPERTIES"][PRODUCT_ID][VALUE]);
    //pr($product);
    $productperiod=GetHLElement(PERIODS_HLID,$product["PROPERTIES"]["PERIOD"]["VALUE"])["UF_DESCRIPTION"];
    //pr($productperiod);

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if($productperiod>0 & $period>0 )
	if(intval($arItem["PROPERTIES"]["PLAN_QTY"]["VALUE"]) > intval($product["PROPERTIES"]["CAPACITY"][VALUE])*$period/$productperiod)
    {
        $deficit=intval($product["PROPERTIES"]["CAPACITY"][VALUE])*$period/$productperiod-intval($arItem["PROPERTIES"]["PLAN_QTY"]["VALUE"]);
	?>

        <tr data-id="<?=$arItem["ID"]?>">
            <?if($product["PROPERTIES"]["ENDPRODUCT"][VALUE]):?>
                <td><b><?echo $product["NAME"]?></b></td>
            <?else:?>
                <td><?echo $product["NAME"]?></td>
            <?endif;?>
            <td><?=GetElement($product["PROPERTIES"]["COMPANY"][VALUE])["NAME"]?></td>
            <td><?=GetHLElement(TYPES_HLID,$product["PROPERTIES"]["TYPE"][VALUE])["UF_NAME"]?></td>
            <td><?=GetHLElement(UNITS_HLID,$product["PROPERTIES"]["UNIT"][VALUE])["UF_NAME"]?></td>
            <td><?=$arItem["PROPERTIES"]["PLAN_QTY"]["VALUE"]?></td>
            <td><?=$product["PROPERTIES"]["CAPACITY"][VALUE]*$period/$productperiod;?></td>
            <td><?=abs($deficit);?></td>
            <td><?=$product["PROPERTIES"]["EXPANSION"][VALUE];?></td>

        </tr>

    <?
    }
	?>



<?endforeach;?>


    </tbody>
</table>
</div>

<button class="btn btn-primary btn-lg mt-2" type="submit" name="submit" value="Y"><i
            class="icon-price-tags mr-2"></i>Запланировать расширение производства
</button>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


