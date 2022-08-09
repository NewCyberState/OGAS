<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>

    <?
    foreach ($arResult as $arItem):?>
        <? if ($arItem["LINK"]):?>
            <a href="<?= $arItem["LINK"] ?>" class="dropdown-item"><?= $arItem[PARAMS][icon] ?>
                <span><?= $arItem["TEXT"] ?></span></a>
        <? else:?>
            <div class="dropdown-divider"></div>
        <? endif; ?>
    <? endforeach ?>

<? endif; ?>