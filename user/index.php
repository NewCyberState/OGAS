<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Граждане");

?>
<?$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork_user", 
	"ogas", 
	array(
		"ALLOWALL_USER_PROFILE_FIELDS" => "N",
		"ALLOW_POST_MOVE" => "N",
		"ALLOW_RATING_SORT" => "N",
		"BLOG_ALLOW_POST_CODE" => "Y",
		"BLOG_COMMENT_AJAX_POST" => "N",
		"BLOG_COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
		"BLOG_COMMENT_ALLOW_VIDEO" => "Y",
		"BLOG_GROUP_ID" => "1",
		"BLOG_IMAGE_MAX_HEIGHT" => "600",
		"BLOG_IMAGE_MAX_WIDTH" => "600",
		"BLOG_NO_URL_IN_COMMENTS" => "",
		"BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => "",
		"BLOG_SHOW_SPAM" => "N",
		"BLOG_USE_CUT" => "N",
		"BLOG_USE_GOOGLE_CODE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TIME_LONG" => "604800",
		"CACHE_TYPE" => "A",
		"CAN_OWNER_EDIT_DESKTOP" => "Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"EDITABLE_FIELDS" => array(
			0 => "LOGIN",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "EMAIL",
			5 => "PERSONAL_BIRTHDAY",
			6 => "PERSONAL_WWW",
			7 => "PERSONAL_ICQ",
			8 => "PERSONAL_GENDER",
			9 => "PERSONAL_PHOTO",
			10 => "PERSONAL_PHONE",
			11 => "PERSONAL_FAX",
			12 => "PERSONAL_MOBILE",
			13 => "PERSONAL_PAGER",
			14 => "PERSONAL_COUNTRY",
			15 => "PERSONAL_STATE",
			16 => "PERSONAL_CITY",
			17 => "PERSONAL_ZIP",
			18 => "PERSONAL_STREET",
			19 => "PERSONAL_MAILBOX",
		),
		"FORUM_AJAX_POST" => "N",
		"FORUM_ID" => "2",
		"FORUM_THEME" => "blue",
		"GROUP_THUMBNAIL_SIZE" => "",
		"GROUP_USE_KEYWORDS" => "Y",
		"ITEM_DETAIL_COUNT" => "32",
		"ITEM_MAIN_COUNT" => "6",
		"LOG_AUTH" => "N",
		"LOG_COMMENT_THUMBNAIL_SIZE" => "",
		"LOG_NEW_TEMPLATE" => "N",
		"LOG_PHOTO_COUNT" => "6",
		"LOG_PHOTO_THUMBNAIL_SIZE" => "48",
		"LOG_THUMBNAIL_SIZE" => "",
		"NAME_TEMPLATE" => "",
		"PATH_TO_BLOG_SMILE" => "/bitrix/images/blog/smile/",
		"PATH_TO_GROUP" => "",
		"PATH_TO_GROUP_PHOTO" => "/workgroups/group/#group_id#/photo/",
		"PATH_TO_GROUP_PHOTO_ELEMENT" => "/workgroups/group/#group_id#/photo/#section_id#/#element_id#/",
		"PATH_TO_GROUP_PHOTO_SECTION" => "/workgroups/group/#group_id#/photo/album/#section_id#/",
		"PATH_TO_GROUP_POST" => "/workgroups/group/#group_id#/blog/#post_id#/",
		"PATH_TO_GROUP_SEARCH" => "",
		"PATH_TO_GROUP_SUBSCRIBE" => "",
		"PATH_TO_SEARCH_EXTERNAL" => "",
		"PATH_TO_SMILE" => "/bitrix/images/socialnetwork/smile/",
		"PHOTO_ALBUM_PHOTO_THUMBS_SIZE" => "120",
		"PHOTO_ELEMENTS_PAGE_ELEMENTS" => "50",
		"PHOTO_MODERATION" => "N",
		"PHOTO_ORIGINAL_SIZE" => "1280",
		"PHOTO_PATH_TO_FONT" => "",
		"PHOTO_SECTION_PAGE_ELEMENTS" => "15",
		"PHOTO_SHOW_WATERMARK" => "Y",
		"PHOTO_THUMBNAIL_SIZE" => "100",
		"PHOTO_UPLOAD_MAX_FILESIZE" => "1047527424",
		"PHOTO_USER_IBLOCK_ID" => "1",
		"PHOTO_USER_IBLOCK_TYPE" => "photos",
		"PHOTO_USE_COMMENTS" => "N",
		"PHOTO_USE_RATING" => "N",
		"PHOTO_WATERMARK_MIN_PICTURE_SIZE" => "400",
		"PHOTO_WATERMARK_RULES" => "USER",
		"RATING_ID" => array(
		),
		"RATING_TYPE" => "",
		"SEARCH_DEFAULT_SORT" => "rank",
		"SEARCH_FILTER_DATE_NAME" => "sonet_search_filter_date",
		"SEARCH_FILTER_NAME" => "sonet_search_filter",
		"SEARCH_PAGE_RESULT_COUNT" => "10",
		"SEARCH_RESTART" => "N",
		"SEARCH_TAGS_COLOR_NEW" => "3E74E6",
		"SEARCH_TAGS_COLOR_OLD" => "C0C0C0",
		"SEARCH_TAGS_FONT_MAX" => "50",
		"SEARCH_TAGS_FONT_MIN" => "10",
		"SEARCH_TAGS_PAGE_ELEMENTS" => "100",
		"SEARCH_TAGS_PERIOD" => "",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SEF_FOLDER" => "/user/",
		"SEF_MODE" => "Y",
		"SET_NAV_CHAIN" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_LOGIN" => "Y",
		"SHOW_RATING" => "",
		"SHOW_VOTE" => "N",
		"SHOW_YEAR" => "Y",
		"SM_THEME" => "grey",
		"SONET_USER_FIELDS_LIST" => array(
			0 => "PERSONAL_BIRTHDAY",
			1 => "PERSONAL_GENDER",
			2 => "PERSONAL_CITY",
		),
		"SONET_USER_FIELDS_SEARCHABLE" => array(
			0 => "LOGIN",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "PERSONAL_BIRTHDAY",
			5 => "PERSONAL_BIRTHDAY_YEAR",
			6 => "PERSONAL_BIRTHDAY_DAY",
			7 => "PERSONAL_PROFESSION",
			8 => "PERSONAL_GENDER",
			9 => "PERSONAL_COUNTRY",
			10 => "PERSONAL_STATE",
			11 => "PERSONAL_CITY",
			12 => "PERSONAL_ZIP",
			13 => "PERSONAL_STREET",
			14 => "PERSONAL_MAILBOX",
			15 => "WORK_COMPANY",
			16 => "WORK_DEPARTMENT",
			17 => "WORK_POSITION",
			18 => "WORK_COUNTRY",
			19 => "WORK_STATE",
			20 => "WORK_CITY",
			21 => "WORK_ZIP",
			22 => "WORK_STREET",
			23 => "WORK_MAILBOX",
		),
		"SONET_USER_PROPERTY_LIST" => array(
		),
		"SONET_USER_PROPERTY_SEARCHABLE" => array(
		),
		"USER_FIELDS_CONTACT" => array(
		),
		"USER_FIELDS_FORUM" => array(
		),
		"USER_FIELDS_MAIN" => array(
		),
		"USER_FIELDS_PERSONAL" => array(
		),
		"USER_FIELDS_SEARCH_ADV" => array(
			0 => "PERSONAL_GENDER",
			1 => "PERSONAL_COUNTRY",
			2 => "PERSONAL_CITY",
		),
		"USER_FIELDS_SEARCH_SIMPLE" => array(
			0 => "PERSONAL_GENDER",
			1 => "PERSONAL_CITY",
		),
		"USER_PROPERTIES_SEARCH_ADV" => array(
		),
		"USER_PROPERTIES_SEARCH_SIMPLE" => array(
		),
		"USER_PROPERTY_CONTACT" => array(
		),
		"USER_PROPERTY_MAIN" => array(
		),
		"USER_PROPERTY_PERSONAL" => array(
		),
		"USE_MAIN_MENU" => "N",
		"COMPONENT_TEMPLATE" => "ogas",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"user_reindex" => "user_reindex.php",
			"user_content_search" => "user/#user_id#/search/",
			"user" => "#user_id#/",
			"user_friends" => "user/#user_id#/friends/",
			"user_friends_add" => "user/#user_id#/friends/add/",
			"user_friends_delete" => "user/#user_id#/friends/delete/",
			"user_groups" => "user/#user_id#/groups/",
			"user_groups_add" => "user/#user_id#/groups/add/",
			"group_create" => "user/#user_id#/groups/create/",
			"user_profile_edit" => "user/#user_id#/edit/",
			"user_settings_edit" => "user/#user_id#/settings/",
			"user_features" => "user/#user_id#/features/",
			"group_request_group_search" => "group/#user_id#/group_search/",
			"group_request_user" => "group/#group_id#/user/#user_id#/request/",
			"search" => "search.php",
			"message_form" => "messages/form/#user_id#/",
			"message_form_mess" => "messages/chat/#user_id#/#message_id#/",
			"user_ban" => "messages/ban/",
			"messages_chat" => "messages/chat/#user_id#/",
			"messages_input" => "messages/input/",
			"messages_input_user" => "messages/input/#user_id#/",
			"messages_output" => "messages/output/",
			"messages_output_user" => "messages/output/#user_id#/",
			"messages_users" => "messages/",
			"messages_users_messages" => "messages/#user_id#/",
			"log" => "log/",
			"activity" => "user/#user_id#/activity/",
			"subscribe" => "subscribe/",
			"user_subscribe" => "user/#user_id#/subscribe/",
			"user_photo" => "user/#user_id#/photo/",
			"user_calendar" => "user/#user_id#/calendar/",
			"user_files" => "user/#user_id#/files/lib/#path#",
			"user_blog" => "user/#user_id#/blog/",
			"user_blog_post_edit" => "user/#user_id#/blog/edit/#post_id#/",
			"user_blog_rss" => "user/#user_id#/blog/rss/#type#/",
			"user_blog_draft" => "user/#user_id#/blog/draft/",
			"user_blog_post" => "#user_id#/blog/#post_id#/",
			"user_blog_moderation" => "user/#user_id#/blog/moderation/",
			"user_forum" => "user/#user_id#/forum/",
			"user_forum_topic_edit" => "user/#user_id#/forum/edit/#topic_id#/",
			"user_forum_topic" => "user/#user_id#/forum/#topic_id#/",
			"bizproc" => "bizproc/",
			"bizproc_edit" => "bizproc/#task_id#/",
			"video_call" => "video/#user_id#/",
			"processes" => "processes/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>