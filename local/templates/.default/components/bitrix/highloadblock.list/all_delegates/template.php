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
    <h6 class="mb-0 font-weight-semibold">
        Выбрать делегатов
    </h6>
    <span class="text-muted d-block">Список граждан, которым вы можете делегировать свой голос.</span>
</div>
<div class="row">
    <!-- data -->
    <? foreach ($arResult['rows'] as $row): ?>

        <?
        $rsUser = CUser::GetByID($row["UF_DELEGATE"]);
        $arUser = $rsUser->Fetch();

        ?>
        <div class="col-lg-4">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#">
                            <img src="<?=CFile::GetPath($arUser["PERSONAL_PHOTO"])?>" class="rounded-circle" alt="" width="42" height="42">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="mb-0"><?=$arUser[NAME]." ".$arUser[LAST_NAME]?></h6>
                        <span class="text-muted"><?=$row["UF_TAG"]?></span>
                    </div>

                    <a href="#" class="btn bg-light mt-1  ml-xl-3 mt-md-1">Освободить делегата</a>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>