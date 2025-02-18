<!DOCTYPE html>
<html lang="en">
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
            
            width: 400px;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
            border: 2px solid red;
            
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
        <h1><?php  ?> questo è l'errore</h1>
        <img src="../assets/immagini/cartellinoRosso.png" alt="cartRosso">

    </div>



    
</body>
</html>