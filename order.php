<?php
require 'include/connect.php';
session_start();
ob_start();
date_default_timezone_set('America/Los_Angeles');

$orderID = $_GET["ooid"];

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

    <title>Add Package - REDUX</title>

    <!-- Bootstrap Core CSS -->
    <link href="css2/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />
    <link href="css2/searchtable.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="js2/jquery.js"></script>
    <script src="js2/custom.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

</head>

<body>

    <style >

 
    .col-lg-12.text-center.orderconfirm h3 {
        text-transform: none;
        font-family: "Josefin Slab","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-style: normal;
        font-size: 2.3em;
    }
   
     .col-lg-12.text-center.orderconfirm span {
      
        font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
       
        
    }

    .box .col-md-3 hr {
        font-weight: bold;
        font-size: 1.4em;
    }

    .tagline-dividerx {

        max-width: 90%;
        border-color: #999999;
        margin: 7px auto 3px;
    }
    .prods {
        padding-top: 30px;
    }
    .prodlist  {
        text-align: left;
    }
    
    #gay.box h5, h6 {
        font-family: Helvetica, "Trebuchet MS", Verdana, sans-serif;
    }
    .container2{
        width: 90%;
    }
    .missingName{
        color: #E18062;
      
    }
     .missingName span{
     
        text-transform: lowercase;
    }
    input {
        text-align: center;
    }

    </style>

    <script>
         
    </script>

    <?  /*
            Retrive order information with the order ID.
        */
        function checkVeryEdgeCase( $email,  $orderid, $connObj ) {
            $sql = "SELECT cid FROM Customers WHERE email='$email' ";
            $result = $connObj->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $custid = $row['cid'];
                return $custid;
            }
            return -1;
        }
        function mergeGiftToCustomerEdgeCase($orderid, $custid, $connObj) {
            $sql = "UPDATE Online_Orders SET cust_id='$custid' WHERE oo_id='$orderid'";
            $result = $connObj->query($sql);

            $sql = "SELECT firstname, lastname FROM Customers WHERE cid='$custid'";
            $result = $connObj->query($sql);
            $row = $result->fetch_assoc();
            $firstn = $row['firstname'];
            $lastn = $row['lastname'];
            $arrName = array($firstn, $lastn);
            return $arrName;
        }

        function isPackageGift($packID, $connObj) {
            $sql = "SELECT gid FROM Gifts WHERE pid='$packID'";
            $result = $connObj->query($sql);
            if ($result->num_rows > 0) {
                return true;
            }
            return false;
        }

        $lookup_customerID = "SELECT cust_id, confirmCode, email, timestamp, zipcode FROM Online_Orders WHERE oo_id='$orderID' ";
        $result = $conn->query($lookup_customerID);

        $row = $result->fetch_assoc();
        $cid = $row['cust_id'];
        $confimation = $row['confirmCode'];
        $email = $row['email'];
        $zip = $row['zipcode'];

        $purchasedate = $row['timestamp'];
        if ($cid == NULL) {
        
            $isCustomer = checkVeryEdgeCase($email, $orderID, $conn);
            if ($isCustomer != -1) {
                $fullname = mergeGiftToCustomerEdgeCase($orderID, $isCustomer, $conn);
                $firstname = $fullname[0];
                $lastname = $fullname[1];
                 $emailLabel = "Email";
            }
            else {
                 $firstname = "N/A";
                $lastname = "N/A";
                $emailLabel = "Email (checkout)";
            }
            
            
        }
        else {
            echo "NOT NULL";
            echo "cid: ".$cid;
            echo "\n";
            $emailLabel = "Email";
            $lookup_customerName = "SELECT firstname, lastname FROM Customers WHERE cid='$cid' ";
            $result = $conn->query($lookup_customerName);
            $row = $result->fetch_assoc();
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }

        

    ?>
