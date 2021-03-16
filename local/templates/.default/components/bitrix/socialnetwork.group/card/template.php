<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI;

UI\Extension::load("socialnetwork.common");

$APPLICATION->SetTitle($arResult['Group']['NAME']);

if(strlen($arResult["FatalError"])>0)
{
	?><span class='errortext'><?=$arResult["FatalError"]?></span><br /><br /><?
}
else
{
	if(strlen($arResult["ErrorMessage"])>0)
	{
		?><span class='errortext'><?=$arResult["ErrorMessage"]?></span><br /><br /><?
	}

	?><script>
		/*BX.ready(function() {
			SonetGroupCardSlider.getInstance().init({
				groupId: <?=intval($arParams["GROUP_ID"])?>,
				groupType: '<?=CUtil::JSEscape($arResult["groupTypeCode"])?>',
				isProject: <?=($arResult['Group']['PROJECT'] == 'Y' ? 'true' : 'false')?>,
				isOpened: <?=($arResult['Group']['OPENED'] == 'Y' ? 'true' : 'false')?>,
				currentUserId: <?=($USER->isAuthorized() ? $USER->getid() : 0)?>,
				userRole: '<?=CUtil::JSUrlEscape($arResult["CurrentUserPerms"]["UserRole"])?>',
				userIsMember: <?=($arResult["CurrentUserPerms"]["UserIsMember"] ? 'true' : 'false')?>,
				userIsAutoMember: <?=(isset($arResult["CurrentUserPerms"]["UserIsAutoMember"]) && $arResult["CurrentUserPerms"]["UserIsAutoMember"] ? 'true' : 'false')?>,
				initiatedByType: '<?=CUtil::JSUrlEscape($arResult["CurrentUserPerms"]["InitiatedByType"])?>',
				favoritesValue: <?=($arResult["FAVORITES"] ? 'true' : 'false')?>,
				canInitiate: <?=($arResult["CurrentUserPerms"]["UserCanInitiate"] && !$arResult["HideArchiveLinks"] ? 'true' : 'false')?>,
				canProcessRequestsIn: <?=($arResult["CurrentUserPerms"]["UserCanProcessRequestsIn"] && !$arResult["HideArchiveLinks"] ? 'true' : 'false')?>,
				canModify: <?=($arResult["CurrentUserPerms"]["UserCanModifyGroup"] ? 'true' : 'false')?>,
				canModerate: <?=($arResult["CurrentUserPerms"]["UserCanModerateGroup"] ? 'true' : 'false')?>,
				hideArchiveLinks: <?=($arResult["HideArchiveLinks"] ? 'true' : 'false')?>,
				containerNodeId: 'socialnetwork-group-card-box',
				subscribeButtonNodeId: 'group_card_subscribe_button',
				menuButtonNodeId: 'group_card_menu_button',
				styles: {
					tags: {
						box: 'socialnetwork-group-tag-box',
						item: 'socialnetwork-group-tag'
					},
					users: {
						box: 'socialnetwork-group-user-box',
						item: 'socialnetwork-group-user'
					},
					fav: {
						switch: 'socialnetwork-group-fav-switch',
						activeSwitch: 'socialnetwork-group-fav-switch-active'
					}
				},
				urls: {
					groupsList: '<?=CUtil::JSUrlEscape($arParams["PATH_TO_GROUPS_LIST"])?>'
				},
				editFeaturesAllowed: <?=(\Bitrix\Socialnetwork\Item\Workgroup::getEditFeaturesAvailability() ? 'true' : 'false')?>
			})
		});*/

		BX.message({
			SGCSPathToGroupTag: '<?=CUtil::JSUrlEscape($arParams["PATH_TO_GROUP_TAG"])?>',
			SGCSPathToUserProfile: '<?=CUtil::JSUrlEscape($arParams["PATH_TO_USER"])?>',
			SGCSWaitTitle: '<?=GetMessageJS("SONET_C6_CARD_WAIT")?>'
		});
	</script><?

	$this->SetViewTarget("sonet-slider-pagetitle", 1000);
	$bodyClass = $APPLICATION->GetPageProperty("BodyClass");
	$APPLICATION->SetPageProperty("BodyClass", ($bodyClass ? $bodyClass." " : "")."pagetitle-menu-visible");
	//include("title_buttons.php");
	$this->EndViewTarget();


	//pr($arResult["CurrentUserPerms"])
    //pr($arResult[Urls][Edit])
	?>


    <div class="card" id="socialnetwork-group-card-box">
		<div class="card-header header-elements-md-inline">
			<h2 class="mb-0"><?=$arResult['Group']['NAME']?></h2>

            <div class="header-elements">

                <?if(!$arResult["CurrentUserPerms"]["UserIsMember"]):?>
                   <button class="btn btn-primary ml-md-2" onclick="request('<?=$arParams["GROUP_ID"]?>');"><i class="icon-plus2 mr-2 "></i>Вступить в группу</button>
                <?else:?>
                <?if(!$arResult["CurrentUserPerms"]["UserIsOwner"]):?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:socialnetwork.user_leave_group",
                        "",
                        Array(
                            "GROUP_ID" => $arParams["GROUP_ID"],
                            "GROUP_VAR" => "",
                            "PAGE_VAR" => "",
                            "PATH_TO_GROUP" => "/personal/groups/group/#group_id#/",
                            "PATH_TO_USER" => "/user/#user_id#/",
                            "SET_NAV_CHAIN" => "N",
                            "SET_TITLE" => "N",
                            "USER_VAR" => ""
                        )
                    );?>
                    <?endif;?>
                <?endif;?>

                <?if($arResult["CurrentUserPerms"]["UserCanModifyGroup"]):?>
                <a href="<?=$arResult[Urls][Edit]?>">
                    <button type="button" class="btn btn-outline-primary ml-2"><i class="icon-pencil4 mr-2"></i> Редактировать</button>
                </a>
                <?endif;?>
            </div>
		</div>
        <div class="card-body">
        <?if($arResult['Group'][IMAGE_ID_FILE][SRC]):?>
            <img src="<?=$arResult['Group'][IMAGE_ID_FILE][SRC]?>" class="mb-3 img-fluid" width="300">
        <?endif;?>
        <?

		if ($arResult['Group']['DESCRIPTION'] != '')
		{
			?>
				<div class="text-mute"><?=$arResult['Group']['DESCRIPTION']?></div>
			<?
		}

		?>

        </div>

		<div class="card-body">
			<div class="socialnetwork-group-left"><?=Loc::getMessage('SONET_C6_CARD_MEMBERS')?> (<?=intval($arResult["Group"]["NUMBER_OF_MEMBERS"])?>)</div>
			<div class="socialnetwork-group-right">
				<div class="socialnetwork-group-user-box"><?
					$counter = 0;;
					if (
						is_array($arResult["Members"]["List"])
						&& !empty($arResult["Members"]["List"])
					)
					{
						foreach($arResult["Members"]["List"] as $member)
						{
							if ($counter >= $arParams['USER_LIMIT'])
							{
								break;
							}

							$backgroundStyle = (
							!empty($member["USER_PERSONAL_PHOTO_FILE"])
							&& !empty($member["USER_PERSONAL_PHOTO_FILE"]["SRC"])
								? "background-image: url('".htmlspecialcharsbx($member["USER_PERSONAL_PHOTO_FILE"]["SRC"])."'); background-size: cover;"
								: ""
							);

                            ?><a href="/user/<?=$member["USER_ID"]?>/"><div class="socialnetwork-group-user" title="<?=$member["NAME_FORMATTED"]?>" style="<?=$backgroundStyle?>"></div></a><?
							$counter++;
						}
					}

					if ($counter >= $arParams['USER_LIMIT'])
					{
						?><div class="socialnetwork-group-user-more">+ <?=(count($arResult["Members"]["List"]) - $arParams['USER_LIMIT'])?></div><?
					}

				?></div>
			</div>


            <?
            if($_REQUEST["join"]=="Y"):?>
                <div class="mt-0">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:socialnetwork.user_request_group",
                        "",
                        Array(
                            "GROUP_ID" => intval($arParams["GROUP_ID"]),
                            "GROUP_VAR" => "",
                            "PAGE_VAR" => "",
                            "PATH_TO_GROUP" => "/personal/groups/group/#group_id#/",
                            "PATH_TO_GROUP_REQUESTS" => "",
                            "PATH_TO_USER" => "/user/#user_id#/",
                            "SET_NAV_CHAIN" => "N",
                            "SET_TITLE" => "N",
                            "USER_VAR" => "",
                            "USE_AUTOSUBSCRIBE" => "Y"
                        )
                    );?>
                </div>
            <?else:?>

                <?if($arResult["CurrentUserPerms"]["UserIsMember"]):?>
                    <div class="text-muted">Вы участник группы</div>
                <?endif;?>
                <?if($arResult["CurrentUserPerms"]["UserIsOwner"]):?>
                    <div class="text-muted">Вы владелец группы</div>
                <?endif;?>


            <?endif;?>

		</div>

        <?if($arResult["Group"]["OPENED"]=="Y"):?>
        <div class="card-body">
            <div class="text-muted">Пригласить в группу по ссылке (любой, у кого есть ссылка, может стать участником группы):</div>
            <div class="form-group form-group-feedback form-group-feedback-right mb-0 mt-1">
            <input class="form-control" value="https://<?=SITE_SERVER_NAME.$APPLICATION->GetCurPage()."?join=Y"?>" id="clipboard" onfocus="document.getElementById('clipboard').select(); document.execCommand('copy');">
            <div class="form-control-feedback">
                <a href="javascript:;" class="text-default" onclick="document.getElementById('clipboard').select(); document.execCommand('copy');"><i class="mi-content-copy" title="Скопировать в буфер обмена"></i></a>
            </div>
            </div>
        </div>

        <?endif;?>




	</div>

    <?if($arResult["CurrentUserPerms"]["UserIsMember"]):?>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible alert">
                <div class="card-body" style="">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <p>На странице группы вы можете ознакомиться с описанием группы, со списком участников группы, пригласить в группу других участников по ссылке, принять участие в обсуждениях на закладке <a href="forum/">Обсуждения</a>, а также вынести свои предложения на рассмотрение участников группы по любым вопросам, требущим принятия коллективного решения всеми участниками группы. Участники группы смогут обсудить данные предложения, проголосовать за них на референдуме среди всех участников данной группы, после чего предложение будет утверждено в качестве закона и будет обязательно для исполнения всеми участниками группы.</p>


                    <a href="/lkg/gos/petition/add/?group_id=<?=$arParams["GROUP_ID"]?>" class="btn btn-info"><i class="icon-copy  mr-2"></i>Добавить петицию</a>

                </div>
            </div>
        </div>
    </div>

