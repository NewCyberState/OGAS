<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Межотраслевой баланс");

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

if($_REQUEST[date])
    $date=$_REQUEST[date];
else
    $date="01.01.2023";



?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Межотраслевой баланс</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>
                    Межотраслевой баланс (МОБ, модель «затраты — выпуск», метод «затраты — выпуск») — сердце плановой
                    экономики, экономико-математическая балансовая модель, определяющая межотраслевые производственные
                    взаимосвязи в экономике страны. Характеризует связи между выпуском продукции в одной отрасли и
                    затратами, расходованием продукции всех участвующих отраслей, необходимым для обеспечения этого
                    выпуска. Межотраслевой баланс представлен в виде системы линейных уравнений. Представляет собой
                    таблицу, в которой отображена структура затрат на производство каждого продукта.</p>

                    <p>Позволяет осуществить расчет плана производства валового продукта для всех предприятий страны для обеспечения требуемого объема выпуска продукции конечного потребления. Использует специальный рекурсивный алгоритм, который позволяет значительно уменьшить количество вычислений по сравнению с более ресурсоемкими методами решения системы линейных уравнений, такими как метод Жордана-Гаусса.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <?if ($_REQUEST["submit"]=="Y")
                    {
                    $mob = new \Ogas\Economy\MOB(0.01);

                    $mob->FillNetProduct($date);
                    $mob->SaveNetProduct($date);
                    $mob->PrintNetProduct();
                    $mob->PrintMOB();
                    $mob->CalculateMOB($date);
                    $mob->SaveGrossProduct($date);
                    $mob->FillWorkingTime($date);
                    $mob->PrintGrossProduct();
                    }
                    else
                    {
                    ?>

                    <h4>Дата расчета</h4>
                    Дата, на которую рассчитывается межотраслевой баланс
                    <div class="col-lg-12 p-0 mt-1">
                        <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                            <form action="">
                            <input type="text" class="form-control daterange-single" id="date" name="date" value="<?=$date?>">
                            </form>
                        </div>

                        <h4 class="mt-3">Расчет межотраслевого баланса</h4>
                        При нажатии этой кнопки будет произведен полный пересчет межотраслевого баланса для всей экономики страны на указанную дату. Сначала будет произведено автоматическое прогнозирование потребления конечного продукта на указанную дату, после чего будет сформирована матрица межотраслевого баланса на основании структуры производства всех товаров и услуг в экономике страны. На следующем этапе будет произведено вычисление межотраслевого баланса и расчет плана производства валового продукта по всем видам номенклатуры продукции всех предприятий страны для обеспечения выпуска конечного продукта в необходимом количестве. Будут сформированы производственные планы для всех предприятий страны по всем видам номенклатуры производимой продукции.
                        <form action="" type="post">
                            <button class="btn btn-primary btn-lg mt-2" type="submit" name="submit" value="Y"><i class="icon-grid52 mr-2"></i>Спланировать производство на всех предприятиях страны</button>
                        </form>
                    </div>
                    <?}?>
                </div>
            </div>

            <style>
                .m {
                    width: 30px;
                    height: 30px;
                    text-align: center;
                }

                .t {
                    margin: 20px 0;
                }

                .grey {
                    text-align: center;
                    background-color: #eee;
                }

                .table td, .table th {
                    padding: 5px;
                }

                .table {
                    width: auto;
                }
            </style>


        </div>
    </div>

    <script>
        $('#date').on('apply.daterangepicker', function(ev, picker) {
            this.form.submit();
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>