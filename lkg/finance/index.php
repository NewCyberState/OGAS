<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансы и платежи");

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/ecommerce_product_list.js");



?>

    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 overflow-auto order-2 order-md-1">

            <!-- Grid -->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" class="card-img img-fluid" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default">LADA Largus</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                724 900 р.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">85 отзывов</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Vesta</a>
                                </h6>

                                <a href="#" class="text-muted">Легоковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                743 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-half font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">34 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-granta-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA Granta</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                519 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-empty3 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">63 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <a href="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" data-popup="lightbox">
                                    <img src="https://carsdo.ru/job/CarsDo/preview/lada-xray-2-1.jpg" class="card-img" alt="" width="96">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-0">
                                    <a href="#" class="text-default mb-0">LADA XRAY</a>
                                </h6>

                                <a href="#" class="text-muted">Легковой автомобиль</a>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">
                                706 900 руб.</h3>

                            <div>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            </div>

                            <div class="text-muted mb-3">74 отзыва</div>

                            <button type="button" class="btn bg-teal-400"><i class="icon-cart-add mr-2"></i> Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /grid -->


            <!-- Pagination -->
            <div class="d-flex justify-content-center pt-3 mb-3">
                <ul class="pagination">
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-right"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-left"></i></a></li>
                </ul>
            </div>
            <!-- /pagination -->

        </div>
        <!-- /left content -->


        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Categories -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Категории</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <input type="search" class="form-control" placeholder="Поиск">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 font-size-base text-muted"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body border-0 p-0">
                        <ul class="nav nav-sidebar mb-2">
                            <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
                                <a href="#" class="nav-link">Наземный транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link active">Легковые автомобили</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Грузовые автомобили</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Автобусы</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link ">Мотоциклы</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Мопеды</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link">Водный транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link">Laces</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sandals</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Skate shoes</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Slip ons</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sneakers</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Winter shoes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link">Морской транспорт</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="#" class="nav-link">Beanies</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Belts</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Caps</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Sunglasses</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Headphones</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Video cameras</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Wallets</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Watches</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /categories -->


                <!-- Filters -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Фильтр</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="search" class="form-control" placeholder="Поиск бренда">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4 font-size-base text-muted"></i>
                                    </div>
                                </div>

                                <div class="overflow-auto" style="max-height: 192px;">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" checked class="form-input-styled" data-fouc=""></span></div>
                                            АвтоВАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            ГАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            УАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            БЕЛАЗ
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                            КАМАЗ
                                        </label>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="font-size-xs text-uppercase text-muted mb-3">Цвет</div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-primary rounded color-selector-active"><div class="py-1"></div>
                                                <i class="icon-checkmark3"></i>
                                            </a>
                                            <div class="font-size-sm text-center text-muted mt-1">Blue</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-warning rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Orange</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-teal rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Teal</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-pink rounded ">
                                                <div class="py-1"></div>
                                            </a>
                                            <div class="font-size-sm text-center text-muted mt-1">Pink</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-grey-800 rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Black</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-purple rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Purple</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-success rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Green</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-danger rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Red</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-2">
                                            <a href="#" class="d-block p-2 bg-info rounded"><div class="py-1"></div></a>
                                            <div class="font-size-sm text-center text-muted mt-1">Cyan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="font-size-xs text-uppercase text-muted mb-3">Опции</div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Crew neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Chest pocket
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Raglan sleeves
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Polo neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        V-neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        High collar
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Hood
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Button strip
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Wide neck
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span><input type="checkbox" class="form-input-styled" data-fouc=""></span></div>
                                        Kangaroo pocket
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn bg-blue btn-block">Фильтр</button>
                        </form>
                    </div>
                </div>
                <!-- /filters -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>