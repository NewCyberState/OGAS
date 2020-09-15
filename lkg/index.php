<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет гражданина");
global $USER;
if(!$USER->IsAuthorized()):
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot-password/",
            "AUTH_REGISTER_URL" => "/auth/registration/",
            "AUTH_SUCCESS_URL" => "/"
        )
    );
else:
?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-center py-2 col-lg-12">

                            <h6 class="mb-1">Общегосударственная Автоматизированная Система</h6>
                            <h2 class="font-weight-semibold mb-1 text-uppercase">Личный Кабинет Гражданина</h2>
                            <span class="text-muted d-block">Добро пожаловать, <?global $USER; echo $USER->GetFirstName()?>!</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-library2 icon-2x text-primary-400 border-primary-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title ">Управление государством</h4>
                        <p class="mb-3">Петиции, законы, обсуждения, голосования, референдумы</p>
                        <a href="gos/" class="btn bg-primary-400">Управление государством</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-cart2 icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1 "></i>
                        <h4 class="card-title text-muted">Товары и услуги</h4>
                        <p class="mb-3 text-muted">Выбор и заказ товаров и услуг, производимых предприятиями страны</p>
                        <a href="#" class="btn bg-success-400 disabled">Товары и услуги</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-credit-card2 icon-2x text-danger border-danger border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title  text-muted">Финансы и платежи</h4>
                        <p class="mb-3  text-muted">Счета, карты, заработная плата, премии, выплаты, пособия</p>
                        <a href="#" class="btn bg-danger disabled">Финансы и платежи</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="mi-work mi-2x text-teal-400 border-teal-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title  text-muted">Работа и занятость</h4>
                        <p class="mb-3 text-muted">Вакансии, резюме, собеседования, подработка, карьерная консультация, профориентация</p>
                        <a href="#" class="btn bg-teal-400 disabled">Работа и занятость</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-design icon-2x text-purple-400 border-purple-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Образование</h4>
                        <p class="mb-3 text-muted">Начальное, среднее, высшее, специальное, дополнительное образование</p>
                        <a href="#" class="btn bg-purple-400 disabled">Образование</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="mi-local-hospital mi-2x text-green border-green border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Здоровье</h4>
                        <p class="mb-3 text-muted">Здоровый образ жизни, медицинские услуги, анализы, диагностика, экстренная помощь</p>
                        <a href="#" class="btn bg-green disabled">Здоровье</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-home7 icon-2x text-slate-400 border-slate-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title  text-muted">Недвижимость</h4>
                        <p class="mb-3 text-muted">Квартиры, дома, комнаты, гаражи, покупка, продажа, аренда</p>
                        <a href="#" class="btn bg-slate-400 disabled">Недвижимость</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-car icon-2x text-indigo-400 border-indigo-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Транспорт</h4>
                        <p class="mb-3 text-muted">Автомобили, мотоциклы, мототехника, водный транспорт, запчасти</p>
                        <a href="#" class="btn bg-indigo-400 disabled">Транспорт</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="icon-movie icon-2x text-violet border-violet border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Культура, спорт и отдых</h4>
                        <p class="mb-3 text-muted">Кино, театры, концерты, матчи, мероприятия, туры, билеты</p>
                        <a href="#" class="btn bg-violet disabled">Культура, спорт и отдых</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="mi-child-friendly mi-2x text-pink border-pink-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Семья и дети</h4>
                        <p class="mb-3 text-muted">Регистрация брака, регистрация рождения, усыновление</p>
                        <a href="#" class="btn bg-pink-400 disabled">Семья и дети</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="mi-person-pin mi-2x text-orange-400 border-orange-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title">Личные данные</h4>
                        <p class="mb-3">Персональные данные, документы, предпочтения, пожелания, интересы</p>
                        <a href="/personal/" class="btn bg-orange-400">Личные данные</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="mi-help-outline mi-2x text-brown border-brown border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h4 class="card-title text-muted">Персональный советник</h4>
                        <p class="mb-3 text-muted">Помощь в различных жизненных ситуациях, поддержка, консультации</p>
                        <a href="#" class="btn bg-brown disabled">Персональный советник</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?
endif;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>