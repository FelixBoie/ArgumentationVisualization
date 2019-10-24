<?php

// Read JSON file
$json = file_get_contents('argument.json');
//Decode JSON
$json_data = json_decode($json,true);

//Traverse array and get the data for students aged less than 20

$title = $json_data['title'];
$acceptabilityDegree = $json_data['acceptabilityDegree'];
$percent = round((1 - ($acceptabilityDegree / 2))*100);


?>

<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Thu Oct 24 2019 12:57:43 GMT+0000 (UTC)  -->
<html data-wf-page="5db19bf1aca82690432cd22a" data-wf-site="5d874fa19d77333f4bc2f3aa">
<head>
  <meta charset="utf-8">
  <title>graph</title>
  <meta content="graph" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/kialo-graph.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
  <style>
      
      
      #chartdiv {
        width: 100%;
        height: 80vh;
      }
      </style>
</head>
<body class="body-2">
  <div class="header">
    <div class="w-row">
      <div class="w-col w-col-1"></div>
      <div class="w-col w-col-2"><img src="images/Group-22.png" width="100" alt="" class="image"></div>
      <div class="w-col w-col-6">
        <div class="white">Showing an Analysis of the Debate:</div>
        <h1 class="header-title"><?php echo $title ?></h1>
      </div>
      <div class="w-col w-col-2">
        <div class="white right">Overall Acceptability Score:</div>
        <h2 class="white score"><?php echo $acceptabilityDegree ?></h2>
      </div>
      <div class="w-col w-col-1"></div>
    </div>
  </div>
  <div class="score w-clearfix">
    <div class="con" style="width:<?php echo $percent ?>%;"></div>
  </div>
 
      <script src="//www.amcharts.com/lib/4/core.js"></script>
      <script src="//www.amcharts.com/lib/4/charts.js"></script>
      <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
      <script src="//www.amcharts.com/lib/4/plugins/forceDirected.js"></script>
      <div id="chartdiv"></div>
      
      <script id="rendered-js">
        /**
      * ---------------------------------------
      * This demo was created using amCharts 4.
      *
      * For more information visit:
      * https://www.amcharts.com/
      *
      * Documentation is available at:
      * https://www.amcharts.com/docs/v4/
      * ---------------------------------------
      */
      
      am4core.useTheme(am4themes_animated);
      
      var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
      var series = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());
      
      series.dataSource.url = "argument.json";
      
      series.dataFields.color = "color_toMain";
      series.dataFields.value = "viewableScore";
      series.dataFields.description = "description";
      series.dataFields.name = "title";
      series.dataFields.children = "childs";
      series.nodes.template.tooltipText = "{title}, {acceptabilityDegree}";
      series.nodes.template.fillOpacity = 1;
      
      series.manyBodyStrength = -20;
      
      series.tooltip.label.maxWidth = 400;
      series.tooltip.label.wrap = true;
      series.links.template.strokeWidth = 5;
      series.links.template.strokeOpacity = 0.2;
      series.links.template.distance = 1.5;
      
      series.nodes.template.label.text = "";
      series.fontSize = 10;
      series.minRadius = 1;
      series.maxRadius = 40;
      
      </script>
    

  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>