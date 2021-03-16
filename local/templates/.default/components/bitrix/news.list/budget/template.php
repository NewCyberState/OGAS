<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);


use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss()
global $USER;


Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/pies/pie.js");
Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/touch.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/sliders/slider_pips.min.js");
//Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/styling/switchery.min.js");
Asset::getInstance()->addJs("/local/assets/js/app.js");
//Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/jqueryui_sliders.js");

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



function array_sum_col($arr,$col) {
    $out = 0;
    foreach ($arr as $row) {
            $out+= $row[$col];
    }
    return $out;
}

?>

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Государственный бюджет</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

            <div class="card-body" style="">
                <p class="text-default">На данной странице отображается результат общественного голосования за распределение государственного бюджета. Все граждане могут оставить свои предложения по распределению государственного бюджета по статьям расходов. Общественное распределение по статьям расходов рассчитывается программно, как среднее арифметическое от распределения, предложенного всеми гражданами в процессе голосования.</p>

            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
<?//pr($arResult)?>
        <h2>Государственный бюджет</h2>


        <div class="chart-container text-center d-none d-md-block" style="width:100%;height: 500px;">
            <div class="d-inline-block" id="google-pie"></div>
        </div>

        <h6>Результаты общественного голосования</h6>
        <div class="datatable-scroll overflow-auto">
<table class="table table-bordered table-striped table-hover table-scrollable table-condensed datatable-highlight dataTable table-bordered"  id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
    <thead>
    <tr role="row">
        <?foreach ($arResult["ITEMS"][0][PROPERTIES] as $prop):
            if($prop[NAME]=="Пользователь"):?>
                <th class="small text-wrap" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" >Гражданин</th>
        <?else:?>
        <th class="small" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" ><?=$prop[NAME]?>, %</th>
            <?endif;?>
        <?endforeach;?>
    </tr>
    </thead>
    <tbody>
<?foreach($arResult["ITEMS"] as $arItem):
    $citizen=array();?>
    <tr role="row" class="odd">
        <?foreach ($arItem[PROPERTIES] as $prop):

        if($prop[NAME]=="Пользователь"):?>
        <?
            $arUser=array();
            $rsUser = CUser::GetByID($prop[VALUE]);
            $arUser = $rsUser->Fetch();

            ?>

        <td class="sorting_1 small text-nowrap"><?=$arUser[NAME]." ".$arUser[LAST_NAME]?></td>
        <?else:
            $citizen[$prop[ID]]=$prop[VALUE];
            ?>
        <td class="sorting_1 small"><?=$prop[VALUE]?></td>
        <?endif;?>
        <?endforeach;?>
    </tr>
	<?    $state[]=$citizen;
    ?>
<?endforeach;?>
    </tbody>
    <tfoot>
    <tr role="row">
        <?foreach ($arResult["ITEMS"][0][PROPERTIES] as $prop):
            if($prop[NAME]=="Пользователь"):?>
                <th class="small text-wrap" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" >Среднее</th>
            <?else:?>
                <th class="small  text-nowrap font-weight-bold" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" ><?=round(array_sum_col($state,$prop[ID])/count($state),2);?></th>
            <?endif;?>
        <?endforeach;?>
    </tr>
    </tfoot>
</table>
        </div>
    </div>
</div>



<script type="text/javascript">

    function drawChart(d) {

        var w = $("#google-pie").parent().width();
        var h = $("#google-pie").parent().height();

        if(d === undefined)
        {
            var d=new Array();
            d.push(["Статья","Процент"]);
            <?foreach ($arResult["ITEMS"][0][PROPERTIES] as $prop):
            if($prop[NAME]!="Пользователь"):?>

            d.push(["<?=$prop["NAME"]." (".round(array_sum_col($state,$prop[ID])/count($state),2)."%)";?>",<?=round(array_sum_col($state,$prop[ID])/count($state),2);?>]);


             <?endif;?>
            <?endforeach;?>
        }
        //console.log(d);

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

    $(document).ready(function() {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    });

</script>