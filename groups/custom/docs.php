<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetTitle(str_replace("#PAGE_TITLE#","Документы",$arResult[PAGES_TITLE_TEMPLATE]));
$APPLICATION->AddChainItem($arResult[groupFields][NAME],str_replace("#group_id#",$arResult["VARIABLES"]["group_id"], $arResult[PATH_TO_GROUP]));
$APPLICATION->AddChainItem("Документы", "");
$APPLICATION->SetPageProperty("group_id",$arResult["VARIABLES"]["group_id"]);

?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:socialnetwork.group_menu",
    "",
    Array(
        "GROUP_VAR" => $arResult["ALIASES"]["group_id"],
        "PAGE_VAR" => $arResult["ALIASES"]["page"],
        "PATH_TO_GROUP" => $arResult["PATH_TO_GROUP"],
        "PATH_TO_GROUP_MODS" => $arResult["PATH_TO_GROUP_MODS"],
        "PATH_TO_GROUP_USERS" => $arResult["PATH_TO_GROUP_USERS"],
        "PATH_TO_GROUP_EDIT" => $arResult["PATH_TO_GROUP_EDIT"],
        "PATH_TO_GROUP_REQUEST_SEARCH" => $arResult["PATH_TO_GROUP_REQUEST_SEARCH"],
        "PATH_TO_GROUP_REQUESTS" => $arResult["PATH_TO_GROUP_REQUESTS"],
        "PATH_TO_GROUP_REQUESTS_OUT" => $arResult["PATH_TO_GROUP_REQUESTS_OUT"],
        "PATH_TO_GROUP_BAN" => $arResult["PATH_TO_GROUP_BAN"],
        "PATH_TO_GROUP_BLOG" => $arResult["PATH_TO_GROUP_BLOG"],
        "PATH_TO_GROUP_PHOTO" => $arResult["PATH_TO_GROUP_PHOTO"],
        "PATH_TO_GROUP_FORUM" => $arResult["PATH_TO_GROUP_FORUM"],
        "PATH_TO_GROUP_CALENDAR" => $arResult["PATH_TO_GROUP_CALENDAR"],
        "PATH_TO_GROUP_FILES" => $arResult["PATH_TO_GROUP_FILES"],
        "PATH_TO_GROUP_TASKS" => $arResult["PATH_TO_GROUP_TASKS"],
        "GROUP_ID" => $arResult["VARIABLES"]["group_id"],
        "PAGE_ID" => "group_docs",
    ),
    $component
);
?>
<div class="card">
    <div class="card-body">

        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible alert p-0">
            <div class="card-body" style="">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                В этом разделе вы можете загрузить документы группы. Документы будут доступны для всех участников группы.


            </div>
        </div>

        <?global $arrFilter;
        $arrFilter=array("PROPERTY_GROUP_ID"=>$arResult["VARIABLES"]["group_id"]);?>

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "docs",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
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
                "FIELD_CODE" => array("NAME", ""),
                "FILTER_NAME" => "arrFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "18",
                "IBLOCK_TYPE" => "ogas",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Документы",
                "PARENT_SECTION" => "0",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("GROUP_ID", "FILE"),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ID",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        );?>

    </div>
</div>

<div class="card">
    <div class="card-body">

        <?$APPLICATION->IncludeComponent(
            "bitrix:iblock.element.add.form",
            "docs",
            Array(
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
                "GROUPS" => array(1,8),
                "IBLOCK_ID" => "18",
                "IBLOCK_TYPE" => "ogas",
                "LEVEL_LAST" => "Y",
                "LIST_URL" => "",
                "MAX_FILE_SIZE" => "0",
                "MAX_LEVELS" => "100000",
                "MAX_USER_ENTRIES" => "100000",
                "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                "PROPERTY_CODES" => array("77", "78", "NAME"),
                "PROPERTY_CODES_REQUIRED" => array("77", "78", "NAME"),
                "RESIZE_IMAGES" => "N",
                "SEF_MODE" => "N",
                "STATUS" => "ANY",
                "STATUS_NEW" => "N",
                "USER_MESSAGE_ADD" => "Документ успешно добавлен",
                "USER_MESSAGE_EDIT" => "",
                "USE_CAPTCHA" => "N",
                "GROUP_ID" =>$arResult["VARIABLES"]["group_id"]
            )
        );?>

    </div>
</div>

