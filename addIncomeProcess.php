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
$userId=$_SESSION['loggedInUserId'];

if($incomeValidation=true){
	require_once "database.php";

	$idOfIncomeCategory=array_search($_POST['sourceOfIncome'],$_SESSION['sourcesOfIncome']);

	$query=$db->prepare('INSERT INTO incomes VALUES(NULL,:idUser,:idIncomeCategory,:amount,:dateOfIncome,:incomeComment)');
	$query->bindValue(':idUser',$userId,PDO::PARAM_INT);
	$query->bindValue(':idIncomeCategory',$idOfIncomeCategory,PDO::PARAM_INT);//tutaj moze byc problem bo wpisany jest string?
	$query->bindValue(':amount',$_POST['amount'],PDO::PARAM_STR);
	$query->bindValue(':dateOfIncome',$_POST['dateOfIncome'],PDO::PARAM_STR);
	$query->bindValue(':incomeComment',$_POST['comment'],PDO::PARAM_STR);
	$query->execute();
}



echo $amount."<br/>";
echo $_POST['dateOfIncome']."<br/>";
echo $_POST['sourceOfIncome']."<br/>";
echo $_POST['comment']."<br/>";

?>