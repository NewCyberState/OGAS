<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/styles/additional.css');
endif;
?>
<div class="">
<?
if(strlen($arResult["MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["ERROR_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["ERROR_MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["FATAL_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["FATAL_MESSAGE"]?>
		</div>
	</div>
	<?
}
elseif(strlen($arResult["UTIL_MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["UTIL_MESSAGE"]?>
		</div>
	</div>
	<?
}
else
{
		if($arResult["preview"] == "Y" && !empty($arResult["PostToShow"])>0)
		{
			echo "<p><b>".GetMessage("BLOG_PREVIEW_TITLE")."</b></p>";
			$className = "blog-post";
			$className .= " blog-post-first";
			$className .= " blog-post-alt";
			$className .= " blog-post-year-".$arResult["postPreview"]["DATE_PUBLISH_Y"];
			$className .= " blog-post-month-".IntVal($arResult["postPreview"]["DATE_PUBLISH_M"]);
			$className .= " blog-post-day-".IntVal($arResult["postPreview"]["DATE_PUBLISH_D"]);
			?>
			<div class="<?=$className?>">
				<h2 class="blog-post-title"><span><?=$arResult["postPreview"]["TITLE"]?></span></h2>
				<div class="blog-post-info-back blog-post-info-top">
					<div class="blog-post-info">
						<div class="blog-author"><div class="blog-author-icon"></div><?=$arResult["postPreview"]["AuthorName"]?></div>
						<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["postPreview"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["postPreview"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["postPreview"]["DATE_PUBLISH_FORMATED"]?></span></div>
					</div>
				</div>
				<div class="blog-post-content">
					<div class="blog-post-avatar"><?=$arResult["postPreview"]["BlogUser"]["AVATAR_img"]?></div>
					<?=$arResult["postPreview"]["textFormated"]?>
					<br clear="all" />
				</div>
				<div class="blog-post-meta">
					<div class="blog-post-info-bottom">
						<div class="blog-post-info">
							<div class="blog-author"><div class="blog-author-icon"></div><?=$arResult["postPreview"]["AuthorName"]?></div>
							<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["postPreview"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["postPreview"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["postPreview"]["DATE_PUBLISH_FORMATED"]?></span></div>
						</div>
					</div>
					<div class="blog-post-meta-util">
						<span class="blog-post-views-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_VIEWS")?>:</span><span class="blog-post-link-counter">0</span></a></span>
						<span class="blog-post-comments-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_COMMENTS")?>:</span><span class="blog-post-link-counter">0</span></a></span>
					</div>

					<?if(!empty($arResult["postPreview"]["Category"]))
					{
						?>
						<div class="blog-post-tag">
							<span><?=GetMessage("BLOG_BLOG_BLOG_CATEGORY")?></span>
							<?
							$i=0;
							foreach($arResult["postPreview"]["Category"] as $v)
							{
								if($i!=0)
									echo ",";
								?> <a href="<?=$v["urlToCategory"]?>"><?=$v["NAME"]?></a><?
								$i++;
							}
							?>
						</div>
						<?
					}
					?>
				</div>
			</div>
			<?
		}

		?>
		<form action="<?=POST_FORM_ACTION_URI?>" id=<?=$component->createPostFormId()?> name="REPLIER" method="post" enctype="multipart/form-data">
		<?=bitrix_sessid_post();?>
		<?
		if($arParams["USE_AUTOSAVE"] == "Y")
		{
			$as = new CAutoSave();
			$as->Init(false);
			?>
			<script>
			BX.message({'BLOG_POST_AUTOSAVE':'<?=GetMessage("BLOG_POST_AUTOSAVE")?>'});
			</script>
			<?
		}
		?>





            <div class="row">
                <div class="col-lg-12">

                    <!-- Basic layout-->
                    <div class="card">

                        <div class="card-body">
                            <div class="form-group">
                                <label>Тема петиции</label>
                                <input maxlength="255" size="70" tabindex="1" type="text" name="POST_TITLE" id="POST_TITLE" class="feed-add-post-inp feed-add-post-inp-active form-control" value="<?=$arResult["PostToShow"]["TITLE"]?>">
                            </div>


                                <div class="form-group">

                                    <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/neweditor.php"); ?>
                                    <input type="hidden" name="USE_NEW_EDITOR" value="Y">
                                    <div style="width:0; height:0; overflow:hidden;"><input type="text" tabindex="3" onFocus="window.oBlogLHE.SetFocus()" name="hidden_focus"></div>

                                </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
            <?if($arResult["POST_PROPERTIES"]["SHOW"] == "Y"):?>
                    <?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):
                        if($FIELD_NAME=="UF_BLOG_POST_DOC" || $FIELD_NAME=="UF_SECTION") continue;

                        ?>

                            <?$APPLICATION->IncludeComponent(
                                "bitrix:system.field.edit",
                                $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?>
                    <?endforeach;?>
                <div class="blog-clear-float"></div>
            <?endif;?>
            </div>
            </div>


            <div class="feed-buttons-block">
                <input type="hidden" name="save" value="Y">
                <input tabindex="5" type="submit" name="save" class="btn btn-primary ml-1" value="<?=GetMessage("BLOG_PUBLISH")?>">

                <input type="hidden" name="blog_upload_cid" id="upload-cid" value="">
            </div>





		</form>

		<script>
		<!--
		document.REPLIER.POST_TITLE.focus();
		//-->
		</script>
		<?
}
?>
