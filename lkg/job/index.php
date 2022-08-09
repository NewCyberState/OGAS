<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Работа и занятость");

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/media/fancybox.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/ecommerce_product_list.js");



?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Работа и занятость <a class="list-icons-item" data-action="collapse"></a></h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body" >
                    В разделе "Работа и занятость" вы можете ознакомиться с информацией о вашем текущем месте работы, выбрать другую работу, узнать о размере вашей заработной платы и порядке ее начисления, пройти переквалификацию.

                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-start flex-column flex-md-row">


        <div class="w-100 order-2 order-md-1">

            <div class="row justify-content-md-center">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                    <h1>Ваше текущее место работы</h1>




                            <table class="table table-striped table-bordered ">
                                <tbody>
                                <tr>
                                    <td>
                                        Текущее место работы
                                    </td>
                                    <td>
                                        <a href="/ipp/">Автомобильный завод "АвтоВАЗ"</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;Должность
                                    </td>
                                    <td>
                                        Программист
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Разряд
                                    </td>
                                    <td>
                                        12
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Тарифная ставка
                                    </td>
                                    <td>
                                        425,80 руб./час
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Заработная плата
                                    </td>
                                    <td>
                                        <a href="salary/">132 645 руб.</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1>Новости</h1>




                            <p><div class="text-primary"> <span class="text-muted">20.12.2021</span> <a href="">Начислена заработная плата за декабрь</a></div>
                            <div class="">Вам начисленая заработная плата за декабрь 2021 года в сумме 132 645 руб.</div>
                            </p>
                            <p><div class="text-primary"> <span class="text-muted">20.12.2021</span> <a href="">Начислена заработная плата за ноябрь</a></div>
                            <div class="">Вам начисленая заработная плата за ноябрь 2021 года в сумме 132 645 руб.</div>
                            </p>
                            <p><div class="text-primary"> <span class="text-muted">20.12.2021</span> <a href="">Начислена заработная плата за октябрь</a></div>
                            <div class="">Вам начисленая заработная плата за октябрь 2021 года в сумме 132 645 руб.</div>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="/upload/main/ed0/q3cq4b4cojntno77nxak3kgznv10oe7a.jpg" alt="" width="170" height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="/upload/main/ed0/q3cq4b4cojntno77nxak3kgznv10oe7a.jpg" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox">
                                    <i class="icon-plus3"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">Иван Иванов</h6>



                    </div>
                    <ul class="nav nav-sidebar border-top-1 border-top-dark-alpha">
                        <li class="nav-item  text-center">
                            <a href="/personal/" class="nav-link">
                                <i class="icon-pencil5"></i>
                                Редактировать
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Рабочая смена</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-center text-center mb-2">
                            <div class="timer-number font-weight-light">
                                07 <span class="d-block font-size-base mt-2">часов</span>
                            </div>
                            <div class="timer-dots mx-1">:</div>
                            <div class="timer-number font-weight-light">
                                54 <span class="d-block font-size-base mt-2">минут</span>
                            </div>
                            <div class="timer-dots mx-1">:</div>
                            <div class="timer-number font-weight-light">
                                29 <span class="d-block font-size-base mt-2">секунд</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex align-items-center">
                        <ul class="list-inline list-inline-condensed mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-default"><i class="icon-play3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-default"><i class="icon-pause"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-default"><i class="icon-stop"></i></a>
                            </li>
                        </ul>

                        <ul class="list-inline list-inline-condensed mb-0 ml-auto">
                            <li class="list-inline-item dropdown">
                                <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="badge badge-mark border-success mr-2"></span>
                                    Открыта
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(71px, 18px, 0px);">
                                    <a href="#" class="dropdown-item active">Открыта</a>
                                    <a href="#" class="dropdown-item">На паузе</a>
                                    <a href="#" class="dropdown-item">Закрыта</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>