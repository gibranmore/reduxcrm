<?php
    require_once 'include/connect.php';
    session_start();
    ob_start();
    date_default_timezone_set('America/Los_Angeles');
    $custID = $_GET["id"];

    if (!isset($_SESSION["pwrd"]))  {
        die("You are not allowed here");
    }

    function lookup_packtype_textdes_translation($numrowResultSet,  $packtype4, $product_id, $name) {
                                        $textDesSessType = "";

                                        if ($product_id == 15 ) {
                                            $textDesSessType = "Localized Cryo Session";
                                           
                                        }
                                        else if ($packtype4 == 1 && $numrowResultSet == 1 && $product_id != 15 ) { 
                                            /* Client has been at REDUX 1 time before, and he didn't do a package session and he didn't get a localized cryo */
                                            $textDesSessType = "First Ever Session";
                                          
                                        }
                                        else if ($packtype4 == 1 && $product_id == null) {
                                            $textDesSessType = "One Individual Session";
                                             
                                        }
                                        else if ($packtype4 == 1 && $product_id == 2) {
                                            $textDesSessType = "One Individual Session";
                                            
                                        }
                                        else if ($packtype4  == 3)
                                            $textDesSessType = "Trinity (3) Session";
                                        else if ($packtype4 == 5 )
                                            $textDesSessType = "Penta (5) Session";
                                        else if ($packtype4 == 10)
                                            $textDesSessType = "Deca (10) Session";
                                        else if ($packtype4 == 15)
                                            $textDesSessType = "Localized Session";
                                        else if ($packtype4 == 1000) 
                                            $textDesSessType = "Membership Session";
                                        else 
                                            $textDesSessType = $name." (Miscelenous Package)";

                                return $textDesSessType;                

    }
    $localCryoPrice = 29.00;

                        $sqlquery = "SELECT email, firstname, lastname, phoneNumber, age, gender, dateadded, ".
                        " preferredFirstName, preferredLastName, isRaiders, interest ".
                       " FROM Customers WHERE cid = '$custID' ";

                        if ($result = $conn->query($sqlquery)) {

                           
                            $row = $result->fetch_assoc();
                            $email = $row['email'];
                            $email = strtoupper($email);

                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            
                            $phone = $row['phoneNumber'];
                            if ($phone == null || $phone == "")
                                $phone = "- -";
                            
                            $age = $row['age'];
                            if ($age == null || $age == "" || $age == 0)
                                $age = "- -";

                            $gender = $row['gender'];

                            if ($gender == null || $gender == "")
                                $gender = "- -";

                            $interest = $row['interest'];
                            $interest = str_replace("," , "  " , $interest);

                            if ($interest == null || $interest == "")
                                $interest = "- -";

                            $date = $row['dateadded'];
                            $isRaiders = $row['isRaiders'];

                            $preferredFirst = $row['preferredFirstName'];
                            $preferredLast = $row['preferredLastName'];
                           if ($preferredFirst == null || $preferredFirst == "" ||  $preferredLast == null || $preferredLast == "") {
                                $preferredFirst = $firstname;
                                $preferredLast = $lastname;

                                $preferredFirst = strtoupper($preferredFirst);
                                $preferredLast = strtoupper($preferredLast);
                            }
                            
                        }
                        else
                            echo "<h1>SOME ERROR OCCURRED</h1>";

                        $todaysdate = date("Y-m-d");
                        $timex = strtotime($todaysdate." -30 days");
                        $newdate = date("Y-m-d", $timex);
                        

                        $sqlMembershipCheck = "UPDATE Packages SET sessionsleft = 0 WHERE packageType = 1000 AND datepurchased < '$newdate'";

                        $updateresult = mysqli_query($conn, $sqlMembershipCheck);
                        if (!$updateresult)  {

                            print "ERROR occured while checking for expired memberships<br>";
                        }
                         $packType = 1;
                        $var = 4;
                        /* This result set is used for the table of packages displayed in the Profile */
                        $sqlquery2 = "SELECT Packages.pid, Packages.packageType, Packages.sessionsleft, Packages.datepurchased, Packages.Name, 
                                        Packages.oo_id,  Packages.Name,
                                        Packages.charged_amt,
                                        Packages.prod_id
                                         FROM Packages 
                                       
                                        WHERE cid='$custID' 
                                        ORDER BY Packages.sessionsleft DESC";

                        /* Need second copy of the previous query result to make a determination of whether or not client has an active NON-local cryo package. 
                        If I use the first result set, then I wont' be able to 'extract' again the first row of result set*/
                        $sqlquery3x = "SELECT Packages.pid, Packages.packageType, Packages.sessionsleft, Packages.datepurchased, Packages.Name, 
                                        Packages.oo_id, Packages.Name,
                                        Packages.charged_amt,
                                        Packages.prod_id
                                        FROM Packages 
                                        
                                        WHERE cid='$custID' AND Packages.prod_id !=15
                                        ORDER BY Packages.sessionsleft DESC";

                        /* This query is for checking only an active package of localized sessions. Notice again we are ordering with the topmost 
                            having the most amount of sessions remaining. This way we can fetch row once and make determination of whether
                            there is an active package of localized sessions */
                        $sqlquery5 = "SELECT Packages.pid, Packages.packageType, Packages.sessionsleft, Packages.datepurchased, Packages.Name, 
                                        Packages.oo_id, Packages.Name,
                                        Packages.charged_amt,
                                        Packages.prod_id
                                        FROM Packages 
                                        WHERE cid='$custID' AND Packages.prod_id=15
                                        ORDER BY Packages.sessionsleft DESC";
                         $activePackageLocalFlag = false;
                         $res5 = $conn->query($sqlquery5);

                        if ($res5->num_rows >= 1) {
                            $row = $res5->fetch_assoc();
                            if ($row['sessionsleft'] > 0)
                                $activePackageLocalFlag = true;
                        }



                        
                       

                       
                        if ($result2 = $conn->query($sqlquery2)) {

                                $prodTypeSingleSession = 0 ; /* This variable holds a 1 or a 2. It represents the prod_id of a single session
                                                                determined by whether or not the the customer has previously completed a session
                                                                with REDUX */
                                $sqlquery3 = "SELECT cid FROM Sessions WHERE cid='$custID' ";

                                if ($result3 = $conn->query($sqlquery3)) {

                                    if ($isRaiders > 0) {

                                        $singleSessionPrice = 0.00;
                                        $prodTypeSingleSession = 2;
                                    }   
                                    else if ($result3->num_rows >= 1) {
                                        $singleSessionPrice = 65.00;
                                        $prodTypeSingleSession = 2;
                                    }
                                    else {
                                        $singleSessionPrice = 40.00;
                                        $prodTypeSingleSession = 1;
                                    }
                                }
                                else
                                    echo "<p>Some error occured while querying the database</p>";


                                $res3x = $conn->query($sqlquery3x);
                                $activePackageNonLocalFlag = false; //means Client has any packages with sessions left
                                $hasPackages = false; // means any past packages, active or otherwise 
                                if ( $res5->num_rows >= 1 || $result2->num_rows >= 1)   { /* Found Pakages. Don't yet know whether any of them has sessions left */
                                    $hasPackages = true;
                                    /* Query result set is Ordered in descending order by sessionsleft, so I can make determination as follows*/
                                    $row = $res3x->fetch_assoc();
                                    if ($row['sessionsleft'] > 0) {
                                        $activePackageNonLocalFlag = true;
                                    }
                                    /*
                                    else if ($row['sessionsleft'] == 0) {
                                        $activePackageFlag = false;
                                    }
                                    */
                                } 
                                else {
                                    $hasPackages = false;
                                }   


                                /* RECENT ACTIVITY */
                                $sqlquery4 = "SELECT Sessions.date, Sessions.packageType, Sessions.prod_id
                                            FROM Sessions
                                            WHERE cid='$custID' ORDER BY sid DESC LIMIT 1";

                                $sqlquery44 = "SELECT Sessions.date, Sessions.packageType, Sessions.prod_id
                                            FROM Sessions
                                            WHERE cid='$custID' ORDER BY sid";

                                $result44 = $conn->query($sqlquery44);



                                if($result4 = $conn->query($sqlquery4)) {

                                    if ($result4->num_rows >= 1) {
                                        $row4 = $result4->fetch_assoc();

                                        $datevisited = $row4["date"];
                                        $packtype4 = $row4["packageType"];
                                        $product_id = $row4["prod_id"];

                                        $textDesSessType = "";

                                        if ($product_id == 15 ) {
                                            $textDesSessType = "Localized Cryo Session";
                                           
                                        }
                                        else if ($packtype4 == 1 && $result44->num_rows == 1 && $product_id != 15 ) { 
                                            /* Client has been at REDUX 1 time before, and he didn't do a package session and he didn't get a localized cryo */
                                            $textDesSessType = "First Ever Session";
                                          
                                        }
                                        else if ($packtype4 == 1 && $product_id == null) {
                                            $textDesSessType = "One Individual Session";
                                             
                                        }
                                        else if ($packtype4 == 1 && $product_id == 2) {
                                            $textDesSessType = "One Individual Session";
                                            
                                        }
                                        else if ($packtype4  == 3)
                                            $textDesSessType = "Trinity (3) Session";
                                        else if ($packtype4 == 5 )
                                            $textDesSessType = "Penta (5) Session";
                                        else if ($packtype4 == 10)
                                            $textDesSessType = "Deca (10) Session";
                                        else if ($packtype4 == 15)
                                            $textDesSessType = "Localized Session";
                                        else if ($packtype4 == 1000) 
                                            $textDesSessType = "Membership Session";
                                        else
                                            $textDesSessType = "Manual Package Session";
                                       
                                    }

                                }
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <title>Client Profile - REDUX</title>

        <!-- Bootstrap Core CSS -->
        <link href="css2/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css2/business-casual.css" rel="stylesheet">
        <link href="css2/searchtable.css" rel="stylesheet">
        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />

          <link href="css2/profile.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
      
           <!-- Bootstrap Core JavaScript -->
        <script src="js2/bootstrap.min.js"></script>
    </head>

    <body> 

        
        <div class="reduxBrand">
            <h1>R<span>EDU</span>X</h1>
        </div>
        <div class="address-bar">Client Profile</div>

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
                    <a class="navbar-brand" href="index.html">Business Casual</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
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
                    
                    
                    <?php


                        

                        
                    ?>
                    
                </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="profx">
           
            <div class="profile"> 
                <div class="clientinfo boxy">
                    <div class="row">
                         <div class="col-lg-12">
                           
                            <h2 class="intro-text text-center"> Client <strong>Information</strong>
                                
                            </h2>
                        
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row content">
                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="well">
                                        <h2 class="name"><?php echo $preferredFirst."  ".$preferredLast ?> </h2>
                                        
                                            <!-- <button type="button" class="btn btn-primary">Edit Name</button>-->
                                            <input type="button" data-toggle="modal" data-target="#nameModal" class="buttonx button6 editstuff" value="edit name" />
                                    
                                    </div>

                                     <div class="well">
                                        <h2><?php echo $email ?></h2>

                                    </div>

                                     <div class="well">
                                        <h2>Client Since: <?php echo $date ?></h2>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-sm-3">
                                      <div class="well">
                                        <h2>Phone</h2>
                                        <p><?php echo $phone ?></p> 
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="well">
                                        <h2>Age</h2>
                                        <p><?php echo $age ?></p> 
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="well">
                                        <h2>Gender</h2>
                                        <p><?php echo $gender ?></p> 
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="well">
                                        <h2>Customer ID</h2>
                                        <p id="idCustomerID"><?php echo $custID ?></p> 
                                      </div>
                                    </div>
                            </div>

                            <div class="well">
                                <h2 class="name">Interests: <?php echo $interest ?> </h2>
                            </div>
                        
                        </div>
                    </div>


                    <div class="clearfix"></div>
                </div>
            </div>

                    <div class="row">
                        <div class="boxy activity">
                             <div class = "container">
                               
                                <h2 class="intro-text text-center blue"> Last Client Activity </h2>
                                <?php
                                   

                                if (isset($datevisited)) {

                                ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="lastactivity">
                                                     <h3>Date Last Visited: </h3>
                                                     <p><? echo $datevisited ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="lastactivity">
                                                    <h3>Session Type: </h3>
                                                     <p><? echo $textDesSessType ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    
                                   }
                                    else {
                                       print "<h2>No Client Activity</h2>";
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>

           
                   
                        <div id="sessions">
                            <div class="boxy">
                                <div class="container xx">
                                    <?php if (!$activePackageNonLocalFlag): ?>
                                        <div class="sessbtn">
                                            <div class="buttonx button6 sessions" data-toggle="modal" data-target="#modalWBC">Complete a WBC Session</div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!$activePackageLocalFlag): ?>
                                        <div  class="sessbtn">
                                            <div class="buttonx button6 sessions" data-toggle="modal" data-target="#modalLocal">Complete a localized Session</div>
                                        </div>
                                     <?php endif; ?>
                                        
                                </div>
                            </div>
                        </div>
                    
        

            <div class="modal fade" id="modalWBC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">

                  <div class="modal-body">
                    <h2>Charge Customer  <?echo "$".number_format($singleSessionPrice, 2) ?></h2>
                    <input id="wbc-sess-submit" type="hidden" value="<?php echo $singleSessionPrice ?>" />
                  </div>
                  <div class="modal-footer">
                    <button id="confirmsinglex" data-packtype="1" data-prodid="<?php echo $prodTypeSingleSession ?>" type="button" class="btn btn-primary">Charge and Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalLocal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">

                  <div class="modal-body">
                    <h2>Charge Customer  <?echo "$".number_format($localCryoPrice, 2) ?></h2>
                    <input id="local-sess-submit" type="hidden" value="<?php echo $localCryoPrice ?>" />
                  </div>
                  <div class="modal-footer">
                    <button id="confirm-localx" data-packtype="1" data-prodid="15" type="button" class="btn btn-primary">Charge and Submit</button>
                    <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Edit Name Modal - Start -->
            <div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="editname">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">First Name:</label>
                            <input id="firstname" type="text" class="form-control input-lg" id="recipient-name" required="">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Last Name:</label>
                            <input id="lastname" type="text" class="form-control input-lg" id="recipient-name" required="">
                        </div>
                          <p class="successname"></p>
                          <p class="failname"></p>

                  </div>
                  <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="formbtn" class="button button6" value="Save"/>
                    </form>
                  </div>
                </div>
              </div>
            </div> <!-- Edit Name Modal - End -->
            
           <div class="row">
            <div class="boxy packages">
                <div >
             
            
            <?php
                /* Need to be able to go to the "Add Package' page when the customer is lacking either type cryo package: local or non-local*/
                if (!$activePackageLocalFlag || !$activePackageNonLocalFlag)  { 

            ?>     
                <div class="active"> 
                    <h2>No active packages</h2>
             <?php
                    print"<a href=\"addPackage.php?id=$custID&name=$preferredFirst&lastname=$preferredLast\" class=\"buttonx button6 fuc\">Add a Package</a> ";

                }
             ?>
                </div>
             <?php
                /*  Show the history of past packages */
                if ( $hasPackages) {
                    print "<div class=\"outerTableContainer\">";
                }
            ?>          
                     <div id="divContainer">
                        <h1>Packages</h1>
                        <table id="myTable" class="formatHTML5" >
                            <div >
                        <!-- TABLE HEADER -->
                            <thead >
                               <!--  <tr>
                                    <td colspan=8></td>
                                </tr>  -->
                                <tr>
                                    <th>ID</th><th>Product</th><th>Sessions</th><th>Sess. left</th><th>Online Order ID</th><th>Date Purchased</th><th>Charged</th><th></th>
                                </tr>
                            </thead>
                                 <tbody>
                                    <? //Packages.pid, Packages.packageType, Packages.sessionsleft, Packages.datepurchased, Packages.Name, 
                                       // Packages.oo_id, Products.textDescription, Products.num_of_sessions
                                    $numResults = $result2->num_rows;
                                  
                                    while ($row = $result2->fetch_assoc() ) {
                                    
                                          
                                        if ($row['sessionsleft'] == 0)  {
                                            print "<tr class=\"usedpack\">";
                                        }
                                        else {
                                            print"<tr>";
                                        }
                                                print"<td>{$row['pid']}</td>";

                                                $text = lookup_packtype_textdes_translation($numResults, $row['packageType'], $row['prod_id'], $row['Name']);

                                                $ooid = $row['oo_id'];
                                                $charged = "$".$row['charged_amt'];

                                                if ($ooid == NULL)
                                                    $ooid = "-- -- --";
                                                
                                                print"<td>$text</td>";
                                                print"<td>{$row['packageType']}</td>";
                                                print"<td>{$row['sessionsleft']}</td>";
                                                print"<td>$ooid</td>";
                                                print"<td>{$row['datepurchased']}</td>";
                                                print"<td>$charged</td>";
                                            if ($row['sessionsleft'] == 0) {
                                                print"<td>-- -- --</td>";   
                                            }
                                            else {
                                                print"<td class=\"wrapuse\">
                                                    <div class=\"usesession\" data-packtype=\"{$row['packageType']}\" data-packid=\"{$row['pid']}\" data-prodid=\"{$row['prod_id']}\">Use Session</div>
                                                </td>"; 
                                            }                                      
                                            print"</tr>";
                                            
                                    }
                                      
                                    ?>
                                </tbody>
                            </div>
                        </table>
                    </div>
                <?php
                    if ($hasPackages)  {
                        print "</div>  <!-- End outerTableContainer -->";
                    }
                ?>
                

            
       
                </div>
            </div> <!-- end - Active Packages class=box packages-->
        </div>  <!-- end - Active Packages clas=row-->
       <script src="js2/profilefuncs.js"></script>
    </body>
</html>
