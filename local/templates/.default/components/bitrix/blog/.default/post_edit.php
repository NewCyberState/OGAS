<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if($arParams["STATUS_ID"]==11):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Создание референдума</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>Ваша петиция была поддержана гражданами, прошла этап общественных обсуждений и сейчас вам необходимо создать на ее основе новый референдум. Изучите пожалуйста результаты обсуждений и подготовьте текст законопроекта, который будет вынесен на референдум. Сохраните новый референдум, он появится в разделе "Мои референдумы". Все граждане, состоящие в группе, с которой была связана исходная петиция, увидят референдум и смогут за него проголосовать. По окончании голосования, если законопроект будет утвержден большинством голосов членов группы - он станет законом и появится в разделе "Принятые законы".</p>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

<?
global $USER;

$post=CBlogPost::GetByID($arResult[VARIABLES][post_id]);
$blog=CBlog::GetByID($post[BLOG_ID]);
$arResult[VARIABLES][blog]=$blog[URL];

if($USER->IsAdmin())
	$arPostProperty = array(
		0 => "UF_BLOG_POST_VOTE",
		1 => "UF_THEMATICS",
		2 => "UF_BLOG_POST_FILE",
		3 => "UF_DECISION",
		4 => "UF_STATUS",
        5 => "UF_STATUS_DATE",
	);
else
	$arPostProperty = array(
		0 => "UF_BLOG_POST_VOTE",
		1 => "UF_THEMATICS",
		2 => "UF_BLOG_POST_FILE",
		3 => "UF_DECISION",
	);

$arPost=CBlogPost::GetByID($arResult["VARIABLES"]["post_id"]);

$componentPostEditParams = Array(
	"BLOG_VAR"			=> $arResult["ALIASES"]["blog"],
	"POST_VAR"			=> $arResult["ALIASES"]["post_id"],
	"USER_VAR"			=> $arResult["ALIASES"]["user_id"],
	"PAGE_VAR"			=> $arResult["ALIASES"]["page"],
	"PATH_TO_BLOG"		=> ".",
	"PATH_TO_POST"		=> $arResult["PATH_TO_POST"],
	"PATH_TO_USER"		=> ".",
	"PATH_TO_POST_EDIT"	=> $arResult["PATH_TO_POST_EDIT"],
	"PATH_TO_DRAFT"		=> $arResult["PATH_TO_DRAFT"],
	"PATH_TO_SMILE"		=> $arResult["PATH_TO_SMILE"],
	"BLOG_URL"			=> ".",
	"ID"				=> $arResult["VARIABLES"]["post_id"],
	"SET_TITLE"			=> $arResult["SET_TITLE"],
	"POST_PROPERTY"		=> $arPostProperty,
	"DATE_TIME_FORMAT"	=> $arResult["DATE_TIME_FORMAT"],
	"GROUP_ID" 			=> $arParams["GROUP_ID"],
	"SMILES_COUNT" 		=> $arParams["SMILES_COUNT"],
	"ALLOW_POST_MOVE" 	=> $arParams["ALLOW_POST_MOVE"],
	"PATH_TO_BLOG_POST" => ".",
	"PATH_TO_BLOG_POST_EDIT" 	=> $arResult["PATH_TO_POST_EDIT"],
	"PATH_TO_BLOG_DRAFT" 		=> $arResult["PATH_TO_DRAFT"],
	"PATH_TO_BLOG_BLOG" 		=> ".",
	"PATH_TO_USER_POST" 		=> ".",
	"PATH_TO_USER_POST_EDIT" 	=> $arParams["PATH_TO_USER_POST_EDIT"],
	"PATH_TO_USER_DRAFT" 		=> $arParams["PATH_TO_USER_DRAFT"],
	"PATH_TO_USER_BLOG" 		=> ".",
	"PATH_TO_GROUP_POST" 		=> $arParams["PATH_TO_GROUP_POST"],
	"PATH_TO_GROUP_POST_EDIT" 	=> $arParams["PATH_TO_GROUP_POST_EDIT"],
	"PATH_TO_GROUP_DRAFT" 		=> $arParams["PATH_TO_GROUP_DRAFT"],
	"PATH_TO_GROUP_BLOG" 		=> $arParams["PATH_TO_GROUP_BLOG"],
	"NAME_TEMPLATE" 			=> $arParams["NAME_TEMPLATE"],
	"SHOW_LOGIN" 				=> $arParams["SHOW_LOGIN"],
	"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
	"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
	"EDITOR_RESIZABLE" => $arParams["EDITOR_RESIZABLE"],
	"EDITOR_DEFAULT_HEIGHT" => $arParams["EDITOR_DEFAULT_HEIGHT"],
	"EDITOR_CODE_DEFAULT" => $arParams["EDITOR_CODE_DEFAULT"],
	"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
	"USE_GOOGLE_CODE" => $arParams["USE_GOOGLE_CODE"],
	"SEO_USE" => $arParams["SEO_USE"],
	/*"USE_SOCNET" => "Y",*/
	"USER_ID" => $arPost[AUTHOR_ID],
	"STATUS_ID" => $arParams["STATUS_ID"],
	/*"SOCNET_GROUP_ID" => "4",*/

);
if(isset($arParams["USER_CONSENT"]))
	$componentPostEditParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
