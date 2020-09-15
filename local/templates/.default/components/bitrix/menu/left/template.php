<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

    <!-- Main -->
    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Управление государством</div> <i class="icon-menu" title="Main"></i></li>

    <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
    <a href="#" class="nav-link"><i class="icon-pencil3"></i> <span>Петиции</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
        <li class="nav-item"><a href="/lkg/gos/petition/add/" class="nav-link">Добавить петицию</a></li>



<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

<?endif?>