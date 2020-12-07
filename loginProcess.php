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
		
		$incomeCategoryQuery=$db->query("SELECT incomecategorywithuser.idIncomeCategory, incomecategory.incomeCategoryName FROM incomecategory, incomecategorywithuser WHERE incomecategorywithuser.userId='$idUser' AND incomecategorywithuser.idIncomeCategory=incomecategory.idIncomeCategory");
		$incomesCategories=$incomeCategoryQuery->fetchAll();
		$sourcesOfIncomeLoaded=[];
		foreach($incomesCategories as $incomeCategory){
			$sourcesOfIncomeLoaded+=[
				$incomeCategory['idIncomeCategory']=>$incomeCategory['incomeCategoryName']
			];
		}
		
		print_r($sourcesOfIncomeLoaded);
		
		$_SESSION['sourcesOfIncome']=$sourcesOfIncomeLoaded;
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