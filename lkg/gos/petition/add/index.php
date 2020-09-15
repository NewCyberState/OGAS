<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить петицию");
?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info bg-white alert-styled-left alert-arrow-left">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Добавить петицию</h5>
					<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
				</div>

				<div class="card-body" style="">
					<p>Добавьте новую петицию с помощью формы, расположенной ниже. Привлеките внимание граждан с помощью запоминающегося названия темы петиции - того требования, которое вы предлагаете им поддержать. Пишите четко и кратко. Выберите одну или несколько подходящих тематик законодательства из выпадающего списка. Выберите группу граждан, интересы которых затрагивает петиция. Только участники выбранной группы увидят петицию. Подберите подходящее изображение петиции - это должен быть файл формата JPG или PNG, размером не менее 2000x1000 пикселей. Опишите проблему и расскажите о том, что вы хотите изменить. Расскажите подробно, каким вы видите решение проблемы. При создании новой петиции придерживайтесь действующего законодательства, не допускайте призывов к незаконным действиям.</p>
				</div>
			</div>
		</div>
	</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.blog.post.edit",
	"petition",
	array(
		"ALLOW_POST_CODE" => "Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"ID" => $id,
		"PAGE_VAR" => "",
		"PATH_TO_BLOG" => "/lkg/gos/petition/",
		"PATH_TO_DRAFT" => "",
		"PATH_TO_POST" => "/people/user/#user_id#/blog/#post_id#/",
		"PATH_TO_POST_EDIT" => "/people/user/#user_id#/blog/#post_id#/",
		"PATH_TO_SMILE" => "",
		"PATH_TO_USER" => "/people/user/#user_id#/",
		"POST_PROPERTY" => array(
            0 => "UF_BLOG_POST_VOTE",
            1 => "UF_STATUS_ID",
            2 => "UF_NEED_VOTES",
            3 => "UF_BLOG_POST_FILE",
            4 => "UF_STATUS_DATE",
            5 => "UF_THEMATICS",
            6 => "UF_DECISION",
		),
		"POST_VAR" => "",
		"SET_TITLE" => "N",
		"USER_VAR" => "",
		"USER_ID" => CUSER::GetID(),
		"SOCNET_GROUP_ID" => "4",
		"USE_SOCNET" => "Y",
		"COMPONENT_TEMPLATE" => "petition"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>