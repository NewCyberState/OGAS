<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Планирование производства");
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");


Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/other/trendline.js");



?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Корректировка плана</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    Вы можете вручную скорректировать план выпуска продукции на любую дату.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>План производства LADA VESTA</h3>
                    <label>Система планирования произвела автоматический расчет плана производства указанной продукции. Вы можете вручную скорректировать расчет, изменив направление линии тренда.</label>

                    <div class="chart-container" id="programmatic_dashboard_div" >
                        Изменить план производства:
                        <div id="programmatic_control_div" style="min-width: 250px"></div>
                        <div class="chart" id="google-trendline"></div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>