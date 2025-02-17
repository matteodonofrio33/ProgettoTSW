<?php
// Controllo se la sessione non è stata avviata
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
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
                   <!-- <span> <a href="../pages/login.html"> Login </a> </span> -->
                   <span>
                        <?php 
                        if (isset($_SESSION['username'])) { 
                            echo '<a id="logout" href="../backend/logout.php">Logout</a>';
                        } else { 
                            echo '<a id="login" href="../pages/login.html">Login</a>';
                        } 
                        ?>
                    </span>
                </li>
                <?php if(isset($_SESSION['username'])) { ?>
                    <li> <a href="../backend/refertoTables.php">Crea referto</a></li>
                    <li> <a href="../pages/miePartite.html">Le mie partite</a></li>
                    <li> <a href="../pages/prossimaPartita.php">Prossima partita</a></li>
                <?php } else { ?>
                    <li> <a href="../pages/login.html">Crea referto</a></li>
                    <li> <a href="../pages/login.html">Le mie partite</a></li>
                    <li> <a href="../pages/login.html">Prossima partita</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <?php
        if(isset($_SESSION['username'])) { ?>
            <h1 id="title1">Benvenuto <?php echo htmlspecialchars($_SESSION['username']); ?>, pronto per arbitrare?</h1>
    <?php 
    } else { ?>
        <h1 id="title2">Benvenuto!</h1>
    <?php } ?>
    



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