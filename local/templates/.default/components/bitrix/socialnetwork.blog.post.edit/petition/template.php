<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\UI;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Socialnetwork\Integration\Calendar\ApiVersion;

$APPLICATION->SetAdditionalCSS('/bitrix/components/bitrix/socialnetwork.log.ex/templates/.default/style.css');
$APPLICATION->SetAdditionalCSS('/bitrix/components/bitrix/socialnetwork.blog.blog/templates/.default/style.css');

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_multiselect.js");
Asset::getInstance()->addJs("/local/assets/js/app.js");


$arParams["FORM_ID"] = "blogPostForm";
$jsObjName = "oPostFormLHE_".$arParams["FORM_ID"];
$id = "idPostFormLHE_".$arParams["FORM_ID"];

UI\Extension::load(["ui.buttons", "sidepanel"]);

$arResult["SHOW_FULL_FORM"]=true;


if (in_array('tasks', $arResult['tabs']))
{
	CModule::IncludeModule('tasks');
	CJSCore::Init(array('tasks_component', 'tasks_integration_socialnetwork'));
}

if (in_array('lists', $arResult['tabs']))
{
	CJSCore::Init(array('lists'));
}

CJSCore::Init(array('videorecorder', 'ui_date'));

if($arResult["delete_blog_post"] == "Y")
{
	$APPLICATION->RestartBuffer();
	if (!empty($arResult["ERROR_MESSAGE"]))
	{
		?>
		<script bxrunfirst="yes">
			top.deletePostEr = 'Y';
		</script>
		<div class="feed-add-error">
			<span class="feed-add-info-icon"></span><span class="feed-add-info-text"><?=$arResult["ERROR_MESSAGE"]?></span>
		</div>
		<?
	}
	if(!empty($arResult["OK_MESSAGE"]))
	{
		?><div class="feed-add-successfully">
			<span class="feed-add-info-text"><span class="feed-add-info-icon"></span><?=$arResult["OK_MESSAGE"]?></span>
		</div><?
	}
	die();
}

if(!empty($arResult["FATAL_MESSAGE"]))
{
	ob_start();

	?><div class="feed-add-error">
		<span class="feed-add-info-text"><span class="feed-add-info-icon"></span><?=$arResult["FATAL_MESSAGE"]?></span>
	</div><?

	$strFullForm = ob_get_contents();
	ob_end_clean();

	if ($_POST["action"] == "SBPE_get_full_form")
	{
		while (ob_end_clean());

		echo CUtil::PhpToJSObject(array(
			"PROPS" => array(
				"CONTENT" => $strFullForm,
				"STRINGS" => array(),
				"JS" => array(),
				"CSS" => array()
			),
			"success" => true
		));
		die();
	}
	else
	{
		echo $strFullForm;
	}

	return false;
}

?>








<div class="feed-wrap">
	<div id="feed-add-post-block<?=$arParams["FORM_ID"]?>" class="feed-add-post-block blog-post-edit"><?
