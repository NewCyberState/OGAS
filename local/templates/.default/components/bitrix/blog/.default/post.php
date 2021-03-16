<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$post=CBlogPost::GetByID($arResult[VARIABLES][post_id]);
$blog=CBlog::GetByID($post[BLOG_ID]);
$arResult[VARIABLES][blog]=$blog[URL];

$arFilter = Array(
    "ID" => $arResult[VARIABLES][post_id],
);

$dbPosts = CBlogPost::GetList(
    array(),
    $arFilter,
    false,
    false,
    array("*","UF_*")
);

$arPost = $dbPosts->Fetch();

$dirs[9]="/lkg/gos/petition/";
$dirs[10]="/lkg/gos/discussion/";
$dirs[12]="/lkg/gos/referendum/";
$dirs[11]="/lkg/gos/referendum/add/";
$dirs[13]="/lkg/gos/law/rejected/";
$dirs[14]="/lkg/gos/law/approved/";
$dirs[15]="/lkg/gos/law/execution/";
$dirs[16]="/lkg/gos/law/executed/";

//Если переход по старой ссылке и статус петиции изменился - редирект по новой ссылке
if(strstr($APPLICATION->GetCurUri(),$dirs[$arPost[UF_STATUS]])===false)
   LocalRedirect($dirs[$arPost[UF_STATUS]].$arResult[VARIABLES][post_id]."/");

?>

<div class="d-flex align-items-start flex-column flex-xl-row">

	<div class="w-100 order-2 order-md-1">

