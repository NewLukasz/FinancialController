<?php
	session_start();
	if(isset($_SESSION['loggedInUserId'])){
		header('Location: dashboard.php');
		exit();
	}
	if(!isset($_SESSION['registerResult'])){
		header('Location:index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">

	<head>
	
		<meta charset="utf-8">
		<title>Financial Controller</title>
		<meta name="description" content="Financial Controller is a web application which help you to control your money flow and show on which target you spend most of you money. By this way you can make an aware decision that you follow the right way.">
		<meta name="keywords" content="money, cash, saving, control, finance, financial, spend, balance, month balance, year balance">
		<meta name="author" content="Lukasz Kilijanski">
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="main.css">
		<script src="skrypt.js"></script>
    
	</head>

	<body>
		<header>
			<div id="logo">
				<a href="index.php"><img class="img-fluid my-3 d-block mx-auto" src="images/logo.png"></a>
			</div>
			<nav class="navbar navbar-dark bg-navbar">
				<ul class="navbar-nav mx-auto">
					<ul class="list-inline">
						<li class="nav-item list-inline-item ">
							<a class="nav-link" href="login.php"> Login </a>
						</li>
						<li class="nav-item list-inline-item">
							<a class="nav-link" href="register.php"> Register </a>
						</li>
					</ul>
				</ul>
			</nav>
		</header>
	
		<main>
			<article>
				<div class="container">
					<div class="row p-4">
						<div class="col-lg-6 text-justify">
							<h1 class="text-center">Register completed! Congratulation!</h1>
							<p class="text-center my-3">
							You made first step to your better life!<span class="font-weight-bold"> Keep going! </span>
							</p>
							
							<a class="btn btn-success btn-block my-4" href="login.php" role="button">Login!</a>
							

							<h1 class="lead">5 reason why - you should do it</h1>
							
							<ol class="text-justify mx-4">
								<li>To be albe to follow your dreams!</li>
								<li>To provide financial calm to your family.</li>
								<li>To be safe in case of emergency situaction.</li>
								<li>To be financial independent and be able to quit your job if you want.</li>
								<li>Because of life is to short to spend entite lifetime in work.</li>
							</ol>
						</div>
						<div class="col-lg-6 mt-2">
							<img class="img-fluid d-block mx-auto" src="images/letyoursavingsgrow.png">
						</div>
					</div>
				</div>
			</article>
		</main>
		<footer>
			financialController.com &copy 2020
		</footer>
	</body>
	
	
	
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
</html>