<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>GENERATORE HASH PASSWORD: </h1>
<?php

$psw = "password3";
$hash = password_hash($psw, PASSWORD_DEFAULT);

echo "hash della password: $psw <br>";
echo "hash: $hash";


?>





    
</body>
</html>

