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

//CModule::IncludeModule("blog");
//pr($arResult);

$APPLICATION->SetPageProperty("og:image", "https://".$_SERVER['HTTP_HOST'].$arResult["PREVIEW_PICTURE"]["SRC"]);

$props = $arResult["PROPERTIES"];

$group = CSocNetGroup::GetByID($props["GROUP_ID"]["VALUE"]);
//pr($group);

foreach ($props["THEMATICS"]["VALUE"] as $value) {
    $v = GetSection($value);
    $t[] = $v["NAME"];
}

$thematics = implode("</li><li class='list-group-item'>", $t);
$thematics = "<ul class='list-group list-group-flush'><li class='list-group-item'>".$thematics."</li></ul>";
$thematics_str = implode("</li><li class=\"list-inline-item\">", $t);

$author = CUSER::GetByID($arResult[CREATED_BY]);
$author = $author->Fetch();

$status_id=$props["STATUS"]["VALUE"];

$arStatus = GetHLElement(4, $props["STATUS"]["VALUE"]);

$now = strtotime("now");
$start = strtotime($props["STATUS_DATE"]["VALUE"]);
$finish = $start+$props["DISCUSS_PERIOD"]["VALUE"]*86400;
$period=$finish-$now-3*60*60;
$enddate=getdate($period);
$enddate=getdate($period);
?>

