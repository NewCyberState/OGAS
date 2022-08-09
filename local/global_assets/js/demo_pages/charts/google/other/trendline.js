/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - trendlines
 *
 *  Google Visualization trendline chart demonstration
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var GoogleTrendline = function () {


    //
    // Setup module components
    //

    // Trendline chart
    var _googleTrendline = function () {
        if (typeof google == 'undefined') {
            console.warn('Warning - Google Charts library is not loaded.');
            return;
        }

        // Initialize chart
        google.charts.load('current', {
            callback: function () {

                // Draw chart
                drawTrendline();

                // Resize on sidebar width change
                $(document).on('click', '.sidebar-control', drawTrendline);

                $(document).on('change', '#date', drawTrendline);

                // Resize on window resize
                var resizeTrendline;
                $(window).on('resize', function () {
                    clearTimeout(resizeTrendline);
                    resizeTrendline = setTimeout(function () {
                        drawTrendline();
                    }, 200);
                });
            },
            packages: ['corechart', 'controls']
        });

        // Chart settings
        function drawTrendline() {

            /*var dashboard = new google.visualization.Dashboard(
                document.getElementById('programmatic_dashboard_div'));

            var Slider = new google.visualization.ControlWrapper({
                'controlType': 'NumberRangeFilter',
                'containerId': 'programmatic_control_div',
                'options': {
                    'filterColumnLabel': 'Объем производства, шт',
                }
            });*/


            // Define charts element
            /*var trendline_element = document.getElementById('google-trendline');*/

            var id = $('#product_id').val();
            var date = $('#date').val();

            $.ajax({
                url: "/ajax/getsales.php",
                data: {ID: id, date: date}
            })
                .done(function (data) {
                    if (data) {
                        var sales = data;


                        var data = google.visualization.arrayToDataTable(
                            JSON.parse(sales));

                        var options = {
                            'width': "92%",
                            'height': 350,
                            fontName: 'Roboto',
                            height: 400,
                            curveType: 'function',
                            crosshair: {trigger: 'both'},
                            fontSize: 12,
                            chartArea: {
                                left: '5%',
                                width: '92%',
                                height: 350
                            },
                            hAxis: {format: ''},
                            trendlines: {
                                0: {
                                    type: 'polynomial',
                                    degree: 5,
                                    showR2: true,
                                    color: 'green',
                                },
                            },
                            legend: {
                                position: 'top',
                                alignment: 'end',
                                textStyle: {
                                    fontSize: 12
                                }
                            }
                        };

                        data.addColumn('number', 'План, шт');

                        var scatter_chart_element = document.getElementById('google-trendline');
                        //dashboard.bind(Slider, programmaticChart);
                        var scatter = new google.visualization.ScatterChart(scatter_chart_element);
                        scatter.draw(data, options);

                    }
                });


            // Options
            /*var options = {
                fontName: 'Roboto',
                height: 400,
                curveType: 'function',
                fontSize: 12,
                chartArea: {
                    left: '5%',
                    width: '92%',
                    height: 350
                },
                hAxis: {format: ''},
                trendlines: {
                    0: {
                        type: 'polynomial',
                        degree: 5,
                        color: 'green',
                    },
                },
                legend: {
                    position: 'top',
                    alignment: 'end',
                    textStyle: {
                        fontSize: 12
                    }
                }
            };*/


            /*
                        // Draw chart
                        var trendline = new google.visualization.ScatterChart(trendline_element);*/


            /*trendline.draw(data, options);
            Slider.draw();*/
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _googleTrendline();
        }
    }
}();


// Initialize module
// ------------------------------

GoogleTrendline.init();
