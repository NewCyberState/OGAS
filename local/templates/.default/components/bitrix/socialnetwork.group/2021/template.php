<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */

/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI;

UI\Extension::load("socialnetwork.common");

$APPLICATION->SetTitle($arResult['Group']['NAME']);

if (strlen($arResult["FatalError"]) > 0) {
    ?><span class='errortext'><?= $arResult["FatalError"] ?></span><br/><br/><?
} else {
    if (strlen($arResult["ErrorMessage"]) > 0) {
        ?><span class='errortext'><?= $arResult["ErrorMessage"] ?></span><br/><br/><?
    }

    ?>
    <script>


        BX.message({
            SGCSPathToGroupTag: '<?=CUtil::JSUrlEscape($arParams["PATH_TO_GROUP_TAG"])?>',
            SGCSPathToUserProfile: '<?=CUtil::JSUrlEscape($arParams["PATH_TO_USER"])?>',
            SGCSWaitTitle: '<?=GetMessageJS("SONET_C6_CARD_WAIT")?>'
        });
    </script><?

    $this->SetViewTarget("sonet-slider-pagetitle", 1000);
    $bodyClass = $APPLICATION->GetPageProperty("BodyClass");
    $APPLICATION->SetPageProperty("BodyClass", ($bodyClass ? $bodyClass . " " : "") . "pagetitle-menu-visible");
    //include("title_buttons.php");
    $this->EndViewTarget();


    //pr($arResult["CurrentUserPerms"])
    //pr($arResult)


    ?>


            <?/*
            if ($arResult["CurrentUserPerms"]["UserIsMember"]):?>


            <div class="card" style="">
                            <div class="card-body" >

                                <p>Вы можете вынести на рассмотрение участников группы любой вопрос, требущий принятия
                                    коллективного решения всеми участниками группы. Участники группы смогут обсудить данный
                                    вопрос, проголосовать за него на референдуме среди участников данной группы, после чего
                                    принятое решение будет утверждено в качестве закона и будет обязательно для исполнения всеми
                                    участниками группы. Создайте новую инциативу, чтобы запустить обсуждение:</p>


                                <a href="/lkg/gos/add/?group_id=<?= $arParams["GROUP_ID"] ?>" class="btn btn-info"><i
                                            class="icon-copy  mr-2"></i>Новая инициатива</a>



                            </div>
            </div>

            <?endif; ?>



<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/groups/initiatives.php",
        "EDIT_TEMPLATE" => "",
        "STATUS" => "1",
        "GROUP_ID" => $arParams["GROUP_ID"]
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
        "GROUP_ID" => $arParams["GROUP_ID"]

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
        "GROUP_ID" => $arParams["GROUP_ID"]

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
        "GROUP_ID" => $arParams["GROUP_ID"]

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
        "GROUP_ID" => $arParams["GROUP_ID"]

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
        "GROUP_ID" => $arParams["GROUP_ID"]

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
        "GROUP_ID" => $arParams["GROUP_ID"]

    ),
    false
);*/?>



<?/*
$APPLICATION->IncludeComponent(
    "bitrix:socialnetwork.log.ex",
    "",
    Array(
        "USER_VAR" => $arResult["ALIASES"]["user_id"],
        "GROUP_VAR" => $arResult["ALIASES"]["group_id"],
        "PAGE_VAR" => $arResult["ALIASES"]["page"],
        "GROUP_ID" => $arResult['Group']["ID"],
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
        "SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
        "SET_TITLE" => $arResult["SET_TITLE"],
        "PAGE_SIZE" => $arParams["ITEM_DETAIL_COUNT"],
        "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
        "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
        "DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
        "DATE_TIME_FORMAT_WITHOUT_YEAR" => $arResult["DATE_TIME_FORMAT_WITHOUT_YEAR"],
        "SHOW_YEAR" => $arParams["SHOW_YEAR"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
        "SUBSCRIBE_ONLY" => "N",
        "SHOW_EVENT_ID_FILTER" => "N",
        "SHOW_FOLLOW_FILTER" => "N",
        "CHECK_COMMENTS_PERMS" => "N",
        "BLOG_NO_URL_IN_COMMENTS" => $arParams["BLOG_NO_URL_IN_COMMENTS"],
        "BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["BLOG_NO_URL_IN_COMMENTS_AUTHORITY"],
    ),
    $this->getComponent()
);*/

/*
$APPLICATION->IncludeComponent("bitrix:main.file.input", "drag_n_drop",
   array(
      "INPUT_NAME"=>"TEST_NAME_INPUT",
      "MULTIPLE"=>"Y",
      "MODULE_ID"=>"main",
      "MAX_FILE_SIZE"=>"",
      "ALLOW_UPLOAD"=>"A",
      "ALLOW_UPLOAD_EXT"=>""
   ),
   false
);
*/
            ?>



        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">О группе</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block">

                            <h3><?=$arResult['Group']['NAME']?></h3>
                            <?
                            if ($arResult['Group'][IMAGE_ID_FILE][SRC]):?>
                                <img src="<?= $arResult['Group'][IMAGE_ID_FILE][SRC] ?>" class="img-fluid">
                            <?endif; ?>

                            <?

                            if ($arResult['Group']['DESCRIPTION'] != '') {
                                ?>
                                <div data-mrc id="collapseDesc" class="text-mute mt-3">
                                    <?=$arResult['Group']['DESCRIPTION']?>
                                </div>
                                <?
                                if (strlen($arResult['Group']['DESCRIPTION']) > 300):?>
                                <a class="collapsed" data-toggle="collapse" href="#collapseDesc"
                                   aria-expanded="false" aria-controls="collapseDesc"></a>
                                <?endif; ?>

                                <?
                            }

                            ?>

                            <?
                            if ($arResult["CurrentUserPerms"]["UserCanModifyGroup"]):?>
                                <a href="<?= $arResult[Urls][Edit] ?>">
                                    <button type="button" class="btn btn-outline-primary mt-3"><i
                                                class="icon-pencil4 mr-2"></i> Редактировать
                                    </button>
                                </a>
                            <?endif; ?>


                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Мой статус</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block">
                            <?
                            if ($_REQUEST["join"] == "Y"):?>
                                <div class="mt-0">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:socialnetwork.user_request_group",
                                        "",
                                        Array(
                                            "GROUP_ID" => intval($arParams["GROUP_ID"]),
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
                                    ); ?>
                                </div>
                            <? else:?>


                                <?
                                if ($arResult["CurrentUserPerms"]["UserIsMember"]):?>
                                    <h3 class="">Я участник группы</h3>
                                <?else:?>
                                    <h3 class="">Я не участник группы</h3>
                                <?endif; ?>
                                <?
                                if ($arResult["CurrentUserPerms"]["UserIsOwner"]):?>
                                    <h3 class="">Я владелец группы</h3>
                                <?endif; ?>

                                <?
                                if (!$arResult["CurrentUserPerms"]["UserIsMember"]):?>
                                    <button class="btn btn-primary ml-md-2 mt-2" onclick="request('<?= $arParams["GROUP_ID"] ?>');">
                                        <i class="icon-plus2 mr-2 "></i>Вступить в группу
                                    </button>
                                <? else:?>
                                    <?
                                    if (!$arResult["CurrentUserPerms"]["UserIsOwner"]):?>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:socialnetwork.user_leave_group",
                                            "",
                                            Array(
                                                "GROUP_ID" => $arParams["GROUP_ID"],
                                                "GROUP_VAR" => "",
                                                "PAGE_VAR" => "",
                                                "PATH_TO_GROUP" => "/personal/groups/group/#group_id#/",
                                                "PATH_TO_USER" => "/user/#user_id#/",
                                                "SET_NAV_CHAIN" => "N",
                                                "SET_TITLE" => "N",
                                                "USER_VAR" => ""
                                            )
                                        ); ?>
                                    <?endif; ?>
                                <?endif; ?>

                            <?endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Участники</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block">
                            <h3><?= intval($arResult["Group"]["NUMBER_OF_MEMBERS"])." ".plural_form(intval($arResult["Group"]["NUMBER_OF_MEMBERS"]),array("участник","участника","участников")) ?></h3>


                            <a href="<?= $arResult[Urls][GroupUsers] ?>">
                                <button type="button" class="btn btn-outline-primary mb-1"><i
                                            class="icon-people mr-2"></i> Все участники
                                </button>
                            </a>


                        </div>
                    </div>
                </div>


                <?
                if (true/*$arResult["Group"]["OPENED"] == "Y"*/):?>

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Пригласить в группу</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block">

                                    Скопируйте ссылку и перешлите ее тому, кого хотите пригласить в группу. Переход по ссылке добавит нового участника в группу

                                    <div class="form-group form-group-feedback form-group-feedback-right mb-0 mt-1">
                                        <input class="form-control"
                                               value="https://<?= SITE_SERVER_NAME . $APPLICATION->GetCurPage() . "?join=Y" ?>"
                                               id="clipboard"
                                               onfocus="document.getElementById('clipboard').select(); document.execCommand('copy');">
                                        <div class="form-control-feedback">
                                            <a href="javascript:;" class="text-default"
                                               onclick="document.getElementById('clipboard').select(); document.execCommand('copy');"><i
                                                        class="mi-content-copy" title="Скопировать в буфер обмена"></i></a>
                                        </div>
                                    </div>


                        </div>
                    </div>
                </div>
                <?endif; ?>


            </div>
        </div>



    <?
}
?>




<script>
    $(document).ready(function() {

        var example = $('[data-mrc]');

// Инициализация
        example.expandable({
            'height': 450,
            'animation_duration': 500,
            'more': 'Развернуть...',
            'less': 'Свернуть...',
            'no_less': false
        });

    });

</script>