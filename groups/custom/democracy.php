<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetTitle(str_replace("#PAGE_TITLE#","Демократия",$arResult[PAGES_TITLE_TEMPLATE]));
$APPLICATION->AddChainItem($arResult[groupFields][NAME],str_replace("#group_id#",$arResult["VARIABLES"]["group_id"], $arResult[PATH_TO_GROUP]));
$APPLICATION->AddChainItem("Демократия", "");

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
        "PAGE_ID" => "group_democracy",
    ),
    $component
);
?>

<div class="card">
    <div class="card-body">

        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible p-0">
            <div class="card-body" style="">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <p>Вы можете вынести на рассмотрение группы любой вопрос, требущий принятия коллективного решения всеми участниками группы. Участники группы смогут обсудить данный вопрос, проголосовать за него на референдуме среди участников данной группы, после чего принятое решение будет утверждено в качестве закона и будет обязательно для исполнения всеми участниками группы. Создайте новую инициативу, чтобы запустить обсуждение:
                </p>
                <a href="/lkg/gos/initiatives/add/?group_id=<?=$arResult[VARIABLES][group_id]?>" class="btn btn-info mb-0"><i class="icon-copy  mr-2"></i>Создать инициативу</a>



            </div>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/initiatives.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "1",
                "GROUP_ID" => $arResult[VARIABLES][group_id]
            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/initiatives.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "2",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "3",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "4",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "5",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "6",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "7",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/groups/laws.php",
                "EDIT_TEMPLATE" => "",
                "STATUS" => "8",
                "GROUP_ID" => $arResult[VARIABLES][group_id]

            ),
            false
        );?>
    </div>
</div>