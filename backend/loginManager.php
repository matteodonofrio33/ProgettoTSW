
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
					$message = "L'utente ".$username." non esiste";
					header("Location: ./error.php?message=".$message."&redirect=../pages/login.php");
					exit(); //in modo tale da esser sicuri di non eseguire altro codice
			}
			else{
				

				if(password_verify($password, $hash)){
					session_start();
					$_SESSION['username'] = $username;
					header("Location: ../pages/homepage.php");
					exit(); 
				}				
				else{
					$message = "Password errata";
					header("Location: ./error.php?message=".$message."&redirect=../pages/login.php");
					exit();
				}
			}
		}
		else{
			$message = "Username o password non inseriti";
					header("Location: ./error.php?message=".$message."&redirect=../pages/login.php");
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
		$prep = pg_prepare($db, "sqlPassword", $sql); 
		$ret = pg_execute($db, "sqlPassword", array($username)); 
		
		if(!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		}
		
		else{
			if ($row = pg_fetch_assoc($ret)){
				
				$password = $row['password'];
				return $password; //password con hash
			}
			else{
				
				return false;
			}
   	}
		pg_close($db);
}
?>