<div class="d-flex align-items-start flex-column flex-xl-row">

    <div class="w-100 order-2 order-md-1">

        <?
        if ($props["STATUS"]["VALUE"] == 1):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-styled-left bg-white">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>

                            <h5 class="card-title">Инициатива</h5>

                            Вам необходимо ознакомиться с инициативой и если вы считаете данный вопрос важным  - нажмите на кнопку "Поддержать". Для того, чтобы инициатива перешла на следующий этап
                                законодательного процесса она должна набрать не менее 10% голосов поддержки от общего числа членов
                                группы, в которую она добавлена.



                    </div>
                </div>
            </div>

        <? endif; ?>

        <? if ($props["STATUS"]["VALUE"] == 2): ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Обсуждение</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Вам необходимо ознакомиться с инициативой и добавить свои комментарии к ней. Инициатива
                                перейдет на следующий этап законодательного процесса <?=date( "d.m.Y",$finish); ?>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>


        <?
        $bgcolor = "bg-success";
        $color = "text-white";
        $badge = "badge-light";
        ?>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header bg-white header-elements-lg-inline">
                        <h4 class="card-title font-weight-semibold mb-0">
                            <?= $arResult["NAME"] ?></h4>
                        <div class="header-elements">
                            <span class="badge bg-success "><?= $arStatus["UF_NAME"] ?></span>


                        </div>

                    </div>


                    <img src="<?= CFile::GetPath($arResult["DETAIL_PICTURE"]["ID"]); ?>" class="img-fluid postimage">


                    <div class="card-header bg-white d-flex mb-0">
                        <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">

                            <li class="list-inline-item">

                                <a href="/user/<?= $author[ID] ?>/"><i
                                            class="icon-user "></i> <?= $author["NAME"] . " " . $author["LAST_NAME"] ?>
                                </a>

                            </li>
                            <li class="list-inline-item"><?= $arResult[DATE_CREATE] ?></li>


                            <li class="list-inline-item">
                                <a href="#comments"><span
                                            class="blog-post-link-caption"><i
                                                class="icon-comment mr-1 icon-1x"></i></span>
                                    <span class="blog-post-link-counter"><?= IntVal($props["BLOG_COMMENTS_CNT"]["VALUE"]) ?></span></a>
                            </li>

                            <li class="list-inline-item"><a
                                        href="/groups/group/<?= $group[ID] ?>/"><?= $group["NAME"] ?></a></li>


                            <?
                            if ($thematics_str) {
                                ?>
                                <li class="list-inline-item">
                                    <?= $thematics_str ?>
                                </li>
                            <? } ?>


                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="mb-0">
                            <h5 class="text-warning"><i class="icon-question6 mr-2"></i>Проблема</h5>
                            <?= $arResult["PREVIEW_TEXT"] ?>

                            <? //pr($arResult)?>
                        </div>
                    </div>


                    <div class="card-body bg-white border-top">
                        <h5 class="text-success"><i class="icon-checkmark-circle2 mr-2"></i>Решение</h5>
                        <?= $arResult["DETAIL_TEXT"] ?>
                    </div>

                    <?if($props["FILES"]["VALUE"]):?>
                    <div class="card-body bg-white border-top">
                        <h5 class="text-primary"><i class="icon-files-empty  mr-2"></i>Файлы</h5>
                        <?foreach($props["FILES"]["VALUE"] as $file):
                            $arFile = CFile::GetFileArray($file);
                            if($arFile)
                                echo "<p><a href='".$arFile["SRC"]."' target=_blank download><i class='icon-file-text2 mr-3 icon-2x'></i> ".$arFile["ORIGINAL_NAME"]."</a></p>";
                        endforeach;
                        ?>
                    </div>
                    <?endif;?>


                    <?if($USER->GetID()==$author["ID"]):?>
                    <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                        <ul class="list-inline list-inline-dotted text-muted mb-1">

                                <li class="list-inline-item">
                                    <a href="/lkg/gos/initiatives/add/?CODE=<?=$arResult[ID]?>"><span
                                                class="blog-post-link-caption">Редактировать</span></a>
                                </li>


                        </ul>

                    </div>
                    <?endif;?>

                </div>


                <? if ($USER->IsAUthorized()):?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                                <div class="card-header header-elements-inline">
                                    <h5 class="card-title">Обсуждение инициативы</h5>
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                </div>

                                <div class="card-body" style="">
                                    <p>При обсуждении инициативы придерживайтесь пожалуйста принципов <a href="https://drive.google.com/file/d/1NvFxdtiqIAkQknImq5niNyxUkdfcpmwJ/view" download target="_blank">"Социократии"</a> и метода "Консента". </p>
                                    <p class="p-0">Если вы хотите высказать возражение, то вы должны привести разумную и понятную причину, почему предлагаемое решение нанесет вред группе. Никто не может заблокировать решение просто потому, что оно ему не нравится, кажется неудобным или у него есть другое мнение. Каждое возражение необходимо разбирать в отдельной ветке обсуждений до тех пор, пока оно не будет снято, либо не будет подтверждено, что возражение является важным и его необходимо учесть при подготовке законопроекта.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                $componentCommentsParams = array(
                    'ELEMENT_ID' => $arResult['ID'],
                    'ELEMENT_CODE' => '',
                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                    'SHOW_DEACTIVATED' => "N",
                    'URL_TO_COMMENT' => $arResult[DETAIL_PAGE_URL],
                    'WIDTH' => '',
                    'COMMENTS_COUNT' => '1000',
                    'BLOG_USE' => $arParams['BLOG_USE'],
                    'FB_USE' => $arParams['FB_USE'],
                    'FB_APP_ID' => $arParams['FB_APP_ID'],
                    'VK_USE' => $arParams['VK_USE'],
                    'VK_API_ID' => $arParams['VK_API_ID'],
                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                    'CACHE_GROUPS' => 'Y',
                    'BLOG_TITLE' => '',
                    'BLOG_URL' => $arParams['BLOG_URL'],
                    'PATH_TO_SMILE' => '',
                    'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
                    'AJAX_POST' => 'N',
                    'BLOG_FROM_AJAX' => 'N',
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
                <?else:?>
                    <a href="/auth/?back_url=<?=$APPLICATION->GetCurPage()?>">Войдите, чтобы увидеть комментарии</a>
                <?endif;?>


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

            <?if($status_id==2):?>
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">До окончания обсуждения</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center text-center mb-2">
                        <div class="timer-number font-weight-light">
                            <?=$enddate[yday]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[yday],array("день","дня","дней"))?></span>
                        </div>
                        <div class="timer-dots mx-1">&nbsp;</div>
                        <div class="timer-number font-weight-light">
                            <?=$enddate[hours]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[hours],array("час","часа","часов"))?></span>
                        </div>
                        <div class="timer-dots mx-1">:</div>
                        <div class="timer-number font-weight-light">
                            <?=$enddate[minutes]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[minutes],array("минута","минуты","минут"))?></span>
                        </div>
                        <div class="timer-dots mx-1">:</div>
                        <div class="timer-number font-weight-light">
                            <?=$enddate[seconds]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[seconds],array("секунда","секунды","секунд"))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?endif;?>

            <?if($status_id==1):?>
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Поддержать</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="justify-content-center text-center mb-0">
                        <div class="mb-2">
                        <?
                        $arVoteResult = CRatings::GetRatingVoteResult("IBLOCK_ELEMENT", $arResult["ID"]);
                        $APPLICATION->IncludeComponent(
                            "bitrix:rating.vote", "like_graphic",
                            Array(
                                "ENTITY_TYPE_ID" => "IBLOCK_ELEMENT",
                                "ENTITY_ID" => $arResult["ID"],
                                "OWNER_ID" => $USER->GetID(),
                                "USER_VOTE" => $arVoteResult[USER_VOTE],
                                "USER_HAS_VOTED" => $arVoteResult[USER_HAS_VOTED],
                                "TOTAL_VOTES" => $arVoteResult[TOTAL_VOTES],
                                "TOTAL_POSITIVE_VOTES" => $arVoteResult[TOTAL_POSITIVE_VOTES],
                                "TOTAL_NEGATIVE_VOTES" => $arVoteResult[TOTAL_NEGATIVE_VOTES],
                                "TOTAL_VALUE" => $arVoteResult[TOTAL_VALUE],
                                "PATH_TO_USER_PROFILE" => "/user/#USER_ID#/",
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        ); ?>
                        </div>
                        <div class="mb-0">Для перехода инициативы на следующий этап необходимо набрать <?=ceil($group["NUMBER_OF_MEMBERS"]*0.1)?> голосов поддержки</div>
                    </div>
                </div>
            </div>
            <?endif;?>

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
                        "HANDLERS" => array("twitter", "vk", "gplus", "facebook"),
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
                        <div class="ml-auto pl-2 text-right"><?= $arResult[DATE_CREATE] ?></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Изменено:</span>
                        <div class="ml-auto  text-right"><?= $arResult[TIMESTAMP_X] ?></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Автор:</span>
                        <div class="ml-auto pl-2 text-right"><a
                                    href="/user/<?= $author[ID] ?>/"><?= $author["NAME"] . " " . $author["LAST_NAME"] ?></a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Группа:</span>
                        <div class="ml-auto pl-2 text-right"><a
                                    href="/groups/group/<?= $group[ID] ?>/"><?= $group["NAME"] ?></a></div>
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-semibold">Участников группы:</span>
                        <div class="ml-auto pl-2 text-right"><?= $group["NUMBER_OF_MEMBERS"]?></div>
                    </li>


                    <li class="list-group-item">
                        <span class="font-weight-semibold">Период обсуждения, дней:</span>
                        <div class="ml-auto text-right pl-2">
                            <?= $props["DISCUSS_PERIOD"]["VALUE"]; ?>

                        </div>
                    </li>


                </ul>
            </div>

        </div>
    </div>

</div>

