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
		<script src="script/calendarForAddingFinancialMovements.js"></script>
		
		
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
		
		<script type="text/javascript">
		
						  
						  
						  google.charts.load('current', {'packages':['table']});
						  google.charts.setOnLoadCallback(drawTable);
						  function drawTable() {
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Name');
							data.addColumn('number', 'Salary');
							data.addColumn('boolean', 'Full Time Employee');
							data.addRows([
							  ['Mike',  {v: 10000, f: '$10,000'}, true],
							  ['Jim',   {v:8000,   f: '$8,000'},  false],
							  ['Alice', {v: 12500, f: '$12,500'}, true],
							  ['Bob',   {v: 7000,  f: '$7,000'},  true]
							]);

							var table = new google.visualization.Table(document.getElementById('table_div'));

							table.draw(data, {showRowNumber: true, width: '70%', height: '70%'});
						  }
						 
						 
						 google.charts.load('current', {'packages':['table']});
						  google.charts.setOnLoadCallback(drawIncomeTable);
						  function drawIncomeTable() {
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Name');
							data.addColumn('number', 'Salary');
							data.addColumn('boolean', 'Full Time Employee');
							data.addRows([
							  ['Mike',  {v: 10000, f: '$10,000'}, true],
							  ['Jim',   {v:8000,   f: '$8,000'},  false],
							  ['Alice', {v: 12500, f: '$12,500'}, true],
							  ['Bob',   {v: 7000,  f: '$7,000'},  true]
							]);

							var table = new google.visualization.Table(document.getElementById('incomeTable'));

							table.draw(data, {showRowNumber: true, width: '70%', height: '70%'});
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
					<li class="nav-item active">
						<a class="nav-link" href="addIncome.php"><i class="icon-dollar"></i>Add income</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addExpense.php"><i class="icon-basket"></i>Add expense</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-chart-pie"></i>Balance</a>
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
				<div class="row p-4">
					<div class="col-lg-12">
						
						<div class="d-flex justify-content-center">
						<h1>Balance from current month</h1>
						</div>
						
					</div>
					<div class="col-lg-6 mt-2">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row p-4">
					<div class="col-lg-6">
						
						<div class="d-flex justify-content-center" id="incomeTable"></div>
						
					</div>
					<div class="col-lg-6 mt-2">
					
						<div class="d-flex justyfi-content-center" id="table_div"></div>
					
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row p-4">
					<div class="col-lg-6">
						Tutaj pierwszy wykres
					</div>
					<div class="col-lg-6">
						W tym miejscy drugi wykres
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