if (!empty($arResult["OK_MESSAGE"]) || !empty($arResult["ERROR_MESSAGE"]))
{
	?><div id="feed-add-post-form-notice-block<?=$arParams["FORM_ID"]?>" class="feed-notice-block" style="display:none;"><?
	if(!empty($arResult["OK_MESSAGE"]))
	{
		?><div class="feed-add-successfully">
			<span class="feed-add-info-icon"></span><span class="feed-add-info-text"><?=$arResult["OK_MESSAGE"]?></span>
		</div><?
	}
	if(!empty($arResult["ERROR_MESSAGE"]))
	{
		?><div class="feed-add-error">
			<span class="feed-add-info-icon"></span><span class="feed-add-info-text"><?=$arResult["ERROR_MESSAGE"]?></span>
		</div><?
	}
	?></div><?
}
if(!empty($arResult["UTIL_MESSAGE"]))
{
	?>
	<div class="feed-add-successfully">
		<span class="feed-add-info-icon"></span><span class="feed-add-info-text"><?=$arResult["UTIL_MESSAGE"]?></span>
	</div>
	<?
}
else if($arResult["imageUploadFrame"] == "Y") // Frame with file input to ajax uploading in WYSIWYG editor dialog
{
	?><script type="text/javascript"><?
	if(!empty($arResult["Image"]))
	{
		?>
		var imgTable = top.BX('blog-post-image');
		if (imgTable)
		{
			imgTable.innerHTML += '<span class="feed-add-photo-block"><span class="feed-add-img-wrap"><?=$arResult["ImageModified"]?></span><span class="feed-add-img-title"><?=$arResult["Image"]["fileName"]?></span><span class="feed-add-post-del-but" onclick="DeleteImage(\'<?=$arResult["Image"]["ID"]?>\', this)"></span><input type="hidden" id="blgimg-<?=$arResult["Image"]["ID"]?>" value="<?=$arResult["Image"]["source"]["src"]?>"></span>';
			imgTable.parentNode.parentNode.style.display = 'block';
		}

		top.bxPostFileId = '<?=$arResult["Image"]["ID"]?>';
		top.bxPostFileIdSrc = '<?=CUtil::JSEscape($arResult["Image"]["source"]["src"])?>';
		top.bxPostFileIdWidth = '<?=CUtil::JSEscape($arResult["Image"]["source"]["width"])?>';
		<?
	}
	elseif(strlen($arResult["ERROR_MESSAGE"]) > 0)
	{
		?>
		window.bxPostFileError = top.bxPostFileError = '<?=CUtil::JSEscape($arResult["ERROR_MESSAGE"])?>';
		<?
	}
	?></script><?
	die();
}
else
{
	$userOption = CUserOptions::GetOption("socialnetwork", "postEdit");
	$bShowTitle = (($arResult["PostToShow"]["MICRO"] != "Y" && !empty($arResult["PostToShow"]["TITLE"])) ||
			(isset($userOption["showTitle"]) && $userOption["showTitle"] == "Y" && $arResult["PostToShow"]["MICRO"] != "Y"));


	$htmlAfterTextarea = "";
	if (!empty($arResult["Images"]))
	{
		$arFile = reset($arResult["Images"]);
		$arJSFiles = array();
		while ($arFile)
		{
			$arJSFiles[strVal($arFile["ID"])] = array(
				"element_id" => $arFile["ID"],
				"element_name" => $arFile["FILE_NAME"],
				"element_size" => $arFile["FILE_SIZE"],
				"element_url" => $arFile["URL"],
				"element_content_type" => $arFile["CONTENT_TYPE"],
				"element_thumbnail" => $arFile["SRC"],
				"element_image" => $arFile["THUMBNAIL"],
				"isImage" => (substr($arFile["CONTENT_TYPE"], 0, 6) == "image/"),
				"del_url" => $arFile["DEL_URL"]
			);
			$title = GetMessage("MPF_INSERT_FILE");
			$arFile["DEL_URL"] = CUtil::JSEscape($arFile["DEL_URL"]);
$htmlAfterTextarea .= <<<HTML
<span class="feed-add-photo-block" id="wd-doc{$arFile["ID"]}">
	<span class="feed-add-img-wrap" title="{$title}">
		<img src="{$arFile["THUMBNAIL"]}" border="0" width="90" height="90" />
	</span>
	<span class="feed-add-img-title" title="{$title}">{$arFile["NAME"]}</span>
	<span class="feed-add-post-del-but"></span>
</span>
HTML;
			$arFile = next($arResult["Images"]);
		}
		if ($htmlAfterTextarea !== "")
		{
			$arJSFiles = CUtil::PhpToJSObject($arJSFiles);
$htmlAfterTextarea .= <<<HTML
<script>window['{$id}Files']={$arJSFiles};</script>
HTML;
		}
	}

	?><div class="feed-add-post-micro" id="micro<?=$jsObjName?>" <?
		?>onclick="

		SBPEFullForm.getInstance().get({
			callback: function() {
				BX.onCustomEvent(BX('div<?=$jsObjName?>'), 'OnControlClick');
				if(BX('div<?=$jsObjName?>').style.display=='none')
				{
					BX.onCustomEvent(BX('div<?=$jsObjName?>'), 'OnShowLHE', ['show']);
				}
			}
		});

		"><div id="micro<?=$jsObjName?>_inner"><?
			?><span class="feed-add-post-micro-title"><?=GetMessage("BLOG_LINK_SHOW_NEW")?></span><?
			?><span class="feed-add-post-micro-dnd"><?=GetMessage("MPF_DRAG_ATTACHMENTS2")?></span><?
		?></div><?
	?></div><?

	if (
		$arParams["LAZY_LOAD"] == 'Y'
		&& !$arResult["SHOW_FULL_FORM"]
	) // lazyloadmode on + not ajax
	{
		?><div id="full<?=$jsObjName?>"></div><?
	}

	?><script>
		BX.message({
			sonetBPECreateTaskSuccessTitle : '<?=GetMessageJS("BLOG_POST_EDIT_T_CREATE_TASK_SUCCESS_TITLE")?>',
			sonetBPECreateTaskSuccessDescription : '<?=GetMessageJS("BLOG_POST_EDIT_T_CREATE_TASK_SUCCESS_DESCRIPTION")?>',
			sonetBPECreateTaskButtonTitle : '<?=GetMessageJS("BLOG_POST_EDIT_T_CREATE_TASK_BUTTON_TITLE")?>',
			PATH_TO_USER_TASKS_TASK : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_TASKS_TASK'])?>',
			SBPE_MORE : '<?=GetMessageJS("SBPE_MORE")?>'
		});

		SBPEFullForm.getInstance().init({
			lazyLoad: <?=(!$arResult["SHOW_FULL_FORM"] ? 'true' : 'false')?>,
			ajaxUrl : '<?=CUtil::JSEscape(htmlspecialcharsBack(POST_FORM_ACTION_URI))?>',
			container: <?=(!$arResult["SHOW_FULL_FORM"] ? "BX('full".$jsObjName."')" : "false")?>,
			containerMicro: <?=(!$arResult["SHOW_FULL_FORM"] ? "BX('micro".$jsObjName."')" : "false")?>,
			containerMicroInner: <?=(!$arResult["SHOW_FULL_FORM"] ? "BX('micro".$jsObjName."_inner')" : "false")?>
		});
	</script><?

	$dynamicArea = new \Bitrix\Main\Page\FrameStatic("sbpe_dynamic");
	$dynamicArea->startDynamicArea();
	?><script>
		BX.ready(function() {
			<?
			if (
				in_array('tasks', $arResult['tabs'])
				&& isset($_SESSION["SL_TASK_ID_CREATED"])

			)
			{
				if (intval($_SESSION["SL_TASK_ID_CREATED"]) > 0)
				{
					?>
					window.SBPEFullForm.getInstance().tasksTaskEvent(<?=intval($_SESSION["SL_TASK_ID_CREATED"])?>);
					<?
				}
				unset($_SESSION["SL_TASK_ID_CREATED"]);
			}
			?>
			SBPEFullForm.getInstance().setOption('startVideoRecorder', '<?=($arResult['startVideoRecorder'] ? 'Y' : 'N')?>');
			SBPEFullForm.getInstance().onShow();
		});
	</script><?
	$dynamicArea->finishDynamicArea();


	if ($arResult["SHOW_FULL_FORM"]) // lazyloadmode on + ajax
	{
		if ($_POST["action"] == "SBPE_get_full_form")
		{
			$APPLICATION->ShowAjaxHead();
		}

		$postFormActionUri = (isset($arParams["POST_FORM_ACTION_URI"]) ? $arParams["POST_FORM_ACTION_URI"] : htmlspecialcharsback(POST_FORM_ACTION_URI));
		$uri = new Bitrix\Main\Web\Uri($postFormActionUri);
		$uri->deleteParams(array("b24statAction", "b24statTab"));
		$uri->addParams(array(
			"b24statAction" => ($arParams["ID"] > 0 ? "editLogEntry" : "addLogEntry"),
		));
		$postFormActionUri = $uri->getUri();

		$selectorId = randString(6);

		?><div id="microblog-form">
		<form action="<?=htmlspecialcharsbx($postFormActionUri)?>" id="blogPostForm" name="blogPostForm" method="POST" enctype="multipart/form-data" target="_self" data-bx-selector-id="<?=htmlspecialcharsbx($selectorId)?>">
			<input type="hidden" name="show_title" id="show_title" value="Y">
        <input type="hidden" name="UF_STATUS" id="UF_STATUS" value="<?if($arParams["STATUS_ID"]){echo $arParams["STATUS_ID"];}else{echo "9";}?>">
			<?=bitrix_sessid_post();?>
			<div class="feed-add-post-form-wrap"><?
				/*if (
					$arParams["TOP_TABS_VISIBLE"] != "Y"
					&& (
						!isset($arParams["PAGE_ID"])
						|| !in_array($arParams["PAGE_ID"], [ "user_blog_post_edit_profile", "user_blog_post_edit_grat", "user_grat", "user_blog_post_edit_post" ])
					)
				)
				{
					?><div class="feed-add-post-form-variants" id="feed-add-post-form-tab"><?
						echo $strGratVote;

						if ($arParams["SHOW_BLOG_FORM_TARGET"])
						{
							$APPLICATION->ShowViewContent("sonet_blog_form");
						}
						?><div id="feed-add-post-form-tab-arrow" class="feed-add-post-form-arrow" style="left: 31px;"></div><?
					?></div><?
				}*/

				?>


                        <div class="row">
                            <div class="col-lg-12">

                                <!-- Basic layout-->
                                <div class="card">

                                    <div class="card-header header-elements-inline" id="blog-title">
                                        <h5 class="card-title">Добавить петицию</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-danger mb-2">Все поля обязательны к заполнению</div>
                                        <div class="form-group">
                                            <label>Тема петиции</label>

                                            <input id="POST_TITLE" name="POST_TITLE"
                                                   class="feed-add-post-inp feed-add-post-inp-active form-control" <?
                                                   ?>type="text" value="<?= $arResult["PostToShow"]["TITLE"] ?>"
                                                   placeholder="Тема петиции"/>

                                        </div>


                                        <?
                                        $arPostField = $arResult["POST_PROPERTIES"]["DATA"]["UF_THEMATICS"];
                                        $FIELD_NAME="UF_THEMATICS";

                                        echo "<div class='form-group'><label>Тематики законодательства</label>";
                                        $arPostField['USER_TYPE']['USE_FIELD_COMPONENT'] = 0;
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:system.field.edit",
                                            $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                            array("arUserField" => $arPostField), null, array("HIDE_ICONS" => "Y"));
                                       echo "</div>";



                                    $arPostField = $arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_FILE"];
                                    $FIELD_NAME="UF_BLOG_POST_FILE";

                                    echo "<div class='form-group'><label>Изображение (формат JPG, PNG, не более 1 МБ)</label>";
                                    ?>

                                    <input type="hidden" name="<?= $FIELD_NAME ?>_old_id"
                                           value="<?= $arPostField[VALUE] ?>"/>

                                        <?= CFile::InputFile($FIELD_NAME, 0, $arPostField[VALUE], false, 1000000, "IMAGE", "class=\"form-control h-auto\"", 0, "", ' value="' . $arPostField[VALUE] . '"', true, true);

                                        echo "</div>";
                                    ?>

                                <?$APPLICATION->IncludeComponent(
						"bitrix:main.post.form",
						"",
						($formParams = Array(
							"FORM_ID" => "blogPostForm",
							"DEST_SELECTOR_ID" => $selectorId,
							"SHOW_MORE" => "Y",
							"PARSER" => Array("Bold", "Italic", "Underline", "Strike", "ForeColor",
								"FontList", "FontSizeList", "RemoveFormat", "Quote", "Code",
								(($arParams["USE_CUT"] == "Y") ? "InsertCut" : ""),
								"CreateLink",
								"Image",
								"Table",
								"Justify",
								"InsertOrderedList",
								"InsertUnorderedList",
								"SmileList",
								"Source",
								"UploadImage",
								(($arResult["allowVideo"] == "Y") ? "InputVideo" : ""),
								"MentionUser",
							),
							"BUTTONS" => Array(
								/*"UploadImage",
								"UploadFile",
								"CreateLink",
								(($arResult["allowVideo"] == "Y") ? "InputVideo" : ""),
								"Quote",
								"MentionUser",*/
								//"InputTag",
								//"VideoMessage",
	//						,"Important"
							),
							"BUTTONS_HTML" => Array("VideoMessage" => '<span class="feed-add-post-form-but-cnt feed-add-videomessage" onclick="BX.VideoRecorder.start(\''.$arParams["FORM_ID"].'\', \'post\');">'.GetMessage('BLOG_VIDEO_RECORD_BUTTON').'</span>'),
							/*"ADDITIONAL" => array(
								"<span title=\"".GetMessage("BLOG_TITLE")."\" ".
								"onclick=\"showPanelTitle_".$arParams["FORM_ID"]."(this);\" ".
								"class=\"feed-add-post-form-title-btn".($bShowTitle ? " feed-add-post-form-btn-active" : "")."\" ".
								"id=\"lhe_button_title_".$arParams["FORM_ID"]."\" ".
								"></span>"
							),*/

							"TEXT" => Array(
								"NAME" => "POST_MESSAGE",
								"VALUE" => \Bitrix\Main\Text\Emoji::decode(htmlspecialcharsBack($arResult["PostToShow"]["~DETAIL_TEXT"])),
								"HEIGHT" => "120px"),

							"PROPERTIES" => array(
								/*array_key_exists("UF_BLOG_POST_FILE", $arResult["POST_PROPERTIES"]["DATA"]) ?
									array_merge(
										(is_array($arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_FILE"]) ? $arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_FILE"] : array()),
										($arResult['bVarsFromForm'] && is_array($_POST["UF_BLOG_POST_FILE"]) ? array("VALUE" => $_POST["UF_BLOG_POST_FILE"]) : array()))
									:
									array_merge(
										(is_array($arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_DOC"]) ? $arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_DOC"] : array()),
										($arResult['bVarsFromForm'] && is_array($_POST["UF_BLOG_POST_DOC"]) ? array("VALUE" => $_POST["UF_BLOG_POST_DOC"]) : array()),
										array("POSTFIX" => "file")),*/
								array_key_exists("UF_BLOG_POST_URL_PRV", $arResult["POST_PROPERTIES"]["DATA"]) ?
									array_merge(
										$arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_URL_PRV"],
										array(
											'ELEMENT_ID' => 'url_preview_'.$id,
											'STYLE' => 'margin: 0 18px'
										)
									)
									:
									array(),
							),
							"UPLOAD_FILE_PARAMS" => array('width' => $arParams["IMAGE_MAX_WIDTH"], 'height' => $arParams["IMAGE_MAX_HEIGHT"]),

							"DESTINATION" => array(
								"VALUE" => $arResult["PostToShow"]["FEED_DESTINATION"],
								"SHOW" => (!isset($arParams["PAGE_ID"]) || $arParams["PAGE_ID"] != "user_blog_post_edit_profile" ? 'Y' : 'N')
							),
							"DEST_SORT" => $arResult["DEST_SORT"],
							"SELECTOR_CONTEXT" => "BLOG_POST",
							/*"TAGS" => Array(
								"ID" => "TAGS",
								"NAME" => "TAGS",
								"VALUE" => explode(",", trim($arResult["PostToShow"]["CategoryText"])),
								"USE_SEARCH" => "Y",
								"FILTER" => "blog",
							),*/
							"SMILES" => COption::GetOptionInt("blog", "smile_gallery_id", 0),
							"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
							"AT_THE_END_HTML" => $htmlAfterTextarea,
							"LHE" => array(
								"id" => $id,
								"documentCSS" => "body {color:#434343;}",
								"iframeCss" => "html body {font-size: 14px!important; line-height: 20px!important;}",
								"ctrlEnterHandler" => "submitBlogPostForm",
								"jsObjName" => $jsObjName,
								"fontFamily" => "'Helvetica Neue', Helvetica, Arial, sans-serif",
								"fontSize" => "14px",
								"bInitByJS" => (!$arResult['bVarsFromForm'] && $arParams["TOP_TABS_VISIBLE"] == "Y")
							),
							"USE_CLIENT_DATABASE" => "Y",
							"DEST_CONTEXT" => "BLOG_POST",
							"ALLOW_EMAIL_INVITATION" => ($arResult["ALLOW_EMAIL_INVITATION"] ? 'Y' : 'N')
						)),
						false,
						Array("HIDE_ICONS" => "Y")
					);?>







				<?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField)
				{
                    $arPostField['USER_TYPE']['USE_FIELD_COMPONENT'] = 0;

					if(in_array($FIELD_NAME, $arParams["POST_PROPERTY_SOURCE"]))
					{
					    if(false/*$FIELD_NAME=="UF_BLOG_POST_VOTE"*/)
                        {
                            echo "<label>Решение проблемы</label>";

                            $APPLICATION->IncludeComponent(
                            "bitrix:system.field.edit",
                            $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                            array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));

                        }

                                    elseif ($FIELD_NAME == "UF_STATUS")
                                    {
                                    echo "<label>Статус</label><div class='form-group'>";
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:system.field.edit",
                                        $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                        array("arUserField" => $arPostField), null, array("HIDE_ICONS" => "Y"));
                                        echo "</div>";
                                }
                                elseif ($FIELD_NAME == "UF_STATUS_DATE" && $USER->IsAdmin())
                                {
                                echo "<label><?=$FIELD_NAME?></label><div class='form-group'>";
                                $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("arUserField" => $arPostField), null, array("HIDE_ICONS" => "Y"));
                                    echo "</div>";
                                }
                                elseif ($FIELD_NAME == "UF_DECISION")
                                {
                                echo "<label>Решение проблемы</label><div class='form-group'>";
                                    $arPostField['USER_TYPE']['USE_FIELD_COMPONENT'] = 0;
                                    $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("arUserField" => $arPostField), null, array("HIDE_ICONS" => "Y"));
                                echo "</div>";
                            }

                            /*elseif ($FIELD_NAME == "UF_THEMATICS")
                            {
                            echo "<label><?=$FIELD_NAME?></label><div class='form-group'>";
                            $APPLICATION->IncludeComponent(
                                "bitrix:system.field.edit",
                                $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                array("arUserField" => $arPostField), null, array("HIDE_ICONS" => "Y"));
                            ?></div><?
                            }*/
					}
				}?>



			<?	/*if (in_array('calendar', $arResult['tabs']))
				{
					?>
					<div id="feed-add-post-content-calendar" style="display: none;">
						<?
						$APPLICATION->IncludeComponent("bitrix:calendar.livefeed.edit", '',
							array(
								"EVENT_ID" => '',
								"UPLOAD_FILE" => (!empty($arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_FILE"]) ? false : $arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_DOC"]),
								"UPLOAD_WEBDAV_ELEMENT" => $arResult["POST_PROPERTIES"]["DATA"]["UF_BLOG_POST_FILE"],
								"UPLOAD_FILE_PARAMS" => array('width' => $arParams["IMAGE_MAX_WIDTH"], 'height' => $arParams["IMAGE_MAX_HEIGHT"]),
								"FILES" => Array(
									"VALUE" => $arResult["Images"],
									"POSTFIX" => "file",
								),
								"DESTINATION" => array(
									"VALUE" => (isset($arResult["PostToShow"]["FEED_DESTINATION_CALENDAR"]) ? $arResult["PostToShow"]["FEED_DESTINATION_CALENDAR"] : $arResult["PostToShow"]["FEED_DESTINATION"]),
									"SHOW" => "Y"
								),
								"DEST_SORT" => (isset($arResult["DEST_SORT_CALENDAR"]) ? $arResult["DEST_SORT_CALENDAR"] : $arResult["DEST_SORT"]),
								"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"]

							), null, array("HIDE_ICONS"=>"Y"));
						?>
					</div>
					<?
				}*/

				/*if(in_array('lists', $arResult['tabs']))
				{
					?>
					<div id="feed-add-post-content-lists" style="display: none;">
						<?
						$APPLICATION->IncludeComponent("bitrix:lists.live.feed", "",
							array(
								"SOCNET_GROUP_ID" => $arParams["SOCNET_GROUP_ID"],
								"DESTINATION" => $arResult["PostToShow"],
								"IBLOCK_ID" => isset($_GET['bp_setting']) ? $_GET['bp_setting'] : 0
							), null, array("HIDE_ICONS" => "Y")
						);
						?>
					</div>
					<?
				}

				if(in_array('tasks', $arResult['tabs']))
				{
					?><div id="feed-add-post-content-tasks" style="display: none;"><div id="feed-add-post-content-tasks-container"><?

						$taskSubmitted = false;

						if (
							isset($_REQUEST['ACTION'])
							&& is_array($_REQUEST['ACTION'])
						)
						{
							foreach ($_REQUEST['ACTION'] as $taskAction)
							{
								if (
									!empty($taskAction['OPERATION'])
									&& $taskAction['OPERATION'] == 'task.add'
									&& CModule::IncludeModule('tasks')
								)
								{
									$taskSubmitted = true;
									break;
								}
							}
						}

						if ($taskSubmitted)
						{
							CTaskNotifications::enableSonetLogNotifyAuthor();

							$componentParameters = array(
								'ID' => 0,
								'GROUP_ID' => $arParams['SOCNET_GROUP_ID'],
								'PATH_TO_USER_PROFILE' => $arParams['PATH_TO_USER_PROFILE'],
								'PATH_TO_GROUP' => $arParams['PATH_TO_GROUP'],
								'PATH_TO_USER_TASKS' => $arParams['PATH_TO_USER_TASKS'],
								'PATH_TO_USER_TASKS_TASK' => $arParams['PATH_TO_USER_TASKS_TASK'],
								'PATH_TO_GROUP_TASKS' => $arParams['PATH_TO_GROUP_TASKS'],
								'PATH_TO_GROUP_TASKS_TASK' => $arParams['PATH_TO_GROUP_TASKS_TASK'],
								'PATH_TO_USER_TASKS_PROJECTS_OVERVIEW' => $arParams['PATH_TO_USER_TASKS_PROJECTS_OVERVIEW'],
								'PATH_TO_USER_TASKS_TEMPLATES' => $arParams['PATH_TO_USER_TASKS_TEMPLATES'],
								'PATH_TO_USER_TEMPLATES_TEMPLATE' => $arParams['PATH_TO_USER_TEMPLATES_TEMPLATE'],
								'SET_NAVCHAIN' => 'N',
								'SET_TITLE' => 'N',
								'SHOW_RATING' => 'N',
								'NAME_TEMPLATE' => $arParams["NAME_TEMPLATE"],
								'ENABLE_FOOTER' => 'N',
								'ENABLE_MENU_TOOLBAR' => 'N',
								'SUB_ENTITY_SELECT' => array(
									'TAG',
									'CHECKLIST',
									'REMINDER',
									'PROJECTDEPENDENCE',
									'TEMPLATE',
									'RELATEDTASK'
								), // change to API call
								'AUX_DATA_SELECT' => array(
									'COMPANY_WORKTIME',
									'USER_FIELDS',
									'TEMPLATE'
								), // change to API call
								'BACKURL' => $arParams['TASK_SUBMIT_BACKURL']
							);

							$APPLICATION->IncludeComponent('bitrix:tasks.task', '',
								$componentParameters,
								null,
								array("HIDE_ICONS" => "Y")
							);

							CTaskNotifications::disableSonetLogNotifyAuthor();
						}
						?></div></div><?
				}*/

				?>
				<script type="text/javascript">
					BX.message({
						'BLOG_TITLE' : '<?=GetMessageJS("BLOG_TITLE")?>',
						'BLOG_TAB_GRAT': '<?=GetMessageJS("BLOG_TAB_GRAT")?>',
						'BLOG_TAB_VOTE': '<?=GetMessageJS("BLOG_TAB_VOTE")?>',
						'SBPE_IMPORTANT_MESSAGE': '<?=GetMessageJS("SBPE_IMPORTANT_MESSAGE")?>',
						'BLOG_POST_AUTOSAVE':'<?=GetMessageJS("BLOG_POST_AUTOSAVE")?>',
						'BLOG_POST_AUTOSAVE2' : '<?=GetMessageJS("BLOG_POST_AUTOSAVE2")?>',
						'SBPE_CALENDAR_EVENT': '<?=GetMessageJS("SBPE_CALENDAR_EVENT")?>',
						'LISTS_CATALOG_PROCESSES_ACCESS_DENIED' : '<?=GetMessageJS("LISTS_CATALOG_PROCESSES_ACCESS_DENIED")?>'
					});
					<?
					if(in_array('tasks', $arResult['tabs']))
					{
						?>
						BX.message({
							'TASK_SOCNET_GROUP_ID' : <?=intval($arParams['SOCNET_GROUP_ID'])?>,
							'PATH_TO_USER_PROFILE' : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_PROFILE'])?>',
							'PATH_TO_GROUP' : '<?=CUtil::JSEscape($arParams['PATH_TO_GROUP'])?>',
							'PATH_TO_USER_TASKS' : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_TASKS'])?>',
							'PATH_TO_GROUP_TASKS' : '<?=CUtil::JSEscape($arParams['PATH_TO_GROUP_TASKS'])?>',
							'PATH_TO_GROUP_TASKS_TASK' : '<?=CUtil::JSEscape($arParams['PATH_TO_GROUP_TASKS_TASK'])?>',
							'PATH_TO_USER_TASKS_PROJECTS_OVERVIEW' : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_TASKS_PROJECTS_OVERVIEW'])?>',
							'PATH_TO_USER_TASKS_TEMPLATES' : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_TASKS_TEMPLATES'])?>',
							'PATH_TO_USER_TEMPLATES_TEMPLATE' : '<?=CUtil::JSEscape($arParams['PATH_TO_USER_TEMPLATES_TEMPLATE'])?>',
							'LOG_EXPERT_MODE' : '<?=(isset($arParams["LOG_EXPERT_MODE"]) ? CUtil::JSEscape($arParams['LOG_EXPERT_MODE']) : 'N')?>',
							'TASK_SUBMIT_BACKURL' : '<?=CUtil::JSEscape($arParams['TASK_SUBMIT_BACKURL'])?>'
						});
						<?
					}
					?>
					BX.SocnetBlogPostInit('<?=$arParams["FORM_ID"]?>', {
						editorID : '<?=$id?>',
						showTitle : '<?=$bShowTitle?>',
						autoSave : '<?=(COption::GetOptionString("blog", "use_autosave", "Y") == "Y" ? ($arParams["ID"] > 0 ? "onDemand" : "Y") : 'N')?>',
						activeTab : '<?=($arResult['bVarsFromForm'] || $arParams["ID"] > 0 ? CUtil::JSEscape($arResult['tabActive']) : '')?>',
						text : '<?=CUtil::JSEscape($formParams["TEXT"]["VALUE"])?>',
						restoreAutosave : <?=(empty($arResult["ERROR_MESSAGE"]) ? 'true' : 'false')?>
					});
				</script>
				<?
				if(COption::GetOptionString("blog", "use_autosave", "Y") == "Y")
				{
					$dynamicArea = new \Bitrix\Main\Page\FrameStatic("post-autosave");
					$dynamicArea->startDynamicArea();
					$as = new CAutoSave();
					$as->Init(false);
					$dynamicArea->finishDynamicArea();
				}
				$arButtons = Array(
					Array(
						"NAME" => "save",
						"TEXT" => GetMessage(!empty($arResult["Post"]) && !empty($arResult["Post"]["PUBLISH_STATUS"]) && $arResult["Post"]["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_DRAFT ? "BLOG_BUTTON_PUBLISH" : "BLOG_BUTTON_SEND"),
						"CLICK" => "submitBlogPostForm();",
					),
				);

				if(
					$arParams["MICROBLOG"] != "Y"
					&& !in_array($arParams["PAGE_ID"], [ "user_blog_post_edit_profile", "user_blog_post_edit_grat", "user_grat", "user_blog_post_edit_post" ])
				)
				{
					/*$arButtons[] = Array(
						"NAME" => "draft",
						"TEXT" => GetMessage("BLOG_BUTTON_DRAFT")
					);*/
				}
				else
				{
					$arButtons[] = Array(
						"NAME" => "cancel",
						"TEXT" => GetMessage("BLOG_BUTTON_CANCEL"),
						"CLICK" => "window.SBPETabs.getInstance().collapse({ userId: ".intval($arParams['USER_ID'])."})",
						"CLEAR_CANCEL" => "Y",
					);
				}

				?><div class="" id="feed-add-buttons-block<?=$arParams["FORM_ID"]?>" style="display:none;"><?
					$scriptFunc = array();
					foreach($arButtons as $val)
					{
						$onclick = $val["CLICK"];
						if(strlen($onclick) <= 0)
							$onclick = "submitBlogPostForm('".$val["NAME"]."'); ";
						$scriptFunc[$val["NAME"]] = $onclick;
						if($val["CLEAR_CANCEL"] == "Y")
						{
							?><button class="ui-btn ui-btn-lg ui-btn-link" id="blog-submit-button-<?=$val["NAME"]?>"><?=$val["TEXT"]?></button><?
						}
						else
						{
							?><button class="btn btn-primary" id="blog-submit-button-<?=$val["NAME"]?>"><?=$val["TEXT"]?>
                            <i class="icon-paperplane ml-2"></i>
                            </button><?
						}
					}
					if (!empty($scriptFunc))
					{
						?><script>BX.ready(function(){<?
						foreach ($scriptFunc as $id => $handler)
						{
							?>BX.bind(BX("blog-submit-button-<?=$id?>"), "click", function(e) {
								<?=$handler?>;
								return e.preventDefault();
							});<?
						}
						?>});
						</script><?
					}
				?></div>

                                    </div>
                                </div>
                            </div>
                        </div>



			<input type="hidden" name="blog_upload_cid" id="upload-cid" value="">
		</form><?
		?><div id="task_form_hidden" style="display: none;"></div><?
		?></div><?

		if ($_POST["action"] == "SBPE_get_full_form")
		{
			$strFullForm = ob_get_contents();
			while (ob_end_clean());

			$JSList = $stringsList = array();

			\Bitrix\Main\Page\Asset::getInstance()->getJs();
			$CSSStrings = \Bitrix\Main\Page\Asset::getInstance()->getCss();
			\Bitrix\Main\Page\Asset::getInstance()->getStrings();

			$targetTypeList = array('JS'/*, 'CSS'*/);
			foreach($targetTypeList as $targetType)
			{
				$targetAssetList = \Bitrix\Main\Page\Asset::getInstance()->getTargetList($targetType);

				foreach($targetAssetList as $targetAsset)
				{
					$assetInfo = \Bitrix\Main\Page\Asset::getInstance()->getAssetInfo($targetAsset['NAME'], \Bitrix\Main\Page\AssetMode::ALL);
					if (!empty($assetInfo['JS']))
					{
						$JSList = array_merge($JSList, $assetInfo['JS']);
					}
					if (!empty($assetInfo['STRINGS']))
					{
						$stringsList = array_merge($stringsList, $assetInfo['STRINGS']);
					}
				}
			}

			$JSList = array_unique($JSList);

			echo CUtil::PhpToJSObject(array(
				"PROPS" => array(
					"CONTENT" => $CSSStrings.implode('', $stringsList).$strFullForm,
					"STRINGS" => array(),
					"JS" => $JSList,
					"CSS" => array()
				),
				"success" => true
			));
			die();
		}
	}
}

?>

</div>
</div>
</div>
