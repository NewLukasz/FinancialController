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
	$_SESSION['amountError']="Your amount has more that 2 digit after coma";
}

if(!is_numeric($amount)){
	$incomeValidation=false;
	$_SESSION['amountError']="Your amount is not a number";
}

$dateOfIncome=$_POST['dateOfIncome'];
if(!checkIsAValidDate($dateOfIncome)){
	$incomeValidation=false;
	$_SESSION['dateError']="You typed wrong data. Please remeber that format is: YYYY-MM-DD";
}

$comment=$_POST['comment'];
if(!checkLengthOfComment($comment)){
	$incomeValidation=false;
	$_SESSION['commentError']="Your comment is too long you can insert up to 50 signs";
}
$userId=$_SESSION['loggedInUserId'];

if($incomeValidation==true){
	require_once "database.php";

	$idOfIncomeCategory=array_search($_POST['sourceOfIncome'],$_SESSION['sourcesOfIncome']);

	$query=$db->prepare('INSERT INTO incomes VALUES(NULL,:idUser,:idIncomeCategory,:amount,:dateOfIncome,:incomeComment)');
	$query->bindValue(':idUser',$userId,PDO::PARAM_INT);
	$query->bindValue(':idIncomeCategory',$idOfIncomeCategory,PDO::PARAM_INT);
	$query->bindValue(':amount',$amount,PDO::PARAM_STR);
	$query->bindValue(':dateOfIncome',$_POST['dateOfIncome'],PDO::PARAM_STR);
	$query->bindValue(':incomeComment',$_POST['comment'],PDO::PARAM_STR);
	$query->execute();
}



echo $amount."<br/>";
echo $_POST['dateOfIncome']."<br/>";
echo $_POST['sourceOfIncome']."<br/>";
echo $_POST['comment']."<br/>";

?>