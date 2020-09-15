<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$messageperpage=12;

?>

<div class="d-flex flex-column flex-md-row">

    <?if($APPLICATION->GetCurDir()=="/lkg/gos/"):?>
    <?$messageperpage=3;?>
        <!-- Left sidebar component -->
    <?/*?>
    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left border-0 shadow-0 sidebar-expand-md">



        <!-- Sidebar content -->

        <div class="sidebar-content">



            <!-- Categories -->



            <div class="card <?if($APPLICATION->GetCurDir()=="/lkg/gos/"){echo "card-collapsed";}?>">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="card-title font-weight-semibold">Группы</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="nav nav-sidebar my-2">

                        <?
                        if (!CModule::IncludeModule("socialnetwork"))
                            echo "Не подключен модуль Социальная сеть";
                        global $USER;
                        $arRes = CSocNetGroup::GetList(array("NUMBER_OF_MEMBERS" => "DESC"), array("ACTIVE" => "Y", "VISIBLE" => "Y", "CHECK_PERMISSIONS" => $USER->GetID()));
                        while ($res = $arRes->Fetch()):?>
                        <?if(CSocNetGroup::CanUserReadGroup($USER->GetID(),$res[ID])):?>

                            <li class="nav-item">
                                <?
                                //pr($res);
                                ?>
                                <a href="?socnet_group_id=<?= $res[ID] ?>" class="nav-link">
                                    <?if($res["IMAGE_ID"]):?>
                                    <i class="mt-0 border">
                                        <img src="<?= CFILE::GetPath($res["IMAGE_ID"]) ?>" width="25px"></i>
                                    <?else:?>
                                    <i class="p-1 border icon-users"></i>
                                    <?endif;?>
                                    <?= $res["NAME"] ?> (<?= $res["NUMBER_OF_MEMBERS"] ?>)
                                    <span class="text-muted font-size-sm font-weight-normal ml-auto"></span>
                                </a>
                            </li>
                        <?endif;?>
                        <? endwhile; ?>
                        <li class="nav-item">
                            <a href="?socnet_group_id=" class="nav-link">
                                <i class="p-1 border icon-users"></i>
                                Все группы</a>
                        </li>

                    </div>
                </div>
            </div>

            <!-- /categories -->


        </div>

        <!-- /sidebar content -->

    </div>
    <!-- /left sidebar component -->
  <?*/?>
    <?endif;?>

    <!-- Right content -->
    <div class="flex-fill overflow-hidden">

        <div class="row">

            <?
            if($arParams["STATUS_ID"]==11) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/referendum/add/post_edit.php?id=#post_id#";
                $template="referendum";
            }
            elseif ($arParams["STATUS_ID"]==9) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/petition/#post_id#/";
                $template = "petition";
            }
            elseif ($arParams["STATUS_ID"]==10) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/discussion/#post_id#/";
                $template = "petition";
            }
            elseif ($arParams["STATUS_ID"]==12) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/referendum/#post_id#/";
                $template = "referendum";
            }
            elseif ($arParams["STATUS_ID"]==13) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/law/rejected/#post_id#/";
                $template = "referendum";
            }
            elseif ($arParams["STATUS_ID"]==14) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/law/approved/#post_id#/";
                $template = "referendum";
            }
            elseif ($arParams["STATUS_ID"]==15) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/law/execution/#post_id#/";
                $template = "referendum";
            }
            elseif ($arParams["STATUS_ID"]==16) {
                $arResult["PATH_TO_POST"] = "/lkg/gos/law/executed/#post_id#/";
                $template = "referendum";
            }

            else
                $template="petition";



            global $USER;

            if(empty($arParams["SOCNET_GROUP_ID"])) {
                $socnet_group_id=array();
                if (!CModule::IncludeModule("socialnetwork"))
                    echo "Не подключен модуль Социальная сеть";

                $arRes = CSocNetGroup::GetList(array("NUMBER_OF_MEMBERS" => "DESC"), array("ACTIVE" => "Y", "VISIBLE" => "Y", "CHECK_PERMISSIONS" => $USER->GetID()));
                while ($res = $arRes->Fetch()):
                    if (CSocNetGroup::CanUserReadGroup($USER->GetID(), $res[ID]))
                        $socnet_group_id[] = $res[ID];
                endwhile;
            }
            else
                $socnet_group_id=$arParams["SOCNET_GROUP_ID"];
            ?>

            <? $APPLICATION->IncludeComponent(
                "ogas:blog.new_posts.list",
                $template,
                array(
                    "BLOG_URL" => "",
                    "BLOG_VAR" => "",
                    "CACHE_TIME" => "86400",
                    "CACHE_TYPE" => "N",
                    "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
                    "GROUP_ID" => "1",
                    "IMAGE_MAX_HEIGHT" => "600",
                    "IMAGE_MAX_WIDTH" => "600",
                    "MESSAGE_PER_PAGE" => $messageperpage,
                    "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
                    "NAV_TEMPLATE" => "",
                    "PAGE_VAR" => "",
                    "PATH_TO_BLOG" => $arResult["PATH_TO_BLOG"],
                    "PATH_TO_BLOG_CATEGORY" => "",
                    "PATH_TO_GROUP_BLOG_POST" => "",
                    "PATH_TO_POST" => $arResult["PATH_TO_POST"],
                    "PATH_TO_SMILE" => "",
                    "PATH_TO_USER" => "/user/#user_id#/",
                    "POST_PROPERTY_LIST" => array("UF_STATUS","UF_STATUS_DATE","UF_BLOG_POST_VOTE","UF_BLOG_POST_FILE"),
                    "POST_VAR" => "post_id",
                    "RATING_TYPE" => "",
                    "SEO_USER" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_LOGIN" => "Y",
                    "SHOW_RATING" => "",
                    "USER_VAR" => "",
                    "COMPONENT_TEMPLATE" => $template,
                    "STATUS_ID" => $arParams["STATUS_ID"],
                    "SOCNET_GROUP_ID" => $socnet_group_id,
                    "CATEGORY_ID" => $arParams["CATEGORY_ID"],
                    "USER_ID" => $arParams["USER_ID"],
                ),
                false
            );?>
        </div>
    </div>
    <!-- /right content -->
</div>
