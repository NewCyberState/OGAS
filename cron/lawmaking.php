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

function cmp($a, $b)
{
    if ($a[2] == $b[2]) {
        return 0;
    }
    return ($a[2] > $b[2]) ? -1 : 1;
}



function GetDelegates($user_id,$tags_list,$level)
{
    global $delegatetable,$votedateend,$endvotes;
    $hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

/*    if($votedateend)
        $datefilter=array("<UF_DATE" => $votedateend);*/
    $datefilter="";

    $rsData = $entity_data_class::getList(array(
        "select" => array("UF_USER","UF_DELEGATE","UF_THEMATICS","UF_ACTION","MAXID"),
        "group" => array("UF_USER","UF_DELEGATE","UF_THEMATICS","UF_ACTION"),
        'runtime' => array(
            new Entity\ExpressionField('MAXID', 'max(ID)')),
        "order" => array("MAXID" => "ASC"),
        "filter" => array("UF_DELEGATE"=>$user_id,"UF_THEMATICS"=>$tags_list,$datefilter)  // Задаем параметры фильтра выборки
    ));
    $tmpdelegatetable=array();

    while ($arData = $rsData->Fetch()) {

        if ($arData[UF_ACTION] == "delete") {
            $tmpkey = array_search(array($arData[UF_USER], $arData[UF_DELEGATE]), $tmpdelegatetable);
            if ($tmpkey !== false)
                unset($tmpdelegatetable[$tmpkey]);
        } else
            $tmpdelegatetable[] = array($arData[UF_USER], $arData[UF_DELEGATE]);
    }

    foreach ($tmpdelegatetable as $tmpdata) {

        $found=false;
        foreach ($delegatetable as $delegate) {
            if($tmpdata==array($delegate[0],$delegate[1])) {
                $found = true;
                break;
            }
            if($tmpdata==array($delegate[1],$delegate[0])) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            $flag = false;
            foreach ($endvotes as $endvote) {
                if ($endvote[0] == $tmpdata[0]) {
                    $flag = true;
                    break;
                }
            }

            $rsUser = CUser::GetByID($tmpdata[0]);
            if(!$rsUser->Fetch()) $flag = true;

            $rsUser = CUser::GetByID($tmpdata[1]);
            if(!$rsUser->Fetch()) $flag = true;

            if (!$flag) {
                $delegatetable[] = array($tmpdata[0], $tmpdata[1], $level);
                GetDelegates($tmpdata[0], $tags_list, $level + 1);
            }
        }
    }

}







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
    array("ID", "TITLE","DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE","UF_THEMATICS","UF_BLOG_POST_VOTE","CATEGORY_ID_F"),
    false,
    array("ID", "TITLE","DATE_CREATE", "SOCNET_GROUP_ID", "UF_STATUS_DATE","UF_THEMATICS","UF_BLOG_POST_VOTE","CATEGORY_ID_F")
);

