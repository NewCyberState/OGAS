<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Госплан");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/lines/area_stacked.js");

$gosplan=new \OGAS\Economy\Gosplan();
$stat=$gosplan->GetStat();

?>
    <script>

        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    </script>


    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 order-2 order-md-1">

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Информационный портал Госплана</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Информационный портал органа государственной власти "Государственный плановый комитет" позволяет управлять информацией, относящейся к сфере осуществления общегосударственного планирования развития народного хозяйства и контроля за выполнением данных планов.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">









                    <div class="card">
                        <div class="card-header bg-light header-elements-inline">
                            <h5 class="card-title">Статистичесие показатели системы планирования экономики</h5>

                        </div>
                        <div class="card-body">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-light">
                                    Количество факторов производства в экономике
                                    <span class="badge bg-success badge-pill ml-auto"><?=$stat["FACTORS_CNT"]?></span>
                                </li>
                                <li class="list-group-item">
                                    Количество видов конечной продукции в экономике
                                    <span class="badge bg-success badge-pill ml-auto"><?=$stat["ENDPRODUCT_CNT"]?></span>
                                </li>
                                <li class="list-group-item list-group-item-light">
                                    Валовый объем производимой продукции, шт
                                    <span class="badge bg-success badge-pill ml-auto"><?=$stat["PLAN_QTY"]?> шт</span>
                                </li>
                                <li class="list-group-item">
                                    Валовый объем производимой продукции, руб.
                                    <span class="badge bg-success badge-pill ml-auto"><?=$stat["PLAN_GROSS"]?> руб.</span>
                                </li>
                            </ul>
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
                            <img class="img-fluid rounded-circle" src="/local/images/gosplan.jpg" alt="" width="170" height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="/local/images/gosplan.jpg" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox">
                                    <i class="icon-plus3"></i>
                                </a>
                                <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">Госплан</h6>
                        <span class="d-block text-muted">Государственный комитет по планированию</span>

                        <div class="list-icons list-icons-extended mt-3">
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body" data-original-title="Google Drive"><i class="icon-facebook2"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body" data-original-title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" title="" data-container="body" data-original-title="Github"><i class="icon-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /user card -->


                <!-- Navigation -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">Сведения</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar my-2">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-rating3"></i>
                                    Рейтинг
                                    <span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-user"></i>
                                    Сотрудников
                                    <span class="text-muted font-size-sm font-weight-normal ml-auto">1855</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-tree7"></i>
                                    Год основания
                                    <span class="badge bg-danger badge-pill ml-auto">1921</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
                <!-- /navigation -->


            </div>
            <!-- /sidebar content -->

        </div>

    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>