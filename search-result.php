<?php
$question = $_POST['question'];

?>

<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Sep 30 2019 11:58:39 GMT+0000 (UTC)  -->
<html data-wf-page="5d87584608e53e575beef4d2" data-wf-site="5d874fa19d77333f4bc2f3aa">
<head>
  <meta charset="utf-8">
  <title>Search Result</title>
  <meta content="Search Result" property="og:title">
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
  .text-field::placeholder {
  color: white;
}
  </style>
</head>
<body class="bluebox">
  <div class="header">
    <div class="w-row">
      <div class="w-col w-col-1"></div>
      <div class="w-col w-col-11"><a href="index.html" class="w-inline-block"><img src="images/Group-21.png" width="61" alt="" class="image"></a></div>
    </div>
  </div>
  <div class="searchbox" style="margin-top:100px;">
    <div class="w-row">
      <div class="w-col w-col-2"></div>
      <div class="w-col w-col-8">
        <p class="white" style="margin-bottom:0px;">Showing Results for:</p>

        <h1 class="white" style="margin-bottom:10px;border-bottom:2px solid #efefef" ><?php echo $question ?></h1>
        <div class="search-results">

          <?php
          $search = ' ';
          $replace = '-';
          $subject = $question;
          $finalString = str_replace($search, $replace, $subject);
          $searchterm = $finalString;
          $key = 'AIzaSyCGJLjs8SqN0-idh36R2SylmiiknnFhJGc';
          $query = 'https://www.googleapis.com/customsearch/v1?q=' . $searchterm . '&cx=012155484393896945511:ypkquhphjb5&key='. $key;



          $res = json_decode(file_get_contents($query));

          foreach ($res->items as $item) {
              $headline = substr($item->htmlTitle, 0, -7);

              ?>
              <a href="mineData.php?url=<?php echo $item->link ?>&title=<?php echo $headline ?>" class="search-result w-inline-block">
            <div class="columns-2 w-row">
              <div class="w-col w-col-10 w-col-small-10 w-col-tiny-10">
                <h3 class="heading-7 result"><?php echo $headline ?></h3>
                <p class="paragraph-3"><?php echo $item->snippet ?></p>
              </div>
              <div class="column w-col w-col-2 w-col-small-2 w-col-tiny-2"><img src="images/right-arrow.svg" height="26" alt=""></div>
            </div>
          </a>
                <?php
          }
          ?>






        </div>
      </div>
      <div class="w-col w-col-2"></div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
