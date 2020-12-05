<?php
session_start();
if( isset($_POST['username'])){
	$username=filter_input(INPUT_POST,'username');
	$password=filter_input(INPUT_POST,'password');
	echo $username.'<br/>';
	echo $password.'<br/>';
	require_once "database.php";
}else{
	header('Location:login.php');
	exit();
}
	