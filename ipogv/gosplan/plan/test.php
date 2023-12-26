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

use NumPHP\LinAlg\LinAlg;

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
                    <?
                    /*$plan = new \Ogas\Economy\Plan($_REQUEST[ID]);
                    echo $plan->Planning("01.01.2023");*/
/*

                    $matrix =
	                    [
		                    [   1, 0,-],
		                    [-0.1, 1,0],
		                    [-0.1,-1,1],
	                    ];

                    $kp = [100,100,100];


                    $det = LinAlg::det($matrix);

                    pr($det);

                    $val = LinAlg::solve($matrix,$kp);

                    pr($val);

*/
                    $date="01.01.2028";

                    $mob = new \Ogas\Economy\MOB(0.01);

                    $mob->FillNetProduct($date);

                    $mob->PrintMOB();

                    pr($mob->Convergence());

/*
                    foreach ($mob->matrix as $key => $val)
	                    $mob->matrix[$key]=array_values($mob->matrix[$key]);

                    $mob->matrix=array_values($mob->matrix);

                    foreach ($mob->netproduct as $key => $val)
	                    $tnp[]=$mob->netproduct[$key];


                    pr($tnp);


                    $det = LinAlg::det($mob->matrix);
                    pr( $det);*/

                    /*$mob->FillNetProduct($date);
                    //$mob->SaveNetProduct($date);
                    $mob->PrintNetProduct($date);
                    $mob->PrintMOB();
                    //$mob->CalculateMOB($date);
                    //$mob->PrintGrossProduct($date);
*/
                  /*  pr($mob->netproduct);
                    $val = LinAlg::solve($mob->matrix,$tnp);

                    pr($val);*/


                    ?>


                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>