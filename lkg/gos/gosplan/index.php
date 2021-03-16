<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Межотраслевой баланс");
global $USER;
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Межотраслевой баланс</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    <p>Межотраслевой баланс (МОБ, модель «затраты — выпуск», метод «затраты — выпуск») — сердце плановой экономики, экономико-математическая балансовая модель, определяющая межотраслевые производственные взаимосвязи в экономике страны. Характеризует связи между выпуском продукции в одной отрасли и затратами, расходованием продукции всех участвующих отраслей, необходимым для обеспечения этого выпуска. Межотраслевой баланс представлен в виде системы линейных уравнений. Представляет собой таблицу, в которой отображена структура затрат на производство каждого продукта. </p>
                </div>
            </div>
        </div>
    </div>


    <div class="card mb-0">

    <div class="card-body border-bottom">


<?
$final=array();
$final2=array();
$matrix=array();
$oper=0;
$oper2=0;
$stop=false;
$tochnost=0.01;


$razmer=30;

for($i=0;$i<$razmer;$i++){
    for($j=0;$j<$razmer;$j++){
        if($i==$j){
            $matrix[$i][$j]=1;
        }
        elseif($matrix[$j][$i]>0)
            $matrix[$i][$j]=0;
        else{
            if(rand(1,$razmer)<=$razmer*0.98)
                $matrix[$i][$j]=0;
            else
                $matrix[$i][$j]=rand(1,200)/100;
        }
    }
}

for($i=0;$i<$razmer;$i++)
    $b[$i]=100;


/*


$razmer=2;

$matrix[0] = array(1,0.1);
$matrix[1] = array(3,1);

$b=array(200000,50000);
*/

/*$matrix[0] = array(1,0.05,0,0);
$matrix[1] = array(0,1,2,0);
$matrix[2] = array(0,0,1,0.1);
$matrix[3] = array(0.3,0,0,1);  */


$n = count($matrix);


echo "Расчет плана производства для всех предприятий страны для обеспечения требуемого объема потребления конечного продукта по каждому виду продукции. Использует специальный рекурсивный алгоритм, который позволяет значительно уменьшить количество вычислений по сравнению с более ресурсоемкими методами решения системы линейных уравнений, такими как метод Жордана-Гаусса.<br><br>";

echo "Матрица производства продукции:<br>";

prm2($matrix);

echo "<br>Примечание: на пересечении строк и столбцов находятся коэффициенты использования комплектующих для производства продукции.<br> Например, если для производства единицы продукта №1 требуется 0.05 единиц продукта №2, то в ячейке [1,2] стоит число 0.05.<br><br>";

echo "Для получения чистого продукта для конечного потребления в объеме:<br>";

prm($b);

$starttime=time();

foreach($b as $t=>$q)
{
    gosplan($t,$q);
}

ksort($final);

if($stop)
    echo "<br>Несовместная матрица<br><br>";
else{
    echo "Потребуется произвести продукции (план по валу): <br>";
    prm($final);
    echo "<br>";
    //pr($final);
}

echo "Относительная погрешность вычислений: <b>".strval($tochnost*100)."%</b><br><br>";

$endtime=time();
echo "Количество произведенных операций с плавающей точкой: <b>".$oper."</b>";
echo "<br>Количество секунд, затраченных на вычисление плана: ".strval($endtime-$starttime);


?>
    </div>
    </div>
<?

function gosplan($t,$q)
{
    global $matrix;
    global $final;
    global $oper;
    global $n;
    global $stop;
    global $b;
    global $tochnost;
    global $razmer;

    if($stop) return;

    if($oper>=pow($razmer,4))
    {
        echo "<br>Перегрузка, слишком много операций. Возможно матрица несовместна<br>";
        exit;
    }

    for($i = 0; $i < $n; $i++)
    {
        if($matrix[$t][$i]>0)
        {
            $coeff=$matrix[$t][$i]*floor($q);
            $oper++;
        }
        else
            continue;

        if($i==$t && $coeff>=$final[$i]*$tochnost)
        {
            $final[$t]+=$coeff;
            $oper++;
        }

        if($matrix[$t][$i]*$matrix[$i][$t]>1 && $i<>$t)
        {
            echo "<br>Решение не может быть найдено! Несовместная матрица!<br>";
            pr($coeff);
            pr($final);
            pr($i);
            pr($t);
            exit;
        }



        if($i<>$t && $coeff>=$final[$i]*$tochnost)
        {
            gosplan($i,$coeff);
        }
        elseif($i<>$t && $coeff<$final[$i]*$tochnost)
        {
            $final[$i]+=$coeff;
            $oper++;
        }

    }
    return;
}



function prm($m)
{
    $n = count($m);
    echo "<div class='datatable-scroll overflow-auto  mt-2 mb-2'><table border=1 cellpadding=5 class='table table-bordered table-striped table-hover table-scrollable table-condensed datatable-highlight dataTable table-bordered'>";
    echo "<tr>";
    for ($i=0;$i<$n;$i++)
    {
        echo "<td class='grey'>".strval($i+1)."</td>";
    }
    echo "</tr>";
    echo "<tr>";
    for ($i=0;$i<$n;$i++)
    {
        echo "<td class=m>";
        echo "<b>".$m[$i]."</b>";
        echo "</td>";

    }
    echo "</tr>";
    echo "</table></div>";
}
function prm2($m)
{
    $n = count($m);
    echo "<div class='datatable-scroll overflow-auto  mt-2 mb-2'><table border=1 cellpadding=5 class='table table-bordered table-striped table-hover table-scrollable table-condensed datatable-highlight dataTable table-bordered'>";
    echo "<tr><td class='grey'></td>";
    for ($i=0;$i<$n;$i++)
    {
        echo "<td class='m grey'>".strval($i+1)."</td>";
    }
    echo "</tr>";
    for ($i=0;$i<$n;$i++)
    {
        echo "<tr>";
        echo "<td class='grey'>Продукт ".strval($i+1)."</td>";
        for($j=0;$j<$n;$j++)
        {
            echo "<td class=m>";
            echo "<b>".$m[$i][$j]."</b>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table></div>";
}

?>
    <style>
        .m
        {
            width:30px;
            height:30px;
            text-align:center;
        }
        .t
        {
            margin:20px 0;
        }

        .grey
        {
            text-align:center;
            background-color:#eee;
        }

        .table td, .table th
        {
            padding:5px;
        }

        .table
        {
            width: auto;
        }
    </style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>