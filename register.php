<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<title>Proiect EWD</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="container">
		<div class="panou-stanga">
			<div class="formular">
				<div class="header">
					<h2>Înregistrare</h2>
				</div>

				<form method="post" action="register.php">
					<?php include('errors.php'); ?>
					<div class="input-group">
						<label>Utilizator</label>
						<input type="text" name="username" value="<?php echo $username; ?>">
					</div>
					<div class="input-group">
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $email; ?>">
					</div>
					<div class="input-group">
						<label>Parolă</label>
						<input type="password" name="password_1">
					</div>
					<div class="input-group">
						<label>Confirmare parolă</label>
						<input type="password" name="password_2">
					</div>
					<div class="input-group">
						<button type="submit" class="btn" name="reg_user">Înregistrează-te</button>
					</div>
				</form>
			</div>
		</div>
		<div class="panou-dreapta-register">
			<h3>
				Ești deja membru?
			</h3>
			<p>
				Te poți autentifica apăsând butonul următor:
			</p>
			<br>
			<a href="login.php"><button class="buton" id="sign-in-btn">Autentifică-te</button></a><br>
			<img src="img/register.svg" class="imaginelogin" alt="">
		</div>
	</div>
</body>

</html>