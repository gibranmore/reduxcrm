<?php
require 'include/connect.php';
session_start();
ob_start();
/*
$myip = "107.201.108.55";
$tempip = "::1";

if ( $_SERVER['REMOTE_ADDR'] == $myip || $_SERVER['REMOTE_ADDR'] == $tempip) {

}	
else {
	die("You don't have the right IP Address");
}

*/
?>
<!DOCTYPE html>

<html>

<head>
	<title>Login</title>
	
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="css2/style.css" type="text/css" media="all" />
</head>

<body>

	<style >
	.err {
		color: red;
		font-weight: 450;
	}
	</style>

	<h2>Redux Login</h2>

	
	
	<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
		
		
		<p class="email">
			<input type="text" name="email" id="email" placeholder="mail@example.com" />
			<label for="email">Email</label>
		</p>
		
		<p class="web">
			<input size="50" type="password" name="pwrd" id="web"  />
			<label for="web">Password</label>
		</p>		
	
		
		
		<p class="submit">
			<input type="submit" value="Login" />
		</p>
	</form>

</body>

</html>

<?php
$emptyErr = $wrongErr = "";
$email = $pass = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pwrd'];
   
    
    
    $query1 = "SELECT password FROM Users WHERE email='$email'";

    $result1 = $conn->query($query1);
    $resultPass = $result1->fetch_row();
    $password = $resultPass[0];
    

    if ($email == "" || $pass =="") {
        $emptyErr = "You left something empty. Fix that!";
    } else if ($result1->num_rows != 1) {
        $wrongErr = "Your email or password is not correct. Fix that!";
    } else if($pass != $password){
        $wrongErr = "Your email or password is not correct2. Fix that!";
    }else {
    
    	echo "debug";

    	$_SESSION["userID"] = $email;
    	$_SESSION["pwrd"] = $pass;


        header('Location:  index.php');
    }
    echo "<h4 class=\"err\">$wrongErr</h4>";
}


?>

