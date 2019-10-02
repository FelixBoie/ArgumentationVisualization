<?php
$url =$_GET['url'];
$title=$_GET['title'];

error_reporting(0);



$level = 0;
$argObj = [];


$dependency = 0;

$argNr = 0;

$argObj2 = runArgument($url, $dependency, $level, $argNr);

$fp = fopen('test.json', 'w');
fwrite($fp, json_decode(json_encode($argObj2)));
fclose($fp);

function runArgument($question_url, $dependecy, $level, $argNr) {
  $data = file_get_contents($question_url);

  // short version of same regex
  $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

  // $matchcount = preg_match_all($pattern_long, $data, $matches);
  $matchcount = preg_match_all($pattern, $data, $matches);
  $json = $matches[1][0];

  $decode = json_decode($json, true);

  $arguments = $decode['mainEntity']['suggestedAnswer'];
  $argObj->title = $decode['mainEntity']['text'];
  $argObj->answerCount = $decode['mainEntity']['answerCount'];

  // if (sizeOf($arguments) == 0) {
  //     return $myObj;
  // }
  $outerChild = []; 
  $argNr = 0;
  foreach ($arguments as $argument) {
      
      $text = $argument['text'];
      $myObj->tile = str_replace('"', '', html_entity_decode($argument['text']));
      // $myObj->title = substr($text,5);
      $myObj->procon = substr($text, 0,3);
      if($myObj->procon == "Pro") {
          $myObj->color = "#32bf57";
      }
      else {
          $myObj->color = "#d13636";
      }
      $myObj->score = $argument['upvoteCount'];
      $myObj->reference = substr(explode('active=', $argument['url'], 2)[1],1);
      $myObj->answerCount = sizeOf($childs);
      $myObj->calculatedScore = 0;
      $myObj->mined = 0;

      $question_url2 = "https://www.kialo.com/$myObj->reference";
      $data = file_get_contents($question_url2);
      $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';
      $matchcount = preg_match_all($pattern, $data, $matches);
      $json = $matches[1][0];
      $decode = json_decode($json, true);
      $childs = $decode['mainEntity']['suggestedAnswer'];
      $myObj->answerCount = sizeOf($childs);
      $childinner = []; 
      $int = 0;
      foreach ($childs as $child) {
          $text2 = $child['text'];
          $children->title = str_replace('"', '', html_entity_decode($child['text']));
          // $children->title = substr($text2,5);
          $children->procon = substr($text2, 0,3);
          if($children->procon == "Pro") {
              $children->color = "#32bf57";
          }
          else {
              $children->color = "#d13636";
          }
          $children->score = $child['upvoteCount'];
          $children->reference = substr(explode('active=', $child['url'], 2)[1],1);
          $children->answerCount = $child['answerCount'];
          $children->calculatedScore = 0;
          $children->mined = 0;
          $childinner[$int] = json_decode(json_encode($children));
          $int++;
      }
      $myObj->childs = $childinner;
      $outerChild[$argNr] = json_decode(json_encode($myObj));
      $argNr++;
  }
  $argObj->childs = $outerChild;
  return json_encode($argObj);
}


?>
<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Sep 30 2019 11:58:39 GMT+0000 (UTC)  -->
<html data-wf-page="5d91e2cd7115f90f48dcb92a" data-wf-site="5d874fa19d77333f4bc2f3aa">
<head>
  <meta charset="utf-8">
  <title>Overview</title>
  <meta content="Overview" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/kialo-graph.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
  <style>
 #chartdiv {
  width: 100%;
  height: 600px;
}
  </style>
</head>
<body class="body">
  <div class="header">
    <div class="w-row">
      <div class="w-col w-col-1 w-col-tiny-tiny-stack w-col-small-small-stack"></div>
      <div class="column-3 w-col w-col-1 w-col-tiny-tiny-stack w-col-small-small-stack"><a href="index.html" class="w-inline-block"><img src="images/Group-21.png" width="61" alt="" class="image"></a></div>
      <div class="w-col w-col-8 w-col-tiny-tiny-stack w-col-small-small-stack">
        <h1 class="light" style="font-size:18px;"><?php

                            echo $title;


                            ?></h1>
      </div>
      <div class="w-col w-col-2 w-col-tiny-tiny-stack w-col-small-small-stack"></div>
    </div>
  </div>
  <div class="side-bar">
    <div class="summary-box w-clearfix">
      <div class="summary-pro">
        <div class="summary-pro-line"></div>
        <div class="summary-content">
          <div class="overline">Pro Score:</div>
          <h2 class="heading-8">70</h2>
        </div>
      </div>
      <div class="summary-con">
        <div class="summary-con-line"></div>
        <div class="summary-content">
          <div class="overline">Con Score:</div>
          <h2 class="heading-8">30</h2>
        </div>
      </div>
    </div>
    <div data-duration-in="300" data-duration-out="100" class="w-tabs">
      <div class="w-tab-menu">
        <a data-w-tab="Tab 1" class="tab-link-tab-1 w-inline-block w-tab-link w--current">
          <div>Pro Arguments</div>
        </a>
        <a data-w-tab="Tab 2" class="tab-link-tab-2 w-inline-block w-tab-link">
          <div>Con Arguments</div>
        </a>
      </div>
      <div class="w-tab-content">
        <div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
          <div class="text-block">These are the pro Arguments we found on Kialo with attacking arguments marked in red:</div>
        </div>
        <div data-w-tab="Tab 2" class="w-tab-pane">
          <div class="text-block-2">These are the con Arguments we found on Kialo with attacking arguments marked in red:</div>
        </div>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top:100px;">
    <div class="graph">
            <div id="chartdiv"></div>
            <br>
            <?php
            echo $argObj2;

echo "$obj";
?></div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <script src="//www.amcharts.com/lib/4/core.js"></script>
<script src="//www.amcharts.com/lib/4/charts.js"></script>
<script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//www.amcharts.com/lib/4/plugins/forceDirected.js"></script>
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

// chart.data = [{
//   "series": [{
//     "dataSource": {
//       "url": "test.json"
//     }
//   }]
// }];

series.dataSource.url = "test.json";

series.dataFields.color = "color";
series.dataFields.value = "score";
series.dataFields.description = "description";
series.dataFields.name = "title";
series.dataFields.children = "childs";
series.nodes.template.tooltipText = "{title}";
series.nodes.template.fillOpacity = 1;

series.nodes.template.label.text = "{score}";
series.fontSize = 10;
series.minRadius = 15;

    </script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
