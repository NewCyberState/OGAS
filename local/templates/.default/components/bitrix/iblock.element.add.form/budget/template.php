<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss()
global $USER;


Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/pies/pie.js");
Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/touch.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/sliders/slider_pips.min.js");
//Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/styling/switchery.min.js");
Asset::getInstance()->addJs("/local/assets/js/app.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/jqueryui_sliders.js");

$oldbudget = array(
    "SOCPOLITIKA" => 25.66,
    "DEFENCE" => 15.83,
    "ECONOMY" => 13.63,
    "SECURITY" => 12.46,
    "STATE" => 7.99,
    "DEBT" => 4.60,
    "SUBSIDY" => 5.18,
    "EDUCATION" => 4.68,
    "HEALTH" => 5.27,
    "CULTURE" => 0.74,
    "ECOLOGY" => 1.76,
    "MEDIA" => 0.49,
    "SPORT" => 0.38,
    "JKH" => 1.34,
);


if (!empty($arResult["ERRORS"])):?>
	<?//ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?//ShowNote($arResult["MESSAGE"])?>
<?endif?>

<script type="text/javascript">

    $(document).ready(function() {
        <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
        <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] != "Пользователь"):

        if($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]>0):?>

        $('[data-id=<?=$propertyID?>]').slider("value", <?=$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"];?> );

        <?else:?>

        $('[data-id=<?=$propertyID?>]').slider("value", <?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]?> );
        $('#input<?=$propertyID?>').val(<?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]?>);

        <?endif;?>
        <?endif;?>
        <?endforeach;?>

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    });




    function drawChart(d) {

        var w = $("#google-pie").parent().width();
        var h = $("#google-pie").parent().height();

        if(d === undefined)
        {
            var d=new Array();
            d.push(["Статья","Процент"]);
            <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
            <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]!="Пользователь"):

            if($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]>0):?>

                d.push(["<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]." (".$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]."%)";?>",<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"];?>]);

            <?else:?>

            d.push(["<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]." (".$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]."%)";?>",<?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]];?>]);

            <?endif;?>

            <?endif;?>
            <?endforeach;?>
        }
        console.log(d);

        var data = google.visualization.arrayToDataTable(d);

        var options = {
            is3D :true,
            //forceIFrame:true,
            width: w,
            height : h,
            legend : { textStyle : {color: 'black', fontSize: 12}},

        };

        var chart = new google.visualization.PieChart(document.getElementById('google-pie'));

        chart.draw(data,options);
    }


</script>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Мой бюджет</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p class="text-default">Укажите ваше предложение о распределении государственного бюджета на следующий год по статьям расходов и нажмите "Проголосовать". Ваш голос будет учтен при расчете распределения бюджета по статьям расходов. По умолчанию заданы параметры распределения бюджета на текущий год.</p>

                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h2>Мой бюджет</h2>

                <div class="chart-container text-center d-none d-md-block" style="width:100%;height: 500px;">
                    <div class="d-inline-block" id="google-pie"></div>
                </div>

                <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                    <?=bitrix_sessid_post()?>

                    <input type="hidden" name="PROPERTY[NAME][0]" size="30" value="<?=$USER->GetFullName()?>" />

                <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
                <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]!="Пользователь"):?>

                    <?$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"] : $arResult["ELEMENT"][$propertyID];?>



                        <input type="hidden" id="input<?=$propertyID?>" name="PROPERTY[<?=$propertyID?>][0]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" />

                <span class="mb-0 ml-1 font-weight-semibold"><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?></span>
                <div class="ui-slider-horizontal jui-slider-increments jui-slider-floats-labels  jui-slider-range-min ui-slider ui-corner-all ui-widget ui-widget-content" data-fouc="" data-text="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?>" data-id="<?=$propertyID?>">
                    <div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="left:<?=$value?>%"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left:<?=$value?>%"></span>
                    </div>
                        <br>
                <?endif;?>
                <?endforeach;?>


                    <input type="submit" class="btn btn-primary" name="iblock_submit" value="Проголосовать" />

                </form>



            </div>
        </div>
    </div>
</div>

<?/*?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
	<table class="data-table" style="width: 90%">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				<tr>
					<td><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></td>
					<td>
						<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br /><?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CHTMLEditor;
								$LHE->Show(array(
									'name' => "PROPERTY[".$propertyID."][0]",
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'width' => '100%',
									'minBodyWidth' => 350,
									'normalBodyWidth' => 555,
									'height' => '200',
									'bAllowPhp' => false,
									'limitPhpAccess' => false,
									'autoResize' => true,
									'autoResizeOffset' => 40,
									'useFileDialogs' => false,
									'saveOnBlur' => true,
									'showTaskbars' => false,
									'showNodeNavi' => false,
									'askBeforeUnloadPage' => true,
									'bbCode' => false,
									'siteId' => SITE_ID,
									'controlsMap' => array(
										array('id' => 'Bold', 'compact' => true, 'sort' => 80),
										array('id' => 'Italic', 'compact' => true, 'sort' => 90),
										array('id' => 'Underline', 'compact' => true, 'sort' => 100),
										array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
										array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
										array('id' => 'Color', 'compact' => true, 'sort' => 130),
										array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
										array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
										array('separator' => true, 'compact' => false, 'sort' => 145),
										array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
										array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
										array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
										array('separator' => true, 'compact' => false, 'sort' => 200),
										array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
										array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
										array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
										array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
										array('separator' => true, 'compact' => false, 'sort' => 290),
										array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
										array('id' => 'More', 'compact' => true, 'sort' => 400)
									),
								));
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" /><br /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><br /><?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>
					</td>
				</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
						>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
<?*/?>