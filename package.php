<?
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');
header("Content-type: application/json"); 
/*
$myip = "107.201.108.55";
$myip2 = "50.161.111.241";
if ( $_SERVER['REMOTE_ADDR'] == $myip || $_SERVER['REMOTE_ADDR'] == $myip2) {

} 
else {
  die("You don't have the right IP address");
}
*/


	 $date = date('Y-m-d');
     $packType = ($_POST["ptype"]);
     $firstname = ($_POST["firstname"]);
     $lastname = ($_POST["lastname"]);
     $cid = ($_POST["cid"]);
      $packname = ($_POST["packname"]);
      $amt = ($_POST["amt"]);

      $prodid = ($_POST["prodid"]);
    $sqlquery = "SELECT sessionsleft FROM Packages WHERE cid = '$cid' AND sessionsleft > 0 ";

   

    /*
     if ($result = $conn->query($sqlquery)) {

        if ($result->num_rows >= 1) {
            $response['success'] = 0;
            $response['msge'] = "Unable to add a package; cutomer has an active packages";
            echo json_encode($response);
            die();
         }

     }
     */
      if (empty($packname)) {
        $query2 = " INSERT INTO Packages (cid, firstname, lastname, packageType, sessionsleft, datepurchased, prod_id, charged_amt) VALUES 
            ('$cid' ,'$firstname' , '$lastname', '$packType', '$packType' ,'$date', '$prodid', '$amt' )";
      }
      else {
             $query2 = " INSERT INTO Packages (cid, firstname, lastname, packageType, sessionsleft, datepurchased, Name, prod_id, charged_amt) VALUES 
            ('$cid' ,'$firstname' , '$lastname', '$packType', '$packType' ,'$date', '$packname', '$prodid', '$amt' )";
      }
      $result2 = mysqli_query($conn, $query2);

      if ($result2) {
        $response['success'] = 1;
        $response['msge'] = "Successfully added new package";
        echo json_encode($response);
        die();
      }
      else {
        $response['success'] = 0;
        $response['msge'] = "Error occurred while processing request";
        echo json_encode($response);
        die();
      }
                


?>