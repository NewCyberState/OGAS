<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сообщества");
?>


<?$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork_group", 
	"2021", 
	array(
		"ITEM_DETAIL_COUNT" => "32",
		"ITEM_MAIN_COUNT" => "100",
		"DATE_TIME_FORMAT" => "d.m.y G:i",
		"NAME_TEMPLATE" => "",
		"SHOW_LOGIN" => "Y",
		"SHOW_RATING" => "Y",
		"RATING_ID" => array(
			0 => "3",
		),
		"CAN_OWNER_EDIT_DESKTOP" => "Y",
		"PATH_TO_USER" => SITE_DIR."user/#user_id#/",
		"PATH_TO_SUBSCRIBE" => SITE_DIR."subscribe/",
		"PATH_TO_GROUP_CREATE" => SITE_DIR."people/user/#user_id#/groups/create/",
		"PATH_TO_SEARCH_EXTERNAL" => SITE_DIR."people/index.php",
		"PATH_TO_MESSAGES_CHAT" => SITE_DIR."people/messages/chat/#user_id#/",
		"PATH_TO_MESSAGE_FORM_MESS" => SITE_DIR."people/messages/form/#user_id#/#message_id#/",
		"PATH_TO_USER_LOG" => SITE_DIR."people/log/",
		"PATH_TO_USER_BLOG_POST" => SITE_DIR."people/user/#user_id#/blog/#post_id#/",
		"PATH_TO_USER_BLOG_POST_EDIT" => SITE_DIR."people/user/#user_id#/blog/edit/#post_id#/",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/groups/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_TIME_LONG" => "60480000",
		"PATH_TO_SMILE" => "/bitrix/images/socialnetwork/smile/",
		"PATH_TO_BLOG_SMILE" => "/bitrix/images/blog/smile/",
		"PATH_TO_FORUM_SMILE" => "/bitrix/images/forum/smile/",
		"SONET_PATH_TO_FORUM_ICON" => "/bitrix/images/forum/icon/",
		"SET_TITLE" => "Y",
		"SET_NAV_CHAIN" => "Y",
		"SHOW_YEAR" => "Y",
		"USER_FIELDS_MAIN" => array(
			0 => "LAST_LOGIN",
			1 => "DATE_REGISTER",
			2 => "PERSONAL_BIRTHDAY",
			3 => "PERSONAL_GENDER",
		),
		"USER_PROPERTY_MAIN" => array(
		),
		"USER_FIELDS_CONTACT" => array(
			0 => "EMAIL",
			1 => "PERSONAL_WWW",
			2 => "PERSONAL_ICQ",
			3 => "PERSONAL_PHONE",
			4 => "PERSONAL_FAX",
			5 => "PERSONAL_MOBILE",
		),
		"USER_PROPERTY_CONTACT" => array(
			0 => "UF_SKYPE",
		),
		"USER_FIELDS_PERSONAL" => array(
			0 => "PERSONAL_PROFESSION",
			1 => "PERSONAL_NOTES",
		),
		"USER_PROPERTY_PERSONAL" => array(
			0 => "UF_TWITTER",
		),
		"AJAX_LONG_TIMEOUT" => "60",
		"BLOG_GROUP_ID" => "1",
		"BLOG_COMMENT_AJAX_POST" => "Y",
		"FORUM_ID" => "2",
		"PHOTO_GROUP_IBLOCK_TYPE" => "photos",
		"PHOTO_GROUP_IBLOCK_ID" => "2",
		"PHOTO_MODERATION" => "N",
		"PHOTO_SECTION_PAGE_ELEMENTS" => "15",
		"PHOTO_ELEMENTS_PAGE_ELEMENTS" => "50",
		"PHOTO_SLIDER_COUNT_CELL" => "3",
		"CELL_COUNT" => "0",
		"PHOTO_ALBUM_PHOTO_THUMBS_SIZE" => "120",
		"PHOTO_THUMBNAIL_SIZE" => "90",
		"PHOTO_ORIGINAL_SIZE" => "1280",
		"PHOTO_UPLOADER_TYPE" => "flash",
		"PHOTO_WATERMARK_MIN_PICTURE_SIZE" => "200",
		"PHOTO_PATH_TO_FONT" => "",
		"PHOTO_SHOW_WATERMARK" => "Y",
		"PHOTO_WATERMARK_RULES" => "USER",
		"PHOTO_PHOTO_UPLOAD_MAX_FILESIZE" => "1024",
		"PHOTO_USE_RATING" => "Y",
		"PHOTO_MAX_VOTE" => "5",
		"PHOTO_VOTE_NAMES" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "",
		),
		"PHOTO_DISPLAY_AS_RATING" => "vote_avg",
		"PHOTO_USE_COMMENTS" => "Y",
		"PHOTO_FORUM_ID" => "1",
		"PHOTO_USE_CAPTCHA" => "Y",
		"SEARCH_DEFAULT_SORT" => "rank",
		"SEARCH_PAGE_RESULT_COUNT" => "10",
		"SEARCH_TAGS_PAGE_ELEMENTS" => "100",
		"SEARCH_TAGS_PERIOD" => "",
		"SEARCH_TAGS_FONT_MAX" => "50",
		"SEARCH_TAGS_FONT_MIN" => "10",
		"SEARCH_TAGS_COLOR_NEW" => "3E74E6",
		"SEARCH_TAGS_COLOR_OLD" => "C0C0C0",
		"AJAX_OPTION_ADDITIONAL" => "",
		"LOG_NEW_TEMPLATE" => "Y",
		"COMPONENT_TEMPLATE" => "2021",
		"GROUP_USE_KEYWORDS" => "Y",
		"GROUP_THUMBNAIL_SIZE" => "",
		"LOG_THUMBNAIL_SIZE" => "",
		"LOG_COMMENT_THUMBNAIL_SIZE" => "",
		"SM_THEME" => "grey",
		"USE_MAIN_MENU" => "N",
		"RATING_TYPE" => "",
		"PATH_TO_USER_CALENDAR" => "/company/personal/user/#user_id#/calendar/",
		"PATH_TO_USER_LOG_ENTRY" => "/company/personal/log/#log_id#/",
		"PATH_TO_USER_TASKS_TEMPLATES" => "/company/personal/user/#user_id#/tasks/templates/",
		"PATH_TO_USER_TEMPLATES_TEMPLATE" => "/company/personal/user/#user_id#/tasks/templates/template/#action#/#template_id#/",
		"PATH_TO_USER_BLOG_POST_IMPORTANT" => "user/#user_id#/blog/important/",
		"PATH_TO_BIZPROC_TASK_LIST" => "/company/personal/user/#user_id#/bizproc/",
		"PATH_TO_BIZPROC_TASK" => "/company/personal/user/#user_id#/bizproc/#id#/",
		"LOG_SUBSCRIBE_ONLY" => "N",
		"LOG_RSS_TTL" => "60",
		"GROUP_PROPERTY" => array(
		),
		"GROUP_USE_BAN" => "Y",
		"ALLOW_POST_MOVE" => "N",
		"BLOG_IMAGE_MAX_WIDTH" => "600",
		"BLOG_IMAGE_MAX_HEIGHT" => "600",
		"BLOG_COMMENT_ALLOW_VIDEO" => "Y",
		"BLOG_COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
		"BLOG_SHOW_SPAM" => "N",
		"BLOG_NO_URL_IN_COMMENTS" => "",
		"BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => "",
		"BLOG_ALLOW_POST_CODE" => "Y",
		"BLOG_USE_GOOGLE_CODE" => "Y",
		"BLOG_USE_CUT" => "N",
		"FORUM_THEME" => "blue",
		"USER_FIELDS_FORUM" => array(
		),
		"SHOW_VOTE" => "N",
		"FORUM_AJAX_POST" => "N",
		"PHOTO_UPLOAD_MAX_FILESIZE" => "1047527424",
		"PHOTO_COMMENTS_TYPE" => "forum",
		"LOG_PHOTO_COUNT" => "6",
		"LOG_PHOTO_THUMBNAIL_SIZE" => "48",
		"SHOW_SEARCH_TAGS_CLOUD" => "N",
		"SEARCH_FILTER_NAME" => "sonet_search_filter",
		"SEARCH_FILTER_DATE_NAME" => "sonet_search_filter_date",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"MAIN_MENU_TYPE" => "top",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"search" => "index.php",
			"group_reindex" => "group_reindex.php",
			"group_content_search" => "group/#group_id#/search/",
			"group_subscribe" => "group/#group_id#/subscribe/",
			"group" => "group/#group_id#/",
			"group_search" => "group/search/",
			"group_search_subject" => "group/search/#subject_id#/",
			"group_edit" => "group/#group_id#/edit/",
			"group_delete" => "group/#group_id#/delete/",
			"group_request_search" => "group/#group_id#/user_search/",
			"group_request_user" => "group/#group_id#/user/#user_id#/request/",
			"user_request_group" => "group/#group_id#/user_request/",
			"group_requests" => "group/#group_id#/requests/",
			"group_requests_out" => "group/#group_id#/requests_out/",
			"group_mods" => "group/#group_id#/moderators/",
			"group_users" => "group/#group_id#/users/",
			"group_ban" => "group/#group_id#/ban/",
			"user_leave_group" => "group/#group_id#/user_leave/",
			"group_features" => "group/#group_id#/features/",
			"group_log" => "group/#group_id#/log/",
			"group_photo" => "group/#group_id#/photo/",
			"group_calendar" => "group/#group_id#/calendar/",
			"group_files" => "group/#group_id#/files/#path#",
			"group_blog" => "group/#group_id#/blog/",
			"group_blog_post_edit" => "group/#group_id#/blog/edit/#post_id#/",
			"group_blog_rss" => "group/#group_id#/blog/rss/#type#/",
			"group_blog_draft" => "group/#group_id#/blog/draft/",
			"group_blog_post" => "group/#group_id#/blog/#post_id#/",
			"group_blog_moderation" => "group/#group_id#/blog/moderation/",
			"group_forum" => "group/#group_id#/forum/",
			"group_forum_topic_edit" => "group/#group_id#/forum/edit/#topic_id#/",
			"group_forum_topic" => "group/#group_id#/forum/#topic_id#/",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>