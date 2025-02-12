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
            //echo "L'errore è la password";
            $error = true;
			echo "<script type='text/javascript'> alert('Hai sbagliato a digitare la password. Riprova'); </script>";
			//echo "<p> Hai sbagliato a digitare la password. Riprova</p>";
			// a $pass e $repass assegniamo una stringa vuota in modo tale che nel modulo sticky non capariranno più le password errate
			
		}
        
		else{
			// Se la password è stata inserita e la password di conferma coincide, proseguiamo:

            //verifico che la lunghezza di nome e cognome sia compresa tra 2 e 30
            //verifico che nome e cognome non abbiano caratteri speciali
            if(strlen($name) < 2 || strlen($name) > 30){
                $error = true;
                //echo "L'errore è la lunghezza del nome";
                echo "<script type='text/javascript'> alert('Nome può avere minimo 2 e massimo 30 caratteri'); </script>";
			   //echo "<p>Nome può avere minimo 2 e massimo 30 caratteri</p>";
                
            }

            if(strlen($password) < 2 || strlen($password) > 15 || strlen($passwordConfirm) < 2 || strlen($passwordConfirm) > 15){
                $error = true;
                //echo "L'errore è la lunghezza della password";
                //echo "<p>Password può avere minimo 2 e massimo 15 caratteri</p>";
                echo "<script type='text/javascript'> alert('Password può avere minimo 2 e massimo 15 caratteri'); </script>";
            }

            if(strlen($surname) < 2 || strlen($surname) > 30){
                $error = true;
                //echo "L'errore è la lunghezza del cognome";
				//echo "<p>Cognome può avere minimo 2 e massimo 30 caratteri</p>";
                echo "<script type='text/javascript'> alert('Cognome può avere minimo 2 e massimo 30 caratteri'); </script>";
                
            }
			    
            $specialName = "|!£$%&/()=?^+*§°#ç@.:-_,;<>\"{}[]~`\\";
            if(checkSpecial($name, $specialName)!== false){
                //echo "L'errore è che ci sono caratteri speciali nel nome";
                $error = true;
				//echo "<p>Nome non può contenere caratteri speciali</p>";
                echo "<script type='text/javascript'> alert('Nome non può contenere caratteri speciali'); </script>";
               
            }

            if(checkSpecial($surname, $specialName) !== false){
                //echo "L'errore è che ci sono caratteri speciali nel cognome";
                $error = true;
				//echo "<p>Nome non può contenere caratteri speciali</p>";
                echo "<script type='text/javascript'> alert('Cognome non può contenere caratteri speciali'); </script>";
            }
                

            //verifico che la lunghezza del codice fiscale sia pari a 16
            //verifico che non ci siano caratteri speciali
			
            if(strlen($taxIdCode) != 16){
                //echo "L'errore è la lunghezza del taxId";
                $error = true;
				//echo "<p>Codice fiscale deve avere una lunghezza di 16 caratteri</p>";
                echo "<script type='text/javascript'> alert('Codice fiscale deve avere una lunghezza di 16 caratteri.'); </script>";  
                
            }
              
            $specialTaxId = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"{}[]~`\\";
            if(checkSpecial($taxIdCode, $specialTaxId) !== false){
                //echo "L'errore è che ci sono caratteri speciali nel codice fiscale";
                $error = true;
				//echo "<p>Il codice fiscale non deve avere caratteri speciali</p>";
                echo "<script type='text/javascript'> alert('Il codice fiscale non deve avere caratteri speciali.'); </script>";  
                
            }

            $specialEmail = "()<>[]:,;\" !#$%^&*{}|'+=/?`~";
            if(checkSpecial($email, $specialEmail)){
               // echo "L'errore è che ci sono caratteri speciali nell'email";
                $error = true;
				//echo "<p>Il codice fiscale non deve avere caratteri speciali</p>";
                echo "<script type='text/javascript'> alert('L'email non deve avere caratteri speciali.'); </script>";  
            }
                

            //verifica se nello username è contenuto il nome inserito dall'utente
            //verifico che la lunghezza dello username sia compresa tra 2 e 15
			
            if(str_contains(strtolower($username), trim(strtolower($name))) || str_contains(strtolower($username), trim(strtolower($surname)))) {// ritorna true o false in base a se $name è contenuto in $username o meno.
				//echo "L'errore è che lo usernamen contiene il nome o cognome";
                $error = true;
                //echo "<p>Lo username non puo' contenere il nome</p>";
              echo "<script type='text/javascript'> alert('Lo username non puo' contenere il nome o il cognome'); </script>";
               
            }
              
                 
            if(strlen($username) < 2 || strlen($username) > 15) {
                //echo "L'errore è la lunghezza del cognome";
                $error = true;
				//echo "<p>Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri</p>";
                echo "<script type='text/javascript'> alert('Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri'); </script>";
               
            }
               


            


			//CONTROLLO SE L'UTENTE GIA' ESISTE
			if(exist($username, "username")){
				$error = true;
                //echo"<p> Username $username già esistente</p>";
                echo "<script type='text/javascript'> alert('Username $username già esistente'); </script>";	
			}else if(exist($email, "email")){
                $error = true;
				echo "<script type='text/javascript'> alert('Email $email già esistente'); </script>";	
			}
			else{
                
				//ORA posso inserire il nuovo utente nel db
				if(insert_utente($username, $email, $name, $surname, $password, $error)){
                    echo"<h1> Utente registrato con successo</h1>";
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