<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (strlen($arResult["ErrorMessage"]) > 0) {
    ?><span class='errortext'><?= $arResult["ErrorMessage"] ?></span><?
    return;
} else {
    if (!defined("BX_SM_DEFAULT")) {
        define("BX_SM_DEFAULT", true);
        ?>
        <script>
            var bIEOpera = (BX.browser.IsIE() || BX.browser.IsOpera());
            var bMenuAdd = <?=(count($arResult['FEATURES']) > $arResult["MAX_ITEMS"] ? 'true' : 'false')?>;
            var SMupdateURL = '<?=CUtil::JSEscape(htmlspecialcharsback($arResult['UPD_URL']))?>';
            var langMenuSettDialogTitle1 = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_1"))?>';
            var langMenuSettDialogTitle_forum = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_forum"))?>';
            var langMenuSettDialogTitle_blog = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_blog"))?>';
            var langMenuSettDialogTitle_microblog = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_microblog"))?>';
            var langMenuSettDialogTitle_photo = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_photo"))?>';
            var langMenuSettDialogTitle_calendar = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_calendar"))?>';
            var langMenuSettDialogTitle_tasks = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_tasks"))?>';
            var langMenuSettDialogTitle_files = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_files"))?>';
            var langMenuSettDialogTitle_search = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_search"))?>';
            var langMenuSettDialogTitle_global = '<?=CUtil::JSEscape(GetMessage("SONET_SM_SETTINGS_TITLE_global"))?>';
                <?
                if (array_key_exists("CustomFeaturesTitle", $arResult))
                {
                foreach($arResult["CustomFeaturesTitle"] as $feature => $title)
                {
                ?>var langMenuSettDialogTitle_<?=$feature?> = '<?=CUtil::JSEscape($title)?>';<?
            }
            }
            ?>
            var langMenuError1 = '<?=CUtil::JSEscape(GetMessage("SONET_SM_TDEF_ERR1"))?>';
            var langMenuError2 = '<?=CUtil::JSEscape(GetMessage("SONET_SM_TDEF_ERR2"))?>';
            var langMenuConfirm1 = '<?=CUtil::JSEscape(GetMessage("SONET_SM_TDEF_CONF1"))?>';
            var langMenuConfirm2 = '<?=CUtil::JSEscape(GetMessage("SONET_SM_TDEF_CONF2"))?>';
        </script>
        <script type="text/javascript"
                src="/bitrix/components/bitrix/socialnetwork.menu/script.js?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/bitrix/socialnetwork.menu/script.js'); ?>"></script>
        <div id="antiselect"
             style="height:100%; width:100%; left: 0; top: 0; position: absolute; -moz-user-select: none !important; display: none; background-color:#FFFFFF; -moz-opacity: 0.01;"></div>
        <?
    }

    $allFeaturesShow = array_slice($arResult['FEATURES'], 0, $arResult["MAX_ITEMS"]);
    $allFeaturesAdd = array_slice($arResult['FEATURES'], $arResult["MAX_ITEMS"]);
    $allFeaturesInactive = array();
    ?>
    <script>
        window.___BXMenu = new BXMenu('<?=$arResult["ID"]?>');
    </script>
    <ul class="nav nav-tabs nav-tabs-highlight mb-0 border-bottom-0">
        <?

        foreach ($arResult['ALL_FEATURES'] as $feature => $arFeature) {

            if(in_array($feature,array('photo','forum','blog','search','chat','marketplace'))) continue;

            if ($arFeature["Url"] == $APPLICATION->GetCurPage())
                $active = 'active';
            else
                $active = '';


            echo "<li class='nav-item'>";
            echo "<a class='nav-link " . $active . "' href='" . $arFeature["Url"] . "'>" . $arFeature["FeatureName"] . "</a>";
            echo "</li>";
        }
        ?>
    </ul>
    <?
}
?>