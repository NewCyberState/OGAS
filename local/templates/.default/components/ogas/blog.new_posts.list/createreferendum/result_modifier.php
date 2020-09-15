<?

if ($arParams["STATUS_ID"]) {
    $rs = CUserFieldEnum::GetList(array(), array("ID" => $arParams["STATUS_ID"], "USER_FIELD_ID" => 31));
    if ($ar = $rs->Fetch())
        $arParams["STATUS_NAME"] = $ar["VALUE"];

}
