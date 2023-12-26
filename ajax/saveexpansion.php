<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("iblock");


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
        'IBLOCK_ID' => EXPANSION_IBID,
        'NAME' => time(),
        'ACTIVE' => 'Y', // активен
        'PROPERTY_VALUES' => $PROP,
    );

    $productID=$el->Add($arLoadProductArray);
    echo $productID;
    return;
}
