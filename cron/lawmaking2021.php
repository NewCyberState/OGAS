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

\Bitrix\Main\Loader::includeModule('iblock');

/* Петиции, которые набрали количество голосов поддержку более 10% от числа участников группы - переводятся в статус "Обсуждения" */

define("INITIATIVES_IBLOCK_ID",13);
define("LAW_IBLOCK_ID",8);

$arFilter = Array(
    "IBLOCK_ID"=>IntVal(INITIATIVES_IBLOCK_ID),
    "ACTIVE"=>"Y",
    "PROPERTY_STATUS" => 1
);
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PROPERTY_*"));
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    $entityTypeId = 'IBLOCK_ELEMENT';
    $entityId = $arFields[ID];
    $arVoteResult = CRatings::GetRatingVoteResult($entityTypeId, $entityId);
    if (!empty($arVoteResult))
        $totalvotes = $arVoteResult[TOTAL_VOTES];

    $groupid = $arProps[GROUP_ID][VALUE];

    if ($groupid) {
        $group = CSocNetGroup::GetByID($groupid);
        if ($totalvotes >= ($group["NUMBER_OF_MEMBERS"] * 10 / 100) || $_GET["debug"]==$arFields[ID]) {

            CIBlockElement::SetPropertyValuesEx($arFields[ID], $arFields[IBLOCK_ID], array("STATUS" => 2,"STATUS_DATE"=>ConvertTimeStamp(time(),"FULL")));
            CIBlockElement::SetElementSection($arFields[ID],102);

        }
    }

}




/* Петиции, которые обсуждаются более 1 недели - переводятся в статус "Законопроект" */


$arFilter = Array(
    "IBLOCK_ID"=>IntVal(INITIATIVES_IBLOCK_ID),
    "ACTIVE"=>"Y",
    "PROPERTY_STATUS" => 2
);
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","PREVIEW_TEXT_TYPE","DETAIL_TEXT_TYPE","CREATED_BY","PROPERTY_*"));
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    if(time()>MakeTimeStamp($arProps[STATUS_DATE][VALUE])+$arProps[DISCUSS_PERIOD][VALUE]*86400 || $_GET["debug"]==$arFields[ID])
    {
        $draft = new CIBlockElement;
        $draftProps=array(
            "GROUP_ID"=>$arProps["GROUP_ID"][VALUE],
            "THEMATICS"=>$arProps["THEMATICS"][VALUE],
            "INITIATIVE_ID"=>$arFields[ID],
            "OPTIONS"=>array("За","Против"),
            "STATUS"=>3,
            "VOTE_PERIOD"=>7,
            "MAJORITY_TYPE"=>5,
            "VOTING_TYPE"=>14,
            "STATUS_DATE"=>ConvertTimeStamp(time(),"FULL"),
        );

        $arLoadProductArray = Array(
            "CREATED_BY"    => $arFields[CREATED_BY], // элемент изменен текущим пользователем
            "IBLOCK_SECTION_ID" => 103,
            "IBLOCK_ID"      => LAW_IBLOCK_ID,
            "PROPERTY_VALUES"=> $draftProps,
            "NAME"           => $arFields["~NAME"],
            "ACTIVE"         => "Y",            // активен
            "PREVIEW_TEXT"         => $arFields["DETAIL_TEXT"],            // активен
            "PREVIEW_TEXT_TYPE"         => $arFields["DETAIL_TEXT_TYPE"],            // активен

        );

        if($arFields["PREVIEW_PICTURE"])
            $arLoadProductArray["PREVIEW_PICTURE"] = CFile::MakeFileArray(
        CFile::GetPath(
            $arFields["PREVIEW_PICTURE"]));

        $draft->Add($arLoadProductArray);

        /*$discuss = new CIBlockElement;
        $arLoadProductArray=array("ACTIVE_TO"=>ConvertTimeStamp(time(),"FULL"));
        $discuss->Update($arFields["ID"], $arLoadProductArray);*/

        $discussProps=array(
            "STATUS"=>3,
            "STATUS_DATE"=>ConvertTimeStamp(time(),"FULL"),
        );
        CIBlockElement::SetPropertyValuesEx($arFields[ID], $arFields[IBLOCK_ID],$discussProps);
    }

}


/* Референдумы, которые находятся на голосовании более 1 недели - переводятся в статус "Закон принят", если за них проголосовало более 50% голосов "за" и в статус "Закон отклонен" в противном случае  */


