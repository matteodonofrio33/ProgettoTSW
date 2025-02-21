<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/registrationStyle.css">
</head>
<body>
    
<?php
	if(isset($_POST['name']))
		$name = $_POST['name'];
	else
		$name = "";

    if(isset($_POST['surname']))
		$surname = $_POST['surname'];
	else
		$surname = "";

    if(isset($_POST['taxIdCode']))
		$taxIdCode = $_POST['taxIdCode'];
	else
		$taxIdCode = "";

    if(isset($_POST['email']))
		$email = $_POST['email'];
	else
		$email = "";
        
	if(isset($_POST['username']))
		$username = $_POST['username'];
	else
		$username = "";

	if(isset($_POST['password']))
		$password = $_POST['password'];
	else
		$password = "";

	if(isset($_POST['passwordConfirm']))
		$passwordConfirm = $_POST['passwordConfirm'];
	else
		$passwordConfirm = "";


	$error = false;

	if (!empty($password)){
		
		if($password != $passwordConfirm){
            $error = true;
			echo "<script type='text/javascript'> alert('Hai sbagliato a digitare la password. Riprova'); </script>";
		}
        
		else{
			//se la password è stata inserita e la password di conferma coincide:

            //verifico che la lunghezza di nome e cognome sia compresa tra 2 e 30
            //verifico che nome e cognome non abbiano caratteri speciali
            if(strlen($name) < 2 || strlen($name) > 30){
                $error = true;
                echo "<script type='text/javascript'> alert('Nome può avere minimo 2 e massimo 30 caratteri'); </script>";
            }

            if(strlen($password) < 2 || strlen($password) > 15 || strlen($passwordConfirm) < 2 || strlen($passwordConfirm) > 15){
                $error = true;
                echo "<script type='text/javascript'> alert('Password può avere minimo 2 e massimo 15 caratteri'); </script>";
            }

            if(strlen($surname) < 2 || strlen($surname) > 30){
                $error = true;
                echo "<script type='text/javascript'> alert('Cognome può avere minimo 2 e massimo 30 caratteri'); </script>";
                
            }
			    
            $specialName = "|!£$%&/()=?^+*§°#ç@.:-_,;<>\"{}[]~`\\";
            if(checkSpecial($name, $specialName)!== false){
                $error = true;
                echo "<script type='text/javascript'> alert('Nome non può contenere caratteri speciali'); </script>";
               
            }

            if(checkSpecial($surname, $specialName) !== false){
                $error = true;
                echo "<script type='text/javascript'> alert('Cognome non può contenere caratteri speciali'); </script>";
            }
                

            //verifico che la lunghezza del codice fiscale sia pari a 16
            //verifico che non ci siano caratteri speciali
			
            if(strlen($taxIdCode) != 16){
                $error = true;
                echo "<script type='text/javascript'> alert('Codice fiscale deve avere una lunghezza di 16 caratteri.'); </script>";  
                
            }
              
            $specialTaxId = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"{}[]~`\\";
            if(checkSpecial($taxIdCode, $specialTaxId) !== false){
                $error = true;
                echo "<script type='text/javascript'> alert('Il codice fiscale non deve avere caratteri speciali.'); </script>";  
                
            }

            $specialEmail = "()<>[]:,;\" !#$%^&*{}|'+=/?`~";
            if(checkSpecial($email, $specialEmail)){
                $error = true;
                echo "<script type='text/javascript'> alert('L'email non deve avere caratteri speciali.'); </script>";  
            }
                

            //verifica se nello username è contenuto il nome inserito dall'utente
            //verifico che la lunghezza dello username sia compresa tra 2 e 15
			
            if(str_contains(strtolower($username), trim(strtolower($name))) || str_contains(strtolower($username), trim(strtolower($surname)))) {// ritorna true o false in base a se $name è contenuto in $username o meno.
                $error = true;
              echo "<script type='text/javascript'> alert('Lo username non puo' contenere il nome o il cognome'); </script>";
               
            }
              
                 
            if(strlen($username) < 2 || strlen($username) > 15) {
                $error = true;
                echo "<script type='text/javascript'> alert('Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri'); </script>";
               
            }
               


            


			//Controllo se l'utente esiste
			if(exist($username, "username")){
				$error = true;
                echo "<script type='text/javascript'> alert('Username $username già esistente'); </script>";	
			}else if(exist($email, "email")){
                $error = true;
				echo "<script type='text/javascript'> alert('Email $email già esistente'); </script>";	
			}
			else{
                
				//ORA posso inserire il nuovo utente nel db
				if(insert_utente($username, $email, $name, $surname, $password, $error)){
                     header("Location: ../pages/login.php");
				}
				else{
					echo "<h1> Errore durante la registrazione. Riprova</h1>";

                   
				}
			}       
		}
	}



    function checkSpecial($str, $special){
        
        return strpbrk($str, $special); //restituisce false se non trova caratteri speciali altrimenti restituisce la sottostringa a partire dal carattere speciale trovato
    }





?>



</body>
</html>
