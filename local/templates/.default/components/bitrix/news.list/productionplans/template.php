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
        <th class="w-25">Фактор производства</th>
        <th>Дата</th>
        <th>Единица измерения</th>
        <th>Плановый объем</th>
        <th>Фактический объем</th>
        <th class="wmin-200">Статус</th>
    </tr>
    </thead>
    <tbody>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?

    $props=$arItem["PROPERTIES"];

    $product=GetElement($props["PRODUCT_ID"]["VALUE"]);

    $unit = GetHLElement(UNITS_HLID, $product["PROPERTIES"]["UNIT"]["VALUE"]);


	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

        <tr data-id="<?=$arItem["ID"]?>">
            <td ><?echo $product["NAME"];?></td>
            <td><?echo $props["DATE"]["VALUE"];?></td>
            <td><?echo $unit["UF_NAME"];?></td>
            <td><?=$props["PLAN_QTY"]["VALUE"];?></td>
            <td><input class="form-control quantity" size="5" type="text" value="<?=$props["FACT_QTY"]["VALUE"]?>"></td>
            <td>
                <span class="savebtn d-none"><i class="icon-spinner2 spinner mr-2"></i> Сохраняется...</span>
            </td>

        </tr>




<?endforeach;?>


    </tbody>
</table>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


<script>

    $("body").on('keyup', ".quantity", function (e) {
        var quantity = $(this).val();
        var id = $(this).parent().parent().data("id");

        var that = $(this);

        $(this).parent().next().find(".savebtn").removeClass("d-none");

        $.ajax({
            type: "POST",
            url: "/ajax/savefact.php",
            data: ({"id": id, "quantity": quantity}),
        }).done(function (d) {

            that.parent().next().find(".savebtn").addClass("d-none");

        });
    });

</script>