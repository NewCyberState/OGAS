<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/assets/js/app.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_checkboxes_radios.js");

//CModule::IncludeModule("blog");
//pr($arResult);
$APPLICATION->SetPageProperty("og:image", "https://".$_SERVER['HTTP_HOST'].$arResult["PREVIEW_PICTURE"]["SRC"]);

$props = $arResult["PROPERTIES"];

$group = CSocNetGroup::GetByID($props["GROUP_ID"]["VALUE"]);
//pr($group);



$ar_group_members=\Ogas\Democracy\LiquidVoting::GetGroupMembers($props["GROUP_ID"]["VALUE"]);

if($props["MEMBERS"]["VALUE"]>0)
    $group_members=$props["MEMBERS"]["VALUE"];
else
    $group_members=$group[NUMBER_OF_MEMBERS];

foreach ($props["THEMATICS"]["VALUE"] as $value) {
    $v = GetSection($value);
    $t[] = $v["NAME"];
}

$thematics = implode("</li><li class='list-group-item'>", $t);
$thematics = "<ul class='list-group list-group-flush'><li class='list-group-item text-center'>" . $thematics . "</li></ul>";
$thematics_str = implode(" / ", $t);

$author = CUSER::GetByID($arResult[CREATED_BY]);
$author = $author->Fetch();

$status_id = $props["STATUS"]["VALUE"];

$arStatus = GetHLElement(4, $status_id);


$responsible = CUSER::GetByID($props[RESPONSIBLE][VALUE]);
$responsible = $responsible->Fetch();

$arInitiative = GetElement($props["INITIATIVE_ID"]["VALUE"]);

foreach ($arInitiative["PROPERTIES"]["THEMATICS"]["VALUE"] as $value) {
    $v = GetSection($value);
    $t[] = $v["NAME"];
}

$ithematics = implode("<br>", $t);
$ithematics_str = implode(" / ", $t);

$iauthor = CUSER::GetByID($arInitiative[CREATED_BY]);
$iauthor = $iauthor->Fetch();
?>

