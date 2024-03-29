<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
    $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<? CUtil::InitJSCore(array("image")); ?>


<?
if($arParams["STATUS_ID"] == 9) {
    $title = "Новые петиции";
    $all="Все петиции";
    $url="/lkg/gos/petition/";
}
elseif($arParams["STATUS_ID"] == 10) {
    $title = "Новые обсуждения";
    $all="Все обсуждения";
    $url="/lkg/gos/discussion/";
}
elseif($arParams["STATUS_ID"] == 12) {
    $title = "Новые референдумы";
    $all="Все референдумы";
    $url="/lkg/gos/referendum/";
}
elseif($arParams["STATUS_ID"] == 13) {
    $title = "Отклоненные законы";
    $all="Все отмененные законы";
    $url="/lkg/gos/law/rejected/";
}
elseif($arParams["STATUS_ID"] == 14) {
    $title = "Принятые законы";
    $all="Все законы";
    $url="/lkg/gos/law/approved/";
}
elseif($arParams["STATUS_ID"] == 15) {
    $title = "Законы на исполнении";
    $all="Все законы";
    $url="/lkg/gos/law/execution/";
}
elseif($arParams["STATUS_ID"] == 16) {
    $title = "Исполненные законы";
    $all="Все законы";
    $url="/lkg/gos/law/executed/";
}
if($arParams[SOCNET_GROUP_ID]>0)
    $groupid="?group_id=".$arParams[SOCNET_GROUP_ID];

