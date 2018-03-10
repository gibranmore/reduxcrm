<?php
require 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');

ob_start();

if (!isset($_SESSION["pwrd"]))  {

    die("You are not allowed here");

}

        $rec_limit = 10;
        $sql = "SELECT count(cid) FROM Customers ";
        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            //$rec_count = $row["cid"];
            //var_dump($row);
            $rec_count = $row["count(cid)"]; 
            //echo ">>reccount".$rec_count."<br>";
        }
        else
            echo "COUld not get data";
         
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql = "SELECT cid, email, preferredFirstName, preferredLastName, phoneNumber, dateadded ". 
            "FROM Customers 
            ORDER BY cid DESC
            LIMIT $offset, $rec_limit";    

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
        div#divContainer td {
            line-height: 2.4;
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
                        <a href="searchcustomer.php">Add Client</a>
                    </li>

                    <li>
                        <a href="addcustomer.php">Search Client</a>
                    </li>

                     <li>
                        <a href="addcustomer.php">Search Online Orders</a>
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
    <div class="clientresults">
        <div id="divContainer">
                <h1 class="blue">Customers</h1>
                    <table class="formatHTML5" >
                            
                        <!-- TABLE HEADER -->
                            <thead >

                                 <tr>
                                    <th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Customer since</th>
                                </tr>
                            </thead>
                                 <tbody >
                                     <?php
                                        $result = $conn->query($sql);
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
                            
                    </table>
        </div>
        <div class="cust-pagination">
           <?php if($page > 0 && $left_rec > $rec_limit) : ?>
                  <? 
                    $last = $page - 2;
                  ?>
                    <a href=<? print "list.php?page=$last"; ?> class="btn btn-primary btn-lg pagin">
                        <span class="glyphicon glyphicon-chevron-left"></span>Prev 10
                    </a>
                    <a href=<? print "list.php?page=$page"; ?>  class="btn btn-primary btn-lg pagin">
                        <span class="glyphicon glyphicon-chevron-right"></span>Next 10
                    </a>
            <?php elseif( $page == 0 ) : ?>
                    <a href=<? print "list.php?page=$page"; ?> class="btn btn-primary btn-lg pagin">
                        <span class="glyphicon glyphicon-chevron-right"></span>Next 10
                    </a>
            <?php elseif( $left_rec <= $rec_limit ) : ?>
                    <? 
                        $last = $page - 2;
                    ?>
                    <a href=<? print "list.php?page=$last";  ?> class="btn btn-primary btn-lg pagin" >
                        <span class="glyphicon glyphicon-chevron-left"></span>Prev 10
                    </a>
            <?php endif; ?>

        </div>
    </div>

   
   

    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>

    <script src="js2/cssTableOverride.js" ></script>


</body>

</html>
