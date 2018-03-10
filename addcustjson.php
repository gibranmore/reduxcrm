<?
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');
header('Content-type:application/json');


	 $date = date('Y-m-d');
     $email = ($_POST["email"]);
     $firstname = ($_POST["first"]);
     $lastname = ($_POST["last"]);
     $phone = ($_POST["phoneNumber"]);
     $gender = ($_POST["gender"]);
     $age = ($_POST["age"]);
     $beauty= $fitness = $wellness = "";
     $pfirst = ($_POST["preferredFirst"]);
    $plast = ($_POST["preferredLast"]);
    $referral = ($_POST["referral"]);

    if (isset($_POST['beauty']))
        $beauty= ($_POST["beauty"]);
    if(isset($_POST['fitness']))
        $fitness = ($_POST["fitness"]);
    if(isset($_POST['wellness']))
     $wellness = ($_POST["wellness"]);

    $setstring = $beauty.",".$fitness.",".$wellness;

    $sqlCheckEmail = "SELECT email from Customers WHERE email= '$email'";
    $resultCheckEmail= $conn->query($sqlCheckEmail);


    $sqlCheckName = "SELECT cid FROM Customers WHERE firstName = '$firstname' AND lastname = '$lastname' ";
    $resultCheckName = $conn->query($sqlCheckName);

    if ($resultCheckEmail->num_rows >= 1) {
        die("!ERROR: That email already exists");
    }
   

        $q = "INSERT INTO Customers (firstname, lastname, phoneNumber, age, gender, referral, email, interest, dateadded, preferredFirstName,
            preferredLastName) values ('$firstname', 
            '$lastname', '$phone', '$age' , '$gender',  '$referral' , '$email',  '$setstring', '$date', '$pfirst', '$plast' )";
           
            $res = mysqli_query($conn, $q);
            if (!$res)
            {
              die("Error Occured while inserting customer");
              
            }
            else
            {
                
                $sqlquery = "SELECT cid FROM Customers ORDER BY cid DESC LIMIT 1";

                        if ($result = $conn->query($sqlquery)) {
                            $row = $result->fetch_assoc();

                             $id = $row['cid'];
                             $response["success"] = 1;
                                $response["message"] = $id;
                             echo json_encode($response);
                        }
                        else   {
                            $response["success"] = 0;
                                $response["message"] = "Error occured while creating customer";
                                echo json_encode($response);
                        }
                      
                
            }  


?>