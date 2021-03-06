<?php
	session_start();
	if(!isset($_SESSION['loggedInUserId'])){
		header('Location: index.php');
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
		<link rel="stylesheet" href="css/fontello.css" type="text/css">
		<link rel="stylesheet" href="main.css">
    
	</head>

	<body>
		<header>
			<div id="logo">
				<a href="index.php"><img class="img-fluid my-3 d-block mx-auto" src="images/logo.png"></a>
			</div>
			<nav class="navbar navbar-dark bg-navbar navbar-expand-lg">
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mx-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#"><i class="icon-home"></i>Main page</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addIncome.php"><i class="icon-dollar"></i>Add income</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addExpense.php"><i class="icon-basket"></i>Add expense</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="showBalance.php"><i class="icon-chart-pie"></i>Balance</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-wrench"></i>Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php"><i class="icon-logout"></i>Logout</a>
					</li>
				</ul>
			</div>
		
		</nav>
		</header>
	
		<main>
			<article>
				<div class="container">
					<div class="row p-4">
						<div class="col-lg-6 mt-2">
							<a class="btn btn-primary btn-block" href="addIncome.php" role="button"><i class="icon-dollar"></i>Add income</a>
							<a class="btn btn-primary btn-block" href="addExpense.php" role="button"><i class="icon-basket"></i>Add expense</a>
							<a class="btn btn-primary btn-block" href="showBalance.php" role="button"><i class="icon-chart-pie"></i>Balance</a>
							<a class="btn btn-primary btn-block" href="dashboard.php" role="button"><i class="icon-wrench"></i>Settings</a>
							<a class="btn btn-primary btn-block" href="logout.php" role="button"><i class="icon-logout"></i>Logout</a>
						</div>
						<div class="col-lg-6 mt-2">
							<img class="img-fluid d-block mx-auto" alt="Growing tree in saving money" src="images/letyoursavingsgrow.png">
						</div>
					</div>
				</div>
			</article>
		</main>
		<footer>
			financialController.com &copy; 2020
		</footer>
	</body>
	
	
	
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
</html>