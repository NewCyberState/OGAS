<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?><h3>Вакансии</h3>
<div>
	 Если вы хотите принять участие в работе над проектом "ОГАС ДЕМО", отправьте пожалуйста ваше краткое резюме на почту <a href="mailto:info@ogasdemo.ru">info@ogasdemo.ru</a> или через форму обратной связи ниже.<br>
</div>
<div>
 <br>
</div>
<div>
	 В настоящее время требуются: <br>
</div>
<div>
	<br>
</div>
<div>
</div>
<ul>
	<li>
	<div>
		 Веб-программист на "Битрикс: Управление сайтом"
	</div>
 </li>
	<li>
	<div>
		 Веб-дизайнер
	</div>
 </li>
	<li>
	<div>
		 Тестировщик
	</div>
 </li>
	<li>
	<div>
		 PR-менеджер <br>
	</div>
 </li>
	<li>
	<div>
		 Редактор
	</div>
 </li>
</ul>
<div>
 <br>
</div>
<h3>Форма обратной связи<br>
 </h3>
<ul>
</ul>
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"template1",
	Array(
		"COMPONENT_TEMPLATE" => "template1",
		"EMAIL_TO" => "info@ogasdemo.ru",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"EMAIL",2=>"MESSAGE",),
		"USE_CAPTCHA" => "Y"
	)
);?><br>
<ul>
</ul>
<div>
</div>
 <br>
<div>
 <br>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>