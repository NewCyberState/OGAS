<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

// Массив полей для добавления
$data = array(
    "UF_THEMATICS"=>$_POST["tag"],
    "UF_USER"=>$_POST["i"],
    "UF_DELEGATE"=>$_POST["j"],
    "UF_DATE"=>date("d.m.Y H:i:s"),
    "UF_ACTION"=>"add"
);

$result = $entity_data_class::add($data);

$hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

// Массив полей для добавления
$data = array(
    "UF_THEMATICS"=>$_POST["tag"],
    "UF_USER"=>$_POST["i"],
    "UF_DELEGATE"=>$_POST["j"],
);

$result = $entity_data_class::add($data);



return;