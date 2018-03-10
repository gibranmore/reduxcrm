<?
	require 'include/connect.php';
	date_default_timezone_set('America/Los_Angeles');
	//header('Content-type:application/json');


		$sql = 'SELECT prod_id, price FROM Products';


		$resultSet = $conn->query($sql);
		$product = 'pr';
		$outerArray = array();
		while ($row = $resultSet->fetch_assoc())  {
			$prodID = $row['prod_id'];
			$product .= $prodID;
			$price =  $row['price'];
			$innerArray = array($product => $price);
			array_push($outerArray, $innerArray);
			$product = 'pr';
		}
		
		echo json_encode($outerArray);


?>