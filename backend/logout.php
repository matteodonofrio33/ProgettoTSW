
<?php session_start();?>
<html>
<head>
	<title>Logout</title>
</head>
<body>
<?php
	session_start();
	

	$_SESSION = session_unset();
	

	if (session_id() != "" || isset($_COOKIE[$sname])) {
		$sname = session_name();
		setcookie($sname,'', time()-2592000,'/');
		session_destroy();
	}

	header("Location: ../pages/homepage.php");

?>
</body>
</html>
