<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */


if ($haveOffers) {
    $showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
    $showProductProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];
    $showPropsBlock = $showDisplayProps || $showProductProps;
    $showSkuBlock = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && !empty($item['OFFERS_PROP']);
} else {
    $showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
    $showProductProps = $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']);
    $showPropsBlock = $showDisplayProps || $showProductProps;
    $showSkuBlock = false;
}

//pr($item);
?>

<div class="card product-item">
    <div class="card-body">
        <div class="">
            <a href="<?= $item[DETAIL_PAGE_URL] ?>" id="<?=$itemIds['SECOND_PICT']?>">
                <img src="<?= $item[PREVIEW_PICTURE][SRC]; ?>" class="card-img-top img-fluid" >
            </a>
        </div>
        <span class="" id="<?=$itemIds['PICT_SLIDER']?>"></span>
    </div>

    <div class="card-body bg-light text-center">
        <div class="mb-2">
            <h6 class="font-weight-semibold mb-0">
                <a href="<?= $item[DETAIL_PAGE_URL] ?>" class="text-default"><?= $item["NAME"] ?></a>
            </h6>

            <span class="text-muted"><?= $item[DISPLAY_PROPERTIES]["COMPANY"][DISPLAY_VALUE] ?></span>
        </div>

        <h3 class="mb-0 font-weight-semibold" data-entity="price-block">
            <span id="<?=$itemIds['PRICE']?>"><?= $item[MIN_PRICE][PRINT_VALUE] ?></span>/<?= $item[DISPLAY_PROPERTIES]["UNIT"][DISPLAY_VALUE] ?></h3>

        <div class="text-muted mb-3"></div>

        <input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="hidden" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$measureRatio?>">

        <div class="product-item-info-container" data-entity="buttons-block">

            <div class="product-item-button-container" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
                <button class="btn bg-primary-400" id="<?= $itemIds['BUY_LINK'] ?>"
                        href="javascript:void(0)" rel="nofollow">
                    <i class="icon-cart-add mr-2"></i> Добавить в корзину
                </button>
            </div>

        </div>



    </div>
</div>
