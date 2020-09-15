<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?if(strpos($APPLICATION->GetCurDir(),"/lkg/gos/")===0)
    $title="Управление государством";
elseif (strpos($APPLICATION->GetCurDir(),"/personal/")===0)
    $title="Настройки пользователя";
else
    $title="";
?>

    <div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

    <!-- Main -->
    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"><?=$title?></div> <i class="icon-menu" title="Main"></i></li>






<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        <li class="nav-item nav-item-submenu <?if ($arItem["SELECTED"]):?>nav-item-expanded nav-item-open<?endif?>">
            <a href="<?=$arItem["LINK"]?>" class="nav-link <?if ($arItem["SELECTED"]):?> nav-item-open<?else:?><?endif?>"><?=$arItem[PARAMS][icon]?><span><?=$arItem["TEXT"]?></span></a>
				<ul class="nav nav-group-sub">
		<?else:?>
			<li class="nav-item"><a href="<?=$arItem["LINK"]?>" class="parent <?if ($arItem["SELECTED"]):?> active<?endif?>"><?=$arItem["TEXT"]?></a>
            </li>

		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="nav-item <?if ($arItem["SELECTED"]):?>nav-item-expanded nav-item-open bg-primary <?endif?>"><a href="<?=$arItem["LINK"]?>" class="nav-link <?if ($arItem["SELECTED"]):?>nav-item-open<?else:?><?endif?>"><span><?=$arItem["TEXT"]?></span></a></li>
			<?else:?>
				<li  class="nav-item"><a href="<?=$arItem["LINK"]?>" class="nav-link <?if ($arItem["SELECTED"]):?> active<?endif?>"><span><?=$arItem["TEXT"]?></span></a></li>
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
