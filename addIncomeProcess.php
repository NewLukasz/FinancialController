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
	$incomeValidation=false;
	echo "Powyzej dwa miejsca po przecinku<br/>";
}

if(!is_numeric($amount)){
	$incomeValidation=false;
	echo "Podana wartosc to nie liczba<br/>";
}

$dateOfIncome=$_POST['dateOfIncome'];
if(!checkIsAValidDate($dateOfIncome)){
	$incomeValidation=false;
	echo "Podana data jest nieprawidlowa";
}

$comment=$_POST['comment'];
if(!checkLengthOfComment($comment)){
	$incomeValidation=false;
	echo "Podany komentarz jest zbyt długi";
}

echo $amount."<br/>";
echo $_POST['dateOfIncome']."<br/>";
echo $_POST['sourceOfIncome']."<br/>";
echo $_POST['comment']."<br/>";

?>