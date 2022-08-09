<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Компактный кроссовер - Стандартизация");

if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);

?><div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Стандартизация</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

            <div class="card-body" style="">
                Страница подробного описания стандарта.
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
                        <span class="badge bg-success ml-2">Стандарт</span>
                    </div>
                </div>

                <div class="nav-tabs-responsive bg-light border-top">
                    <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
                        <li class="nav-item"><a href="#tab5" class="nav-link active" data-toggle="tab"><i class="icon-certificate mr-2"></i> Стандарт</a></li>
                        <li class="nav-item"><a href="#tab4" class="nav-link" data-toggle="tab"><i class="icon-clipboard2  mr-2"></i> Испытания</a></li>
                        <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab"><i class="icon-wrench3  mr-2"></i> Разработка</a></li>
                        <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab"><i class="icon-zoomin3  mr-2"></i> Исследование</a></li>
                        <li class="nav-item"><a href="#tab1" class="nav-link" data-toggle="tab"><i class="icon-question3  mr-2"></i> Потребность</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab5">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <h3>Общий вид автомобиля</h3>

                                <img src="https://vmasshtabe.ru/wp-content/uploads/2020/03/1537909-vms-Lada-X-Ray-Kross.png" class="img-fluid mb-4">

                                <h3>Технические характеристики</h3>

                                <table class="table table-striped table-bordered ">
                                    <thead>
                                    <tr class="bg-blue">
                                        <th>#</th>
                                        <th>Характеристика</th>
                                        <th>Значение</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Длина</td>
                                        <td>4165 мм</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ширина</td>
                                        <td>1764 мм</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Высота</td>
                                        <td>1570 мм</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Колёсная база</td>
                                        <td>2592 мм</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Клиренс</td>
                                        <td>195 мм</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Ширина передней колеи</td>
                                        <td>1484 мм</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Ширина задней колеи</td>
                                        <td>1524 мм</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Размер колёс</td>
                                        <td>195/65/R15 205/55/R16 205/50/R17</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Объем багажника мин/макс, л</td>
                                        <td>361/1207</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td> Объём топливного бака, л</td>
                                        <td> 50</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Снаряженная масса, кг</td>
                                        <td>1190</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Полная масса, кг</td>
                                        <td>1650</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td> Коробка передач</td>
                                        <td>механика
                                            </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Количество передач
                                            </td>
                                        <td>5
                                            </td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Тип привода
                                            </td>
                                        <td>передний</td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>Тип передней подвески
                                        </td>
                                        <td>независимая, пружинная</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Тип задней подвески</td>
                                        <td>полунезависимая, пружинная</td>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>Передние тормоза</td>
                                        <td>дисковые вентилируемые</td>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Задние тормоза</td>
                                        <td>барабанные</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>Максимальная скорость, км/ч</td>
                                        <td>176</td>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Разгон до 100 км/ч, с</td>
                                        <td>11.4</td>
                                    </tr>
                                    <tr>
                                        <td>22</td>
                                        <td>Расход топлива, л город/трасса/смешанный</td>
                                        <td>9.3/5.9/7.2</td>
                                    </tr>
                                    <tr>
                                        <td>23</td>
                                        <td>Марка топлива</td>
                                        <td>АИ-95</td>
                                    </tr>
                                    <tr>
                                        <td>24</td>
                                        <td>Тип двигателя</td>
                                        <td>бензин</td>
                                    </tr>
                                    <tr>
                                        <td>25</td>
                                        <td>Расположение двигателя</td>
                                        <td>переднее, поперечное</td>
                                    </tr>
                                    <tr>
                                        <td>26</td>
                                        <td>Объем двигателя, см³</td>
                                        <td>1596</td>
                                    </tr>
                                    <tr>
                                        <td>27</td>
                                        <td>Максимальная мощность, л.с./кВт при об/мин</td>
                                        <td>106 / 78 при 5800</td>
                                    </tr>
                                    <tr>
                                        <td>28</td>
                                        <td>Максимальный крутящий момент, Н*м при об/мин</td>
                                        <td>148 при 4200</td>
                                    </tr>
                                    </tbody>
                                </table>



                                                                <h3 class="mt-4">Схема организации производственного процесса</h3>

                                <img src="https://www.vokrugsveta.ru/img/cmn/2013/06/04/002.jpg" class="img-fluid">


                                <h3 class="mt-4">Производственные затраты</h3>

                                Производственные затраты на производство одной единицы номенклатуры продукции, включая сырье, материалы, комплектующие, амортизацию оборудования и трудозатраты.

                                <table class="table table-bordered table-striped framed mt-2">
                                    <thead>
                                    <tr class="bg-blue">
                                        <th class="w-50">Название</th>
                                        <th>Количество</th>
                                        <th>Единица измерения</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Топливо №1</td>
                                        <td>1</td>
                                        <td>т</td>

                                    </tr>
                                    <tr>
                                        <td>Энергия №1</td>
                                        <td>1000</td>
                                        <td>квт/ч</td>

                                    </tr>
                                    <tr>
                                        <td>Сырье №1</td>
                                        <td>20</td>
                                        <td>кг</td>

                                    </tr>
                                    <tr>
                                        <td>Сырье №2</td>
                                        <td>5</td>
                                        <td>кг</td>

                                    </tr>
                                    <tr>
                                        <td>Материал №1</td>
                                        <td>5</td>
                                        <td>кг</td>
                                    </tr>
                                    <tr>
                                        <td>Материал №2</td>
                                        <td>38</td>
                                        <td>кг</td>
                                    </tr>
                                    <tr>
                                        <td>Комплектующий №1</td>
                                        <td>5</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Комплектующий №2</td>
                                        <td>1</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Оборудование №1 (амортизация)</td>
                                        <td>0,001</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Оборудование №2 (амортизация)</td>
                                        <td>0,002</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Здание №1 (амортизация)</td>
                                        <td>0,001</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Cооружение №1 (амортизация)</td>
                                        <td>0,002</td>
                                        <td>шт</td>
                                    </tr>
                                    <tr>
                                        <td>Специалист №1</td>
                                        <td>5</td>
                                        <td>чел/ч</td>
                                    </tr>
                                    <tr>
                                        <td>Специалист №2</td>
                                        <td>10</td>
                                        <td>чел/ч</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <h3 class="mt-4"><i class="icon-file-pdf mr-2 icon-2x"></i>Технические требования</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к безопасности</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к надежности</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к контролю и приемке</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к сырью, материалам</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к консервации, упаковке и маркировке</h3>

                                <h3><i class="icon-file-pdf mr-2 icon-2x"></i>Требования к эксплуатации, техническому обслуживанию, ремонту и хранению</h3>



                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade " id="tab4">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <iframe width="100%" height="710" src="https://www.youtube.com/embed/8qdC5DzuqRA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                <iframe width="100%" height="710" src="https://www.youtube.com/embed/-WRRmAwZuaM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                <iframe width="100%" height="710" src="https://www.youtube.com/embed/gvCdkb96_O0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <iframe width="100%" height="710" src="https://www.youtube.com/embed/TfWBESnuA7U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/283e9b91575111.5e35536cc7c7f.jpg">
                                <img src="https://www.carstyling.ru/resources/concept/2012_Lada_XRAY_Concept_07.jpg">
                                <img src="https://avatars.mds.yandex.net/get-zen_doc/3642096/pub_5f5732b3b7204709f060e8d7_5f5752c0ccc2347a76ecdd91/scale_1200">


                                <iframe width="100%" height="710" src="https://www.youtube.com/embed/LeG1bwAPcsM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <br><br>
                                <p>
                                    Длина серийного кроссовера составляет 4164 миллиметра, ширина 1764 мм, высота — 1570 миллиметра. Колесная база — 2592 миллиметра. Объём багажника — от 361 до 1207 литров (при сложенных спинках задних сидений).</p>

                                <p>На выбор доступно два бензиновых двигателя: модели объёмом 1,6 литров мощностью 106 л. с. и модель объёмом 1,8 литров на 122 л. с. Вариант с двигателем 1,8 л и мощностью 122 л. с. получил трансмиссию АМТ (автоматизированную механическую коробку передач).</p>

                                <p>Топливо АИ-95</p>
                                <p>Привод передний</p>
                                <p>Разгон 11.4 с</p>
                                <p>Расход 7.2 л</p>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <img src="https://avatars.mds.yandex.net/get-pdb/5070357/4a9568a9-2647-4565-b788-cc92e5ef9fcf/s1200">
                                <img src="https://www.kolesa.ru/uploads/bnnews/2015/08/07/24c00037ecd46e11805978de328e4eb8-995x550-90.png">
                                <img src="http://www.autoade.ru/wp-content/uploads/2015/03/0__Lada-Xray-sketch-7__1280_754.jpg">

                                Особенности модели - компактность, высокий клиренс и заостренные линии кузова. Автомобиль оборудован подушками для водителя и переднего пассажира, а также еще и боковые подушки на все 4 двери. Модель обладает улучшенной обтекаемостью. Скругленная форма оптики, увеличенная решетка радиатора, круглые противотуманные фары, удобный доступ к багажнику.
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="tab1">
                        <div class="card-body">
                            <div class="mt-1 mb-1">

                                <h5>Нужен недорогой стильный компактный внедорожник, автомобиль-кроссовер малого класса. Чтобы имел увеличенный клиренс, накладки на нижнюю часть дверей, пороги, колёсные арки, бамперы, защищающие эмаль кузова на лёгком бездорожье и автоматизированную механическую коробку передач.</h5>
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
                        <span class="text-uppercase font-size-sm font-weight-semibold">Стандарт</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <h5>ТУ 4514-032-00232934-2016</h5>
                        <a href="#">Ссылка на стандарт</a>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Согласования</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>


                    <table class="table table-borderless table-xs border-top-0 my-2">
                        <tbody>
                        <tr>
                            <td class="">Госстандарт</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Министерство транспорта</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Федеральная служба по техническому и экспортному контролю</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="">Министерство здравоохранения</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="">Министерство промышленности</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="">Федеральное дорожное агентство</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="">Федеральная служба по интеллектуальной собственности</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="">Министерство энергетики </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker"><span class="checked"><input type="checkbox" class="form-check-input-styled" checked="" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </td>

                        </tr>



                        </tbody>
                    </table>
                </div>




                <!-- Categories -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Автор</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="/upload/main/ed0/q3cq4b4cojntno77nxak3kgznv10oe7a.jpg" alt="" width="170" height="170">
                            <div class="card-img-actions-overlay card-img rounded-circle">
                                <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                    <i class="icon-plus3"></i>
                                </a>
                                <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">Иван Иванов</h6>
                        <span class="d-block text-muted">Автомобильный дизайнер</span>

                        <div>
                            <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            <i class="icon-star-full2 font-size-base text-warning-300"></i>
                            <i class="icon-star-full2 font-size-base text-warning-300"></i>
                        </div>
                    </div>
                </div>
                <!-- /categories -->

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