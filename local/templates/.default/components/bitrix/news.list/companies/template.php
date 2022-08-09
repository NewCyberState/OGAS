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
?>

<div class="row">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col-lg-4">

            <a href="<?=$arItem["ID"]?>/">
            <div class="card">


                <img class="card-img-top img-fluid p-3" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                <div class="card-body">
                    <h5 class="card-title"><? echo $arItem["NAME"] ?></h5>
                    <p class="card-text"><?= $arItem["PREVIEW_TEXT"] ?></p>

                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                    <span class="text-muted"><?= $arItem["PROPERTIES"]["EMPLOYEES"]["VALUE"] ?> сотрудников</span>
                    <span>

                <? for ($i = 0; $i < $arItem["PROPERTIES"]["RATING"]["VALUE"]; $i++): ?>
                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                <? endfor; ?>
								</span>
                </div>


            </div>
            </a>

        </div>

    <? endforeach; ?>


</div>