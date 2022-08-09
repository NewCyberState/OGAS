<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Данные предприятия</legend>

	<?foreach($arResult["FIELDS"] as $code=>$value):
        ?>
                    <div class="form-group row">
        <?
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?>

                        <label class="col-form-label col-lg-2">


            <?=GetMessage("IBLOCK_FIELD_".$code)?>
                        </label>
                        <div class="col-lg-10">
                        <?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>" style="max-width: 100px;max-height:100px;"><?
			}
                        ?></div><?
		}
		else
		{
            ?> <label class="col-form-label col-lg-2"><?=GetMessage("IBLOCK_FIELD_".$code)?></label><div class="col-lg-10"><?=$value;?></div><?
		}
        ?></div>
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">
		<?=$arProperty["NAME"]?>
                        </label>
                        <div class="col-lg-10">
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
                        </div>
                    </div>
	<?endforeach;?>

                </fieldset>
            </div>
        </div>
    </div>
</div>
