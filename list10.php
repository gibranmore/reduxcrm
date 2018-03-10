<?php
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');

ob_start();

if (!isset($_SESSION["pwrd"]))  {

    die("You are not allowed here");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Last 10 Clients - REDUX</title>

    <!-- Bootstrap Core CSS -->
    <link href="css2/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">
     <link href="css2/searchtable.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />

</head>

<body>

<style >
    #results span{
        font-size: 1.95em;
    }

</style>


     <div class="reduxBrand">
            <h1>R<span>EDU</span>X</h1>
        </div>
    <div class="address-bar">Customer Management</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php">Business Casual</a>
            </div>
            <!-- Collect the nav links, 
            s, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="addcustomer.php">Add Client</a>
                    </li>

                    <li>
                        <a href="searchcustomer.php">Search Client</a>
                    </li>

                    <li>
                        <a href="searchorders.php">Search Online Orders</a>
                    </li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    
                    <?

        /*
        $sql = "";
        if (isset($_GET["firstname"]) ) {

            $first = $_GET["firstname"];
            $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded ". 
            "FROM Customers WHERE firstname= '$first' ORDER BY cid DESC";

        }
        else if (isset($_GET["lastname"]) ) {
            $last = $_GET["lastname"];
            $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded  ". 
            "FROM Customers WHERE lastname = '$last' ORDER BY cid DESC";
        
        else if (isset($_GET["pfirstname"]) ) {
            $pfirst = $_GET["pfirstname"];
            $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded  ". 
            "FROM Customers WHERE preferredFirstName = '$pfirst' ORDER BY cid DESC";
        }
        else if (isset($_GET["plastname"]) ) {
            $plast = $_GET["plastname"];
            $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded  ". 
            "FROM Customers WHERE preferredLastName = '$plast' ORDER BY cid DESC";
        }
        else {
             $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded  ". 
            "FROM Customers ORDER BY cid DESC ".
            "LIMIT 10";

         }
         */


            $query = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded 
                        FROM Customers
                        WHERE ";  //It is okay that we have the 'where' preset. The case where we would not need 'WHERE' 
                                //(extracting all) is alrady taken care of elsewhere.
            $counter = 0; // This variable is used for the 'AND' protion of the SQL "SELECT" query.

            if (!empty($_GET["firstname"])) {
                $first = $_GET["firstname"];
                $query .= " firstname = '$first' ";

                $counter++;
            }

            if (!empty($_GET["pfirstname"])) {
                $pfirst = $_GET["pfirstname"];
                if ($counter > 0 )
                    $query .= " AND preferredFirstName = '$pfirst' ";
                else
                    $query .= " preferredFirstName = '$pfirst' ";
                $counter++;
            }

            if (!empty($_GET["lastname"])) {
                $last = $_GET["lastname"];
                if ($counter > 0 )
                    $query .= " AND lastname = '$last' ";
                else
                    $query .= " lastname = '$last' ";
                $counter++;
            }
            if (!empty($_GET["plastname"])) {
                $plast = $_GET["plastname"];
                if ($counter > 0 )
                    $query .= " AND preferredLastName = '$plast' ";
                else
                    $query .= " preferredLastName = '$plast' ";
                $counter++;
            }
            if (!empty($_GET["email"])) {
                $email = $_GET["email"];
                if ($counter > 0 )
                    $query .= " AND email = '$email' ";
                else
                    $query .= " email = '$email' ";
                $counter++;
            }
            if (!empty($_GET["phone"])) {
                $phone = $_GET["phone"];
                if ($counter > 0 )
                    $query .= " AND phoneNumber = '$phone' ";
                else
                    $query .= " phoneNumber = '$phone' ";
                $counter++;
            }

            $query .= " ORDER BY cid DESC";



        

    ?>
             
   <div class="clientresults">
        <div id="divContainer">
                        <h1 class="blue">Customers</h1>
                        <table class="formatHTML5" >
                            <div >
                        <!-- TABLE HEADER -->
                            <thead >

                                 <tr>
                                    <th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Customer since</th>
                                </tr>
                            </thead>
                                 <tbody >
                                    <?php
                                        $result = $conn->query($query);

                                        
                                        if ($result->num_rows == 0)
                                            header("Location: noresults.php ");
                                        
                                        while ($row = $result->fetch_assoc()) {
                                            $cid = $row['cid'];
                                            $first = strtoupper($row['preferredFirstName']);
                                            $last = strtoupper($row['preferredLastName']);
                                            $email = strtoupper($row['email']);
                                            $phone = $row['phoneNumber'];
                                            if ($row['phoneNumber'] == "" || $row['phoneNumber'] == NULL)
                                                $phone = "- - - - - -";
                                    ?>
                                            <tr data-href=<? print "\"".$cid."\"" ?>>
                                                <td ><? print $first ?> </td>
                                                <td ><? print $last ?> </td>
                                                <td ><? print $email ?> </td>
                                                <td ><? print $phone ?> </td>
                                                <td ><? print $row['dateadded']; ?> </td>
                                            </tr>
                                    <?php
                                        }

                                    ?>
                         
                                </tbody>
                            </div>
                        </table>
        </div>
   </div>

  

    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>
    
    <script src="js2/cssTableOverride.js" ></script>



</body>

</html>
