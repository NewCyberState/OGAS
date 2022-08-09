<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
//pr($item);
?>

<div>

    <div class="card">
        <a name="post<?=$item["ID"]?>"></a>
        <div class="card-header <?if($arParams["STATUS_ID"]==9){echo "bg-white";}else{echo "bg-info";};?> d-flex header-elements-inline">
            <h6 class="font-weight-semibold mb-0 flex-grow-1 card-title text-truncate">
                <a href="<?= $item["urlToPost"] ?>" class="<?if($arParams["STATUS_ID"]==9){echo "";}else{echo "text-white";};?>"
                   title="<?= $item["NAME"] ?>"><?= $item["NAME"]; ?></a>
            </h6>
            <div class="header-elements">
                <a href="<?= $item["urlToPost"] ?>" title="<?= $item["NAME"] ?>"><span class="badge bg-success ml-2"><?= $arParams["STATUS_NAME"] ?></span></a>
            </div>
        </div>

        <a href="<?= $CurPost["urlToPost"] ?>" class="<?if($arParams["STATUS_ID"]==9){echo "";}else{echo "text-white";};?>"
           title="<?= $CurPost["TITLE"] ?>">

<div class="cardimage" style="background-image: url(<?=$item[PREVIEW_PICTURE][SRC];?>);"></div>

        </a>
<div class="card-body">

    <?//pr($CurPost);
    ?>
    <div id="">
        <div data-mrc id="collapseSummary<?= $item[ID] ?>">
            <?= $item[PREVIEW_TEXT]?>
        </div>
        <?
        if (strlen($item[PREVIEW_TEXT]) > 400):?>
            <a class="collapsed" data-toggle="collapse" href="#collapseSummary<?= $item[ID] ?>"
               aria-expanded="false" aria-controls="collapseSummary"></a>
        <?endif; ?>
    </div>


</div>
<div class="card-footer d-flex">
    <ul class="list-inline list-inline-dotted text-muted mb-0">
        <li class="list-inline-item">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:rating.vote", $arParams["RATING_TYPE"],
                Array(
                    "ENTITY_TYPE_ID" => "BLOG_POST",
                    "ENTITY_ID" => $CurPost["ID"],
                    "OWNER_ID" => $CurPost["AUTHOR_ID"],
                    "USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
                    "USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
                    "TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
                    "TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
                    "TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
                    "TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
                    "PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            ); ?>
        </li>

        <li class="list-inline-item"><a
                    href="<?= $item["urlToPost"] ?>#comments" title="Комментарии" alt="Комментарии"><span class="blog-post-link-caption"><i class="icon-comment mr-1"></i></span> <?= IntVal($item["NUM_COMMENTS"]); ?></a>
        </li>

    </ul>

    <?
    if (!empty($item["CATEGORY"])) {
        echo "<span class='ml-auto'>";
        $i = 0;
        foreach ($item["CATEGORY"] as $v) {
            if ($i != 0)
                echo ",";
            ?> <?= $v["NAME"] ?><?
            $i++;
        }
        echo "</span>";
    }
    ?>
</div>
</div>

</div>