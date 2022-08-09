<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/ecommerce_orders_history.js");

?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Заказы</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    В этом разделе отображаются заказы на продукцию вашего предприятия, оставленные покупателями.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Заказы</h3>
                    <p class="mb-2">Покупатели оставили через Общегосударственную систему заказа товаров и услуг заказы на продукцию вашего предприятия. Вам необходимо обеспечить производство указанной продукции, отгрузить ее на склад, откуда ее заберут сотрудники Общегосударственной транспортной службы.</p>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th colspan="2">Название продукции</th>
                                <th>Цвет</th>
                                <th>Цена</th>
                                <th>Номер заказа</th>
                                <th>Покупатель</th>
                                <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="table-active">
                                <td colspan="6" class="font-weight-semibold">Новые заказы</td>
                                <td class="text-right">
                                    <span class="badge bg-secondary badge-pill">24</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0" style="width: 45px;">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Vesta</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Синий</td>
                                <td>
                                    <h6 class="mb-0 font-weight-semibold">743 900 руб.</h6>
                                </td>
                                <td>
                                    <a href="#">1237749</a>
                                </td>
                                <td>
                                    <a href="#">Иван Иванов</a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Largus</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Красный</td>
                                <td><h6 class="mb-0 font-weight-semibold">724 900 руб.</h6></td>
                                <td>
                                    <a href="#">345634</a>
                                </td>
                                <td><a href="#">Петр Петров</a></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0" style="width: 45px;">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Vesta</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Синий</td>
                                <td>
                                    <h6 class="mb-0 font-weight-semibold">743 900 руб.</h6>
                                </td>
                                <td>
                                    <a href="#">1237749</a>
                                </td>
                                <td>
                                    <a href="#">Иван Иванов</a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Largus</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Красный</td>
                                <td><h6 class="mb-0 font-weight-semibold">724 900 руб.</h6></td>
                                <td>
                                    <a href="#">345634</a>
                                </td>
                                <td><a href="#">Петр Петров</a></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-active">
                                <td colspan="6" class="font-weight-semibold">Отргруженные заказы</td>
                                <td class="text-right">
                                    <span class="badge bg-success badge-pill">42</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0" style="width: 45px;">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Vesta</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Синий</td>
                                <td>
                                    <h6 class="mb-0 font-weight-semibold">743 900 руб.</h6>
                                </td>
                                <td>
                                    <a href="#">1237749</a>
                                </td>
                                <td>
                                    <a href="#">Иван Иванов</a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Largus</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Красный</td>
                                <td><h6 class="mb-0 font-weight-semibold">724 900 руб.</h6></td>
                                <td>
                                    <a href="#">345634</a>
                                </td>
                                <td><a href="#">Петр Петров</a></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0" style="width: 45px;">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-vesta-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Vesta</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Синий</td>
                                <td>
                                    <h6 class="mb-0 font-weight-semibold">743 900 руб.</h6>
                                </td>
                                <td>
                                    <a href="#">1237749</a>
                                </td>
                                <td>
                                    <a href="#">Иван Иванов</a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <a href="#">
                                        <img src="https://carsdo.ru/job/CarsDo/preview/lada-largus-2-1.jpg" alt="" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-semibold">Lada Largus</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark bg-grey border-grey mr-1"></span>
                                        Обрабатывается
                                    </div>
                                </td>
                                <td>Красный</td>
                                <td><h6 class="mb-0 font-weight-semibold">724 900 руб.</h6></td>
                                <td>
                                    <a href="#">345634</a>
                                </td>
                                <td><a href="#">Петр Петров</a></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>

                                        </div>
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>