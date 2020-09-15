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






<?
$iCount = 0;
foreach ($arResult["QUESTIONS"] as $arQuestion):
	$iCount++;

?>




<div class="card-body bg-white border-top">

    <h5 class="text-success">Решение<i class="icon-checkmark-circle2 ml-1"></i></h5>
    <?=$arQuestion["QUESTION"]?>

</div>
<?
endforeach;

?>