<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ОГАС-ДЕМО");
global $USER;
?>
<div class="auth" id="authblock">
<?if(!$USER->IsAuthorized()):
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot-password/",
            "AUTH_REGISTER_URL" => "/auth/registration/",
            "AUTH_SUCCESS_URL" => "/lkg/gos/",
            "SHOW_ERRORS" => "Y"
        )
    );
else:
    LocalRedirect("/lkg/");
endif;
?>
</div>
    <script>
        $(document).ready( function() {
            function showauth()
            {
                $(".ogas").fadeOut();
                $("#authblock").fadeIn();

            }

            $(".ogas span").typed({
                strings: ["^2500<i>ОГАС</i>^2000<br>Общегосyдарственная<br>Автомати3ированная<br>Система^500"],
                typeSpeed: 10,
                loop: false,
                backSpeed: 0,
                contentType: 'html',
                showCursor: false,
                callback: function () {
                    $(".ogas .buttons").fadeIn(500);
                },
            });

        });
    </script>

<div class="ogas">
    <span></span>
    <div class="buttons" style="display: none">
       <a href='javascript:' id='showauth' onclick='$(".ogas").fadeOut(function() {$("#authblock").fadeIn();$(".navbar").removeClass("d-none");$("#bgvideo").get(0).pause();});' class='btn btn-light bg-white font-size-lg '>Войти в систему</a><br>
        <a id='about' href='/about/' class='btn btn-light border-white text-white font-size-lg font-weight-semibold mt-0 mb-0'>Подробнее о проекте</a><br>
        <a href="https://vk.com/digital_socialism/" target="_blank"><b class="fab fa-vk mr-2 mt-2 fa-2x font-weight-normal text-white"></b></a>
        <a href="https://t.me/digitalsocialism" target="_blank"><b class="fab fa-telegram-plane mr-2 mt-2 fa-2x font-weight-normal text-white"></b></a>
        <a href="https://www.youtube.com/channel/UC9g23VIh4tRNf-dW7TdtWsg" target="_blank"><b class="fab fa-youtube mr-2 mt-2 fa-2x font-weight-normal text-white"></b></a>

    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>