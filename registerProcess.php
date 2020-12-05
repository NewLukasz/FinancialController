<?php

if(isset($_POST['email'])){
	session_start();
	$validationStatus=true;
	$username=$_POST['username'];
	//username validation
	if((strlen($username)<3)||(strlen($username)>20)){
			$validationStatus=false;
			$_SESSION['errorUsername']="Username length must be between 3 and 20 signs";
	}
	
	if(ctype_alnum($username)==false){
			$validationStatus=false;
			$_SESSION['errorUsername']="Username can contain only letters and digits";
	}
	//email validation
	$email=$_POST['email'];
	$safetyEmail=filter_var($email,FILTER_SANITIZE_EMAIL);
	if((filter_var($safetyEmail, FILTER_VALIDATE_EMAIL)==false)||($email!=$safetyEmail)){
			$validationStatus=false;
			$_SESSION['errorEmail']="Insert correct e-mail adress";
	}
	//password validation
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	if((strlen($password1)<8)||(strlen($haslo1)>20)){
		$validationStatus=false;
		$_SESSION['errorPassword']="Password length must be between 8 and 20 signs";
	}
	if($password1!=$password2){
		$validationStatus=false;
		$_SESSION['errorPassword']="Inserted passwords must be the same";
	}
	$hashedPassword=password_hash($password1,PASSWORD_DEFAULT);
	
	//termsCheckbox validation
	if(!isset($_POST['termsAndConditions']))
	{
		$validationStatus=false;
		$_SESSION['errorTermsAndConditions']="Please accept terms and conditions";
	}
	
	
	if($validationStatus==false){
		header('Location: register.php');
	}
}else{
	header('Location: index.php');
	exit();
}

?>