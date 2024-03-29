<?php


use Bitrix\Highloadblock as HL,
    Bitrix\Main\Data\Cache,
    Bitrix\Main\Entity,
    Bitrix\Sale\Delivery,
    Bitrix\Sale,
    Bitrix\Sale\Discount\Gift,
    Bitrix\Sale\Compatible\DiscountCompatibility,
    Bitrix\Main,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\Order,
    Bitrix\Sale\DiscountCouponsManager,
    Bitrix\Main\Context,
    Bitrix\Main\Event,
    Bitrix\Main\Service\GeoIp,
    Bitrix\Blog,
    Bitrix\Main\Loader;

CModule::IncludeModule("blog");

require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/ogas.php';;

AddEventHandler("blog", "OnBlogUpdate",Array("MyClass", "OnBlogUpdateHandler"));


AddEventHandler("main", "OnBeforeUserRegister", Array("MyClass", "OnBeforeUserRegisterHandler"));
AddEventHandler("main", "OnAfterUserRegister", Array("MyClass", "OnAfterUserRegisterHandler"));
AddEventHandler("main", "OnAfterUserAuthorize", Array("MyClass", "OnAfterUserAuthorizeHandler"));

AddEventHandler("socialnetwork", "OnBeforeSocNetGroupAdd", Array("MyClass", "OnBeforeSocNetGroupAddHandler"));

class MyClass
{

    function OnBeforeSocNetGroupAddHandler(&$arParams)
    {
        if($arParams["NAME"])
        {
            $res=CSocNetGroup::GetList(false,array("NAME"=>$arParams["NAME"]));

            if($res->SelectedRowsCount()>0)
            {
                global $APPLICATION;
                $APPLICATION->throwException('Группа с таким названием уже существует!');
                return false;
            }
        }
    }


    function OnAfterUserAuthorizeHandler(&$arFields)
    {
        include($_SERVER['DOCUMENT_ROOT']."/ajax/citizen.php");

        //AddMessage2Log($arFields);
        /*if($arFields[user_fields][LAST_LOGIN]==null)
            LocalRedirect("/personal/wizard/");*/

    }

    function OnBlogUpdateHandler($ID, &$arFields)
    {
        /*AddMessage2Log($ID);
        AddMessage2Log($arFields);*/

    }

    function OnBeforeUserRegisterHandler(&$arFields)
    {
        if($arFields["EMAIL"])
            $arFields["LOGIN"] = $arFields["EMAIL"];
        return $arFields;
    }

    public static function OnAfterUserRegisterHandler(&$arFields)
    {

    }
}


function GetElement($ELEMENT_ID)
{
    $res = CIBlockElement::GetByID($ELEMENT_ID);
    $ar_res = $res->GetNextElement();
    if ($ar_res) {
        $temp = $ar_res->GetFields();
        $temp["PROPERTIES"] = $ar_res->GetProperties();
        //$temp = array_merge($temp, $temp2);
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
    if($USER->IsAdmin()) {
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

function GetHLElement($HLBL,$HLID)
{
    $hlbl = $HLBL;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "order" => array("ID" => "ASC"),
        "filter" => array("UF_XML_ID"=>$HLID)
    ));

    $arData = $rsData->Fetch();
    return $arData;
}


// Событие происходит при формировании списка дополнительного
// функционала соц.сети
// В обработчике можно изменить или дополнить список
AddEventHandler("socialnetwork", "OnFillSocNetFeaturesList", "__AddSocNetFeature");

// Событие происходит при формировании списка закладок
// В обработчике можно изменить список закладок
AddEventHandler("socialnetwork", "OnFillSocNetMenu", "__AddSocNetMenu");

// Событие происходит в комплексном компоненте при работе в ЧПУ
// режиме при формировании списка шаблонов адресов страниц
// комплексного компонента
AddEventHandler("socialnetwork", "OnParseSocNetComponentPath", "__OnParseSocNetComponentPath");

// Событие происходит в комплексном компоненте при работе в
// не ЧПУ режиме при формировании списка псевдонимов переменных
AddEventHandler("socialnetwork", "OnInitSocNetComponentVariables", "__OnInitSocNetComponentVariables");

// При формировании списка дополнительного функционала
// добавим дополнительную запись superficha
function __AddSocNetFeature(&$arSocNetFeaturesSettings)
{
    $arSocNetFeaturesSettings["democracy"] = array(
        "allowed" => array(SONET_ENTITY_USER, SONET_ENTITY_GROUP),
        "operations" => array(
            "write" => array(SONET_ENTITY_USER => SONET_RELATIONS_TYPE_NONE, SONET_ENTITY_GROUP => SONET_ROLES_MODERATOR),
            "view" => array(SONET_ENTITY_USER => SONET_RELATIONS_TYPE_ALL, SONET_ENTITY_GROUP => SONET_ROLES_USER),
        ),
        "minoperation" => "view",
    );
    $arSocNetFeaturesSettings["docs"] = array(
        "allowed" => array(SONET_ENTITY_USER, SONET_ENTITY_GROUP),
        "operations" => array(
            "write" => array(SONET_ENTITY_USER => SONET_RELATIONS_TYPE_NONE, SONET_ENTITY_GROUP => SONET_ROLES_MODERATOR),
            "view" => array(SONET_ENTITY_USER => SONET_RELATIONS_TYPE_ALL, SONET_ENTITY_GROUP => SONET_ROLES_USER),
        ),
        "minoperation" => "view",
    );
}

// При формировании списка закладок добавим дополнительную
// закладку для функционала superficha
function __AddSocNetMenu(&$arResult)
{
    // Достуна для показа
    $arResult["CanView"]["democracy"] = true;
    // Ссылка закладки
    $arResult["Urls"]["democracy"] = CComponentEngine::MakePathFromTemplate("/groups/group/#group_id#/democracy/",
        array("group_id" => $arResult["Group"]["ID"]));
    // Название закладки
    $arResult["Title"]["democracy"] = "Демократия";

    $arResult["CanView"]["docs"] = true;
    // Ссылка закладки
    $arResult["Urls"]["docs"] = CComponentEngine::MakePathFromTemplate("/groups/group/#group_id#/docs/",
        array("group_id" => $arResult["Group"]["ID"]));
    // Название закладки
    $arResult["Title"]["docs"] = "Документы";
}

// При формировании списка шаблонов адресов страниц
// комплексного компонента в режиме ЧПУ добавим шаблон
// для superficha
function __OnParseSocNetComponentPath(&$arUrlTemplates, &$arCustomPagesPath)
{
    // Шаблон адреса страницы
    $arUrlTemplates["democracy"] = "group/#group_id#/democracy/";
    // Путь относительно корня сайта,
    // по которому лежит страница
    $arCustomPagesPath["democracy"] = "/groups/custom/";

    // Шаблон адреса страницы
    $arUrlTemplates["docs"] = "group/#group_id#/docs/";
    // Путь относительно корня сайта,
    // по которому лежит страница
    $arCustomPagesPath["docs"] = "/groups/custom/";
}

