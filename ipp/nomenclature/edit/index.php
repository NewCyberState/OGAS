<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Цифровой двойник товара");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");

Asset::getInstance()->addJs("/local/global_assets/js/plugins/buttons/spin.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/plugins/buttons/ladda.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/components_buttons.js");

Asset::getInstance()->addJs("/local/global_assets/js/plugins/notifications/pnotify.min.js");



if ($_REQUEST[CID])
    $CID = intval($_REQUEST[CID]);
if ($_REQUEST[PID])
    $PID = intval($_REQUEST[PID]);

$company = new \OGAS\Economy\Company($CID);

//pr($_POST);

if ($_POST["ID"]) {
    $company->UpdateProduct($_POST);
} elseif ($_POST && !$_POST[ID]) {
    $company->AddProduct($_POST);
}

$product = $company->GetProduct($PID);

$structure = $company->GetStructure($PID);

$expansion = $company->GetExpansion($PID);


//pr($product);

$types = $company->GetProductTypes();
$units = $company->GetProductUnits();
$periods = $company->GetPeriods();

?>


    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Цифровой двойник товара</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    На этой странице можно добавить или отредактировать информацию о номенклатуре продукции предприятия
                    - название, описание, свойства номенклатуры, затраты на производство.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-teal header-elements-inline">
                    <h3 class="card-title">Свойства номенклатуры</h3>

                </div>
                <div class="card-body">
                    <form id="product_form" method="post" enctype="multipart/form-data">
                        <input id="parentid" type="hidden" value="<?= $PID ?>" name="ID">
                        <input type="hidden" value="<?= $CID ?>" name="PROPERTY_COMPANY">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Предприятие</label>
                            <div class="col-lg-9">
                                <?= $company->name ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Название номенклатуры</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control mb-2" value="<?= $product[NAME] ?>" name="NAME">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Описание</label>
                            <div class="col-lg-9">
                                <textarea rows="5" cols="5" class="form-control" name="PREVIEW_TEXT"
                                          placeholder=""><?= $product[PREVIEW_TEXT] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Изображение</label>
                            <div class="media mt-0 col-lg-9">
                                <div class="mr-3">

                                    <? if ($product["DETAIL_PICTURE"]): ?>
                                        <img src="<? echo \CFile::GetPath($product["DETAIL_PICTURE"]) ?>" width="60"
                                             class="rounded-round">
                                    <? else: ?>
                                        <img src="/local/global_assets/images/placeholders/placeholder.jpg" width="60"
                                             height="60" class="rounded-round" alt="">
                                    <? endif; ?>

                                </div>

                                <div class="media-body">
                                    <input type="file" class="form-input-styled" data-fouc name="DETAIL_PICTURE">
                                    <span class="form-text text-muted">Допустимые форматы: gif, png, jpg. Максимальный размер файла 2Mb</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Конечный продукт</label>
                            <div class="col-lg-9">
                                <div class="form-check mt-0">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input-styled"
                                               value="16" <? if ($product["PROPERTY_ENDPRODUCT_VALUE"]) echo "checked" ?>
                                               name="PROPERTY_ENDPRODUCT" data-fouc>
                                        Установите галочку, если это конечный продукт для продажи гражданам или другим
                                        предприятиям
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Тип номенклатуры</label>
                            <div class="col-lg-3">
                                <select class="form-control select mb-2" name="PROPERTY_TYPE">
                                    <? foreach ($types as $key => $type): ?>
                                        <option value="<?= $key ?>" <? if ($key == $product["PROPERTY_TYPE_VALUE"]) echo "selected" ?>><?= $type["UF_NAME"] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Единица измерения</label>
                            <div class="col-lg-3">
                                <select class="form-control select mb-2" name="PROPERTY_UNIT">
                                    <? foreach ($units as $key => $unit): ?>
                                        <option value="<?= $key ?>" <? if ($key == $product["PROPERTY_UNIT_VALUE"]) echo "selected" ?>><?= $unit["UF_NAME"] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Продолжительность производственного цикла
                                <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"
                                   data-popup="popover" title="" data-trigger="hover" data-placement="top"
                                   data-content="Период времени, необходимый для полного изготовления товара или услуги, от момента поступления сырья и материалов до отгрузки готовой продукции."
                                   data-original-title=""></i>
                            </label>


                            <div class="col-lg-3">
                                <select class="form-control select mb-2" name="PROPERTY_PERIOD">
                                    <? foreach ($periods as $key => $period): ?>
                                        <option value="<?= $key ?>" <? if ($key == $product["PROPERTY_PERIOD_VALUE"]) echo "selected" ?>><?= $period["UF_NAME"] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Объем производственных мощностей
                                <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"
                                   data-popup="popover" title="" data-trigger="hover" data-placement="top"
                                   data-content="Укажите текущие максимальные производственные мощности предприятия по выпуску данной номенклатуры продукции за один производственный цикл в указанных выше единицах измерения"
                                   data-original-title=""></i>
                            </label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control"
                                       value="<?= $product["PROPERTY_CAPACITY_VALUE"] ?>" name="PROPERTY_CAPACITY">

                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Продолжительность расширения производства                                <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"
                                   data-popup="popover" title="" data-trigger="hover" data-placement="top"
                                   data-content="Период времени, необходимый для расширения производства."
                                   data-original-title=""></i>
                            </label>


                            <div class="col-lg-3">
                                <select class="form-control select mb-2" name="PROPERTY_EXPANSIONPERIOD">
                                    <? foreach ($periods as $key => $period): ?>
                                        <option value="<?= $key ?>" <? if ($key == $product["PROPERTY_EXPANSIONPERIOD_VALUE"]) echo "selected" ?>><?= $period["UF_NAME"] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Объем расширения производства
                                <i class="icon-question text-secondary border-secondary icon-question4 font-size-lg"
                                   data-popup="popover" title="" data-trigger="hover" data-placement="top"
                                   data-content="Укажите, какой объем дополнительных производственных мощностей будет введен строй после проведения работ по расширению производства в соответствии с таблицей затрат на расширение производства, расположенной ниже. Объем дополнительных производственных мощностей задается в указанных выше единицах измерения за один производственный цикл"
                                   data-original-title=""></i></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control"
                                       value="<?= $product["PROPERTY_EXPANSION_VALUE"] ?>" name="PROPERTY_EXPANSION">

                            </div>
                        </div>

                        <div class="form-group row border-top pt-3 pb-0">
                            <span class="col-lg-3 col-form-label"></span>
                            <div class="col-lg-9">
                                <button type="submit" id="product_submit"
                                        class="btn btn-primary "
                                        data-style="zoom-in">
                                    <span class="">Сохранить</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <? if ($PID > 0): ?>
                <div class="card">
                    <div class="card-header bg-warning   header-elements-inline">
                        <h3 class="card-title">Производственные затраты</h3>

                    </div>
                    <div class="card-body">

                        <h6 class="mb-3">Укажите полные производственные затраты на производство одной единицы
                            номенклатуры
                            продукции, включая сырье, материалы, комплектующие, амортизацию оборудования и
                            трудозатраты.</h6>


                        <table class="table table-bordered framed structuretable">
                            <thead>
                            <tr>
                                <th class="w-50">Название</th>
                                <th>Тип</th>
                                <th>Количество</th>
                                <th>Единица измерения</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($structure as $k => $str): ?>
                                <tr data-id="<?= $k ?>">
                                    <td>
                                        <select class="form-control select select-search factor">
                                            <? foreach ($company->GetProductTypes() as $key => $type):
                                                $products = $company->GetProductsByType($type["UF_XML_ID"]);
                                                if ($products):?>
                                                    <optgroup label="<?= $type["UF_NAME"] ?>">
                                                        <? foreach ($products as $key => $product): ?>
                                                            <option value="<?= $key ?>" <? if ($str[0] == $key) echo "selected" ?>
                                                                    data-type="<?= $type["UF_NAME"] ?>"
                                                                    data-unit="<?= $company->GetProductUnit($key) ?>"><?= $product ?></option>
                                                        <? endforeach; ?>
                                                    </optgroup>
                                                <? endif; ?>
                                            <? endforeach; ?>
                                        </select>
                                    </td>
                                    <td><?= $str[3] ?></td>
                                    <td><input class="form-control quantity" type="text" value="<?= $str[1] ?>"></td>
                                    <td><?= $company->GetProductUnit($str[0]) ?></td>
                                    <td>
                                        <button class="btn btn-icon deletebtn" alt="Удалить" title="Удалить">
                                            <i class="icon-cross2"></i>
                                        </button>
                                        <i class="icon-spinner2 spinner savebtn d-none"></i>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            <tr class="d-none emptytr">
                                <td>
                                    <input class="form-control elementid" type="hidden" value="0">
                                    <select class="form-control factor">
                                        <option>Выберите фактор производства</option>
                                        <? foreach ($company->GetProductTypes() as $key => $type):
                                            $products = $company->GetProductsByType($type["UF_XML_ID"]);
                                            if ($products):?>
                                                <optgroup label="<?= $type["UF_NAME"] ?>">
                                                    <? foreach ($products as $key => $product): ?>
                                                        <option value="<?= $key ?>" data-type="<?= $type["UF_NAME"] ?>"
                                                                data-unit="<?= $company->GetProductUnit($key) ?>"><?= $product ?></option>
                                                    <? endforeach; ?>
                                                </optgroup>
                                            <? endif; ?>
                                        <? endforeach; ?>
                                    </select>
                                </td>
                                <td></td>
                                <td><input class="form-control quantity" type="text" value=""></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-icon deletebtn" alt="Удалить" title="Удалить">
                                        <i class="icon-cross2"></i>
                                    </button>
                                    <i class="icon-spinner2 spinner savebtn d-none"></i>
                                </td>
                            </tr>

                            </tbody>
                        </table>


                        <button type="button" id="addtr"
                                class="btn btn-primary mt-2">
                            <i class="icon-plus2"></i>
                        </button>

                    </div>
                </div>


                <div class="card">
                    <div class="card-header bg-blue   header-elements-inline">
                        <h3 class="card-title">Расширение производства</h3>

                    </div>
                    <div class="card-body">

                        <h6 class="mb-3">Укажите полные затраты, необходимые для расширения производства, включая сырье,
                            материалы, комплектующие, амортизацию оборудования и трудозатраты.</h6>


                        <table class="table table-bordered framed expansiontable">
                            <thead>
                            <tr>
                                <th class="w-50">Название</th>
                                <th>Тип</th>
                                <th>Количество</th>
                                <th>Единица измерения</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($expansion as $k => $str): ?>
                                <tr data-id="<?= $k ?>">
                                    <td>
                                        <select class="form-control select select-search factor2">
                                            <? foreach ($company->GetProductTypes() as $key => $type):
                                                $products = $company->GetProductsByType($type["UF_XML_ID"]);
                                                if ($products):?>
                                                    <optgroup label="<?= $type["UF_NAME"] ?>">
                                                        <? foreach ($products as $key => $product): ?>
                                                            <option value="<?= $key ?>" <? if ($str[0] == $key) echo "selected" ?>
                                                                    data-type="<?= $type["UF_NAME"] ?>"
                                                                    data-unit="<?= $company->GetProductUnit($key) ?>"><?= $product ?></option>
                                                        <? endforeach; ?>
                                                    </optgroup>
                                                <? endif; ?>
                                            <? endforeach; ?>
                                        </select>
                                    </td>
                                    <td><?= $str[3] ?></td>
                                    <td><input class="form-control quantity2" type="text" value="<?= $str[1] ?>"></td>
                                    <td><?= $company->GetProductUnit($str[0]) ?></td>
                                    <td>
                                        <button class="btn btn-icon deletebtn2" alt="Удалить" title="Удалить">
                                            <i class="icon-cross2"></i>
                                        </button>
                                        <i class="icon-spinner2 spinner savebtn2 d-none"></i>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            <tr class="d-none emptytr2">
                                <td>
                                    <input class="form-control elementid" type="hidden" value="0">
                                    <select class="form-control factor2">
                                        <option>Выберите фактор производства</option>
                                        <? foreach ($company->GetProductTypes() as $key => $type):
                                            $products = $company->GetProductsByType($type["UF_XML_ID"]);
                                            if ($products):?>
                                                <optgroup label="<?= $type["UF_NAME"] ?>">
                                                    <? foreach ($products as $key => $product): ?>
                                                        <option value="<?= $key ?>" data-type="<?= $type["UF_NAME"] ?>"
                                                                data-unit="<?= $company->GetProductUnit($key) ?>"><?= $product ?></option>
                                                    <? endforeach; ?>
                                                </optgroup>
                                            <? endif; ?>
                                        <? endforeach; ?>
                                    </select>
                                </td>
                                <td></td>
                                <td><input class="form-control quantity2" type="text" value=""></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-icon deletebtn2" alt="Удалить" title="Удалить">
                                        <i class="icon-cross2"></i>
                                    </button>
                                    <i class="icon-spinner2 spinner savebtn d-none"></i>
                                </td>
                            </tr>

                            </tbody>
                        </table>


                        <button type="button" id="addtr2"
                                class="btn btn-primary mt-2">
                            <i class="icon-plus2"></i>
                        </button>

                    </div>
                </div>

            <? endif; ?>
        </div>
    </div>

    <script>

        $("#product_submit").on('click', function (e) {
            var form = $("#productform");

            $.ajax({
                type: "POST",
                url: "/ajax/saveproduct.php",
                data: $(form).serializeArray()
            }).done(function (html) {
                if ($(html).find('.alert').length) {
                    $('#ajax_auth').parent().html(html);
                }

            });
        });

        var delay = (function(){
            var timer = 0;
            return function(callback, ms, that){
                clearTimeout (timer);
                timer = setTimeout(callback.bind(that), ms);
            };
        })();

        $("body").on('keyup', ".quantity", function (e) {

            delay(function(){


            var quantity = $(this).val();
            var factorid = $(this).parent().prev().prev().find("select").val();
            var id = $(this).parent().parent().data("id");
            var parentid = $("#parentid").val();

            var that = $(this);

            $(this).parent().next().next().find(".savebtn").removeClass("d-none");

            $.ajax({
                type: "POST",
                url: "/ajax/savestructure.php",
                data: ({"id": id, "factorid": factorid, "quantity": quantity, "parentid": parentid}),
            }).done(function (d) {

                if (d) {
                    if (d == "error") {
                        new PNotify({
                            title: 'ОШИБКА!',
                            text: 'Введенное значение в поле Количество делает невозможным рассчитать план для всей экономики. Измените значение!',
                            addclass: 'alert alert-warning alert-styled-right',
                            type: 'error'
                        });
                    }
                    else
                        that.parent().parent().data("id", d);
                }

                that.parent().next().next().find(".savebtn").addClass("d-none");

            });

            }, 1000, this);
        });

        $("body").on('change', ".factor", function (e) {
            var factorid = $(this).val();
            var quantity = $(this).parent().next().next().find("input").val();
            var parentid = $("#parentid").val();
            var id = $(this).parent().parent().data("id");
            var type = $(this).find("option:selected").data("type");
            var unit = $(this).find("option:selected").data("unit");

            var that = $(this);

            $(this).parent().next().html(type);
            $(this).parent().next().next().next().html(unit);

            $(this).parent().next().next().next().next().find(".savebtn").removeClass("d-none");

            $.ajax({
                type: "POST",
                url: "/ajax/savestructure.php",
                data: ({"id": id, "factorid": factorid, "quantity": quantity, "parentid": parentid}),
            }).done(function (d) {

                if (d) {
                    if (d == "error") {
                        new PNotify({
                            title: 'ОШИБКА!',
                            text: 'Введенное значение в поле Количество делает невозможным рассчитать план для всей экономики. Измените значение!',
                            addclass: 'alert alert-warning alert-styled-right',
                            type: 'error'
                        });
                    }
                    else
                        that.parent().parent().data("id", d);
                }

                that.parent().next().next().next().next().find(".savebtn").addClass("d-none");

            });
        });

        $("#addtr").on('click', function (e) {
            var that = $(".emptytr").clone().appendTo(".structuretable tbody").removeClass("d-none").removeClass("emptytr");
            that.find("SELECT").addClass("select").addClass("select-search").select2();
        });

        $("body").on('click', ".deletebtn", function (e) {
            var id = $(this).parent().parent().data("id");
            var that = $(this);

            $.ajax({
                type: "POST",
                url: "/ajax/deletestructure.php",
                data: ({"id": id}),
            }).done(function (d) {
                that.parent().parent().remove();
            });
        });






        $("body").on('keyup', ".quantity2", function (e) {
            var quantity = $(this).val();
            var factorid = $(this).parent().prev().prev().find("select").val();
            var id = $(this).parent().parent().data("id");
            var parentid = $("#parentid").val();

            var that = $(this);

            $(this).parent().next().next().find(".savebtn2").removeClass("d-none");

            $.ajax({
                type: "POST",
                url: "/ajax/saveexpansion.php",
                data: ({"id": id, "factorid": factorid, "quantity": quantity, "parentid": parentid}),
            }).done(function (d) {

                if (d)
                    that.parent().parent().data("id", d);

                that.parent().next().next().find(".savebtn2").addClass("d-none");

            });
        });

        $("body").on('change', ".factor2", function (e) {
            var factorid = $(this).val();
            var quantity = $(this).parent().next().next().find("input").val();
            var parentid = $("#parentid").val();
            var id = $(this).parent().parent().data("id");
            var type = $(this).find("option:selected").data("type");
            var unit = $(this).find("option:selected").data("unit");

            var that = $(this);

            $(this).parent().next().html(type);
            $(this).parent().next().next().next().html(unit);

            $(this).parent().next().next().next().next().find(".savebtn2").removeClass("d-none");

            $.ajax({
                type: "POST",
                url: "/ajax/saveexpansion.php",
                data: ({"id": id, "factorid": factorid, "quantity": quantity, "parentid": parentid}),
            }).done(function (d) {

                if (d)
                    that.parent().parent().data("id", d);

                that.parent().next().next().next().next().find(".savebtn2").addClass("d-none");

            });
        });

        $("#addtr2").on('click', function (e) {
            var that = $(".emptytr2").clone().appendTo(".expansiontable tbody").removeClass("d-none").removeClass("emptytr2");
            that.find("SELECT").addClass("select").addClass("select-search").select2();
        });

        $("body").on('click', ".deletebtn2", function (e) {
            var id = $(this).parent().parent().data("id");
            var that = $(this);

            $.ajax({
                type: "POST",
                url: "/ajax/deleteexpansion.php",
                data: ({"id": id}),
            }).done(function (d) {
                that.parent().parent().remove();
            });
        });



    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>