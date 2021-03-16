<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(CModule::IncludeModule("iblock"))
{

    $IBLOCK_ID = 10;        //здесь необходимо указать ID Вашего инфоблока

    $arOrder = Array("SORT"=>"ASC");
    $arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $aMenuLinksExt[] = Array(
            $arFields['NAME'],
            $arFields['DETAIL_PAGE_URL'],
            Array(),
            Array(),
            ""
        );

    }

}

$aMenuLinks = array_merge($aMenuLinks,$aMenuLinksExt);
?>