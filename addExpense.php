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
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" type="text/css" href="jquery-ui.min.css">
		
		<script src="jquery-3.5.1.min.js"></script>
		<script src="jquery-ui.min.js"></script>
		<script src="script/calendar.js"></script>
    
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
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php"><i class="icon-home"></i>Main page</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="addIncome.php"><i class="icon-dollar"></i>Add income</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="addExpense.php"><i class="icon-basket"></i>Add expense</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-chart-pie"></i>Balance</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-wrench"></i>Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php"><i class="icon-logout"></i>Logout</a>
					</li>
				</ul>
			</div>
		
		</nav>
		</header>
	
		<main>
			<div class="financialMovementsForm">
			<div class="form-group">
				<label>Type cost of expense:</label>
				
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-basket"></i></span>
				 </div>
				 <input name="cost" type="text" class="form-control" placeholder="Cost" aria-label="Cost">
				</div>
			</div>
			  
			  
			<div class="form-group">
				<label>Type date:</label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-calendar"></i></span>
				  </div>
				  <input  name="dateOfExpense" id="datePicker" type="text" class="form-control" aria-label="Date">
				</div>
			</div>
			<label>Choose payment method: </label>
			<select class="form-control mb-3" id="PaymentMethod">
				<?php 
				foreach($_SESSION['paymentMethods']as $method){
						echo "<option>".$method."</option>";
				}
				?>
			</select>
			
			<label>Choose category: </label>
			<select class="form-control mb-3" id="expenseCategory">
				<?php 
				foreach($_SESSION['categoriesOfExpense']as $category){
						echo "<option>".$category."</option>";
				}
				?>
			</select>
			
			<div class="form-group">
				<label>Comment:</label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-pencil"></i></span>
				  </div>
				  <input name="comment" type="text" class="form-control" placeholder="Comment (optional)" aria-label="Comment">
				</div>
			</div>
			  
			  <button type="button" class="btn btn-primary btn-block mt-2">Add income</button>
			</form>
			</div>
		</main>
		<footer>
			financialController.com &copy 2020
		</footer>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
</html>