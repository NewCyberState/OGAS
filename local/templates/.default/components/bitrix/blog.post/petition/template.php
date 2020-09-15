<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;

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


            <?if($arParams["STATUS_ID"]>12 && $arParams["STATUS_ID"]!=13 && !empty($arResult[UF_THEMATICS])):?>


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
                                <li class="list-inline-item"><?=$arResult[SOCNET_GROUP_NAME];?></li>
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

                            <li  class="list-inline-item"><?=$arResult[SOCNET_GROUP_NAME]?></li>


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
        <? /*

		$className = "blog-post";
		$className .= " blog-post-first";
		$className .= " blog-post-alt";
		$className .= " blog-post-year-".$arResult["Post"]["DATE_PUBLISH_Y"];
		$className .= " blog-post-month-".IntVal($arResult["Post"]["DATE_PUBLISH_M"]);
		$className .= " blog-post-day-".IntVal($arResult["Post"]["DATE_PUBLISH_D"]);
		?>
		<script>
		BX.viewImageBind(
			'blg-post-<?=$arResult["Post"]["ID"]?>',
			{showTitle: false},
			{tag:'IMG', attr: 'data-bx-image'}
		);
		</script>
		<div class="<?=$className?>" id="blg-post-<?=$arResult["Post"]["ID"]?>">
		<h2 class="blog-post-title"><span><?=$arResult["Post"]["TITLE"]?></span></h2>
		<div class="blog-post-info-back blog-post-info-top">
		<div class="blog-post-info">
			<?if ($arParams["SHOW_RATING"] == "Y"):?>
			<div class="blog-post-rating rating_vote_graphic">
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
			);?>
			</div>
			<?endif;?>
			<div class="blog-author">
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
					<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
				</noindex>
			<?else:?>
				<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>
			<?endif;?>
			<?
			if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && array_key_exists("ALIAS", $arResult["BlogUser"]) && strlen($arResult["BlogUser"]["ALIAS"]) > 0)
				$arTmpUser = array(
					"NAME" => "",
					"LAST_NAME" => "",
					"SECOND_NAME" => "",
					"LOGIN" => "",
					"NAME_LIST_FORMATTED" => $arResult["BlogUser"]["~ALIAS"],
				);
			elseif (strlen($arResult["urlToBlog"]) > 0 || strlen($arResult["urlToAuthor"]) > 0)
					$arTmpUser = array(
						"NAME" => $arResult["arUser"]["~NAME"],
						"LAST_NAME" => $arResult["arUser"]["~LAST_NAME"],
						"SECOND_NAME" => $arResult["arUser"]["~SECOND_NAME"],
						"LOGIN" => $arResult["arUser"]["~LOGIN"],
						"NAME_LIST_FORMATTED" => "",
					);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
			<?endif;?>
			<?		
			$APPLICATION->IncludeComponent("bitrix:main.user.link",
				'',
				array(
					"ID" => $arResult["arUser"]["ID"],
					"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
					"NAME" => $arTmpUser["NAME"],
					"LAST_NAME" => $arTmpUser["LAST_NAME"],
					"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
					"LOGIN" => $arTmpUser["LOGIN"],
					"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
					"USE_THUMBNAIL_LIST" => "N",
					"PROFILE_URL" => $arResult["urlToAuthor"],
					"PROFILE_URL_LIST" => $arResult["urlToBlog"],
					"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
					"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
					"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
					"SHOW_YEAR" => $arParams["SHOW_YEAR"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
					"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
					"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
					"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
					"INLINE" => "Y",
					"SEO_USER" => $arParams["SEO_USER"],
				),
				false,
				array("HIDE_ICONS" => "Y")
			);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				</noindex>
			<?endif;?>
			</div>
			<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
		</div>
		</div>
		<div class="blog-post-content">
			<div class="blog-post-avatar"><?=$arResult["BlogUser"]["AVATAR_img"]?></div>
			<?=$arResult["Post"]["textFormated"]?>
			<?if(!empty($arResult["images"]))
			{
				?>
				<div class="feed-com-files">
					<div class="feed-com-files-title"><?=GetMessage("BLOG_PHOTO")?></div>
					<div class="feed-com-files-cont">
						<?
						foreach($arResult["images"] as $val)
						{
							?><span class="feed-com-files-photo"><img src="<?=$val["small"]?>" alt="" border="0" data-bx-image="<?=$val["full"]?>"></span><?
						}
						?>
					</div>
				</div>
				<?
			}?>
			<?if($arResult["POST_PROPERTIES"]["SHOW"] == "Y"):
				$eventHandlerID = false;
				$eventHandlerID = AddEventHandler('main', 'system.field.view.file', Array('CBlogTools', 'blogUFfileShow'));
				?>
				<div>
				<?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
				<?if(!empty($arPostField["VALUE"])):?>
					<?=($FIELD_NAME=='UF_BLOG_POST_DOC' ? "" : "<b>".$arPostField["EDIT_FORM_LABEL"].":</b>&nbsp;")?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.view", 
								$arPostField["USER_TYPE"]["USER_TYPE_ID"], 
								array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?><br />
				<?endif;?>
				<?endforeach;?>
				</div>
				<?
				if ($eventHandlerID !== false && ( intval($eventHandlerID) > 0 ))
					RemoveEventHandler('main', 'system.field.view.file', $eventHandlerID);
			endif;?>
		</div>
			<div class="blog-post-meta">
				<div class="blog-post-info-bottom">
				<div class="blog-post-info">
					<div class="blog-author">
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
							<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
						</noindex>
					<?else:?>
						<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>
					<?endif;?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
					<?endif;?>
					<?		
					$APPLICATION->IncludeComponent("bitrix:main.user.link",
						'',
						array(
							"ID" => $arResult["arUser"]["ID"],
							"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
							"NAME" => $arTmpUser["NAME"],
							"LAST_NAME" => $arTmpUser["LAST_NAME"],
							"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
							"LOGIN" => $arTmpUser["LOGIN"],
							"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
							"USE_THUMBNAIL_LIST" => "N",
							"PROFILE_URL" => $arResult["urlToAuthor"],
							"PROFILE_URL_LIST" => $arResult["urlToBlog"],
							"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
							"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
							"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
							"SHOW_YEAR" => $arParams["SHOW_YEAR"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
							"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
							"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
							"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
							"INLINE" => "Y",
							"SEO_USER" => $arParams["SEO_USER"],
						),
						false,
						array("HIDE_ICONS" => "Y")
					);
					?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						</noindex>
					<?endif;?>
					</div>
					<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
				</div>
				</div>
				<?
				if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
				{
					?><div class="blog-post-share">
						<noindex><?
						$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
								"HANDLERS" => $arParams["SHARE_HANDLERS"],
								"PAGE_URL" => htmlspecialcharsback($arResult["urlToPost"]),
								"PAGE_TITLE" => $arResult["Post"]["~TITLE"],
								"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
								"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
								"ALIGN" => "right",
								"HIDE" => $arParams["SHARE_HIDE"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);
						?></noindex>
					</div>
					<?
				}?>
				<div class="blog-post-meta-util">
					<span class="blog-post-views-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_VIEWS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["VIEWS"])?></span></a></span>
					<?if($arResult["Post"]["ENABLE_COMMENTS"] == "Y"):?>
						<span class="blog-post-comments-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_COMMENTS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["NUM_COMMENTS"])?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToHide"])>0):?>
						<span class="blog-post-hide-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_HIDE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToHide"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_HIDE")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToEdit"])>0):?>
						<span class="blog-post-edit-link"><a href="<?=$arResult["urlToEdit"]?>"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_EDIT")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToDelete"])>0):?>
						<span class="blog-post-delete-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToDelete"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_DELETE")?></span></a></span>
					<?endif;?>

					<?if ($arParams["SHOW_RATING"] == "Y"):?>
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
					);?>
					</span>
					<?endif;?>
				</div>
				
				<?if(!empty($arResult["Category"]))
				{
					?>
					<div class="blog-post-tag">
						<noindex>
						<?=GetMessage("BLOG_BLOG_BLOG_CATEGORY")?>
						<?
						$i=0;
						foreach($arResult["Category"] as $v)
						{
							if($i!=0)
								echo ",";
							?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
							$i++;
						}
						?>
						</noindex>
					</div>
					<?
				}
				?>
			</div>
		</div>
		<?*/
    } else
        echo GetMessage("BLOG_BLOG_BLOG_NO_AVAIBLE_MES");
}
?>