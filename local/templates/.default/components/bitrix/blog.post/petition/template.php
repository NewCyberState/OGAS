<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Page\Asset;

global $USER;

$APPLICATION->AddChainItem($arResult["Post"]["TITLE"]);

?>
<? CUtil::InitJSCore(array("image")); ?>
<?
if (strlen($arResult["MESSAGE"]) > 0) {
    ?>
    <div class="blog-textinfo blog-note-box">
        <div class="blog-textinfo-text">
            <?= $arResult["MESSAGE"] ?>
        </div>
    </div>
    <?
}
if (strlen($arResult["ERROR_MESSAGE"]) > 0) {
    ?>
    <div class="blog-errors blog-note-box blog-note-error">
        <div class="blog-error-text">
            <?= $arResult["ERROR_MESSAGE"] ?>
        </div>
    </div>
    <?
}
if (strlen($arResult["FATAL_MESSAGE"]) > 0) {
    ?>
    <div class="blog-errors blog-note-box blog-note-error">
        <div class="blog-error-text">
            <?= $arResult["FATAL_MESSAGE"] ?>
        </div>
    </div>
    <?
} elseif (strlen($arResult["NOTE_MESSAGE"]) > 0) {
    ?>
    <div class="blog-textinfo blog-note-box">
        <div class="blog-textinfo-text">
            <?= $arResult["NOTE_MESSAGE"] ?>
        </div>
    </div>
    <?
} else {
    if (!empty($arResult["Post"]) > 0) { ?>



        <?if($arParams["STATUS_ID"]==9):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Петиция</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Вам необходимо ознакомиться с петицией и если вы хотите ее поддержать - нужно нажать на ссылку "Поддержать". Для того, чтобы петиция перешла на следующий этап законодательного процесса она должна набрать не менее 10% голосов от общего числа членов группы, в которую она добавлена.</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==10):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Обсуждение</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Вам необходимо ознакомиться с петицией и добавить свои комментарии к ней. Петиция перейдет на следующий этап законодательного процесса спустя 1 неделю с момента перевода в статус "Обсуждение". </p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==12):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Идет референдум</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Вам необходимо ознакомиться с текстом законопроекта и проголосовать "За" или "Против".</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==13):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон отклонен</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Данный законопроект не набрал необходимого количество голосов поддержки и был отклонен.</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==14):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон принят</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Закон набрал необходимое количество голосов поддержки и был успешно принят. Ознакомьтесь с текстом принятого закона.</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==15):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон на исполнении</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Закон передан на исполнение в органы исполнительной власти.</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        <?if($arParams["STATUS_ID"]==16):?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Закон исполнен</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            <p>Закон принят и исполнен органами исполнительной власти. Вы можете оценить качество исполнения закона выбрав оценку в блоке "Пожалуйста, оцените качество исполнения закона".</p>
                        </div>
                    </div>
                </div>
            </div>

        <?endif;?>

        

        <? if ($arParams["STATUS_ID"] >= 12):

            if($arParams["STATUS_ID"]==12) {
                $bgcolor = "bg-danger";
                $color = "text-white";
                $badge= "badge-success";
            }
            elseif ($arParams["STATUS_ID"]==13)
            {
                $bgcolor = "bg-secondary";
                $color = "text-white";
                $badge= "badge-light";

            }
            elseif ($arParams["STATUS_ID"]==14)
            {
                $bgcolor = "bg-success";
                $color = "text-white";
                $badge= "badge-light";
            }
            else
            {
                $bgcolor = "bg-success";
                $color = "text-white";
                $badge= "badge-light";
            }

            ?>





            <div class="row">
                <div class="col-lg-12">


            <?if($arParams["STATUS_ID"]>14 && !empty($arResult[UF_THEMATICS])):?>


            <div class="card">

                <div class="card-header bg-danger header-elements-lg-inline">
                    <h4 class="card-title <?= $color;?> font-weight-semibold mb-0">Результаты исполнения закона</h4>
                    <div class="header-elements">
                        <span class="badge badge-light">Результаты исполнения</span>


                    </div>
                </div>

                <div class="card-header bg-white d-flex mb-0">
                    <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">
                        <?if($arResult[LAW][ACTIVE_FROM]):?>
                        <li class="list-inline-item">
                            Принят к исполнению: <?=$arResult[LAW][ACTIVE_FROM];?>
                        </li>
                        <?endif;?>
                        <?if($arResult[LAW][ACTIVE_TO]):?>
                        <li class="list-inline-item">
                            Исполнен: <?=$arResult[LAW][ACTIVE_TO];?>
                        </li>
                        <?endif;?>
                    </ul>
                </div>

                    <div class="card-body border-bottom">

                        <?if($arResult[LAW][DETAIL_TEXT]):?>
                            <div class="mb-3">
                                <h5 class="text-danger">Отчет об исполнении закона<i class="icon-file-check  ml-1"></i></h5>
                                <div class='font-weight-semibold'>
                                    <?=$arResult[LAW][DETAIL_TEXT];?>
                                </div>
                            </div>
                        <?endif;?>

                        <div class="mb-3">
                            <h5 class="text-danger">Органы власти, ответственные за исполнение закона<i class="icon-library2 ml-1"></i></h5>

                            <?foreach($arResult[UF_THEMATICS] as $value){
                                $organ=GetElement($value[UF_ORGAN]);
                                echo "<div class=''>- ".$organ[NAME]."</div>";
                            }



                            ?>
                        </div>




                        <div class="mb-0">
                            <h5 class="text-danger">Пожалуйста, оцените качество исполнения закона<i class="icon-star-empty3   ml-1"></i></h5>
                            <div class="text-muted mb-3">Вы можете оценить качество исполнения закона по шкале от "Ужасно" до "Отлично". На основании индивидуальных оценок граждан рассчитывается средняя оценка исполнения закона. Расчетная оценка исполнения закона влияет на рейтинги министерств и ведомств, ответственных за исполнение закона. Рейтинги ведомств влияют на размеры заработных плат и премий чиновников. </div>
                            <div class="d-block">
                                <?$APPLICATION->IncludeComponent(
                                    "altasib:review.rating",
                                    "lawrating",
                                    Array(
                                        "ALLOW_SET" => "Y",
                                        "CACHE_TIME" => "86400",
                                        "CACHE_TYPE" => "A",
                                        "DETAIL_PAGE_URL" => "#SITE_DIR#/ogas/detail.php?ID=#ELEMENT_ID#",
                                        "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
                                        "ELEMENT_ID" => $arResult[UF_LAW],
                                        "IBLOCK_ID" => "8",
                                        "IBLOCK_TYPE" => "ogas",
                                        "IS_SEF" => "Y",
                                        "SECTION_PAGE_URL" => "#SITE_DIR#/ogas/list.php?SECTION_ID=#SECTION_ID#",
                                        "SEF_BASE_URL" => "#SITE_DIR#/ogas/index.php?ID=#IBLOCK_ID#",
                                        "SHOW_TITLE" => "N",
                                        "TITLE_TEXT" => "Рейтинг товара:"
                                    )
                                );?>
                            </div>
                        </div>
                    </div>
            </div>
             <?endif;?>

                    <div class="card">

                        <div class="card-header <?= $bgcolor;?> header-elements-lg-inline">
                            <h4 class="card-title <?= $color;?> font-weight-semibold mb-0"><?= $arResult["Post"]["TITLE"] ?></h4>
                                <div class="header-elements">
                                <span class="badge <?=$badge;?>"><?= $arParams["STATUS_NAME"] ?></span>


                                </div>

                        </div>

                        <div class="card-header bg-white d-flex mb-0">
                            <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">
                                <li class="list-inline-item">
                                <?=$arParams["STATUS_NAME"]?>
                                </li>
                                <li class="list-inline-item">
                                    <?//pr($arResult);?>
                                    <span class="blog-post-date-formated"><?if($arParams["STATUS_ID"]==12) {?>Начало:<?}elseif($arParams["STATUS_ID"]==13){?><?}elseif($arParams["STATUS_ID"]==14){?><?}?>
                                        <?=$arResult[UF_STATUS_DATE]?>
                        </span>

                                </li>
                                <?if($arParams["STATUS_ID"]==12) {?>
                                    <li class="list-inline-item">
                        <span class="blog-post-day"><span class="blog-post-date-formated">Окончание:
                                <?=date("d.m.Y h:i:s",strtotime("+1 week",MakeTimeStamp($arResult[UF_STATUS_DATE], "DD.MM.YYYY HH:MI:SS")));
                                ?></span>
                                    </li>
                                <?}?>
                                <li class="list-inline-item"><a href="/groups/group/<?=$arResult[SOCNET_GROUP_ID]?>/"><?=$arResult[SOCNET_GROUP_NAME];?></a></li>
                                <?
                                if (!empty($arResult["UF_THEMATICS"])){
                                    ?>
                                    <li class="list-inline-item">

                                            <noindex>

                                                <?
                                                $i = 0;
                                                foreach ($arResult["UF_THEMATICS"] as $v) {
                                                    if ($i != 0)
                                                        echo ",";
                                                    ?> <?= $v["NAME"] ?><?
                                                    $i++;
                                                }
                                                ?>
                                            </noindex>

                                    </li>


                                <?}?>
                            </ul>
                        </div>



                            <?if($arParams["STATUS_ID"]==12):?>

                            <? $APPLICATION->IncludeComponent("bitrix:voting.current", "referendum", Array(
                                "CHANNEL_SID" => "UF_BLOG_POST_VOTE",    // Группа опросов
                                "VOTE_ID" => $arResult[VOTE_ID],    // ID опроса
                                "VOTE_ALL_RESULTS" => "Y",    // Показывать варианты ответов для полей типа Text и Textarea
                                "CACHE_TYPE" => "A",    // Тип кеширования
                                "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                                "AJAX_MODE" => "Y",    // Включить режим AJAX
                                "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                                "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                                "AJAX_OPTION_HISTORY" => "Y",    // Включить эмуляцию навигации браузера
                                    "PETITION_ID" => $arResult[Post][ID],
                                    "STATUS_ID" => $arParams[STATUS_ID],
                                    "STATUS_DATE" => $arResult[UF_STATUS_DATE],
                                    "THEMATICS" => $arResult[UF_THEMATICS],
                                    "TAGS" => $arResult[Category],

                                ),
                                false
                            ); ?>



                            <?else:?>
                                <? $APPLICATION->IncludeComponent(
	"bitrix:voting.result", 
	"liquid", 
	array(
		"CHANNEL_SID" => "UF_BLOG_POST_VOTE",
		"VOTE_ID" => $arResult[VOTE_ID],
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"NEED_VOTES" => $arResult[POST_PROPERTIES][DATA][UF_NEED_VOTES][VALUE],
		"PETITION_ID" => $arResult[Post][ID],
        "STATUS_ID" => $arParams[STATUS_ID],
		"STATUS_DATE" => $arResult[UF_STATUS_DATE],
		"TAGS" => $arResult[Category],
        "THEMATICS" => $arResult[UF_THEMATICS],

		"COMPONENT_TEMPLATE" => "liquid"
	),
	false
); ?>
                            <?endif;?>


                    </div>


                    <? if ($arParams["STATUS_ID"] == 12):?>

                        <?

                        //Выводим блок "Назначенные делегаты" в референдуме, если в указанных тематиках текущий пользователь выбрал своих делегатов

                        $alreadyDelegate = array();
                        $iamDelegate = array();

                        $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
                        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

                        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                        $entity_data_class = $entity->getDataClass();

                        foreach ($arResult["UF_THEMATICS"] as $THEMATIC) {
                            $THEMATICS = $THEMATIC["ID"];
                        }


                        $data = array(
                            "UF_THEMATICS" => $THEMATICS,
                            "UF_USER" => $USER->GetID(),
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
                                <div class="card-header bg-success header-elements-lg-inline header-elements-inline">
                                    <h5 class="card-title">
                                        <a data-toggle="collapse" class="text-default text-white"
                                           href="#collapsible-delegates1" aria-expanded="false">Назначенные делегаты</a>
                                    </h5>
                                </div>

                                <div id="collapsible-delegates1" class="collapse show" style="">
                                    <div class="card-body">

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
                                                                         class="rounded-circle" alt="" width="42"
                                                                         height="42">
                                                                    <h6 class="mb-0"><?= $arUser[NAME] . " " . $arUser[LAST_NAME] ?></h6>
                                                                </a>
                                                                <span class="text-muted"><?= $them[NAME] ?></span>
                                                            </div>

                                                            <?
                                                            if (in_array($arUser[ID], $myDelegates)): ?>
                                                                <a href="javascript:"
                                                                   onclick="undelegate(<?= $USER->GetID() ?>,<?= $delegate[UF_DELEGATE] ?>,<?= $delegate[UF_THEMATICS] ?>,$(this))"
                                                                   class="btn bg-light mt-1">Освободить делегата</a>
                                                            <? else: ?>
                                                                <a href="javascript:"
                                                                   onclick="delegate(<?= $USER->GetID() ?>,<?= $delegate[UF_DELEGATE] ?>,<?= $delegate[UF_THEMATICS] ?>,$(this))"
                                                                   class="btn bg-primary mt-1">Назначить делегата</a>
                                                            <?endif; ?>
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


                        $data = CUser::GetList(($by="ID"), ($order="ASC"),
                            array(
                                'UF_THEMATICS' => $THEMATICS,
                                'ACTIVE' => 'Y',
                            ),
                            array("SELECT"=>array("ID","UF_*"))
                        );



                        if ($data->SelectedRowsCount()>0):
                            ?>
                            <div class="card card-group-control card-group-control-left">
                                <div class="card-header bg-success header-elements-lg-inline header-elements-inline">
                                    <h5 class="card-title">
                                        <a data-toggle="collapse" class="text-default text-white collapsed"
                                           href="#collapsible-delegates2" aria-expanded="false">Возможные делегаты</a>
                                    </h5>
                                </div>

                                <div id="collapsible-delegates2" class="collapse" style="">
                                    <div class="card-body">

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
                                                                         class="rounded-circle" alt="" width="42"
                                                                         height="42">
                                                                    <h6 class="mb-0"><?= $arUser[NAME] . " " . $arUser[LAST_NAME] ?></h6>
                                                                </a>

                                                            </div>


                                                                <a href="javascript:"
                                                                   onclick="delegateall(<?= $USER->GetID() ?>,<?= $arUser[ID] ?>,$(this))"
                                                                   class="btn bg-primary mt-1">Назначить делегата</a>

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
            </div>


        <? endif; ?>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header bg-white header-elements-lg-inline">
                        <h4 class="card-title font-weight-semibold mb-0">
                                <?= $arResult["Post"]["TITLE"] ?></h4>
                        <div class="header-elements">
                            <span class="badge bg-success "><?if($arParams["STATUS_ID"] != 10){echo "Петиция";}else{echo $arParams["STATUS_NAME"]; }?></span>


                        </div>

                    </div>

                    <?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
                        <?if(!empty($arPostField["VALUE"]) && $FIELD_NAME=="UF_BLOG_POST_FILE"):?>

                                <img src="<?=CFile::GetPath($arPostField["VALUE"]);?>" class="img-fluid postimage">

                        <?endif;?>
                    <?endforeach;?>



                    <div class="card-header bg-white d-flex mb-0">
                        <ul class="list-inline list-inline-dotted text-muted mt-1 mb-1">
                            <li class="list-inline-item">
                                <?
                                if ($arParams["SHOW_RATING"] == "Y"):?>
                                    <span class="rating_vote_text">
					<?
                    $APPLICATION->IncludeComponent(
                        "bitrix:rating.vote", $arParams["RATING_TYPE"],
                        Array(
                            "ENTITY_TYPE_ID" => "BLOG_POST",
                            "ENTITY_ID" => $arResult["Post"]["ID"],
                            "OWNER_ID" => $arResult["Post"]["AUTHOR_ID"],
                            "USER_VOTE" => $arResult["RATING"]["USER_VOTE"],
                            "USER_HAS_VOTED" => $arResult["RATING"]["USER_HAS_VOTED"],
                            "TOTAL_VOTES" => $arResult["RATING"]["TOTAL_VOTES"],
                            "TOTAL_POSITIVE_VOTES" => $arResult["RATING"]["TOTAL_POSITIVE_VOTES"],
                            "TOTAL_NEGATIVE_VOTES" => $arResult["RATING"]["TOTAL_NEGATIVE_VOTES"],
                            "TOTAL_VALUE" => $arResult["RATING"]["TOTAL_VALUE"],
                            "PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    ); ?>
					</span>
                                <? endif; ?>
                            </li>
                            <li class="list-inline-item">

                                <a  href="/user/<?=$arResult["arUser"][ID]?>/"><i class="icon-user "></i> <?=$arResult["arUser"][NAME]?> <?=$arResult["arUser"][LAST_NAME]?></a>

                            </li>
                            <li class="list-inline-item"><?= $arResult["Post"]["DATE_PUBLISH_DATE"] ?></li>

                            <li class="list-inline-item">
                                <span
                                            class="blog-post-link-caption"><i class="icon-eye mr-1 icon-1x"></i><span
                                                class="blog-post-link-counter"><?= IntVal($arResult["Post"]["VIEWS"]) ?></span>
                            </li>


                            <li class="list-inline-item">
                                <?
                                if ($arResult["Post"]["ENABLE_COMMENTS"] == "Y"):?>
                                    <a href="#comments"><span
                                                class="blog-post-link-caption"><i class="icon-comment mr-1 icon-1x"></i></span>
                                        <span class="blog-post-link-counter"><?= IntVal($arResult["Post"]["NUM_COMMENTS"]) ?></span></a>
                                <? endif; ?>
                            </li>

                            <li  class="list-inline-item"><a href="/groups/group/<?=$arResult[SOCNET_GROUP_ID]?>/"><?=$arResult[SOCNET_GROUP_NAME]?></a></li>


                            <?
                            if (!empty($arResult["UF_THEMATICS"])){
                            ?>
                            <li class="list-inline-item">
                                <div class="blog-post-tag">
                                    <noindex>

                                        <?
                                        $i = 0;
                                        foreach ($arResult["UF_THEMATICS"] as $v) {
                                            if ($i != 0)
                                                echo ",";
                                            ?> <?= $v["NAME"] ?><?
                                            $i++;
                                        }
                                        ?>
                                    </noindex>
                                </div>
                            </li>


                                <?}?>



                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="mb-0">
                            <h5 class="text-warning">Проблема<i class="icon-question6 ml-1"></i></h5>
                            <?= $arResult["Post"]["textFormated"] ?>

                            <?//pr($arResult)?>

                        </div>



                    </div>


                    <?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
                        <?if(!empty($arPostField["VALUE"]) && $FIELD_NAME=="UF_DECISION"):?>
                            <div class="card-body bg-white border-top">
                                <h5 class="text-success">Решение<i class="icon-checkmark-circle2 ml-1"></i></h5>
                                <?=TxtToHTML($arPostField["VALUE"])?>
                            </div>


                        <?endif;?>
                    <?endforeach;?>

                    <? /*$APPLICATION->IncludeComponent(
	"bitrix:voting.result", 
	"petition", 
	array(
		"CHANNEL_SID" => "UF_BLOG_POST_VOTE",
		"VOTE_ID" => $arResult[VOTE_ID],
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"NEED_VOTES" => $arResult[POST_PROPERTIES][DATA][UF_NEED_VOTES][VALUE],
		"COMPONENT_TEMPLATE" => "petition"
	),
	false
); */?>

                    <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                        <ul class="list-inline list-inline-dotted text-muted mb-1">

                            <?
                            if (strLen($arResult["urlToEdit"]) > 0):?>
                                <li class="list-inline-item">
                                    <a href="<?= $arResult["urlToEdit"] ?>"><span
                                                class="blog-post-link-caption"><?= GetMessage("BLOG_BLOG_BLOG_EDIT") ?></span></a>
                                </li>
                            <? endif; ?>
                            <?
                            if (strLen($arResult["urlToDelete"]) > 0):?>
                                <li class="list-inline-item">
                                    <a href="javascript:if(confirm('<?= GetMessage("BLOG_MES_DELETE_POST_CONFIRM") ?>')) window.location='<?= $arResult["urlToDelete"] . "&" . bitrix_sessid_get() ?>'"><span
                                                class="blog-post-link-caption"><?= GetMessage("BLOG_BLOG_BLOG_DELETE") ?></span></a>
                                </li>
                            <? endif; ?>

                            <?
                            /*if (!empty($arResult["Category"])) {
                                ?>
                                <li class="list-inline-item">
                                    <div class="blog-post-tag">
                                        <noindex>
                                            <?= GetMessage("BLOG_BLOG_BLOG_CATEGORY") ?>
                                            <?
                                            $i = 0;
                                            foreach ($arResult["Category"] as $v) {
                                                if ($i != 0)
                                                    echo ",";
                                                ?> <a href="<?= $v["urlToCategory"] ?>"
                                                      rel="nofollow"><?= $v["NAME"] ?></a><?
                                                $i++;
                                            }
                                            ?>
                                        </noindex>
                                    </div>
                                </li>
                            <? }*/ ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

<?    } else
        echo GetMessage("BLOG_BLOG_BLOG_NO_AVAIBLE_MES");
}
?>