<?endif;?>

    <?$APPLICATION->IncludeComponent(
    "bitrix:blog",
    ".default",
    array(
        "AJAX_PAGINATION" => "N",
        "ALLOW_POST_CODE" => "Y",
        "ALLOW_POST_MOVE" => "N",
        "BLOG_COUNT" => "3",
        "BLOG_COUNT_MAIN" => "3",
        "BLOG_PROPERTY" => array(
        ),
        "BLOG_PROPERTY_LIST" => array(
        ),
        "BLOG_URL" => "petition/",
        "CACHE_TIME" => "3600",
        "CACHE_TIME_LONG" => "604800",
        "CACHE_TYPE" => "A",
        "COLOR_TYPE" => "Y",
        "COMMENTS_COUNT" => "25",
        "COMMENTS_LIST_VIEW" => "N",
        "COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
        "COMMENT_ALLOW_VIDEO" => "Y",
        "COMMENT_EDITOR_CODE_DEFAULT" => "Y",
        "COMMENT_EDITOR_DEFAULT_HEIGHT" => "300",
        "COMMENT_EDITOR_RESIZABLE" => "Y",
        "COMMENT_PROPERTY" => array(
        ),
        "COMPONENT_TEMPLATE" => ".default",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "DO_NOT_SHOW_MENU" => "N",
        "DO_NOT_SHOW_SIDEBAR" => "N",
        "EDITOR_CODE_DEFAULT" => "Y",
        "EDITOR_DEFAULT_HEIGHT" => "300",
        "EDITOR_RESIZABLE" => "Y",
        "GROUP_ID" => array(
            0 => "",
            1 => "",
        ),
        "IMAGE_MAX_HEIGHT" => "600",
        "IMAGE_MAX_WIDTH" => "600",
        "MESSAGE_COUNT" => "3",
        "MESSAGE_COUNT_MAIN" => "3",
        "MESSAGE_LENGTH" => "100",
        "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
        "NAV_TEMPLATE" => "",
        "NOT_USE_COMMENT_TITLE" => "N",
        "NO_URL_IN_COMMENTS" => "",
        "NO_URL_IN_COMMENTS_AUTHORITY" => "",
        "PATH_TO_BLOG" => "/club/user/#user_id#/blog/",
        "PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
        "PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
        "PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
        "PATH_TO_POST" => "/club/user/#user_id#/blog/#post_id#/",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
        "PATH_TO_USER" => "/club/user/#user_id#/",
        "PERIOD" => "",
        "PERIOD_DAYS" => "30",
        "PERIOD_NEW_TAGS" => "",
        "POST_PROPERTY" => array(
            0 => "UF_STATUS",
        ),
        "POST_PROPERTY_LIST" => array(
        ),
        "RATING_TYPE" => "",
        "SEF_MODE" => "N",
        "SEO_USE" => "Y",
        "SEO_USER" => "N",
        "SET_NAV_CHAIN" => "Y",
        "SET_TITLE" => "N",
        "SHOW_LOGIN" => "Y",
        "SHOW_NAVIGATION" => "N",
        "SHOW_RATING" => "",
        "SHOW_SPAM" => "N",
        "SMILES_COUNT" => "4",
        "THEME" => "blue",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USER_PROPERTY" => array(
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_ASC_PAGING" => "N",
        "USE_GOOGLE_CODE" => "Y",
        "USE_SHARE" => "N",
        "USE_SOCNET" => "N",
        "WIDTH" => "100%",
        "SOCNET_GROUP_ID" => $arParams["GROUP_ID"],
        "CATEGORY_ID" => $category,
        "STATUS_ID" => "9",
        "USER_ID" => false,
        "VARIABLE_ALIASES" => array(
            "blog" => "blog",
            "post_id" => "post_id",
            "user_id" => "user_id",
            "page" => "page",
            "group_id" => "group_id",
        )
    ),
    false
);?>


    <?$APPLICATION->IncludeComponent(
    "bitrix:blog",
    ".default",
    Array(
        "AJAX_PAGINATION" => "N",
        "ALLOW_POST_CODE" => "Y",
        "ALLOW_POST_MOVE" => "N",
        "BLOG_COUNT" => "4",
        "BLOG_COUNT_MAIN" => "4",
        "BLOG_PROPERTY" => array(),
        "BLOG_PROPERTY_LIST" => array(),
        "BLOG_URL" => "",
        "CACHE_TIME" => "3600",
        "CACHE_TIME_LONG" => "604800",
        "CACHE_TYPE" => "A",
        "COLOR_TYPE" => "Y",
        "COMMENTS_COUNT" => "25",
        "COMMENTS_LIST_VIEW" => "N",
        "COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
        "COMMENT_ALLOW_VIDEO" => "Y",
        "COMMENT_EDITOR_CODE_DEFAULT" => "N",
        "COMMENT_EDITOR_DEFAULT_HEIGHT" => "200",
        "COMMENT_EDITOR_RESIZABLE" => "Y",
        "COMMENT_PROPERTY" => array(),
        "COMPONENT_TEMPLATE" => ".default",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "DO_NOT_SHOW_MENU" => "N",
        "DO_NOT_SHOW_SIDEBAR" => "N",
        "EDITOR_CODE_DEFAULT" => "N",
        "EDITOR_DEFAULT_HEIGHT" => "300",
        "EDITOR_RESIZABLE" => "Y",
        "GROUP_ID" => array(0=>"",1=>"",),
        "IMAGE_MAX_HEIGHT" => "600",
        "IMAGE_MAX_WIDTH" => "600",
        "MESSAGE_COUNT" => "25",
        "MESSAGE_COUNT_MAIN" => "6",
        "MESSAGE_LENGTH" => "100",
        "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
        "NAV_TEMPLATE" => "",
        "NOT_USE_COMMENT_TITLE" => "N",
        "NO_URL_IN_COMMENTS" => "",
        "NO_URL_IN_COMMENTS_AUTHORITY" => "",
        "PATH_TO_BLOG" => "/lkg/gos/",
        "PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
        "PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
        "PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
        "PATH_TO_POST" => "/club/user/#user_id#/blog/#post_id#/",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
        "PATH_TO_USER" => "/club/user/#user_id#/",
        "PERIOD" => "",
        "PERIOD_DAYS" => "30",
        "PERIOD_NEW_TAGS" => "",
        "POST_PROPERTY" => array("UF_STATUS","UF_STATUS_DATE"),
        "POST_PROPERTY_LIST" => array(),
        "RATING_TYPE" => "",
        "SEF_MODE" => "N",
        "SEO_USE" => "Y",
        "SEO_USER" => "N",
        "SET_NAV_CHAIN" => "Y",
        "SET_TITLE" => "Y",
        "SHOW_LOGIN" => "Y",
        "SHOW_NAVIGATION" => "N",
        "SHOW_RATING" => "",
        "SHOW_SPAM" => "N",
        "SMILES_COUNT" => "4",
        "THEME" => "blue",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USER_PROPERTY" => array(),
        "USER_PROPERTY_NAME" => "",
        "USE_ASC_PAGING" => "N",
        "USE_GOOGLE_CODE" => "Y",
        "USE_SHARE" => "N",
        "USE_SOCNET" => "N",
        "VARIABLE_ALIASES" => array("blog"=>"blog","post_id"=>"post_id","user_id"=>"user_id","page"=>"page","group_id"=>"group_id",),
        "WIDTH" => "100%",
        "SOCNET_GROUP_ID" => $arParams["GROUP_ID"],
        "CATEGORY_ID" => $category,
        "STATUS_ID" => 10,
        "USER_ID" => "",

    )
);?>



    <?$APPLICATION->IncludeComponent(
    "bitrix:blog",
    ".default",
    array(
        "AJAX_PAGINATION" => "N",
        "ALLOW_POST_CODE" => "Y",
        "ALLOW_POST_MOVE" => "N",
        "BLOG_COUNT" => "4",
        "BLOG_COUNT_MAIN" => "4",
        "BLOG_PROPERTY" => array(
        ),
        "BLOG_PROPERTY_LIST" => array(
        ),
        "BLOG_URL" => "",
        "CACHE_TIME" => "3600",
        "CACHE_TIME_LONG" => "604800",
        "CACHE_TYPE" => "A",
        "COLOR_TYPE" => "Y",
        "COMMENTS_COUNT" => "25",
        "COMMENTS_LIST_VIEW" => "N",
        "COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
        "COMMENT_ALLOW_VIDEO" => "Y",
        "COMMENT_EDITOR_CODE_DEFAULT" => "N",
        "COMMENT_EDITOR_DEFAULT_HEIGHT" => "200",
        "COMMENT_EDITOR_RESIZABLE" => "Y",
        "COMMENT_PROPERTY" => array(
        ),
        "COMPONENT_TEMPLATE" => ".default",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "DO_NOT_SHOW_MENU" => "N",
        "DO_NOT_SHOW_SIDEBAR" => "N",
        "EDITOR_CODE_DEFAULT" => "N",
        "EDITOR_DEFAULT_HEIGHT" => "300",
        "EDITOR_RESIZABLE" => "Y",
        "GROUP_ID" => array(
            0 => "1",
            1 => "",
        ),
        "IMAGE_MAX_HEIGHT" => "600",
        "IMAGE_MAX_WIDTH" => "600",
        "MESSAGE_COUNT" => "3",
        "MESSAGE_COUNT_MAIN" => "3",
        "MESSAGE_LENGTH" => "100",
        "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
        "NAV_TEMPLATE" => "",
        "NOT_USE_COMMENT_TITLE" => "N",
        "NO_URL_IN_COMMENTS" => "",
        "NO_URL_IN_COMMENTS_AUTHORITY" => "",
        "PATH_TO_BLOG" => "/club/user/#user_id#/blog/",
        "PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
        "PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
        "PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
        "PATH_TO_POST" => "/club/user/#user_id#/blog/#post_id#/",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
        "PATH_TO_USER" => "/club/user/#user_id#/",
        "PERIOD" => "",
        "PERIOD_DAYS" => "30",
        "PERIOD_NEW_TAGS" => "",
        "POST_PROPERTY" => array(
            0 => "UF_BLOG_POST_VOTE",
            1 => "UF_STATUS_ID",
        ),
        "POST_PROPERTY_LIST" => array(
        ),
        "RATING_TYPE" => "",
        "SEF_MODE" => "N",
        "SEO_USE" => "Y",
        "SEO_USER" => "N",
        "SET_NAV_CHAIN" => "N",
        "SET_TITLE" => "Y",
        "SHOW_LOGIN" => "Y",
        "SHOW_NAVIGATION" => "N",
        "SHOW_RATING" => "",
        "SHOW_SPAM" => "N",
        "SMILES_COUNT" => "4",
        "THEME" => "blue",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USER_PROPERTY" => array(
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_ASC_PAGING" => "N",
        "USE_GOOGLE_CODE" => "Y",
        "USE_SHARE" => "N",
        "USE_SOCNET" => "N",
        "WIDTH" => "100%",
        "SOCNET_GROUP_ID" => $arParams["GROUP_ID"],
        "CATEGORY_ID" => $category,
        "STATUS_ID" => "12",
        "USER_ID" => false,
        "VARIABLE_ALIASES" => array(
            "blog" => "blog",
            "post_id" => "post_id",
            "user_id" => "user_id",
            "page" => "page",
            "group_id" => "group_id",
        )
    ),
    false
);?>




    <?$APPLICATION->IncludeComponent(
    "bitrix:blog",
    ".default",
    array(
        "AJAX_PAGINATION" => "Y",
        "ALLOW_POST_CODE" => "Y",
        "ALLOW_POST_MOVE" => "N",
        "BLOG_COUNT" => "3",
        "BLOG_COUNT_MAIN" => "3",
        "BLOG_PROPERTY" => array(
        ),
        "BLOG_PROPERTY_LIST" => array(
        ),
        "BLOG_URL" => "",
        "CACHE_TIME" => "3600",
        "CACHE_TIME_LONG" => "604800",
        "CACHE_TYPE" => "A",
        "COLOR_TYPE" => "Y",
        "COMMENTS_COUNT" => "25",
        "COMMENTS_LIST_VIEW" => "N",
        "COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
        "COMMENT_ALLOW_VIDEO" => "Y",
        "COMMENT_EDITOR_CODE_DEFAULT" => "N",
        "COMMENT_EDITOR_DEFAULT_HEIGHT" => "200",
        "COMMENT_EDITOR_RESIZABLE" => "Y",
        "COMMENT_PROPERTY" => array(
        ),
        "COMPONENT_TEMPLATE" => ".default",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "DO_NOT_SHOW_MENU" => "N",
        "DO_NOT_SHOW_SIDEBAR" => "N",
        "EDITOR_CODE_DEFAULT" => "N",
        "EDITOR_DEFAULT_HEIGHT" => "300",
        "EDITOR_RESIZABLE" => "Y",
        "GROUP_ID" => array(
            0 => "1",
            1 => "",
        ),
        "IMAGE_MAX_HEIGHT" => "600",
        "IMAGE_MAX_WIDTH" => "600",
        "MESSAGE_COUNT" => "3",
        "MESSAGE_COUNT_MAIN" => "3",
        "MESSAGE_LENGTH" => "100",
        "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
        "NAV_TEMPLATE" => "",
        "NOT_USE_COMMENT_TITLE" => "N",
        "NO_URL_IN_COMMENTS" => "",
        "NO_URL_IN_COMMENTS_AUTHORITY" => "",
        "PATH_TO_BLOG" => "/club/user/#user_id#/blog/",
        "PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
        "PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
        "PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
        "PATH_TO_POST" => "/club/user/#user_id#/blog/#post_id#/",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
        "PATH_TO_USER" => "/club/user/#user_id#/",
        "PERIOD" => "",
        "PERIOD_DAYS" => "30",
        "PERIOD_NEW_TAGS" => "",
        "POST_PROPERTY" => array(
            0 => "UF_BLOG_POST_VOTE",
            1 => "UF_STATUS_ID",
        ),
        "POST_PROPERTY_LIST" => array(
        ),
        "RATING_TYPE" => "",
        "SEF_MODE" => "N",
        "SEO_USE" => "Y",
        "SEO_USER" => "N",
        "SET_NAV_CHAIN" => "N",
        "SET_TITLE" => "Y",
        "SHOW_LOGIN" => "Y",
        "SHOW_NAVIGATION" => "N",
        "SHOW_RATING" => "",
        "SHOW_SPAM" => "N",
        "SMILES_COUNT" => "4",
        "THEME" => "blue",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USER_PROPERTY" => array(
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_ASC_PAGING" => "N",
        "USE_GOOGLE_CODE" => "Y",
        "USE_SHARE" => "N",
        "USE_SOCNET" => "N",
        "WIDTH" => "100%",
        "SOCNET_GROUP_ID" => $arParams["GROUP_ID"],
        "CATEGORY_ID" => $category,
        "STATUS_ID" => "14",
        "USER_ID" => false,
        "VARIABLE_ALIASES" => array(
            "blog" => "blog",
            "post_id" => "post_id",
            "user_id" => "user_id",
            "page" => "page",
            "group_id" => "group_id",
        )
    ),
    false
);?>



    <?$APPLICATION->IncludeComponent(
    "bitrix:blog",
    ".default",
    array(
        "AJAX_PAGINATION" => "N",
        "ALLOW_POST_CODE" => "Y",
        "ALLOW_POST_MOVE" => "N",
        "BLOG_COUNT" => "4",
        "BLOG_COUNT_MAIN" => "4",
        "BLOG_PROPERTY" => array(
        ),
        "BLOG_PROPERTY_LIST" => array(
        ),
        "BLOG_URL" => "",
        "CACHE_TIME" => "3600",
        "CACHE_TIME_LONG" => "604800",
        "CACHE_TYPE" => "A",
        "COLOR_TYPE" => "Y",
        "COMMENTS_COUNT" => "25",
        "COMMENTS_LIST_VIEW" => "N",
        "COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
        "COMMENT_ALLOW_VIDEO" => "Y",
        "COMMENT_EDITOR_CODE_DEFAULT" => "N",
        "COMMENT_EDITOR_DEFAULT_HEIGHT" => "200",
        "COMMENT_EDITOR_RESIZABLE" => "Y",
        "COMMENT_PROPERTY" => array(
        ),
        "COMPONENT_TEMPLATE" => ".default",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "DO_NOT_SHOW_MENU" => "N",
        "DO_NOT_SHOW_SIDEBAR" => "N",
        "EDITOR_CODE_DEFAULT" => "N",
        "EDITOR_DEFAULT_HEIGHT" => "300",
        "EDITOR_RESIZABLE" => "Y",
        "GROUP_ID" => array(
            0 => "1",
            1 => "",
        ),
        "IMAGE_MAX_HEIGHT" => "600",
        "IMAGE_MAX_WIDTH" => "600",
        "MESSAGE_COUNT" => "3",
        "MESSAGE_COUNT_MAIN" => "3",
        "MESSAGE_LENGTH" => "100",
        "NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
        "NAV_TEMPLATE" => "",
        "NOT_USE_COMMENT_TITLE" => "N",
        "NO_URL_IN_COMMENTS" => "",
        "NO_URL_IN_COMMENTS_AUTHORITY" => "",
        "PATH_TO_BLOG" => "/club/user/#user_id#/blog/",
        "PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
        "PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
        "PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
        "PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
        "PATH_TO_POST" => "/club/user/#user_id#/blog/#post_id#/",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
        "PATH_TO_USER" => "/club/user/#user_id#/",
        "PERIOD" => "",
        "PERIOD_DAYS" => "30",
        "PERIOD_NEW_TAGS" => "",
        "POST_PROPERTY" => array(
            0 => "UF_BLOG_POST_VOTE",
            1 => "UF_STATUS_ID",
        ),
        "POST_PROPERTY_LIST" => array(
        ),
        "RATING_TYPE" => "",
        "SEF_MODE" => "N",
        "SEO_USE" => "Y",
        "SEO_USER" => "N",
        "SET_NAV_CHAIN" => "N",
        "SET_TITLE" => "Y",
        "SHOW_LOGIN" => "Y",
        "SHOW_NAVIGATION" => "N",
        "SHOW_RATING" => "",
        "SHOW_SPAM" => "N",
        "SMILES_COUNT" => "4",
        "THEME" => "blue",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USER_PROPERTY" => array(
        ),
        "USER_PROPERTY_NAME" => "",
        "USE_ASC_PAGING" => "N",
        "USE_GOOGLE_CODE" => "Y",
        "USE_SHARE" => "N",
        "USE_SOCNET" => "N",
        "WIDTH" => "100%",
        "SOCNET_GROUP_ID" => $arParams["GROUP_ID"],
        "CATEGORY_ID" => $category,
        "STATUS_ID" => "16",
        "USER_ID" => false,
        "VARIABLE_ALIASES" => array(
            "blog" => "blog",
            "post_id" => "post_id",
            "user_id" => "user_id",
            "page" => "page",
            "group_id" => "group_id",
        )
    ),
    false
);?>

    <?
}
?>



