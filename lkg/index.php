<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет гражданина");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");


global $USER;
if (!$USER->IsAuthorized()):
    if($_GET["back_url"])
        $success=$_GET["back_url"];
    else
        $success="/lkg/";

    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot-password/",
            "AUTH_REGISTER_URL" => "/auth/registration/",
            "AUTH_SUCCESS_URL" => $success
        )
    );
else:

    $userID = $USER->GetID(); //Ищем id тек. пользователя.
    $arUser = CUser::GetByID($userID)->Fetch(); //Получаем ID Фотографии по ID пользователя.
    $photoPath = CFile::GetPath($arUser['PERSONAL_PHOTO']);


    ?>

    <script>

        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    </script>


    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 order-2 order-md-1">

            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="text-center py-2 col-lg-12">

                                <h6 class="mb-1 text-muted">Общегосударственная Автоматизированная Система</h6>
                                <h2 class="font-weight-semibold mb-1 text-uppercase">Личный Кабинет Гражданина</h2>
                                <h6 class="mb-0 d-block">Добро пожаловать, <?
                                    global $USER;
                                    echo $USER->GetFirstName() ?>!</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



                            <?$APPLICATION->IncludeComponent(
                            "bitrix:socialnetwork.user_requests.ex",
                            "",
                            Array(
                            "PATH_TO_USER" => "/user/#user_id#/",
                            "PATH_TO_GROUP" => "/groups/group/#group_id#/",
                            "PAGE_VAR" => $arResult["ALIASES"]["page"],
                            "USER_VAR" => $arResult["ALIASES"]["user_id"],
                            "GROUP_VAR" => $arResult["ALIASES"]["group_id"],
                            "SET_NAV_CHAIN" => "N",
                            "SET_TITLE" => "N",
                            "USER_ID" => $userID,
                            "GROUP_ID" => "",
                            "NAME_TEMPLATE" => "",
                            "SHOW_LOGIN" => "N",
                            "USE_KEYWORDS" => "N",
                            "USE_AUTOSUBSCRIBE" => "Y",
                            ),
                            $component
                            );
                            ?>




            <div class="header-elements-inline">
                <h3>Популярное</h3>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/lkg/gos/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-library2 text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/lkg/gos/">
                                    <h6 class="media-title font-weight-semibold">Управление государством</h6>
                                </a>
                                Инициативы, обсуждения, референдумы, законы
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/lkg/gos/initiatives/add/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-copy icon-1x text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/lkg/gos/initiatives/add/">
                                    <h6 class="media-title font-weight-semibold">Новая инициатива</h6>
                                </a>
                                Создать новую инициативу
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/groups/create/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-new icon-1x text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/groups/create/">
                                    <h6 class="media-title font-weight-semibold">Новая группа</h6>
                                </a>
                                Создать новую группу
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/personal/groups/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-make-group  icon-1x text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/personal/groups/">
                                    <h6 class="media-title font-weight-semibold">Мои группы</h6>
                                </a>
                                Группы, в которых я участвую
                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/personal/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-pencil icon-1x text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/personal/">
                                    <h6 class="media-title font-weight-semibold">Мои данные</h6>
                                </a>
                                Редактировать личные данные
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="/personal/delegates/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                <i class="icon-collaboration icon-1x text-primary-400 border-primary-400 border-2 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <a href="/personal/delegates/">
                                    <h6 class="media-title font-weight-semibold">Мои делегаты</h6>
                                </a>
                                Назначить моих делегатов
                            </div>


                        </div>
                    </div>
                </div>


            </div>

            <div class="header-elements-inline">
                <h3>Новые группы</h3>
            </div>

            <div class="row justify-content-start">

                <?
                $arRes = CSocNetGroup::GetList(array("DATE_CREATE" => "DESC"), array("ACTIVE" => "Y","VISIBLE"=>"Y","OPENED"=>"Y","SUBJECT_ID"=>1));
                while ($res = $arRes->Fetch()):
                    if (!CSocNetUserToGroup::GetUserRole($userID, $res[ID])):?>
                        <div class="col-lg-4">
                            <div class="card card-body">
                                <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                                    <?if($res["IMAGE_ID"]):?>
                                    <a href="/groups/group/<?= $res["ID"] ?>/" class="text-teal mr-md-3 mb-3 mb-md-0">
                                        <img class="rounded-circle p-0" src="<?=CFILE::GetPath($res["IMAGE_ID"])?>" width="40px" height="auto">
                                    </a>
                                    <?endif;?>

                                    <div class="media-body text-center text-md-left">
                                        <a href="/groups/group/<?= $res["ID"] ?>/">
                                            <h6 class="media-title font-weight-semibold"><?= $res["NAME"]?></h6>
                                        </a>
                                        <?=$res["NUMBER_OF_MEMBERS"]." ".plural_form($res["NUMBER_OF_MEMBERS"],array("участник","участника","участников"))?>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <?
                        $i++;
                        if ($i == 9) break; ?>
                    <? endif; ?>
                <? endwhile; ?>



            </div>


            <div class="header-elements-inline">
                <h3>Новости</h3>
                <div class="header-elements"><a href="/news/">Все новости</a></div>
            </div>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:news",
                "news",
                array(
                    "ADD_ELEMENT_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "DETAIL_TEXT",
                        1 => "DETAIL_PICTURE",
                        2 => "DATE_ACTIVE_FROM",
                        3 => "SHOW_COUNTER",
                        4 => "CREATED_BY",
                        5 => "CREATED_USER_NAME",
                        6 => "",
                    ),
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "YOUTUBE",
                        1 => "FORUM_MESSAGE_CNT",
                        2 => "FORUM_TOPIC_ID",
                        3 => "",
                    ),
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FILE_404" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "19",
                    "IBLOCK_TYPE" => "ogas",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PREVIEW_PICTURE",
                        3 => "DATE_ACTIVE_FROM",
                        4 => "SHOW_COUNTER",
                        5 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "YOUTUBE",
                        1 => "FORUM_MESSAGE_CNT",
                        2 => "",
                    ),
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "round",
                    "PAGER_TITLE" => "Новости",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SEF_FOLDER" => "/news/",
                    "SEF_MODE" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "N",
                    "USE_PERMISSIONS" => "N",
                    "USE_RATING" => "N",
                    "USE_REVIEW" => "N",
                    "USE_RSS" => "N",
                    "USE_SEARCH" => "N",
                    "USE_SHARE" => "N",
                    "COMPONENT_TEMPLATE" => "news",
                    "SEF_URL_TEMPLATES" => array(
                        "news" => "",
                        "section" => "",
                        "detail" => "#ELEMENT_ID#/",
                    )
                ),
                false
            ); ?>

            <h3 class="">Возможности</h3>
            <div class="row justify-content-md-center">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-library2 icon-2x text-primary-400 border-primary-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title ">Управление государством</h4>
                            <p class="mb-3">Инициативы, обсуждения, референдумы, законы</p>
                            <a href="gos/" class="btn bg-primary-400">Управление государством</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-cart2 icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1 "></i>
                            <h4 class="card-title">Товары и услуги</h4>
                            <p class="mb-3 ">Выбор и заказ товаров и услуг, производимых предприятиями
                                страны</p>
                            <a href="goods/" class="btn bg-success-400">Товары и услуги</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-cogs  icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1 "></i>
                            <h4 class="card-title">Изобретения и инновации</h4>
                            <p class="mb-3 ">Потребности, идеи, исследования, разработки, испытания,
                                стандарты, производство</p>
                            <a href="innovations/" class="btn bg-warning-400">Изобретения и инновации (прототип)</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-credit-card2 icon-2x text-muted border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title  text-muted">Финансы и платежи</h4>
                            <p class="mb-3  text-muted">Счета, карты, заработная плата, премии, выплаты, пособия</p>
                            <a href="#" class="btn bg-danger bg-light disabled">Финансы и платежи</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="mi-work mi-2x text-teal-400 border-teal-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title">Работа и занятость (прототипы)</h4>
                            <p class="mb-3">Вакансии, резюме, собеседования, подработка, карьерная
                                консультация, профориентация</p>
                            <a href="/lkg/job/" class="btn bg-teal-400">Работа и занятость</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-design icon-2x text-purple-400 text-muted border-purple-400 border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Образование</h4>
                            <p class="mb-3 text-muted">Начальное, среднее, высшее, специальное, дополнительное
                                образование</p>
                            <a href="#" class="btn bg-purple-400 bg-light disabled">Образование</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="mi-local-hospital mi-2x text-green text-muted border-green border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Здоровье</h4>
                            <p class="mb-3 text-muted">Здоровый образ жизни, медицинские услуги, анализы, диагностика,
                                экстренная помощь</p>
                            <a href="#" class="btn bg-green bg-light disabled">Здоровье</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-home7 icon-2x text-slate-400 text-muted border-slate-400 border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title  text-muted">Недвижимость</h4>
                            <p class="mb-3 text-muted">Квартиры, дома, комнаты, гаражи, покупка, продажа, аренда</p>
                            <a href="#" class="btn bg-slate-400 bg-light disabled">Недвижимость</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-car icon-2x text-indigo-400 text-muted border-indigo-400 border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Транспорт</h4>
                            <p class="mb-3 text-muted">Автомобили, мотоциклы, мототехника, водный транспорт,
                                запчасти</p>
                            <a href="#" class="btn bg-indigo-400 bg-light disabled">Транспорт</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-movie icon-2x text-violet text-muted border-violet border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Культура, спорт и отдых</h4>
                            <p class="mb-3 text-muted">Кино, театры, концерты, матчи, мероприятия, туры, билеты</p>
                            <a href="#" class="btn bg-violet bg-light disabled">Культура, спорт и отдых</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="mi-child-friendly mi-2x text-pink text-muted border-pink-400 border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Семья и дети</h4>
                            <p class="mb-3 text-muted">Регистрация брака, регистрация рождения, усыновление</p>
                            <a href="#" class="btn bg-pink-400 bg-light disabled">Семья и дети</a>
                        </div>
                    </div>
                </div>

                <?/*?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="mi-person-pin mi-2x text-orange-400 border-orange-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title">Личные данные</h4>
                            <p class="mb-3">Персональные данные, документы, предпочтения, пожелания, интересы</p>
                            <a href="/personal/" class="btn bg-orange-400">Личные данные</a>
                        </div>
                    </div>
                </div>
                <?*/?>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="mi-help-outline mi-2x text-brown text-muted border-brown border-light border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h4 class="card-title text-muted">Персональный советник</h4>
                            <p class="mb-3 text-muted">Помощь в сложных жизненных ситуациях, 
                                консультации</p>
                            <a href="#" class="btn bg-brown bg-light disabled">Персональный советник</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User card -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="<?= $photoPath ?>" alt="" width="170"
                                 height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="<?= $photoPath ?>"
                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round"
                                   data-popup="lightbox">
                                    <i class="icon-plus3"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0"><?= $arUser["NAME"] . " " . $arUser["LAST_NAME"] ?></h6>

                        <?
                        if ($arUser["UF_SONET"]):?>
                            <div class="list-icons list-icons-extended mt-2 mb-2">
                                <?
                                foreach ($arUser["UF_SONET"] as $value):
                                if (strstr($value, "vk.com")):?>                            <a
                                        href="<?= $value ?>" target="_blank" class="list-icons-item" data-popup="tooltip"
                                        title="" data-container="body" data-original-title="VK"><i
                                            class="fab fa-vk mr-2 mt-0 fa-1x font-weight-normal"></i></a>
                                <? elseif (strstr($value, "facebook.com")): ?>
                                    <a href="<?= $value ?>" target="_blank" class="list-icons-item" data-popup="tooltip"
                                       title="" data-container="body" data-original-title="Facebook"><i
                                                class="fab fa-facebook mr-2 mt-0 fa-1x font-weight-normal"></i></a>
                                <? elseif (strstr($value, "twitter.com")): ?>
                                    <a href="<?= $value ?>" target="_blank" class="list-icons-item" data-popup="tooltip"
                                       title="" data-container="body" data-original-title="Twitter"><i
                                                class="fab fa-twitter mr-2 mt-0 fa-1x font-weight-normal"></i></a>
                                <? elseif ($value): ?>
                                    <a href="<?= $value ?>" target="_blank" class="list-icons-item" data-popup="tooltip"
                                       title="" data-container="body" data-original-title="WWW"><b
                                                class="fab fa-internet-explorer mr-0 mt-0 fa-1x font-weight-normal"></b></a>
                                <? endif;
                                endforeach;?>
                            </div>
                        <? endif; ?>

                        <?
                        if ($arUser[PERSONAL_NOTES]):?>
                            <p><?= $arUser[PERSONAL_NOTES] ?></p>
                        <? endif; ?>

                    </div>
                    <ul class="nav nav-sidebar border-top-1 border-top-dark-alpha">
                        <li class="nav-item  text-center">
                            <a href="/personal/" class="nav-link">
                                <i class="icon-pencil5"></i>
                                Редактировать
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /user card -->


                <!-- Navigation -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">Мои группы</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body p-0">
                    <ul class="nav nav-sidebar border-bottom-1 border-bottom-dark-alpha">
                        <?
                        $arRes = CSocNetGroup::GetList(array("NUMBER_OF_MEMBERS" => "DESC"), array("ACTIVE" => "Y"));
                        while ($res = $arRes->Fetch()):
                            if (CSocNetUserToGroup::GetUserRole($userID, $res[ID])&& CSocNetUserToGroup::GetUserRole($userID, $res[ID])<=SONET_ROLES_USER):?>
                                <li class="nav-item"><a class="nav-link"
                                            href="/groups/group/<?= $res["ID"] ?>/"><?= $res["NAME"] . " (" . $res["NUMBER_OF_MEMBERS"] . ")"; ?></a>
                                </li>
                            <? endif; ?>
                            <?
                            $i++;
                            //if ($i == 10) break; ?>
                        <? endwhile; ?>

                    </ul>
                    <ul class="nav nav-sidebar ">
                        <li class="nav-item  text-center">
                            <a href="/groups/my/" class="nav-link">
                                <i class="icon-people"></i>
                                 Мои группы
                            </a>
                        </li>
                        <li class="nav-item  text-center">
                            <a href="/groups/" class="nav-link">
                                <i class="icon-make-group"></i>Все группы
                            </a>
                        </li>
                        <li class="nav-item  text-center">
                            <a href="/groups/create/" class="nav-link">
                                <i class="icon-new"></i>Новая группа
                            </a>
                        </li>
                    </ul>
                    </div>

                    <!-- /navigation -->
                </div>



                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">Мои компетенции</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                <?
                if (!empty($arUser[UF_THEMATICS])):?>


                        <ul class="nav nav-sidebar border-bottom-1 border-bottom-dark-alpha">
                            <?
                            foreach ($arUser[UF_THEMATICS] as $item):
                                $thematic = GetSection($item); ?>
                                <li class="list-group-item pt-2 pb-2"><?= $thematic["NAME"] ?></li>
                            <? endforeach; ?>
                        </ul>
                        <ul class="nav nav-sidebar ">
                            <li class="nav-item  text-center">
                                <a href="/personal/" class="nav-link">
                                    <i class="icon-pencil5"></i>
                                    Редактировать
                                </a>
                            </li>
                        </ul>
                        <!-- /navigation -->
                <?else:?>
                <div class="card-body text-center" >
                    У вас пока не указано ни одной компетенции. Если вы хотите, чтобы другие граждане делегировали вам свой голос при голосовании на референдумах, то вам необходимо указать в профиле ваши компетенции и добавить свою биографию, чтобы убедить их делегировать вам свой голос.
                </div>
                    <ul class="nav nav-sidebar border-top-1 border-top-dark-alpha">
                        <li class="nav-item  text-center">
                            <a href="/personal/" class="nav-link">
                                <i class="icon-pencil5"></i>
                                Редактировать
                            </a>
                        </li>
                    </ul>
                <? endif; ?>
                </div>
            </div>
            <!-- /sidebar content -->

        </div>


    </div>

<?
endif;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>