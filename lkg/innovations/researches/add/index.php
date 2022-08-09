<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить исследование");

use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss()

Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");


if(intval($_GET["group_id"])>0)
    $socnet_group_id=intval($_GET["group_id"]);

?><div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Добавить исследование</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

        </div>
    </div>
</div>

        <div class="card">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Потребность</label>
                    <div class="col-lg-10">
                        <a href="/lkg/innovations/needs/edit/">#4323</a><p>Нужен недорогой стильный компактный внедорожник, автомобиль-кроссовер малого класса. Чтобы имел увеличенный клиренс, накладки на нижнюю часть дверей, пороги, колёсные арки, бамперы, защищающие эмаль кузова на лёгком бездорожье и автоматизированную механическую коробку передач.

                    </div>
                </div>

                <div class="form-group row">
                        <label class="col-form-label col-lg-2">Категория</label>
                    <div class="col-lg-10">
                        <select class="form-control select" data-fouc>
                            <optgroup label="Автомобили">
                                <option value="AZ">Легковые автомобили</option>
                                <option value="CO">Грузовые автомобили</option>
                                <option value="ID">Мотоциклы</option>
                                <option value="WY">Мопеды</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Название</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" value="Компактный кроссовер">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Описание</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="10" >Особенности модели - компактность, высокий клиренс и заостренные линии кузова. Автомобиль оборудован подушками для водителя и переднего пассажира, а также еще и боковые подушки на все 4 двери. Модель обладает улучшенной обтекаемостью. Скругленная форма оптики, увеличенная решетка радиатора, круглые противотуманные фары, удобный доступ к багажнику. </textarea>
                    </div>
                </div>

                <a class="btn btn-primary" href="/lkg/innovations/researches/edit/"><i class="icon-check2 mr-2"></i>Сохранить</a>
            </div>
        </div>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>