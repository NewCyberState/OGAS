<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $globalpost,$globalgroup,$endvotes,$za,$protiv,$globalthematics,$globalvotes,$delegatetable;

if ($arParams["SHOW_RESULTS"] == "Y")
{
	$this->IncludeLangFile("result.php");
}
?>
<div class="card">

    <div class="card-header bg-white header-elements-lg-inline ">
        <h4 class="card-title font-weight-semibold mb-0">Результат голосования</h4>
    </div>

    <div class="card-body">

	<?$APPLICATION->IncludeComponent(
		"bitrix:voting.result",
		"2021",
		Array(
			"VOTE_ID" => $arResult["VOTE_ID"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"PERMISSION" => $arParams["PERMISSION"],
			"ADDITIONAL_CACHE_ID" => $arResult["ADDITIONAL_CACHE_ID"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"VOTE_ALL_RESULTS" => $arParams["VOTE_ALL_RESULTS"],
			"CAN_VOTE" => $arParams["CAN_VOTE"],
        "ELEMENT_ID" => $arParams["ELEMENT_ID"],
            "THEMATICS" => $arParams["THEMATICS"],
		"TAGS" => $arParams["TAGS"]),

		($this->__component->__parent ? $this->__component->__parent : $component),
		array("HIDE_ICONS" => "Y")
	);?>
	<?if ($arParams["SHOW_RESULTS"] = "Y" && $arParams["CAN_VOTE"] == "Y"):?>
			<span class="vote-form-box-button vote-form-box-button-single"><?
				?><a name="show_form" href="<?=$APPLICATION->GetCurPageParam("", array("VOTE_ID","VOTING_OK","VOTE_SUCCESSFULL", "view_result"))?>" <?
					?>><?=GetMessage("VOTE_BACK")?></a>
			</span>
	<?endif;?>

    </div>
</div>
