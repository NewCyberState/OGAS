<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Планирование производства");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/picker_date.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.date.js");

Asset::getInstance()->addJs("/local/global_assets/js/plugins/ui/moment/moment.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/daterangepicker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/anytime.min.js");


Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/other/trendline.js");

$product=GetElement($_REQUEST[ID]);

?>
    <input id="product_id" type="hidden" value="<?= $_REQUEST[ID] ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">План производства</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    Автоматический расчет плана производства продукции.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>План производства товара <?=$product[NAME]?></h3>
                    Дата, на которую осуществляется расчет плана:
                    <div class="col-lg-3 p-0 mt-1 mb-3">
                        <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                            <input type="text" class="form-control daterange-single" id="date" value="01.01.2023">
                        </div>
                    </div>
                    <label>Система планирования произвела автоматический расчет плана производства указанной
                        продукции.</label>

                    <? /*?><div class="chart-container" id="programmatic_dashboard_div" >
                        Изменить план производства:
                        <div id="programmatic_control_div" style="min-width: 250px"></div>
                        <div class="chart" id="google-trendline"></div>
                    </div><?*/ ?>
                    <div class="chart" id="google-trendline"></div>


                </div>
            </div>
        </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>