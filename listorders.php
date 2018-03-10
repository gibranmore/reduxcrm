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

    <title>All Online Orders - REDUX</title>

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

    <style>
    .col-lg-12.listorders span {
        text-transform: none;
        font-family: "Open Sans", "Sans-Serif";
        font-size: 1.2em;
        font-style: normal;
    }
    .pagination {
        padding-top: 20px;
        text-align: center;
       
    }
    .block {
        
        display: inline-block;
    }
    .block p {
        padding: 10px;
        font-size: 2.2em;
        font-weight: 600;
        color:  grey;
    }

    .pagination a {

        -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        color: white;
        float: left;
        padding: 8px  16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 2px solid #fff;
        font-size: 2.1em;
        font-weight: 400; 
        background: grey;      
    }

    .pagination a.active {
        background-color: red;
        color: white;
        border: 1px solid #4CAF50;
    }
    .block a:hover + p {
        color: #F5F5F5;
    }

    .pagination a:hover:not(.active) {
        background-color: #F5F5F5;
        color:  grey;
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
                        <a href="searchorders.php">Search Orders</a>
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

    <center> <div >

        <div >
            <div >
                <div >
                    <hr>
                        <h4>Search Results</h4>
                     <hr>
                     <br>
                    <?

        if (isset($_GET["orderconfirm"]) ) {
            $confirmCode = $_GET["orderconfirm"];
        }
        if (isset($_GET["zipcode"]) ) {
            $zipcode = $_GET["zipcode"];
        }
        if (isset($_GET["email"]) ) {
            $email = $_GET["email"];
        }

        $rec_limit = 10;

        /*
        $sql = "SELECT count(oo_id) FROM Online_Orders ";
        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
           
            $rec_count = $row["count(oo_id)"]; 
           
        }
        else
            echo "COUld not get data";
        */
        $oneParameterFlag = false;

        
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         
         /*
         $left_rec = $rec_count - ($page * $rec_limit);
        */

        function moreNextResults($sql, $offsetNext, $connObj) {
            //echo "sql: ".$sql;
            $pos = strpos($sql, "OFFSET");
            $subsql = substr($sql, 0, $pos+6);
            $subsql = $subsql." ".$offsetNext;
            //echo "subsql: ".$subsql;
            $result = $connObj->query($subsql);

            if ($result->num_rows == 0)
                return false;
            return true;

        }

        function lookupCustomerID($id, $connObj) {
                    $sqlx = "SELECT firstname, lastname FROM Customers WHERE cid='$id' ";
                    $result = $connObj->query($sqlx);

                    $arr = array();
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();

                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        array_push($arr, $firstname , $lastname );
                        
                    }
                    else
                        array_push($arr, "N/A" , "N/A" );
                    return $arr;
        }

         

        $sqlx = "SELECT oo_id, confirmCode, email, cust_id, purchase_date FROM Online_Orders ";
        $sql2 = "SELECT count(oo_id) FROM Online_Orders ";
        $sql3 = "SELECT oo_id, confirmCode, email, cust_id, purchase_date FROM Online_Orders ";
        $parameterString = "";
        $keywords = "";
        if (isset($confirmCode)) {
            $oneParameterFlag = true;
            $sqlx .= " WHERE confirmCode=?"; 
            $sql2 .= " WHERE confirmCode=?"; 
            $sql3 .= " WHERE confirmCode='$confirmCode'"; 
            $parameterString .= "s";  
            $keywords .= ", ".$confirmCode; 
        }
        

        if (isset($email)) {   
            if ($oneParameterFlag) {
                $sqlx .= " AND email=?";
                $sql2 .= " AND email=?";
                $sql3 .= " AND email='$email'";
            }
            else  {
                $sqlx .= " WHERE email=?";
                 $sql2 .= " WHERE email=?";
                 $sql3 .=  " WHERE email='$email'";
            }
            $oneParameterFlag = true;
            $parameterString .= "s";   
            $keywords .= ", ".$email; 
        }
        if (isset($zipcode)) {   
            if ($oneParameterFlag) {  
                $sqlx .= " AND zipcode=?";
                 $sql2 .= " AND zipcode=?";
                 $sql3 .= " AND zipcode='$zipcode'";
            }
            else {  
                $sqlx .= " WHERE zipcode=?";
                  $sql2 .= " WHERE zipcode=?";
                  $sql3 .= " WHERE zipcode='$zipcode'";
            }
             $parameterString .= "i"; 
            $keywords .= ", ".$zipcode;   
        }

        if (isset( $_GET{'incr10'} )) {   
            $incr10 =  $_GET{'incr10'};
            //$incr
        }
        else {   
            $incr10 = 0;
        }

        if (isset( $_GET{'prev'} )) {   
            $prev =  $_GET{'prev'};
            //$incr
        }
        else {   
            $prev = 0;
        }

        $sqlx .= " ORDER BY oo_id DESC ".
                " LIMIT 10 OFFSET $incr10";
        $sql3 .= " ORDER BY oo_id DESC ".
                " LIMIT 10 OFFSET $incr10";

        $stmt = $conn->prepare($sqlx);
        $stmt2 = $conn->prepare($sql2);
        if (isset($confirmCode) && !isset($email) && !isset($zipcode)) { /*confirmcode */
            $stmt->bind_param($parameterString, $confirmCode);
            $stmt2 = $conn->prepare($sql2);
            $stmt->execute();
        }
        else if (isset($confirmCode) && isset($email) && isset($zipcode)) { /* confirmcode, email, zipcode */
             $stmt->bind_param($parameterString, $confirmCode, $email, $zipcode);
             $stmt2 = $conn->prepare($sql2);
            $stmt->execute(); 
        }
        else if (isset($confirmCode) && !isset($email) && isset($zipcode)) { /* confirmcode, zipcode */
             $stmt->bind_param($parameterString, $confirmCode, $zipcode);
             $stmt2 = $conn->prepare($sql2);
            $stmt->execute(); 
        }
        else if (isset($confirmCode) && isset($email) && !isset($zipcode)) {/* confirmcode, email*/
             $stmt->bind_param($parameterString, $confirmCode, $email);
             $stmt2 = $conn->prepare($sql2);
            $stmt->execute(); 
        }
        else if (!isset($confirmCode) && isset($email) && !isset($zipcode)) { /* email */
             $stmt->bind_param($parameterString, $email);
                $stmt2 = $conn->prepare($sql2);
            $stmt->execute(); 
        }
        else if (!isset($confirmCode) && !isset($email) && isset($zipcode)) { /* zipcode */
             $stmt->bind_param($parameterString, $zipcode);
             $stmt2 = $conn->prepare($sql2);
             $stmt->execute(); 
        }
        else if (!isset($confirmCode) && isset($email) && isset($zipcode)) { /* email, zipcode */
             $stmt->bind_param($parameterString, $email, $zipcode);
             $stmt2 = $conn->prepare($sql2);
             $stmt->execute(); 
        }
        else if (!isset($confirmCode) && !isset($email) && !isset($zipcode)) {   /* */
            $stmt->execute(); 
            $stmt2->execute(); 
        }

        /* For pagination: Need the same query except only this time need to count the number of results */
        //$sql2 = $sqlx;
        
        $result = $stmt->get_result();
        $numrows = $result->num_rows;


         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }

         $left_rec = $numrows - ($page * $rec_limit);
            
         $comma = strpos($keywords, ",");
         if ($comma == 0)
            $keywords = substr($keywords, 1);

        if ($numrows == 0) {
            print "<h4>No Search Results Found</h4>";
        }
        else {
                        print "<!-- CENTTERED COLUMN ON THE PAGE-->";
                        
                        print "<div id=\"divContainer\">";
                     
                        print   "<h1>Online Orders</h1>";
                        print       "<table class=\"formatHTML5\" >";
                     
                        print       "<!-- TABLE HEADER-->";
                        print           "<thead>";
                        print               "<tr><td colspan=3><b>Keywords:</b>&nbsp; $keywords</td></tr>";
                        print               "<tr>";
                        print                   "<th>Confirmation Code</th><th>Email</th><th>Purchase Date</th>";
                        print               "</tr>";
                        print           "</thead>".
                                            "<tbody>";
                while($row = $result->fetch_assoc() ) {
                    $code = $row['confirmCode'];
                    $checkoutEmail = $row['email'];
                    $date = $row['purchase_date'];
                    $orderID = $row['oo_id'];
                  
                        print           "<tr class=\"clickable-row\" data-href=\"{$orderID}\">".
                                            "<td>{$code}</td><td>{$checkoutEmail}</td><td>{$date}</td>".
                                        "</tr>";

                }
                        print           "</tbody>".
                                    "</table>".
                                "</div>";
                 $prev = $incr10 - 10 ;
                 $incr10 += 10;
                 $pageGetStringBuildNext = "<a href = \"listorders.php?incr10=$incr10";
                 $pageGetStringBuildPrev = "<a href = \"listorders.php?incr10=$prev";
                 if (isset($confirmCode)) {
                    $pageGetStringBuildNext .= "&orderconfirm=".$confirmCode;
                    $pageGetStringBuildPrev .= "&orderconfirm=".$confirmCode;
                }
                if (isset($email)){
                    $pageGetStringBuildNext .= "&email=".$email;
                      $pageGetStringBuildPrev .= "&email=".$email;
                }
                if (isset($zipcode)) {
                    $pageGetStringBuildNext .= "&zipcode=".$zipcode;
                    $pageGetStringBuildPrev .= "&zipcode=".$zipcode;
                }
                /* Finish the end of url GET string*/
                $pageGetStringBuildNext .= "\"> > </a>";
                $pageGetStringBuildPrev .= "\"> < </a>";
                ?>
                <div class="pagination">
                    <?
                    if ($prev != -10) {
                        echo "<div class=\"block\">";
                            echo $pageGetStringBuildPrev;
                        echo "</div>";
                    }
                        echo "<div class=\"block\">";
                            echo "<p>10</p>";
                        echo "</div>";
                    if ( moreNextResults($sql3, $incr10, $conn)) {
                        echo "<div class=\"block\">";
                            echo $pageGetStringBuildNext;
                        echo "</div>";
                    }
            }
                    ?>
                 </div>   
                </div>
                       
            </div>
        </div>        




    </div> <center/>
    <!-- /.container -->


    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>
    <script>
        $(".clickable-row").click(function() {
            window.location = "order.php?ooid=" + $(this).data("href");
        });
    </script>



</body>

</html>
