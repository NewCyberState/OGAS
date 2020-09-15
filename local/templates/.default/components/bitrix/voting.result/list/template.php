<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult["ERROR_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-error">
	<div class="vote-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"])?></div>
</div>
<?
endif;

if (!empty($arResult["OK_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-note">
	<div class="vote-note-box-text"><?=ShowNote($arResult["OK_MESSAGE"])?></div>
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
		<div class="vote-item-header">

<?
	if ($arQuestion["IMAGE"] !== false):
?>
			<div class="vote-item-image"><img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" /></div>
<?
	endif;

?>
            <div class="">
			<div class="vote-item-title vote-item-question"><?=$arQuestion["QUESTION"]?></div>
            </div>
			<div class="vote-clear-float"></div>
		</div>





	</li>
<?
endforeach;

?>
</ul>