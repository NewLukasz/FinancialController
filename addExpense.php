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
		<script src="script/calendarForAddingFinancialMovements.js"></script>
    
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
			<form class="financialMovementsForm" method="post" action="addExpenseProcess.php">
			<div class="form-group">
				<label>Type cost of expense:</label>
				
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-basket"></i></span>
				 </div>
				 <input name="cost" type="text" class="form-control" placeholder="Cost" aria-label="Cost"
				 <?php
				 if(isset($_SESSION['costSetInSession'])) echo 'value="'.$_SESSION['costSetInSession'].'"';?> >
				</div>
				<?php
				if(isset($_SESSION['costError'])){
					echo '<span class="errorNotyfication">'.$_SESSION['costError'].'</span>';
					unset($_SESSION['amountError']);
				}
				?>
			</div>
			  
			  
			<div class="form-group">
				<label>Type date:</label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-calendar"></i></span>
				  </div>
				  <input  name="dateOfExpense" id="datePicker" type="text" class="form-control" aria-label="Date"
				  <?php
					if(isset($_SESSION['dateOfExpenseSetInSession'])){
						echo 'id="datePickerSession" value="'.$_SESSION['dateOfExpenseSetInSession'].'"';
					}else{
						echo 'id="datePicker"';
					}
					unset($_SESSION['dateOfExpenseSetInSession']);
					?>
				  >
				</div>
				<?php
					if(isset($_SESSION['dateError'])){
						echo '<span class="errorNotyfication">'.$_SESSION['dateError'].'</span>';
						unset($_SESSION['dateError']);
					}
				?>
			</div>
			<label>Choose payment method: </label>
			<select class="form-control mb-3" name="paymentMethod">
				<option></option>
				<?php 
				foreach($_SESSION['paymentMethods']as $method){
					if(isset($_SESSION['paymentMethodInSession'])){
						if($_SESSION['paymentMethodInSession']==$method) echo "<option selected>".$method."</option>";
						else echo "<option>".$method."</option>";
					}else{
						echo "<option>".$method."</option>";	
					}
				}
				unset($_SESSION['paymentMethodInSession']);
				?>
			</select>
			<div>
			<?php
			if(isset($_SESSION['paymentError'])){
				echo '<span class="errorNotyfication">'.$_SESSION['paymentError'].'</span>';
				unset($_SESSION['paymentError']);
			}
			?>
			</div>
			<label>Choose category: </label>
			<select class="form-control mb-3" name="expenseCategory">
				<option></option>
				<?php 
				foreach($_SESSION['categoriesOfExpense']as $category){
					if(isset($_SESSION['expenseCategoryInSession'])){
						if($_SESSION['expenseCategoryInSession']==$category) echo "<option selected>".$category."</option>";
						else echo "<option>".$category."</option>";
					}else{
						echo "<option>".$category."</option>";	
					}
				}
				unset($_SESSION['expenseCategoryInSession']);
				?>
			</select>
			<?php
			if(isset($_SESSION['categoryError'])){
				echo '<span class="errorNotyfication">'.$_SESSION['categoryError'].'</span>';
				unset($_SESSION['categoryError']);
			}
			?>
			<div class="form-group">
				<label>Comment:</label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-pencil"></i></span>
				  </div>
				  <input name="comment" type="text" class="form-control" placeholder="Comment (optional)" aria-label="Comment"<?php if(isset($_SESSION['commentOfExpenseInSession'])) echo 'value="'.$_SESSION['commentOfExpenseInSession'].'"';?>>
				</div>
				<?php
					if(isset($_SESSION['commentError'])){
						echo '<span class="errorNotyfication">'.$_SESSION['commentError'].'</span>';
						unset($_SESSION['commentError']);
					}
				?>
			</div>
			<div class="form-group">  
			  <button type="submit" class="btn btn-primary btn-block mt-2">Add expense</button>
			   <?php
					if(isset($_SESSION['expenseAdded'])){
						echo '<span  class="successNotyfication">'.$_SESSION['expenseAdded'].'</span>';
						unset($_SESSION['expenseAdded']);
					}
				?>
			</div>
			</form>
		</main>
		<footer>
			financialController.com &copy; 2020
		</footer>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
</html>