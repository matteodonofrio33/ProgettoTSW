<html lang="it">
<head>
	<title>Login</title>
	<link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../assets/css/loginStyle.css">
</head>
<body>


    <div class="titleContainer">
        <h2>La prima piattaforma per gli arbitri online</h2>
    </div>

<div class="loginArea"> 
    
	<form method="post" action="../backend/loginManager.php">
        <h3> Inserire i dati di accesso </h3>
		<p>
		<label for="username">Username
			<input type="text" name="username" id="username" required onchange="validate(this)"/>
		</label>
		</p>
		<p>
		<label for="password">Password
			<input type="password" name="password" id="password" required onchange="validate(this)"/>
		</label>

		</p>
		<p>
		<input type="submit" name="send" value="Login" class="login"/>
		</p>
	</form>

	<p id="submmit">Sei un arbitro ma non hai un account? <a href="../pages/registration.php">Registrati!</a></p>

</div>





</body>
<?php include('../includes/footer.html'); ?>
</html>
