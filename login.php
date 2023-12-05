<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<title>Proiect EWD</title>
</head>

<body>
	<div class="container">
		<div class="panou-stanga">
			<h3>
				Încă nu ești membru?
			</h3>
			<p>
				Te poți înregistra apăsând butonul următor:
			</p>
			<br>
			<a href="register.php"><button class="buton" id="sign-in-btn">Înregistrează-te</button></a><br>
			<img src="img/login.svg" class="imaginelogin" alt="">
		</div>
		<div class="panou-dreapta">
			<div class="header">
				<h2>Autentificare</h2>
			</div>
			<form method="post" action="login.php">
				<?php include('errors.php'); ?>
				<div class="input-group">
					<label>Utilizator</label>
					<input type="text" name="username">
				</div>
				<div class="input-group">
					<label>Parolă</label>
					<input type="password" name="password">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="login_user">Autentificare</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>