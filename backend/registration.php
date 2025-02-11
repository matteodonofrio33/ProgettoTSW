<html>
<head>
	<title>Registrati</title>
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


	
	if (!empty($password)){
		// Se le due password sono diverse mostriamo un messaggio di errore
		if($password!=$passwordConfirm){
			echo "<p> Hai sbagliato a digitare la password. Riprova</p>";
			// a $pass e $repass assegniamo una stringa vuota in modo tale che nel modulo sticky non capariranno più le password errate
			$password = "";
			$passwordConfirm = "";
            $email = "";
		}
        
		else{
			// Se la password è stata inserita e la password di conferma coincide, proseguiamo:

            //verifico che la lunghezza di nome e cognome sia compresa tra 2 e 30
            //verifico che nome e cognome non abbiano caratteri speciali
            if(strlen($name) < 2 || strlen($name) > 30){
                echo "<script type='text/javascript'> alert('Nome può avere minimo 2 e massimo 30 caratteri'); </script>";
                $name = "";
                $email = "";
            }

            if(strlen($password) < 2 || strlen($password) > 15 || strlen($passwordConfirm) < 2 || strlen($passwordConfirm) > 15){
                $password = "";
                $passwordConfirm = "";
                $email = "";
                echo "<script type='text/javascript'> alert('Password può avere minimo 2 e massimo 15 caratteri'); </script>";
            }

            if(strlen($surname) < 2 || strlen($surname) > 30){
                echo "<script type='text/javascript'> alert('Cognome può avere minimo 2 e massimo 30 caratteri'); </script>";
                $surname = "";
                $email = "";
            }
			    
            
            if(checkSpecial($name)!== false){
                echo "<script type='text/javascript'> alert('Nome non può contenere caratteri speciali'); </script>";
                $name = "";
                $email = "";
            }

            if(checkSpecial($surname) !== false){
                echo "<script type='text/javascript'> alert('Nome non può contenere caratteri speciali'); </script>";
                $surname = "";
                $email = "";
            }
                

            //verifico che la lunghezza del codice fiscale sia pari a 16
            //verifico che non ci siano caratteri speciali
            if(strlen($taxIdCode) != 16){
                echo "<script type='text/javascript'> alert('Codice fiscale deve avere una lunghezza di 16 caratteri.'); </script>";  
                $taxIdCode = "";
                $email = "";
            }
              
            
            if(checkSpecial($taxIdCode) !== false){
                echo "<script type='text/javascript'> alert('Il codice fiscale non deve avere caratteri speciali.'); </script>";  
                $taxIdCode = "";
                $email = "";
            }
                

            //verifica se nello username è contenuto il nome inserito dall'utente
            //verifico che la lunghezza dello username sia compresa tra 2 e 15
            if(str_contains($username, $name)) {// ritorna true o false in base a se $name è contenuto in $username o meno.
                echo "<script type='text/javascript'> alert('Lo username non puo' contenere il nome'); </script>";
                $username = "";
                $email = "";
            }
              
                 
            if(strlen($username) < 2 || strlen($username) > 15){
                echo "<script type='text/javascript'> alert('Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri'); </script>";
                $username = "";
                $email = "";
            }
               


            


			//CONTROLLO SE L'UTENTE GIA' ESISTE
			if(username_exist($username)){
                echo "<script type='text/javascript'> alert('Username $username già esistente'); </script>";	
			}
			else{
				//ORA posso inserire il nuovo utente nel db
				if(insert_utente($username, $email, $name, $surname, $password)){
                    echo"<p> Utente registrato con successo</p>";
					
				}
				else{
					echo "<p> Errore durante la registrazione. Riprova</p>";
				}
			}
		}
	}



    function checkSpecial($str){
        $special = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"  ";
        return strpbrk($str, $special); //restituisce false se non trova caratteri speciali altrimenti restituisce la sottostringa a partire dal carattere speciale trovato
    }





?>
<!-- Il form viene visualizzato sempre, sia prima che dopo l'invio -->
<!-- Abbiamo realizzato uno sticky form -->
<!-- Qui devo includere il registration.html -->
 

<div class="titleContainer">
        <h2>Inserisci i tuoi dati per registrarti</h2>
    </div>

<div class="registrationArea"> 
    
	<form id="registrationForm" method="post" action="./registration.php">
        
        <p>
            <label for="name">Nome
                <input id="name" type="text" name="name"  required onchange="validateName()"/>
            </label>
            </p>
		
            <p>
                <label for="surname">Cognome
                    <input id="surname" type="text" name="surname"  required onchange="validateSurname()"/>
                </label>
                </p>

                <p>
                    <label for="taxIdCode">Codice fiscale
                        <input id="taxIdCode" type="text" name="taxIdCode"  required onchange="validateTaxId()"/>
                    </label>
                    </p>

        <p>
            <label for="email">Email
                <input id="email" type="email" name="email"  required />
            </label>
        </p>


            <p>
		<label for="username">Username
			<input id="username" type="text" name="username"  required onchange="validateUsername()"/>
		</label>
		</p>
		<p>
		<label for="password">Password
			<input id="pass1" type="password" name="password"  required onchange="validatePassword1()"/>
		</label>

		</p>

        <p>
            <label for="passwordConfirm">Conferma password
                <input id="pass2" type="password" name="passwordConfirm"  required onchange="validatePassword2()"/>
            </label>
    
            </p>
		<p>
		<input type="submit" name="send" value="Invia" class="sendData"/>
		</p>
	</form>

	<p id="submmit">Vuoi diventare un arbitro? <a href="./request.html">Unisciti a noi!</a></p>

