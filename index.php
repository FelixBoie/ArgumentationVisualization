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
$argObj2 = runArgument($question_url, $dependecy, $level, $argNr);
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
        // echo json_encode($outerChild[0]);
        echo "<br>";
        $argNr++;
    }
    $argObj->childs = $outerChild;
    return json_encode($argObj);
}
?>
