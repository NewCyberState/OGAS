<?php

namespace OGAS\Economy;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('iblock');
Loader::includeModule('sale');
Loader::includeModule('blog');
Loader::includeModule('socialnetwork');
Loader::includeModule('vote');

/**/


/**
 * Class Worker
 * @package OGAS\Economy
 */
class Worker
{

    protected $id;
    public $name;


    function __construct($WORKER_ID)
    {
        $this->id = $WORKER_ID;
        $this->name=GetElement($WORKER_ID)["NAME"];
    }


    public function CalculateSalary($date)
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_DATE","PROPERTY_FACT");

        $timestamp=strtotime("-1 month",MakeTimeStamp($date, "DD.MM.YYYY"));

        $from = date("Y-m-d H:i:s", $timestamp);

        $arFilter = Array("IBLOCK_ID" => WORKINGTIME_IBID, "ACTIVE" => "Y", "PROPERTY_WORKER" => $this->id,"><PROPERTY_DATE"=> array($d,ConvertDateTime($date,"YYYY-MM-DD")));

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $hours+=floatval($ob["PROPERTY_FACT_VALUE"]);
        }

        $class=GetElement($this->id)["PROPERTIES"]["CLASS"]["VALUE"];
        $rate=GetElement($class)["PROPERTIES"]["RATE"]["VALUE"];

        $salary=$rate*$hours;

        \CIBlockElement::SetPropertyValuesEx($this->id, false, array("SALARY" => $salary));

        return $salary;

    }

    public function ChargeSalary()
    {
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_DATE","PROPERTY_USER","PROPERTY_SALARY");

        $arFilter = Array("IBLOCK_ID" => WORKERS_IBID, "ACTIVE" => "Y", "ID" => $this->id);

        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNext()) {
            $user= $ob["PROPERTY_USER_VALUE"];
            $salary=$ob["PROPERTY_SALARY_VALUE"];

            if($user) {

                if(!\CSaleUserAccount::GetByUserID($user,"RUB"))
                    \CSaleUserAccount::Add(array("USER_ID"=>$user,"CURRENT_BUDGET"=>0,"CURRENCY"=>"RUB"));

                \CSaleUserAccount::UpdateAccount($user,"+".$salary,"RUB","Начисление заработной платы");

            }
        }
    }
}

