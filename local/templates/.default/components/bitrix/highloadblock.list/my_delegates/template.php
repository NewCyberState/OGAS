<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');
?>

<div class="mb-3">
    <span class="text-muted d-block">Список граждан, которым вы делегировали свой голос. Ваш голос на любом референдуме по указанной теме перейдет к выбранным вами делегатам и увеличит вес их голоса на единицу. Допустимо делегировать свой голос разным делегатам по одной и той же теме, а также одному и тому же делегату по разным темам. Если голос делегирован нескольким делегатам - он будет пропорционально разделен между ними и увеличит вес их голоса соответственно. Если делегат не входит в группу, в которой создан референдум - он не сможет голосовать на этом референдуме. Если по какой-либо теме вы не делегировали голос - вам необходимо голосовать самостоятельно. Если вы не выбрали делегата и не участвовали в голосовании - ваш голос не будет учтен.</span>
</div>
<div class="row">
	<!-- data -->
    <?if($arResult['rows']):?>
	<? foreach ($arResult['rows'] as $row): ?>

    <?
        $rsUser = CUser::GetByID($row["UF_DELEGATE"]);
        $arUser = $rsUser->Fetch();

        ?>
    <div class="col-md-12 col-xl-6">
        <div class="card card-body">
            <div class="media align-items-center align-items-lg-start flex-column flex-lg-row">
                <div class="mr-0 mr-lg-3">
                    <a href="/user/<?=$arUser[ID]?>/">
                        <img src="<?=CFile::GetPath($arUser["PERSONAL_PHOTO"])?>" class="rounded-circle" alt="" width="42" height="42">
                    </a>
                </div>

                <div class="media-body  text-center text-lg-left">
                    <a href="/user/<?=$arUser[ID]?>/"><h6 class="mb-0"><?=$arUser[NAME]." ".$arUser[LAST_NAME]?></h6></a>
                    <span class="text-muted"><?$section=GetSection($row["UF_THEMATICS"]);echo $section[NAME];?></span>
                </div>

                <a href="javascript:" onclick="undelegate(<?=$USER->GetID()?>,<?=$arUser[ID]?>,'<?=$row["UF_THEMATICS"]?>',$(this))" class="btn bg-light  mt-1  ml-md-3 mt-md-1">Освободить делегата</a>
            </div>
        </div>




    </div>
	<? endforeach; ?>
    <?else:?>
    <div class="col-lg-12">
        <div class="card card-body">
            Не выбран ни один делегат
        </div>
    </div>

    <?endif;?>
</div>