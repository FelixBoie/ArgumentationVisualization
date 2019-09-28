<?php
error_reporting(0);
$question_url = "https://www.kialo.com/2629";
$level = 0;
$argObj = [];

$parts = explode("-",$question_url);
//break the string up around the "/" character in $mystring

$dependency = 0;

$argNr = 0;

$mystring = end($parts);
//grab the first part

echo $mystring;

echo "<br><br>";
$argObj2 = json_decode(json_encode(runArgument($question_url, $dependecy, $level, $argNr)));
echo $argObj2;

echo "$obj";

function runArgument($question_url, $dependecy, $level, $argNr) {
    $data = file_get_contents($question_url);

    // short version of same regex
    $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';

    // $matchcount = preg_match_all($pattern_long, $data, $matches);
    $matchcount = preg_match_all($pattern, $data, $matches);
    echo("<pre>\n");
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
        $myObj->title = substr($text,5);
        $myObj->procon = substr($text, 0,3);
        $myObj->score = $argument['upvoteCount'];
        $myObj->reference = substr(explode('active=', $argument['url'], 2)[1],1);
        $myObj->answerCount = sizeOf($childs);
        $myObj->calculatedScore = 0;
        $myObj->mined = 0;
        $outerChild[$argNr] = json_decode(json_encode(runArgument("https://www.kialo.com/$myObj->reference", $dependecy, $level, $argNr)));
        $myObj->childs = $outerChild;
        $argNr++;
    }
    $argObj->childs = json_decode(json_encode($myObj));
    echo json_encode($argObj);
    echo "<br>";
    return json_decode(json_encode($argObj));   
}
?>
