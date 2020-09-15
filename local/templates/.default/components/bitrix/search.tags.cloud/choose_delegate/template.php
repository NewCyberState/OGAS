<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

?>

<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Назначить делегатов
    </h6>
    <span class="text-muted d-block">Список граждан, которым вы можете делегировать свой голос. По каждой теме вы можете выбрать одного или нескольких делегатов. Ваш голос на любом референдуме по указанной теме перейдет к выбранным вами делегатам и увеличит вес их голоса на единицу. Допустимо делегировать свой голос разным делегатам по одной и той же теме, а также одному и тому же делегату по разным темам. Если голос делегирован нескольким делегатам - он будет пропорционально разделен между ними и увеличит вес их голоса соответственно. Если делегат не входит в группу, в которой создан референдум - он не сможет голосовать на этом референдуме. Если по какой-либо теме вы не делегировали голос - вам необходимо голосовать самостоятельно. Если вы не выбрали делегата и не участвовали в голосовании - ваш голос не будет учтен.</span>
</div>
<div class="row">

    <div class="col-md-12">
        <div class="card">
    <div class="card-body">
        <div class="d-md-flex">

    <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
    <!-- data -->
    <? foreach ($arResult["SEARCH"] as $key => $res): ?>

        <li class="nav-item <?=($key==0?"active":"")?>"><a href="#vertical-left-tab<?=$key?>" class="nav-link <?=($key==0?"active show":"")?>" data-toggle="tab"><?=$res[NAME]?></a></li>

    <? endforeach; ?>

    </ul>
    <div class="tab-content  col-lg-9">
        <? foreach ($arResult["SEARCH"] as $key => $res): ?>

        <div class="tab-pane fade <?=($key==0?"show active":"")?>" id="vertical-left-tab<?=$key?>">
            <div class="row">

            <?
            $alreadyDelegate=array();

            $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
            $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            // Массив полей для добавления
            $data = array(
                "UF_TAG"=>$res[NAME],
                "UF_USER"=>$USER->GetID(),
            );
            $result = $entity_data_class::getList(array(
                "select" => array("*"),
                "order" => array("ID" => "ASC"),
                "filter" => $data
            ));

            while($arData = $result->Fetch()) {
                $alreadyDelegate[]=$arData["UF_DELEGATE"];
            }




            $data = array(
                "UF_TAG"=>$res[NAME],
                "UF_DELEGATE"=>$USER->GetID(),
            );
            $result = $entity_data_class::getList(array(
                "select" => array("*"),
                "order" => array("ID" => "ASC"),
                "filter" => $data
            ));

            while($arData = $result->Fetch()) {
                $alreadyDelegate[]=$arData["UF_USER"];
            }


            $data = CUser::GetList(($by="ID"), ($order="ASC"),
            array(
            'UF_TAG' => $res[NAME],
            'ACTIVE' => 'Y'
            ),
                array("SELECT"=>array("ID","UF_*"))
            );
            ?>

            <?while($arUser = $data->Fetch()) { if($arUser[ID]==$USER->GetID() || in_array($arUser[ID],$alreadyDelegate)) continue;?>

                <div class="col-lg-6">
                    <div class="card card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#">
                                    <img src="<?=CFile::GetPath($arUser["PERSONAL_PHOTO"])?>" class="rounded-circle" alt="" width="42" height="42">
                                </a>
                            </div>

                            <div class="media-body">
                                <h6 class="mb-0"><?=$arUser[NAME]." ".$arUser[LAST_NAME]?></h6>
                                <span class="text-muted"><?=$res[NAME]?></span>
                            </div>

                            <a href="javascript:" onclick="delegate(<?=$USER->GetID()?>,<?=$arUser[ID]?>,'<?=$res[NAME]?>',$(this))" class="btn bg-primary mt-1">Назначить делегата</a>
                        </div>
                    </div>
                </div>

            <?}
            ?>
        </div>
        </div>
        <? endforeach; ?>
    </div>
</div>
    </div>
    </div>
    </div>
</div>