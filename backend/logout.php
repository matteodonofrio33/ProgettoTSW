<html>
<head>
	<title>Logout</title>
</head>
<body>
<?php
	session_start();
	session_set_cookie_params(0);
	
	$sname = session_name();
	$uname = $_SESSION["username"];

	session_unset();
	session_destroy();

	if (isset($_COOKIE[$sname])) {
		setcookie($sname,'', time()-3600,'/');
	}

	header("Location: ../pages/homepage.php");

?>
</body>
</html>
