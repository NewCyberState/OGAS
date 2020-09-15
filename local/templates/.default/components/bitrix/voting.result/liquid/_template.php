<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $delegatetable;
global $votedateend;
global $endvotes;
global $za;
global $protiv;

if ($arParams[STATUS_ID] >= 13)
    $votedateend = $arParams[STATUS_DATE];

function cmp($a, $b)
{
    if ($a[2] == $b[2]) {
        return 0;
    }
    return ($a[2] > $b[2]) ? -1 : 1;
}


function GetDelegates($user_id, $tags_list, $level)
{
    if ($level > 20) return;

    global $delegatetable, $votedateend, $endvotes;

    $hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    if ($votedateend)
        $datefilter = array("<UF_DATE" => $votedateend);

    $rsData = $entity_data_class::getList(array(
        "select" => array("UF_USER", "UF_DELEGATE", "UF_THEMATICS", "UF_ACTION", "MAXID"),
        "group" => array("UF_USER", "UF_DELEGATE", "UF_THEMATICS", "UF_ACTION"),
        'runtime' => array(
            new Entity\ExpressionField('MAXID', 'max(ID)')),
        "order" => array("MAXID" => "ASC"),
        "filter" => array("UF_DELEGATE" => $user_id, "UF_THEMATICS" => $tags_list, $datefilter)  // Задаем параметры фильтра выборки
    ));

    $tmpdelegatetable = array();

    while ($arData = $rsData->Fetch()) {

        if ($arData[UF_ACTION] == "delete") {
            $tmpkey = array_search(array($arData[UF_USER], $arData[UF_DELEGATE]), $tmpdelegatetable);
            if ($tmpkey !== false)
                unset($tmpdelegatetable[$tmpkey]);
        } else
            $tmpdelegatetable[] = array($arData[UF_USER], $arData[UF_DELEGATE]);
    }

    foreach ($tmpdelegatetable as $tmpdata) {

        $found=false;
        foreach ($delegatetable as $delegate) {
            if($tmpdata==array($delegate[0],$delegate[1])) {
                $found = true;
                break;
            }
            if($tmpdata==array($delegate[1],$delegate[0])) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            $flag = false;
            foreach ($endvotes as $endvote) {
                if ($endvote[0] == $tmpdata[0]) {
                    $flag = true;
                    break;
                }
            }

            $rsUser = CUser::GetByID($tmpdata[0]);
            if(!$rsUser->Fetch()) $flag = true;

            $rsUser = CUser::GetByID($tmpdata[1]);
            if(!$rsUser->Fetch()) $flag = true;


            if (!$flag) {
                $delegatetable[] = array($tmpdata[0], $tmpdata[1], $level);
                GetDelegates($tmpdata[0], $tags_list, $level + 1);
            }
        }
    }

}

if (!empty($arResult["ERROR_MESSAGE"])):
    ?>
    <div class="vote-note-box vote-note-error card-body">
        <div class="vote-note-box-text"><?= ShowError($arResult["ERROR_MESSAGE"]) ?></div>
    </div>
<?
endif;

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"])):
    return true;
endif;

foreach ($arParams[THEMATICS] as $tag) {
    $tags[] = $tag[ID];
}
//pr($arParams);

foreach ($arResult["QUESTIONS"] as $arQuestion) {

    foreach ($arQuestion["ANSWERS"] as $arAnswer) {

        $db_res = CVoteEvent::GetUserAnswerStat(array(), array("ANSWER_ID" => $arAnswer[ID], "VALID" => "Y", "bGetVoters" => "Y", "bGetMemoStat" => "N"));

        while ($db_res && ($res = $db_res->Fetch())) {
            $endvotes[] = array($res[AUTH_USER_ID], $arAnswer["MESSAGE"]);
        }
    }
}


foreach ($endvotes as $item) {
    GetDelegates($item[0], $tags, 1);
}

usort($delegatetable, "cmp");

//pr($delegatetable);

foreach ($endvotes as $vote):
    $delegatetable[] = array($vote[0], $vote[1], 0);
endforeach;

//pr($delegatetable);

foreach ($delegatetable as $row) {
    $w[$row[0]]++;
}


foreach ($delegatetable as $row) {
    $t[$row[2]][] = array($row[0], $row[1]);
}


foreach ($t as $key => $row) {
    foreach ($row as $k => $s) {
        //pr($s);
        //pr($w[$key][$s[0]]);
        $p[$s[0]][$s[1]] = 1 / $w[$s[0]];
    }

}

