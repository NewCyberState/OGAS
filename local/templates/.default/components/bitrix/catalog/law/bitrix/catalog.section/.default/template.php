<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */

if (!empty($arResult['NAV_RESULT']))
{
    $navParams =  array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
}
else
{
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}
$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');


if (!empty($arResult['ITEMS'])) {
    ?>
        <h5 class="mb-3 font-weight-semibold"><?= $arResult["NAME"] ?></h5>
    <div class="row" data-entity="<?=$containerName?>">

        <?
        foreach ($arResult['ITEMS'] as $item) {
            $APPLICATION->IncludeComponent(
                'bitrix:catalog.item',
                '',
                array(
                    'RESULT' => array(
                        'ITEM' => $item,
                        'AREA_ID' => $areaIds[$item['ID']],
                        'TYPE' => "card",
                        'BIG_LABEL' => 'N',
                        'BIG_DISCOUNT_PERCENT' => 'N',
                        'BIG_BUTTONS' => 'N',
                        'SCALABLE' => 'N'
                    ),
                    'PARAMS' => $generalParams

                ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );

        }

        if ($showLazyLoad)
        {
            ?>
            <div class="row bx-<?=$arParams['TEMPLATE_THEME']?>">
                <div class="btn btn-default btn-lg center-block" style="margin: 15px;"
                     data-use="show-more-<?=$navParams['NavNum']?>">
                    <?=$arParams['MESS_BTN_LAZY_LOAD']?>
                </div>
            </div>
            <?
        }

        if ($showBottomPager)
        {
            ?>
            <div data-pagination-num="<?=$navParams['NavNum']?>">
                <!-- pagination-container -->
                <?=$arResult['NAV_STRING']?>
                <!-- pagination-container -->
            </div>
            <?
        }

        ?>
    </div>


<? } ?>
