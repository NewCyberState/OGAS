<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Складские остатки");
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Складские остатки</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    В этом разделе отображаются складские остатки продукции вашего предприятия.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Складские остатки</h3>
                    <p class="mb-2">Система управления производством рассчитала для вашего предприятия следующие данные по остаткам вашей продукции на складе.  Если расчетные данные по каким-либо позициям номенклатуры отличаются от фактических остатков на складе - пожалуйста укажите фактические остатки продукции на складе.</p>

                    <table class="table table-bordered framed">
                        <thead>
                        <tr>
                            <th class="w-50">Название</th>
                            <th>Единица измерения</th>
                            <th>Остаток, план</th>
                            <th>Остаток, факт</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Lada Vesta</td>
                            <td>шт</td>
                            <td>18</td>
                            <td><input class="form-control" type="text" value="18"></td>
                        </tr>
                        <tr>
                            <td>Lada Granta</td>
                            <td>шт</td>
                            <td>23</td>
                            <td><input class="form-control" type="text" value="23"></td>
                        </tr>
                        <tr>
                            <td>Lada XRAY</td>
                            <td>шт</td>
                            <td>11</td>
                            <td><input class="form-control" type="text" value="11"></td>
                        </tr>
                        <tr>
                            <td>Lada Largus</td>
                            <td>шт</td>
                            <td>82</td>
                            <td><input class="form-control" type="text" value="82"></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>