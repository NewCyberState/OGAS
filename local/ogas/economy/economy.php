<?php

namespace OGAS\Economy;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('iblock');
Loader::includeModule('blog');
Loader::includeModule('socialnetwork');
Loader::includeModule('vote');

/**/


/**
 * Class Economy
 * @package OGAS\Economy
 */
class Economy
{

    function __construct()
    {
    }

    public function GetCompanyList()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_UNIT", "PROPERTY_DATE", "PROPERTY_QUANTITY");

        $arFilter = Array("IBLOCK_ID" => COMPANY_IBID, "ACTIVE" => "Y");

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $companylist[$ob[ID]] = $ob[NAME];
        }

        asort($companylist);

        return $companylist;
    }


}

