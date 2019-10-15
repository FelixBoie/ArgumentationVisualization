<?php
// Read JSON file
$json = file_get_contents('argument.json');

//Decode JSON
$json_data = json_decode($json,true);



//print main argument
print($json_data['title']);
echo '<br/>';

//Start with the main Argument
defArgument($json_data); // calculates scores, pahts and acceptabilityDegree
calculateRelationToMainArgument_pro($json_data); // calculates if argument is pro or con against the main argument

// show final json file
print_r($json_data);

//Start the Function
function defArgument(&$array) {
	
	if ($array['calculatedScore'] > -1000) {
		// aguments calculatedScore and path have alreay been defined
    	return $array['calculatedScore'];
	}
	elseif (empty($array['childs'])) {
		// argument is at the most outer level, calculatedScore, path and acceptabilityDegree are set to 1. 		
	    $array['calculatedScore'] = 1;
	    $array['pathCount'] = 1;
	    $array['acceptabilityDegree'] = 1;
	    return 1;
	}
	else {
		// argument needs to be defined, and is not on the most outer level
	    // loop over all children in the next level
		$calculatedScore = 0;
		$pathCount = 0;
		$proConSign = 0; // if pro, then 1 if contra then -1
	    for ($i = 0; $i < $array['answerCount']; $i++) {
	    	// negative score for counter arguments
	    	if($array['childs'][$i]['procon']=='Pro'){
	    		$proConSign = 1;
	    	} else {
	    		$proConSign = -1;
	    	}
	    	
	    	//order is important, first the calculatedScore needs to run, then the count.
	        $calculatedScore += defArgument($array['childs'][$i]) * $proConSign * $array['childs'][$i]['score']/100; // needs to be divided by 100, as scores should be between -1 and 1
	        $pathCount += $array['childs'][$i]['pathCount'];
	        
	    }
	    $array['calculatedScore'] = $calculatedScore;
	    $array['pathCount'] = $pathCount;
	    $array['acceptabilityDegree'] = 1 + $calculatedScore/$pathCount;
	    return $calculatedScore;
	}
}


//put in here the main argument
function calculateRelationToMainArgument_pro(&$array) {
	if (empty($array['childs'])){
		//should not do anything if there are no children
	} else {
		for ($i = 0; $i < $array['answerCount']; $i++) {
			if ($array['childs'][$i]['procon'] == 'Pro'){
				$array['childs'][$i]['procon_compardToMain'] = 'Pro';
				calculateRelationToMainArgument_pro($array['childs'][$i]);
				$array['childs'][$i]['color_toMain'] = "#32bf57";
			} else {
				$array['childs'][$i]['procon_compardToMain'] = 'Con';
				calculateRelationToMainArgument_con($array['childs'][$i]);
				$array['childs'][$i]['color_toMain'] = "#d13636";
			}	
		}
	}
}

function calculateRelationToMainArgument_con(&$array) {
	if (empty($array['childs'])){
		//should not do anything if there are no children
	} else {
		for ($i = 0; $i < $array['answerCount']; $i++) {
			if ($array['childs'][$i]['procon'] == 'Pro'){
				$array['childs'][$i]['procon_compardToMain'] = 'Con';
				calculateRelationToMainArgument_con($array['childs'][$i]);
				$array['childs'][$i]['color_toMain'] = "#d13636";
			} else {
				$array['childs'][$i]['procon_compardToMain'] = 'Pro';
				calculateRelationToMainArgument_pro($array['childs'][$i]);
				$array['childs'][$i]['color_toMain'] = "#32bf57";
			}
		}
	}	
}