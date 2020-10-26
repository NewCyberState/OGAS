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
    Asset::getInstance()->addCss("/local/global_assets/css/icons/fontawesome/styles.min.css");
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
    Asset::getInstance()->addJs("/local/assets/js/app.js");
    Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/login.js");
    ?>

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
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="/" class="d-inline-block">
            <img src="/local/img/ogaslogo3.png" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>



        </ul>
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
                        <a href="/personal/" class="dropdown-item"><i class="icon-cog5"></i> Мои данные</a>
                        <a href="/personal/groups/" class="dropdown-item"><i class="icon-make-group "></i> Мои группы</a>
                        <a href="/personal/delegates/" class="dropdown-item"><i class="icon-collaboration "></i> Мои делегаты</a>
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

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>

            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <?if ($USER->isAuthorized()):?>

                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="/personal/" class="text-white">

                                    <div style="background-image: url(<?= CFile::GetPath($arUser["PERSONAL_PHOTO"]); ?>);background-size: cover; height: 34px; width: 34px" class="rounded-circle"></div>
                                </a>


                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold mt-1">

                                    <span><?= trim($USER->GetFullName()); ?></span></div>

                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="/personal/" class="text-white"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif;?>

            <!-- Main navigation -->

            <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left2", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "360000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "left2"
	),
	false
); ?>

            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h1><? $APPLICATION->ShowTitle() ?></h1>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>


                </div>


            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-0">

                        <div class="card-body" style="">


