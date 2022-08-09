<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Товары и услуги");

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/ecommerce_product_list.js");



?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"products", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/cart/",
		"BIG_DATA_RCM_TYPE" => "personal",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
			0 => "BUY",
		),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(
			0 => "POPUP",
			1 => "MAGNIFIER",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "ogas",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_SHOW_SLIDER" => "Y",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(
			0 => "retail",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SEARCH_USE_SEARCH_RESULT_ORDER" => "N",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/lkg/goods/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SKU_DESCRIPTION" => "N",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "16",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
		"TOP_SHOW_SLIDER" => "N",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_BIG_DATA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_STORE" => "N",
		"COMPONENT_TEMPLATE" => "products",
		"FILTER_NAME" => "arrFilter",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "COMPANY",
			1 => "TYPE",
			2 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "retail",
		),
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_ID#/",
			"element" => "#SECTION_ID#/#ELEMENT_ID#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		),
        "TOP_PROPERTY_CODE" => array(
            0=>"UNIT",
            )

	),
	false
);?>


<?/*?>

    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 overflow-auto order-2 order-md-1">

            <!-- Grid -->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /grid -->


            <!-- Pagination -->
            <div class="d-flex justify-content-center pt-3 mb-3">
                <ul class="pagination">
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-right"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-left"></i></a></li>
                </ul>
            </div>
            <!-- /pagination -->

        </div>
        <!-- /left content -->


        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Categories -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Категории</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <input type="search" class="form-control" placeholder="Поиск">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 font-size-base text-muted"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body border-0 p-0">
                        <ul class="nav nav-sidebar mb-2">
                            <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
                                <a href="#" class="nav-link">Наземный транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link active">Легковые автомобили</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Грузовые автомобили</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Автобусы</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link ">Мотоциклы</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Мопеды</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link">Водный транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link">Laces</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sandals</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Skate shoes</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Slip ons</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sneakers</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Winter shoes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link">Морской транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link">Beanies</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Belts</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Caps</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sunglasses</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Headphones</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Video cameras</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Wallets</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Watches</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /categories -->


                <!-- Filters -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Фильтр</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="search" class="form-control" placeholder="Поиск бренда">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4 font-size-base text-muted"></i>
                                    </div>
                                </div>

                                <div class="overflow-auto" style="max-height: 192px;">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" checked class="form-input-styled" data-fouc=""></span></div>
                                            АвтоВАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            ГАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            УАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            БЕЛАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            КАМАЗ
                                        </label>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="font-size-xs text-uppercase text-muted mb-3">Цвет</div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-primary rounded color-selector-active"><div class="py-1"></div>
                                                <i class="icon-checkmark3"></i>
                                            </a>
                                            <div class="font-size-sm text-center text-muted mt-1">Blue</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-warning rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Orange</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-teal rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Teal</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-pink rounded ">
                                                <div class="py-1"></div>
                                            </a>
                                            <div class="font-size-sm text-center text-muted mt-1">Pink</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-grey-800 rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Black</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-purple rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Purple</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-success rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Green</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-danger rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Red</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-info rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Cyan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="font-size-xs text-uppercase text-muted mb-3">Опции</div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Crew neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Chest pocket
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Raglan sleeves
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Polo neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        V-neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        High collar
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Hood
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Button strip
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Wide neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Kangaroo pocket
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn bg-blue btn-block">Фильтр</button>
                        </form>
                    </div>
                </div>
                <!-- /filters -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>

<?*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>