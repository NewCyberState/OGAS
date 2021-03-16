<?php
global $globalpost,$globalgroup,$globalthematics;

if ($arParams["STATUS_ID"]) {
$rs = CUserFieldEnum::GetList(array(), array("ID" => $arParams["STATUS_ID"], "USER_FIELD_ID" => 31));
    if ($ar = $rs->Fetch()) {
        $arParams["STATUS_NAME"] = $ar["VALUE"];
        $arResult["STATUS_NAME"] = $ar["VALUE"];
    }
}

$SORT = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");

$arFilter = Array(
    "ACTIVE" => "Y",
    "ID" => $arParams[ID]
);
$arSelectedFields = array("ID", "SOCNET_GROUP_ID","UF_STATUS_DATE","UF_THEMATICS","UF_LAW");

$dbPosts = CBlogPost::GetList(
    $SORT,
    $arFilter,
    $arSelectedFields,
    false,
    $arSelectedFields
);

while ($arPost = $dbPosts->Fetch())
{
//pr($arPost);
    $arGroup = CSocNetGroup::GetByID($arPost[SOCNET_GROUP_ID]);
    $arResult[SOCNET_GROUP_ID] = $arGroup[ID];
    $arResult[SOCNET_GROUP_NAME] = $arGroup[NAME];
    $arResult[UF_STATUS_DATE] = $arPost[UF_STATUS_DATE];

    $globalgroup=$arGroup;
    foreach ($arPost[UF_THEMATICS] as $item)
        $arResult[UF_THEMATICS][]=GetSection($item);

    /*if(!$arPost[UF_LAW])
    {
        $el = new CIBlockElement;

        $arLoadProductArray = Array(
            "IBLOCK_ID"      => 8,
            "NAME"           => $arResult[Post]["TITLE"],
            "ACTIVE"         => "Y",            // активен
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray))
        {
            CBlogPost::Update($arPost[ID],array("UF_LAW"=>$PRODUCT_ID));
            $arResult[UF_LAW]=$PRODUCT_ID;
        }

    }
    else
        $arResult[UF_LAW]=$arPost[UF_LAW];

    $arResult[LAW]=GetElement($arResult[UF_LAW]);
    break;*/

    $arResult[UF_LAW]=$arPost[UF_LAW];

    $arResult[LAW]=GetElement($arResult[UF_LAW]);
}

$globalthematics=$arResult[UF_THEMATICS];

//pr($arResult[POST_PROPERTIES][DATA]);
$attach=\Bitrix\Vote\Attach::getData($arResult[POST_PROPERTIES][DATA][UF_BLOG_POST_VOTE][VALUE]);

$arResult[VOTE_ID]=$attach[0][OBJECT_ID];


$globalpost=$arResult;
//pr($arResult[VOTE_ID]);

