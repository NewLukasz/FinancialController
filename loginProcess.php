<?php
session_start();

if(isset($_SESSION['loggedInUserId'])){
	header('Location: dashboard.php');
	exit();
}

if( isset($_POST['username'])){
	$username=filter_input(INPUT_POST,'username');
	$password=filter_input(INPUT_POST,'password');
	
	require_once "database.php";
	
	$userQuery = $db->prepare('SELECT idUser,password FROM users WHERE users.username=:username');
	$userQuery->bindValue(':username',$username, PDO::PARAM_STR);
	$userQuery->execute();
	
	$user=$userQuery->fetch();		//result is asociative array
	if($user && password_verify($password,$user['password'])){
		$_SESSION['loggedInUserId'] = $user['idUser'];
		$idUser=$user['idUser'];
		unset($_SESSION['badAttemptLogin']);
		$sourcesOfIncomeQuery=$db->query("SELECT idIncomeCategory FROM incomecategorywithuser WHERE userId='$idUser'");
		$sourcesOfIncome=$sourcesOfIncomeQuery->fetchAll();
		$sourcesOfIncomeLoaded=[];
		foreach($sourcesOfIncome as $sourceOfIncome){
			array_push($sourcesOfIncomeLoaded,$sourceOfIncome['idIncomeCategory']);
		}
		$_SESSION['loadedSourcesOfIncome']=$sourcesOfIncomeLoaded;
		header('Location: dashboard.php');	
	}else{
		$_SESSION['badAttemptLogin'] = $username;
		header('Location: login.php');
		exit();
	}
	
}else{
	header('Location:login.php');
	exit();
}
?>