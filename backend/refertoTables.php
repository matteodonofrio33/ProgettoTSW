<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require('../pages/referto.php');
    
    //echo "$giocatore1";
    echo " 
        <table>
        

        <tr>
            <th>Nome Giocatore</th>
            <th>Stato Giocatore</th>
            <th>Minuto</th>
        </tr>

        <tr>
            <td>$giocatore1</td>
            <td>Maria Anders</td>
            <td>Germany</td>
        </tr>

        <tr>
            <td>$giocatore2</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
        </tr>

        <tr>
            <td>$giocatore3</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
        </tr>

        <tr>
            <td>$giocatore4</td>
            <td>Helen Bennett</td>
            <td>UK</td>
        </tr>

        <tr>
            <td>$giocatore5</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
        </tr>
        <tr>
            <td>$giocatore6</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
        </tr>



    </table>
    
    
    
    
    
    
    ";


    ?>
</body>
</html>