<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Министерство образования");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/charts/google/lines/area_stacked.js");


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
                            <h5 class="card-title">Информационный портал Министерства Образования</h5>
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>

                        <div class="card-body" style="">
                            Информационный портал органа государственной власти "Министерство образования" позволяет управлять информацией, относящейся к сфере общего образования, среднего профессионального образования, соответствующего дополнительного профессионального образования, профессионального обучения, дополнительного образования детей и взрослых, воспитания, опеки и попечительства в отношении несовершеннолетних граждан, социальной поддержки и социальной защиты обучающихся.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">









                    <div class="card">
                        <div class="card-header bg-light header-elements-inline">
                            <h5 class="card-title">Текущие показатели</h5>

                        </div>
                        <div class="card-body">
                            <p class="card-text">Текущие показатели системы образования:</p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-light">
                                    Годовой объем бюджета, выделенный на образование, в процентах от общего объема государственного бюджета
                                    <span class="badge bg-success badge-pill ml-auto">7,41%</span>
                                </li>
                                <li class="list-group-item">
                                    Годовой объем бюджета системы образования, млн. руб.
                                    <span class="badge bg-success badge-pill ml-auto">2 350</span>
                                </li>
                                <li class="list-group-item list-group-item-light">
                                    Потрачено, млн. руб.
                                    <span class="badge bg-success badge-pill ml-auto">1 350</span>
                                </li>
                                <li class="list-group-item">
                                    Не потрачено, млн. руб.
                                    <span class="badge bg-success badge-pill ml-auto">1 000</span>
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
                            <img class="img-fluid rounded-circle" src="/local/images/minobr.jpg" alt="" width="170" height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="/local/images/minobr.jpg" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox">
                                    <i class="icon-plus3"></i>
                                </a>
                                <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">Министерство Образования</h6>
                        <span class="d-block text-muted">Министерства образования и науки</span>

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
                                    <span class="text-muted font-size-sm font-weight-normal ml-auto">957</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-tree7"></i>
                                    Год основания
                                    <span class="badge bg-danger badge-pill ml-auto">1946</span>
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