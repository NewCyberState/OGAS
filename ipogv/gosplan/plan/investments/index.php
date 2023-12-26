<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Планирование инвестиций");

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

if($_REQUEST[today])
    $today=$_REQUEST[today];
else
    $today="01.01.2022";


?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Планирование инвестиций в расширение производственных мощностей</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>В этом разделе можно спланировать расширение производственных мощностей на всех
                        предприятиях страны.</p>
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

                        $mob->FillCapacity();
                        $mob->FillNetProduct($date);
                        //$mob->SaveNetProduct($date);
                        $mob->PrintNetProduct($date);
                        //$mob->PrintCapacity($date);
                        //$mob->PrintMOB();
                        $mob->CalculateMOB($date);
                        //$mob->SaveGrossProduct($date);
                        //$mob->FillWorkingTime($date);
                        $mob->PrintGrossProduct($date,false);

                        while ($mob->OverCapacity()) { //Если плановый объем выпуска на дату планирования превышает производственные мощности
                            $mob->Recalculate($date);
                            while ($mob->OverCapacity()) {
                                $mob->PrintCapacity($date);
                                $mob->CalculateLackOfCapacity();//Вычислить недостаток производственных мощностей
                                $mob->PrintLack($date);

                                $mob->Recalculate($today);
                                $mob->PrintNetProduct($today);

                                $duration=$mob->PlanNewCapitalFunds($today); //Заложить в план такое расширение капитальных фондов, которое позволяют текущие производственные мощности
                                $mob->PrintAdded($today);
                                //$mob->PrintGrossProduct();
                            }
                            //$mob->PrintNetProduct($today);

                            $s="+".$duration." day";

                            $today = date('d.m.Y',strtotime($s,strtotime($today))); //После расширения производственных мощностей сдвигаем дату вперед на длительность расширения производственных мощностей

                            $mob->ExtendCapacity(); //Расширить производственные мощности
                            $mob->PrintCapacity($today);

                            $mob->Recalculate($today);
                            $mob->PrintNetProduct($today);
                            $mob->PrintGrossProduct($today,false);
                        }

                        $mob->Recalculate($date);
                        $mob->PrintNetProduct($date);
                        $mob->PrintGrossProduct($date,false);
                    }
                    else
                    {
                    ?>

                    <div class="col-lg-12 p-0 mt-1">
                        <form action="" type="get">
                            <h4>Текущая дата</h4>
                            <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                <input type="text" class="form-control daterange-single" id="today" name="today" value="<?=$today?>">
                            </div>

                        <h4 class="mt-2">Дата планирования</h4>
                        Дата, на которую осуществляется расчет плана
                        <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                            <input type="text" class="form-control daterange-single" id="date" name="date" value="<?=$date?>">
                        </div>

                        <h4 class="mt-3">Планирование расширения производственных мощностей</h4>
                            <p>При нажатии этой кнопки будет произведен автоматический расчет плана расширения производственных мощностей. Будет сформирован поэтапный план расширения производственных мощностей на всех предприятиях страны чтобы на указанную дату производственные мощности полностью покрывали весь прогнозируемый спрос по всем видам номенклатуры продукции.
                                </p>

                            <button class="btn btn-primary btn-lg mt-2" type="submit" name="submit" value="Y"><i class="icon-grid52 mr-2"></i>Спланировать расширение производственных мощностей</button>
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