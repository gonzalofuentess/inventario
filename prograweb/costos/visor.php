<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<?php 

require_once("arreglo.php");

//Creamos un objeto de la clase randomTable
$rand = new RandomTable();
//insertamos un valor aleatorio
#$rand->insertRandom();
//obtenemos toda la información de la tabla random
$rawdata = $rand->getAllInfo();

//echo json_decode($rawdata),"\n";
#print_r(array_values($rawdata));
#echo json_encode($rawdata);

?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>



    </head>
    <body>
       




<!-- HTML -->
<div id="chartdiv"></div>



<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);


// Add data
chart.data = <?php echo json_encode($rawdata); ?>;

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//dateAxis.renderer.grid.template.location = 0;
//dateAxis.renderer.minGridDistance = 30;

var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis1.title.text = "Costo";

var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Páginas Vistas";
valueAxis2.renderer.opposite = true;
valueAxis2.renderer.grid.template.disabled = true;

// Create series
var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.dataFields.valueY = "cloudfront";
series1.dataFields.dateX = "fecha";
series1.yAxis = valueAxis1;
series1.name = "Cloud Front";
series1.tooltipText = "{name}\n[bold font-size: 20]${valueY}[/]";
series1.fill = chart.colors.getIndex(0);
series1.strokeWidth = 0;
series1.clustered = false;
series1.columns.template.width = am4core.percent(40);

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "costo";
series2.dataFields.dateX = "fecha";
series2.yAxis = valueAxis1;
series2.name = "Costo Diario Total";
series2.tooltipText = "{name}\n[bold font-size: 20]${valueY}[/]";
series2.fill = chart.colors.getIndex(0).lighten(0.5);
series2.strokeWidth = 0;
series2.clustered = false;
series2.toBack();

var series3 = chart.series.push(new am4charts.LineSeries());
series3.dataFields.valueY = "page_views";
series3.dataFields.dateX = "fecha";
series3.name = "Páginas Vistas";
series3.strokeWidth = 2;
series3.tensionX = 0.7;
series3.yAxis = valueAxis2;
series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";

var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
bullet3.circle.radius = 3;
bullet3.circle.strokeWidth = 2;
bullet3.circle.fill = am4core.color("#fff");
var series4 = chart.series.push(new am4charts.ColumnSeries());
series4.dataFields.valueY = "ec2";
series4.dataFields.dateX = "fecha";
series4.name = "EC2";
//series4.strokeWidth = 2;
//series4.tensionX = 0.7;
series4.yAxis = valueAxis1;
series4.tooltipText = "{name}\n[bold font-size: 20]${valueY}[/]";
series4.stroke = chart.colors.getIndex(0).lighten(0.5);
series4.strokeDasharray = "3,3";
series4.clustered = false;
series4.columns.template.width = am4core.percent(30);

//var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
//bullet4.circle.radius = 3;
//bullet4.circle.strokeWidth = 2;
//bullet4.circle.fill = am4core.color("#fff");

// Add cursor
chart.cursor = new am4charts.XYCursor();

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.position = "top";

// Add scrollbar
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series1);
chart.scrollbarX.series.push(series3);
chart.scrollbarX.parent = chart.bottomAxesContainer;
</script>


    </body>
</html>