$arFilter = Array(
    "IBLOCK_ID"=>IntVal(LAW_IBLOCK_ID),
    "ACTIVE"=>"Y",
    "PROPERTY_STATUS" => 4
);
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array("ID","IBLOCK_ID", "NAME","PREVIEW_PICTURE","CREATED_BY","PROPERTY_*"));
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();


    if(time()>MakeTimeStamp($arProps[STATUS_DATE][VALUE])+$arProps[VOTE_PERIOD][VALUE]*86400 || $_GET["debug"]==$arFields[ID])
    {

        $votingdata=\Ogas\Democracy\LiquidVoting::GetVotingData2021($arFields["ID"]);

        $endvotes=\Ogas\Democracy\LiquidVoting::GetEndVotes2021($arFields["ID"]);

        $delegate_result=array();
        $direct_result=array();

        $options_count=count($arProps["OPTIONS"]["VALUE"]);

        foreach ($votingdata as $key => $row) {

            foreach ($arProps["OPTIONS"]["VALUE"] as $option)
            if ($row[1] == $option)
                $delegate_result[$option] += $row[2];
        }

        foreach ($endvotes as $key => $row) {

            foreach ($arProps["OPTIONS"]["VALUE"] as $option)
                if ($row[1] == $option)
                    $direct_result[$option] += 1;
        }

        $voters_count=0;

        foreach ($delegate_result as $key=>$value)
            $voters_count+=$value;


        /*pr($delegate_result);
        pr($direct_result);
        exit;*/

        $groupid = $arProps["GROUP_ID"][VALUE];
        if ($groupid) {
            $group = CSocNetGroup::GetByID($groupid);

            $vote_result=false;

            /*pr($arProps["MAJORITY_TYPE"]);
            pr($options_count);
            pr($delegate_result);
            pr($voters_count);
            pr(floatval($voters_count /$options_count));*/


            //Проверяем результаты голосования для разных типов большинства

            if($arProps["MAJORITY_TYPE"][VALUE_XML_ID]==1 && $options_count==2 && $delegate_result["За"] && (floatval($delegate_result["За"]) > floatval($voters_count /$options_count)))
                $vote_result=true;
            elseif($arProps["MAJORITY_TYPE"][VALUE_XML_ID]==1 && $options_count==2 && $delegate_result["За"] && (floatval($delegate_result["За"]) <= floatval($voters_count/$options_count )))
                $vote_result=false;
            elseif($arProps["MAJORITY_TYPE"][VALUE_XML_ID]==2 && $options_count==2 && $delegate_result["За"] && (floatval($delegate_result["За"]) > floatval($group["NUMBER_OF_MEMBERS"] / $options_count)))
                $vote_result=true;
            elseif($arProps["MAJORITY_TYPE"][VALUE_XML_ID]==2 && $options_count==2 && $delegate_result["За"] && (floatval($delegate_result["За"]) <= floatval($group["NUMBER_OF_MEMBERS"] / $options_count)))
            $vote_result=false;
            elseif($options_count>2 && (floatval(max($delegate_result)) > 0))
                $vote_result=true;
            else
                $vote_result=false;



            if($vote_result==true || $_GET["debug"]==$arFields["ID"])
            {
                if($arProps["RESPONSIBLE"]["VALUE"]) {
                    $status = 7;
                    $section=107;
                }
                else {
                    $status = 5;
                    $section=105;
                }

                $law = new CIBlockElement;
                $lawProps=array(
                    "STATUS"=>$status,
                    "STATUS_DATE"=>ConvertTimeStamp(time(),"FULL"),
                    "MEMBERS" => $group["NUMBER_OF_MEMBERS"],
                    "VOTES" => count($endvotes),
                    "DELEGATED_VOTES" => $voters_count
                );
                CIBlockElement::SetPropertyValuesEx($arFields[ID], $arFields[IBLOCK_ID],$lawProps);
                CIBlockElement::SetElementSection($arFields[ID],$section);
            }
            else
            {
                $law = new CIBlockElement;
                $lawProps=array(
                    "STATUS"=>6,
                    "STATUS_DATE"=>ConvertTimeStamp(time(),"FULL"),
                    "MEMBERS" => $group["NUMBER_OF_MEMBERS"],
                    "VOTES" => count($endvotes),
                    "DELEGATED_VOTES" => $voters_count);
                CIBlockElement::SetPropertyValuesEx($arFields[ID], $arFields[IBLOCK_ID],$lawProps);
                CIBlockElement::SetElementSection($arFields[ID],106);

            }

        }

    }

}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");