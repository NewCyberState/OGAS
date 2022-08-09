<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Итоги выборов");

if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);

?><div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Итоги выборов</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

            <div class="card-body" style="">
                На странице отображаются итоги прошедших выборов.
            </div>
        </div>
    </div>
</div>

        <div class="row">
            <div class="col-lg-6 col-xl-3">

                <div class="card">
                    <a name="post116"></a>
                    <div class="card-header bg-light d-flex header-elements-inline">
                        <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                            <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Глава государства</a> <span class="font-size-base text-muted">Россия</span>
                        </h6>
                        <div class="header-elements">
                            <a href="#" title=""><span class="badge bg-success ml-2">Итоги</span></a>
                        </div>
                    </div>







                    <div class="card-body text-center">
                        <div>
                            <img class="img-fluid rounded-circle" src="https://static.tildacdn.com/tild3130-6334-4431-b933-373938623064/photo.jpg" alt="" width="170" height="170">

                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate mt-2">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Антон Антонов</a>
                            </h6>
                            Независимый кандидат
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">
                                Итоги подведены
                            </li>
                            <li class="list-inline-item">
                                11.10.2021
                            </li>
                        </ul>

                    </div>
                </div>

            </div>



            <div class="col-lg-6 col-xl-3">

                <div class="card">
                    <a name="post116"></a>
                    <div class="card-header bg-light d-flex header-elements-inline">
                        <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                            <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Депутат парламента</a> <span class="font-size-base text-muted">Россия</span>
                        </h6>
                        <div class="header-elements">
                            <a href="#" title=""><span class="badge bg-success ml-2">Итоги</span></a>
                        </div>
                    </div>







                    <div class="card-body text-center">
                        <div>
                            <img class="img-fluid rounded-circle" src="https://games-of-thrones.ru/sites/default/files/pictures/all/zhvakin/6.jpg" alt="" width="170" height="170">

                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate mt-2">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Иван Иванов</a>
                            </h6>
                            Партия КПРФ
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">
                                Итоги подведены
                            </li>
                            <li class="list-inline-item">
                                11.10.2021
                            </li>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-xl-3">

                <div class="card">
                    <a name="post116"></a>
                    <div class="card-header bg-light d-flex header-elements-inline">
                        <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                            <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Глава города</a> <span class="font-size-base text-muted">Москва</span>
                        </h6>
                        <div class="header-elements">
                            <a href="#" title=""><span class="badge bg-success ml-2">Итоги</span></a>
                        </div>
                    </div>







                    <div class="card-body text-center">
                        <div>
                            <img class="img-fluid rounded-circle" src="https://avatars.mds.yandex.net/get-pdb/4263207/7af36a2b-4d15-4261-89fb-f1bb196ad54f/s1200" alt="" width="170" height="170">

                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate mt-2">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Петр Петров</a>
                            </h6>
                            Партия "Новые люди"
                        </div>
                    </div>


                    <div class="card-footer d-flex">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">
                                Итоги подведены
                            </li>
                            <li class="list-inline-item">
                                11.10.2021
                            </li>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-xl-3">

                <div class="card">
                    <a name="post116"></a>
                    <div class="card-header bg-light d-flex header-elements-inline">
                        <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                            <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Руководитель</a> <span class="font-size-base text-muted">Институт системной социологии</span>
                        </h6>
                        <div class="header-elements">
                            <a href="#" title=""><span class="badge bg-success ml-2">Итоги</span></a>
                        </div>
                    </div>







                    <div class="card-body text-center">
                        <div>
                            <img class="img-fluid rounded-circle" src="https://i.vimeocdn.com/portrait/39557858_640x640" alt="" width="170" height="170">

                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate mt-2">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Антон Антонов</a>
                            </h6>
                            Кандидат социологических наук
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">
                                Итоги подведены
                            </li>
                            <li class="list-inline-item">
                                11.10.2021
                            </li>



                        </ul>

                    </div>
                </div>

            </div>


        </div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>