<div class="d-flex align-items-start flex-column flex-xl-row">

    <div class="w-100 order-2 order-md-1">

        <?
        if ($status_id == 3):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Добавить законопроект</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Вам необходимо разработать текст законопроекта, выносимого на референдум.
                                Текст законопроекта должен быть разработан на основании текста созданной вами исходной
                                инициативы с
                                учетом обсуждений данной инициативы, которые состоялись среди участников группы.
                                Внимательно изучите все комментарии к инициативе и постарайтесь учесть интересы всех
                                участников группы при подготовке законопроекта - это повысит шансы на то, что
                                законопроект будет принят.
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($status_id == 4): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Референдум</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                           Вам необходимо внимательно ознакомиться с текстом законопроекта и отдать свой голос за
                                один из предложенных вариантов. Если вы не разбираетесь в тематике данного законопроекта
                                или не до конца понимаете все последствия принятия данного решения, то воздержитесь от
                                голосования. Если вы не проголосуете сами, но при этом у вас есть назначеные вами
                                делегаты по тематике данного законопроекта, то ваш голос будет пропорционально разделен
                                на части и передан вашим делегатам. Ваш голос увеличит вес их голоса.
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($status_id == 5): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон принят</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Закон набрал необходимое количество голосов поддержки и был успешно принят. Ознакомьтесь
                                с текстом принятого закона. Закон обязателен к исполнению всеми участниками данной
                                группы.
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($status_id == 6): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон отклонен</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Данный законопроект не набрал необходимого количество голосов поддержки и был
                                отклонен.
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($status_id == 7): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон на исполнении</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Закон передан на исполнение лицу, назначенному ответственным за его исполнение.
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($status_id == 8): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон исполнен</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Закон одобрен на референдуме и исполнен ответственным лицом. Вы можете изучить отчет об исполнении закона и оценить качество
                                исполнения закона выбрав оценку в блоке "Оцените исполнение".
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>


        <?
        $bgcolor = "bg-success";
        $color = "text-white";
        if ($status_id == 6)
            $badge = "badge-secondary";
        elseif ($status_id == 4)
            $badge = "badge-danger";
        else
            $badge = "badge-success";
        ?>


        <div class="row">
            <div class="col-lg-12">

                <ul class="nav nav-tabs nav-tabs-highlight mb-0 border-bottom-0">

                    <? if ($status_id >= 5): ?>
                        <li class="nav-item">
                            <a href="#bordered-tab1" class="nav-link active" data-toggle="tab">Закон</a>
                        </li>
                        <li class="nav-item">
                                <a href="#bordered-tab2" class="nav-link " data-toggle="tab" id="resultpage">Результаты</a>
                        </li>
                    <? endif; ?>
                    <? if ($status_id == 4): ?>
                        <li class="nav-item">
                            <a href="#bordered-tab3" class="nav-link <? if ($status_id == 4): ?>active<? endif; ?>"
                               data-toggle="tab">Референдум</a>
                        </li>
                    <? endif; ?>
                    <? if ($status_id == 3): ?>
                        <li class="nav-item">
                            <a href="#bordered-tab4" class="nav-link <? if ($status_id == 3): ?>active<? endif; ?>"
                               data-toggle="tab">Законопроект</a>
                        </li>
                    <? endif; ?>
                    <li class="nav-item">
                        <a href="#bordered-tab5" class="nav-link" data-toggle="tab">Инициатива</a></li>
                </ul>

                <div class="tab-content order-top-0 rounded-top-0 mb-0">

                    <? if ($status_id >= 5): ?>
                        <div class="tab-pane fade <? if ($status_id >= 5): ?>show active<? endif; ?>"
                             id="bordered-tab1">
                            <div class="card">
                                <div class="card-header bg-light header-elements-lg-inline">
                                    <h4 class="card-title font-weight-semibold mb-0"><?= $arResult["NAME"] ?></h4>
                                    <div class="header-elements">
                                        <span class="badge <?= $badge; ?>"><?= $arStatus["UF_NAME"] ?></span>
                                    </div>
                                </div>



                                <?if($status_id == 7 && $props["RESPONSIBLE"][VALUE]==$USER->GetID()):?>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>Внимание <?=$responsible["NAME"]." ".$responsible["LAST_NAME"]?>!
                                        Вы назначены ответственным лицом за исполнение данного закона. Вам необходимо внимательно изучить принятый закон, исполнить его, после чего отчитаться об исполнении закона с помощью формы, размещенной ниже
                                    </div>

                                    <? $_REQUEST["CODE"] = $arResult["ID"]; ?>
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:iblock.element.add.form",
                                        "execution",
                                        array(
                                            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                                            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                                            "CUSTOM_TITLE_DETAIL_PICTURE" => "Изображение (формат JPG, PNG, не менее 1000x500 пикселей)",
                                            "CUSTOM_TITLE_DETAIL_TEXT" => "Отчет об исполнении закона",
                                            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                                            "CUSTOM_TITLE_NAME" => "Название законопроекта",
                                            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                                            "CUSTOM_TITLE_PREVIEW_TEXT" => "Текст законопроекта",
                                            "CUSTOM_TITLE_TAGS" => "",
                                            "DEFAULT_INPUT_SIZE" => "100",
                                            "DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
                                            "ELEMENT_ASSOC" => "PROPERTY_ID",
                                            "ELEMENT_ASSOC_PROPERTY" => "76",
                                            "GROUPS" => array(
                                                0 => "1",
                                                1 => "8",
                                            ),
                                            "IBLOCK_ID" => "8",
                                            "IBLOCK_TYPE" => "ogas",
                                            "LEVEL_LAST" => "Y",
                                            "LIST_URL" => "/lkg/gos/",
                                            "MAX_FILE_SIZE" => "10000000",
                                            "MAX_LEVELS" => "100000",
                                            "MAX_USER_ENTRIES" => "100000",
                                            "PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
                                            "PROPERTY_CODES" => array(
                                                0 => "DETAIL_TEXT",
                                                3 => "64",
                                                7 => "75",
                                                10 => "IBLOCK_SECTION",
                                            ),
                                            "PROPERTY_CODES_REQUIRED" => array(
                                                0 => "DETAIL_TEXT",
                                            ),
                                            "RESIZE_IMAGES" => "Y",
                                            "SEF_FOLDER" => "",
                                            "SEF_MODE" => "N",
                                            "STATUS" => "ANY",
                                            "STATUS_NEW" => "N",
                                            "USER_MESSAGE_ADD" => "",
                                            "USER_MESSAGE_EDIT" => "",
                                            "USE_CAPTCHA" => "N",
                                            "COMPONENT_TEMPLATE" => "execution"
                                        ),
                                        false
                                    ); ?>
                                </div>
                                    <div class="card-header header-elements-lg-inline bg-white">
                                        <h4 class="card-title font-weight-semibold mb-0">Текст закона</h4>

                                    </div>
                                <?endif;?>


                                <div class="card-body">
                                    <?= $arResult[PREVIEW_TEXT]; ?>
                                </div>




                                <? if ($props["FILES"]["VALUE"]): ?>
                                    <div class="card-body bg-white">
                                        <h5 class="text-primary">Файлы<i class="icon-files-empty  ml-1"></i></h5>
                                        <? foreach ($props["FILES"]["VALUE"] as $file):
                                            $arFile = CFile::GetFileArray($file);
                                            if ($arFile)
                                                echo "<p><a href='" . $arFile["SRC"] . "' target=_blank><i class='icon-file-text2 mr-3 icon-2x'></i> " . $arFile["ORIGINAL_NAME"] . "</a></p>";
                                        endforeach;
                                        ?>
                                    </div>
                                <? endif; ?>

                                <?if($status_id == 8 && $arResult["DETAIL_TEXT"]):?>
                                    <div class="card-footer bg-light header-elements-lg-inline border-bottom">
                                        <h4 class="card-title font-weight-semibold mb-0">Отчет об исполнении закона</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                        <?=html_entity_decode($arResult["DETAIL_TEXT"]);
                                        ?>
                                        </p>

                                    </div>
                                <div class="card-footer">
                                    <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">

                                        <li class="list-inline-item">

                                            <a href="/user/<?= $responsible[ID] ?>/"><i
                                                        class="icon-user "></i> <?= $responsible["NAME"]." ".$responsible["LAST_NAME"]?>
                                            </a>

                                        </li>
                                        <li class="list-inline-item"><?= $props["STATUS_DATE"]["VALUE"] ?></li>
                                    </ul>
                                </div>
                                <?endif;?>


                            </div>
                            <?php
                            $componentCommentsParams = array(
                                'ELEMENT_ID' => $arResult['ID'],
                                'ELEMENT_CODE' => '',
                                'IBLOCK_ID' => 8,
                                'SHOW_DEACTIVATED' => "N",
                                'URL_TO_COMMENT' => $arResult[DETAIL_PAGE_URL],
                                'WIDTH' => '',
                                'COMMENTS_COUNT' => '1000',
                                'BLOG_USE' => "Y",
                                'FB_USE' => "N",
                                'FB_APP_ID' => "N",
                                'VK_USE' => "N",
                                'VK_API_ID' => "N",
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                'BLOG_TITLE' => '',
                                'BLOG_URL' => "catalog_comments",
                                'PATH_TO_SMILE' => '',
                                'EMAIL_NOTIFY' => "Y",
                                'AJAX_POST' => 'Y',
                                'SHOW_SPAM' => 'Y',
                                'SHOW_RATING' => 'Y',
                                'FB_TITLE' => '',
                                'FB_USER_ADMIN_ID' => '',
                                'FB_COLORSCHEME' => 'light',
                                'FB_ORDER_BY' => 'reverse_time',
                                'VK_TITLE' => '',
                                'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
                            );

                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.comments',
                                '',
                                $componentCommentsParams,
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>

                        </div>
                        <div class="tab-pane fade" id="bordered-tab2">
                            <div class="card">
                                <div class="card-header header-elements-lg-inline">
                                    <h4 class="card-title font-weight-semibold mb-0">Результаты голосования</h4>
                                    <div class="header-elements">
                                        <span class="badge <?= $badge; ?>">Результаты</span>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:voting.result",
                                        "2021",
                                        array(
                                            "CHANNEL_SID" => "REFERENDUM",
                                            "VOTE_ID" => $props["VOTE_ID"]["VALUE"],
                                            "VOTE_ALL_RESULTS" => "Y",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "3600",
                                            "AJAX_MODE" => "Y",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "Y",
                                            "AJAX_OPTION_HISTORY" => "Y",
                                            "NEED_VOTES" => $arResult[POST_PROPERTIES][DATA][UF_NEED_VOTES][VALUE],
                                            "ELEMENT_ID" => $arResult[ID],
                                            "STATUS_ID" => $status_id,
                                            "STATUS_DATE" => $props["STATUS_DATE"]["VALUE"],
                                            "THEMATICS" => $props["THEMATICS"]["VALUE"],
                                            "TAGS" => $arResult[Category],

                                            "COMPONENT_TEMPLATE" => "2021"
                                        ),
                                        false
                                    ); ?>
                                </div>
                            </div>

                        </div>
                    <? endif; ?>
                    <? if ($status_id == 4): ?>
                        <div class="tab-pane fade <? if ($status_id == 4): ?>show active<? endif; ?>"
                             id="bordered-tab3">
                            <div class="card">
                                <div class="card-header header-elements-lg-inline bg-white d-flex justify-content-between">
                                    <h4 class="card-title font-weight-semibold mb-0"><?= $arResult["NAME"] ?></h4>
                                    <div class="header-elements">
                                        <span class="badge <?= $badge; ?>"><?=$arStatus["UF_NAME"]?></span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <?= $arResult["PREVIEW_TEXT"] ?>
                                </div>
                            </div>


                                    <? $APPLICATION->IncludeComponent("bitrix:voting.current", "2021", Array(
                                        "CHANNEL_SID" => "REFERENDUM",    // Группа опросов
                                        "VOTE_ID" => $props["VOTE_ID"]["VALUE"],    // ID опроса
                                        "VOTE_ALL_RESULTS" => "Y",    // Показывать варианты ответов для полей типа Text и Textarea
                                        "CACHE_TYPE" => "A",    // Тип кеширования
                                        "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                                        "AJAX_MODE" => "Y",    // Включить режим AJAX
                                        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                                        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                                        "AJAX_OPTION_HISTORY" => "Y",    // Включить эмуляцию навигации браузера
                                        "ELEMENT_ID" => $arResult[ID],
                                        "STATUS_ID" => $status_id,
                                        "STATUS_DATE" => $props["STATUS_DATE"]["VALUE"],
                                        "THEMATICS" => $props["THEMATICS"]["VALUE"],
                                        "TAGS" => $arResult[Category],

                                    ),
                                        false
                                    ); ?>

                            <? if ($status_id == 4): ?>

                                <?

                                //Выводим блок "Назначенные делегаты" в референдуме, если в указанных тематиках текущий пользователь выбрал своих делегатов

                                $alreadyDelegate = array();
                                $iamDelegate = array();

                                $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
                                $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

                                $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                                $entity_data_class = $entity->getDataClass();

                                foreach ($props["THEMATICS"]["VALUE"] as $THEMATIC) {
                                    $THEMATICS[] = $THEMATIC;
                                }


                                $data = array(
                                    "UF_THEMATICS" => $THEMATICS,
                                    "UF_USER" => $USER->GetID(),
                                    "UF_DELEGATE" => $ar_group_members
                                );
                                $result = $entity_data_class::getList(array(
                                    "select" => array("*"),
                                    "order" => array("ID" => "ASC"),
                                    "filter" => $data
                                ));

                                while ($arData = $result->Fetch()) {
                                    $myDelegates[] = $arData["UF_DELEGATE"];
                                    $myDelegatesThematics[] = $arData;
                                }

                                if ($myDelegates):
                                    ?>
                                    <div class="card card-group-control card-group-control-left">
                                        <div class="card-header header-elements-lg-inline header-elements-inline">
                                            <h5 class="card-title">
                                                <a data-toggle="collapse" class="text-default"
                                                   href="#collapsible-delegates1" aria-expanded="false">Назначенные
                                                    делегаты</a>
                                            </h5>
                                        </div>

                                        <div id="collapsible-delegates1" class="collapse show" style="">
                                            <div class="card-body">
                                                <div class="text-muted mb-2">Вы назначили этих граждан своими
                                                    делегатами. В случае, если вы сами не проголосуете на данном
                                                    референдуме, ваш голос перейдет к вашим делегатам, будет
                                                    пропорционально разделен между ними и они примут решение за вас.
                                                </div>
                                                <div class="row">

                                                    <? foreach ($myDelegatesThematics as $delegate) {


                                                            if ($delegate[UF_DELEGATE] == $USER->GetID()) continue;

                                                            $rsUser = CUser::GetByID($delegate[UF_DELEGATE]);
                                                            $arUser = $rsUser->Fetch();

                                                            $them = GetSection($delegate[UF_THEMATICS]);
                                                            ?>

                                                            <div class="col-md-12 col-xl-6">
                                                                <div class="card card-body">
                                                                    <div class="media align-items-center flex-column">
                                                                        <div class="text-center">
                                                                            <a data-popup="popover" data-trigger="hover"
                                                                               data-placement="top"
                                                                               data-content="<?= $arUser[PERSONAL_NOTES] ?>"
                                                                               href="/user/<?= $arUser[ID] ?>/">
                                                                                <img src="<?= CFile::GetPath($arUser["PERSONAL_PHOTO"]) ?>"
                                                                                     class="rounded-circle" alt=""
                                                                                     width="42"
                                                                                     height="42">
                                                                                <h6 class="mb-0"><?= $arUser[NAME] . " " . $arUser[LAST_NAME] ?></h6>
                                                                            </a>
                                                                            <span class="text-muted"><?= $them[NAME] ?></span>
                                                                        </div>

                                                                        <?
                                                                        if (in_array($arUser[ID], $myDelegates)): ?>
                                                                            <a href="javascript:"
                                                                               onclick="undelegate(<?= $USER->GetID() ?>,<?= $delegate[UF_DELEGATE] ?>,<?= $delegate[UF_THEMATICS] ?>,$(this))"
                                                                               class="btn bg-light mt-1">Освободить
                                                                                делегата</a>
                                                                        <? else: ?>
                                                                            <a href="javascript:"
                                                                               onclick="delegate(<?= $USER->GetID() ?>,<?= $delegate[UF_DELEGATE] ?>,<?= $delegate[UF_THEMATICS] ?>,$(this))"
                                                                               class="btn bg-primary mt-1">Назначить
                                                                                делегата</a>
                                                                        <? endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?
                                                        }

                                                    ?>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                <? endif; ?>


                                <?

                                //Выводим блок "Возможные делегаты" в референдуме, если в указанных тематиках есть делегаты, которых можно выбрать


                                $data = CUser::GetList(($by = "ID"), ($order = "ASC"),
                                    array(
                                        'UF_THEMATICS' => $THEMATICS,
                                        'ID' => implode("|",$ar_group_members),
                                        'ACTIVE' => 'Y',
                                    ),
                                    array("SELECT" => array("ID", "UF_*"))
                                );


                                if ($data->SelectedRowsCount() > 0):
                                    ?>
                                    <div class="card card-group-control card-group-control-left">
                                        <div class="card-header header-elements-lg-inline header-elements-inline">
                                            <h5 class="card-title">
                                                <a data-toggle="collapse" class="text-default collapsed"
                                                   href="#collapsible-delegates2" aria-expanded="false">Возможные
                                                    делегаты</a>
                                            </h5>

                                        </div>

                                        <div id="collapsible-delegates2" class="collapse" style="">
                                            <div class="card-body">

                                                <div class="text-muted mb-2">Вы можете назначить этих граждан своими
                                                    делегатами, т.к. они состоят в группе данного референдума и указали
                                                    в своем профиле, что они являются экспертами по тематикам
                                                    референдума.
                                                </div>
                                                <div class="row">

                                                    <?
                                                    while ($arUser = $data->Fetch()) {


                                                            if ($arUser[ID] == $USER->GetID() || in_array($arUser[ID], $myDelegates))
                                                                continue;


                                                            ?>

                                                            <div class="col-md-12 col-xl-6">
                                                                <div class="card card-body">
                                                                    <div class="media align-items-center flex-column">
                                                                        <div class="text-center">
                                                                            <a data-popup="popover" data-trigger="hover"
                                                                               data-placement="top"
                                                                               data-content="<?= $arUser[PERSONAL_NOTES] ?>"
                                                                               href="/user/<?= $arUser[ID] ?>/">
                                                                                <img src="<?= CFile::GetPath($arUser["PERSONAL_PHOTO"]) ?>"
                                                                                     class="rounded-circle" alt=""
                                                                                     width="42"
                                                                                     height="42">
                                                                                <h6 class="mb-0"><?= $arUser[NAME] . " " . $arUser[LAST_NAME] ?></h6>
                                                                            </a>

                                                                        </div>


                                                                        <a href="javascript:"
                                                                           onclick="delegateall(<?= $USER->GetID() ?>,<?= $arUser[ID] ?>,$(this))"
                                                                           class="btn bg-primary mt-1">Назначить
                                                                            делегата</a>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?
                                                        }
                                                    ?>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                <? endif; ?>

                            <? endif; ?>


                        </div>
                    <? endif; ?>
                    <? if ($status_id == 3): ?>
                        <div class="tab-pane fade <? if ($status_id == 3): ?>show active<? endif; ?>"
                             id="bordered-tab4">
                            <div class="card mb-0 border-bottom-0">
                                <div class="card-header header-elements-lg-inline">
                                    <h4 class="card-title font-weight-semibold mb-0">Добавить законопроект</h4>
                                    <div class="header-elements">
                                        <span class="badge <?= $badge; ?>">Законопроект</span>
                                    </div>
                                </div>
                            </div>

                            <? $_REQUEST["CODE"] = $arResult["ID"] ?>
                            <? $APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"draft", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "Изображение (формат JPG, PNG, не менее 1000x500 пикселей)",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Название законопроекта",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Текст законопроекта",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "100",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "1",
			1 => "8",
		),
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "ogas",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "/lkg/gos/",
		"MAX_FILE_SIZE" => "10000000",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
		"PROPERTY_CODES" => array(
			0 => "37",
			1 => "62",
			2 => "63",
			3 => "64",
			4 => "65",
			5 => "71",
			6 => "74",
			7 => "75",
			8 => "76",
			9 => "85",
			10 => "NAME",
			11 => "IBLOCK_SECTION",
			12 => "PREVIEW_TEXT",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "62",
			1 => "65",
			2 => "71",
			3 => "85",
			4 => "NAME",
			5 => "PREVIEW_TEXT",
		),
		"RESIZE_IMAGES" => "Y",
		"SEF_FOLDER" => "",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "draft"
	),
	false
); ?>


                        </div>
                    <? endif; ?>
                    <div class="tab-pane fade" id="bordered-tab5">

                        <div class="card">

                            <div class="card-header bg-white header-elements-lg-inline">
                                <h4 class="card-title font-weight-semibold mb-0">
                                    <?= $arInitiative["NAME"] ?></h4>
                                <div class="header-elements">
                                    <span class="badge badge-success">Инициатива</span>
                                </div>
                            </div>


                            <img src="<?= CFile::GetPath($arInitiative["DETAIL_PICTURE"]); ?>"
                                 class="img-fluid postimage">


                            <div class="card-header bg-white d-flex mb-0">
                                <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">

                                    <li class="list-inline-item">

                                        <a href="/user/<?= $iauthor[ID] ?>/"><i
                                                    class="icon-user "></i> <?= $iauthor["NAME"] . " " . $iauthor["LAST_NAME"] ?>
                                        </a>

                                    </li>
                                    <li class="list-inline-item"><?= $arInitiative[DATE_CREATE] ?></li>


                                    <li class="list-inline-item">
                                        <a href="#comments"><span
                                                    class="blog-post-link-caption"><i
                                                        class="icon-comment mr-1 icon-1x"></i></span>
                                            <span class="blog-post-link-counter"><?= IntVal($arInitiative["PROPERTIES"]["BLOG_COMMENTS_CNT"]["VALUE"]) ?></span></a>
                                    </li>

                                    <li class="list-inline-item"><a
                                                href="/groups/group/<?= $group[ID] ?>/"><?= $group["NAME"] ?></a></li>


                                    <?
                                    if ($ithematics_str) {
                                        ?>
                                        <li class="list-inline-item">
                                            <?= $ithematics_str ?>
                                        </li>
                                    <? } ?>


                                </ul>
                            </div>
                            <div class="card-body">

                                <div class="mb-0">
                                    <h5 class="text-warning"><i class="icon-question6 mr-2"></i>Проблема</h5>
                                    <?= $arInitiative["PREVIEW_TEXT"] ?>

                                    <? //pr($arResult)?>
                                </div>
                            </div>


                            <div class="card-body bg-white border-top">
                                <h5 class="text-success"><i class="icon-checkmark-circle2 mr-2"></i>Решение</h5>
                                <?= $arInitiative["DETAIL_TEXT"] ?>
                            </div>

                            <? if ($arInitiative["PROPERTIES"]["FILES"]["VALUE"]): ?>
                                <div class="card-body bg-white border-top">
                                    <h5 class="text-primary"><i class="icon-files-empty  mr-2"></i>Файлы</h5>
                                    <? foreach ($arInitiative["PROPERTIES"]["FILES"]["VALUE"] as $file):
                                        $arFile = CFile::GetFileArray($file);
                                        if ($arFile)
                                            echo "<p><a href='" . $arFile["SRC"] . "' target=_blank download><i class='icon-file-text2 mr-3 icon-2x'></i> " . $arFile["ORIGINAL_NAME"] . "</a></p>";
                                    endforeach;
                                    ?>
                                </div>
                            <? endif; ?>


                        </div>


                        <?php
                        $componentCommentsParams = array(
                            'ELEMENT_ID' => $arInitiative['ID'],
                            'ELEMENT_CODE' => '',
                            'IBLOCK_ID' => 13,
                            'SHOW_DEACTIVATED' => "N",
                            'URL_TO_COMMENT' => $arResult[DETAIL_PAGE_URL],
                            'WIDTH' => '',
                            'COMMENTS_COUNT' => '1000',
                            'BLOG_USE' => "Y",
                            'FB_USE' => "N",
                            'FB_APP_ID' => "N",
                            'VK_USE' => "N",
                            'VK_API_ID' => "N",
                            'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                            'CACHE_TIME' => $arParams['CACHE_TIME'],
                            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                            'BLOG_TITLE' => '',
                            'BLOG_URL' => "catalog_comments",
                            'PATH_TO_SMILE' => '',
                            'EMAIL_NOTIFY' => "Y",
                            'AJAX_POST' => 'N',
                            'SHOW_SPAM' => 'Y',
                            'SHOW_RATING' => 'N',
                            'FB_TITLE' => '',
                            'FB_USER_ADMIN_ID' => '',
                            'FB_COLORSCHEME' => 'light',
                            'FB_ORDER_BY' => 'reverse_time',
                            'VK_TITLE' => '',
                            'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
                        );

                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.comments',
                            'copy',
                            $componentCommentsParams,
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                        ?>
                    </div>

                </div>

            </div>
        </div>

    </div>


    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-lg">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Статус</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center text-center mb-2">
                        <h3 class="mb-0"><?= $arStatus["UF_NAME"] ?></h3>
                    </div>
                </div>
            </div>


        <?if($status_id==8):?>
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Оценить исполнение</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body text-center">
                        <p class="mb-2">
                            Изучите отчет об исполнении закона, составленный исполнителем и оцените качество исполнения данного закона.</p>

                        <div class="d-block w-100">

                            <?
                            $arVoteResult = CRatings::GetRatingVoteResult("IBLOCK_ELEMENT", $arResult["ID"]);
                            $APPLICATION->IncludeComponent(
                                "bitrix:iblock.vote", "bootstrap_v4",
                                Array(
                                    'IBLOCK_TYPE' => 'ogas',
                                    'IBLOCK_ID' => '8',
                                    'ELEMENT_ID' => $arResult["ID"],
                                    'CACHE_TYPE' => 'A',
                                    'CACHE_TIME' => '3600',
                                    'SHOW_RATING' => 'Y',
                                    'DISPLAY_AS_RATING' => 'vote_avg'
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            ); ?>
                        </div>

                </div>
            </div>
            <?endif;?>


            <? if ($status_id == 4) {
                $now = strtotime("now");
                $start = strtotime($props["STATUS_DATE"]["VALUE"]);
                $finish = $start + $props["VOTE_PERIOD"]["VALUE"] * 86400;
                $period = $finish - $now - 3 * 60 * 60;
                $enddate = getdate($period);

                ?>
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">До окончания голосования</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-center text-center mb-2">
                            <div class="timer-number font-weight-light">
                                <?= $enddate[yday] ?> <span
                                        class="d-block font-size-base mt-2"><?= plural_form($enddate[yday], array("день", "дня", "дней")) ?></span>
                            </div>
                            <div class="timer-dots mx-1">&nbsp;</div>
                            <div class="timer-number font-weight-light">
                                <?= $enddate[hours] ?> <span
                                        class="d-block font-size-base mt-2"><?= plural_form($enddate[hours], array("час", "часа", "часов")) ?></span>
                            </div>
                            <div class="timer-dots mx-1">:</div>
                            <div class="timer-number font-weight-light">
                                <?= $enddate[minutes] ?> <span
                                        class="d-block font-size-base mt-2"><?= plural_form($enddate[minutes], array("минута", "минуты", "минут")) ?></span>
                            </div>
                            <div class="timer-dots mx-1">:</div>
                            <div class="timer-number font-weight-light">
                                <?= $enddate[seconds] ?> <span
                                        class="d-block font-size-base mt-2"><?= plural_form($enddate[seconds], array("секунда", "секунды", "секунд")) ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Тип большинства</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-center text-center mb-0">
                            <h4 class="mb-0"> <?= $props["MAJORITY_TYPE"]["VALUE"]; ?>
                                <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?= $props["MAJORITY_TYPE"]["HINT"]; ?>' ></i>
                            </h4>
                        </div>
                    </div>
                </div>

            <? } ?>

            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Поделиться</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body text-center">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.share",
                        "universal",
                        Array(
                            "HANDLERS" => array( "vk","facebook","twitter", "gplus", "mailru","ya"),
                            "HIDE" => "N",
                            "PAGE_TITLE" => $arResult["NAME"],
                            "PAGE_URL" => $APPLICATION->GetCurPage(),
                            "SHORTEN_URL_KEY" => "",
                            "SHORTEN_URL_LOGIN" => ""
                        )
                    );?>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Тематики</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <?= $thematics; ?>
            </div>

            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Свойства</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span class="font-weight-semibold">ID:</span>
                        <div class="ml-auto  text-right"><?= $arResult["ID"] ?></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Создано:</span>
                        <div class="ml-auto  text-right"><?= $arResult[DATE_CREATE] ?></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Изменено:</span>
                        <div class="ml-auto  text-right"><?= $arResult[TIMESTAMP_X] ?></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Автор:</span>
                        <div class="ml-auto  text-right"><a
                                    href="/user/<?= $author[ID] ?>/"><?= $author["NAME"] . " " . $author["LAST_NAME"] ?></a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Группа:</span>
                        <div class="ml-auto  text-right"><a
                                    href="/groups/group/<?= $group[ID] ?>/"><?= $group["NAME"] ?></a></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Участников группы:</span>
                        <div class="ml-auto text-right pl-2">
                            <?= $group_members; ?>

                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">ID инициативы:</span>
                        <div class="ml-auto text-right pl-2">
                            <?= $props["INITIATIVE_ID"]["VALUE"]; ?>

                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Период голосования, дней:</span>
                        <div class="ml-auto text-right pl-2">
                            <?= $props["VOTE_PERIOD"]["VALUE"]; ?>

                        </div>
                    </li>


                </ul>
            </div>


        </div>
    </div>

</div>

