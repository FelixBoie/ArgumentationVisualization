<?php
error_reporting(0);
$question_url = "https://www.kialo.com/2629";
$level = 0;

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
runArgument($question_url, $level);

function runArgument($question_url, $level) {
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
    echo $title;
    echo $url = substr(explode('active=', $argument['url'], 2)[1],1);

    $arguments = $decode['mainEntity']['suggestedAnswer'];
    foreach ($arguments as $argument) {
        $text = $argument['text'];
        $title = substr($text,5);
        echo "Title: $title <br>";
        $procon = substr($text, 0,3);
        echo "Status: $procon <br>";
        $score = $argument['upvoteCount'];
        echo "Score: $score <br>";
        $reference = substr(explode('active=', $argument['url'], 2)[1],1);
        echo "Reference: https://www.kialo.com/$reference  <br><br>";

        // runArgument("https://www.kialo.com/" + $reference, 1);
    }
}




?>
