<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_multiselect.js");
Asset::getInstance()->addJs("/local/assets/js/app.js");

?>
<div class="row">
<div class="col-lg-12">
<div class="card">

<?
if($arResult["strProfileError"]) {
    echo "<div class=\"alert alert-danger border-0 alert-dismissible\">";
    echo $arResult["strProfileError"];
    echo "</div>";
}
?>

<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=$arResult["FORM_TARGET"]?>">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table class="profile-table data-table">
	<tbody>
		<tr>
			<td><?echo GetMessage("main_profile_code")?><span class="starrequired">*</span></td>
			<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
		</tr>
	</tbody>
</table>

<p><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_profile_send")?>" /></p>

</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_profile_resend',
	errorContainerId: 'bx_profile_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_profile_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_profile_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_profile_resend"></div>

<?else:?>

<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

<div  id="user_div_reg" class="table-responsive">
<table class="table table-scrollable table-striped">
	<tbody>


	<tr>
		<td><?=GetMessage('NAME')?></td>
		<td><input type="text" class="form-control" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('LAST_NAME')?></td>
		<td><input type="text"  class="form-control" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('LOGIN')?><span class="starrequired">*</span></td>
		<td><input type="text"  class="form-control" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></td>
		<td><input type="text"  class="form-control" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></td>
	</tr>
<?if($arResult["PHONE_REGISTRATION"]):?>
	<tr>
		<td><?echo GetMessage("main_profile_phone_number")?><?if($arResult["PHONE_REQUIRED"]):?><span class="starrequired">*</span><?endif?></td>
		<td><input type="text"  class="form-control" name="PHONE_NUMBER" maxlength="50" value="<? echo $arResult["arUser"]["PHONE_NUMBER"]?>" /></td>
	</tr>
<?endif?>
<?if($arResult['CAN_EDIT_PASSWORD']):?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_REQ')?></td>
		<td><input type="password"  class="form-control" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
		</td>
	</tr>
<?endif?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_CONFIRM')?></td>
		<td><input type="password"  class="form-control" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></td>
	</tr>
<?endif?>
<?if($arResult["TIME_ZONE_ENABLED"] == true):?>
	<tr>
		<td colspan="2" class="profile-header"><?echo GetMessage("main_profile_time_zones")?></td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_auto")?></td>
		<td>
			<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
		<td>
			<select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
				<option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
<?endforeach?>
			</select>
		</td>
	</tr>

<?endif?>




    <tr>
        <td><?=GetMessage("USER_PHOTO")?></td>
        <td>
            <?=$arResult["arUser"]["PERSONAL_PHOTO_INPUT"]?>
            <?
            if (strlen($arResult["arUser"]["PERSONAL_PHOTO"])>0)
            {
                ?>
                <br />
                <?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>
                <?
            }
            ?></td>
    </tr>



	<?// ********************* User properties ***************************************************?>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name"><?//pr($arUserField)?>
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
                <?=$arUserField["EDIT_FORM_LABEL"]?>:
                <?if($FIELD_NAME=="UF_THEMATICS"):?>
                <i class="icon-question text-secondary  font-size-lg icon-question4"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$arUserField["HELP_MESSAGE"]?>' ></i>
                <?endif;?></td><td class="field-value">
				<?$arUserField['USER_TYPE']['USE_FIELD_COMPONENT'] = 0;

                $APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
		<?endforeach;?>

        <tr>
            <td>Биография: <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='Расскажите подробнее о себе, о своем практическом опыте, о своих достижениях. Если вы хотите, чтобы другие граждане делегировали вам свой голос, постарайтесь убедить их в вашей компетентности.' ></i></td>
            <td><textarea class="form-control"  cols="30" rows="10" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea></td>
        </tr>


	<?// ******************** /User properties ***************************************************?>

    <?if($arResult["IS_ADMIN"]):?>

                <tr>
                    <td><?=GetMessage("USER_ADMIN_NOTES")?>:</td>
                    <td><textarea cols="30" rows="5" class="form-control" name="ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea></td>
                </tr>
    <?endif;?>

    <tr>
        <td colspan="2">

        <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<p><input type="submit" class="btn btn-primary" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<input type="reset" class="btn btn-secondary"  value="<?=GetMessage('MAIN_RESET');?>"></p>
        </td>
    </tr>

    <?
    if($arResult["SOCSERV_ENABLED"])
    {
        ?><tr>
        <td colspan="2"><?
        $APPLICATION->IncludeComponent(
            "bitrix:socserv.auth.split",
            ".default",
            array(
                "SHOW_PROFILES" => "Y",
                "ALLOW_DELETE" => "Y",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );
        ?>
        </td>
        </tr>
            <?
    }
    ?>

    <?endif?>

    </tbody>
</table>
</div>

</form>


</div>
</div>
</div>