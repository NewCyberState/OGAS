<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Планирование инвестиций");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");


Asset::getInstance()->addJs("/local/global_assets/js/plugins/ui/moment/moment.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/daterangepicker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/anytime.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/picker_date.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.date.js");


$company = new \OGAS\Economy\Company(false);
$periods = $company->GetPeriods();

if ($_REQUEST["submit"] == "Y") {
    $mob = new \Ogas\Economy\MOB(0.01);
    $mob->FillNetProduct($date);
    $mob->SaveNetProduct($date);


    $arrFilter["PROPERTY_DATE"] = \CDatabase::FormatDate($_REQUEST[plandate], "DD.MM.YYYY", "YYYY-MM-DD");
}

?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Планирование инвестиций</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>
                        В этом разделе можно провести расчет цен необходимых инвестиций в капитальные фонды всех
                        предприятий страны.</p>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <? if ($_REQUEST["submit"] != "Y"): ?>

                        <form action="" type="post">


                            <div class="col-lg-6 p-0 mt-1">


                                <h4>Текущая дата</h4>
                                Дата, когда должно быть начато расширение производственных мощностей
                                <div class="input-group mt-1">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                    <input type="text" class="form-control daterange-single" id="curdate" name="curdate"
                                           value="01.01.2022">

                                </div>

                                <h4 class="mt-2">Плановая дата</h4>
                                Дата, на которую будет планироваться потребность в производственных мощностях
                                <div class="input-group  mt-1">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                    <input type="text" class="form-control daterange-single" id="plandate"
                                           name="plandate" value="01.01.2023">

                                </div>


                                <h4 class="mt-2">Расчет инвестиций</h4>
                                При нажатии этой кнопки будет произведен расчет необходимых инвестиций в капитальные
                                фонды, для обеспечения расширения производства на всех предприятиях страны, чтобы
                                удовлетворить весь имеющийся спрос.
                                <button class="btn btn-primary btn-lg mt-2" type="submit" name="submit" value="Y"><i
                                            class="icon-price-tags mr-2"></i>Расчитать инвестиции в капитальные фонды
                                </button>
                            </div>
                        </form>
                    <? else: ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "investments",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "NAME",
                                    1 => "",
                                ),
                                "FILTER_NAME" => "arrFilter",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "30",
                                "IBLOCK_TYPE" => "ogas",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "1000",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                    0 => "PRODUCT_ID",
                                    1 => "PLAN_QTY",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "PROPERTY_COMPANY",
                                "SORT_BY2" => "NAME",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "prices"
                            ),
                            false
                        ); ?>
                    <? endif; ?>

                </div>
            </div>


        </div>
    </div>

    <script>
        $('#date').on('apply.daterangepicker', function (ev, picker) {
            this.form.submit();
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>