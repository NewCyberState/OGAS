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
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/local/assets/js/app.js");


?>


<div class="mb-3">
    <span class="text-muted d-block">Список граждан, которым вы можете делегировать свой голос. По каждой теме вы можете выбрать одного или нескольких делегатов. Ваш голос на любом референдуме по указанной теме перейдет к выбранным вами делегатам и увеличит вес их голоса на единицу. Допустимо делегировать свой голос разным делегатам по одной и той же теме, а также одному и тому же делегату по разным темам. Если голос делегирован нескольким делегатам - он будет пропорционально разделен между ними и увеличит вес их голоса соответственно. Если делегат не входит в группу, в которой создан референдум - он не сможет голосовать на этом референдуме. Если по какой-либо теме вы не делегировали голос - вам необходимо голосовать самостоятельно. Если вы не выбрали делегата и не участвовали в голосовании - ваш голос не будет учтен.</span>
</div>
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex">

                    <ul class="nav nav-tabs nav-tabs-vertical flex-column  wmin-md-200 mb-md-0 border-bottom-0 col-sm-12 col-md-3 col-xl-3">
                        <!-- data -->
                        <? foreach ($arResult['SECTIONS'] as $key=>&$arSection):
                        ?>

                            <li class="nav-item <?=($key==0?"active":"")?>"><a href="#vertical-left-tab<?=$key?>" class="nav-link <?=($key==0?"active show":"")?>" data-toggle="tab"><?=$arSection[NAME]?></a></li>

                        <? endforeach; ?>

                    </ul>
                    <div class="tab-content col-sm-12 col-md">
                        <? foreach ($arResult['SECTIONS'] as $key=>&$arSection): ?>

                            <div class="tab-pane fade <?=($key==0?"show active":"")?>" id="vertical-left-tab<?=$key?>">
                                <div class="row">

                                    <?
                                    $alreadyDelegate=array();
                                    $iamDelegate=array();

                                    $hlbl = 3; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
                                    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

                                    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                                    $entity_data_class = $entity->getDataClass();

                                    // Массив полей для добавления
                                    $data = array(
                                        "UF_THEMATICS"=>$arSection[ID],
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
                                        "UF_THEMATICS"=>$arSection[ID],
                                        "UF_DELEGATE"=>$USER->GetID(),
                                    );
                                    $result = $entity_data_class::getList(array(
                                        "select" => array("*"),
                                        "order" => array("ID" => "ASC"),
                                        "filter" => $data
                                    ));

                                    while($arData = $result->Fetch()) {
                                        $iamDelegate[]=$arData["UF_USER"];
                                    }


                                    $data = CUser::GetList(($by="ID"), ($order="ASC"),
                                        array(
                                            'UF_THEMATICS' => $arSection[ID],
                                            'ACTIVE' => 'Y'
                                        ),
                                        array("SELECT"=>array("ID","UF_*"))
                                    );
                                    ?>

                                    <?while($arUser = $data->Fetch()) { if($arUser[ID]==$USER->GetID() || in_array($arUser[ID],$iamDelegate)) continue;?>

                                        <div class="col-md-12 col-xl-6">
                                            <div class="card card-body">
                                                <div class="media align-items-center flex-column">
                                                    <div class="text-center">
                                                        <a data-popup="popover" data-trigger="hover" data-placement="top" data-content="<?=$arUser[PERSONAL_NOTES]?>"  href="/user/<?=$arUser[ID]?>/">
                                                            <img src="<?=CFile::GetPath($arUser["PERSONAL_PHOTO"])?>" class="rounded-circle" alt="" width="42" height="42">
                                                        <h6 class="mb-0"><?=$arUser[NAME]." ".$arUser[LAST_NAME]?></h6></a>
                                                        <span class="text-muted"><?=$arSection[NAME]?></span>
                                                    </div>

                                                    <?if(in_array($arUser[ID],$alreadyDelegate)):?>
                                                    <a href="javascript:" onclick="undelegate(<?=$USER->GetID()?>,<?=$arUser[ID]?>,<?=$arSection[ID]?>,$(this))" class="btn bg-light mt-1">Освободить делегата</a>
                                                    <?else:?>
                                                                    <a href="javascript:" onclick="delegate(<?=$USER->GetID()?>,<?=$arUser[ID]?>,<?=$arSection[ID]?>,$(this))" class="btn bg-primary mt-1">Назначить делегата</a>
                                                    <?endif;?>
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