<?php
// Read JSON file
$json = file_get_contents('argument.json');

//Decode JSON
$json_data = json_decode($json,true);

//Start with the first Argument
$firstArgument = $json_data['childs'][1];

defArgument($firstArgument);

print_r($json_data);

//Start the Function
function defArgument($array) {
$calculatedScore = 0;
if ($array['calculatedScore'] > -1000) {
    return $array['claculatedScore'];
}
elseif (empty($array['childs'])) {
    $array['calculatedScore'] = 1;
    return 1;
}
else {
    
    //for ($i = 0; $i < $array['calculatedScore']; $i++) {
    for ($i = 0; $i < 20; $i++) {
        $calculatedScore += defArgument($array['childs'][$i]) * $array['childs'][$i]['score'];
    }
    $array['calculatedScore'] = $calculatedScore;
    return $calculatedScore;
}
}