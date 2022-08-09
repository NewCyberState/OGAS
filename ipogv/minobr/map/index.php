<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Уровень образования");


?>
    <style type="text/css">

        #YMapsID {
            width: 100%;
            height: 750px;
        }
        #YMapsCode {
            width: 100%;
        }
    </style>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="heatmap.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left ">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Уровень образования</h5>
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                </div>

                <div class="card-body" style="">
                    На данной тепловой карте вы можете наблюдать средний уровень образования в данном регионе. Основываясь на данной информации можно принимать решения о постройке различных учебных заведений в том или ином районе.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <script src="data.js" type="text/javascript"></script>

    <script type="text/javascript">
        ymaps.ready(function () {
            var map = new ymaps.Map('YMapsID', {
                    center: [55.7522, 37.6156],
                    controls: ['zoomControl', 'typeSelector',  'fullscreenControl'],
                    zoom: 12, type: 'yandex#satellite'
                }),



                gradients = [{
                    0.1: 'rgba(10, 255, 10, 0.5)',
                    0.2: 'rgba(255, 255, 25, 0.7)',
                    0.7: 'rgba(234, 25, 25, 0.9)',
                    1.0: 'rgba(255, 0, 0, 1)'
                }, {
                    0.1: 'rgba(162, 36, 25, 0.7)',
                    0.2: 'rgba(234, 72, 58, 0.8)',
                    0.7: 'rgba(255, 255, 0, 0.9)',
                    1.0: 'rgba(128, 255, 0, 1)'
                }],
                radiuses = [200],
                opacities = [0.4];

            ymaps.modules.require(['Heatmap'], function (Heatmap) {
                var heatmap = new Heatmap(data, {
                    gradient: gradients[0],
                    radius: radiuses[0],
                    opacity: opacities[2]
                });
                heatmap.setMap(map);

                buttons.dissipating.events.add('press', function () {
                    heatmap.options.set(
                        'dissipating', !heatmap.options.get('dissipating')
                    );
                });
                buttons.opacity.events.add('press', function () {
                    var current = heatmap.options.get('opacity'),
                        index = opacities.indexOf(current);
                    heatmap.options.set(
                        'opacity', opacities[++index == opacities.length ? 0 : index]
                    );
                });
                buttons.radius.events.add('press', function () {
                    var current = heatmap.options.get('radius'),
                        index = radiuses.indexOf(current);
                    heatmap.options.set(
                        'radius', radiuses[++index == radiuses.length ? 0 : index]
                    );
                });
                buttons.gradient.events.add('press', function () {
                    var current = heatmap.options.get('gradient');
                    heatmap.options.set(
                        'gradient', current == gradients[0] ? gradients[1] : gradients[0]
                    );
                });
                buttons.heatmap.events.add('press', function () {
                    heatmap.setMap(
                        heatmap.getMap() ? null : map
                    );
                });

                for (var key in buttons) {
                    if (buttons.hasOwnProperty(key)) {
                        map.controls.add(buttons[key]);
                    }
                }
            });
        });
    </script>

                            <div id="YMapsID"></div>
                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>