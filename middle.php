<?php
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');

ob_start();

if (!isset($_SESSION["pwrd"]))  {

    die("You are not allowed here");

}
?>

    <?

        if ($_SERVER["REQUEST_METHOD"] == "POST") {



            $query = "SELECT cid FROM Customers WHERE "; 
            $counter = 0; // This variable is used for the 'AND' protion of the SQL "SELECT" query.
            
            if( !empty($_POST["firstname"]) && !empty($_POST["lastname"]) ) { // First and Last name were entered 
                                                                            // Highest order of precedence
               
                $first = $_POST["firstname"];
                $first = trim($first);
                
                $last = $_POST["lastname"];
                $last = trim($last);

                if ($counter > 0){
                    $addon = " AND firstname= '$first' AND lastname= '$last' ";
                }
                else
                    $addon =  " firstname= '$first' AND lastname= '$last' ";
                
                $query = $query.$addon;
                $counter++;
            }

            if ( !empty($_POST["pfirstname"]) && !empty($_POST["plastname"]) ) { 
                $pfirst = $_POST["pfirstname"];

                $pfirst = preg_replace('/\s+/', '', $pfirst ); //remove all white spaces
                $pfirst = trim($pfirst);

                $plast = $_POST["plastname"];
                if ($counter > 0){
                    $addon = " AND preferredFirstName= '$pfirst' AND  preferredLastName = '$plast' ";
                }
                else
                    $addon =  " preferredFirstName = '$pfirst' AND  preferredLastName = '$plast' ";

                $query = $query.$addon;
                $counter++;

            }

            if (!empty($_POST["email"]) ) { // Search by email (email field was entered)

                $email = $_POST["email"];

                $email = preg_replace('/\s+/', '', $email ); //remove all white spaces

                if ($counter > 0){
                    $addon = " AND email = '$email' ";
                }
                else
                    $addon = " email = '$email' ";
                
                $query = $query.$addon;
                $counter++;

            }
            if( !empty($_POST["phonenum"])  ) {

                $p = $_POST["phonenum"];
                if ($counter > 0){
                    $addon = " AND phoneNumber = '$p' ";
                }
                else
                    $addon = " phoneNumber = '$p' ";
                
                $query = $query.$addon;
                $counter++;

            }
            $occur = 0;
            $parameters = "list10.php?";
            if ( !empty ($_POST["firstname"] ) ) {
                $parameters .= "firstname=".$_POST["firstname"];
                $occur++;
            }
            if ( !empty($_POST["lastname"] ) ) {
                if ($occur > 0)
                    $parameters .= "&lastname=".$_POST["lastname"];
                else
                    $parameters .= "lastname=".$_POST["lastname"];
                $occur++;
            }
            if ( !empty($_POST["pfirstname"] ) ) {
                if ($occur > 0)
                    $parameters .= "&pfirstname=".$_POST["pfirstname"];
                else
                    $parameters .= "pfirstname=".$_POST["pfirstname"];
                $occur++;
            }
            if ( !empty ($_POST["plastname"] ) ) {
                if ($occur > 0)
                    $parameters .= "&plastname=".$_POST["plastname"];
                else
                    $parameters .= "plastname=".$_POST["plastname"];
                $occur++;
            }
            if ( !empty ($_POST["email"] ) ) {
                if ($occur > 0)
                    $parameters .= "&email=".$_POST["email"];
                else
                    $parameters .= "email=".$_POST["email"];
                $occur++;
            }
            if ( !empty ($_POST["phonenum"] ) ) {
                if ($occur > 0)
                    $parameters .= "&phone=".$_POST["phonenum"];
                else
                    $parameters .= "phone=".$_POST["phonenum"];
            }

            

            header("Location: ".$parameters);
           

            /*
            if(!empty($_POST["list"]) && empty($_POST["firstname"]) && empty($_POST["lastname"]) &&  empty($_POST["phonenum"]) && empty($_POST["email"]) 
                && empty($_POST["plastname"]) && empty($_POST["pfirstname"]) )  {
                if ($_POST["list"] == 5) {

                    //$sql = "SELECT cid FROM Customers ORDER BY cid LIMIT 10";
                    header("Location: list.php");
                    exit;
                }
            }

            if(!empty($_POST["list"]) && empty($_POST["firstname"]) && empty($_POST["lastname"]) &&  empty($_POST["phonenum"]) && empty($_POST["email"]) 
                && empty($_POST["plastname"]) && empty($_POST["pfirstname"]) )  {
                if ($_POST["list"] == 6) {

                    //$sql = "SELECT cid FROM Customers ORDER BY cid LIMIT 10";
                    header("Location: list10.php");
                    exit;
                }
            }
            echo 'query: '.$query;
            echo "\n";
            $result = $conn->query($query);

            if ($result->num_rows > 0 ) {
                echo "found someone...redirecting to his profile<br>";
                $row = $result->fetch_assoc();
                $id = $row['cid'];
                //header("Location: profile.php?id=$id ");
                header("Location: index.php ");
            }
            else {
                 header("Location: noresults.php ");
            }
            */
        }

    ?>
