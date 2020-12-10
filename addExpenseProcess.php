<?php
session_start();

require_once 'functions.php';

if(!isset($_SESSION['loggedInUserId'])){
	header('Location: index.php');
	exit();
}

$_SESSION['paymentMethodInSession']=$_POST['paymentMethod'];
$_SESSION['expenseCategoryInSession']=$_POST['expenseCategory'];

$expenseValidation=true;

$cost=$_POST['cost'];
$cost=checkCommaAndChangeForDot($cost);

if(checkHowManyDecimalPlacesHasAmount($cost)>2){
	$expenseValidation=false;
	$_SESSION['costError']="Your cost has more that 2 digit after coma";
}

if(!is_numeric($cost)){
	$expenseValidation=false;
	$_SESSION['costError']="Your cost is not a number";
}

$_SESSION['costSetInSession']=$cost;

$dateOfExpense=$_POST['dateOfExpense'];
$_SESSION['dateOfExpenseSession']=$dateOfExpense;
if(!checkIsAValidDate($dateOfExpense)){
	$expenseValidation=false;
	$_SESSION['dateError']="You typed wrong data. Please remeber that format is: YYYY-MM-DD";
}

if(!$_POST['expenseCategory']){
	$expenseValidation=false;
	$_SESSION['categoryError']="Please choose category";
}

if(!$_POST['paymentMethod']){
	$expenseValidation=false;
	$_SESSION['paymentError']="Please choose payment method";
}

$comment=$_POST['comment'];
if(!checkLengthOfComment($comment)){
	$expenseValidation=false;
	$_SESSION['commentError']="Your comment is too long you can insert up to 50 signs";
}

$_SESSION['commentOfExpenseInSession']=$comment;
$userId=$_SESSION['loggedInUserId'];


if($expenseValidation==true){
	require_once "database.php";

	$idOfExpenseCategory=array_search($_POST['expenseCategory'],$_SESSION['categoriesOfExpense']);
	$idOfPaymentMethod=array_search($_POST['paymentMethod'],$_SESSION['paymentMethods']);

	$query=$db->prepare('INSERT INTO expenses VALUES(NULL,:idUser,:idExpenseCategory, :idPaymentMethod, :cost,:dateOfExpense,:expenseComment)');
	$query->bindValue(':idUser',$userId,PDO::PARAM_INT);
	$query->bindValue(':idExpenseCategory',$idOfExpenseCategory,PDO::PARAM_INT);
	$query->bindValue(':idPaymentMethod',$idOfPaymentMethod,PDO::PARAM_INT);
	$query->bindValue(':cost',$cost,PDO::PARAM_STR);
	$query->bindValue(':dateOfExpense',$_POST['dateOfExpense'],PDO::PARAM_STR);
	$query->bindValue(':expenseComment',$_POST['comment'],PDO::PARAM_STR);
	$query->execute();
	
	$_SESSION['expenseAdded']="Expense added successfully.";

	unset($_SESSION['commentOfExpenseInSession']);
	unset($_SESSION['dateOfExpenseSession']);
	unset($_SESSION['costSetInSession']);
	unset($_SESSION['expenseCategoryInSession']);
	unset($_SESSION['paymentMethodInSession']);	
}
header("Location: addExpense.php");
?>