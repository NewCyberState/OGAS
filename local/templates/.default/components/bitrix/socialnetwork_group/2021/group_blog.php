<?php

use Bitrix\Main\Loader;
use Bitrix\Blog\Copy\Integration\Group;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible p-0">
            <div class="card-body" style="">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <p>В данном разделе отображается процесс законотворчества в данной группе на различных этапах законодательного процесса. На странице отображаются добавленные участниками данной группы инициативы, обсуждения, законопроекты, референдумы, законы. Если вы хотите начать новый законодательный процесс, то создайте новую инициативу:
                    </p>
                <a href="/lkg/gos2/add/?group_id=<?=$arResult[VARIABLES][group_id]?>" class="btn btn-info"><i class="icon-copy  mr-2"></i>Создать инициативу</a>



            </div>
        </div>
    </div>
</div>


<?
$pageId = "group_blog";
include("util_group_menu.php");
//include("util_group_profile.php");
//pr($arResult[VARIABLES][group_id]);
    ?>

    <div class="card">
        <div class="card-body">



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