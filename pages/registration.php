<html lang="it">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Sito pensato per gli arbitri e per la crezione di referti."> 
  <meta name="keywords" content="arbitro, referto, partita, goals, ammonito, espulso, fallo.">
  
	<title>Registrazione</title>
	<link rel="icon" href="../assets/immagini/fischietto.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../assets/css/registrationStyle.css">
	<script src="../assets/js/checkDataRegistration.js"></script>

</head>

<body>

	<?php
	require('../backend/checkDataRegistration.php');
	include('../includes/header.php');

	?>


	<!--Invio dei dati-->
	<div class="contents">
		<div class="titleContainer">
			<h2>Inserisci i tuoi dati per registrarti</h2>
		</div>

		<div class="container">

			<div class="red">
				<h2>Errore di registrazione</h2>
				<img src="../assets/immagini/cartellinoRosso.png" alt="red">
			</div>

			<div class="registrationArea">

				<form id="registrationForm" method="post" action="./registration.php" onsubmit="return validateAll()">

					<p>
						<label for="name">Nome
							<input id="name" type="text" name="name" required value="<?php echo $name ?>" 
							placeholder="Mario"/>
						</label>

					</p>

					<p>
						<label for="surname">Cognome
							<input id="surname" type="text" name="surname" required value="<?php echo $surname ?>" 
							placeholder="Rossi"/>
						</label>
					</p>

					<p>
						<label for="taxIdCode">Codice fiscale
							<input id="taxIdCode" type="text" name="taxIdCode" required value="<?php echo $taxIdCode ?>"
								placeholder="RSSMRA80A01H501Z" />
						</label>
					</p>

					<p>
						<label for="email">Email
							<input id="email" type="email" name="email" required value="<?php echo $email ?>"
								placeholder="mr@gmail.com" />
						</label>
					</p>


					<p>
						<label for="username">Username
							<input id="username" type="text" name="username" required value="<?php echo $username ?>" 
							placeholder="mrss03"/>
						</label>
					</p>
					<p>
						<label for="password">Password
							<input id="pass1" type="password" name="password" required value="<?php echo $password ?>" />
						</label>

					</p>

					<p>
						<label for="passwordConfirm">Conferma password
							<input id="pass2" type="password" name="passwordConfirm" required
								value="<?php echo $passwordConfirm ?>" />
						</label>

					</p>
					<p>
						<input type="submit" name="send" value="Invia" class="sendData" />
					</p>
				</form>

				<p id="submit">Vuoi diventare un arbitro? <a href="./request.html">Unisciti a noi!</a></p>

			</div>



		</div>
	</div>




</body>
	<?php include('../includes/footer.html'); ?>
</html>

<?php
function exist($valore, $campo)
{
	require "../backend/conn.php";


	$sql = "SELECT $campo FROM arbitro WHERE $campo=$1";
	$ret = pg_query_params($db, $sql, array($valore));

	if (!$ret) {
		$message = "Oops si è verificato un errore";
		header("Location: ./error.php?message=" . $message . "&redirect=./pages/homepage.php");
		exit();

	} else {

		if ($row = pg_fetch_assoc($ret)) {
			return true;
		} else { 
			return false;
		}
	}
	pg_close($db);
}

function insert_utente($username, $email, $name, $surname, $password, $error)
{
	require "../backend/conn.php"; //connessione
	$hash = password_hash($password, PASSWORD_DEFAULT);


	
	if (!$error) {
		$sql = "INSERT INTO arbitro(username, email, nome, cognome, password) VALUES($1, $2, $3, $4, $5)";
		$prep = pg_prepare($db, "insertUser", $sql);
		$ret = pg_execute($db, "insertUser", array($username, $email, $name, $surname, $hash));

		if (!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		} else {
			return true;
		}
	} else {
		echo "<script type='text/javascript'> alert('Non è stato possibile effettuare la registrazione'); </script>";
	}


	pg_close($db);
}
?>

