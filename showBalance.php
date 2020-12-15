<?php
	session_start();
	
	if(!isset($_SESSION['loggedInUserId'])){
		header('Location: index.php');
		exit();
	}
	require_once "database.php";
	
	$firstLimitDate=date("Y-m-1");
	//echo $firstLimitDate;
	$d= new DateTime($firstLimitDate);
	$secondLimitDate=$d->format('Y-m-t');
	//echo $secondLimitDate;
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
		<link rel="stylesheet" type="text/css" href="jquery-ui.min.css">	
		<link rel="stylesheet" href="main.css">
		
		<script src="jquery-3.5.1.min.js"></script>
		<script src="jquery-ui.min.js"></script>
		<script src="script/calendar.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
		<script type="text/javascript">
		  google.charts.load('current', {'packages':['table']});
		  google.charts.setOnLoadCallback(drawIncomeCategoryTable);

		  function drawIncomeCategoryTable() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Category');
			data.addColumn('number', 'Amount');
			data.addRows([
			<?php
			foreach($_SESSION['sourcesOfIncome'] as $source){
				$idOfIncomeCategory=array_search($source,$_SESSION['sourcesOfIncome']);
				$queryForAmount=$db->query("SELECT income_category_assigned_to_user_id, SUM(amount) AS sumOfAmount FROM incomes WHERE income_category_assigned_to_user_id='$idOfIncomeCategory' AND date_of_income BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
				$amount=$queryForAmount->fetch();
				$currectAmount=$amount['sumOfAmount'];
				if($amount['sumOfAmount']){
					echo "['$source',$currectAmount],";
				}
			}
			?>
			]);
			var table = new google.visualization.Table(document.getElementById('incomesCategoryTable'));
			table.draw(data, {showRowNumber: true, width: '350px'});
		  }
		  
		  
		  
		  google.charts.load('current', {'packages':['table']});
		  google.charts.setOnLoadCallback(drawExpenseCategoryTable);

		  function drawExpenseCategoryTable() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Category');
			data.addColumn('number', 'Costs');
			data.addRows([
			<?php
			foreach($_SESSION['categoriesOfExpense'] as $category){
				$idOfExpenseCategory=array_search($category,$_SESSION['categoriesOfExpense']);
				$queryForCosts=$db->query("SELECT expense_category_assigned_to_user_id, SUM(amount) AS sumOfCosts FROM expenses WHERE expense_category_assigned_to_user_id='$idOfExpenseCategory'AND date_of_expense BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
				$cost=$queryForCosts->fetch();
				$currectCost=$cost['sumOfCosts'];
				if($cost['sumOfCosts']){
					echo "['$category',$currectCost],";
				}
			}
			?>
			]);
			var table = new google.visualization.Table(document.getElementById('expensesCategoryTable'));
			table.draw(data, {showRowNumber: true, width: '350px'});
		  }
		  
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawIncomeCategoryChart);
		
		function drawIncomeCategoryChart() {

        var data = google.visualization.arrayToDataTable([
          ['Category', 'Income'],
		  <?php
			foreach($_SESSION['sourcesOfIncome'] as $source){
				$idOfIncomeCategory=array_search($source,$_SESSION['sourcesOfIncome']);
				$queryForAmount=$db->query("SELECT income_category_assigned_to_user_id, SUM(amount) AS sumOfAmount FROM incomes WHERE income_category_assigned_to_user_id='$idOfIncomeCategory' AND date_of_income BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
				$amount=$queryForAmount->fetch();
				$currectAmount=$amount['sumOfAmount'];
				if($amount['sumOfAmount']){
					echo "['$source',$currectAmount],";
				}
			}
			?>
        ]);

        var options = {
          title: 'My incomes'
        };

        var chart = new google.visualization.PieChart(document.getElementById('IncomesPiechart'));

        chart.draw(data, options);
		}
		
		
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawExpenseCategoryChart);
		
		function drawExpenseCategoryChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Expense'],
		 <?php
			foreach($_SESSION['categoriesOfExpense'] as $category){
				$idOfExpenseCategory=array_search($category,$_SESSION['categoriesOfExpense']);
				$queryForCosts=$db->query("SELECT expense_category_assigned_to_user_id, SUM(amount) AS sumOfCosts FROM expenses WHERE expense_category_assigned_to_user_id='$idOfExpenseCategory' AND date_of_expense BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
				$cost=$queryForCosts->fetch();
				$currectCost=$cost['sumOfCosts'];
				if($cost['sumOfCosts']){
					echo "['$category',$currectCost],";
				}
			}
			?>
        ]);

        var options = {
          title: 'My expenses'
        };

        var chart = new google.visualization.PieChart(document.getElementById('ExpensePiechart'));

        chart.draw(data, options);
		}
		
		
		
		  
		</script>
		
    
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
					<li class="nav-item">
						<a class="nav-link" href="addExpense.php"><i class="icon-basket"></i>Add expense</a>
					</li>
					<li class="nav-item active">
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
			<div class="container">
			
			
		<div class="d-flex justify-content-end">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
			  Change period of time
			</button>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="change period of time" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose period of time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  
	  
		<form action="showBalance.php" method="post">
			
			  
			<div class="modal-body">
			<div class="form-group">
				<label>Type date:</label>
				<div class="input-group mb-2">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-calendar"></i></span>
				  </div>
				  <input  name="fisrtLimitDate" id="datePickerFirstLimit" type="text" class="form-control" aria-label="Date">
				  
				</div>
				
				<label>Type date:</label>
				<div class="input-group mb-2">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-calendar"></i></span>
				  </div>
				  <input  name="secondLimitDate" id="datePickerSecondLimit" type="text" class="form-control" aria-label="Date">
				  
				</div>
				
			</div>
			
		
	  
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-primary " data-dismiss="modal">Save changes</button>
				<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
	  </form>
    </div>
  </div>
