<?php
error_reporting(0);
// $question_url = "https://www.kialo.com/2629";    
$question_url = "https://www.kialo.com/31178";
$level = 0;
$argObj = [];
$procon = 0;
$score = 0;
$reference = 0;
$calculatedScore = 0;
$getTitle = 0;

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$dependency = 0;

$argNr = 0;
$OGTitle = "null";

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
$argObj2 = runArgument($question_url, $procon, $score, $reference, $calculatedScore);
echo json_encode($argObj2);

function runArgument($question_url, $procon, $score, $reference, $calculatedScore) {
    $data = file_get_contents($question_url);
    // echo $data;
    // echo "<br>";
    // short version of same regex
    $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

    // $matchcount = preg_match_all($pattern_long, $data, $matches);
    $matchcount = preg_match_all($pattern, $data, $matches);
    echo("<pre>\n");
    $json = $matches[1][0];

    $decode = json_decode($json, true);
    if ($getTitle == 0) {
        $OGTitle = $decode['mainEntity']['text'];
        $getTitle = 1;
    }
    $argObj->title = $decode['mainEntity']['text'];
    // echo $argObj->title;
    $argObj->answerCount = $decode['mainEntity']['answerCount'];
    $argObj->procon = $procon;
    $argObj->score = $score;
    $argObj->reference = $reference;
    $argObj->calculatedScore = $calculatedScore;
    
    $outerChild = []; 
    $argNr = 0;
    $arguments = $decode['mainEntity']['suggestedAnswer'];
    foreach ($arguments as $argument) {
        $text = $argument['text'];
        $procon_inner = substr($text, 0,3);
        $score_inner = $argument['upvoteCount'];
        $reference_inner = substr(explode('active=', $argument['url'], 2)[1],1);
        $calculatedScore_inner = 0;
        $outerChild[] = runArgument("https://www.kialo.com/$reference_inner", $procon_inner, $score_inner, $reference_inner, $calculatedScore_inner);
        $argNr++;
    }
    $argObj->childs = json_decode(json_encode($outerChild));
    // var_dump($argObj);

    
    if ($argObj->answerCount == 0) {
        return $argObj;
    }
    else if ($argObj->title = $OGTitle) {
        return $argObj;
    }


    
    // echo json_encode($argObj);
    // return json_decode(json_encode($argObj));   
}
?>