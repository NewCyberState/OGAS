<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить потребность");

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
                <h5 class="card-title">Добавить потребность</h5>
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            </div>

        </div>
    </div>
</div>

        <div class="card">
            <div class="card-body">

                <div class="form-group row">
                        <label class="col-form-label col-lg-2">Категория</label>
                    <div class="col-lg-10">
                        <select class="form-control select" data-fouc>
                            <optgroup label="Mountain Time Zone">
                                <option value="AZ">Автомобили</option>
                                <option value="CO">Colorado</option>
                                <option value="ID">Idaho</option>
                                <option value="WY">Wyoming</option>
                            </optgroup>
                            <optgroup label="Central Time Zone">
                                <option value="AL">Alabama</option>
                                <option value="AR">Arkansas</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
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
                        <textarea class="form-control" rows="10" >Нужен недорогой стильный компактный внедорожник, автомобиль-кроссовер малого класса. Чтобы имел увеличенный клиренс, накладки на нижнюю часть дверей, пороги, колёсные арки, бамперы, защищающие эмаль кузова на лёгком бездорожье и автоматизированную механическую коробку передач. </textarea>
                    </div>
                </div>

                <button class="btn btn-primary"><i class="icon-check2 mr-2"></i>Сохранить</button>
            </div>
        </div>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>