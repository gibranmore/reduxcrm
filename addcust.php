<?
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');
header('Content-type:application/json');


	 $date = date('Y-m-d');
     $email = strtoupper($_POST["email"]);
     $firstname = strtoupper($_POST["first"]);
     $lastname = strtoupper($_POST["last"]);
     $phone = ($_POST["phoneNumber"]);
     $gender = strtoupper($_POST["gender"]);
     $age = ($_POST["age"]);
     $beauty= $fitness = $wellness = "";
     $pfirst = strtoupper($_POST["preferredFirst"]);
    $plast = strtoupper($_POST["preferredLast"]);
    $referral = strtoupper($_POST["referral"]);

    if (isset($_POST['beauty']))
        $beauty= ($_POST["beauty"]);
    if(isset($_POST['fitness']))
        $fitness = ($_POST["fitness"]);
    if(isset($_POST['wellness']))
     $wellness = ($_POST["wellness"]);

    if (empty($beauty) && empty($fitness) && empty($wellness))
        $interest = "NULL";
    else {
        $interest = $beauty.",".$fitness.",".$wellness;
        $interest = strtoupper($interest);
        $interest = "'$interest'";
    }



    $referral = trim($referral);
    $referral = strtoupper($referral);

    $phone = !empty($phone) ? "'$phone'" : "NULL";
    $age = !empty($age) ? "'$age'" : "NULL";
    $gender = !empty($gender) ? "'$gender'" : "NULL";
    $referral = !empty($referral) ? "'$referral'" : "NULL";
    



    $sqlCheckEmail = "SELECT email from Customers WHERE email= '$email'";
    $resultCheckEmail= $conn->query($sqlCheckEmail);


    $sqlCheckName = "SELECT cid FROM Customers WHERE firstName = '$firstname' AND lastname = '$lastname' ";
    $resultCheckName = $conn->query($sqlCheckName);

    if ($resultCheckEmail->num_rows >= 1) {
        $response["success"] = 0;
        $response["message"] = "Existing email";
        echo json_encode($response);
        die();
    }
   

        $q = "INSERT INTO Customers (firstname, lastname, phoneNumber, age, gender, referral, email, interest, dateadded, preferredFirstName,
            preferredLastName) values ('$firstname', 
            '$lastname', $phone, $age , $gender,  $referral , '$email',  $interest, '$date', '$pfirst', '$plast' )";
           
            $res = mysqli_query($conn, $q);
            if (!$res)
            {
                $response["success"] = 0;
                $response["message"] = "Database error occurred";
                echo json_encode($response);
                
            }
            else
            {
                
                $sqlquery = "SELECT cid FROM Customers ORDER BY cid DESC LIMIT 1";

                        if ($result = $conn->query($sqlquery)) {
                            $row = $result->fetch_assoc();


                            $response["success"] = 1;
                            $response["message"] = "Successfully added customer";
                            $response["cid"] = $row['cid'];
                            echo json_encode($response);
                            
                        }
                        else  {
                            $response["success"] = 0;
                            $response["message"] = "Database error occurred";
                            echo json_encode($response);
                            
                        }
                
            }  


?>