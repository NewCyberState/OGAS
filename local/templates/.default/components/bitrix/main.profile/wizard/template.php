<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
    CJSCore::Init('phone_auth');
}


    global $USER;

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;



    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/wizards/steps.min.js");
    Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/cookie.js");
    Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/validation/validate.min.js");
    Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_wizard.js");
    Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js");
    Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_multiselect.js");
    Asset::getInstance()->addJs("/local/assets/js/app.js");


if($_REQUEST[save]=="Y")
    LocalRedirect("/lkg/gos/");

?>

<div class="row">
    <div class="col-lg-12">

        <!-- Basic setup -->
        <div class="card">
            <div class="card-header bg-white text-center">
                <h5 class="card-title"><b>Добро пожаловать <?=$USER->GetFirstName()?>!</b> <br>Вы всего в 3-х шагах от того, чтобы стать полноценным гражданином кибергосударства!</h5>
            </div>


            <form method="post" name="form1" class="wizard-form steps-basic" data-fouc action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                <?=$arResult["BX_SESSION_CHECK"]?>
                <input type="hidden" name="lang" value="<?=LANG?>" />
                <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                <input type="hidden" name="save" value="Y" />

                <h6>Назначьте делегатов</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="alert alert-danger border-0 alert-dismissible d-none">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                <span id="notdelegated"></span>
                            </div>

                            <div class="form-group">
                                <h5>Назначьте делегатов</h5>
                                <p>Сейчас вам необходимо назначить своих делегатов по всем тематикам законотворчества. Делегаты смогут распоряжаться вашим голосом при голосовании на референдумах, если по каким-либо причинам вы не смогли проголосовать самостоятельно. Если вы голосуете лично и напрямую - ваш голос никому не будет делегирован, а будет учтен ваш персональный выбор. Чем больше делегатов вы назначите, тем выше вероятность того, что ваш голос будет учтен при голосовании на любом референдуме. Выбирайте делегатами тех граждан, кого вы хорошо знаете по реальным делам, кому вы полностью доверяете и кто будет выражать ваши интересы при принятии всех общегосударственных решений. Назначить и освободить делегатов по отдельным тематикам можно будет позже, в разделе "Мои делегаты". Назначение делегатов является обязательным условием для того, чтобы стать гражданином кибергосударства!</p>
                            </div>
                            <div class="row">

                            <?
                            $rsUsers = CUser::GetList(($by="ID"), ($order="DESC"),
                                array(
                                    'ACTIVE' => 'Y',
                                    'NAME' => htmlspecialchars($_GET['q']),
                                    '!UF_THEMATICS' => false,
                                ),
                                array("SELECT"=>array("UF_*"))

                            );


                            ?>


                                <? $rsUsers->NavStart(24); // разбиваем постранично по 50 записей
                                $rsUsers->bShowAll=false;



                                while($user=$rsUsers->NavNext(false, "f_")) {
                                    if($user[ID]==$USER->GetID())
                                        continue;

                                    $thematics=array();
                                    foreach ($user[UF_THEMATICS] as $item)
                                    {
                                        $sec=GetSection($item);
                                        $thematics[]=$sec["NAME"];
                                    }




                                    $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
                                    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

                                    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                                    $entity_data_class = $entity->getDataClass();



                                    $data = array(
                                        "UF_USER"=>$USER->GetID(),
                                        "UF_DELEGATE"=>$user[ID],
                                    );
                                    $result = $entity_data_class::getList(array(
                                        "select" => array("*"),
                                        "order" => array("ID" => "ASC"),
                                        "filter" => $data
                                    ));

                                    $alreadydelegate=false;

                                    while($arData = $result->Fetch()) {
                                        if(!empty($arData))
                                        {
                                            $alreadydelegate=true;
                                            break;
                                        }
                                    }











                                    $file = CFile::ResizeImageGet($user[PERSONAL_PHOTO], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                                    ?>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="card-img-actions d-inline-block">
                                                    <a  data-popup="popover" data-trigger="hover" data-placement="top" data-content="<?=$user[PERSONAL_NOTES]?>"  href="/user/<?=$user[ID]?>/" class="btn btn-outline bg-white border-white border-2 btn-icon rounded-round">
                                                        <img class="rounded-circle mb-2" style="object-fit: cover" src="<?=$file['src']?>" alt="" width="100" height="100">

                                                    <h6 class="font-weight-semibold mb-0 text-primary"><?=$user[NAME]." ".$user[LAST_NAME]?></h6> </a>
                                                </div>
                                                <div class="d-block mb-1">
                                                <a  data-popup="popover" data-trigger="hover" data-placement="top" data-content="<?=implode(". ",$thematics)?>"  href="javascript:"><?=count($user[UF_THEMATICS])." ".plural_form(count($user[UF_THEMATICS]),array("компетенция","компетенции","компетенций"))?></a>
                                                </div>

                                                <?
                                                if($alreadydelegate){
                                                    ?>
                                                    <a href="javascript:" onclick="undelegateall(<?=$USER->GetID()?>,<?=$user[ID]?>,$(this))" class="btn bg-light mt-1">Освободить делегата</a>
                                                <?}
                                                else
                                                {
                                                    ?>
                                                    <a href="javascript:" onclick="delegateall(<?=$USER->GetID()?>,<?=$user[ID]?>,$(this))" class="btn bg-primary mt-1">Назначить делегатом</a>

                                                <?}?>

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









                            <?/*$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section.list",
                                    "thematics",
                                    Array(
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "N",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "N",
                                        "COUNT_ELEMENTS" => "Y",
                                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                        "FILTER_NAME" => "sectionsFilter",
                                        "IBLOCK_ID" => "5",
                                        "IBLOCK_TYPE" => "ogas",
                                        "SECTION_CODE" => "",
                                        "SECTION_FIELDS" => array(0=>"",1=>"",),
                                        "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                        "SECTION_URL" => "",
                                        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                                        "SHOW_PARENT_NAME" => "Y",
                                        "TOP_DEPTH" => "2",
                                        "VIEW_MODE" => "LINE"
                                    )
                                );*/?>


                        </div>


                    </div>


                </fieldset>

                <h6>Станьте делегатом</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Станьте делегатом</h5>
                            <div class="form-group">
                                <p>Если вы хотите, чтобы другие граждане могли выбирать вас делегатом и передавать вам свой голос для голосования на референдумах,  вам необходимо выбрать ваши компетенции и рассказать о себе, о своем опыте и своих достижениях в поле "Биография".</p>

<?// ********************* User properties ***************************************************?>

                    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>

                                <?if ($arUserField["MANDATORY"]=="Y"):?>
                                    <span class="starrequired">*</span>
                                <?endif;?>
                                <div class="mb-1 mt-3 font-weight-semibold">
                                <?=$arUserField["EDIT_FORM_LABEL"]?>:
                                <?if($FIELD_NAME=="UF_THEMATICS"):?>
                                    <i class="icon-question text-secondary  font-size-lg icon-question4"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$arUserField["HELP_MESSAGE"]?>' ></i>
                                <?endif;?>
                                </div>
                                <?$arUserField['USER_TYPE']['USE_FIELD_COMPONENT'] = 0;

                                $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
                    <?endforeach;?>

                                <div class="mb-1 mt-3 font-weight-semibold">
                                    Биография: <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='Расскажите подробнее о себе, о своем практическом опыте, о своих достижениях. Если вы хотите, чтобы другие граждане делегировали вам свой голос, постарайтесь убедить их в вашей компетентности.' ></i></div>
                                    <textarea class="form-control"  cols="30" rows="10" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea></td>

                            </div>
                <?// ******************** /User properties ***************************************************?>

                    </div>
                    </div>
                </fieldset>

                <h6>Готово!</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12  text-center">
                            <h5>Вы стали гражданином!</h5>
                            <img src="/upload/medialibrary/f2a/f2a7f4bfcb774ac4404634e73469ff39.png" class="img-fluid img-thumbnail mb-2" width="1000" height="562">
                            <div class="form-group">
                                <p>Поздравляем, вы стали гражданином Нового Кибернетического Государства! Теперь вам доступен весь функционал Общегосударственной Автоматизированной Системы. Вы можете создавать петиции, принимать участие в обсуждениях, участвовать в референдумах и другие возможности. В случае, если вы не сможете самостоятельно принять участия в голосованиях на референдумах - за вас смогут это сделать ваши делегаты. При принятии любых общегосударственных решений ваш голос всегда будет учтен!</p>

                                <p>Нажав кнопку "Готово" вы перейдете в раздел "Управление государством", где сможете воспользоваться всеми функциональными возможностями, доступными гражданину.</p>


                            <?/*$APPLICATION->IncludeComponent(
                                "bitrix:socialnetwork_group",
                                "template2",
                                array(
                                    "ALLOW_POST_MOVE" => "Y",
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
                                    "CAN_OWNER_EDIT_DESKTOP" => "N",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
                                    "FORUM_AJAX_POST" => "N",
                                    "FORUM_ID" => "1",
                                    "FORUM_THEME" => "blue",
                                    "GROUP_PROPERTY" => array(
                                    ),
                                    "GROUP_THUMBNAIL_SIZE" => "",
                                    "GROUP_USE_BAN" => "N",
                                    "GROUP_USE_KEYWORDS" => "N",
                                    "ITEM_DETAIL_COUNT" => "100",
                                    "ITEM_MAIN_COUNT" => "6",
                                    "LOG_COMMENT_THUMBNAIL_SIZE" => "",
                                    "LOG_NEW_TEMPLATE" => "N",
                                    "LOG_PHOTO_COUNT" => "6",
                                    "LOG_PHOTO_THUMBNAIL_SIZE" => "48",
                                    "LOG_RSS_TTL" => "60",
                                    "LOG_SUBSCRIBE_ONLY" => "N",
                                    "LOG_THUMBNAIL_SIZE" => "",
                                    "MAIN_MENU_TYPE" => "top",
                                    "NAME_TEMPLATE" => "",
                                    "PATH_TO_BIZPROC_TASK" => "/company/personal/user/#user_id#/bizproc/#id#/",
                                    "PATH_TO_BIZPROC_TASK_LIST" => "/company/personal/user/#user_id#/bizproc/",
                                    "PATH_TO_BLOG_SMILE" => "/bitrix/images/blog/smile/",
                                    "PATH_TO_GROUP_CREATE" => "",
                                    "PATH_TO_MESSAGES_CHAT" => "/company/personal/messages/chat/#user_id#/",
                                    "PATH_TO_MESSAGE_FORM_MESS" => "/company/personal/messages/form/#user_id#/#message_id#/",
                                    "PATH_TO_SEARCH_EXTERNAL" => "",
                                    "PATH_TO_SMILE" => "/bitrix/images/socialnetwork/smile/",
                                    "PATH_TO_SUBSCRIBE" => "",
                                    "PATH_TO_USER" => "",
                                    "PATH_TO_USER_BLOG_POST" => "",
                                    "PATH_TO_USER_BLOG_POST_EDIT" => "",
                                    "PATH_TO_USER_BLOG_POST_IMPORTANT" => "user/#user_id#/blog/important/",
                                    "PATH_TO_USER_CALENDAR" => "/company/personal/user/#user_id#/calendar/",
                                    "PATH_TO_USER_LOG" => "/company/personal/log/",
                                    "PATH_TO_USER_LOG_ENTRY" => "/company/personal/log/#log_id#/",
                                    "PATH_TO_USER_TASKS_TEMPLATES" => "/company/personal/user/#user_id#/tasks/templates/",
                                    "PATH_TO_USER_TEMPLATES_TEMPLATE" => "/company/personal/user/#user_id#/tasks/templates/template/#action#/#template_id#/",
                                    "PHOTO_ALBUM_PHOTO_THUMBS_SIZE" => "120",
                                    "PHOTO_ELEMENTS_PAGE_ELEMENTS" => "50",
                                    "PHOTO_GROUP_IBLOCK_ID" => "1",
                                    "PHOTO_GROUP_IBLOCK_TYPE" => "photos",
                                    "PHOTO_MODERATION" => "N",
                                    "PHOTO_ORIGINAL_SIZE" => "1280",
                                    "PHOTO_PATH_TO_FONT" => "",
                                    "PHOTO_SECTION_PAGE_ELEMENTS" => "15",
                                    "PHOTO_SHOW_WATERMARK" => "Y",
                                    "PHOTO_THUMBNAIL_SIZE" => "100",
                                    "PHOTO_UPLOAD_MAX_FILESIZE" => "1047527424",
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
                                    "SEF_FOLDER" => "/personal/wizard/",
                                    "SEF_MODE" => "Y",
                                    "SET_NAV_CHAIN" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_LOGIN" => "Y",
                                    "SHOW_RATING" => "",
                                    "SHOW_SEARCH_TAGS_CLOUD" => "Y",
                                    "SHOW_VOTE" => "N",
                                    "SHOW_YEAR" => "Y",
                                    "SM_THEME" => "grey",
                                    "USER_FIELDS_FORUM" => array(
                                    ),
                                    "USER_PROPERTY_CONTACT" => array(
                                    ),
                                    "USER_PROPERTY_MAIN" => array(
                                    ),
                                    "USER_PROPERTY_PERSONAL" => array(
                                    ),
                                    "USE_MAIN_MENU" => "N",
                                    "PATH_TO_BLOG_POST" => "",
                                    "PATH_TO_BLOG_POST_EDIT" => "",
                                    "PATH_TO_BLOG_DRAFT" => "",
                                    "PATH_TO_BLOG_BLOG" => "",
                                    "PATH_TO_USER_POST" => "",
                                    "PATH_TO_USER_POST_EDIT" => "",
                                    "PATH_TO_USER_DRAFT" => "",
                                    "PATH_TO_USER_BLOG" => "",
                                    "SEF_URL_TEMPLATES" => array(
                                        "index" => "index.php",
                                        "search" => "search.php",
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
                            );*/?>

                        </div>
                    </div>
                </fieldset>


            </form>
        </div>
        <!-- /basic setup -->
    </div>
</div>