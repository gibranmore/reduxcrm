<?
    require_once 'include/connect.php';
    session_start();
    date_default_timezone_set('America/Los_Angeles');

     $cid = ($_POST["customerid"]);
     $first = ($_POST["preferredFirst"]);
     $last = ($_POST["preferredLast"]);
    
     /*
        Escape single quotes to allow names like o'reilly
    */
    $first = $conn->real_escape_string($first);
    $last = $conn->real_escape_string($last);

    $sqlquery2 = "UPDATE Customers SET preferredFirstName = '$first', preferredLastName = '$last' WHERE cid = '$cid' ";


    $updateresult = mysqli_query($conn, $sqlquery2);
    if (!$updateresult) {
         $response['success'] = 'failure';
        $response['msge'] = "Error occured while updating name";
    	
    }
    else {

        $response['success'] = 'success';
        $response['msge'] = "Successfully updated name";
    }

     echo json_encode($response);


?>