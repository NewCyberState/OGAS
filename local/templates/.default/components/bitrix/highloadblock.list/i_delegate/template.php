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
    <span class="text-muted d-block">Список граждан, которые делегировали вам свой голос. Их голос на любом референдуме по указанной теме перейдет к вам и увеличит вес вашего голоса на единицу. Если вы не будете принимать участие в голосованиях, то ни ваш голос, ни голоса граждан, которые передали вам свой голос - учтены не будут. Если вы хотите иметь возможность стать делегатом, вам необходимо добавить свои компетенции в блоке "Компетенции" в разделе <a href="/personal/">Мои данные</a>, указать в каких областях вы считаете себя экспертом и готовы распоряжаться голосами других граждан.</span>
</div>
<div class="row">
	<!-- data -->
    <?if($arResult['rows']):?>
	<? foreach ($arResult['rows'] as $row): ?>

    <?


        $rsUser = CUser::GetByID($row["UF_USER"]);
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


            </div>
        </div>




    </div>
	<? endforeach; ?>
    <?else:?>
    <div class="col-lg-12">
        <div class="card card-body">
            Вас пока никто не назначил своим делегатом
        </div>
    </div>

    <?endif;?>
</div>