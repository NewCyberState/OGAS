<?
global $USER;
$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");

/*$arFilter = Array("IBLOCK_ID" => COMPANY_IBID, "ACTIVE" => "Y", "CREATED_BY" => $USER->GetID());

$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

while ($ob = $res->GetNext()) {
    $companylist[$ob[ID]] = $ob[NAME];
}

$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COMPANY");

$arFilter = Array("IBLOCK_ID" => WORKERS_IBID, "ACTIVE" => "Y", "PROPERTY_USER" => $USER->GetID());

$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

while ($ob = $res->GetNext()) {
    $company = GetElement($ob["PROPERTY_COMPANY_VALUE"]);
    $companylist[$company[ID]] = $company[NAME];
}*/

$arFilter = Array("IBLOCK_ID" => COMPANY_IBID, "ACTIVE" => "Y");

$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

while ($ob = $res->GetNext()) {
    $companylist[$ob[ID]] = $ob[NAME];
}


$aMenuLinks[] =
    Array(
        "Гражданин",
        "/lkg/",
        Array(),
        Array(),
        ""
    );

$aMenuLinks[] = 0;

foreach ($companylist as $key => $company)
    $aMenuLinks[] = Array(
        $company,
        "/ipp/" . $key . "/",
        Array(),
        Array(),
        ""
    );

$aMenuLinks[] =
    Array(
        "Создать новое предприятие",
        "/ipp/0/company/",
        Array(),
        Array(),
        ""
    );

$aMenuLinks[] = 0;

$aMenuLinks[] =
    Array(
        "Госплан",
        "/ipogv/gosplan/",
        Array(),
        Array(),
        ""
    );
$aMenuLinks[] = Array(
    "Министерство образования",
    "/ipogv/minobr/",
    Array(),
    Array(),
    ""
);

?>