<html>
<head>
	<title>Logout</title>
</head>
<body>
<?php
 	/* attiva la sessione */
	session_start();

	/* sessione attiva, la distrugge */
	$sname = session_name();
	$uname = $_SESSION["username"];

	session_unset();
	session_destroy();

	/* ed elimina il cookie corrispondente */
	if (isset($_COOKIE[$sname])) {
		setcookie($sname,'', time()-3600,'/');
	}
	
	//echo "<p> Logout effettuato. Ciao $uname </p>";
	//echo "<p>Torna alla <a href='../pages/homepage.php'>Home</a></p>";

	header("Location: ../pages/homepage.php");

?>
</body>
</html>
