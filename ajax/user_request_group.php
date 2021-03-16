<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;

CModule::IncludeModule("socialnetwork");

return $APPLICATION->IncludeComponent(
    "bitrix:socialnetwork.user_request_group",
    "",
    Array(
        "GROUP_ID" => intval($_REQUEST["group_id"]),
        "GROUP_VAR" => "",
        "PAGE_VAR" => "",
        "PATH_TO_GROUP" => "/personal/groups/group/#group_id#/",
        "PATH_TO_GROUP_REQUESTS" => "",
        "PATH_TO_USER" => "/user/#user_id#/",
        "SET_NAV_CHAIN" => "N",
        "SET_TITLE" => "N",
        "USER_VAR" => "",
        "USE_AUTOSUBSCRIBE" => "Y"
    )
);

