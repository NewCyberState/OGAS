<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); //Защита от подключения файла напрямую без подключения ядра
use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss()
global $USER;

$rsSites = CSite::GetByID(SITE_ID);
$arSite = $rsSites->Fetch();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta content="<?= $APPLICATION->ShowProperty("description"); ?>" property="og:description"/>
    <meta content="<?= $APPLICATION->ShowTitle(); ?>" property="og:title"/>
    <meta content="<?= "https://".$_SERVER['HTTP_HOST'].$APPLICATION->GetCurDir(); ?>" property="og:url"/>
    <meta content="<?= $arSite[NAME] ?>" property="og:site_name"/>
    <meta content="<?= "https://".$_SERVER['HTTP_HOST']."/local/img/about.png" ?>" property="og:image"/>
    <meta content="website" property="og:type"/>
    <? $APPLICATION->ShowHead(); ?>

    <!-- Global stylesheets -->
    <?
    Asset::getInstance()->addCss("https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900");
    Asset::getInstance()->addCss("/local/global_assets/css/icons/icomoon/styles.min.css");
    Asset::getInstance()->addCss("/local/global_assets/css/icons/material/styles.min.css");
    Asset::getInstance()->addCss("/local/assets/css/bootstrap.min.css");
    Asset::getInstance()->addCss("/local/assets/css/bootstrap_limitless.min.css");
    Asset::getInstance()->addCss("/local/assets/css/layout.min.css");
    Asset::getInstance()->addCss("/local/assets/css/components.min.css");
    Asset::getInstance()->addCss("/local/assets/css/colors.min.css");
    ?>
    <!-- /global stylesheets -->

    <!-- JS files -->
    <?
    Asset::getInstance()->addJs("/local/global_assets/js/main/jquery.min.js");
    Asset::getInstance()->addJs("/local/global_assets/js/main/bootstrap.bundle.min.js");
    Asset::getInstance()->addJs("/local/global_assets/js/plugins/loaders/blockui.min.js");
    Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/styling/uniform.min.js");
    if($APPLICATION->GetCurPage()!="/personal/wizard/")
        Asset::getInstance()->addJs("/local/assets/js/app.js");
    Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/login.js");
    Asset::getInstance()->addJs("/local/js/typed.js");
    ?>
    <!-- /JS files -->

 </head>

<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/includes/counters.php",
        "EDIT_TEMPLATE" => ""
    )
);?>
<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark <?if($APPLICATION->GetCurDir()=="/"):?>d-none<?endif;?>">
    <div class="navbar-brand">
        <a href="/" class="d-inline-block">
            <img src="/local/img/ogaslogo3.png" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <span class="ml-md-3 mr-md-auto"></span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                   data-toggle="dropdown">Кибергосударство</a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/concept/" class="dropdown-item">Концепция кибергосударства</a>
                    <a href="/lkg/gos/" class="dropdown-item">Управление кибергосударством</a>
                    <a href="/user/" class="dropdown-item">Граждане кибергосударства</a>
                    <a href="/sourcecode/" class="dropdown-item">Исходный код кибергосударства</a>
                </div>
            </li>

            <?
            global $USER;
            $rsUser = CUser::GetByID($USER->GetID());
            $arUser = $rsUser->Fetch();
            if ($USER->isAuthorized()):
                ?>
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                       data-toggle="dropdown">
                        <div style="background-image: url(<?= CFile::GetPath($arUser["PERSONAL_PHOTO"]); ?>);background-size: cover; height: 34px; width: 34px" class="rounded-circle mr-2"></div>
                        <span><?= trim($USER->GetFirstName()); ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/lkg/gos/" class="dropdown-item"><i class="icon-user "></i> Личный кабинет</a>
                        <a href="/personal/" class="dropdown-item"><i class="icon-cog5"></i> Мои данные</a>
                        <a href="/personal/groups/" class="dropdown-item"><i class="icon-make-group "></i> Мои группы</a>
                        <a href="/?logout=yes" class="dropdown-item"><i class="icon-switch2"></i> Выйти</a>
                    </div>
                </li>
            <?else:?>
                <li class="nav-item">
                    <a href="/auth/" class="navbar-nav-link d-flex align-items-center" >Войти</a>
                </li>
            <? endif; ?>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">


    <!-- Main content -->
    <div class="content-wrapper">
        <?if($APPLICATION->GetCurDir()=="/"):?>
        <video playsinline autoplay muted loop class="video-intro position-absolute embed-responsive" id="bgvideo" poster="/local/img/bgvideo.jpg">
            <source src="/local/video/bg5.mp4" type="video/mp4">
            <source src="/local/video/ogas.webm" type="video/webm">
        </video>
        <?endif;?>
        <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">
