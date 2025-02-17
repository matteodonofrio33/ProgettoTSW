<html>
<head>
	<title>Gestione Login</title>
	<style>
		body {
			background-color: black;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.container {
			width: 500px;
			margin: 0 auto;
			text-align: center;
			
		}

		

		img {
			margin: 0 auto;
			width: 300px;
		}
		h1 {
			color: red;
		}
		
	</style>
	
</head>
<body>
	<div class="container">

	
	<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

		


		if($_POST['username'] || $_POST['password']){
			$username =  $_POST['username'];
			$password =  $_POST['password'];
			
			//chiama la funzione get_pwd che controlla
			//se username esiste nel DB. Se esiste, restituisce la password (hash), altrimenti restituisce false.
			require 'conn.php';
			$hash = get_pwd($username,$db);
			$hash = trim($hash); //rimuove spazi vuoti
			
			if(!$hash){			
				echo "
					<h1> L'utente $username non esiste. <a href=\"../pages/login.html\">Riprova</a></h1>
					<img src='../assets/immagini/cartellinoRosso.png' alt='loginErrorImage'>;
				";
					
			}
			else{
				

				if(password_verify($password, $hash)){
					// Avvia la sessione
					session_start();
					$_SESSION['username'] = $username;
				
					// Reindirizza l'utente alla pagina areaPersonaleArbitro.html
					header("Location: ../pages/homepage.php");
					exit(); 
				}				
				else{
					//Visualizza messaggio di errore
					//echo 'Username o password errati. <a href="../pages/login.html">Riprova</a>';
					echo "
						<h1> Username o password errati. <a href=\"../pages/login.html\">Riprova</a></h1>
						<img src='../assets/immagini/cartellinoRosso.png' alt='loginErrorImage'>;
						
					";
					
					
				}
			}
		}
		else{
			
			echo "<h1>ERRORE: username o password non inseriti <a href=\"../pages/login.html\">Riprova</a></h1>";
			exit();
		}

	?>
	</div>
</body>
</html>

<?php
function get_pwd($username, $db){
		require 'conn.php';
		$sql = "SELECT password FROM arbitro WHERE username=$1;";
		$prep = pg_prepare($db, "sqlPassword", $sql); #preparando la query così si evita sql injection
		$ret = pg_execute($db, "sqlPassword", array($username)); #esecuzione della query pianificata
		if(!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		}
		
		else{
			if ($row = pg_fetch_assoc($ret)){
				
				$password = $row['password'];
				return $password; //questa è la password con hash
			}
			else{
				
				return false;
			}
   	}
		pg_close($db);
}
?>