</div>
			</div>
			
			
			
			
			
				<div class="row p-4">
					<div class="col-lg-12">
						
						<div class="d-flex justify-content-center">
						<h1>Balance from current month</h1>
						</div>
						
					</div>
					<div class="col-lg-12">
						
						<div class="d-flex justify-content-center">
						<?php
						$idUser=$_SESSION['loggedInUserId'];
						$incomesQuery=$db->query("SELECT SUM(amount) AS sumOfIncomes FROM incomes WHERE user_id='$idUser' AND date_of_income BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
						$incomeSum=$incomesQuery->fetch();
						$expensesQuery=$db->query("SELECT SUM(amount) AS sumOfexpenses FROM expenses WHERE user_id='$idUser'AND date_of_expense BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
						$expenseSum=$expensesQuery->fetch();
						echo "Your summary of incomes is: {$incomeSum['sumOfIncomes']}zł, and summary of expenses: {$expenseSum['sumOfexpenses']}zł</br>";
						$diff=$incomeSum['sumOfIncomes']-$expenseSum['sumOfexpenses'];
						if($incomeSum['sumOfIncomes']>$expenseSum['sumOfexpenses']){
							echo "Your total income lower by expenses is: {$diff} you plan your finanses very prudently.";
						}else{
							echo "Currently your balanse in on minus. Difference beetwen incomes and expenses is: {$diff}.";
						}
						?>
						</div>
						
					</div>
					<div class="col-lg-12">
						
						<div class="d-flex justify-content-center mt-3">
						<h2>Balance of incomes and expenses in case of category below:</h2>
						</div>
						
					</div>
					
				</div>
			</div>
			
			<div class="container" style="border: 1px solid black;">
				<h3 class="d-flex justify-content-center mt-3">Incomes balance</h3>
				<div class="row p-2">
					<div class="col-lg-6 d-flex justify-content-center mt-3">
						<div id="incomesCategoryTable"></div>
					</div>
					<div class="col-lg-6 d-flex justify-content-center">
						<div id="IncomesPiechart" style="width: 500px; height: 300px;"></div>
					</div>
				</div>
			</div>
			<div class="container mt-3" style="border: 1px solid black;">
				<h3 class="d-flex justify-content-center mt-3">Expenses balance</h3>
				<div class="row p-2">
					<div class="col-lg-6 d-flex justify-content-center">
						<div id="expensesCategoryTable"></div>
					</div>
					<div class="col-lg-6 d-flex justify-content-center">
						<div id="ExpensePiechart" style="width: 500px; height: 300px;"></div>
					</div>
				</div>
			</div>
			<div class="container mt-5" style="border: 1px solid black;">
				<h3 class="d-flex justify-content-center mt-3">Below detailed balances</h3>
				<div class="row p-4">
					<div class="col-lg-6 mt-2">
						<table class="table tableWithFinancialMovemnts" style='table-layout:fixed;width:100%'>
							<thead>
								<tr><th colspan="5" style="text-align: center;" ><h2>Incomes</h2></th></tr>
								<tr><th>Nr</th><th>Amount</th> <th>Source</th> <th>Date</th> <th>Comment</th></tr>
							<thead>
							
							<?php
							$idUser=$_SESSION['loggedInUserId'];
							$incomesQuery=$db->query("SELECT amount, income_category_assigned_to_user_id, date_of_income, income_comment FROM incomes WHERE user_id='$idUser'AND date_of_income BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
							$incomes=$incomesQuery->fetchAll();
							$counter=1;
							$sourceOfIncomeNames=$_SESSION['sourcesOfIncome'];
							foreach($incomes as $income){
								$indexOfCategory=$income['income_category_assigned_to_user_id'];
								$sourceOfIncomeName=$sourceOfIncomeNames[$indexOfCategory];
								echo "<tr><td>{$counter}</td><td>{$income['amount']}<td>{$sourceOfIncomeName}</td> <td>{$income['date_of_income']}</td> <td>{$income['income_comment']}</td>";
								$counter++;
							}
							?>
						</table>
					</div>
					<div class="col-lg-6 mt-2 ">
					<table class="table tableWithFinancialMovemnts" style='table-layout:fixed;width:100%'>
							<thead>
								<tr><th colspan="6" style="text-align: center;" ><h2>Expenses</h2></th></tr>
								<tr><th >Nr</th><th>Amount</th> <th>Category</th> <th>PaymentMethod</th> <th>Date</th> <th>Comment</th></tr>
							<thead>
							<?php
							$idUser=$_SESSION['loggedInUserId'];
							$expenseQuery=$db->query("SELECT amount, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, date_of_expense, expense_comment FROM expenses WHERE user_id='$idUser'AND date_of_expense BETWEEN '$firstLimitDate' AND '$secondLimitDate'");
							$expenses=$expenseQuery->fetchAll();
							$counter=1;
							$categoryOfExpenseNames=$_SESSION['categoriesOfExpense'];
							$paymentMethodNames=$_SESSION['paymentMethods'];
							foreach($expenses as $expense){
								$indexOfCategory=$expense['expense_category_assigned_to_user_id'];
								$categoryOfExpenseName=$categoryOfExpenseNames[$indexOfCategory];
								$indexOfPaymentMethod=$expense['payment_method_assigned_to_user_id'];
								$paymentMethodName=$paymentMethodNames[$indexOfPaymentMethod];
								echo "<tr><td>{$counter}</td><td>{$expense['amount']}<td>{$categoryOfExpenseName}</td><td>{$paymentMethodName}</td> <td>{$expense['date_of_expense']}</td> <td>{$expense['expense_comment']}</td>";
								$counter++;
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</main>
		<footer>
			financialController.com &copy; 2020
		</footer>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
</html>