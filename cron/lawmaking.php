<?php
$_SERVER["DOCUMENT_ROOT"] = dirname(dirname(__FILE__));
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
define("SITE_ID", "s1");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
CModule::IncludeModule("main");
CModule::IncludeModule("blog");
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$AdminEmail = COption::GetOptionString('main', 'email_from');

global $delegatetable;
global $votedateend;
global $endvotes;


/* Петиции, которые набрали количество голосов поддержку более 10% от числа участников группы - переводятся в статус "Обсуждения" */


$SORT = Array("DATE_PUBLISH" => "DESC");

$arFilter = Array(
    "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
    "BLOG_ACTIVE" => "Y",
    "BLOG_USE_SOCNET" => "Y",
    "UF_STATUS" => 9
);

$dbPosts = CBlogPost::GetList(
    $SORT,
    $arFilter,
    array("ID", "DATE_CREATE", "SOCNET_GROUP_ID"),
    false,
    array("ID", "DATE_CREATE", "SOCNET_GROUP_ID")
);

while ($arPost = $dbPosts->Fetch()) {


    $totalvotes=0;

    $entityTypeId = 'BLOG_POST';
    $entityId = $arPost[ID];
    $arVoteResult = CRatings::GetRatingVoteResult($entityTypeId, $entityId);
    if (!empty($arVoteResult))
        $totalvotes = $arVoteResult[TOTAL_VOTES];

    //pr($arPost);

    $groupid = $arPost[SOCNET_GROUP_ID];

    if ($groupid) {
        $group = CSocNetGroup::GetByID($groupid);
        if ($totalvotes >= ($group["NUMBER_OF_MEMBERS"] * 10 / 100)) {
            $arFields = array(
                "UF_STATUS" => 10,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s")
            );

            $updateID = CBlogPost::Update($arPost[ID], $arFields);
        }
    }


}


/* Петиции, которые обсуждаются более 1 недели - переводятся в статус "Создание референдума" */


$SORT = Array("DATE_PUBLISH" => "DESC");

$arFilter = Array(
    "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
    "BLOG_ACTIVE" => "Y",
    "BLOG_USE_SOCNET" => "Y",
    "UF_STATUS" => 10,
    "<=UF_STATUS_DATE" => date("d.m.Y H:i:s",strtotime("-1 week"))

);

$dbPosts = CBlogPost::GetList(
    $SORT,
    $arFilter,
    array("ID", "DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE"),
    false,
    array("ID", "DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE")
);

while ($arPost = $dbPosts->Fetch()) {

    //pr($arPost);

    $arFields = array(
        "UF_STATUS" => 11,
        "UF_STATUS_DATE" => date("d.m.Y H:i:s")
    );

    $updateID = CBlogPost::Update($arPost[ID], $arFields);

}


/* Референдумы, которые находятся на голосовании более 1 недели - переводятся в статус "Закон принят", если за них проголосовало более 50% голосов "за" и в статус "Закон отклонен" в противном случае  */


$SORT = Array("DATE_PUBLISH" => "DESC");

$arFilter = Array(
    "PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH,
    //"BLOG_ACTIVE" => "Y",
    //"BLOG_USE_SOCNET" => "Y",
    "UF_STATUS" => 12,
    //"<=UF_STATUS_DATE" => date("d.m.Y H:i:s",strtotime("-1 week"))

);

$dbPosts = CBlogPost::GetList(
    $SORT,
    $arFilter,
    array("ID", "TITLE","DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE","UF_THEMATICS","UF_BLOG_POST_VOTE","CATEGORY_ID_F","UF_LAW"),
    false,
    array("ID", "TITLE","DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE","UF_THEMATICS","UF_BLOG_POST_VOTE","CATEGORY_ID_F","UF_LAW")
);

