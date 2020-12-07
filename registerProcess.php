<?php

// klucz witryny 6Lcis_oZAAAAACLypmyEUzGJOqq0u3AzA24k-BAt
// tajny klucz 6Lcis_oZAAAAAAguJS9SQ96H9qJotRWKyXt9DkKp

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
	if((strlen($password1)<8)||(strlen($password2)>20)){
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
	//captcha validation
	$secret = "6Lcis_oZAAAAAAguJS9SQ96H9qJotRWKyXt9DkKp";
		
	$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
	$answer=json_decode($check);
	
	if($answer->success==false){
		$validationStatus=false;
		$_SESSION['errorCaptcha']="Confirm that you are not a bot";
	}
	
	if($validationStatus==false){
		$_SESSION['usernameAttempt']=$username;
		$_SESSION['emailAttempt']=$email;
		header('Location: register.php');
		exit();
	}
	
	unset($_SESSION['usernameAttempt']);
	unset($_SESSION['emailAttempt']);
	
	require_once 'database.php';
	
	$query=$db->prepare('INSERT INTO users VALUES(NULL,:username,:password,:email)');
	$query->bindValue(':username',$username,PDO::PARAM_STR);
	$query->bindValue(':password',$hashedPassword, PDO::PARAM_STR);
	$query->bindValue(':email',$safetyEmail,PDO::PARAM_STR);
	$query->execute();
	
	$idUserQuery=$db->query("SELECT idUser FROM users WHERE username='$username'");
	$idUserQueryResult=$idUserQuery->fetch();
	$idUser=$idUserQueryResult['idUser'];
	
	$NUMBER_OF_DEFAULT_EXPENSE_CATEGORY=17;
	for($i=1;$i<=$NUMBER_OF_DEFAULT_EXPENSE_CATEGORY;$i++){
		$query=$db->query("INSERT INTO expensecategorywithuser VALUES(NULL,'$idUser','$i')");
	}
	
	$NUMBER_OF_DEFAULT_SOURCE_OF_INCOME=4;
	for($i=1;$i<=$NUMBER_OF_DEFAULT_SOURCE_OF_INCOME;$i++){
			$query=$db->query("INSERT INTO incomecategorywithuser VALUES(NULL,'$idUser','$i')");
	}
	
	$NUMBER_OF_DEFAULT_PAYMENTS_METHODS=3;
	for($i=1;$i<=$NUMBER_OF_DEFAULT_PAYMENTS_METHODS;$i++){
		$query=$db->query("INSERT INTO paymentmethodswithuser VALUES(NULL,'$idUser','$i')");
	}
	
	header('Location: registeredSuccesful.php');
	$_SESSION['registerResult']=true;
}else{
	header('Location: index.php');
	exit();
}

?>