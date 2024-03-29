<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Landing\Copy\Integration\Group as LandingGroup;
use Bitrix\Main\Loader;
use Bitrix\Blog\Copy\Integration\Group as BlogGroup;

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$component = $this->getComponent();

$pageId = "group";


?>


<?
include("util_group_menu.php");

if (Loader::includeModule("blog")) {
    $APPLICATION->includeComponent(
        "bitrix:socialnetwork.copy.checker",
        "",
        [
            "moduleId" => BlogGroup::MODULE_ID,
            "queueId" => $arResult["VARIABLES"]["group_id"],
            "stepperClassName" => BlogGroup::STEPPER_CLASS,
            "checkerOption" => BlogGroup::CHECKER_OPTION,
            "errorOption" => BlogGroup::ERROR_OPTION,
            "titleMessage" => GetMessage("BLG_STEPPER_PROGRESS_TITLE"),
            "errorMessage" => GetMessage("BLG_STEPPER_PROGRESS_ERROR"),
        ],
        $component,
        ["HIDE_ICONS" => "Y"]
    );
}

if (Loader::includeModule("landing")) {
    $APPLICATION->includeComponent(
        "bitrix:socialnetwork.copy.checker",
        "",
        [
            "moduleId" => LandingGroup::MODULE_ID,
            "queueId" => $arResult["VARIABLES"]["group_id"],
            "stepperClassName" => LandingGroup::STEPPER_CLASS,
            "checkerOption" => LandingGroup::CHECKER_OPTION,
            "errorOption" => LandingGroup::ERROR_OPTION,
            "titleMessage" => GetMessage("LANDING_STEPPER_PROGRESS_TITLE"),
            "errorMessage" => GetMessage("LANDING_STEPPER_PROGRESS_ERROR"),
        ],
        $component,
        ["HIDE_ICONS" => "Y"]
    );
}

