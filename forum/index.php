<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Форум");
?><?$APPLICATION->IncludeComponent(
	"bitrix:forum", 
	".default", 
	array(
		"AJAX_POST" => "N",
		"ATTACH_MODE" => array(
			0 => "THUMB",
		),
		"ATTACH_SIZE" => "90",
		"CACHE_TIME" => "3600",
		"CACHE_TIME_FOR_FORUM_STAT" => "3600",
		"CACHE_TIME_USER_STAT" => "60",
		"CACHE_TYPE" => "A",
		"CHECK_CORRECT_TEMPLATES" => "N",
		"DATE_FORMAT" => "d.m.Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"EDITOR_CODE_DEFAULT" => "N",
		"FID" => array(
			0 => "3",
			1 => "4",
			2 => "6",
			3 => "7",
			4 => "8",
			5 => "9",
			6 => "10",
		),
		"FORUMS_PER_PAGE" => "10",
		"HELP_CONTENT" => "",
		"IMAGE_SIZE" => "500",
		"MESSAGES_PER_PAGE" => "10",
		"NAME_TEMPLATE" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGE_NAVIGATION_TEMPLATE" => "forum",
		"PAGE_NAVIGATION_WINDOW" => "5",
		"PATH_TO_AUTH_FORM" => "",
		"RATING_ID" => array(
			0 => "3",
		),
		"RATING_TYPE" => "",
		"RESTART" => "N",
		"RULES_CONTENT" => "",
		"SEF_MODE" => "Y",
		"SEND_MAIL" => "E",
		"SEO_USER" => "Y",
		"SEO_USE_AN_EXTERNAL_SERVICE" => "N",
		"SET_DESCRIPTION" => "N",
		"SET_NAVIGATION" => "Y",
		"SET_PAGE_PROPERTY" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_AUTHOR_COLUMN" => "N",
		"SHOW_AUTH_FORM" => "Y",
		"SHOW_FIRST_POST" => "N",
		"SHOW_FORUMS" => "Y",
		"SHOW_FORUM_ANOTHER_SITE" => "Y",
		"SHOW_FORUM_USERS" => "N",
		"SHOW_LEGEND" => "Y",
		"SHOW_NAVIGATION" => "Y",
		"SHOW_RATING" => "",
		"SHOW_STATISTIC_BLOCK" => array(
			0 => "STATISTIC",
			1 => "USERS_ONLINE",
		),
		"SHOW_SUBSCRIBE_LINK" => "N",
		"SHOW_TAGS" => "Y",
		"SHOW_VOTE" => "N",
		"THEME" => "blue",
		"TIME_INTERVAL_FOR_USER_STAT" => "10",
		"TMPLT_SHOW_ADDITIONAL_MARKER" => "new",
		"TOPICS_PER_PAGE" => "10",
		"USER_FIELDS" => array(
		),
		"USER_PROPERTY" => array(
		),
		"USE_LIGHT_VIEW" => "N",
		"USE_NAME_TEMPLATE" => "N",
		"USE_RSS" => "Y",
		"WORD_LENGTH" => "50",
		"WORD_WRAP_CUT" => "23",
		"COMPONENT_TEMPLATE" => ".default",
		"RSS_CACHE" => "1800",
		"RSS_TYPE_RANGE" => array(
		),
		"RSS_COUNT" => "30",
		"RSS_TN_TITLE" => "",
		"RSS_TN_DESCRIPTION" => "",
		"SEF_FOLDER" => "/forum/",
		"VOTE_CHANNEL_ID" => "1",
		"VOTE_GROUP_ID" => "",
		"VOTE_TEMPLATE" => "light",
		"VOTE_UNIQUE" => array(
			0 => "8",
		),
		"VOTE_UNIQUE_IP_DELAY" => "10 D",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"list" => "forum#FID#/",
			"read" => "forum#FID#/#TITLE_SEO#",
			"message" => "messages/forum#FID#/message#MID#/#TITLE_SEO#",
			"help" => "help/",
			"rules" => "rules/",
			"message_appr" => "messages/approve/forum#FID#/topic#TID#/",
			"message_move" => "messages/move/forum#FID#/topic#TID#/message#MID#/",
			"rss" => "rss/#TYPE#/#MODE#/#IID#/",
			"search" => "search/",
			"subscr_list" => "subscribe/",
			"active" => "topic/new/",
			"topic_move" => "topic/move/forum#FID#/topic#TID#/",
			"topic_new" => "topic/add/forum#FID#/",
			"topic_search" => "topic/search/",
			"user_list" => "users/",
			"profile" => "user/#UID#/edit/",
			"profile_view" => "user/#UID#/",
			"user_post" => "user/#UID#/post/#mode#/",
			"message_send" => "user/#UID#/send/#TYPE#/",
			"pm_list" => "pm/folder#FID#/",
			"pm_edit" => "pm/folder#FID#/message#MID#/user#UID#/#mode#/",
			"pm_read" => "pm/folder#FID#/message#MID#/",
			"pm_search" => "pm/search/",
			"pm_folder" => "pm/folders/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>