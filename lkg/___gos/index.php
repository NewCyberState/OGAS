<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Управление государством");

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER;

if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);


/*
$hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();



$data = array(
    "UF_USER"=>$USER->GetID(),
);
$result = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "ASC"),
    "filter" => $data
));

$hasdelegates=false;

while($arData = $result->Fetch()) {
    if(!empty($arData))
    {
        $hasdelegates=true;
        break;
    }
}*/



//if(!$hasdelegates)

/*if(!in_array(8, $USER->GetUserGroupArray()))
    LocalRedirect("/personal/wizard/");*/
?>
<div class="row">
    <div class="col-lg-12">
    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Законодательная система Нового Кибернетического Государства</h5>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        </div>

        <div class="card-body" style="">
            <p>Основной формой политической организации Нового Кибернетического Государства является Делегативная Электронная Демократия, сочетающая преимущества представительной и прямой  демократии.</p>
            <p>Высшей формой власти в государстве является Всенародный Делегативный Электронный Референдум. На референдуме любой гражданин может голосовать как напрямую, так и передав свой голос одному или нескольким делегатам, которые могут голосовать вместо него. Через механизмы делегативных электронных референдумов могут приниматься решения любых уровней, от общегосударственного до уровня отдельного дома или подъезда. В обсуждении и принятии решений должны иметь возможность принимать участие все граждане, кого затронут последствия этих решений.</p>
            <p>Любой гражданин может сообщить обществу о выявленной им проблеме и предложить способ ее решения в форме петиции. Гражданин может добавить новую петицию в любую группу, в которой он состоит. Добавить петицию можно в разделе "Петиции" / "Добавить петицию".</p>
            <p>Чтобы петиция перешла на следующий этап законодательного процесса, она должна быть поддержана не менее, чем 10% участников выбранной группы. Если петиция получила необходимую поддержку - она переводится в раздел "Обсуждения", где начинается обсуждение петиции участниками группы.</p>
            <p>На обсуждение петиции отводится 1 неделя, после чего петиция автоматически переводится в режим "Создание референдума".</p>
            <p>На этапе "Создание референдума" автор петиции обязан на основании петиции и с учетом результатов прошедших обсуждений, создать новый законопроект и выдвинуть его на референдум с вариантами ответов "За" и "Против".
            <p>После создания законопроекта и запуска референдума, созданный референдум появляется в разделе "Референдумы" / "Все референдумы", где все члены группы могут принять участие в голосовании. Этап голосования продолжается в течение 1 недели с момента объявления референдума.</p>
            <p>Если большинство членов группы проголосует "За" - законопроект считается утвержденным, он становится законом и автоматически перемещается в раздел "Принятые законы". При голосовании учитывается делегирование голосов граждан своим делегатам по тематике референдума.</p>
            <p>Если количество голосов "За" меньше половины от общего числа участников группы - законопроект считается отклоненным, он автоматически перемещается в раздел "Отклоненные законы".</p>
            <p>Если закон утвержден - он отправляется на исполнение в органы исполнительной власти, ответственные за его исполнение и переводится в статус "На исполнении". Ответственные органы исполнительной власти осуществляют исполнение принятого закона и отчитываются о его исполнении. По факту исполнения принятого закона он переводится в статус "Исполненные законы". Граждане, принимавшие участие в утверждении закона, могут оценить качество его исполнения поставив свою оценку исполнения закона на странице закона.</p>
            <p>Обращаем внимание, что данная информационная система является  демонстрационной версией Общегосударственной Автоматизированной Системы. Предназначена исключительно для демонстрации функциональных возможностей системы и решения, принятые с ее помощью не носят действительной государственной законодательной силы.</p>

            <p><b>Чтобы начать законодательный процесс, добавьте новую петицию:</b></p>
                <a href="/lkg/gos/petition/add/" class="btn btn-info"><i class="icon-copy  mr-2"></i>Добавить петицию</a>

        </div>
    </div>
    </div>
</div>

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
        "SOCNET_GROUP_ID" => $socnet_group_id,
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
        "SOCNET_GROUP_ID" => $socnet_group_id,
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
        "MESSAGE_COUNT" => "25",
        "MESSAGE_COUNT_MAIN" => "6",
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
        "SOCNET_GROUP_ID" => $socnet_group_id,
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
        "BLOG_COUNT" => "4",
        "BLOG_COUNT_MAIN" => "12",
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
        "SOCNET_GROUP_ID" => $socnet_group_id,
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
        "SOCNET_GROUP_ID" => $socnet_group_id,
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>