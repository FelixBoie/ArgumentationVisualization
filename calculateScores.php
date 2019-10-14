<?php
// Read JSON file
$json = file_get_contents('argument.json');

//Decode JSON
$json_data = json_decode($json,true);



//print main argument
print($json_data['title']);
echo '<br/>';

//Start with the main Argument
defArgument($json_data);

// show final json file
print_r($json_data);

//Start the Function
function defArgument(&$array) {
	
	if ($array['calculatedScore'] > -1000) {
		print("run part1");
		echo '<br/>';
		
    	return $array['calculatedScore'];
	}
	elseif (empty($array['childs'])) {
		print("run part2_works");
		echo '<br/>';
		
	    $array['calculatedScore'] = 1;  
	    return 1;
	}
	else {
		print("run part3");
		echo '<br/>';
	    // loop over all children in the next level
		$calculatedScore = 0;
	    for ($i = 0; $i < $array['answerCount']; $i++) {
	    
	        $calculatedScore += defArgument($array['childs'][$i]) * $array['childs'][$i]['score'];
	    }
	    $array['calculatedScore'] = $calculatedScore;
	    return $calculatedScore;
	}
}
