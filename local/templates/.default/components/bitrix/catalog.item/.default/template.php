<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @global CUSER $USER
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 *  * @var string $templateFolder
 */

$this->setFrameMode(true);

if (isset($arResult['ITEM']))
{
    $item = $arResult['ITEM'];
    $props=$item["PROPERTIES"];
    $arStatus=GetHLElement(4,$props["STATUS"]["VALUE"]);

    if($arStatus["ID"]==1)
        $bgcolor="bg-white";
    elseif ($arStatus["ID"]==2)
        $bgcolor="bg-light";
    elseif ($arStatus["ID"]==3)
        $bgcolor="bg-danger";
    elseif ($arStatus["ID"]==4)
        $bgcolor="bg-warning";
    elseif ($arStatus["ID"]==5)
        $bgcolor="bg-info";
    elseif ($arStatus["ID"]==6)
        $bgcolor="bg-secondary";
    elseif ($arStatus["ID"]==7)
        $bgcolor="bg-warning";
    elseif ($arStatus["ID"]==8)
        $bgcolor="bg-success";
    //pr($item);
    ?>

    <div class="swiper-slide <?if($APPLICATION->GetCurDir()=="/lkg/gos/"):?>col-lg-6 col-xl-4<?else:?>col-lg-6 col-xl-4<?endif;?>">

        <div class="card">
            <a name="post<?=$item["ID"]?>"></a>

            <a href="<?= $item ["DETAIL_PAGE_URL"] ?>" class="<?if($arStatus["ID"]<=2){echo "";}else{echo "text-white";};?>"
               title="<?= $item["NAME"] ?>"><div class="card-header <?=$bgcolor?> d-flex header-elements-inline">
                <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                    <?= $item["NAME"]; ?>
                </h6>

            </div></a>
            <?if($item[PREVIEW_PICTURE][ID]):?>
                <a href="<?= $item["DETAIL_PAGE_URL"] ?>" class="<?if($arStatus["ID"]==1){echo "";}else{echo "text-white";};?>"
                   title="<?= $item["TITLE"] ?>">

                    <div class="cardimage" style="background-image: url(<?=$item[PREVIEW_PICTURE][SRC];?>);"></div>

                </a>
            <?endif;?>

            <div class="card-body">

                <?//pr($CurPost);
                ?>
                <div class="longtext  <?if(!$item[PREVIEW_PICTURE][ID]) echo "nopicture";?>">
                    <div data-mrc<?if(!$item[PREVIEW_PICTURE][ID]) echo "2";?> id="collapseSummary<?= $item[ID] ?>">
                        <?= $item[PREVIEW_TEXT]?>
                    </div>
                    <?
                    if (strlen($item[PREVIEW_TEXT]) > 400):?>
                        <a class="collapsed " data-toggle="collapse" href="#collapseSummary<?= $item[ID] ?>"
                           aria-expanded="false" aria-controls="collapseSummary"></a>
                    <?endif; ?>
                </div>


            </div>
            <div class="card-footer d-flex justify-content-between">
                <ul class="list-inline list-inline-dotted text-muted mb-0">
                    <?if($arStatus["ID"]==1){?>
                    <li class="list-inline-item">
                        <?

                        $arVoteResult = CRatings::GetRatingVoteResult("IBLOCK_ELEMENT",  $item["ID"]);
                        $APPLICATION->IncludeComponent(
                            "bitrix:rating.vote", "like",
                            Array(
                                "ENTITY_TYPE_ID" => "IBLOCK_ELEMENT",
                                "ENTITY_ID" => $item["ID"],
                                "OWNER_ID" => $USER->GetID(),
                                "USER_VOTE" => $arVoteResult[USER_VOTE],
                                "USER_HAS_VOTED" => $arVoteResult[USER_HAS_VOTED],
                                "TOTAL_VOTES" => $arVoteResult[TOTAL_VOTES],
                                "TOTAL_POSITIVE_VOTES" => $arVoteResult[TOTAL_POSITIVE_VOTES],
                                "TOTAL_NEGATIVE_VOTES" => $arVoteResult[TOTAL_NEGATIVE_VOTES],
                                "TOTAL_VALUE" => $arVoteResult[TOTAL_VALUE],
                                "PATH_TO_USER_PROFILE" => "/user/#USER_ID#/",
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );?>
                    </li>
                    <?}?>

                    <?$group=CSocNetGroup::GetByID($props["GROUP_ID"]["VALUE"]);?>
                    <li class="list-inline-item"><a href="/groups/group/<?=$group["ID"]?>/"><?=$group["NAME"]?></a>
                    </li>

                    <li class="list-inline-item"><a
                            href="<?= $item[DETAIL_PAGE_URL] ?>#comments" title="Комментарии" alt="Комментарии"><span class="blog-post-link-caption"><i class="icon-comment mr-1"></i></span> <?= intval($props["BLOG_COMMENTS_CNT"]["VALUE"]); ?></a>
                    </li>



                </ul>

                <div class="d-flex">
                    <a href="<?= $item["DETAIL_PAGE_URL"] ?>" title="<?= $item["NAME"] ?>"><span class="badge bg-success ml-2"><?= $arStatus["UF_NAME"]?></span></a>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {

            var example = $('[data-mrc]');

// Инициализация
            example.expandable({
                'height': 150,
                'animation_duration': 500,
                'more': 'Развернуть...',
                'less': 'Свернуть...',
                'no_less': false
            });

            var example2 = $('[data-mrc2]');

// Инициализация
            example2.expandable({
                'height': 360,
                'animation_duration': 500,
                'more': 'Развернуть...',
                'less': 'Свернуть...',
                'no_less': false
            });

        });

    </script>

    <?



}