<?//pr($arResult);
$APPLICATION->IncludeComponent(
		"bitrix:blog.post", 
		"petition",
		Array(
				"BLOG_VAR"				=> $arResult["ALIASES"]["blog"],
				"POST_VAR"				=> $arResult["ALIASES"]["post_id"],
				"USER_VAR"				=> $arResult["ALIASES"]["user_id"],
				"PAGE_VAR"				=> $arResult["ALIASES"]["page"],
				"PATH_TO_BLOG"			=> $arResult["PATH_TO_BLOG"],
				"PATH_TO_POST"			=> $arResult["PATH_TO_POST"],				
				"PATH_TO_BLOG_CATEGORY"	=> $arResult["PATH_TO_BLOG_CATEGORY"],
				"PATH_TO_POST_EDIT"		=> $arResult["PATH_TO_POST_EDIT"],
				"PATH_TO_USER"			=> $arResult["PATH_TO_USER"],
				"PATH_TO_SMILE"			=> $arResult["PATH_TO_SMILE"],
				"BLOG_URL"				=> $arResult["VARIABLES"]["blog"],
				"ID"					=> $arResult["VARIABLES"]["post_id"],
				"CACHE_TYPE"			=> $arResult["CACHE_TYPE"],
				"CACHE_TIME"			=> $arResult["CACHE_TIME"],
				"SET_NAV_CHAIN"			=> $arResult["SET_NAV_CHAIN"],
				"SET_TITLE"				=> $arResult["SET_TITLE"],
				"POST_PROPERTY"			=> $arParams["POST_PROPERTY"],
				"DATE_TIME_FORMAT"		=> $arResult["DATE_TIME_FORMAT"],
				"GROUP_ID" 				=> $arParams["GROUP_ID"],
				"SEO_USER"				=> $arParams["SEO_USER"],
				"NAME_TEMPLATE" 		=> $arParams["NAME_TEMPLATE"],
				"SHOW_LOGIN" 			=> $arParams["SHOW_LOGIN"],
				"PATH_TO_CONPANY_DEPARTMENT"	=> $arParams["PATH_TO_CONPANY_DEPARTMENT"],
				"PATH_TO_SONET_USER_PROFILE" 	=> $arParams["PATH_TO_SONET_USER_PROFILE"],
				"PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
				"PATH_TO_VIDEO_CALL" 	=> $arParams["PATH_TO_VIDEO_CALL"],
				"USE_SHARE" 			=> $arParams["USE_SHARE"],
				"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
				"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
				"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
				"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHARE_SHORTEN_URL_KEY" 	=> $arParams["SHARE_SHORTEN_URL_KEY"],
				"SHOW_RATING" => $arParams["SHOW_RATING"],
				"RATING_TYPE" => $arParams["RATING_TYPE"],
				"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
				"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
				"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
				"SEO_USE" => $arParams["SEO_USE"],
			    "STATUS_ID" => $arParams["STATUS_ID"],

		),
		$component 
	);
	?>
	<?

	$componentCommentName = "bitrix:blog.post.comment";
	if(isset($arParams["COMMENTS_LIST_VIEW"]) && $arParams["COMMENTS_LIST_VIEW"] == "Y")
		$componentCommentName = 'bitrix:blog.post.comment.list';
	
	$componentCommentParams = array(
		"BLOG_VAR"		=> $arResult["ALIASES"]["blog"],
		"USER_VAR"		=> $arResult["ALIASES"]["user_id"],
		"PAGE_VAR"		=> $arResult["ALIASES"]["page"],
		"POST_VAR"		=> $arResult["ALIASES"]["post_id"],
		"PATH_TO_BLOG"	=> $arResult["PATH_TO_BLOG"],
		"PATH_TO_POST"	=> $arResult["PATH_TO_POST"],
		"PATH_TO_USER"	=> $arResult["PATH_TO_USER"],
		"PATH_TO_SMILE"	=> $arResult["PATH_TO_SMILE"],
		"BLOG_URL"		=> $arResult["VARIABLES"]["blog"],
		"ID"			=> $arResult["VARIABLES"]["post_id"],
		"CACHE_TYPE"	=> $arResult["CACHE_TYPE"],
		"CACHE_TIME"	=> $arResult["CACHE_TIME"],
		"COMMENTS_COUNT" => $arResult["COMMENTS_COUNT"],
		"DATE_TIME_FORMAT"	=> $arResult["DATE_TIME_FORMAT"],
		"USE_ASC_PAGING"	=> $arParams["USE_ASC_PAGING"],
		"NOT_USE_COMMENT_TITLE"	=> $arParams["NOT_USE_COMMENT_TITLE"],
		"GROUP_ID" 			=> $arParams["GROUP_ID"],
		"SEO_USER"			=> $arParams["SEO_USER"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
		"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
		"PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
		"PATH_TO_SONET_USER_PROFILE" => $arParams["PATH_TO_SONET_USER_PROFILE"],
		"PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
		"PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
		"SHOW_RATING" => $arParams["SHOW_RATING"],
		"RATING_TYPE" => $arParams["RATING_TYPE"],
		"SMILES_COUNT" => $arParams["SMILES_COUNT"],
		"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
		"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
		"EDITOR_RESIZABLE" => $arParams["COMMENT_EDITOR_RESIZABLE"],
		"EDITOR_DEFAULT_HEIGHT" => $arParams["COMMENT_EDITOR_DEFAULT_HEIGHT"],
		"EDITOR_CODE_DEFAULT" => $arParams["COMMENT_EDITOR_CODE_DEFAULT"],
		"ALLOW_VIDEO" => $arParams["COMMENT_ALLOW_VIDEO"],
		"ALLOW_IMAGE_UPLOAD" => $arParams["COMMENT_ALLOW_IMAGE_UPLOAD"],
		"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
		"SHOW_SPAM" => $arParams["SHOW_SPAM"],
		"NO_URL_IN_COMMENTS" => $arParams["NO_URL_IN_COMMENTS"],
		"NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["NO_URL_IN_COMMENTS_AUTHORITY"],
		"AJAX_POST" => $arParams["AJAX_POST"],
		"COMMENT_PROPERTY" => $arParams["COMMENT_PROPERTY"],
		"AJAX_PAGINATION" => $arParams["AJAX_PAGINATION"],
	);
	if(isset($arParams["USER_CONSENT"]))
		$componentCommentParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
	if(isset($arParams["USER_CONSENT_ID"]))
		$componentCommentParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
	if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
		$componentCommentParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
	if(isset($arParams["USER_CONSENT_IS_LOADED"]))
		$componentCommentParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
	$componentCommentParams["USER_CONSENT_FOR_REGISTERED"] = "Y";	// get consent for registered

	$APPLICATION->IncludeComponent(
		$componentCommentName,
		'',
		$componentCommentParams,
		$component 
	);
?>

	</div>
	<?

	global $globalpost,$globalgroup,$endvotes,$za,$protiv,$globalthematics,$globalvotes,$delegatetable;

	//pr($globalthematics);

	foreach ($globalthematics as $cat)
		$cats[]=$cat["NAME"];



	if($arPost[UF_STATUS]==12) {
		$now = strtotime("now");
		$finish = strtotime($arPost[UF_STATUS_DATE])+7*86400;
		$period=$finish-$now-3*60*60;
		$enddate=getdate($period);
	}

	if($arPost[UF_STATUS]>=12) {
	?>


<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<div class="card">
			<div class="card-header bg-transparent header-elements-inline">
				<span class="text-uppercase font-size-sm font-weight-semibold">Статус</span>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="d-flex justify-content-center text-center mb-2">
					<h3 class="mb-0"><?=$globalpost["STATUS_NAME"]?></h3>
				</div>
			</div>


		</div>



		<?if($arPost[UF_STATUS]==12) {?>
		<!-- Referendum timer -->
		<div class="card">
			<div class="card-header bg-transparent header-elements-inline">
				<span class="text-uppercase font-size-sm font-weight-semibold">До окончания</span>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="d-flex justify-content-center text-center mb-2">
					<div class="timer-number font-weight-light">
						<?=$enddate[yday]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[yday],array("день","дня","дней"))?></span>
					</div>
					<div class="timer-dots mx-1">&nbsp;</div>
					<div class="timer-number font-weight-light">
						<?=$enddate[hours]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[hours],array("час","часа","часов"))?></span>
					</div>
					<div class="timer-dots mx-1">:</div>
					<div class="timer-number font-weight-light">
						<?=$enddate[minutes]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[minutes],array("минута","минуты","минут"))?></span>
					</div>
					<div class="timer-dots mx-1">:</div>
					<div class="timer-number font-weight-light">
						<?=$enddate[seconds]?> <span class="d-block font-size-base mt-2"><?=plural_form($enddate[seconds],array("секунда","секунды","секунд"))?></span>
					</div>
				</div>
			</div>


		</div>
		<!-- Referendum timer -->
			<?}?>

        <?

        $delegatetable=\Ogas\Democracy\LiquidVoting::GetVotingData($arResult[VARIABLES][post_id]);

        $myvote="";
        $touser=array();
        foreach ($endvotes as $endvote){
            if($endvote[0]==CUSER::GetID())
                $myvote=$endvote[1];
        }

        foreach ($delegatetable as $item) {
            if($item[0]==CUSER::GetID() && intval($item[1]))
            {
                $res=CUSER::GetByID($item[1]);
                $ar=$res->Fetch();
                $touser[]="<a href='/user/$ar[ID]/'>".$ar["NAME"]."&nbsp;".$ar["LAST_NAME"]."</a>";
            }

        }
        if($touser)
            $touser=implode ("<br>",$touser);


        if($arPost[UF_LAW])
            $law=GetElement($arPost[UF_LAW]);


        ?>



        <div class="card">
            <div class="card-header bg-transparent header-elements-inline ">
                <span class="text-uppercase font-size-sm font-weight-semibold">Ваш голос</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <table class="table table-borderless table-xs my-2">
                <tbody>
                <tr>
                    <td>Тип голосования:</td>
                    <td class="text-right"><?=($myvote?"Прямое":"Делегативное")?></td>
                </tr>
                <?if($myvote):?>
                <tr>
                    <td>Ваш голос:</td>
                    <td class="text-right"><?=$myvote?></td>
                </tr>
                <?endif;?>
                </tbody>
            </table>


        </div>

        <?if($touser):?>
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline ">
                <span class="text-uppercase font-size-sm font-weight-semibold">Ваши делегаты</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <table class="table table-borderless table-xs my-2">
                <tbody>
                    <tr>
                        <td class="text-center"><?=$touser?></td>
                    </tr>
                </tbody>
            </table>


        </div>
        <?endif;?>


		<div class="card">
			<div class="card-header bg-transparent header-elements-inline ">
				<span class="text-uppercase font-size-sm font-weight-semibold">Результаты</span>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>


            <?if($law):?>
			<table class="table table-borderless table-xs my-2">
				<tbody>
				<tr>
					<td>Группа:</td>
					<td class="text-right"><?=$law["GROUP"]["VALUE"]?></td>
				</tr>
				<tr>
					<td>Участников группы:</td>
					<td class="text-right"><?=$law["MEMBERS"]["VALUE"]?></td>
				</tr>

				<tr>
					<td>Проголосовали:</td>
					<td class="text-right"><?=$law["VOTES"]["VALUE"]?></td>
				</tr>
				<tr>
					<td>Проголосовали с учетом делегирования:</td>
					<td class="text-right"><?=$law["DELEGATED_VOTES"]["VALUE"]?></td>
				</tr>
				<tr>
					<td>"За" с учетом делегирования:</td>
					<td class="text-right"><?=$law["ZA"]["VALUE"]?></td>
				</tr>
				<tr>
					<td>"Против" с учетом делегирования:</td>
					<td class="text-right"><?=$law["PROTIV"]["VALUE"]?></td>
				</tr>
                <tr>
					<td>Для принятия закона требуется всего голосов "За":</td>
					<td class="text-right"><?=$law["ZA_NEEDED"]["VALUE"]?></td>
				</tr>


				</tbody>
			</table>
            <?else:?>
                <table class="table table-borderless table-xs my-2">
                    <tbody>
                    <tr>
                        <td>Группа:</td>
                        <td class="text-right"><?=$globalpost[SOCNET_GROUP_NAME]?></td>
                    </tr>
                    <tr>
                        <td>Участников группы:</td>
                        <td class="text-right"><?=$globalgroup[NUMBER_OF_MEMBERS]?></td>
                    </tr>

                    <?if(!empty($delegatetable)):?>
                        <tr>
                            <td>Проголосовали:</td>
                            <td class="text-right"><?=count($endvotes)?></td>
                        </tr>
                        <tr>
                            <td>Проголосовали с учетом делегирования:</td>
                            <td class="text-right"><?=$za+$protiv?></td>
                        </tr>
                        <tr>
                            <td>"За" с учетом делегирования:</td>
                            <td class="text-right"><?=intval($za)?></td>
                        </tr>
                        <tr>
                            <td>"Против" с учетом делегирования:</td>
                            <td class="text-right"><?=intval($protiv)?></td>
                        </tr>
                    <?endif;?>
                    <?
                    if(ceil($globalgroup[NUMBER_OF_MEMBERS]/2)==floor($globalgroup[NUMBER_OF_MEMBERS]/2))
                        $needza=$globalgroup[NUMBER_OF_MEMBERS]/2+1;
                    else
                        $needza=ceil($globalgroup[NUMBER_OF_MEMBERS]/2);

                    ?>
                    <tr>
                        <td>Для принятия закона требуется всего голосов "За":</td>
                        <td class="text-right"><?=$needza?></td>
                    </tr>
                    <?if(!empty($delegatetable)):?>
                        <?if($arPost[UF_STATUS]==12) {?>

                            <tr>
                                <td>Для принятия закона требуется еще голосов "За":</td>
                                <td class="text-right"><?=$needza-$za?></td>
                            </tr>
                        <?}?>
                    <?endif;?>


                    </tbody>
                </table>
            <?endif;?>

		</div>

	</div>
</div>

<?}?>
</div>

