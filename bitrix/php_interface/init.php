<?php

/*
CModule::IncludeModule("blog");
use \Bitrix\Main\Service\GeoIp;


AddEventHandler("blog", "OnBlogUpdate",Array("MyClass", "OnBlogUpdateHandler"));


AddEventHandler("main", "OnBeforeUserRegister", Array("MyClass", "OnBeforeUserRegisterHandler"));
AddEventHandler("main", "OnAfterUserAdd", Array("MyClass", "OnAfterUserAddHandler"));
AddEventHandler("main", "OnAfterUserAuthorize", Array("MyClass", "OnAfterUserAuthorizeHandler"));

AddEventHandler("socialnetwork", "OnBeforeSocNetGroupAdd", Array("MyClass", "OnBeforeSocNetGroupAddHandler"));



class MyClass
{

    function OnBeforeSocNetGroupAddHandler(&$arParams)
    {
        pr($arParams);
        return false;
        if($arParams["NAME"])
        {
            $res=CSocNetGroup::GetList(false,array("NAME"=>$arParams["NAME"]));

            if($res->SelectedRowsCount()>0)
            {
                $GLOBALS['APPLICATION']->throwException('Группа с таким названием уже существует!');
                return false;
            }
        }
    }


    function OnAfterUserAuthorizeHandler(&$arFields)
    {

        //AddMessage2Log($arFields);
        //if($arFields[user_fields][LAST_LOGIN]==null)
          //  LocalRedirect("/personal/wizard/");

    }

    function OnBlogUpdateHandler($ID, &$arFields)
    {
        //AddMessage2Log($ID);
        //AddMessage2Log($arFields);

    }

    function OnBeforeUserRegisterHandler(&$arFields)
    {
        if($arFields["EMAIL"])
            $arFields["LOGIN"] = $arFields["EMAIL"];
        return $arFields;
    }

    function OnAfterUserAddHandler(&$arFields)
    {


    }
}


function GetElement($ELEMENT_ID)
{
    $res = CIBlockElement::GetByID($ELEMENT_ID);
    $ar_res = $res->GetNextElement();
    if ($ar_res) {
        $temp = $ar_res->GetFields();
        $temp2 = $ar_res->GetProperties();
        $temp = array_merge($temp, $temp2);
        return $temp;
    } else
        return false;
}


function GetSection($SECTION_ID)
{
    $res = CIBlockSection::GetByID($SECTION_ID);
    $ar_res = $res->Fetch();

    $res2 = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $ar_res["IBLOCK_ID"], 'ID' => $SECTION_ID), false, array('*', 'UF_*'));

    $ar_res2 = $res2->GetNext();
    return $ar_res2;
}


function plural_form($n, $forms)
{
    return $n % 10 == 1 && $n % 100 != 11 ? $forms[0] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[1] : $forms[2]);
}

function pr($o)
{
    global $USER;
    if(true
        //$USER->IsAdmin()
    ) {
        $bt = debug_backtrace();
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/", "\\", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        $dRoot = str_replace("\\", "/", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        ?>
        <div
                style='font-size: 12px;font-family: monospace;width: 100%;color: #181819;background: #EDEEF8;border: 1px solid #006AC5;'>
            <div
                    style='padding: 5px 10px;font-size: 10px;font-family: monospace;background: #006AC5;font-weight:bold;color: #fff;'>
                File: <?= $bt["file"] ?> [<?= $bt["line"] ?>]
            </div>
            <pre style='padding:10px;'><? print_r($o) ?></pre>
        </div>
        <?
    }
}

function my_crop($text, $length, $clearTags = true)
{
    $text = trim($text);
    if ($clearTags === true)
        $text = strip_tags($text);
    if ($length <= 0 || strlen($text) <= $length)
        return $text;
    $out = mb_substr($text, 0, $length);
    $pos = mb_strrpos($out, ' ');
    if ($pos)
        $out = mb_substr($out, 0, $pos);
    return $out . '…';
}

function numberEnd($number, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

function pre($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
*/