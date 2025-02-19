<?php
//controllo se la sessione non è stata avviata
if (session_status()==PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/headerStyle.css">
</head>
<body>

    <header>
        <nav class="menu">
            <ul id="list">
                <li id="access"> <a href="#"> <img src="../assets/immagini/user.png" alt="userImg"> </a>
                   <span id="log">
                        <?php 
                        if (isset($_SESSION['username'])) { 
                            echo '<a id="logout" href="../backend/logout.php">Logout</a>';
                        } else { 
                            echo '<a id="login" href="../pages/login.php">Login</a>';
                        } 
                        ?>
                    </span>
                </li>
                <?php if(isset($_SESSION['username'])) { ?>
                    <li> <a href="../pages/homepage.php">Homepage</a></li>
                    <li> <a href="../pages/refertoTables.php">Crea referto</a></li>
                    <li> <a href="../pages/miePartite.php">Le mie partite</a></li>
                    <li> <a href="../pages/prossimaPartita.php">Prossima partita</a></li>
                <?php } else { ?>
                    <li> <a href="../pages/login.php">Crea referto</a></li>
                    <li> <a href="../pages/login.php">Le mie partite</a></li>
                    <li> <a href="../pages/login.php">Prossima partita</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <script type="text/javascript"> 

            let elementImg = document.getElementById("access");
            let elementSpan = document.getElementsByTagName("span")[0];

            elementImg.addEventListener("mouseover", function(event) {
                elementSpan.style.display="block";
            });

            elementImg.addEventListener("mouseout", function() {
                elementSpan.style.display="none";
            }); 

    </script>

    <?php if(isset($_SESSION['username'])) { ?>
        <script src="../assets/js/headerJS.js"></script>
    <?php } ?>
    
</body>
</html>