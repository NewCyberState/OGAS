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
$arItem = $arResult["ITEMS"][0];
?>
<div class="table-responsive">
    <table class="table table-bordered framed">
        <thead>
        <tr>
            <th>ФИО</th>

            <? foreach ($arItem["DISPLAY_PROPERTIES"] as $PROPERTY): ?>
                <? if ($PROPERTY["NAME"]): ?>
                    <th><?= $PROPERTY["NAME"] ?></th>
                <? endif; ?>
            <? endforeach; ?>
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
                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $PROPERTY):?>
                    <? if ($PROPERTY["PROPERTY_TYPE"] == "S" && $PROPERTY[USER_TYPE] != "UserID" && $PROPERTY[USER_TYPE] != "Money"): ?>
                        <td><?= $PROPERTY[VALUE] ?></td>
                    <? elseif ($PROPERTY["PROPERTY_TYPE"] == "S" && $PROPERTY[USER_TYPE] == "UserID"): ?>
                        <td><? $rsUser = CUser::GetByID($PROPERTY[VALUE]);
                            $arUser = $rsUser->Fetch();
                            echo $arUser[NAME] . " " . $arUser[LAST_NAME] ?></td>
                    <? elseif ($PROPERTY["PROPERTY_TYPE"] == "S" && $PROPERTY[USER_TYPE] == "Money"): ?>
                        <td><?= CurrencyFormat($PROPERTY[VALUE],"RUB") ?></td>
                    <? elseif ($PROPERTY["PROPERTY_TYPE"] == "E"): ?>
                        <td><?= GetElement($PROPERTY[VALUE])["NAME"] ?></td>
                    <? elseif ($PROPERTY["PROPERTY_TYPE"] == "N"): ?>
                        <td><?= $PROPERTY[VALUE] ?></td>
                    <? endif; ?>
                <? endforeach; ?>

            </tr>

        <? endforeach; ?>

        </tbody>
    </table>
</div>
