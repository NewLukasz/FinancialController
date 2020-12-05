<?php
function checkCommaAndChangeForDot($amount){
	for($i=0;$i<strlen($amount);$i++){
		if($amount[$i]==','){
			$amount[$i]='.';
		}
	}
	return $amount;
}

function checkHowManyDecimalPlacesHasAmount($amount){
	for($i=0;$i<strlen($amount);$i++){
		if($amount[$i]=='.'){
			//echo $i."<br/>";
			//echo substr($amount,$i+1)."<br/>";
			return strlen(substr($amount,$i+1));
		}
	}
}
?>