/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - area
 *
 *  Google Visualization area chart demonstration
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var GoogleAreaBasic = function() {


    //
    // Setup module components
    //

    // Area chart
    var _googleAreaBasic = function() {
        if (typeof google == 'undefined') {
            console.warn('Warning - Google Charts library is not loaded.');
            return;
        }

        // Initialize chart
        google.charts.load('current', {
            callback: function () {

                // Draw chart
                drawAreaChart();

                // Resize on sidebar width change
                $(document).on('click', '.sidebar-control', drawAreaChart);

                // Resize on window resize
                var resizeAreaChart;
                $(window).on('resize', function() {
                    clearTimeout(resizeAreaChart);
                    resizeAreaChart = setTimeout(function () {
                        drawAreaChart();
                    }, 200);
                });
            },
            packages: ['corechart']
        });

        // Chart settings
        function drawAreaChart() {

            // Define charts element
            var area_basic_element = document.getElementById('google-area');

            // Data
            var data = google.visualization.arrayToDataTable([
                ['Месяц/Год', 'Объем производства, шт'],
                ['01/2020',  1200],
                ['02/2020',  1170],
                ['03/2020',  1500],
                ['04/2020',  1100],
                ['05/2020',  1250],
                ['06/2020',  1400],
                ['07/2020',  1300],
                ['08/2020',  1350],
                ['09/2020',  1700],
                ['10/2020',  1200],
                ['11/2020',  1600],
                ['12/2020',  1750],
                ['01/2021',  1200],
                ['02/2021',  1500],
                ['03/2021',  1900],
                ['04/2021',  1750],
                ['05/2021',  2000],
                ['06/2021',  1800],
                ['07/2021',  2200],
                ['08/2021',  1900],
                ['09/2021',  2450],
                ['10/2021',  1900],
                ['11/2021',  2200],
                ['12/2021',  2500],
            ]);


            // Options
            var options = {
                fontName: 'Roboto',
                height: 400,
                curveType: 'function',
                fontSize: 12,
                areaOpacity: 0.4,
                chartArea: {
                    left: '5%',
                    width: '94%',
                    height: 350
                },
                pointSize: 4,
                tooltip: {
                    textStyle: {
                        fontName: 'Roboto',
                        fontSize: 13
                    }
                },
                vAxis: {
                    title: 'Sales and Expenses',
                    titleTextStyle: {
                        fontSize: 13,
                        italic: false
                    },
                    gridarea:{
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
            var area_chart = new google.visualization.AreaChart(area_basic_element);
            area_chart.draw(data, options);
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _googleAreaBasic();
        }
    }
}();


// Initialize module
// ------------------------------

GoogleAreaBasic.init();
