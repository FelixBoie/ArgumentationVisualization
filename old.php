<?php
$question_url = "https://www....com/2629";

$obj = runArgument($question_url, $dependecy, $level, $argNr);

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

        foreach ($arguments as $argument) {
        $myObj->reference = substr(explode('active=', $argument['url'], 2)[1],1);
        

        $question_url2 = "https://www...com/$myObj->reference";
        $data = file_get_contents($question_url2);
        $pattern = '{<script id="metadata-qapage" type="application/ld.json" data-react-helmet="true">(.*)</script>}';
        $matchcount = preg_match_all($pattern, $data, $matches);
        $json = $matches[1][0];
        $decode = json_decode($json, true);
        $childs = $decode['mainEntity']['suggestedAnswer'];
        foreach ($childs as $child) {
            $text2 = $child['text'];
            echo "$text2 <br>";
            $children->title = substr($text2,5);
            $children->procon = substr($text2, 0,3);
            $children->score = $child['upvoteCount'];
            $children->answerCount = $child['answerCount'];
            $children->calculatedScore = 0;
            $children->mined = 0;
            $myObj->child[] = $children;
        }

        echo json_encode($myObj);
        echo "<br>";
    }

}



?>
