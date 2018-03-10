<?php
 require_once 'include/connect.php';
  session_start();
  date_default_timezone_set('America/Los_Angeles');


if($_POST["customerid"]) {

	$custID = $_POST["customerid"];
	$packagetype = $_POST["packType"];
	$productid = $_POST["productid"];

	  $date = date('Y-m-d');
	
	  $query2 = " INSERT INTO Sessions (cid, date, packageType, prod_id) VALUES ('$custID' , '$date', '$packagetype', '$productid')";
	  $result2 = mysqli_query($conn, $query2);

	  if (!$result2) {
	  	echo "error";
	  }
	  else
	  	echo "Clear!";

}

?>