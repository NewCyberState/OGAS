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



$data = array(
    "UF_USER"=>$_POST["i"],
    "UF_DELEGATE"=>$_POST["j"],
);
$result = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "ASC"),
    "filter" => $data
));

while($arData = $result->Fetch()) {
    $entity_data_class::Delete($arData[ID]);
}

$rsUser = CUser::GetByID(intval($_POST["j"]));
$arUser = $rsUser->Fetch();

foreach ($arUser[UF_THEMATICS] as $thematic) {
// Массив полей для добавления

    $hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();


    $data = array(
        "UF_THEMATICS" => $thematic,
        "UF_USER" => $_POST["i"],
        "UF_DELEGATE" => $_POST["j"],
        "UF_DATE" => date("d.m.Y H:i:s"),
        "UF_ACTION" => "add"
    );

    $result = $entity_data_class::add($data);

    $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();


// Массив полей для добавления
    $data = array(
        "UF_THEMATICS" => $thematic,
        "UF_USER" => $_POST["i"],
        "UF_DELEGATE" => $_POST["j"],
    );

    $result = $entity_data_class::add($data);
}


return;