?>
<div class="d-flex align-items-start flex-column flex-md-row">

    <!-- Left content -->
    <div class="w-100 overflow-auto order-2 order-md-1">


        <div class="card">
            <div class="card-body">

                <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible p-0">
                    <div class="card-body" style="">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        На странице группы вы можете обсудить любой вопрос с участниками группы, вступить или выйти из
                        группы, пригласить в группу других участников по ссылке. В разделе "Демократия" вы можете
                        ознакомиться с решениями, принятыми в группе с помощью механизмов делегативной демократии. В
                        разделе "Документы" размещены важные документы группы. В разделе "Участники" вы можете
                        ознакомиться со списком участников группы, а также назначить своих делегатов.
                    </div>
                </div>

                <?

                $APPLICATION->IncludeComponent(
                    "bitrix:socialnetwork.log.ex",
                    "2021",
                    Array(
                        "USER_VAR" => $arResult["ALIASES"]["user_id"],
                        "GROUP_VAR" => $arResult["ALIASES"]["group_id"],
                        "PAGE_VAR" => $arResult["ALIASES"]["page"],
                        "GROUP_ID" => $arResult["VARIABLES"]["group_id"],
                        "ENTITY_TYPE" => "G",
                        "PATH_TO_LOG_ENTRY" => $arParams["PATH_TO_USER_LOG_ENTRY"],
                        "PATH_TO_USER_BLOG_POST_EDIT" => $arParams["PATH_TO_USER_BLOG_POST_EDIT"],
                        "PATH_TO_USER" => $arParams["PATH_TO_USER"],
                        "PATH_TO_MESSAGES_CHAT" => $arResult["PATH_TO_MESSAGES_CHAT"],
                        "PATH_TO_VIDEO_CALL" => $arResult["PATH_TO_VIDEO_CALL"],
                        "PATH_TO_GROUP" => $arResult["PATH_TO_GROUP"],
                        "PATH_TO_SEARCH_TAG" => $arParams["PATH_TO_SEARCH_TAG"],
                        "USE_RSS" => "Y",
                        "PATH_TO_LOG_RSS" => $arResult["PATH_TO_GROUP_LOG_RSS"],
                        "PATH_TO_LOG_RSS_MASK" => $arResult["PATH_TO_GROUP_LOG_RSS_MASK"],
                        "SET_NAV_CHAIN" => "N",
                        "SET_TITLE" => "N",
                        "PAGE_SIZE" => 10,
                        "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                        "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                        "DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
                        "DATE_TIME_FORMAT_WITHOUT_YEAR" => $arResult["DATE_TIME_FORMAT_WITHOUT_YEAR"],
                        "SHOW_YEAR" => $arParams["SHOW_YEAR"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
                        "SUBSCRIBE_ONLY" => "N",
                        "SHOW_EVENT_ID_FILTER" => "Y",
                        "SHOW_FOLLOW_FILTER" => "Y",
                        "CHECK_COMMENTS_PERMS" => "N",
                        "BLOG_NO_URL_IN_COMMENTS" => $arParams["BLOG_NO_URL_IN_COMMENTS"],
                        "BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["BLOG_NO_URL_IN_COMMENTS_AUTHORITY"],
                    ),
                    $this->getComponent()
                ); ?>
            </div>
        </div>
    </div>
        <?

        $APPLICATION->IncludeComponent(
            "bitrix:socialnetwork.group",
            "2021",
            Array(
                "PATH_TO_USER" => $arParams["PATH_TO_USER"],
                "PATH_TO_GROUP" => $arResult["PATH_TO_GROUP"],
                "PATH_TO_GROUP_EDIT" => $arResult["PATH_TO_GROUP_EDIT"],
                "PATH_TO_GROUP_CREATE" => $arResult["PATH_TO_GROUP_CREATE"],
                "PATH_TO_GROUP_COPY" => $arResult["PATH_TO_GROUP_COPY"],
                "PATH_TO_GROUP_REQUEST_SEARCH" => $arResult["PATH_TO_GROUP_REQUEST_SEARCH"],
                "PATH_TO_USER_REQUEST_GROUP" => $arResult["PATH_TO_USER_REQUEST_GROUP"],
                "PATH_TO_GROUP_REQUESTS" => $arResult["PATH_TO_GROUP_REQUESTS"],
                "PATH_TO_GROUP_REQUESTS_OUT" => $arResult["PATH_TO_GROUP_REQUESTS_OUT"],
                "PATH_TO_GROUP_MODS" => $arResult["PATH_TO_GROUP_MODS"],
                "PATH_TO_GROUP_USERS" => $arResult["PATH_TO_GROUP_USERS"],
                "PATH_TO_USER_LEAVE_GROUP" => $arResult["PATH_TO_USER_LEAVE_GROUP"],
                "PATH_TO_GROUP_DELETE" => $arResult["PATH_TO_GROUP_DELETE"],
                "PATH_TO_GROUP_FEATURES" => $arResult["PATH_TO_GROUP_FEATURES"],
                "PATH_TO_GROUP_BAN" => $arResult["PATH_TO_GROUP_BAN"],
                "PATH_TO_SEARCH" => $arResult["PATH_TO_SEARCH"],
                "PATH_TO_SEARCH_TAG" => $arParams["PATH_TO_SEARCH_TAG"],
                "PAGE_VAR" => $arResult["ALIASES"]["page"],
                "USER_VAR" => $arResult["ALIASES"]["user_id"],
                "GROUP_VAR" => $arResult["ALIASES"]["group_id"],
                "SET_NAV_CHAIN" => "Y",
                "SET_TITLE" => $arResult["SET_TITLE"],
                "USER_ID" => $arResult["VARIABLES"]["user_id"],
                "GROUP_ID" => $arResult["VARIABLES"]["group_id"],
                "ITEMS_COUNT" => $arParams["ITEM_MAIN_COUNT"],
                "PATH_TO_GROUP_BLOG_POST" => $arResult["PATH_TO_GROUP_BLOG_POST"],
                "PATH_TO_GROUP_BLOG" => $arResult["PATH_TO_GROUP_BLOG"],
                "PATH_TO_BLOG" => $arResult["PATH_TO_GROUP_BLOG"],
                "PATH_TO_POST" => $arParams["PATH_TO_USER_BLOG_POST"],
                "PATH_TO_POST_EDIT" => $arParams["PATH_TO_USER_BLOG_POST_EDIT"],
                "PATH_TO_USER_BLOG_POST_IMPORTANT" => $arResult["PATH_TO_USER_BLOG_POST_IMPORTANT"],
                "PATH_TO_GROUP_FORUM" => $arResult["PATH_TO_GROUP_FORUM"],
                "PATH_TO_GROUP_FORUM_TOPIC" => $arResult["~PATH_TO_GROUP_FORUM_TOPIC"],
                "PATH_TO_GROUP_FORUM_MESSAGE" => $arResult["~PATH_TO_GROUP_FORUM_MESSAGE"],
                "FORUM_ID" => $arParams["FORUM_ID"],
                "PATH_TO_GROUP_SUBSCRIBE" => $arResult["PATH_TO_GROUP_SUBSCRIBE"],
                "PATH_TO_MESSAGE_TO_GROUP" => $arResult["PATH_TO_MESSAGE_TO_GROUP"],
                "BLOG_GROUP_ID" => $arParams["BLOG_GROUP_ID"],
                "TASK_VAR" => $arResult["ALIASES"]["task_id"],
                "TASK_ACTION_VAR" => $arResult["ALIASES"]["action"],
                "PATH_TO_GROUP_TASKS" => $arResult["PATH_TO_GROUP_TASKS"],
                "PATH_TO_GROUP_TASKS_TASK" => $arResult["PATH_TO_GROUP_TASKS_TASK"],
                "PATH_TO_GROUP_TASKS_VIEW" => $arResult["PATH_TO_GROUP_TASKS_VIEW"],
                "PATH_TO_GROUP_CONTENT_SEARCH" => $arResult["PATH_TO_GROUP_CONTENT_SEARCH"],
                "TASK_FORUM_ID" => $arParams["TASK_FORUM_ID"],
                "THUMBNAIL_LIST_SIZE" => 30,
                "PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
                "PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
                "DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
                "SHOW_YEAR" => $arParams["SHOW_YEAR"],
                "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                "CAN_OWNER_EDIT_DESKTOP" => $arParams["CAN_OWNER_EDIT_DESKTOP"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
                "SHOW_SEARCH_TAGS_CLOUD" => $arParams["SHOW_SEARCH_TAGS_CLOUD"],
                "SEARCH_TAGS_PAGE_ELEMENTS" => $arParams["SEARCH_TAGS_PAGE_ELEMENTS"],
                "SEARCH_TAGS_PERIOD" => $arParams["SEARCH_TAGS_PERIOD"],
                "SEARCH_TAGS_FONT_MAX" => $arParams["SEARCH_TAGS_FONT_MAX"],
                "SEARCH_TAGS_FONT_MIN" => $arParams["SEARCH_TAGS_FONT_MIN"],
                "SEARCH_TAGS_COLOR_NEW" => $arParams["SEARCH_TAGS_COLOR_NEW"],
                "SEARCH_TAGS_COLOR_OLD" => $arParams["SEARCH_TAGS_COLOR_OLD"],
                "PATH_TO_USER_LOG" => $arParams["~PATH_TO_USER_LOG"],
                "PATH_TO_GROUP_LOG" => $arResult["PATH_TO_GROUP_LOG"],
                "USE_MAIN_MENU" => $arParams["USE_MAIN_MENU"],
                "LOG_SUBSCRIBE_ONLY" => $arParams["LOG_SUBSCRIBE_ONLY"],
                "GROUP_PROPERTY" => $arResult["GROUP_PROPERTY"],
                "GROUP_USE_BAN" => $arParams["GROUP_USE_BAN"],
                "BLOG_ALLOW_POST_CODE" => $arParams["BLOG_ALLOW_POST_CODE"],
                "SHOW_RATING" => $arParams["SHOW_RATING"],
                "LOG_THUMBNAIL_SIZE" => $arParams["LOG_THUMBNAIL_SIZE"],
                "LOG_COMMENT_THUMBNAIL_SIZE" => $arParams["LOG_COMMENT_THUMBNAIL_SIZE"],
                "LOG_NEW_TEMPLATE" => $arParams["LOG_NEW_TEMPLATE"],
            ),
            $component
        );
        ?>

</div>
