<?php


$message = isset($_GET['message']) ? $_GET['message'] : 'Si è verificato un errore';
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '#';



?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>

    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        
        }

        #errorDiv{
            
            width: 450px;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
        }

        #errorDiv img {
            width: 300px;
        }

        #errorDiv h1 {
            color: white;
        }




    </style>

</head>
<body>


    <div id="errorDiv" >

        <h1> <?php echo $message ?> </h1>
        <img src="../assets/immagini/cartellinoRosso.png" alt="cartRosso">
            <a href="<?php echo $redirect ?>">Riprova</a>


    </div>



    
</body>
</html>