if(isset($arParams["USER_CONSENT_ID"]))
	$componentPostEditParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
	$componentPostEditParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
if(isset($arParams["USER_CONSENT_IS_LOADED"]))
	$componentPostEditParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];

if($arParams["STATUS_ID"]==11)
    $template="referendum";
else
    $template="petition";

$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.blog.post.edit",
    $template,
	$componentPostEditParams,
	$component
);
?>

        <?if($arParams["STATUS_ID"]==11) {

            $APPLICATION->IncludeComponent(
                "bitrix:blog.post",
                "petition",
                Array(
                    "BLOG_VAR" => $arResult["ALIASES"]["blog"],
                    "POST_VAR" => $arResult["ALIASES"]["post_id"],
                    "USER_VAR" => $arResult["ALIASES"]["user_id"],
                    "PAGE_VAR" => $arResult["ALIASES"]["page"],
                    "PATH_TO_BLOG" => $arResult["PATH_TO_BLOG"],
                    "PATH_TO_POST" => $arResult["PATH_TO_POST"],
                    "PATH_TO_BLOG_CATEGORY" => $arResult["PATH_TO_BLOG_CATEGORY"],
                    "PATH_TO_POST_EDIT" => $arResult["PATH_TO_POST_EDIT"],
                    "PATH_TO_USER" => $arResult["PATH_TO_USER"],
                    "PATH_TO_SMILE" => $arResult["PATH_TO_SMILE"],
                    "BLOG_URL" => $arResult["VARIABLES"]["blog"],
                    "ID" => $arResult["VARIABLES"]["post_id"],
                    "CACHE_TYPE" => $arResult["CACHE_TYPE"],
                    "CACHE_TIME" => $arResult["CACHE_TIME"],
                    "SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
                    "SET_TITLE" => $arResult["SET_TITLE"],
                    "POST_PROPERTY" => $arParams["POST_PROPERTY"],
                    "DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
                    "GROUP_ID" => $arParams["GROUP_ID"],
                    "SEO_USER" => $arParams["SEO_USER"],
                    "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                    "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                    "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
                    "PATH_TO_SONET_USER_PROFILE" => $arParams["PATH_TO_SONET_USER_PROFILE"],
                    "PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
                    "PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
                    "USE_SHARE" => $arParams["USE_SHARE"],
                    "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                    "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                    "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                    "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                    "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                    "SHOW_RATING" => $arParams["SHOW_RATING"],
                    "RATING_TYPE" => $arParams["RATING_TYPE"],
                    "IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
                    "IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
                    "ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
                    "SEO_USE" => $arParams["SEO_USE"],
                    "STATUS_ID" => $arParams["STATUS_ID"],

                ),
                $component
            );
        }
        ?>


