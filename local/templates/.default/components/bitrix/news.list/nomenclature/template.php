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
        <th>Тип</th>
        <th>Единица измерения</th>
        <th>Конечный продукт</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

        <tr data-id="<?=$arItem["ID"]?>">
            <?if($arItem["DISPLAY_PROPERTIES"]["ENDPRODUCT"][DISPLAY_VALUE]):?>
                <td><b><a href="<?=$arItem["ID"]?>/edit/"><?echo $arItem["NAME"]?></a></b></td>
            <?else:?>
                <td><a href="<?=$arItem["ID"]?>/edit/"><?echo $arItem["NAME"]?></a></td>
            <?endif;?>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["TYPE"][DISPLAY_VALUE]?></td>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["UNIT"][DISPLAY_VALUE]?></td>
            <td><?=$arItem["DISPLAY_PROPERTIES"]["ENDPRODUCT"][DISPLAY_VALUE]?></td>

            <td><a href="<?=$arItem["ID"]?>/edit/"><button class="btn btn-icon mr-2"><i class="icon-pencil5"></i> </button></a><button class="btn btn-icon deletebtn" data-id="<?=$arItem["ID"]?>"><i class="icon-cross2"></i></button></td>
        </tr>




<?endforeach;?>


    </tbody>
</table>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


<script>

    $(".deletebtn").on('click', function (e) {
        var that=$(this);
        var id=that.data("id");

        $.ajax({
            type: "POST",
            url: "/ajax/deleteproduct.php",
            data: ({"id": id}),
        }).done(function (html) {
            that.parent().parent().remove();
        });
    });

</script>