while ($arPost = $dbPosts->Fetch()) {

    $za=0;
    $protiv=0;

    $votingdata=\Ogas\Democracy\LiquidVoting::GetVotingData($arPost["ID"]);

    $endvotes=\Ogas\Democracy\LiquidVoting::GetEndVotes($arPost["ID"]);


    foreach ($votingdata as $key => $row) {
        if ($row[1] == "За")
            $za += $row[2];
        if ($row[1] == "Против")
            $protiv += $row[2];
    }


    $groupid = $arPost[SOCNET_GROUP_ID];
    if ($groupid) {
        $group = CSocNetGroup::GetByID($groupid);


        if (strtotime($arPost["UF_STATUS_DATE"])<=strtotime("-1 week") && floatval($za) > floatval($group["NUMBER_OF_MEMBERS"] * 50 / 100))
        {
            //Количество голосов "ЗА" больше половины членов группы

            $arFields = array(
                "UF_STATUS" => 14,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),

            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);


            $el = new CIBlockElement;

            $PROP["GROUP"] = $group["NAME"];
            $PROP["GROUP_ID"] = $group["ID"];
            $PROP["MEMBERS"] = $group["NUMBER_OF_MEMBERS"];
            $PROP["VOTES"] = count($endvotes);
            $PROP["DELEGATED_VOTES"] = $za+$protiv;
            $PROP["ZA"] = $za;
            $PROP["PROTIV"] = $protiv;

            if(ceil($group["NUMBER_OF_MEMBERS"]/2)==floor($group["NUMBER_OF_MEMBERS"]/2))
                $needza=$group["NUMBER_OF_MEMBERS"]/2+1;
            else
                $needza=ceil($group["NUMBER_OF_MEMBERS"]/2);

            $PROP["ZA_NEEDED"] = $needza;

            $arLoadProductArray = Array(
                "IBLOCK_ID"      => 8,
                "NAME"           => $arPost["TITLE"],
                "ACTIVE"         => "Y",
                "PROPERTY_VALUES" => $PROP,
            );

            if($arPost[UF_LAW])
            {
                $el->Update($arPost[UF_LAW],$arLoadProductArray);
            }
            else {
                if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    CBlogPost::Update($arPost[ID], array("UF_LAW" => $PRODUCT_ID));
                }
            }


        }

        if(strtotime($arPost["UF_STATUS_DATE"])<=strtotime("-1 week") && floatval($za) <= floatval($group["NUMBER_OF_MEMBERS"] * 50 / 100)) {

            //Количество голосов "ЗА" меньше половины членов группы и прошло больше 1 недели с момента начала голосования

            $arFields = array(
                "UF_STATUS" => 13,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),
            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);

            $el = new CIBlockElement;

            $PROP["GROUP"] = $group["NAME"];
            $PROP["GROUP_ID"] = $group["ID"];
            $PROP["MEMBERS"] = $group["NUMBER_OF_MEMBERS"];
            $PROP["VOTES"] = count($endvotes);
            $PROP["DELEGATED_VOTES"] = $za+$protiv;
            $PROP["ZA"] = $za;
            $PROP["PROTIV"] = $protiv;

            if(ceil($group["NUMBER_OF_MEMBERS"]/2)==floor($group["NUMBER_OF_MEMBERS"]/2))
                $needza=$group["NUMBER_OF_MEMBERS"]/2+1;
            else
                $needza=ceil($group["NUMBER_OF_MEMBERS"]/2);

            $PROP["ZA_NEEDED"] = $needza;

            $arLoadProductArray = Array(
                "IBLOCK_ID"      => 8,
                "NAME"           => $arPost["TITLE"],
                "ACTIVE"         => "Y",
                "PROPERTY_VALUES" => $PROP,
            );

            if($arPost[UF_LAW])
            {
                $el->Update($arPost[UF_LAW],$arLoadProductArray);
            }
            else {
                if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    CBlogPost::Update($arPost[ID], array("UF_LAW" => $PRODUCT_ID));
                }
            }


        }
        /*else
        {
            $arFields = array(
                "UF_STATUS" => 13,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),
            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);
        }*/
    }

}





require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");