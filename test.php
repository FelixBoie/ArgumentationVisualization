<?php
error_reporting(0);
$question_url = "https://www.kialo.com/2629";
$level = 0;
$argObj = [];
$procon = 0;
$score = 0;
$reference = 0;
$calculatedScore = 0;

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$dependency = 0;

$argNr = 0;

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
$argObj2 = runArgument($question_url, $procon, $score, $reference, $calculatedScore);
echo json_encode($argObj2);

function runArgument($question_url, $procon, $score, $reference, $calculatedScore) {
    $data = file_get_contents($question_url);

    // short version of same regex
    $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

    // $matchcount = preg_match_all($pattern_long, $data, $matches);
    $matchcount = preg_match_all($pattern, $data, $matches);
    echo("<pre>\n");
    $json = $matches[1][0];

    $decode = json_decode($json, true);

    
    $argObj->title = $decode['mainEntity']['text'];
    $argObj->answerCount = $decode['mainEntity']['answerCount'];
    $argObj->procon = $procon;
    $argObj->score = $score;
    $argObj->reference = $reference;
    $argObj->calculatedScore = $calculatedScore;
    echo json_encode($argObj->title);

    $arguments = $decode['mainEntity']['suggestedAnswer'];
    $outerChild = []; 
    $argNr = 0;
    foreach ($arguments as $argument) {
        $text = $argument['text'];
        $procon_inner = substr($text, 0,3);
        $score_inner = $argument['upvoteCount'];
        $reference_inner = substr(explode('active=', $argument['url'], 2)[1],1);
        $calculatedScore_inner = 0;
        $outerChild[$argNr] = runArgument("https://www.kialo.com/$reference_inner", $procon_inner, $score_inner, $reference_inner, $calculatedScore_inner);
        // echo json_encode($outerChild[$argNr]);
        $argNr++;
    }
    $argObj->childs = json_decode(json_encode($outerChild));
    echo "<br>";
    echo json_encode($argObj);
    echo "<br>";
    echo "<br>";
    return json_decode(json_encode($argObj));   
}
?>
