<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Глава государства - Россия - Голосование");

if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);

?><div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Голосование</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

            <div class="card-body" style="">
                Вы находитесь на странице голосования на выборах. Вам необходимо ознакомиться с описанием выборной должности, ознакомиться со списком кандидатов, выбрать кандидата, который по вашему мнению является наиболее подходящим для данной должности и нажать кнопку "Голосовать". По окочании голосования будут автоматически подведены итоги и вы получите уведомление по электронной почте.
            </div>
        </div>
    </div>
</div>
    <div class="d-flex align-items-start flex-column flex-md-row">

        <!-- Left content -->
        <div class="w-100 overflow-auto order-2 order-md-1">

            <div class="card">
                <div class="card-header bg-transparent header-elements-md-inline">
                    <h5 class="card-title">Глава государства</h5>

                    <div class="header-elements">
                        <span class="badge bg-success ml-2">Выборы</span>
                    </div>
                </div>


                <div class="card-body">
                    Функции:<br>

                    Является гарантом Конституции, прав и свобод человека и гражданина. Принимает меры по охране суверенитета, независимости и государственной целостности, обеспечивает согласованное функционирование и взаимодействие органов государственной власти.<br>

                    Определяет основные направления внутренней и внешней политики государства, представляет Россию внутри страны и в международных отношениях.<br>

                    Является Верховным Главнокомандующим Вооруженными Силами, вводит военное положение.<br><br>

                    Права:<br>
                    1) Назначает Председателя Правительства;<br>
                    2) Имеет право председательствовать на заседаниях Правительства;<br>
                    3) Имеет право назначить референдум;<br>
                    4) Принимает решение об отставке Правительства;<br><br>

                    Обязанности:<br>

                    1) Осуществляет руководство внешней политикой;<br>

                    2) Ведет переговоры и подписывает международные договоры;<br>

                    3) Вносит законопроекты<br>

                    4) Подписывает и обнародует федеральные законы;<br>

                    5) Издает указы и распоряжения<br>

                    6) Решает вопросы гражданства и предоставления политического убежища;<br>

                    7) Обращается к Федеральному Собранию с ежегодными посланиями о положении в стране, об основных направлениях внутренней и внешней политики государства.<br>

                    8) Назначает и освобождает полномочных представителей.<br>

                    9) Назначает и освобождает высшее командование Вооруженных Сил.
                </div>



            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-elements-inline bg-white">
                            <h5 class="card-title">Кандидаты</h5>
                            <div class="header-elements">
                                <span><a href="/lkg/gos/petition/?group_id=Array">Все кандидаты</a></span>
                            </div>
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
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Иван Иванов</a>
                            </h6>

                        </div>







                        <div class="card-body text-center">

                            <div class="card-img-actions d-inline-block">
                                <img class="img-fluid rounded-circle" src="https://games-of-thrones.ru/sites/default/files/pictures/all/zhvakin/6.jpg" alt="" width="170" height="170">
                                <div class="card-img-actions-overlay card-img rounded-circle">
                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                        <i class="icon-link"></i>
                                    </a>
                                </div>


                            </div>
                            <button type="button" class="btn btn-outline-danger mt-3"><i class="icon-check2 mr-2 "></i> Голосовать</button>

                        </div>

                        <div class="card-footer d-flex">
                           Член партии "Цифровая Россия".
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-xl-3">

                    <div class="card">
                        <a name="post116"></a>
                        <div class="card-header bg-light d-flex header-elements-inline">
                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Петр Петров</a>
                            </h6>

                        </div>







                        <div class="card-body text-center">

                            <div class="card-img-actions d-inline-block">
                                <img class="img-fluid rounded-circle" src="https://avatars.mds.yandex.net/get-pdb/4263207/7af36a2b-4d15-4261-89fb-f1bb196ad54f/s1200" alt="" width="170" height="170">
                                <div class="card-img-actions-overlay card-img rounded-circle">
                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                        <i class="icon-link"></i>
                                    </a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger mt-3"><i class="icon-check2 mr-2 "></i> Голосовать</button>

                        </div>

                        <div class="card-footer d-flex">
                            Независимый кандидат
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-xl-3">

                    <div class="card">
                        <a name="post116"></a>
                        <div class="card-header bg-light d-flex header-elements-inline">
                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Антон Антонов</a>
                            </h6>

                        </div>







                        <div class="card-body text-center">

                            <div class="card-img-actions d-inline-block">
                                <img class="img-fluid rounded-circle" src="https://i.vimeocdn.com/portrait/39557858_640x640" alt="" width="170" height="170">
                                <div class="card-img-actions-overlay card-img rounded-circle">
                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                        <i class="icon-link"></i>
                                    </a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-danger mt-3"><i class="icon-check2 mr-2 "></i> Голосовать</button>

                        </div>

                        <div class="card-footer d-flex">
                            Член партии "Новые люди"
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-xl-3">

                    <div class="card">
                        <a name="post116"></a>
                        <div class="card-header bg-light d-flex header-elements-inline">
                            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                                <a href="https://ogasdemo.ru/lkg/gos/elections/edit/" class="d-block" title="">Виктор Викторов</a>
                            </h6>

                        </div>







                        <div class="card-body text-center">

                            <div class="card-img-actions d-inline-block">
                                <img class="img-fluid rounded-circle" src="https://static.tildacdn.com/tild3130-6334-4431-b933-373938623064/photo.jpg" alt="" width="170" height="170">
                                <div class="card-img-actions-overlay card-img rounded-circle">
                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                        <i class="icon-link"></i>
                                    </a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger mt-3"><i class="icon-check2 mr-2 "></i> Голосовать</button>

                        </div>

                        <div class="card-footer d-flex">
                            Член партии КПРФ
                        </div>
                    </div>

                </div>
            </div>

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

                                <p>В знак протеста надо призвать народ к забастовке. Отдавать завоеванные места в Думе глупо
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

                                <p>Нужно осваивать методы ненасильственного сопротивления с помощью которых индийцы в своё время скинули британских колонизаторов. Бойкот товарам и услугам тех предприятий, которые прямо или опосредовано принадлежат всем, кто от власти замешан в масштабных фальсификациях итогов выборов, а по сути в государственном перевороте. </p>

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

                                <p>Именно КПРФ выводит людей на улицу и создает напряжение. Если честно, даже не ожидал от одряхлевшего Зюганова такое!
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

                                        <p>Не торопите события. Пока КПРФ очень бодро настроена, полагаю!!!</p>

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

                                                <p>"Единая Россия" получала гранты американского агентства по международному развитию USAID, сообщила представитель Госдепартамента Виктория Нуланд. По ее данным, партия участвовала в "некоторых" программах Международного республиканского института (IRI) и Национального демократического института по международным вопросам (NDI). </p>

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

                                                <p>у какой полудурок, он же полуумный, пойдёт голосовать за "Яблоко", да ещё и надкусанное. Все нормальные люди, пережившие "перестройку" конца 80 -х, начала 90 -х, помнят и знают Гришку Явлинсккого, обгадившегося по полной с его Программой "500 ДНЕЙ" и последующим участием в гайдаровско-чубайсовских реформах, приведших страну практически к краху, а людей к нищенству, бандитизму, проституции и пр. Именно он с компаньёнами-соратниками почти уничтожил Россию, но таки остановили вредителя.
                                                    Его бы судить, да на пожизненное, ан нет, опять во власть лезет. Теперь уже на американо-европейские денежные подачки. И надо же, жалуется мерзавец,типа голоса его своровали. Это ж надо, некто в избирательных комиссиях, якобы, воровал бюллетени, поданные за Яблоко, в целях их сокрытия и уничтожения и использовал их в сортирах типа "М" - "Ж" в качестве подтирки.
                                                    Но слава Богу,люди, народ в своём подавляющем большинстве, понимают, что таких яблок, явлинских, рыбаковых и ежи с ними в их партиии других похожих, НАМ НЕ НУЖНО. А посему хоть на мильён раз пересчитать голоса, их у них НЕ ПРИБАВИТЬСЯ. ТАКОВА ВОЛЯ НАРОДА.</p>

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

                                <p>По закону финансирование из федерального бюджета (из расчета 152 руб. за каждый поданный за партию голос) получают партии, набравшие больше 3% голосов на предыдущих выборах в Госдуму. Партия, чей кандидат набрал 3% голосов и более на президентских выборах, в течение года со дня объявления результатов получает единоразовую выплату из расчета 20 руб. за голос.
                                </p>

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

                <!--<div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Подробности</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>


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
                            <td class="text-right">Иван Иванов</td>
                        </tr>

                        </tbody>
                    </table>
                </div>-->

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">О выборах</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Группа:</span>
                            <div class="ml-auto"><a href="#">Россия</a></div>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Дата начала:</span>
                            <div class="ml-auto">01.10.2021</div>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Дата окончания:</span>
                            <div class="ml-auto">11.10.2021</a></div>
                        </li>
                    </ul>


                </div>



                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Статистика</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Статус:</span>
                            <div class="ml-auto">Идет голосование</div>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Проголосовали:</span>
                            <div class="ml-auto">102451</div>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-semibold">Не проголосовали:</span>
                            <div class="ml-auto">125957</a></div>
                        </li>
                    </ul>


                </div>




            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->

    </div>
<script>
    $("button").click(function() {
        $(".btn").not($(this)).removeClass("btn-danger").removeClass("btn-outline-danger").addClass("disabled");
        $( this ).html("<i class=\"icon-thumbs-up2 mr-2 \"></i> Ваш выбор");
        $( this ).removeClass("btn-outline-danger").removeClass("disabled").addClass("btn-danger");

    });
    </script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>