<div class="dark">
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

    <center> <div class="container2">

        <div class="row">
            <div class="col-lg-12 text-center orderconfirm">
               <?
                echo "<h3>Order Confirmation: <span><b>{$confimation}</b></span></h3> ";
                ?>
            </div>
        </div>


        <div id="gay" class="box">
            <div class="row" id="orderdetails">
                <div class="col-md-4">
                    
                        <?
                        echo "<h5 id=\"emlabel\">$emailLabel</h5>";
                        ?>
                    <hr class="tagline-dividerx">
                    <?
                        if ($cid != NULL)
                            echo "<h6 class=\"clickable-email\" id=\"src-email\" data-href=\"$cid\">{$email}</h6>";
                        else
                             echo "<h6 id=\"src-email\">{$email}</h6>";
                    ?>
                </div>
                    
                <div class="col-md-5">
                        <h5>Name</h5>
                    <hr class="tagline-dividerx">
                        
                        <?
                            if ($firstname == "N/A")
                                print "<h5 class=\"missingName\">N/A <span>(customer not on file)</span></h5>";
                            else
                                print "<h5>$firstname $lastname</h5>";
                        ?>
                </div>

                <div class="col-md-2">
                   
                        <h5>Purchase Date</h5>
                    <hr class="tagline-dividerx">
                        <?
                            echo "<h5>{$purchasedate}</h5>";
                        ?>
                </div>

                <div class="col-md-1">
                   
                        <h5>Zipcode</h5>
                       <hr class="tagline-dividerx">
                    <?
                            echo "<h5>{$zip}</h5>";
                        ?>
                </div>
            </div>

       
           
                     <?
                        $sql = " SELECT Products.textDescription, Packages.cid, Packages.pid, Packages.charged_amt
                         FROM Products
                         INNER JOIN Packages ON Packages.prod_id = Products.prod_id
                         INNER JOIN Online_Orders ON Packages.oo_id = Online_Orders.oo_id
                         WHERE Online_Orders.oo_id='$orderID' ";

                        $getTotalSql = "SELECT chargeAmount 
                            FROM Online_Orders WHERE oo_id='$orderID'";

                        $result2 = $conn->query($getTotalSql);
                        $row2 = $result2->fetch_assoc();
                        $total = $row2['chargeAmount'];

                    ?>
                <div id="divContainer">
                    <h1>Order Details</h1>
                        <table id="myTable" class="formatHTML5" >
                        <!-- TABLE HEADER-->
                        <thead>
                            <tr><td colspan=4></td></tr>
                            <tr>
                                <th></th><th>Product</th><th>Amount</th><th>Gift</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?
                                   $ctr = 1;
                            if ($result = $conn->query($sql)) {
                                $danglingPackageFlag = false;

                                while ($row = $result->fetch_assoc() ) {

                                    $isg = isPackageGift($row['pid'], $conn);
                                    $customerid = $row['cid'];
                                    $isgift = "";
                                     if ($cid == NULL && !$isg) {
                                        $isgift = "NO";
                                        print "<tr class=\"giftrow\">";
                                        $danglingPackageFlag = true;
                                        
                                    }
                                    else if ($isg) {
                                        $isgift = "YES";
                                         print "<tr class=\"clickable-row\" data-href=\"{$customerid}\">";
                                       
                                    }
                                    else if ($cid != NULL & !$isg) {
                                        $isgift = "NO";
                                        print "<tr class=\"clickable-row\" data-href=\"{$customerid}\">";
                                        
                                    }
                                   
                                    print "<td>$ctr</td>";
                                    print "<td>{$row['textDescription']}</td>";
                                   
                                    print "<td>{$row['charged_amt']}</td>";
                                    print "<td>{$isgift}</td>";
                                    print "<tr>";
                                    $ctr++;
                                }
                            } 
                                ?>
                            </tbody>
                        </table>
                    </div>


       <!--</table> -->

        <h3 id="total">Total: $<? print $total ?></h3>
        <div class="mergearea">
            <? 
                if ($danglingPackageFlag)  {
                    print "<div type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"myButton\" id=\"myBtn\" data-whatever=\"@getbootstrap\">Create Customer and Merge Packages</div>";
                }
            ?>
        </div>  

        <div class="newcust">
        
        </div>

                        
        </div>      
        <!--End Box -->
    </div>
       
  

    </div> <center/>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">New Profile</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <form id="myForm">
                         <div class="form-group">
                           <label for="email" class="col-form-label">*Email:</label>
                           <input type="text" class="form-control" id="email" value="ssss@email.com" disabled/>
                         </div>
                         <div class="form-group">
                           <label for="first-name" class="col-form-label">*First Name:</label>
                           <input type="text" class="form-control" id="username" required="" />
                         </div>
                          <div class="form-group">
                           <label for="last-name" class="col-form-label">*Last Name:</label>
                           <input type="text" class="form-control" id="password" required="" />
                         </div>
                         <div class="form-group">
                           <label for="phone-num" class="col-form-label">Phone:</label>
                           <input id="phone" name="telNo" type="tel" onblur="formatPhone(this)" class="form-control" onkeypress="formatPhone(this);"/>
                         </div>

                           <div class="form-group">
                            <label class="form-label ">Interest:</label>
                               <input class="form-control" id="fitness" type="checkbox" name="fitness" value="fitness">Fitness
                               <input class="form-control" id="beauty" type="checkbox" name="beauty" value="beauty">Beauty
                               <input class="form-control" id="wellness" type="checkbox" name="wellness" value="wellness">Wellness
                           </div>

                           <div class="form-group">
                                <label class="form-label">Age:</label>
                                   <input type="number"  class="form-control"  id="age" name="age" min="0" max="100"/>
                           </div>

                             <div class="form-group">
                               <label class="form-label">Gender:</label>
                                    <select  class="form-control" id="gender" name="gender">
                                       <option  class="form-control" value="" selected disabled> <strong>Please select</strong></option>
                                       <option  class="form-control" id="Male" value="M">Male</option>
                                       <option  class="form-control" id="Female" value="F">Female</option>
                                   </select>
                           </div>

                           <div class="form-group">
                             <label class="form-label">Referral:</label>
                                <select  class="form-control" id="referral" name="referral">
                                   <option  class="form-control" value="" selected disabled> <strong>Please select</strong></option>
                                   <option  class="form-control" id="google" value="google">Google</option>
                                   <option  class="form-control" id="facebook" value="facebook">Facebook</option>
                                   <option  class="form-control" id="friend" value="friend">Family/Friend</option>
                                   <option class="form-control" id="street" value="street">Steet/Passing By</option>
                                   <option class="form-control" id="yelp" value="yelp">Yelp</option>
                                   <option  class="form-control" id="other" value="other">Other</option>
                               </select>
                           </div>

                           <input type="hidden" id="preferredFirst" value="">
                           <input type="hidden" id="preferredLast" value="">
                           <?
                           print "<input type=\"hidden\" id=\"order\" value=$orderID >";
                           ?>
                           

                       </form>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="button" id="btnLogin" class="btn btn-primary">Create Customer</button>
                     </div>
                   </div>
                 </div>
           </div>

   

    <!-- /.container -->

   
    
     <script src="js2/updateOrder.js"></script>
     <script src="js2/order.js"></script>

    <script>
       function formatPhone (obj) {
            var numbers = obj.value.replace(/\D/g, ''),
            char = {0:'(',3:') ',6:' - '};
            obj.value = '';
            for (var i = 0; i < numbers.length; i++) {
                obj.value += (char[i]||'') + numbers[i];
            }

        }

  </script>
    

    <style>

    .row#orderdetails  {
        padding-bottom: 4%;
    }
    .clickable-email  {
        cursor: pointer;
        font-weight: bold;
        color: #6093e7;

    }

    .dark{


   }
    #myModal {
        z-index: 8888;
    }
    .newcust {
        padding-top: 20px;
        font-size: 1.1em;
    }

td {

 border: 1px solid rgb(190,190,190);

}


#myTable .giftrow td {
    background-color:  #E18062;
}


.mergearea {
    padding-top: 30px;
}
.myButton {
   
 
    background-color: #E18062;
    -moz-border-radius:6px;
    -webkit-border-radius:6px;
    border-radius:6px;
 
    display:inline-block;
    cursor:pointer;
    color: #fff;
    font-family:Arial;
    font-size:15px;
    font-weight:bold;
    padding:16px 65px;
    text-decoration:none;
    
}
.myButton:hover {
    background-color: #E1A08D;
}
.myButton:active {
    position:relative;
    top:1px;
}

h3 {
    font-size: 24px;
    font-weight: 700;
}

#total {
    font-family: Arial;
    letter-spacing: 1px;
    font-size: 26px;
    font-weight: 700;
}

caption {

 padding: 10px;

}
    </style>

</body>

</html>
