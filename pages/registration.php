<html lang="it">
<head>
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

 
<!--FORM PER L'INVIO DEI DATI-->
<div class="titleContainer">
        <h2>Inserisci i tuoi dati per registrarti</h2>
</div>

<div class="container"> 

<div class="red" >
	<h2>Errore di registrazione</h2>
	<img src="../assets/immagini/cartellinoRosso.png" alt="red">
</div>

<div class="registrationArea"> 
    
	<form id="registrationForm" method="post" action="./registration.php" onsubmit="return validateAll()">
        
        <p>
            <label for="name">Nome
                <input id="name" type="text" name="name"  required  value="<?php echo $name?>" />
            </label>
			
        </p>
		
        <p>
                <label for="surname">Cognome
                    <input id="surname" type="text" name="surname"  required  value="<?php echo $surname?>" />
                </label>
                </p>

                <p>
                    <label for="taxIdCode">Codice fiscale
                        <input id="taxIdCode" type="text" name="taxIdCode"  required  value="<?php echo $taxIdCode?>" placeholder="composto da 16 caratteri" />
                    </label>
                 </p>

        <p>
            <label for="email">Email
                <input id="email" type="email" name="email"  required  value="<?php echo $email?>" placeholder="example@gmail.com" />
            </label>
        </p>


            <p>
		<label for="username">Username
			<input id="username" type="text" name="username"  required  value="<?php echo $username?>" />
		</label>
		</p>
		<p>
		<label for="password">Password
			<input id="pass1" type="password" name="password"  required  value="<?php echo $password?>" />
		</label>

		</p>

        <p>
            <label for="passwordConfirm">Conferma password
                <input id="pass2" type="password" name="passwordConfirm"  required  value="<?php echo $passwordConfirm?>" />
            </label>
    
            </p>
		<p>
		<input type="submit" name="send" value="Invia" class="sendData"/>
		</p>
	</form>

	<p id="submit">Vuoi diventare un arbitro? <a href="./request.html">Unisciti a noi!</a></p>

</div>



</div>





</body>
</html>

<?php
function exist($valore, $campo){
	require "../backend/conn.php";
	
	
	$sql = "SELECT $campo FROM arbitro WHERE $campo=$1";
	$ret = pg_query_params($db, $sql, array($valore));

	if(!$ret) {
		$message = "Oops si è verificato un errore";
		header("Location: ./error.php?message=".$message."&redirect=./homepage.php");
		exit();
		
	}
	else{
		
		if ($row = pg_fetch_assoc($ret)){
			return true;
		}
		else{ //$row è false se la query non ha restituito alcuna entry
			return false;
		}
	}
	pg_close($db);
}

function insert_utente($username, $email, $name, $surname, $password, $error){
	require "../backend/conn.php"; //connessione
	$hash = password_hash($password, PASSWORD_DEFAULT);
    
	
    //Query parametrizzata per evitare l'sql injection
	if(!$error){
		$sql = "INSERT INTO arbitro(username, email, nome, cognome, password) VALUES($1, $2, $3, $4, $5)";
		$prep = pg_prepare($db, "insertUser", $sql);
		$ret = pg_execute($db, "insertUser", array($username, $email, $name, $surname, $hash));
	
		if(!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		}
		else{
			return true;
		}
	}else {
		echo "<script type='text/javascript'> alert('Non è stato possibile effettuare la registrazione'); </script>";
	}
   
        
	pg_close($db);
}
?>

<?php include('../includes/footer.html'); ?>

