<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
    <h3>
        Группы в социальных сетях</h3>
    <div>
    <p>
        Больше информации о проекте ОГАС и Новом Кибернетическом Государстве в наших группах в социальных сетях:
    </p>
    <ul class="list-inline list-inline-condensed mb-0">
        <li class="list-inline-item"> <a href="https://vk.com/digital_socialism" target="_blank" class="btn bg-indigo btn-icon btn-lg rounded-round"><i class="fab fa-vk fa-1x" style="top:0;padding:2px 0"></i></a></li>
        <li class="list-inline-item"> <a href="https://t.me/newcyberstate" target="_blank" class="btn bg-info btn-icon btn-lg rounded-round"><i class="fab fa-telegram-plane"  style="top:0;padding:2px 0;left:-1px;"></i></a></li>
        <li class="list-inline-item"> <a href="https://www.youtube.com/channel/UC9g23VIh4tRNf-dW7TdtWsg" target="_blank" class="btn bg-danger btn-icon btn-lg rounded-round"><i class="fab fa-youtube"  style="top:0;padding:2px 0"></i></a></li>
    </ul>
    </div>
    <br>
    <h3>Отправить сообщение администрации портала</h3>
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"template1", 
	array(
		"EMAIL_TO" => "info@ogasdemo.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
<div>
 <br>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>