<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заработная плата");
?><h2>Заработная плата за текущий месяц</h2>
<table class="table table-striped table-bordered w-auto">
<tbody>
<tr>
	<td>
		 &nbsp;Специальность
	</td>
	<td>
		 &nbsp; Программист
	</td>
</tr>
<tr>
	<td>
		 &nbsp; Разряд
	</td>
	<td>
		 &nbsp; 12
	</td>
</tr>
<tr>
	<td>
		 &nbsp; Тарифная ставка
	</td>
	<td>
		 &nbsp; 425,80 руб.
	</td>
</tr>
</tbody>
</table>
 <br>
<div class="toast mt-3" style="opacity: 1; max-width: none;">
	<div class="toast-header bg-primary">
 <span class="font-weight-semibold mr-auto">Формула расчета заработной платы</span>
	</div>
	<div class="toast-body bg-light">
		<h5 class="mb-0">Заработная плата = Количество отработанных человеко-часов * Часовая тарифная ставка * Коэффициент востребованности * Коэффициент качества + Надбавки - Удержания</h5>
	</div>
</div>

    <div class="toast mt-3" style="opacity: 1; max-width: none;">
        <div class="toast-header bg-success">
            <span class="font-weight-semibold mr-auto">Расчет заработной платы</span>
        </div>
        <div class="toast-body bg-light">
            <h3 class="mb-0">Заработная плата = 176 * 425,80 * 1,18 * 1,5 = 132&nbsp;645 руб.</h3>
        </div>
    </div>

<div class="font-weight-semibold font-size-lg mb-2">
</div>
<p>
	 Количество отработанных человеко-часов - Количество часов, которые отработал работник за прошедший месяц
</p>
<p>
	 Часовая тарифная ставка - часовая ставка в рублях с учетом специальности и разряда работника
</p>
<p>
	 Коэффициент востребованности - коэффициент дефицитности специальности. Вычисляется с учетом количества вакансий относительно общего числа работников данной специальности
</p>
<p>
	 Коэффициент качества - коэффициент качества работы предприятия, рассчитывается с учетом рейтинга предприятия и с учетом точности выполнения плановых заданий предприятием
</p>
<p>
	 Надбавки - различные персональные надбавки для работника
</p>
<p>
	 Удержания - различные персональные удержания для работника
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>