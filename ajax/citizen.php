<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
CModule::IncludeModule("main");
CModule::IncludeModule("blog");
CModule::IncludeModule("socialnetwork");
use Bitrix\Main\Entity;
use \Bitrix\Main\Service\GeoIp;

global $USER;

$rsUser = CUser::GetByID($USER->GetID());
$arFields = $rsUser->Fetch();

if(!in_array(8, CUser::GetUserGroup($USER->GetID()))) {
    $arGroups[] = 8;
    $USER->SetUserGroup($USER->GetID(), $arGroups);
}
else
    return;
//AddMessage2Log($arFields);

$ipAddress = GeoIp\Manager::getRealIp();
$result = GeoIp\Manager::getDataResult($ipAddress, "ru");
$country = $result->getGeoData()->countryName;
$region = $result->getGeoData()->regionName;
$city = $result->getGeoData()->cityName;

$groups = array("Мир", $city, $country);

//AddMessage2Log($groups);

$found = array();

foreach ($groups as $group) {
    $arOrder = Array(
        "ID" => "ASC"
    );

    $arFilter = Array(
        "SITE_ID" => SITE_ID,
        "NAME" => $group

    );
    $arSelectedFields = Array("ID", "SITE_ID", "NAME");

    $dbGroup = CSocNetGroup::GetList($arOrder, $arFilter, false, false, $arSelectedFields);
    if ($arGroup = $dbGroup->Fetch()) {
        $found[$arGroup["ID"]] = $arGroup["NAME"];
    } else {
        $arGroupFields = array(
            "SITE_ID" => SITE_ID,
            "NAME" => trim($group),
            "VISIBLE" => "Y",
            "OPENED" => "Y",
            "SUBJECT_ID" => 3,
            "INITIATE_PERMS" => SONET_ROLES_USER,
            "CLOSED" => "N"
        );
        $newID = CSocNetGroup::CreateGroup(1, $arGroupFields);
        if (IntVal($newID) > 0) {
            // AddMessage2Log($newID);
            $found[$newID] = $group;
        }
    }

}
//AddMessage2Log($found);


$arBlog = CBlog::GetByOwnerID($arFields["ID"]);
//AddMessage2Log($arBlog);
if (!$arBlog) {
    $arBlogFields = array(
        "NAME" => $arFields["NAME"] . " " . $arFields["LAST_NAME"],
        "GROUP_ID" => 1,
        "ENABLE_IMG_VERIF" => 'Y',
        "EMAIL_NOTIFY" => 'Y',
        "ACTIVE" => "Y",
        "URL" => "u" . $arFields["ID"] . "-blog-" . SITE_ID,
        "OWNER_ID" => $arFields["ID"]
    );

    //AddMessage2Log($arBlogFields);
    $newID = CBlog::Add($arBlogFields);
    //AddMessage2Log($newID);

    foreach ($found as $key => $value) {
        CSocNetUserToGroup::Add(
            array(
                "USER_ID" => $arFields["ID"],
                "GROUP_ID" => $key,
                "ROLE" => SONET_ROLES_USER,
                "INITIATED_BY_TYPE" => SONET_INITIATED_BY_USER,
                "INITIATED_BY_USER_ID" => $arFields["ID"],
                "MESSAGE" => false,
            )
        );
    }


}
/*
if($_GET["back_url"])
    LocalRedirect($_GET["back_url"]);
else
    LocalRedirect("/lkg/gos/");
*/