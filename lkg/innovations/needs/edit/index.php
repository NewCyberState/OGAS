<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои обсуждения");

if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);

?><div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Потребность</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

            <div class="card-body" style="">
                Страница подробного описания потребности.
            </div>
        </div>
    </div>
</div>
    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 overflow-auto order-2 order-md-1">

            <!-- Course overview -->
            <div class="card">
                <div class="card-header header-elements-md-inline">
                    <h5 class="card-title">Компактный кроссовер</h5>

                    <div class="header-elements">
                        <span class="badge bg-success ml-2">Потребность</span>
                    </div>
                </div>

                <div class="nav-tabs-responsive bg-light border-top">
                    <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
                        <li class="nav-item"><a href="#course-overview" class="nav-link active" data-toggle="tab"><i class="icon-question3  mr-2"></i> Потребность</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="course-overview">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <h5>Нужен недорогой, стильный, компактный внедорожник, автомобиль-кроссовер малого класса. Чтобы имел увеличенный клиренс, накладки на нижнюю часть дверей, пороги, колёсные арки, бамперы, защищающие эмаль кузова на лёгком бездорожье и автоматизированную механическую коробку передач.</h5>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
            <!-- /course overview -->


            <!-- Discussion -->
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <h6 class="card-title font-weight-semibold">Комментарии</h6>
                    <div class="header-elements">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">42 комментария</li>
                        </ul>
                    </div>
                </div>


                <div class="card-body">
                    <ul class="media-list">
                        <li class="media flex-column flex-md-row">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title">
                                    <a href="#" class="font-weight-semibold">Григорий Григорьев</a>
                                    <span class="text-muted ml-3">Только что</span>
                                </div>

                                <p>Концепт показали в августе прошлого года, а уже в нынешнем декабре машина должна встать на конвейер.
                                </p>

                                <ul class="list-inline list-inline-dotted font-size-sm">
                                    <li class="list-inline-item">114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                    <li class="list-inline-item"><a href="#"></a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="media flex-column flex-md-row">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title">
                                    <a href="#" class="font-weight-semibold">Семен Семенов</a>
                                    <span class="text-muted ml-3">5 минут назад</span>
                                </div>

                                <p>Если посмотреть на внешнюю скоростную характеристику мотора 21176, то увидим очень неплохую стартовую тягу (в сравнении с 21126 она увеличилась с 103 до 120 Нм), но на 2500 оборотах будет зримый провал. И если менять передачи именно в «провальном» диапазоне, то двигатель будет насиловать сам себя в необходимости «вытягиваться» до полки момента, а это где-то 3500 оборотов (у 21126 — 4200). Если мотор с такой характеристикой сгруппировать с механической коробкой, то езды «внатяг» не очень получится, придется по-спортивному делать поздние переключения. Или совсем ранние, до 2000 оборотов, но это девочково-пенсионерский стиль. «Робот» АМТ сглаживает это «моментное противоречие» даже при базовых настройках, а уж когда его откалибруют точно…</p>

                                <ul class="list-inline list-inline-dotted font-size-sm">
                                    <li class="list-inline-item">90 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                    <li class="list-inline-item"><a href="#"></a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="media flex-column flex-md-row">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title">
                                    <a href="#" class="font-weight-semibold">Сергей Сергеев</a>
                                    <span class="text-muted ml-3">7 минут назад</span>
                                </div>

                                <p>Руль «пережат» в «нуле», но не скажу, что это неприятно. Во всяком случае, самостабилизация вышла отменной, во многом из-за безупречно выбранных углов установки передних колес. Но, разумеется, моторчик электроусилителя еще калибровать и калибровать…
                                </p>

                                <ul class="list-inline list-inline-dotted font-size-sm">
                                    <li class="list-inline-item">70 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                    <li class="list-inline-item"><a href="#"></a></li>
                                </ul>

                                <div class="media flex-column flex-md-row">
                                    <div class="mr-md-3 mb-2 mb-md-0">
                                        <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#" class="font-weight-semibold">Антон Антонов</a>
                                            <span class="text-muted ml-3">10 минут назад</span>
                                        </div>

                                        <p>В целом, это, конечно, очень «сырой» автомобиль, но с большим потенциалом по настройкам. Более того, мощность мотора 1,8 просто перепрошивкой можно легко поднять до 150 л.с. и примерно 190 Нм.</p>

                                        <ul class="list-inline list-inline-dotted font-size-sm">
                                            <li class="list-inline-item">67 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                            <li class="list-inline-item"><a href="#">Ответить</a></li>
                                            <li class="list-inline-item"><a href="#"></a></li>
                                        </ul>

                                        <div class="media flex-column flex-md-row">
                                            <div class="mr-md-3 mb-2 mb-md-0">
                                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-title">
                                                    <a href="#" class="font-weight-semibold">Петр Петров</a>
                                                    <span class="text-muted ml-3">1 час назад</span>
                                                </div>

                                                <p>Окончательные характеристики машин не раскрываются, даже точная геометрия пока — тайна. Могу назвать лишь предварительные цифры. Багажник, например, имеет расчетный объем в 380 литров, но точно его еще не измеряли. Самая мощная версия должна разгоняться до 100 км/ч за 10,2 секунды и достигать «максималки» в 187 км/ч.</p>

                                                <ul class="list-inline list-inline-dotted font-size-sm">
                                                    <li class="list-inline-item">54 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                                    <li class="list-inline-item"><a href="#"></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="media flex-column flex-md-row">
                                            <div class="mr-md-3 mb-2 mb-md-0">
                                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-title">
                                                    <a href="#" class="font-weight-semibold">Елена Еленина</a>
                                                    <span class="text-muted ml-3">2 hours ago</span>
                                                </div>

                                                <p>Лишь бы не отнеслись к кондиционеру по остаточному принципу тюнингования, как например в ВАЗ-2101...
                                                    Когда, чтобы заменить ремень кондиционера, требуется частично демонтировать двигатель,
                                                    и где слабенький испаритель пытается вытянуть основное тепло не из салона, а из печки.
                                                    Или как наши китайские товарищи, которые хладопроводы могут проложить по наикратчайшей траектории, - почти поверх двигателя.
                                                    Дождёмся выпуска, чтобы увидеть все секреты инноваций.</p>

                                                <ul class="list-inline list-inline-dotted font-size-sm">
                                                    <li class="list-inline-item">41 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                                    <li class="list-inline-item"><a href="#"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="media flex-column flex-md-row">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <a href="#"><img src="/local/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="" width="38" height="38"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title">
                                    <a href="#" class="font-weight-semibold">Иван Иванов</a>
                                    <span class="text-muted ml-3">3 часа назад</span>
                                </div>

                                <p>И часто вы меняете ремень кондиционера? За 15 лет эксплуатации авто впервые слышу про эти ремни. Я к тому что проблема нераспространенная с ремнем </p>

                                <ul class="list-inline list-inline-dotted font-size-sm">
                                    <li class="list-inline-item">32 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                    <li class="list-inline-item"><a href="#">Ответить</a></li>
                                    <li class="list-inline-item"><a href="#"></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>


            </div>


            <!-- /discussion -->

        </div>
        <!-- /left content -->


        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Подробности</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <!--<div class="d-flex justify-content-center text-center mb-2 mt-2">
                        Нужно для разработки прототипа:
                    </div>

                    <div class="d-flex justify-content-center text-center mb-2 mt-2">
                        <div class="timer-number">
                            50000 <small>р.</small>
                        </div>
                    </div>-->

                    <div class="card-body pb-0">
                        <a href="#" class="btn bg-teal-400 btn-block mb-2">Поддержать</a>
                    </div>

                    <table class="table table-borderless table-xs border-top-0 my-2">
                        <tbody>
                        <tr>
                            <td class="font-weight-semibold">Поддержали:</td>
                            <td class="text-right">4000</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold">Необходимо:</td>
                            <td class="text-right">
                                5000
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold">Добавлено:</td>
                            <td class="text-right">1 июля 2021</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold">Автор:</td>
                            <td class="text-right">Петр Петров</td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="card card-collapsed">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Предложить</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <!--<div class="d-flex justify-content-center text-center mb-2 mt-2">
                        Нужно для разработки прототипа:
                    </div>

                    <div class="d-flex justify-content-center text-center mb-2 mt-2">
                        <div class="timer-number">
                            50000 <small>р.</small>
                        </div>
                    </div>-->

                    <div class="card-body pb-0">
                        <a href="/lkg/innovations/researches/add/" class="btn bg-primary-400 btn-block mb-2">Предложить идею</a>
                    </div>

                    <table class="table table-borderless table-xs border-top-0 my-2">
                        <tbody>
                        <tr>
                            <td class="font-weight-semibold">Уже предложили:</td>
                            <td class="text-right">0</td>
                        </tr>


                        </tbody>
                    </table>
                </div>


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

                    <div class="card-body p-0">
                        <div class="nav nav-sidebar mb-2">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Автомобили
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Легковые автомобили
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Изобретения
                                </a>
                            </li>

                        </div>
                    </div>
                </div>
                <!-- /categories -->



            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>