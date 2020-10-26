<?php
$_SERVER["DOCUMENT_ROOT"] = dirname(dirname(__FILE__));
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
define("SITE_ID", "s1");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");






CModule::IncludeModule("main");
CModule::IncludeModule("blog");
if (!CModule::IncludeModule("socialnetwork"))
    echo "Не подключен модуль Социальная сеть";

$AdminEmail = COption::GetOptionString('main', 'email_from');


$filter = Array
(
    "ACTIVE" => "Y",
    //"ID" => 1,
    "GROUPS_ID" => Array(1, 8) // Граждане
);

$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter, array('SELECT' => array("UF_*")));


while ($arUser = $rsUsers->GetNext()) {
    $groups = array();
    $message_text = "";


    $dbRequests = CSocNetUserToGroup::GetList(
        array("USER_LAST_NAME" => "ASC", "USER_NAME" => "ASC"),
        array(
            "USER_ID" => $arUser[ID],
            "USER_ACTIVE" => "Y",
            "GROUP_ACTIVE" => "Y"

        ),
        false,
        false,
        array("ID", "USER_ID", "GROUP_ID")
    );
    while ($arRequests = $dbRequests->GetNext()) {
        $groups[] = $arRequests["GROUP_ID"];

    }
    //pr( $groups);


//Новые петиции

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        ">=DATE_PUBLISH" => date("d.m.Y", strtotime("-1 day")),
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 9
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL","SOCNET_GROUP_ID", "UF_STATUS_DATE")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Поддержите петиции<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/petition/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые обсуждения

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        ">=UF_STATUS_DATE" => date("d.m.Y", strtotime("-1 day")),
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 10
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL","SOCNET_GROUP_ID", "UF_STATUS_DATE")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Обсудите петиции<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a  target=_blank href='https://ogasdemo.ru/lkg/gos/discussion/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые создания референдумов

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        //">=UF_STATUS_DATE" => date("d.m.Y", strtotime("-1 day")),
        "AUTHOR_ID" => $arUser["ID"],
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 11
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL","SOCNET_GROUP_ID", "UF_STATUS_DATE")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Создайте новые референдумы<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a  target=_blank href='https://ogasdemo.ru/lkg/gos/referendum/add/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые референдумы

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        ">=UF_STATUS_DATE" => date("d.m.Y", strtotime("-1 day")),
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 12
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL","SOCNET_GROUP_ID", "UF_STATUS_DATE")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Примите участие в референдумах<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a  target=_blank href='https://ogasdemo.ru/lkg/gos/referendum/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые отклоненные законы

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        ">=UF_STATUS_DATE" => date("d.m.Y", strtotime("-1 day")),
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 13
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL","SOCNET_GROUP_ID", "UF_STATUS_DATE")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Ознакомьтесь с отклоненными законопроектами<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a  target=_blank href='https://ogasdemo.ru/lkg/gos/law/rejected/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }


//Новые принятые законы

    $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
    $arFilter = Array(
        "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
        ">=UF_STATUS_DATE" => date("d.m.Y", strtotime("-1 day")),
        "SOCNET_GROUP_ID" => $groups,
        "UF_STATUS" => 14
    );

    $dbPosts = CBlogPost::GetList(
        $SORT,
        $arFilter,
        false,
        false,
        array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "BLOG_URL")
    );

    if ($dbPosts->SelectedRowsCount() > 0) {
        $message_text .= "Ознакомьтесь с принятыми законами<br><br>";

        while ($arPost = $dbPosts->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a  target=_blank href='https://ogasdemo.ru/lkg/gos/law/approved/" . $arPost["ID"] . "/'>" . $arPost["TITLE"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//pr( $message_text);
    $sitename = COption::GetOptionString('main', 'site_name');

    $arFields_notify = array(
        "SITE_NAME" => $sitename,
        "NAME" => $arUser["NAME"],
        "LAST_NAME" => $arUser["LAST_NAME"],
        "EMAIL" => $arUser["EMAIL"],
        "DEFAULT_EMAIL_FROM" => $AdminEmail,
        "MESSAGE" => $message_text,
    );

    //pr($arFields_notify);
//AddMessage2Log($arFields_notify);
if(trim($message_text)) {


   /* $message_text .= "Рекомендуем вам назначить делегатов, которые смогут принимать участие в голосовании на референдумах вместо вас. Выбрать и назначить делегатов можно в разделе <a  target=_blank href='https://ogasdemo.ru/personal/delegates/adddelegates/'>Назначить делегатов</a>, либо в разделе <a  target=_blank href='https://ogasdemo.ru/user/'>Граждане</a>.<br><br>";

    if(!$arUser["UF_THEMATICS"] || !$arUser["PERSONAL_NOTES"]) {

        $message_text .= "Если вы хотите сами стать делегатом для других граждан и распоряжаться их голосами при голосовании, вам необходимо указать свои компетенции и рассказать о своем жизненном опыте в разделе   <a  target=_blank href='https://ogasdemo.ru/personal/'>Мои данные</a>.<br><br>";

        $message_text .= "Увидеть, кто из граждан делегировал вам свои голоса можно в разделе <a  target=_blank href='https://ogasdemo.ru/personal/delegates/idelegate/'>Я делегат</a>.<br><br>";
    }

echo $message_text;
exit;*/
    CEvent::Send("OGAS_EVENTS", SITE_ID, $arFields_notify);
}
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
