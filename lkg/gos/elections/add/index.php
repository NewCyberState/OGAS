<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить петицию");
?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info bg-white alert-styled-left alert-arrow-left p-0">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Добавить выборы</h5>
					<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
				</div>

				<div class="card-body" style="">
					<p>Добавьте новые выборы с помощью формы, расположенной ниже.</p>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Группа</label>
                        <div class="col-lg-10">
                            <select class="form-control">
                                <option value="opt1">Выберите группу</option>
                                <option value="opt2">Россия</option>
                                <option value="opt5">Москва</option>
                                <option value="opt3">Волгоград</option>
                                <option value="opt4">Институт системной социологии</option>
                                <option value="opt5">КПРФ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Должность</label>
                        <div class="col-lg-10">
                            <select class="form-control">
                                <option value="opt1">Выберите должность</option>
                                <option value="opt2">Глава государства</option>
                                <option value="opt5">Премьер-министр</option>
                                <option value="opt3">Депутат парламента</option>
                                <option value="opt4">Руководитель</option>
                                <option value="opt5">Министр обороны</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Должностные обязанности</label>
                        <div class="col-lg-10">
                            <textarea rows="10" cols="3" class="form-control" placeholder="Введите описание должностных обязанностей"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Дата начала выборов</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="date" name="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Дата окончания выборов</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="date" name="date">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary"><i class="icon-check2 mr-2"></i> Сохранить</button>
                </div>
            </div>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>