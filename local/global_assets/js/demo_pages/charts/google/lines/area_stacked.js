/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - stacked area
 *
 *  Google Visualization stacked area chart demonstration
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var GoogleAreaStacked = function() {


    //
    // Setup module components
    //

    // Stacked area chart
    var _googleAreaStacked = function() {
        if (typeof google == 'undefined') {
            console.warn('Warning - Google Charts library is not loaded.');
            return;
        }

        // Initialize chart
        google.charts.load('current', {
            callback: function () {

                // Draw chart
                drawAreaStackedChart();

                // Resize on sidebar width change
                $(document).on('click', '.sidebar-control', drawAreaStackedChart);

                // Resize on window resize
                var resizeAreaStacked;
                $(window).on('resize', function () {
                    clearTimeout(resizeAreaStacked);
                    resizeAreaStacked = setTimeout(function () {
                        drawAreaStackedChart();
                    }, 200);
                });
            },
            packages: ['corechart']
        });

        // Chart settings
        function drawAreaStackedChart() {

            // Define charts element


            var id = $('#company_id').val();
            var date = $('#date').val();

            $.ajax({
                url: "/ajax/getcompanysales.php",
                data: {ID: id, date: date}
            })
                .done(function (data) {
                    if (data) {
                        var sales = JSON.parse(data);
                        console.log(sales);

                         var area_stacked_element = document.getElementById('google-area-stacked');

                         var data = google.visualization.arrayToDataTable(sales
                             );

                         var options_area_stacked = {
                             fontName: 'Roboto',
                             height: 400,
                             aggregationTarget: 'auto',
                             curveType: 'function',
                             fontSize: 12,
                             areaOpacity: 0.4,
                             chartArea: {
                                 left: '5%',
                                 width: '94%',
                                 height: 350
                             },
                             isStacked: true,
                             pointSize: 4,
                             tooltip: {
                                 textStyle: {
                                     fontName: 'Roboto',
                                     fontSize: 13
                                 }
                             },
                             lineWidth: 2,
                             vAxis: {
                                 title: 'Продано, шт',
                                 titleTextStyle: {
                                     fontSize: 13,
                                     italic: false
                                 },
                                 gridlines:{
                                     color: '#e5e5e5',
                                     count: 10
                                 },
                                 minValue: 0
                             },
                             legend: {
                                 position: 'top',
                                 alignment: 'end',
                                 textStyle: {
                                     fontSize: 12
                                 }
                             }
                         };

                         // Draw chart
                         var area_stacked_chart = new google.visualization.AreaChart(area_stacked_element);
                         area_stacked_chart.draw(data, options_area_stacked);

                    }
                    ;
                });


        }

    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _googleAreaStacked();
        }
    }
}();


// Initialize module
// ------------------------------

GoogleAreaStacked.init();