while ($arPost = $dbPosts->Fetch()) {

    //pr($arPost);

    $post = \Bitrix\Blog\Item\Post::getById($arPost["ID"]);
    //$tags = $post->getTags();
    $tags=$arPost["UF_THEMATICS"];

    $attach=\Bitrix\Vote\Attach::getData($arPost["UF_BLOG_POST_VOTE"]);
    $vote_id=$attach[0][OBJECT_ID];

    $VOTE_ID = GetVoteDataByID($vote_id, $arChannel, $arVote, $arQuestions, $arAnswers, $arDropDown, $arMultiSelect, $arGroupAnswers, "N");

    //pr($arChannel);

    /*foreach ($arAnswers as $an)
    {
        foreach ($an as $answer) {
            if ($answer[MESSAGE] == "Да" || $answer[MESSAGE] == "За")
                if ($answer[COUNTER] > 0) {
                    $groupid = $arPost[SOCNET_GROUP_ID];
                    if ($groupid) {
                        $group = CSocNetGroup::GetByID($groupid);
                        //pr($answer[COUNTER]);
                        //pr($group["NUMBER_OF_MEMBERS"]);
                        if ($answer[COUNTER] >= ceil($group["NUMBER_OF_MEMBERS"] * 50 / 100))
                        {
                            $arFields = array(
                                "UF_STATUS" => 14,
                                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),

                            );
                            $updateID = CBlogPost::Update($arPost[ID], $arFields);

                        } elseif($arPost["UF_STATUS_DATE"]<=date("d.m.Y H:i:s",strtotime("-1 week")) && $answer[COUNTER] < ceil($group["NUMBER_OF_MEMBERS"] * 50 / 100)) {
                            $arFields = array(
                                "UF_STATUS" => 13,
                                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),
                            );
                            $updateID = CBlogPost::Update($arPost[ID], $arFields);
                        }
                    }
                }
        }
    }*/

    $delegatetable=array();
    $endvotes=array();
    $w=array();
    $t=array();
    $p=array();
    $r=array();
    $u=array();


    foreach ($arAnswers as $an){
        foreach ($an as $arAnswer) {
            //pr($arAnswer);


        $db_res = CVoteEvent::GetUserAnswerStat(array(), array("ANSWER_ID" => $arAnswer[ID], "VALID" => "Y", "bGetVoters" => "Y", "bGetMemoStat" => "N"));

        while ($db_res && ($res = $db_res->Fetch())) {
            $endvotes[] = array($res[AUTH_USER_ID], $arAnswer["MESSAGE"]);
            }
        }
    }

    foreach ($endvotes as $item) {
        GetDelegates($item[0], $tags, 1);
    }

    usort($delegatetable, "cmp");

    foreach ($endvotes as $vote):
        $delegatetable[]=array($vote[0],$vote[1],0);
    endforeach;

    //pr($delegatetable);

    foreach ($delegatetable as $row)
    {
        $w[$row[0]]++;
    }


    foreach ($delegatetable as $row)
    {
        $t[$row[2]][]=array($row[0],$row[1]);
    }


    foreach ($t as $key=>$row)
    {
        foreach ($row as $k=>$s) {
            //pr($s);
            $p[$s[0]][$s[1]] = 1/$w[$s[0]];
        }

    }

    foreach ($p as $key=>$row)
    {
        foreach ($row as $k=>$s) {
            //pr($s);
            $r[$k] = $r[$k]+$s+$s*$r[$key];
        }

    }



    foreach ($t as $key=>$row)
    {
        foreach ($row as $k=>$s) {
            //pr($r[$s[0]]);
            $u[] = array($s[0], $s[1], ($r[$s[0]] + 1) / $w[$s[0]]);
        }
    }

    //pr($u);

    $za=0;
    $protiv=0;

    foreach ($u as $key=>$row)
    {
        if($row[1]=="За")
            $za+= $row[2];
        if($row[1]=="Против")
            $protiv+= $row[2];
    }

    //pr($za);

    $groupid = $arPost[SOCNET_GROUP_ID];
    if ($groupid) {
        $group = CSocNetGroup::GetByID($groupid);
        //pr($answer[COUNTER]);
        //pr($group["NUMBER_OF_MEMBERS"]);
        if (floatval($za) > ceil($group["NUMBER_OF_MEMBERS"] * 50 / 100))
        {
            //Количество голосов "ЗА" больше половины членов группы

            $arFields = array(
                "UF_STATUS" => 14,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),

            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);


            $el = new CIBlockElement;

            $arLoadProductArray = Array(
                "IBLOCK_ID"      => 8,
                "NAME"           => $arPost["TITLE"],
                "ACTIVE"         => "Y",            // активен
            );

            if($PRODUCT_ID = $el->Add($arLoadProductArray))
            {
                CBlogPost::Update($arPost[ID],array("UF_LAW"=>$PRODUCT_ID));
            }


        }
        elseif($arPost["UF_STATUS_DATE"]<=date("d.m.Y H:i:s",strtotime("-1 week")) && floatval($za) <= ceil($group["NUMBER_OF_MEMBERS"] * 50 / 100)) {

            //Количество голосов "ЗА" меньше половины членов группы и прошло больше 1 недели с момента начала голосования

            $arFields = array(
                "UF_STATUS" => 13,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),
            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);
        }
        else
        {
            $arFields = array(
                "UF_STATUS" => 13,
                "UF_STATUS_DATE" => date("d.m.Y H:i:s"),
                "UF_NEED_VOTES" => ceil ($group["NUMBER_OF_MEMBERS"] * 50 / 100),
            );
            $updateID = CBlogPost::Update($arPost[ID], $arFields);
        }
    }

}





require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");