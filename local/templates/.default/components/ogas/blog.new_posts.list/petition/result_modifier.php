<?
CModule::IncludeModule("socialnetwork");


    if ($arParams["STATUS_ID"]) {
    $rs = CUserFieldEnum::GetList(array(), array("ID" => $arParams["STATUS_ID"], "USER_FIELD_ID" => 31));
    if ($ar = $rs->Fetch())
        $arParams["STATUS_NAME"] = $ar["VALUE"];

}

foreach ($arResult[POSTS] as $key=>$val) {
    //pr($val);
    if($val[SOCNET_GROUP_ID]) {
        $arGroup = CSocNetGroup::GetByID($val[SOCNET_GROUP_ID]);
        $arResult[POSTS][$key]["SOCNET_GROUP_NAME"] = $arGroup[NAME];
    }
}
