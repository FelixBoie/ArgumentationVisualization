<?php
error_reporting(0);
$question_url = "https://www.kialo.com/2629";
$level = 0;

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$dependency = 0;

$argNr = 0;

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
$obj = runArgument($question_url, $dependecy, $level, $argNr);

echo "$obj";

function runArgument($question_url, $dependecy, $level, $argNr) {
    $data = file_get_contents($question_url);

    // short version of same regex
    $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

    // $matchcount = preg_match_all($pattern_long, $data, $matches);
    $matchcount = preg_match_all($pattern, $data, $matches);
    echo("<pre>\n");
    $json = $matches[1][0];

    // echo "$json";
    // echo "<br><br>";

    $decode = json_decode($json, true);
    // echo $json;

    // $title = $decode['mainEntity']['text'];
    // echo "<br>";
    // echo $title;
    // echo "<br>";
    // echo $url = substr(explode('active=', $argument['url'], 2)[1],1);

    $arguments = $decode['mainEntity']['suggestedAnswer'];
    foreach ($arguments as $argument) {
        $argNr++;
        $int = 0;
        // echo "NUMBERRRRRRR: $argNr <br>";
        $text = $argument['text'];
        $myObj->title = substr($text,5);
        $myObj->procon = substr($text, 0,3);
        $myObj->score = $argument['upvoteCount'];
        $myObj->reference = substr(explode('active=', $argument['url'], 2)[1],1);

        $nextSite = $myObj->reference;
        
        $question_url2 = "https://www.kialo.com/$myObj->reference";
        $data = file_get_contents($question_url2);
        $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';
        $matchcount = preg_match_all($pattern, $data, $matches);
        echo("<pre>\n");
        $json = $matches[1][0];
        $decode = json_decode($json, true);
        $arguments = $decode['mainEntity']['suggestedAnswer'];
        foreach ($arguments as $argument) {
            // $myObj->arg[]= runArgument("https://www.kialo.com/extSite", $dependecy, $level++ , $argNr);
           

            $text = $argument['text'];
            $myObj->arg[]->title = substr($text,5);
            $myObj->arg[]->procon = substr($text, 0,3);
            $myObj->arg[]->score = $argument['upvoteCount'];
            $myObj->arg[]->reference = substr(explode('active=', $argument['url'], 2)[1],1);
            $myJSON = json_encode($myObj);
            echo "$myJSON";
        }
        
    }
    return $myObj;
}



?>