foreach ($p as $key => $row) {
    foreach ($row as $k => $s) {
        //pr($s);
        //pr($w[$key][$s[0]]);
        $r[$k] = $r[$k] + $s + $s * $r[$key];
    }

}

foreach ($t as $key => $row) {
    foreach ($row as $k => $s) {
        //pr($r[$s[0]]);
        $u[] = array($s[0], $s[1], ($r[$s[0]] + 1) / $w[$s[0]]);
    }
}

ksort($t);

foreach ($u as $key => $row) {
    if ($row[1] == "За")
        $za += $row[2];
    if ($row[1] == "Против")
        $protiv += $row[2];
}

/*
pr($delegatetable);
pr($w);
pr($w1);
pr($t);
pr($p);
pr($r);
pr($u);
pr($endvotes );*/
//pr($u);


foreach ($arResult["QUESTIONS"] as $arQuestion):
?>
<div class="card-body">

    <div class="vote-item-header">

        <?
        if ($arQuestion["IMAGE"] !== false):
            ?>
            <div class="vote-item-image"><img src="<?= $arQuestion["IMAGE"]["SRC"] ?>" width="30" height="30"/></div>
        <?
        endif;

        ?>
        <div class="">
            <div class="font-size-lg font-weight-semibold">
                <h5 class="<?= ($arParams["STATUS_ID"] >= "14" ? "text-success" : "text-danger") ?>">
                    Текст <?= ($arParams["STATUS_ID"] >= "14" ? "закона" : "законопроекта") ?><i
                            class="icon-file-text2  ml-2"></i></h5>

                <div class="font-size-lg font-weight-semibold border-1 border-danger p-2 rounded">
                <?= $arQuestion["QUESTION"] ?>
                </div></div>
        </div>
        <div class="vote-clear-float"></div>
    </div>

</div>

</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body bg-white">

                <h5 class="text-success">Результаты голосования<i class="icon-law ml-2"></i></h5>

                <p class="text-muted">Результаты голосования рассчитываются на основании данных о голосовании граждан на
                    референдуме и с учетом сведений о делегировании голосов. Делегирование своего голоса осуществляется
                    в разделе <a href="/personal/delegates/add/">Назначить делегатов</a>. Сведения о текущем
                    делегировании своего голоса можно увидеть в разделах <a href="/personal/delegates/">Мои делегаты</a>
                    и <a href="/personal/delegates/idelegate/">Я делегат</a>. Если вы хотите сами стать делегатом, вам необходимо указать свои компетенции и рассказать о своем жизненном опыте в разделе <a href="/personal/">Мои данные</a>. </p>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                <div id="sankey_multiple"
                     style="width: 100%; height: <?= count($delegatetable) * 20 + count($endvotes) * 50; ?>px;"></div>

                <script type="text/javascript">
                    google.charts.load("current", {packages: ["sankey"]});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Гражданин');
                        data.addColumn('string', 'Гражданин');
                        data.addColumn('number', 'Вес');
                        data.addRows([
                            <?foreach ($u as $row):?>
                            <?
                            if (intval($row[0])) {
                                $rsUser = CUser::GetByID($row[0]);
                                $arUser = $rsUser->Fetch();
                                $from = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
                            } else
                                $from = $row[0];

                            if (intval($row[1])) {
                                $rsUser = CUser::GetByID($row[1]);
                                $arUser = $rsUser->Fetch();
                                $to = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
                            } elseif ($row[1] == "За") {
                                $to = $row[1] . " (" . $za . ")";
                            } elseif ($row[1] == "Против") {
                                $to = $row[1] . " (" . $protiv . ")";
                            }

                            ?>
                            ['<?=$from?>', '<?=$to?>', <?=$row[2]?> ],
                            <?endforeach;?>
                        ]);
                        var colors = ['#a6cee3', '#b2df8a', '#fb9a99', '#fdbf6f',
                            '#cab2d6', '#ffff99', '#1f78b4', '#33a02c'];

                        // Set chart options
                        var options = {
                            /*width: 100%,*/

                            sankey: {
                                node: {
                                    //colors: colors,
                                    nodePadding: 60,
                                },
                                link: {
                                    colorMode: 'gradient',
                                    //colors: colors
                                },
                                iterations:200
                            }

                        };

                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.Sankey(document.getElementById('sankey_multiple'));
                        chart.draw(data, options);
                    }
                </script>

            </div>

            <?
            endforeach;

            ?>
        </div>