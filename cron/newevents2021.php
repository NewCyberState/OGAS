<?php
$_SERVER["DOCUMENT_ROOT"] = dirname(dirname(__FILE__));
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
define("SITE_ID", "s1");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


define("INITIATIVES_IBLOCK_ID",13);
define("LAW_IBLOCK_ID",8);



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

if($_REQUEST["debug"])
    $filter["ID"]=intval($_REQUEST["debug"]);

$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter, array('SELECT' => array("UF_*")));

while ($arUser = $rsUsers->GetNext()) {
    $groups = array();
    $message_text = "";

    $dbRequests = CSocNetUserToGroup::GetList(
        array("USER_LAST_NAME" => "ASC", "USER_NAME" => "ASC"),
        array(
            "USER_ID" => $arUser[ID],
            "USER_ACTIVE" => "Y",
            "GROUP_ACTIVE" => "Y",
            "<=ROLE" => SONET_ROLES_USER,
        ),
        false,
        false,
        array("ID", "USER_ID", "GROUP_ID")
    );
    while ($arRequests = $dbRequests->GetNext()) {
        $groups[] = $arRequests["GROUP_ID"];

    }
    //pr( $groups);

    if(!$groups)
        continue;

//Новые петиции

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(INITIATIVES_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        ">=DATE_CREATE" => ConvertTimeStamp(strtotime("-1 day"), "FULL"),
        "PROPERTY_STATUS" => 1
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Поддержите инициативы<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/initiatives/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые обсуждения

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(INITIATIVES_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-1 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 2
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Обсудите инициативы<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/discussions/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

//Новые законопроекты

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        "CREATED_BY" => $arUser["ID"],
        "DATE_ACTIVE_FROM" => CDatabase::CharToDateFunction(ConvertTimeStamp(strtotime("-7 day"), "FULL"))
        "PROPERTY_STATUS" => 3
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Подготовьте законопроекты<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/drafts/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }


//Новые референдумы

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-1 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 4
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Проголосуйте на референдумах<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/referendums/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }



//Новые принятые законы

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-1 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 5
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Ознакомьтесь с принятыми законами<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/law/approved/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }




//Новые отклоненные законы

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-1 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 6
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Ознакомьтесь с отклоненными законами<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/law/rejected/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }


    //Новые законы на исполнении

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        "PROPERTY_RESPONSIBLE" => $arUser["ID"],
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-7 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 7
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Вам необходимо исполнить законы и отчитаться об исполнении<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/law/execution/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
        }
        $message_text .= "<br><br>";
    }

    //Новые исполненные законы

    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
        "ACTIVE"=>"Y",
        "PROPERTY_GROUP_ID" => $groups,
        //"PROPERTY_RESPONSIBLE" => $arUser["ID"],
        ">=PROPERTY_STATUS_DATE" => ConvertDateTime(ConvertTimeStamp(strtotime("-1 day"), "FULL"),"YYYY-MM-DD HH:MM:SS"),
        "PROPERTY_STATUS" => 8
    );

    $res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false,false, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","CREATED_BY","PROPERTY_*"));


    if ($res->SelectedRowsCount() > 0) {
        $message_text .= "Ознакомьтесь с исполненными законами<br><br>";

        while ($arPost = $res->Fetch()) {
            //pr($arPost);
            //$arPost["TITLE"].;
            $message_text .= "<a target=_blank href='https://ogasdemo.ru/lkg/gos/law/executed/" . $arPost["ID"] . "/'>" . $arPost["NAME"] . "</a><br>";
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




//AddMessage2Log($arFields_notify);
if(trim($message_text)) {

    //pr($arFields_notify);


    /* $message_text .= "Рекомендуем вам назначить делегатов, которые смогут принимать участие в голосовании на референдумах вместо вас. Выбрать и назначить делегатов можно в разделе <a  target=_blank href='https://ogasdemo.ru/personal/delegates/adddelegates/'>Назначить делегатов</a>, либо в разделе <a  target=_blank href='https://ogasdemo.ru/user/'>Граждане</a>.<br><br>";

     if(!$arUser["UF_THEMATICS"] || !$arUser["PERSONAL_NOTES"]) {

         $message_text .= "Если вы хотите сами стать делегатом для других граждан и распоряжаться их голосами при голосовании, вам необходимо указать свои компетенции и рассказать о своем жизненном опыте в разделе   <a  target=_blank href='https://ogasdemo.ru/personal/'>Мои данные</a>.<br><br>";

         $message_text .= "Увидеть, кто из граждан делегировал вам свои голоса можно в разделе <a  target=_blank href='https://ogasdemo.ru/personal/delegates/idelegate/'>Я делегат</a>.<br><br>";
     }

 echo $message_text;
 exit;*/

    if($arUser["EMAIL"])
        CEvent::Send("OGAS_EVENTS", SITE_ID, $arFields_notify);
}
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
