<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

global $USER;


$res = CIBlockSection::GetList(
    $arOrder = Array("SORT"=>"DESC") , //Сортировка в обратном порядке
    $arFilter = array('IBLOCK_ID'=>5)
);
$allsect=array();

while ($arSection = $res->Fetch())
{
    $allsect[]=$arSection[ID];
}


$data = array(
    "UF_USER"=>$USER->GetID(),
);
$result = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "ASC"),
    "filter" => $data
));

$thematics=array();
$thematicnames=array();

while($arData = $result->Fetch()) {
    if(!in_array($arData["UF_THEMATICS"],$thematics))
    {
        $thematics[]=$arData["UF_THEMATICS"];
    }

}

foreach ($allsect as $item)
{
    if(!in_array($item,$thematics)) {
        $var = GetSection($item);
        $thematicnames[] = "'" . $var["NAME"] . "'";
    }
}

if(!empty($thematicnames))
    echo implode(", ", $thematicnames);
