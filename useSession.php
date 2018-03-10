<?
    require_once 'include/connect.php';
    session_start();
    date_default_timezone_set('America/Los_Angeles');
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
     $pid = ($_POST["packageid"]);
     $cid = ($_POST["customerid"]);

    $sqlquery = "SELECT sessionsleft FROM Packages WHERE pid = '$pid' ";

    if ($result = $conn->query($sqlquery)) {
    		 $row = $result->fetch_assoc();
            $sessionsleft = $row['sessionsleft'];
    }
    $sessionsleft--;

    $sqlquery2 = "UPDATE Packages SET sessionsleft= '$sessionsleft' WHERE pid= '$pid' ";
    //$sqlquery = "UPDATE Packages SET sessio";
    $updateresult = mysqli_query($conn, $sqlquery2);
    if (!$updateresult) {

    	die("Some error occurred while updating database!");
    }


   






?>