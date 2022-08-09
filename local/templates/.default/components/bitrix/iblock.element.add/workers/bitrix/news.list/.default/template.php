<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$arItem = $arResult["ITEMS"][0];

global $USER;
if ($_REQUEST[CID])
    $CID = intval($_REQUEST[CID]);
if ($_REQUEST[PID])
    $PID = intval($_REQUEST[PID]);

$CurrentUserIsCreator=($USER->GetID()==GetElement($CID)["CREATED_BY"]);

?>
<table class="table table-bordered framed">
    <thead>
    <tr>
        <th>Название</th>

        <? foreach ($arItem["PROPERTIES"] as $PROPERTY): ?>
            <? if ($PROPERTY["NAME"]): ?>
                <th><?= $PROPERTY["NAME"] ?></th>
            <? endif; ?>
        <? endforeach; ?>

        <th>Действия</th>
    </tr>
    </thead>
    <tbody>

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $a=GetElement($arItem);

        if($CurrentUserIsCreator)
            $link=$arItem["ID"]."/edit/?CODE=".$arItem["ID"]."&edit=Y";
        else
            $link="";
        ?>

        <tr data-id="<?= $arItem["ID"] ?>">
            <td><b>
                    <?if($CurrentUserIsCreator):?>
                    <a href="<?= $link;?>"><? echo $arItem["NAME"] ?></a>
                    <?else:?>
                        <? echo $arItem["NAME"] ?>
                    <?endif;?>
                </b></td>
            <? foreach ($arItem["PROPERTIES"] as $PROPERTY): ?>
                <? if ($PROPERTY["PROPERTY_TYPE"] == "S" && $PROPERTY[USER_TYPE] != "UserID"): ?>
                    <td><?= $PROPERTY[VALUE] ?></td>
                <? elseif ($PROPERTY["PROPERTY_TYPE"] == "S" && $PROPERTY[USER_TYPE] == "UserID"): ?>
                    <td><? $rsUser = CUser::GetByID($PROPERTY[VALUE]);
                        $arUser = $rsUser->Fetch();
                        echo $arUser[NAME] . " " . $arUser[LAST_NAME] ?></td>
                <? elseif ($PROPERTY["PROPERTY_TYPE"] == "E"): ?>
                    <td><?= GetElement($PROPERTY[VALUE])["NAME"] ?></td>
                <? elseif ($PROPERTY["PROPERTY_TYPE"] == "N"): ?>
                    <td><?= $PROPERTY[VALUE] ?></td>
                <? endif; ?>
            <? endforeach; ?>
            <td>  <?if($CurrentUserIsCreator):?>
                <a href="<?= $arItem["ID"] ?>/edit/">
                    <button class="btn btn-icon mr-2"><i class="icon-pencil5"></i></button>
                </a>
                <button class="btn btn-icon deletebtn" data-id="<?= $arItem["ID"] ?>"><i class="icon-cross2"></i>
                </button>
                <?endif;?>
            </td>
        </tr>

    <? endforeach; ?>

    </tbody>
</table>

<?if($CurrentUserIsCreator):?>
<a class="btn btn-primary mt-2" href="?edit=Y&CODE=0"><i class="icon-plus2"></i> Добавить </a>
<?endif;?>

<script>

    $(".deletebtn").on('click', function (e) {
        var that = $(this);
        var id = that.data("id");

        $.ajax({
            type: "POST",
            url: "/ajax/deleteproduct.php",
            data: ({"id": id}),
        }).done(function (html) {
            that.parent().parent().remove();
        });
    });

</script>