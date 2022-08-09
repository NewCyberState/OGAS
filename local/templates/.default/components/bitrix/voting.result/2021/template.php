<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

global $delegatetable,$endvotes,$za,$protiv;

//pr($arParams);

$votingdata=\Ogas\Democracy\LiquidVoting::GetVotingData2021($arParams[ELEMENT_ID]);

$endvotes=\Ogas\Democracy\LiquidVoting::GetEndVotes2021($arParams[ELEMENT_ID]);

$delegatetable=$votingdata;

foreach ($endvotes as $key => $row) {
    if ($row[1] == "За")
        $endza += 1;
    if ($row[1] == "Против")
        $endprotiv += 1;
}

foreach ($votingdata as $key => $row) {
    if ($row[1] == "За")
        $za += $row[2];
    if ($row[1] == "Против")
        $protiv += $row[2];
}
$element=GetElement($arParams[ELEMENT_ID]);

$group = CSocNetGroup::GetByID($element["PROPERTIES"]["GROUP_ID"]["VALUE"]);

if($element["PROPERTIES"]["MEMBERS"]["VALUE"]>0)
    $group_members=$element["PROPERTIES"]["MEMBERS"]["VALUE"];
else
    $group_members=$group[NUMBER_OF_MEMBERS];

$status_id = $element["PROPERTIES"]["STATUS"]["VALUE"];

$arStatus = GetHLElement(4, $status_id);


$responsible = CUSER::GetByID($element["PROPERTIES"][RESPONSIBLE][VALUE]);
$responsible = $responsible->Fetch();

//pr($endvotes);
?>

<p class="text-muted">Результаты голосования рассчитываются на основании данных о голосовании граждан на
    референдуме и с учетом сведений о делегировании голосов. Делегирование своего голоса осуществляется
    в разделе <a href="/personal/delegates/add/">Назначить делегатов</a>. Сведения о текущем
    делегировании своего голоса можно увидеть в разделах <a href="/personal/delegates/">Мои делегаты</a>
    и <a href="/personal/delegates/idelegate/">Я делегат</a>. Если вы хотите сами стать делегатом, вам необходимо указать свои компетенции и рассказать о своем жизненном опыте в разделе <a href="/personal/">Мои данные</a>. </p>

<table class="table table-striped table-bordered mb-3">
    <tr>
        <td>
            Название
        </td>
        <td>
            <?=$element[NAME]?>
        </td>
    </tr>
    <tr>
        <td>
            Тип большинства <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$element["PROPERTIES"]["MAJORITY_TYPE"]["HINT"]?>' ></i>
        </td>
        <td>
            <?=$element["PROPERTIES"]["MAJORITY_TYPE"]["VALUE"]?>
        </td>
    </tr>
    <tr>
        <td>
            Тип голосования <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$element["VOTING_TYPE"]["HINT"]?>' ></i>
        </td>
        <td>
            <?=$element["PROPERTIES"]["VOTING_TYPE"]["VALUE"]?>
        </td>
    </tr>
    <tr>
        <td>
            Группа
        </td>
        <td>
            <?=$group[NAME]?>
        </td>
    </tr>
    <tr>
        <td>
            Количество участников группы
        </td>
        <td>
            <?=$group_members?>
        </td>
    </tr>
    <tr>
        <td>
            Голосов "За"
        </td>
        <td>
            <?=floatval($endza)?>
        </td>
    </tr>
    <tr>
        <td>
            Голосов "Против"
        </td>
        <td>
            <?=floatval($endprotiv)?>
        </td>
    </tr>
    <tr>
        <td>
            Голосов "За" с учетом делегирования
        </td>
        <td>
            <?=floatval($za)?>
        </td>
    </tr>
    <tr>
        <td>
            Голосов "Против" с учетом делегирования
        </td>
        <td>
            <?=floatval($protiv)?>
        </td>
    </tr>
    <tr>
        <td>
            Статус
        </td>
        <td>
            <?=$arStatus["UF_NAME"]?>
        </td>
    </tr>

    <?if($responsible):?>
    <tr>
        <td>
            Ответственный за исполнение <i class="icon-question text-default icon-question4 icon-1x p-1 cursor-pointer"  data-popup="popover" title="" data-trigger="hover" data-placement="top" data-content='<?=$element["PROPERTIES"]["RESPONSIBLE"]["HINT"]?>' ></i>
        </td>
        <td>
            <?=$responsible["NAME"]." ".$responsible["LAST_NAME"];?>
        </td>
    </tr>
    <?endif;?>
</table>
<?
if($element["PROPERTIES"]["VOTING_TYPE"][VALUE_XML_ID]==1)
foreach ($arResult["QUESTIONS"] as $arQuestion):
?>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                <div id="sankey_multiple"
                     style="width: 100%; height: <?= ($za+$protiv) * 75; ?>px; display: inline-block;position: relative"></div>

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
                                    nodePadding: 50,
                                },
                                link: {
                                    colorMode: 'gradient',
                                    //colors: colors
                                },
                                iterations:300
                            }

                        };

                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.Sankey(document.getElementById('sankey_multiple'));
                        chart.draw(data, options);
                    }

                    $("#resultpage").click(function (e) {
                        setTimeout(drawChart, 200);
                    })

                </script>

            <?
            endforeach;
            ?>
