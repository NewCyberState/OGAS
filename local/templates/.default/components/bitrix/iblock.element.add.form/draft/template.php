<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

//pr($arResult[ELEMENT][CREATED_BY]);
//pr($arResult["PROPERTY_LIST_FULL"]);

if (!empty($arResult["ERRORS"])):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-styled-left alert-dismissible mb-0">
                <?
                ShowError(implode("<br />", $arResult["ERRORS"])) ?>
            </div>
        </div>
    </div>
<?endif;
if ($arResult["MESSAGE"] <> ''):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible mb-0">
                <? ShowNote($arResult["MESSAGE"]) ?>
            </div>
        </div>
    </div>
<? endif ?>

<?

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="">


                <form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post"
                      enctype="multipart/form-data" id="mainform">
                    <?= bitrix_sessid_post() ?>

                    <input type="hidden" name="PROPERTY[74][0]" value="0" id="vote_id">
                    <input type="hidden" name="PROPERTY[75][0]" value="<?=ConvertTimeStamp(time(),"FULL");?>" id="statusdate_id">

                    <input type="hidden" name="iblock_apply" value="" id="iblock_apply">
                    <input type="hidden" name="iblock_submit" value="" id="iblock_submit">


                    <input type="hidden" name="AUTHOR_ID" value="<?=$arResult[ELEMENT][CREATED_BY]?>" id="author_id">
                    <input type="hidden" name="PROPERTY[IBLOCK_SECTION][]" value="103" id="category">
                    <input type="hidden" name="PROPERTY[56][0]" value="1">
                    <input type="hidden" name="PROPERTY[64][0]" id="status"
                           value="<?= $arResult["ELEMENT_PROPERTIES"][64][0]["VALUE"] ?>">

                    <input type="hidden" name="PROPERTY[37][0]" value="<?=$arResult["ELEMENT_PROPERTIES"][37][0]["VALUE"]?>">


                    <? if ($arParams["MAX_FILE_SIZE"] > 0): ?><input type="hidden" name="MAX_FILE_SIZE"
                                                                     value="<?= $arParams["MAX_FILE_SIZE"] ?>" /><? endif ?>

                    <div class="table-responsive shadow-0 mb-0">
                        <table class="profile-table table table-striped">
                            <? if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])): ?>
                                <tbody>
                                <? foreach ($arResult["PROPERTY_LIST"] as $propertyID): ?>


                                    <? if ($propertyID == "IBLOCK_SECTION" || $propertyID == "56" || $propertyID == "64" || $propertyID == "37" || $propertyID == "74" || $propertyID == "75") continue; ?>

                                    <? if ($propertyID == "58"): ?>
                                        <tr>
                                            <td>
                                                Группа *
                                            </td>
                                            <td>

                                                <select name="PROPERTY[58][0]" class="form-control select select-search"
                                                        data-placeholder="Выберите группу...">
                                                    <?
                                                    $i = 0;
                                                    $arRes = CSocNetGroup::GetList(array("NUMBER_OF_MEMBERS" => "DESC"), array("ACTIVE" => "Y", "VISIBLE" => "Y", "CHECK_PERMISSIONS" => $USER->GetID()));
                                                    while ($res = $arRes->Fetch()):
                                                        if (CSocNetGroup::CanUserInitiate($USER->GetID(), $res[ID])):?>
                                                            <option value="<?= $res[ID] ?>"><?= $res["NAME"] . " (" . $res["NUMBER_OF_MEMBERS"] . plural_form($res["NUMBER_OF_MEMBERS"], array(" участник", " участника", " участников")) . ")"; ?></option>
                                                        <? endif; ?>
                                                    <? endwhile; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?
                                        continue;
                                    endif; ?>

                                    <? if ($propertyID == "59"): ?>
                                        <tr>
                                            <td>
                                                Тематики *
                                            </td>
                                            <td>

                                                <select name="PROPERTY[59][0]" class="form-control select" multiple
                                                        data-placeholder="Выберите одну или несколько тематик...">
                                                    <?
                                                    $i = 0;
                                                    $arFilter = Array('IBLOCK_ID' => 5, 'GLOBAL_ACTIVE' => 'Y');
                                                    $arRes = CIBlockSection::GetList(Array("NAME" => "ASC"), $arFilter, true);

                                                    while ($res = $arRes->Fetch()):
                                                        ?>
                                                        <option value="<?= $res[ID] ?>"><?= $res["NAME"] ?></option>
                                                    <? endwhile; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?
                                        continue;
                                    endif; ?>

                                    <? if ($propertyID == "76"): ?>
                                        <tr>
                                            <td>
                                                Ответственный за исполнение закона
                                                <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"])
                                                {?>
                                                    <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"]?>' ></i>
                                                <?}?>
                                            </td>
                                            <td>

                                                <select name="PROPERTY[76][0]" class="form-control select select-search"
                                                        data-placeholder="Выберите участника...">
                                                    <?
                                                    $selected=$arResult["ELEMENT_PROPERTIES"][76][0]["VALUE"];
                                                    ?>
                                                    <option value="" <?if(!$selected)echo 'selected';?>>Не выбран</option>
                                                    <?
                                                    $dbRequests = CSocNetUserToGroup::GetList(
                                                        array("USER_LAST_NAME" => "ASC", "USER_NAME" => "ASC"),
                                                        array(
                                                            "GROUP_ID" => $arResult["ELEMENT_PROPERTIES"][37][0]["VALUE"] ,
                                                            "USER_ACTIVE" => "Y",
                                                            "GROUP_ACTIVE" => "Y"

                                                        ),
                                                        false,
                                                        false,
                                                        array("ID", "USER_ID", "GROUP_ID","USER_NAME", "USER_LAST_NAME")
                                                    );



                                                    while ($res = $dbRequests->Fetch()):
                                                    ?>

                                                            <option value="<?= $res[USER_ID] ?>" <?if($res[USER_ID]==$selected)echo 'selected';?>><?= $res["USER_NAME"]." ".$res["USER_LAST_NAME"]  ?></option>

                                                    <? endwhile; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?
                                        continue;
                                    endif; ?>



                                    <tr>
                                        <td><? if (intval($propertyID) > 0): ?><?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?><? else: ?><?= !empty($arParams["CUSTOM_TITLE_" . $propertyID]) ? $arParams["CUSTOM_TITLE_" . $propertyID] : GetMessage("IBLOCK_FIELD_" . $propertyID) ?><? endif ?><? if (in_array($propertyID, $arResult["PROPERTY_REQUIRED"])): ?>
                                                <span class="starrequired">*</span><? endif ?>

                                            <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"])
                                            {?>
                                                <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"]?>' ></i>
                                            <?}?>

                                        </td>


                                        <td>
                                            <?
                                            if (intval($propertyID) > 0) {
                                                if (
                                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                                    &&
                                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                                                )
                                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                                                elseif (
                                                    (
                                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                                        ||
                                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                                    )
                                                    &&
                                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                                                )
                                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                                            } elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y") {
                                                $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                                                $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                                            } else {
                                                $inputNum = 1;
                                            }

                                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                                                $INPUT_TYPE = "USER_TYPE";
                                            else
                                                $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

                                            switch ($INPUT_TYPE):
                                                case "USER_TYPE":
                                                    for ($i = 0; $i < 1; $i++) {
                                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                            $description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
                                                        } elseif ($i == 0) {
                                                            $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                                            $description = "";
                                                        } else {
                                                            $value = "";
                                                            $description = "";
                                                        }

                                                        echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                                                            array(
                                                                $arResult["PROPERTY_LIST_FULL"][$propertyID],
                                                                array(
                                                                    "VALUE" => $value,
                                                                    "DESCRIPTION" => $description,
                                                                ),
                                                                array(
                                                                    "VALUE" => "PROPERTY[" . $propertyID . "][" . $i . "][VALUE]",
                                                                    "DESCRIPTION" => "PROPERTY[" . $propertyID . "][" . $i . "][DESCRIPTION]",
                                                                    "FORM_NAME" => "iblock_add",
                                                                ),
                                                            ));

                                                        ?><?
                                                    }
                                                    break;
                                                case "TAGS":
                                                    $APPLICATION->IncludeComponent(
                                                        "bitrix:search.tags.input",
                                                        "",
                                                        array(
                                                            "VALUE" => $arResult["ELEMENT"][$propertyID],
                                                            "NAME" => "PROPERTY[" . $propertyID . "][0]",
                                                            "TEXT" => 'size="' . $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] . '"',
                                                        ), null, array("HIDE_ICONS" => "Y")
                                                    );
                                                    break;
                                                case "HTML":
                                                    $LHE = new CHTMLEditor;
                                                    $LHE->Show(array(
                                                        'name' => "PROPERTY[" . $propertyID . "][0]",
                                                        'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[" . $propertyID . "][0]"),
                                                        'inputName' => "PROPERTY[" . $propertyID . "][0]",
                                                        'content' => $arResult["ELEMENT"][$propertyID],
                                                        'width' => '100%',
                                                        'minBodyWidth' => 350,
                                                        'normalBodyWidth' => 555,
                                                        'height' => '200',
                                                        'bAllowPhp' => false,
                                                        'limitPhpAccess' => false,
                                                        'autoResize' => true,
                                                        'autoResizeOffset' => 40,
                                                        'useFileDialogs' => false,
                                                        'saveOnBlur' => true,
                                                        'showTaskbars' => false,
                                                        'showNodeNavi' => false,
                                                        'askBeforeUnloadPage' => true,
                                                        'bbCode' => false,
                                                        'siteId' => SITE_ID,
                                                        'controlsMap' => array(
                                                            array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                                                            array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                                                            array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                                                            array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                                                            array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                                                            array('id' => 'Color', 'compact' => true, 'sort' => 130),
                                                            array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                                                            array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                                                            array('separator' => true, 'compact' => false, 'sort' => 145),
                                                            array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                                                            array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                                                            array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                                                            array('separator' => true, 'compact' => false, 'sort' => 200),
                                                            array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                                                            array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                                                            array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                                                            array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                                                            array('separator' => true, 'compact' => false, 'sort' => 290),
                                                            array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                                                            array('id' => 'More', 'compact' => true, 'sort' => 400)
                                                        ),
                                                    ));
                                                    break;
                                                case "T":
                                                    for ($i = 0; $i < $inputNum; $i++) {

                                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                        } elseif ($i == 0) {
                                                            $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                                        } else {
                                                            $value = "";
                                                        }
                                                        ?>
                                                        <textarea
                                                                cols="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                                rows="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] ?>"
                                                                name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= $value ?></textarea>
                                                        <?
                                                    }
                                                    break;

                                                case "S":
                                                case "N":
                                                    for ($i = 0; $i < $inputNum; $i++) {
                                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                        } elseif ($i == 0) {
                                                            $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                                                        } else {
                                                            $value = "";
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control"
                                                               name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"
                                                               size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>"
                                                               value="<?= $value ?>" /><?
                                                        if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                                                            $APPLICATION->IncludeComponent(
                                                                'bitrix:main.calendar',
                                                                '',
                                                                array(
                                                                    'FORM_NAME' => 'iblock_add',
                                                                    'INPUT_NAME' => "PROPERTY[" . $propertyID . "][" . $i . "]",
                                                                    'INPUT_VALUE' => $value,
                                                                ),
                                                                null,
                                                                array('HIDE_ICONS' => 'Y')
                                                            );
                                                            ?>
                                                            <small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small><?
                                                        endif
                                                        ?><?
                                                    }
                                                    if ($inputNum > 1)
                                                        echo "<input class=\"btn btn-primary btn-sm mt-1\" type=\"button\" name='addbtn' onclick=\"addNewField(this);\" value=\"Добавить\" >";
                                                    break;

                                                case "F":
                                                    for ($i = 0; $i < $inputNum; $i++) {
                                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                        ?>
                                                        <input type="hidden"
                                                               name="PROPERTY[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]"
                                                               value="<?= $value ?>"/>
                                                        <input type="file" class="form-control"
                                                               size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                               name="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"/>
                                                        <?

                                                        if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value])) {
                                                            ?>
                                                            <input type="checkbox" class="form-control"
                                                                   name="DELETE_FILE[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]"
                                                                   id="file_delete_<?= $propertyID ?>_<?= $i ?>"
                                                                   value="Y"/>
                                                            <label for="file_delete_<?= $propertyID ?>_<?= $i ?>"><?= GetMessage("IBLOCK_FORM_FILE_DELETE") ?></label>
                                                            <?

                                                            if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"]) {
                                                                ?>
                                                                <img src="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"
                                                                     height="<?= $arResult["ELEMENT_FILES"][$value]["HEIGHT"] ?>"
                                                                     width="<?= $arResult["ELEMENT_FILES"][$value]["WIDTH"] ?>"
                                                                     border="0"/><br/>
                                                                <?
                                                            } else {
                                                                ?>
                                                                <?= GetMessage("IBLOCK_FORM_FILE_NAME") ?>: <?= $arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"] ?>
                                                                <br/>
                                                                <?= GetMessage("IBLOCK_FORM_FILE_SIZE") ?>: <?= $arResult["ELEMENT_FILES"][$value]["FILE_SIZE"] ?> b
                                                                <br/>
                                                                [
                                                                <a href="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"><?= GetMessage("IBLOCK_FORM_FILE_DOWNLOAD") ?></a>]
                                                                <br/>
                                                                <?
                                                            }
                                                        }
                                                    }

                                                    break;
                                                case "L":

                                                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                                                    else
                                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";


                                                    switch ($type):
                                                        case "checkbox":
                                                        case "radio":
                                                            foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                                $checked = false;
                                                                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                                    if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                                                                        foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                                                                            if ($arElEnum["VALUE"] == $key) {
                                                                                $checked = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    if ($arEnum["DEF"] == "Y") $checked = true;
                                                                }

                                                                ?>
                                                                <input type="<?= $type ?>" class="form-control"
                                                                       name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>"
                                                                       value="<?= $key ?>"
                                                                       id="property_<?= $key ?>"<?= $checked ? " checked=\"checked\"" : "" ?> />
                                                                <label for="property_<?= $key ?>"><?= $arEnum["VALUE"] ?></label>
                                                                <?
                                                            }
                                                            break;

                                                        case "dropdown":
                                                        case "multiselect":
                                                            ?>
                                                            <select class="form-control select"
                                                                    name="PROPERTY[<?= $propertyID ?>]<?= $type == "multiselect" ? "[]\" size=\"" . $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] . "\" multiple=\"multiple" : "" ?>">
                                                                <option value=""><?
                                                                    echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA") ?></option>
                                                                <?
                                                                if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                                                                else $sKey = "ELEMENT";

                                                                foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                                    $checked = false;
                                                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                                        foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum) {
                                                                            if ($key == $arElEnum["VALUE"]) {
                                                                                $checked = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        if ($arEnum["DEF"] == "Y") $checked = true;
                                                                    }
                                                                    ?>
                                                                    <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
                                                                    <?
                                                                }
                                                                ?>
                                                            </select>
                                                            <?
                                                            break;

                                                    endswitch;
                                                    break;
                                            endswitch; ?>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                                <? if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0): ?>
                                    <tr>
                                        <td><?= GetMessage("IBLOCK_FORM_CAPTCHA_TITLE") ?></td>
                                        <td>
                                            <input type="hidden" name="captcha_sid"
                                                   value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                                 width="180" height="40" alt="CAPTCHA"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?= GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT") ?><span
                                                    class="starrequired">*</span>:
                                        </td>
                                        <td><input type="text" name="captcha_word" maxlength="50" value=""></td>
                                    </tr>
                                <? endif ?>
                                </tbody>
                            <? endif ?>
                            <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="mb-2 text-muted">
                                        Чтобы сохранить законопроект для последующего редактирования - нажмите
                                        "Сохранить".<br>
                                        Чтобы опубликовать законопроект и вынести его на референдум - нажмите
                                        "Опубликовать".
                                    </div>
                                    <input type="button" class="btn btn-danger" id="btn_submit"
                                           value="Опубликовать">

                                    <input type="button" class="btn btn-primary" id="btn_apply"
                                           value="<?= GetMessage("IBLOCK_FORM_SUBMIT") ?>"/>
                                    <? if ($arParams["LIST_URL"] <> ''): ?>

                                        <input
                                                class="btn btn-secondary"
                                                type="button"
                                                name="iblock_cancel"
                                                value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
                                                onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"]) ?>';"
                                        >
                                    <? endif ?>

                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function addNewField(e) {
        var cnt = $(e).siblings().length;
        $(e).before('<input type="text" class="form-control" name="PROPERTY[71][' + cnt + ']" size="30" value="">');
    }

    $("#btn_apply").on('click', function (e) {
        e.preventDefault();
        var form = $("#mainform");
        $("#iblock_apply").val("Сохранить");
        form.submit();
    });

        $("#btn_submit").on('click', function (e) {
        var form = $("#mainform");

            $.ajax({
                url: '/ajax/createvote.php',
                method: 'post',
                dataType: 'html',
                data:  $("#mainform").serialize(),
                success: function (data) {
                    $("#vote_id").val(data);
                    $("#status").val("4");
                    $("#category").val("104");
                    $("#iblock_submit").val("Опубликовать");
                    $("#mainform").submit();
                    //alert(data);
                },
                error: function(data){
                    console.log(data);
                }
            });
    });


</script>