<?
if($arParams["STATUS_ID"]==11) {
    $componentCommentName = "bitrix:blog.post.comment";
    if (isset($arParams["COMMENTS_LIST_VIEW"]) && $arParams["COMMENTS_LIST_VIEW"] == "Y")
        $componentCommentName = 'bitrix:blog.post.comment.list';

    $componentCommentParams = array(
        "BLOG_VAR"		=> $arResult["ALIASES"]["blog"],
        "USER_VAR"		=> $arResult["ALIASES"]["user_id"],
        "PAGE_VAR"		=> $arResult["ALIASES"]["page"],
        "POST_VAR"		=> $arResult["ALIASES"]["post_id"],
        "PATH_TO_BLOG"	=> $arResult["PATH_TO_BLOG"],
        "PATH_TO_POST"	=> $arResult["PATH_TO_POST"],
        "PATH_TO_USER"	=> $arResult["PATH_TO_USER"],
        "PATH_TO_SMILE"	=> $arResult["PATH_TO_SMILE"],
        "BLOG_URL"		=> $arResult["VARIABLES"]["blog"],
        "ID"			=> $arResult["VARIABLES"]["post_id"],
        "CACHE_TYPE"	=> $arResult["CACHE_TYPE"],
        "CACHE_TIME"	=> $arResult["CACHE_TIME"],
        "COMMENTS_COUNT" => $arResult["COMMENTS_COUNT"],
        "DATE_TIME_FORMAT"	=> $arResult["DATE_TIME_FORMAT"],
        "USE_ASC_PAGING"	=> $arParams["USE_ASC_PAGING"],
        "NOT_USE_COMMENT_TITLE"	=> $arParams["NOT_USE_COMMENT_TITLE"],
        "GROUP_ID" 			=> $arParams["GROUP_ID"],
        "SEO_USER"			=> $arParams["SEO_USER"],
        "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
        "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
        "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
        "PATH_TO_SONET_USER_PROFILE" => $arParams["PATH_TO_SONET_USER_PROFILE"],
        "PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
        "PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
        "SHOW_RATING" => $arParams["SHOW_RATING"],
        "RATING_TYPE" => $arParams["RATING_TYPE"],
        "SMILES_COUNT" => $arParams["SMILES_COUNT"],
        "IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
        "IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
        "EDITOR_RESIZABLE" => $arParams["COMMENT_EDITOR_RESIZABLE"],
        "EDITOR_DEFAULT_HEIGHT" => $arParams["COMMENT_EDITOR_DEFAULT_HEIGHT"],
        "EDITOR_CODE_DEFAULT" => $arParams["COMMENT_EDITOR_CODE_DEFAULT"],
        "ALLOW_VIDEO" => $arParams["COMMENT_ALLOW_VIDEO"],
        "ALLOW_IMAGE_UPLOAD" => $arParams["COMMENT_ALLOW_IMAGE_UPLOAD"],
        "ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
        "SHOW_SPAM" => $arParams["SHOW_SPAM"],
        "NO_URL_IN_COMMENTS" => $arParams["NO_URL_IN_COMMENTS"],
        "NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["NO_URL_IN_COMMENTS_AUTHORITY"],
        "AJAX_POST" => $arParams["AJAX_POST"],
        "COMMENT_PROPERTY" => $arParams["COMMENT_PROPERTY"],
        "AJAX_PAGINATION" => $arParams["AJAX_PAGINATION"],
    );
    if (isset($arParams["USER_CONSENT"]))
        $componentCommentParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
    if (isset($arParams["USER_CONSENT_ID"]))
        $componentCommentParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
    if (isset($arParams["USER_CONSENT_IS_CHECKED"]))
        $componentCommentParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
    if (isset($arParams["USER_CONSENT_IS_LOADED"]))
        $componentCommentParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
    $componentCommentParams["USER_CONSENT_FOR_REGISTERED"] = "Y";    // get consent for registered

    $APPLICATION->IncludeComponent(
        $componentCommentName,
        '',
        $componentCommentParams,
        $component
    );
    $componentPostEditParams["COMMENTS_BLOCK"]=$comments;

}
?>
