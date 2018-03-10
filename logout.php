<?php 
    session_start();
	
	session_unset();
	
	session_destroy();
	
	header('Location:  login.php');
?>

<!--
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" http-equiv="refresh" content="3;url=./index.php">
<title>Logout</title>
</head>
<body>

<?php



 
	//print ("<h1>You have logged out!</h1><h3>Redirecting in 3 seconds...</h3>");
	

	
?>
</body>
</html>

-->