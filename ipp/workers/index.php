<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудники");
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Сотрудники предприятия</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    В разделе "Сотрудники" отображается подробная информация о сотрудниках вашего предприятия.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add", 
	"workers", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_DELETE" => "Y",
		"ALLOW_EDIT" => "Y",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
		),
		"IBLOCK_ID" => "24",
		"IBLOCK_TYPE" => "ogas",
		"LEVEL_LAST" => "Y",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"NAV_ON_PAGE" => "10",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
            0 => "108",
            1 => "NAME",
			2 => "106",
            3 => "107",
            4 => "113",
            5 => "114",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			1 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "workers"
	),
	false
);?>


                    <?/*?>
                    <h3>Сотрудники</h3>
                    <p class="mb-2">Система управления производством произвела расчет заработных плат для сотрудников вашего предприятия с учетом их рейтингов:</p>

                    <table class="table table-bordered framed">
                        <thead>
                        <tr>
                            <th class="w-50">ФИО</th>
                            <th>Должность</th>
                            <th>Специальность</th>
                            <th>Разряд</th>
                            <th>Рейтинг</th>
                            <th>Заработная плата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Иванов И.И.</td>
                            <td>Генеральный директор</td>
                            <td>Экономист</td>
                            <td>11 разряд</td>
                            <td><span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                </span></td>
                            <td>200 000 руб.</td>
                        </tr>
                        <tr>
                            <td>Петров П.П.</td>
                            <td>Главный бухгалтер</td>
                            <td>Экономист</td>
                            <td>10 разряд</td>
                            <td><span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                </span></td>
                            <td>150 000 руб.</td>
                        </tr>
                        <tr>
                            <td>Сидоров С.С.</td>
                            <td>Главный инженер</td>
                            <td>Инженер-технолог</td>
                            <td>9 разряд</td>
                            <td><span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                </span></td>
                            <td>140 000 руб.</td>
                        </tr>
                        <tr>
                            <td>Антонов А.А.</td>
                            <td>Ведущий специалист</td>
                            <td>Инженер</td>
                            <td>8 разряд</td>
                            <td><span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                </span></td>
                            <td>100 000 руб.</td>
                        </tr>
                        <tr>
                            <td>Сергеев С.С.</td>
                            <td>Уборщик</td>
                            <td>Уборщик</td>
                            <td>3 разряд</td>
                            <td><span class="text-muted font-size-sm font-weight-normal ml-auto">
                                    <i class="icon-star-full2 font-size-base text-warning-300  m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-full2 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-empty3 font-size-base text-warning-300 m-0"></i>
                                    <i class="icon-star-empty3 font-size-base text-warning-300 m-0"></i>
                                </span></td>
                            <td>50 000 руб.</td>
                        </tr>
                        </tbody>
                    </table>
<?*/?>

                </div>
            </div>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>