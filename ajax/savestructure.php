<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");

require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

if(!$_REQUEST["factorid"] || !$_REQUEST["parentid"] || !$_REQUEST["quantity"])
{
	return false;
}


$mob = new \Ogas\Economy\MOB(0.01);

$mob->matrix2[intval($_REQUEST["factorid"])][intval($_REQUEST["parentid"])]=floatval($_REQUEST["quantity"]);

if(!$mob->Convergence()) {
	echo "error";
	return;
}
//AddMessage2Log($_REQUEST);

if($_REQUEST["id"]) {

    CIBlockElement::SetPropertyValuesEx(intval($_REQUEST["id"]), false,
        array("FACTOR" => intval($_REQUEST["factorid"]),
            "QUANTITY" => floatval($_REQUEST["quantity"])));

    return false;
}
else
{
    $el = new CIBlockElement;
    $PROP = array();
    $PROP["PARENT"] = intval($_REQUEST["parentid"]);
    $PROP["FACTOR"] = intval($_REQUEST["factorid"]);
    $PROP["QUANTITY"] = floatval($_REQUEST["quantity"]);
    $arLoadProductArray = Array(
        'IBLOCK_ID' => STRUCTURE_IBID,
        'NAME' => time(),
        'ACTIVE' => 'Y', // активен
        'PROPERTY_VALUES' => $PROP,
    );

    $productID=$el->Add($arLoadProductArray);
    echo $productID;
    return;
}