</div>


<script type="text/javascript">
    //verifico che la lunghezza di nome e cognome sia compresa tra 2 e 30
    //verifico che nome e cognome non abbiano caratteri speciali
	function validateName() {
        let name = document.getElementById("name").value;

        if(!isRightLength(name))
            return false;
            //alert("Nome può avere minimo 2 e massimo 30 caratteri");  
        
            
        if(checkSpecial(name))
            return false;
           //alert("Nome non puo' contenere caratteri speciali");
        
           return true;
    }

    function validateSurname() {
        let surname = document.getElementById("surname").value;

        if(!isRightLength(surname))
            return false;
           // alert("Cognome può avere minimo 2 e massimo 30 caratteri");  
        
            
        if(checkSpecial(surname))
            return false;
            //alert("Cognome non puo' contenere caratteri speciali");

            return true;
    }

  


    //verifica se nello username è contenuto il nome inserito dall'utente
    //verifico che la lunghezza dello username sia compresa tra 2 e 15
    function validateUsername() {
        let name = document.getElementById("name").value;
        let username = document.getElementById("username").value;
        //document.write("Il nome inserito è " + name.value);
        if(username.includes(name))
            return false;
           // alert("Lo username non puo' contenere il nome");

        if(username.length < 2 || username.length > 15)
            return false;
            //alert("Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri");
        return true;
    }

        //verifico che la lunghezza del codice fiscale sia pari a 16
        //verifico che non ci siano caratteri speciali
        function validateTaxId() {
        const len = 16;
        taxId = document.getElementById("taxIdCode");

        if(taxId.length != len)
            return false;
           //alert("Codice fiscale deve avere una lunghezza di 16 caratteri");
    
        if(checkSpecial(taxId))
            return false;
           
           // alert("Il codice fiscale non deve avere caratteri speciali.");

            return true;
    }



    
    //verifica se la password contiene almeno 3 e massimo 15 caratteri
    function validatePassword1() {
        pass1 = document.getElementById("pass1").value;
        
        if(pass1.length < 2 || pass1.length > 15)
            return false;
          //  alert("La password deve avere un minimo di 2 ed un massimo di 15 caratteri");

          return true;
        
    }



    //verifica se le password sono uguali
    function validatePassword2(){
        pass2 = document.getElementById("pass2").value;
        pass1 = document.getElementById("pass1").value;

        if(!(pass1 === pass2))
            return false;
          //  alert("Le password non corrispondono");
        return true;
    }

    
    

        
    

    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        let error = false;

        if(!validateName()){
            error = true;
          //  alert("Controlla l'inserimento del nome");
        }
            

        if(!validateSurname()){
            error = true;
           // alert("Controlla l'inserimento del cognome");
        }
            

        if(!validateTaxId()){
            error = true;
           // alert("Controlla l'inserimento del codice fiscale");
        }
            

        if(!validatePassword1()){
            error = true;
          //  alert("Controlla l'inserimento della password");
        }
           

        if(!validatePassword2()){
            error = true;
          //  alert("Controlla l'inserimento della password");
        }

        if(error)
        	event.preventDefault();
            

    });





    //Manca il controllo sull'email perché è effettuato automaticamente dai browser
    
   


   

    //controlla se sono presenti caratteri speciali
    function checkSpecial(str){
        
        const special = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"  ";

        let flag = false;

        for(let i = 0; i < str.length; i++) {
            if(special.includes(str[i]))
                return true;       
            }

        return false;
    }


    function isRightLength(str){
        str = str.value;
		if(str.length < 2 || str.length > 30)
		   return false;

           return true;
    }


  

	
    

  


	



</script>




</body>
</html>

<?php
function username_exist($user){
	require "./conn.php";
	
	
	$sql = "SELECT username FROM arbitro WHERE username=$1";
	$prep = pg_prepare($db, "sqlUsername", $sql);
	

	$ret = pg_execute($db, "sqlUsername", array($user));
	// $ret sarà uguale a false in caso di fallimento nell'esecuzione del prepared statement

	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
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

function insert_utente($username, $email, $name, $surname, $password){
	require "./conn.php"; //connessione
	//echo "sto inserendo $username e $password";
	$hash = password_hash($password, PASSWORD_DEFAULT);
    
	//echo "HASH: $hash";
    //Query parametrizzata per evitare l'sql injection
	if($username!='' && $email!='' && $name!='' && $surname!='' && $password!=''){
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
