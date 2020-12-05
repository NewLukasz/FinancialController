<?php
function checkCommaAndChangeForDot($amount){
	for($i=0;$i<strlen($amount);$i++){
		if($amount[$i]==',')$amount[$i]='.';
	}
	return $amount;
}

function checkHowManyDecimalPlacesHasAmount($amount){
	for($i=0;$i<strlen($amount);$i++){
		if($amount[$i]=='.') return strlen(substr($amount,$i+1));
	}
}

function checkIsAValidDate($myDateString){
	$pauseCounter=0;
	for($i=0;$i<strlen($myDateString);$i++){
		if($myDateString[$i]=='-') $pauseCounter++;
	}
	return ($pauseCounter==2)? (bool)strtotime($myDateString) : false;
}

//ile znakow ma komentarz
?>