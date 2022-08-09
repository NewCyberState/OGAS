<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Предприятие");

global $USER;

if(intval($_REQUEST["CID"])>0) {
        $company = GetElement(intval($_REQUEST["CID"]));
        if ($company["CREATED_BY"] == $USER->GetID())
            $CurrentUserIsCreator = true;

    if($CurrentUserIsCreator || $_REQUEST["CID"]==0)
        $_REQUEST["CODE"] = intval($_REQUEST["CID"]);
}
elseif(intval($_REQUEST["CID"])===0) {
    $CurrentUserIsCreator = true;
    $_REQUEST["CODE"]=0;
}

?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Профиль предприятия</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    Введите информацию о вашем предприятии.
                </div>
            </div>
        </div>
    </div>

<?if($CurrentUserIsCreator):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"company", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "1",
			1 => "8",
		),
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "ogas",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "/ipp/",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "100",
			1 => "101",
			2 => "102",
			3 => "103",
			4 => "NAME",
			5 => "PREVIEW_TEXT",
			6 => "PREVIEW_PICTURE",
			7 => "DETAIL_TEXT",
			8 => "DETAIL_PICTURE",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "101",
			1 => "102",
			2 => "103",
			3 => "NAME",
			4 => "PREVIEW_TEXT",
			5 => "PREVIEW_PICTURE",
		),
		"RESIZE_IMAGES" => "Y",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "company"
	),
	false
);?>
<?else:?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"company",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => $_REQUEST["CID"],
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "",
		),
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "ogas",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "EMPLOYEES",
			1 => "PLACE",
			2 => "OGRN",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "company"
	),
	false
);?>
<?endif;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>