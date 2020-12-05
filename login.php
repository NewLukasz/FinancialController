<?php
	session_start();
	if(isset($_SESSION['loggedInUserId'])){
		header('Location: dashboard.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">

	<head>
	
		<meta charset="utf-8">
		<title>Login - Financial Controller</title>
		<meta name="description" content="Financial Controller is a web application which help you to control your money flow and show on which target you spend most of you money. By this way you can make an aware decision that you follow the right way.">
		<meta name="keywords" content="money, cash, saving, control, finance, financial, spend, balance, month balance, year balance">
		<meta name="author" content="Lukasz Kilijanski">
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/fontello.css">
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
						<li class="nav-item list-inline-item active">
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
			<form class="loginAndRegisterForm" action="loginProcess.php" method="post">
			  <div class="form-group">
				<label>Type your user name:</label>
				
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-user"></i></span>
				  </div>
				  <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username"  <?php if(isset($_SESSION['badAttemptLogin'])) echo 'value="'.$_SESSION['badAttemptLogin'].'"' ; ?>>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label>Type your password:</label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-lock"></i></span>
				  </div>
				  <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Password">
				</div>
			  </div>
			  <div class="form-check">
				<input type="checkbox" class="form-check-input">
				<label class="form-check-label">Remember me</label>
			  </div>
<?php
if(isset($_SESSION['badAttemptLogin'])){
	echo '<span class="errorNotyfication">Wrong user data inserted.</span>';
	unset($_SESSION['badAttemptLogin']);
}
?>
			  <button type="submit" class="btn btn-primary btn-block mt-2">Login</button>
			</form>
		</main>
		<footer>
			financialController.com &copy 2020
		</footer>
	</body>
	
	
	
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
</html>