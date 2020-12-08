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
	
	$userQuery = $db->prepare('SELECT id,password FROM users WHERE username=:username');
	$userQuery->bindValue(':username',$username, PDO::PARAM_STR);
	$userQuery->execute();
	
	$user=$userQuery->fetch();		//result is asociative array
	if($user && password_verify($password,$user['password'])){
		$_SESSION['loggedInUserId'] = $user['id'];
		$idUser=$user['id'];
		unset($_SESSION['badAttemptLogin']);
		
		
		
		$incomeCategoryQuery=$db->query("SELECT name FROM incomes_category_assigned_to_users WHERE user_id='$idUser'");
		$incomesCategories=$incomeCategoryQuery->fetchAll();
		$_SESSION['sourcesOfIncome']=[];
		foreach($incomesCategories as $incomeCategory){
			array_push($_SESSION['sourcesOfIncome'],$incomeCategory['name']);		
		}				
		
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