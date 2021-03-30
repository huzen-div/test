<script type="text/javascript">
    google.charts.load('current', {
        packages: ['bar']
    });
    google.charts.setOnLoadCallback(drawChart1);

    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'My Daily Activities',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);

    }
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChart5);

    function drawChart5() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2013', 1000, 400],
            ['2014', 1170, 460],
            ['2015', 660, 1120],
            ['2016', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance',
            hAxis: {
                title: 'Year',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                minValue: 0
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart6);

    function drawChart6() {
        var data = google.visualization.arrayToDataTable([
            ['Mon', 20, 28, 38, 45],
            ['Tue', 31, 38, 55, 66],
            ['Wed', 50, 55, 77, 80],
            ['Thu', 77, 77, 66, 50],
            ['Fri', 68, 66, 22, 15]
            // Treat first row as data as well.
        ], true);

        var options = {
            legend: 'none'
        };

        var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div_2'));

        chart.draw(data, options);
    }
</script>
<style>
    .drawChart{
        height: 500px;
    }
</style>
<div class="row">
    <div id="columnchart_material" class="col-md-6 drawChart"></div>

    <div id="piechart_3d" class="col-md-6 drawChart"></div>
</div>
<div class="row">

    <div id="barchart_material" class="col-md-6 drawChart"></div>
    <div id="curve_chart" class="col-md-6 drawChart"></div>
</div>
<div class="row">
    <div id="chart_div" class="col-md-6 drawChart"></div>
    <div id="chart_div_2" class="col-md-6 drawChart"></div>
</div>