<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $arrFilter,$USER,$USER_SONET_GROUPS;

$USER_SONET_GROUPS=\Ogas\Democracy\LiquidVoting::GetUserGroups($USER->GetID());


if($_REQUEST["my"]=="Y") {
    $arrFilter = array("PROPERTY_STATUS" => 2, "CREATED_BY" => $USER->GetID(),"PROPERTY_GROUP_ID"=>$USER_SONET_GROUPS);

    $APPLICATION->SetTitle("Мои обсуждения");
}
else {
    $arrFilter = array("PROPERTY_STATUS" => 2,"PROPERTY_GROUP_ID"=>$USER_SONET_GROUPS);
    $APPLICATION->SetTitle("Все обсуждения");
}
?>

<?
    if($APPLICATION->GetCurPage()=="/lkg/gos/discussions/"):
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Обсуждения</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    В разделе "Обсуждения" отображаются петиции, получившие поддержку граждан и перешедшие на этап обсуждений. Вам необходимо ознакомиться с каждой петицией и добавить свои комментарии к ней. Петиция перейдет на следующий этап законодательного процесса спустя 1 неделю с момента перевода в статус "Обсуждение".
                </div>
            </div>
        </div>
    </div>

<?endif;?>



<?$APPLICATION->IncludeComponent(
    "bitrix:catalog",
    "initiative",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => "/personal/basket.php",
        "BIG_DATA_RCM_TYPE" => "personal",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
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
        "DETAIL_BLOG_EMAIL_NOTIFY" => "Y",
        "DETAIL_BLOG_URL" => "catalog_comments",
        "DETAIL_BLOG_USE" => "Y",
        "DETAIL_BRAND_USE" => "N",
        "DETAIL_BROWSER_TITLE" => "-",
        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "Y",
        "DETAIL_DETAIL_PICTURE_MODE" => array(
            0 => "POPUP",
            1 => "MAGNIFIER",
        ),
        "DETAIL_DISPLAY_NAME" => "Y",
        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "DETAIL_FB_USE" => "N",
        "DETAIL_IMAGE_RESOLUTION" => "16by9",
        "DETAIL_META_DESCRIPTION" => "-",
        "DETAIL_META_KEYWORDS" => "-",
        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
        "DETAIL_SET_CANONICAL_URL" => "Y",
        "DETAIL_SET_VIEWED_IN_COMPONENT" => "Y",
        "DETAIL_SHOW_POPULAR" => "N",
        "DETAIL_SHOW_SLIDER" => "N",
        "DETAIL_SHOW_VIEWED" => "N",
        "DETAIL_STRICT_SECTION_CHECK" => "Y",
        "DETAIL_USE_COMMENTS" => "Y",
        "DETAIL_USE_VOTE_RATING" => "N",
        "DETAIL_VK_USE" => "N",
        "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILE_404" => "",
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
        "IBLOCK_ID" => "13",
        "IBLOCK_TYPE" => "ogas",
        "INCLUDE_SUBSECTIONS" => "Y",
        "INSTANT_RELOAD" => "N",
        "LABEL_PROP" => array(
        ),
        "LAZY_LOAD" => "N",
        "LINE_ELEMENT_COUNT" => "30",
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
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
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
        "SEF_MODE" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "Y",
        "SHOW_404" => "Y",
        "SHOW_DEACTIVATED" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SKU_DESCRIPTION" => "N",
        "SHOW_TOP_ELEMENTS" => "Y",
        "SIDEBAR_DETAIL_SHOW" => "N",
        "SIDEBAR_PATH" => "",
        "SIDEBAR_SECTION_SHOW" => "Y",
        "TEMPLATE_THEME" => "blue",
        "TOP_ADD_TO_BASKET_ACTION" => "ADD",
        "TOP_ELEMENT_COUNT" => "9",
        "TOP_ELEMENT_SORT_FIELD" => "sort",
        "TOP_ELEMENT_SORT_FIELD2" => "id",
        "TOP_ELEMENT_SORT_ORDER" => "asc",
        "TOP_ELEMENT_SORT_ORDER2" => "desc",
        "TOP_ENLARGE_PRODUCT" => "STRICT",
        "TOP_LINE_ELEMENT_COUNT" => "3",
        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "TOP_SHOW_SLIDER" => "Y",
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
        "USE_MAIN_ELEMENT_SECTION" => "Y",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "USE_REVIEW" => "N",
        "USE_SALE_BESTSELLERS" => "Y",
        "USE_STORE" => "N",
        "COMPONENT_TEMPLATE" => "initiative",
        "LIST_PROPERTY_CODE_MOBILE" => array(
        ),
        "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(
        ),
        "DETAIL_VK_API_ID" => "API_ID",
        "DETAIL_FB_APP_ID" => "",
        "MESSAGES_PER_PAGE" => "10",
        "USE_CAPTCHA" => "N",
        "REVIEW_AJAX_POST" => "N",
        "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
        "FORUM_ID" => "5",
        "URL_TEMPLATES_READ" => "",
        "SHOW_LINK_TO_FORUM" => "Y",
        "FILTER_NAME" => "arrFilter",
        "FILTER_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PRICE_CODE" => array(
        ),
        "SEF_FOLDER" => "/lkg/gos/",
        "SEF_URL_TEMPLATES" => array(
            "sections" => "",
            "section" => "#SECTION_CODE#/",
            "element" => "#SECTION_CODE#/#ELEMENT_ID#/",
            "compare" => "compare.php?action=#ACTION_CODE#",
            "smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
        ),
        "VARIABLE_ALIASES" => array(
            "compare" => array(
                "ACTION_CODE" => "action",
            ),
        )
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>