<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отклоненные законы");

?>
<?
if($APPLICATION->GetCurUri()=="/lkg/gos/law/rejected/"):
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Отклоненные законы</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>В разделе "Отклоненные законы" отображаются законопроекты, которые были вынесены на референдум, но не набрали большинства голосов граждан, являющихся членами группы, к которой относится референдум.
                    </p>
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
		"BLOG_COUNT" => "20",
		"BLOG_COUNT_MAIN" => "6",
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
		"MESSAGE_COUNT" => "25",
		"MESSAGE_COUNT_MAIN" => "6",
		"MESSAGE_LENGTH" => "100",
		"NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
		"NAV_TEMPLATE" => "",
		"NOT_USE_COMMENT_TITLE" => "N",
		"NO_URL_IN_COMMENTS" => "",
		"NO_URL_IN_COMMENTS_AUTHORITY" => "",
		"PATH_TO_BLOG" => "/lkg/gos/law/rejected/",
		"PATH_TO_BLOG_CATEGORY" => "/club/user/#user_id#/blog/?category=#category_id#",
		"PATH_TO_GROUP_BLOG" => "/club/group/#group_id#/blog/",
		"PATH_TO_GROUP_BLOG_CATEGORY" => "/club/group/#group_id#/blog/?category=#category_id#",
		"PATH_TO_GROUP_BLOG_POST" => "/club/group/#group_id#/blog/#post_id#/",
		"PATH_TO_MESSAGES_CHAT" => "/club/messages/chat/#user_id#/",
		"PATH_TO_POST" => "/lkg/gos/law/rejected/#post_id#/",
		"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
		"PATH_TO_SONET_USER_PROFILE" => "/club/user/#user_id#/",
		"PATH_TO_USER" => "/user/#user_id#/",
		"PERIOD" => "",
		"PERIOD_DAYS" => "30",
		"PERIOD_NEW_TAGS" => "",
		"POST_PROPERTY" => array(
            0 => "UF_BLOG_POST_VOTE",
            1 => "UF_STATUS_ID",
            2 => "UF_NEED_VOTES",
            3 => "UF_BLOG_POST_FILE",
            4 => "UF_STATUS_DATE",
            5 => "UF_THEMATICS",
            6 => "UF_REPORT",
            7 => "UF_DECISION",
		),
		"POST_PROPERTY_LIST" => array(
		),
		"RATING_TYPE" => "",
		"SEF_MODE" => "Y",
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
		"SOCNET_GROUP_ID" => $socnet_group_id,
		"CATEGORY_ID" => $category,
		"STATUS_ID" => "13",
		"USER_ID" => false,
		"SEF_FOLDER" => "/lkg/gos/law/rejected/",
		"SEF_URL_TEMPLATES" => array(
			"index_" => "index.php",
			"group" => "group/#group_id#/",
			"blog" => "",
			"user" => "user/#user_id#/",
			"user_friends" => "friends/#user_id#/",
			"search" => "search.php",
			"user_settings" => "#blog#/user_settings.php",
			"user_settings_edit" => "#blog#/user_settings_edit.php?id=#user_id#",
			"group_edit" => "#blog#/group_edit.php",
			"blog_edit" => "#blog#/blog_edit.php",
			"category_edit" => "#blog#/category_edit.php",
			"post_edit" => "post_edit.php?id=#post_id#",
			"draft" => "#blog#/draft.php",
			"moderation" => "#blog#/moderation.php",
			"trackback" => POST_FORM_ACTION_URI."&blog=#blog#&id=#post_id#&page=trackback",
			"post" => "#post_id#/",
			"post_rss" => "#blog#/rss/#type#/#post_id#",
			"rss" => "#blog#/rss/#type#",
			"rss_all" => "rss/#type#/#group_id#",
		),
		"VARIABLE_ALIASES" => array(
			"user_settings_edit" => array(
				"user_id" => "id",
			),
			"post_edit" => array(
				"post_id" => "id",
			),
			"trackback" => array(
				"blog" => "blog",
				"post_id" => "id",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>