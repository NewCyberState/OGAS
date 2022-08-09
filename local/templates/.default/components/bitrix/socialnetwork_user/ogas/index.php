<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$pageId = "user_log";
//include("util_menu.php");

$rsUsers = CUser::GetList(($by="ID"), ($order="DESC"),
    array(
        'ACTIVE' => 'Y',
        'GROUPS_ID' => array(8),
        'NAME' => htmlspecialchars($_GET['q']),
    )
);

?><div id="log_external_container"></div><?
/*$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.log.ex",
	"",
	Array(
		"USER_VAR" => $arResult["ALIASES"]["user_id"],
		"GROUP_VAR" => $arResult["ALIASES"]["group_id"],
		"PAGE_VAR" => $arResult["ALIASES"]["page"],
		"PATH_TO_LOG_ENTRY" => $arResult["PATH_TO_LOG_ENTRY"],
		"PATH_TO_USER" => $arResult["PATH_TO_USER"],
		"PATH_TO_MESSAGES_CHAT" => $arResult["PATH_TO_MESSAGES_CHAT"],
		"PATH_TO_VIDEO_CALL" => $arResult["PATH_TO_VIDEO_CALL"],
		"PATH_TO_GROUP" => $arParams["PATH_TO_GROUP"],
		"PATH_TO_SMILE" => $arResult["PATH_TO_SMILE"],
		"PATH_TO_USER_BLOG_POST" => $arResult["PATH_TO_USER_BLOG_POST"],
		"PATH_TO_USER_BLOG_POST_IMPORTANT" => $arResult["PATH_TO_USER_BLOG_POST_IMPORTANT"],
		"PATH_TO_GROUP_BLOG_POST" => $arParams["PATH_TO_GROUP_POST"],
		"PATH_TO_SEARCH_TAG" => $arParams["PATH_TO_SEARCH_TAG"],
		"SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
		"SET_TITLE" => $arResult["SET_TITLE"],
		"PAGE_SIZE" => $arParams["ITEM_DETAIL_COUNT"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
		"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
		"DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
		"DATE_TIME_FORMAT_WITHOUT_YEAR" => $arResult["DATE_TIME_FORMAT_WITHOUT_YEAR"],
		"SHOW_YEAR" => $arParams["SHOW_YEAR"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
		"SHOW_EVENT_ID_FILTER" => "Y",
		"SHOW_SETTINGS_LINK" => "Y",
		"SET_LOG_CACHE" => "Y",
		"USE_COMMENTS" => "Y",
		"BLOG_ALLOW_POST_CODE" => $arParams["BLOG_ALLOW_POST_CODE"],
		"PAGER_DESC_NUMBERING" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CONTAINER_ID" => "log_external_container",
		"SHOW_RATING" => $arParams["SHOW_RATING"],
		"RATING_TYPE" => $arParams["RATING_TYPE"],
		"AVATAR_SIZE" => $arParams["LOG_THUMBNAIL_SIZE"],
		"AVATAR_SIZE_COMMENT" => $arParams["LOG_COMMENT_THUMBNAIL_SIZE"],
		"NEW_TEMPLATE" => $arParams["LOG_NEW_TEMPLATE"],
		"AUTH" => $arParams["LOG_AUTH"],
		"CHECK_COMMENTS_PERMS" => (isset($arParams["CHECK_COMMENTS_PERMS"]) && $arParams["CHECK_COMMENTS_PERMS"] == "Y" ? "Y" : "N"),
		"BLOG_NO_URL_IN_COMMENTS" => $arParams["BLOG_NO_URL_IN_COMMENTS"],
		"BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["BLOG_NO_URL_IN_COMMENTS_AUTHORITY"],
	),
	$this->getComponent()
);*/
?>


<div class="row">

<form action="">
<div class="dataTables_filter"><label><span>Поиск</span> <input type="search" class="form-control" name="q" placeholder="Найти гражданина..." value="<?=htmlspecialchars($_GET['q'])?>" aria-controls="DataTables_Table_0"></label></div>
</form>
</div>
<div class="row">


    <? $rsUsers->NavStart(24); // разбиваем постранично по 50 записей
    $rsUsers->bShowAll=false;



    while($user=$rsUsers->NavNext(false, "f_")) {
        $file = CFile::ResizeImageGet($user[PERSONAL_PHOTO], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        ?>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-img-actions d-inline-block mb-3">
                    <a href="/user/<?=$user[ID]?>/" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 ">
                        <img class="rounded-circle" style="object-fit: cover" src="<?=$file['src']?>" alt="" width="170" height="170">
                    </a>
                </div>

                <a href="/user/<?=$user[ID]?>/">
                    <h6 class="font-weight-semibold mb-0"><?=$user[NAME]." ".$user[LAST_NAME]?></h6> </a>

            </div>
        </div>
    </div>
<?}?>

</div>
<div class="row">
<?
$APPLICATION->IncludeComponent(
    'bitrix:system.pagenavigation',
    '',
    array(
        'NAV_TITLE'   => 'Элементы', // поясняющий текст для постраничной навигации
        'NAV_RESULT'  => $rsUsers,  // результаты выборки из базы данных
        'SHOW_ALWAYS' => false ,      // показывать постраничную навигацию всегда?
        'SHOW_ALL' => false
    )
);
?>
</div>

