<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;

Loader::includeModule("vote");

//AddMessage2Log($_REQUEST);

$arFields=array(
    "CHANNEL_ID"=>2,
    "ACTIVE"=>"Y",
    "ANONYMITY"=>1,
    "NOTIFY"=>"N",
    "AUTHOR_ID"=>$_REQUEST["AUTHOR_ID"],
    "DATE_START"=>ConvertTimeStamp(time(),"FULL"),
    "DATE_END"=>ConvertTimeStamp(time()+$_REQUEST["PROPERTY"][65][0]*86400,"FULL"),
    "COUNTER"=>0,
    "TITLE"=>$_REQUEST["PROPERTY"]["NAME"][0],
    "UNIQUE_TYPE"=>40,
    );

$voteID=CVote::Add($arFields);

$arQuestion=array("VOTE_ID"=>$voteID,"QUESTION"=>$_REQUEST["PROPERTY"]["NAME"][0],"QUESTION_TYPE"=>"text","COUNTER"=>0);
$questionID=CVoteQuestion::Add($arQuestion);

foreach ($_REQUEST["PROPERTY"][71] as $value)
if(!empty($value))
{
    $arAnswer=array("QUESTION_ID"=>$questionID,"MESSAGE"=>trim($value),"MESSAGE_TYPE"=>"text","COUNTER"=>0,"FIELD_TYPE"=>0);
    CVoteAnswer::Add($arAnswer);
}
echo $voteID;