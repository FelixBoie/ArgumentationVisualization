<?php
error_reporting(0);
// $question_url = "https://www.kialo.com/2629";    
$question_url = "https://www.kialo.com/27064";
ini_set('max_execution_time', 3000);
$level = 0;
$argObj = [];
$procon = 0;
$score = 0;
$reference = 0;
$calculatedScore = 0;
$getTitle = 0;
$count = 0;
$level = 0;
$maxLevel = 5;

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$dependency = 0;

$argNr = 0;
$OGTitle = "null";

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
$argObj2 = runArgument($question_url, $procon, $score, $reference, $calculatedScore, $level, $maxLevel);
echo json_encode($argObj2);

function runArgument($question_url, $procon, $score, $reference, $calculatedScore, $level, $maxLevel) {
    $level++;

    $data = file_get_contents($question_url);
    $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

    $matchcount = preg_match_all($pattern, $data, $matches);
    echo("<pre>\n");
    $json = $matches[1][0];

    $decode = json_decode($json, true);
    if ($getTitle == 0) {
        $OGTitle = str_replace('"', '', html_entity_decode($decode['mainEntity']['text']));
        $getTitle = 1;
    }
    $argObj->title = str_replace('"', '', html_entity_decode($decode['mainEntity']['text']));
    $argObj->answerCount = $decode['mainEntity']['answerCount'];
    $argObj->procon = $procon;
    if($argObj->procon == "Pro") {
        $argObj->color = "#32bf57";
    }
    else {
        $argObj->color = "#d13636";
    }
    $argObj->score = $score;
    $argObj->reference = $reference;
    $argObj->calculatedScore = $calculatedScore;
    
    $outerChild = []; 
    $argNr = 0;
    $arguments = $decode['mainEntity']['suggestedAnswer'];
    if ($level < $maxLevel) {
        foreach ($arguments as $argument) {
            $text = str_replace('"', '', html_entity_decode($argument['text']));
            $procon_inner = substr($text, 0,3);
            
            $score_inner = $argument['upvoteCount'];
            $reference_inner = substr(explode('active=', $argument['url'], 2)[1],1);
            $calculatedScore_inner = 0;
            $outerChild[] = runArgument("https://www.kialo.com/$reference_inner", $procon_inner, $score_inner, $reference_inner, $calculatedScore_inner, $level, $maxLevel);
            $argNr++;
        }
        $argObj->childs = json_decode(json_encode($outerChild));
    }
    return $argObj;


    
    // echo json_encode($argObj);
    // return json_decode(json_encode($argObj));   
}
?>