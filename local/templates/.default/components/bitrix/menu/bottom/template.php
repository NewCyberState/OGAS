<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?if(strpos($APPLICATION->GetCurDir(),"/lkg/gos/")===0)
    $title="Управление государством";
elseif (strpos($APPLICATION->GetCurDir(),"/personal/")===0)
    $title="Настройки пользователя";
else
    $title="";
?>

    <ul class="navbar-nav ml-lg-auto flex-wrap">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        <li class="nav-item">
            <a href="<?=$arItem["LINK"]?>" class="navbar-nav-link"><?=$arItem["TEXT"]?></a>
        </li>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="nav-item"><a href="<?=$arItem["LINK"]?>" class="navbar-nav-link"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li  class="nav-item"><a href="<?=$arItem["LINK"]?>" class="navbar-nav-link <?if ($arItem["SELECTED"]):?> active<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
    </ul>
    </li>
<?endif?>

    </ul>
    </div>
