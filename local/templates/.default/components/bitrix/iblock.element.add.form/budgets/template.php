<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss()
global $USER;


Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/pies/pie.js");
Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/touch.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/sliders/slider_pips.min.js");
//Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/styling/switchery.min.js");
Asset::getInstance()->addJs("/local/assets/js/app.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/jqueryui_sliders.js");

$oldbudget = array(
    "SOCPOLITIKA" => 25.66,
    "DEFENCE" => 15.83,
    "ECONOMY" => 13.63,
    "SECURITY" => 12.46,
    "STATE" => 7.99,
    "DEBT" => 4.60,
    "SUBSIDY" => 5.18,
    "EDUCATION" => 4.68,
    "HEALTH" => 5.27,
    "CULTURE" => 0.74,
    "ECOLOGY" => 1.76,
    "MEDIA" => 0.49,
    "SPORT" => 0.38,
    "JKH" => 1.34,
);


if (!empty($arResult["ERRORS"])):?>
	<?//ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?//ShowNote($arResult["MESSAGE"])?>
<?endif?>

<script type="text/javascript">

    $(document).ready(function() {
        <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
        <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] != "Пользователь"):

        if($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]>0):?>

        $('[data-id=<?=$propertyID?>]').slider("value", <?=$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"];?> );

        <?else:?>

        $('[data-id=<?=$propertyID?>]').slider("value", <?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]?> );
        $('#input<?=$propertyID?>').val(<?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]?>);

        <?endif;?>
        <?endif;?>
        <?endforeach;?>

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    });




    function drawChart(d) {

        var w = $("#google-pie").parent().width();
        var h = $("#google-pie").parent().height();

        if(d === undefined)
        {
            var d=new Array();
            d.push(["Статья","Процент"]);
            <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
            <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]!="Пользователь"):

            if($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]>0):?>

                d.push(["<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]." (".$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]."%)";?>",<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"];?>]);

            <?else:?>

            d.push(["<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]." (".$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]]."%)";?>",<?=$oldbudget[$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]];?>]);

            <?endif;?>

            <?endif;?>
            <?endforeach;?>
        }
        console.log(d);

        var data = google.visualization.arrayToDataTable(d);

        var options = {
            is3D :true,
            forceIFrame:true,
            width: w,
            height : h,
            legend : { textStyle : {color: 'black', fontSize: 12}},

        };

        var chart = new google.visualization.PieChart(document.getElementById('google-pie'));

        chart.draw(data,options);
    }


</script>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Мой бюджет</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p class="text-default">Укажите ваше предложение о распределении государственного бюджета на следующий год по статьям расходов и нажмите "Проголосовать". Ваш голос будет учтен при расчете распределения бюджета по статьям расходов. По умолчанию заданы параметры распределения бюджета на текущий год.</p>

                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h2>Мой бюджет</h2>

                <div class="chart-container text-center d-none d-md-block" style="width:100%;height: 500px;">
                    <div class="d-inline-block" id="google-pie"></div>
                </div>

                <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                    <?=bitrix_sessid_post()?>

                    <input type="hidden" name="PROPERTY[NAME][0]" size="30" value="<?=$USER->GetFullName()?>" />

                <?
                foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
                <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]=="Значение голоса"):

                        //pr($arResult["PROPERTY_LIST_FULL"][$propertyID]);?>


                        <?if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
                        {
                        $inputNum = count($arResult["ELEMENT_PROPERTIES"][$propertyID]) ;

                        }

                        for ($i = 0; $i<$inputNum; $i++)
                        {
                           $value = $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"];

                    ?>

                        <input type="hidden" id="input<?=$propertyID."_".$i?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" />

                <span class="mb-0 ml-1 font-weight-semibold"><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?></span>
                <div class="ui-slider-horizontal jui-slider-increments jui-slider-floats-labels  jui-slider-range-min ui-slider ui-corner-all ui-widget ui-widget-content" data-fouc="" data-text="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?>" data-id="<?=$propertyID?>">
                    <div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="left:<?=$value?>%"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left:<?=$value?>%"></span>
                    </div>
                        <br>
                        <?}?>

                    <?endif;?>
                <?endforeach;?>


                    <input type="submit" class="btn btn-primary" name="iblock_submit" value="Проголосовать" />

                </form>



            </div>
        </div>
    </div>
</div>

