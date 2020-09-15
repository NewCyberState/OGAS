<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

global $delegatetable,$endvotes,$za,$protiv;

$votingdata=\Ogas\Democracy\LiquidVoting::GetVotingData($arParams[PETITION_ID]);

$endvotes=\Ogas\Democracy\LiquidVoting::GetEndVotes($arParams[PETITION_ID]);

$delegatetable=$votingdata;

foreach ($votingdata as $key => $row) {
    if ($row[1] == "За")
        $za += $row[2];
    if ($row[1] == "Против")
        $protiv += $row[2];
}

//pr($votingdata);


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
                            <?foreach ($votingdata as $row):?>
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