
    //verifico che la lunghezza di nome e cognome sia compresa tra 2 e 30
    //verifico che nome e cognome non abbiano caratteri speciali
	function validateName() {
        let name = document.getElementById("name").value;

        if(!isRightLength(name, 2, 30))
            return false;
            //alert("Nome può avere minimo 2 e massimo 30 caratteri");          
            specialName = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"{}[]~`\\";
        if(checkSpecial(name, specialName))
            return false;
           //alert("Nome non puo' contenere caratteri speciali");
        
           return true;
    }

    function validateSurname() {
        let surname = document.getElementById("surname").value;

        if(!isRightLength(surname, 2, 30))
            return false;
           // alert("Cognome può avere minimo 2 e massimo 30 caratteri");  
        
		   specialSurname = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"{}[]~`\\";
        if(checkSpecial(surname, specialSurname))
            return false;
            //alert("Cognome non puo' contenere caratteri speciali");

            return true;
    }

  


    //verifica se nello username è contenuto il nome inserito dall'utente
    //verifico che la lunghezza dello username sia compresa tra 2 e 15
    function validateUsername() {
        let name = document.getElementById("name").value.toLowerCase();
		let surname = document.getElementById("surname").value.toLowerCase();
        let username = document.getElementById("username").value.toLowerCase();
        //document.write("Il nome inserito è " + name.value);
        if(username.includes(name) || username.includes(surname))
            return false;
           // alert("Lo username non puo' contenere il nome");

        if(!isRightLength(username, 2, 15))
            return false;
            //alert("Lo username deve avere un minimo di 2 ed un massimo di 15 caratteri");
        return true;
    }

        //verifico che la lunghezza del codice fiscale sia pari a 16
        //verifico che non ci siano caratteri speciali
        function validateTaxId() {
        const len = 16;
        taxId = document.getElementById("taxIdCode").value;

        if(taxId.length != len)
            return false;
           //alert("Codice fiscale deve avere una lunghezza di 16 caratteri");
    
		specialTaxId = "|!£$%&/()=?'^+*§°#ç@.:-_,;<>\"{}[]~`\\";
        if(checkSpecial(taxId, specialTaxId))
            return false;
           
           // alert("Il codice fiscale non deve avere caratteri speciali.");

            return true;
    }

    function validateEmail() {
        specialEmail = "()<>[]:,;\" !#$%^&*{}|'+=/?`~";
        email = document.getElementById("email").value;

        if(checkSpecial(email, specialEmail))
            return false;

        return true;
    }



    
    //verifica se la password contiene almeno 3 e massimo 15 caratteri
    function validatePassword1() {
        pass1 = document.getElementById("pass1").value;
        
        if(!isRightLength(pass1, 2, 15))
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

    
    

        
    

    function validateAll() {
        //alert("Sono validateAll");
        let error = false;

        if(!validateName()){
			error = true;
            alert("Controlla l'inserimento del nome");
        }
            

        if(!validateSurname()){
			error = true;
            alert("Controlla l'inserimento del cognome");
        }

        if(!validateUsername()){
            error = true;
            alert("Controlla l'inserimento dello username");
        }
            

        if(!validateTaxId()){
            error = true;
            alert("Controlla l'inserimento del codice fiscale");
        }

        if(!validateEmail()){
            error = true;
            alert("Controlla l'inserimento dell'email");
        }
            

        if(!validatePassword1()){
			error = true;
            alert("Controlla l'inserimento della password");
        }
           

        if(!validatePassword2()){
			error = true;
            alert("Controlla l'inserimento della password");
        }

		return !error; //serve per bloccare l'invio dei dati nel form
    }


   

    //controlla se sono presenti caratteri speciali
    function checkSpecial(str, special){
        
        

        let flag = false;

        for(let i = 0; i < str.length; i++) {
            if(special.includes(str[i]))
                return true;       
            }

        return false;
    }



    function isRightLength(str, min, max){
        
		if(str.length < min || str.length > max)
		   return false;

           return true;
    }

	




