<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult["ERROR_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-error card-body">
	<div class="vote-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"])?></div>
</div>
<?
endif;

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"]) ):
	return true;
endif;

?>






<ul class="vote-items-list vote-question-list voting-result-box">

<?
$iCount = 0;
foreach ($arResult["QUESTIONS"] as $arQuestion):
	$iCount++;

?>

	<li class="vote-item-vote <?=($iCount == 1 ? "vote-item-vote-first " : "")?><?
				?><?=($iCount == count($arResult["QUESTIONS"]) ? "vote-item-vote-last " : "")?><?
				?><?=($iCount%2 == 1 ? "vote-item-vote-odd " : "vote-item-vote-even ")?><?
				?>">


        <div class="card-body">


		<div class="vote-item-header">

<?
	if ($arQuestion["IMAGE"] !== false):
?>
			<div class="vote-item-image"><img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" /></div>
<?
	endif;

?>
            <div class="">
			<div class="vote-item-title vote-item-question font-size-lg"><?=$arQuestion["QUESTION"]?></div>
            </div>
			<div class="vote-clear-float"></div>
		</div>

		</div>

<div class="card-footer bg-white">

<?
	if (true/*$arQuestion["DIAGRAM_TYPE"] == "circle"*/):
?>
        <h3>Результаты голосования</h3>
			<table class="vote-answer-table">
				<tr>
					<td width="160"><img width="150" height="150" src="<?=$componentPath?>/draw_chart.php?qid=<?=$arQuestion["ID"]?>&dm=150" /></td>
					<td>
						<table class="vote-bar-table">
							<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
								<tr>
									<td><div class="vote-bar-square" style="background-color:#<?=htmlspecialcharsbx($arAnswer["COLOR"])?>"></div></td>
									<td><nobr><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</nobr></td>
									<td><?=$arAnswer["MESSAGE"]?></td>
								</tr>
							<?endforeach?>
						</table>
					</td>
				</tr>
			</table>

<?
	else://histogram
?>


			<table width="100%" class="vote-answer-table <?if(!$_REQUEST["post_id"]){echo 'd-none';}?>">
			<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
				<? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])):?>
					<tr><td></td><td style='vertical-align:middle;'><div style='width:80%; height:1px; background-color:#<?=htmlspecialcharsbx($arAnswer["COLOR"])?>;'></div></td></tr>
				<? endif; ?>
				<tr>
					<? $percent = round($arAnswer["BAR_PERCENT"] * 0.8); // (100% bar * 0.8) + (20% span counter) = 100% td ?>
						<td width="24%" style=''>
						<?=$arAnswer["MESSAGE"]?>
						<? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])) 
						{
							if (trim($arAnswer["MESSAGE"]) != '') 
								echo '&nbsp';
							echo '('.GetMessage('VOTE_GROUP_TOTAL') .')';
						}
						?>
					&nbsp;</td>
					<td><div class="vote-answer-bar" style="width:<?=$percent?>%;background-color:#<?=htmlspecialcharsbx($arAnswer["COLOR"])?>"></div>
					<span class="vote-answer-counter"><nobr><?=($arAnswer["COUNTER"] > 0?'&nbsp;':'')?><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</nobr></span></td>
					<? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): ?>
						<? $arGroupAnswers = $arResult['GROUP_ANSWERS'][$arAnswer['ID']]; ?> 
						</tr>
						<?foreach ($arGroupAnswers as $arGroupAnswer):?>
							<? $percent = round($arGroupAnswer["PERCENT"] * 0.8); // (100% bar * 0.8) + (20% span counter) = 100% td ?>
							<tr>
								<td width="24%">
									<? if (trim($arAnswer["MESSAGE"]) != '') { ?>
										<span class='vote-answer-lolight'><?=$arAnswer["MESSAGE"]?>:&nbsp;</span>
									<? } ?>
									<?=$arGroupAnswer["MESSAGE"]?>
								</td>
								<td><div class="vote-answer-bar" style="width:<?=$percent?>%;background-color:#<?=htmlspecialcharsbx($arAnswer["COLOR"])?>"></div>
								<span class="vote-answer-counter"><nobr><?=($arGroupAnswer["COUNTER"] > 0?'&nbsp;':'')?><?=$arGroupAnswer["COUNTER"]?> (<?=$arGroupAnswer["PERCENT"]?>%)</nobr></span></td>
							</tr>
						<?endforeach?>
						<tr><td></td><td style='vertical-align:middle;'><div style='width:80%; height:1px; background-color:#<?=htmlspecialcharsbx($arAnswer["COLOR"])?>;'></div></td></tr>
					<? else: ?>
				</tr>
					<? endif; // USER_ANSWERS ?>
			<?endforeach?>
			</table>
<?
	endif;
?>

    <?
    if ($arParams[NEED_VOTES]):?>
        <br><b>Для принятия закона необходимо: <?= $arParams[NEED_VOTES] ?> голоса "За"</b>
    <?endif; ?>
    </div>
	</li>
<?
endforeach;

?>
</ul>

    <?
if (!empty($arResult["OK_MESSAGE"])):
    ?>
    <div class="vote-note-box vote-note-note card-body">
        <div class="vote-note-box-text text-success">Спасибо! Ваш голос учтен.</div>
    </div>
<?
endif;
?>