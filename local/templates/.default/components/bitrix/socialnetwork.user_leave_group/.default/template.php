<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$component = $this->getComponent();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI;

UI\Extension::load("ui.buttons");
UI\Extension::load("ui.alerts");
UI\Extension::load("socialnetwork.common");

if ($arResult["NEED_AUTH"] == "Y")
{
	$APPLICATION->AuthForm("");
}
elseif (strlen($arResult["FatalError"])>0)
{
	?><span class='text-muted'><?=$arResult["FatalError"]?></span><?
}
else
{
	if(strlen($arResult["ErrorMessage"])>0)
	{
		?><span class='text-muted'><?=$arResult["ErrorMessage"]?></span><?
	}

	if ($arResult["ShowForm"] == "Input")
	{
		/*?><script>
			BX.ready(function() {
				BX.BXSULG.init({
					groupId: <?=intval($arResult["Group"]["ID"])?>,
					errorBlockName: 'sonet_group_user_leave_error_block<?=intval($arResult["Group"]["ID"])?>'
				});
			});
		</script><?*/

		?><div id="sonet_group_user_leave_error_block-<?=intval($arResult["Group"]["ID"])?>" class="ui-alert ui-alert-xs ui-alert-danger ui-alert-icon-danger<?=(strlen($arResult["ErrorMessage"]) > 0 ? "" : " sonet-ui-form-error-block-invisible")?>"><?=$arResult["ErrorMessage"]?></div><?
		?><div class="text-muted">
    <form method="post" id="sonet_group_user_leave_form-<?=$arResult["Group"]["ID"]?>" name="form-<?=$arResult["Group"]["ID"]?>" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
				<div class="sonet-slider-footer-fixed">
					<input type="hidden" name="SONET_GROUP_ID" value="<?=$arResult["Group"]["ID"] ?>">
					<input type="hidden" name="ajax_request" value="N">
                    <input type="hidden" name="save" value="N">
					<?=bitrix_sessid_post()?>
					<span class=""><?
						?><button class="btn btn-outline-danger" type="submit" id="sonet_group_user_leave_button_submit-<?=$arResult["Group"]["ID"]?>"><?=Loc::getMessage($arResult["Group"]["PROJECT"] == "Y" ? "SONET_C37_T_SAVE_PROJECT" : "SONET_C37_T_SAVE") ?></button> <?
						?></span><? // class="sonet-ui-btn-cont"
				?></div><? // sonet-slider-footer-fixed
			?></form><?
		?></div><?
	}
	else
	{
		?><?= GetMessage("SONET_C37_T_SUCCESS") ?><?
		if ($arResult["CurrentUserPerms"]["UserCanSeeGroup"])
		{
			?><a href="<?= $arResult["Urls"]["Group"] ?>"><?= $arResult["Group"]["NAME"]; ?></a><?
		}
	}
}
?>