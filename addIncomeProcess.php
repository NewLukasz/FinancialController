<?php
session_start();

require_once 'functions.php';

if(!isset($_SESSION['loggedInUserId'])){
	header('Location: index.php');
	exit();
}

$incomeValidation=true;	

$amount=$_POST['amount'];
$amount=checkCommaAndChangeForDot($amount);
if(checkHowManyDecimalPlacesHasAmount($amount)>2){
	echo "Powyzej dwa miejsca po przecinku";
}

echo $amount."<br/>";
echo $_POST['dateOfIncome']."<br/>";
echo $_POST['sourceOfIncome']."<br/>";
echo $_POST['comment']."<br/>";

?>