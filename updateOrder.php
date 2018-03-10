<?
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');
header('Content-type:application/json');


$date = date('Y-m-d');

$customerID = ($_POST["custID"]);
$orderID = ($_POST["order"]);
$email = ($_POST["email"]);

/* */
$sql = "UPDATE Online_Orders SET cust_id=? WHERE oo_id=? OR email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $customerID, $orderID, $email);
$stmt->execute();
if($stmt->errno) {
	//echo "FAILURE!!! ".$stmt->error;
	$response["tran"] = "onlineOrders";
     $response["success"] = 0;
     $response["message"] = $stmt->error;
    echo json_encode($response);
}
else {
	//echo "FAILURE!!! ".$stmt->error;
	$response["tran"] = "onlineOrders";
     $response["success"] = 1;
     $response["message"] = "successfully set orders, affected rows= ".$stmt->affected_rows;
    echo json_encode($response);
}

/*Scan entire Online Orders table and look for past orders submitted with the given email so we can attach the newly created customer to those orders */
//$sql = "UPDATE Online_Orders SET cu"

$ordersArr = array();

$sqlx = "SELECT oo_id FROM Online_Orders WHERE email='$email' ";
$resultset = $conn->query($sqlx);
if (!$resultset) {
	die("*error: ".$conn->error);
}
else{
	//echo "FAILURE!!! ".$stmt->error;
	$response["tran"] = "propagate Orders where email";
     $response["success"] = 1;
     $response["message"] = "successfully set all orders where equal to email";
    echo json_encode($response);
}
echo "\n";
while ($rowx = $resultset->fetch_assoc()) {
	array_push($ordersArr, $rowx['oo_id']);
	echo "oo_id: ".$rowx['oo_id'];
	echo "\n";
}
echo "array.len: ".count($ordersArr);
echo "\n";
$ctr = 0;
foreach ($ordersArr as $val) {
	$sqly = "UPDATE Packages SET cid=? WHERE oo_id=? AND cid IS NULL";
	$stmty = $conn->prepare($sqly);
	$stmty->bind_param("ii", $customerID, $val);
	$stmty->execute();
	if ($stmty->errno) {
		die ("Error occurred in for loop, iteration: ".$ctr.", ".$stmty->error);
	}
}


?>