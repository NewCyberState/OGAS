<?php

namespace Ogas\Democracy;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('blog');

/**/


/**
 * Class LiquidVoting
 * @package Ogas\Democracy
 */
class LiquidVoting
{

    private static $hlbl = 2; //HL инфоблок Делегаты. История

    private static $delegatetable = array();
    private static $endvotes = array();
    private static $votedateend = false;


    public static function cmp($a, $b)
    {
        if ($a[2] == $b[2]) {
            return 0;
        }
        return ($a[2] > $b[2]) ? -1 : 1;
    }

    /**
     * @param $post_id
     */
    public function GetVotingData($post_id)
   {

       $w=array();
       $t=array();
       $p=array();
       $r=array();
       $u=array();
       self::$endvotes=array();

       $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
       $arFilter = Array(
           "ID" => $post_id,
       );

       $dbPosts = \CBlogPost::GetList(
           $SORT,
           $arFilter,
           false,
           false,
           array("*","UF_*")
       );

       $post = $dbPosts->Fetch();

       //pr($post->getFields());
       //$tags = $post->getTags();
       $tags=$post["UF_THEMATICS"];

       if ($post[UF_STATUS] >= 13)
           self::$votedateend = $post[UF_STATUS_DATE];

       $attach=\Bitrix\Vote\Attach::getData($post["UF_BLOG_POST_VOTE"]);
       $vote_id=$attach[0][OBJECT_ID];

       $VOTE_ID = GetVoteDataByID($vote_id, $arChannel, $arVote, $arQuestions, $arAnswers, $arDropDown, $arMultiSelect, $arGroupAnswers, "N");


       foreach ($arAnswers as $an){
           foreach ($an as $arAnswer) {
               $db_res = \CVoteEvent::GetUserAnswerStat(array(), array("ANSWER_ID" => $arAnswer[ID], "VALID" => "Y", "bGetVoters" => "Y", "bGetMemoStat" => "N"));

               while ($db_res && ($res = $db_res->Fetch())) {
                   self::$endvotes[] = array($res[AUTH_USER_ID], $arAnswer["MESSAGE"]);
               }
           }
       }


       foreach (self::$endvotes as $item) {
           self::GetDelegates($item[0], $tags, 1);
       }


       usort(self::$delegatetable, array("\Ogas\Democracy\LiquidVoting", "cmp"));


       foreach (self::$endvotes as $vote):
           self::$delegatetable[]=array($vote[0],$vote[1],0);
       endforeach;

       foreach (self::$delegatetable as $row)
       {
           $w[$row[0]]++;
       }


       foreach (self::$delegatetable as $row)
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

       return $u;



   }


    public function GetDelegates($user_id, $tags_list, $level)
    {
        global $delegatetable, $votedateend, $endvotes;

        $hlblock = HL\HighloadBlockTable::getById(self::$hlbl)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        if (self::$votedateend)
            $datefilter = array("<UF_DATE" => self::$votedateend);

        $rsData = $entity_data_class::getList(array(
            "select" => array("UF_USER", "UF_DELEGATE", "UF_THEMATICS", "UF_ACTION", "MAXID"),
            "group" => array("UF_USER", "UF_DELEGATE", "UF_THEMATICS", "UF_ACTION"),
            'runtime' => array(
                new Entity\ExpressionField('MAXID', 'max(ID)')),
            "order" => array("MAXID" => "ASC"),
            "filter" => array("UF_DELEGATE" => $user_id, "UF_THEMATICS" => $tags_list, $datefilter)  // Задаем параметры фильтра выборки
        ));

        $tmpdelegatetable = array();

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
            foreach (self::$delegatetable as $delegate) {
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
                foreach (self::$endvotes as $endvote) {
                    if ($endvote[0] == $tmpdata[0]) {
                        $flag = true;
                        break;
                    }
                }

                $rsUser = \CUser::GetByID($tmpdata[0]);
                if(!$rsUser->Fetch()) $flag = true;

                $rsUser = \CUser::GetByID($tmpdata[1]);
                if(!$rsUser->Fetch()) $flag = true;


                if (!$flag) {
                    self::$delegatetable[] = array($tmpdata[0], $tmpdata[1], $level);
                    self::GetDelegates($tmpdata[0], $tags_list, $level + 1);
                }
            }
        }

    }

    public function GetEndVotes($post_id)
    {
        self::$endvotes=array();

        $SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
        $arFilter = Array(
            "ID" => $post_id,
        );

        $dbPosts = \CBlogPost::GetList(
            $SORT,
            $arFilter,
            false,
            false,
            array("*", "UF_*")
        );

        $post = $dbPosts->Fetch();

        $attach = \Bitrix\Vote\Attach::getData($post["UF_BLOG_POST_VOTE"]);
        $vote_id = $attach[0][OBJECT_ID];

        $VOTE_ID = GetVoteDataByID($vote_id, $arChannel, $arVote, $arQuestions, $arAnswers, $arDropDown, $arMultiSelect, $arGroupAnswers, "N");


        foreach ($arAnswers as $an) {
            foreach ($an as $arAnswer) {
                $db_res = \CVoteEvent::GetUserAnswerStat(array(), array("ANSWER_ID" => $arAnswer[ID], "VALID" => "Y", "bGetVoters" => "Y", "bGetMemoStat" => "N"));

                while ($db_res && ($res = $db_res->Fetch())) {
                    self::$endvotes[] = array($res[AUTH_USER_ID], $arAnswer["MESSAGE"]);
                }
            }
        }

        return  self::$endvotes;
    }


}
