<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Информационный портал предприятия");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/lines/area_stacked.js");

//pr($_REQUEST);

if ($_REQUEST[CID])
    $CID = intval($_REQUEST[CID]);

$company = GetElement($CID);

$sales = new \Ogas\Economy\Company($CID);
$products = $sales->GetEndProducts();

$plandate = date("d.m.Y", strtotime("1 january next year"));

$mob = new \Ogas\Economy\MOB(0.01);

$mob->FillNetProduct($plandate);
$mob->CalculateMOB($plandate);
$grossproduct = $mob->grossproduct;


foreach ($products as $key => $value) {
    $plan = new \Ogas\Economy\Plan($key);
    $unit = $sales->GetProductUnit($key);
    $plannedquantity = $plan->Planning($plandate);

    if (!$plannedquantity)
        $plannedquantity = ceil($grossproduct[$key]);

    $productsplan[$key] = $plannedquantity . " " . $unit;

}

//pr(    $productsplan);

?>
<?if(!$_REQUEST[CID]):?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "companies",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
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
        "IBLOCK_ID" => "20",
        "IBLOCK_TYPE" => "ogas",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "100",
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
            0 => "UNIT",
            1 => "TYPE",
            2 => "ENDPRODUCT",
            3 => "RATING",
        ),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "PROPERTY_ENDPRODUCT",
        "SORT_BY2" => "NAME",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "nomenclature"
    ),
    false
);?>

<?else:?>


    <script>

        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    </script>


    <input type="hidden" id="company_id" value="<?= $CID ?>">
    <input type="hidden" id="date" value="<?= date("d.m.Y") ?>">

    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 order-2 order-md-1">

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Информационный портал предприятия</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            В разделе "Информационный портал предприятия" вы можете управлять информацией о вашем
                            предприятии.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">


                    <div class="card">
                        <div class="card-header bg-light header-elements-inline">
                            <h5 class="card-title">Ваше предприятие</h5>

                        </div>
                        <div class="card-body">

                            <table class="table table-striped table-borderless">
                                <tbody>
                                <tr>
                                    <td>Название предприятия</td>
                                    <td><?= $company["NAME"] ?></td>
                                </tr>
                                <? foreach ($company["PROPERTIES"] as $value):
                                    if ($value["VALUE"]):?>
                                        <tr>
                                            <td><?= $value[NAME] ?></td>
                                            <td><?= $value["VALUE"] ?></td>
                                        </tr>
                                    <? endif; ?>
                                <? endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </div>


                    <?if($sales->GetSales()):?>

                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">Продажи</h6>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                    <a class="list-icons-item" data-action="reload"></a>
                                    <a class="list-icons-item" data-action="remove"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart" id="google-area-stacked"></div>
                            </div>


                        </div>

                    </div>
                    <?endif;?>

                    <div class="card">
                        <div class="card-header bg-light header-elements-inline">
                            <h5 class="card-title">План производства</h5>

                        </div>
                        <div class="card-body">
                            <p class="card-text">Система планирования рассчитала для вашего предприятия план
                                производства. Вашей компании необходимо произвести до <?= $plandate ?>:</p>

                            <table class="table table-striped table-borderless">
                                <tbody>

                                    <? foreach ($productsplan as $key => $value): ?>
                                    <tr>
                                        <? if ($value): ?>
                                            <td>
                                                <?= $products[$key]; ?>
                                            </td>

                                            <td>
                                                <span class="badge bg-success badge-pill ml-auto"><?= $value; ?></span>
                                            </td>
                                        <? endif; ?>
                                    </tr>
                                    <? endforeach; ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span class="text-muted">Обновлено 2 часа назад</span>
                        </div>
                    </div>

                </div>
            </div>


        </div>


        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User card -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle"
                                 src="<?= CFILE::GetPath($company["PREVIEW_PICTURE"]) ?>" alt="" width="170"
                                 height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="<?= CFILE::GetPath($company["DETAIL_PICTURE"]) ?>"
                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round"
                                   data-popup="lightbox">
                                    <i class="icon-plus3"></i>
                                </a>
                                <a href="#"
                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0"><?= $company["NAME"] ?></h6>
                        <span class="d-block text-muted"><?= $company["PREVIEW_TEXT"] ?></span>

                        <div class="list-icons list-icons-extended mt-3">
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body"
                               data-original-title="Google Drive"><i class="icon-facebook2"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body"
                               data-original-title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body"
                               data-original-title="Github"><i class="icon-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /user card -->


                <!-- Navigation -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">О компании</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar my-2">
                            <? if ($company["PROPERTIES"]["RATING"]["VALUE"]): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-rating3"></i>
                                        Рейтинг
                                        <span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <? for ($i = 0; $i < $company["PROPERTIES"]["RATING"]["VALUE"]; $i++): ?>
                                        <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <? endfor; ?>
                                </span>
                                    </a>
                                </li>
                            <? endif; ?>
                            <? if ($company["PROPERTIES"]["EMPLOYEES"]["VALUE"]): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-user"></i>
                                        Сотрудников
                                        <span class="text-muted font-size-sm font-weight-normal ml-auto"><?= $company["PROPERTIES"]["EMPLOYEES"]["VALUE"] ?></span>
                                    </a>
                                </li>
                            <? endif; ?>
                            <? if ($company["PROPERTIES"]["FOUNDATION"]["VALUE"]): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-tree7"></i>
                                        Год основания
                                        <span class="badge bg-danger badge-pill ml-auto"><?= ConvertDateTime($company["PROPERTIES"]["FOUNDATION"]["VALUE"], "Y"); ?></span>
                                    </a>
                                </li>
                            <? endif; ?>


                        </ul>
                    </div>
                </div>
                <!-- /navigation -->


            </div>
            <!-- /sidebar content -->

        </div>

    </div>
<?endif;?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>