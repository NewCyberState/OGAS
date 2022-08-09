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
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                    <div class="mb-3">
                        <img
                                class="img-fluid"
                                border="0"
                                src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                                width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                                height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                                alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                        />
                    </div>
                <? endif ?>
                <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
                    <h1><?= $arResult["NAME"] ?></h1>
                <? endif; ?>

                <? //pr($arResult)?>

                <ul class="list-inline list-inline-dotted text-muted mb-3">

                    <li class="list-inline-item"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></li>

                    <li class="list-inline-item"><?= $arResult["CREATED_USER_NAME"] ?></li>
                </ul>


                <p>
                    <? echo $arResult["DETAIL_TEXT"]; ?>
                </p>


                <? if ($arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]["~VALUE"]["TEXT"]): ?>
                    <?= $arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]["~VALUE"]["TEXT"] ?>
                <? endif; ?>


            </div>
        </div>
    </div>
</div>