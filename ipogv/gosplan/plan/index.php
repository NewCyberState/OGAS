<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Планирование производства");
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("/local/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/form_select2.js");


Asset::getInstance()->addJs("/local/global_assets/js/plugins/ui/moment/moment.min.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/daterangepicker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/anytime.min.js");

Asset::getInstance()->addJs("/local/global_assets/js/demo_pages/picker_date.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.js");
Asset::getInstance()->addJs("/local/global_assets/js/plugins/pickers/pickadate/picker.date.js");


?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Планирование производства</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    Результаты расчета конечного и валового продукта с учетом планового спроса на продукцию, остатков на складах, произведенные на основании матрицы межотраслевого баланса.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Планирование производства</h3>

                    <?/*?>
                    <div class="row">
                    <div class="col-lg-6 mb-4">
                    <label>Выберите отрасль</label>
                    <select class="form-control select" data-fouc>
                        <optgroup label="Автомобильная промышленность">
                            <option value="AZ">Легковые автомобили</option>
                            <option value="CO">Грузовые автомобили</option>
                        </optgroup>
                        <optgroup label="Обрабатывающая промышленность">
                            <option value="AZ">Чёрная металлургия</option>
                            <option value="CO">Цветная металлургия</option>
                            <option value="ID">Химическая и нефтехимическая промышленность</option>
                            <option value="WY">Лесная, деревообрабатывающая и целлюлозно-бумажная промышленность</option>
                            <option value="WY">Промышленность строительных материалов</option>
                            <option value="WY">Стекольная и фарфоро-фаянсовая промышленность</option>
                            <option value="WY">Лёгкая промышленность</option>
                            <option value="WY">Пищевая промышленность</option>
                            <option value="WY">Микробиологическая промышленность</option>
                        </optgroup>
                        <optgroup label="Добывающая промышленность">
                            <option value="AL">Нефтяная промышленность</option>
                            <option value="AR">Газовая промышленность</option>
                            <option value="KS">Угольная промышленность</option>
                            <option value="KY">Торфяная промышленность</option>
                        </optgroup>
                    </select>
                    </div>

                    <div class="col-lg-6 mb-4">
                    <label>Выберите дату</label>
                    <div class="input-group">

										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                        <input type="text" class="form-control daterange-single" value="01.01.2021">
                    </div>
                    </div>
                    </div>
<?*/?>

                    <?
                    $gosplan=new OGAS\Economy\Gosplan();
                    $companylist=$gosplan->GetCompanyList();

                    //$sales = new \OGAS\Economy\Company();
                    //$products=$sales->GetSaleProducts();

                    foreach ($companylist as $k => $company):

                        $products=$gosplan->GetSaleProductList($k);
                        if(!$products)
                            continue;
                        echo "<h4>".$company."</h4>";
                    ?>

                    <table class="table table-bordered framed mb-3">
                        <thead>
                        <tr>
                            <th class="w-50">Название</th>
                            <th>Конечный продукт, план</th>
                            <th>Единица измерения</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach ($products as $key=>$product):

                            $plan= new \OGAS\Economy\Plan($key);
                            $planondate=$plan->Planning("01.01.2023");
                            ?>
                        <tr>
                            <td><a href="edit/?ID=<?=$key?>"><?=$product[0]?></a></td>
                            <td><?=$planondate?></td>
                            <td><?=$product[1]?></td>
                        </tr>
                        <?endforeach;?>

                        </tbody>
                    </table>

                    <?endforeach;?>


                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>