if (count($arResult["POSTS"]) > 0) {
    ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header header-elements-inline bg-white">
                    <h5 class="card-title"><?=$title?></h5>
                    <div class="header-elements">
                        <span><a href="<?=$url.$groupid?>"><?=$all?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">


<?    foreach ($arResult["POSTS"] as $ind => $CurPost) {
        $className = "blog-post";
        if ($ind == 0)
            $className .= " blog-post-first";
        elseif (($ind + 1) == count($arResult["POSTS"]))
            $className .= " blog-post-last";
        if ($ind % 2 == 0)
            $className .= " blog-post-alt";
        $className .= " blog-post-year-" . $CurPost["DATE_PUBLISH_Y"];
        $className .= " blog-post-month-" . $CurPost["DATE_PUBLISH_M"];
        $className .= " blog-post-day-" . $CurPost["DATE_PUBLISH_D"];
        ?>
        <script>
            BX.viewImageBind(
                'blg-post-<?=$CurPost["ID"]?>',
                {showTitle: false},
                {tag: 'IMG', attr: 'data-bx-image'}
            );
        </script>


        <div class="<?if($APPLICATION->GetCurDir()=="/lkg/gos/"):?>col-lg-6 col-xl-4<?else:?>col-lg-6 col-xl-4<?endif;?>">

            <div class="card">
                <a name="post<?=$CurPost["ID"]?>"></a>
                <div class="card-header <?if($arParams["STATUS_ID"]==9){echo "bg-white";}else{echo "bg-info";};?> d-flex header-elements-inline">
                    <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                        <a href="<?= $CurPost["urlToPost"] ?>" class="<?if($arParams["STATUS_ID"]==9){echo "";}else{echo "text-white";};?>"
                           title="<?= $CurPost["TITLE"] ?>"><?= $CurPost["TITLE"]; ?></a>
                    </h6>
                    <div class="header-elements">
                        <a href="<?= $CurPost["urlToPost"] ?>" title="<?= $CurPost["TITLE"] ?>"><span class="badge bg-success ml-2"><?= $arParams["STATUS_NAME"] ?></span></a>
                    </div>
                </div>



                <?foreach ($CurPost["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
                    <?if(!empty($arPostField["VALUE"]) && $FIELD_NAME=="UF_BLOG_POST_FILE"):?>
                        <a href="<?= $CurPost["urlToPost"] ?>" class="<?if($arParams["STATUS_ID"]==9){echo "";}else{echo "text-white";};?>"
                           title="<?= $CurPost["TITLE"] ?>">
                            <?
                            $arFileTmp = CFile::ResizeImageGet(
                                $arPostField["VALUE"],
                                array("width" => 750, "height" => 500),
                                BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                true,
                                false,
                                false,
                                false
                            );
                            ?>

                            <div class="cardimage" style="background-image: url(<?=$arFileTmp["src"];?>);"></div>
                        </a>
                    <?endif;?>
                <?endforeach;?>


<?/*?>
                <div class="card-header bg-white d-flex mb-0">
                    <ul class="list-inline list-inline-dotted text-muted  mb-0">
                        <li class="list-inline-item">
                            <?//pr($CurPost);
                            ?>

                            <?
                            if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0) && array_key_exists("BLOG_USER_ALIAS", $CurPost) && strlen($CurPost["BLOG_USER_ALIAS"]) > 0)
                                $arTmpUser = array(
                                    "NAME" => "",
                                    "LAST_NAME" => "",
                                    "SECOND_NAME" => "",
                                    "LOGIN" => "",
                                    "NAME_LIST_FORMATTED" => $CurPost["~BLOG_USER_ALIAS"],
                                );
                            elseif (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0)
                                $arTmpUser = array(
                                    "NAME" => $CurPost["~AUTHOR_NAME"],
                                    "LAST_NAME" => $CurPost["~AUTHOR_LAST_NAME"],
                                    "SECOND_NAME" => $CurPost["~AUTHOR_SECOND_NAME"],
                                    "LOGIN" => $CurPost["~AUTHOR_LOGIN"],
                                    "NAME_LIST_FORMATTED" => "",
                                );
                            ?>

                            <?
                            if ($arParams["SEO_USER"] == "Y"): ?>
                            <noindex>
                                <?
                                endif;
                                ?>
                                <?
                                $GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
                                    '',
                                    array(
                                        "ID" => $CurPost["AUTHOR_ID"],
                                        "HTML_ID" => "blog_new_posts_list_" . $CurPost["AUTHOR_ID"],
                                        "NAME" => $arTmpUser["NAME"],
                                        "LAST_NAME" => $arTmpUser["LAST_NAME"],
                                        "SECOND_NAME" => $arTmpUser["SECOND_NAME"],
                                        "LOGIN" => $arTmpUser["LOGIN"],
                                        "NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
                                        "USE_THUMBNAIL_LIST" => "N",
                                        "PROFILE_URL" => $CurPost["urlToAuthor"],
                                        "PROFILE_URL_LIST" => $CurPost["urlToBlog"],
                                        "PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
                                        "PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
                                        "DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
                                        "SHOW_YEAR" => $arParams["SHOW_YEAR"],
                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                        "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                                        "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                                        "PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
                                        "PATH_TO_SONET_USER_PROFILE" => $arParams["~PATH_TO_SONET_USER_PROFILE"],
                                        "INLINE" => "Y",
                                        "SEO_USER" => $arParams["SEO_USER"],
                                    ),
                                    false,
                                    array("HIDE_ICONS" => "Y")
                                );
                                ?>
                                <?
                                if ($arParams["SEO_USER"] == "Y"): ?>
                            </noindex>
                        <?
                        endif;
                        ?>

                            <?
                            if ($arParams["SEO_USER"] == "Y"):?>
                                <noindex>
                                    <a class="text-muted" href="<?= $CurPost["urlToAuthor"] ?>" rel="nofollow"></a>
                                </noindex>
                            <? else:?>
                                <a class="text-muted" href="<?= $CurPost["urlToAuthor"] ?>"></a>
                            <?endif; ?>


                        </li>
                        <li class="list-inline-item">
                        <span class="blog-post-day"><span
                                    class="blog-post-date-formated"><?= $CurPost["DATE_PUBLISH_FORMATED"] ?></span>
                        </li>
                        <li class="list-inline-item"><?=$CurPost[SOCNET_GROUP_NAME];?></li>

                    </ul>

                </div>

                <?*/?>

                <div class="card-body">

                    <?//pr($CurPost);
                    ?>
                    <div id="">
                        <div data-mrc id="collapseSummary<?= $CurPost[ID] ?>">
                            <?= $CurPost["TEXT_FORMATED"] ?>
                        </div>
                        <?
                        if (strlen($CurPost["TEXT_FORMATED"]) > 400):?>
                            <a class="collapsed" data-toggle="collapse" href="#collapseSummary<?= $CurPost[ID] ?>"
                               aria-expanded="false" aria-controls="collapseSummary"></a>
                        <?endif; ?>
                    </div>


                </div>

                <div class="card-footer d-flex">
                    <ul class="list-inline list-inline-dotted text-muted mb-0">
                        <li class="list-inline-item">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:rating.vote", $arParams["RATING_TYPE"],
                                Array(
                                    "ENTITY_TYPE_ID" => "BLOG_POST",
                                    "ENTITY_ID" => $CurPost["ID"],
                                    "OWNER_ID" => $CurPost["AUTHOR_ID"],
                                    "USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
                                    "USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
                                    "TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
                                    "TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
                                    "TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
                                    "TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
                                    "PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            ); ?>
                        </li>

                        <li class="list-inline-item"><a
                                    href="<?= $CurPost["urlToPost"] ?>#comments" title="Комментарии" alt="Комментарии"><span class="blog-post-link-caption"><i class="icon-comment mr-1"></i></span> <?= IntVal($CurPost["NUM_COMMENTS"]); ?></a>
                        </li>

                    </ul>

                    <?
                    if (!empty($CurPost["CATEGORY"])) {
                        echo "<span class='ml-auto'>";
                        $i = 0;
                        foreach ($CurPost["CATEGORY"] as $v) {
                            if ($i != 0)
                                echo ",";
                            ?> <?= $v["NAME"] ?><?
                            $i++;
                        }
                        echo "</span>";
                    }
                    ?>
                </div>
            </div>

        </div>


        <?/*?>

			<div class="<?=$className?>" id="blg-post-<?=$CurPost["ID"]?>">
				<h2 class="blog-post-title"><a href="<?=$CurPost["urlToPost"]?>" title="<?=$CurPost["TITLE"]?>"><?=$CurPost["TITLE"]?></a></h2>
				<div class="blog-post-info-back blog-post-info-top">
				<div class="blog-post-info">
					<?if ($arParams["SHOW_RATING"] == "Y"):?>
					<div class="blog-post-rating rating_vote_graphic">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote", $arParams["RATING_TYPE"],
						Array(
							"ENTITY_TYPE_ID" => "BLOG_POST",
							"ENTITY_ID" => $CurPost["ID"],
							"OWNER_ID" => $CurPost["AUTHOR_ID"],
							"USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
							"USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
							"TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
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
							<a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>" rel="nofollow"></a>
						</noindex>
					<?else:?>
						<a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>"></a>
					<?endif;?>
					<?
					if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0) && array_key_exists("BLOG_USER_ALIAS", $CurPost) && strlen($CurPost["BLOG_USER_ALIAS"]) > 0)
						$arTmpUser = array(
							"NAME" => "",
							"LAST_NAME" => "",
							"SECOND_NAME" => "",
							"LOGIN" => "",
							"NAME_LIST_FORMATTED" => $CurPost["~BLOG_USER_ALIAS"],
						);
					elseif (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0)
						$arTmpUser = array(
							"NAME" => $CurPost["~AUTHOR_NAME"],
							"LAST_NAME" => $CurPost["~AUTHOR_LAST_NAME"],
							"SECOND_NAME" => $CurPost["~AUTHOR_SECOND_NAME"],
							"LOGIN" => $CurPost["~AUTHOR_LOGIN"],
							"NAME_LIST_FORMATTED" => "",
						);	
					?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
					<?endif;?>
					<?
					$GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
						'',
						array(
							"ID" => $CurPost["AUTHOR_ID"],
							"HTML_ID" => "blog_new_posts_list_".$CurPost["AUTHOR_ID"],
							"NAME" => $arTmpUser["NAME"],
							"LAST_NAME" => $arTmpUser["LAST_NAME"],
							"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
							"LOGIN" => $arTmpUser["LOGIN"],
							"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
							"USE_THUMBNAIL_LIST" => "N",
							"PROFILE_URL" => $CurPost["urlToAuthor"],
							"PROFILE_URL_LIST" => $CurPost["urlToBlog"],
							"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
							"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
							"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
							"SHOW_YEAR" => $arParams["SHOW_YEAR"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
							"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
							"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
							"PATH_TO_SONET_USER_PROFILE" => $arParams["~PATH_TO_SONET_USER_PROFILE"],
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
					<div class="blog-post-date"><span class="blog-post-day"><?=$CurPost["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$CurPost["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></span></div>
				</div>
				</div>
				<div class="blog-post-content">
					<div class="blog-post-avatar"><?=$CurPost["BlogUser"]["AVATAR_img"]?></div>
					<?=$CurPost["TEXT_FORMATED"]?>
					<?
					if ($CurPost["CUT"] == "Y")
					{
						?><p><a class="blog-postmore-link" href="<?=$CurPost["urlToPost"]?>"><?=GetMessage("BLOG_BLOG_BLOG_MORE")?></a></p><?
					}
					?>
					<?if(!empty($CurPost["arImages"]))
					{
						?>
						<div class="feed-com-files">
							<div class="feed-com-files-title"><?=GetMessage("BLOG_PHOTO")?></div>
							<div class="feed-com-files-cont">
								<?
								foreach($CurPost["arImages"] as $val)
								{
									?><span class="feed-com-files-photo"><img src="<?=$val["small"]?>" alt="" border="0" data-bx-image="<?=$val["full"]?>"></span><?
								}
								?>
							</div>
						</div>
						<?
					}?>
					<?if($CurPost["POST_PROPERTIES"]["SHOW"] == "Y"):
						$eventHandlerID = false;
						$eventHandlerID = AddEventHandler('main', 'system.field.view.file', Array('CBlogTools', 'blogUFfileShow'));
						?>
						<?foreach ($CurPost["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
						<?if(!empty($arPostField["VALUE"])):?>
						<div>
						<?=($FIELD_NAME=='UF_BLOG_POST_DOC' ? "" : "<b>".$arPostField["EDIT_FORM_LABEL"].":</b>&nbsp;")?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.view", 
								$arPostField["USER_TYPE"]["USER_TYPE_ID"], 
								array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?>
						</div>
						<?endif;?>
						<?endforeach;?>
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
									<a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>" rel="nofollow"></a>
								</noindex>
							<?else:?>
								<a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>"></a>
							<?endif;?>
							<?if($arParams["SEO_USER"] == "Y"):?>
								<noindex>
							<?endif;?>
							<?
							$GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
								'',
								array(
									"ID" => $CurPost["AUTHOR_ID"],
									"HTML_ID" => "blog_new_posts_list_".$CurPost["AUTHOR_ID"],
									"NAME" => $arTmpUser["NAME"],
									"LAST_NAME" => $arTmpUser["LAST_NAME"],
									"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
									"LOGIN" => $arTmpUser["LOGIN"],
									"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
									"USE_THUMBNAIL_LIST" => "N",
									"PROFILE_URL" => $CurPost["urlToAuthor"],
									"PROFILE_URL_LIST" => $CurPost["urlToBlog"],
									"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
									"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
									"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
									"SHOW_YEAR" => $arParams["SHOW_YEAR"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
									"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
									"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
									"PATH_TO_SONET_USER_PROFILE" => $arParams["~PATH_TO_SONET_USER_PROFILE"],
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
							<div class="blog-post-date"><span class="blog-post-day"><?=$CurPost["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$CurPost["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></span></div>
						</div>
					</div>
					<?
					if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
					{
						?>
						<div class="blog-post-share" style="float: right;">
							<noindex>
							<?
							$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
									"HANDLERS" => $arParams["SHARE_HANDLERS"],
									"PAGE_URL" => htmlspecialcharsback($CurPost["urlToPost"]),
									"PAGE_TITLE" => htmlspecialcharsback($CurPost["TITLE"]),
									"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
									"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
									"ALIGN" => "right",
									"HIDE" => $arParams["SHARE_HIDE"],
								),
								$component,
								array("HIDE_ICONS" => "Y")
							);
							?>
							</noindex>
						</div>
						<?
					}
					?>
					<div class="blog-post-meta-util">
						<span class="blog-post-views-link"><a href="<?=$CurPost["urlToPost"]?>"><?=GetMessage("BLOG_BLOG_BLOG_VIEWS")?> <?=IntVal($CurPost["VIEWS"]);?></a></span>
						<span class="blog-post-comments-link"><a href="<?=$CurPost["urlToPost"]?>#comments"><?=GetMessage("BLOG_BLOG_BLOG_COMMENTS")?> <?=IntVal($CurPost["NUM_COMMENTS"]);?></a></span>
						<?if ($arParams["SHOW_RATING"] == "Y"):?>
						<span class="rating_vote_text">
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:rating.vote", $arParams["RATING_TYPE"],
							Array(
								"ENTITY_TYPE_ID" => "BLOG_POST",
								"ENTITY_ID" => $CurPost["ID"],
								"OWNER_ID" => $CurPost["AUTHOR_ID"],
								"USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
								"USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
								"TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
								"TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
								"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
								"TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
								"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);?>
						</span>
						<?endif;?>
					</div>

					<div class="blog-post-tag">
						<noindex>
						<?
						if(!empty($CurPost["CATEGORY"]))
						{
							echo GetMessage("BLOG_BLOG_BLOG_CATEGORY");
							$i=0;
							foreach($CurPost["CATEGORY"] as $v)
							{
								if($i!=0)
									echo ",";
								?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
								$i++;
							}
						}
						?>
						</noindex>
					</div>
		<?*/
    }

    ?></div><?

    if($APPLICATION->GetCurDir()!="/lkg/gos/"):
        if (strlen($arResult["NAV_STRING"]) > 0)
            echo "<div class='row'>".$arResult["NAV_STRING"]."</div>";
    endif;
}
/*else {
    if ($arParams["STATUS_ID"] == 9)
        echo "<div class='col-lg-12'><div class='card'><div class='card-body'>Не найдено ни одной петиции</div></div></div>";
    elseif ($arParams["STATUS_ID"] == 10)
        echo "<div class='col-lg-12'><div class='card'><div class='card-body'><div class='w-100'>Не найдено ни одного обсуждения</div></div></div></div>";

    echo "</div>";
}*/
?>

<script>
$(document).ready(function() {

    var example = $('[data-mrc]');

// Инициализация
    example.expandable({
        'height': 150,
        'animation_duration': 500,
        'more': 'Развернуть...',
        'less': 'Свернуть...',
        'no_less': false
});

});

</script>