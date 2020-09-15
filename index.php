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
    LocalRedirect("/lkg/gos/");
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
                strings: ["^2000<i>ОГАС</i>^2000<br>Общегосyдарственная<br>Автомати3ированная<br>Система^500"],
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
       <a href='javascript:' id='showauth' onclick='$(".ogas").fadeOut(function() {$("#authblock").fadeIn();$(".navbar").removeClass("d-none");$("#bgvideo").get(0).pause();});' class='btn btn-light bg-white font-size-lg '>Войти в систему</a><br><a href='/about/' class='text-white font-size-lg mt-0 mb-0'>Подробнее о проекте</a>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>