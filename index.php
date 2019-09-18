<?php

$question_url = "https://www.kialo.com/2629.92 ";

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";

$data = file_get_contents($question_url);


// short version of same regex
$pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

// $matchcount = preg_match_all($pattern_long, $data, $matches);
$matchcount = preg_match_all($pattern, $data, $matches);
echo("<pre>\n");
$json = $matches[1][0];

$decode = json_decode($json, true);
echo $json;

$title = $decode['mainEntity']['text'];
echo $title + " ";
echo $url = substr(explode('active=', $argument['url'], 2)[1],1);

$arguments = $decode['mainEntity']['suggestedAnswer'];
foreach ($arguments as $argument) {
    $text = $argument['text'];
    $title = substr($text,5);
    echo "$title <br>";
    $procon = substr($text, 0,3);
    echo "$procon <br>";
    $score = $argument['upvoteCount'];
    echo "$score <br>";
    $reference = substr(explode('active=', $argument['url'], 2)[1],1);
    echo "$reference <br>";

}




?>
