<?php
ob_start();
require_once 'include/connect.php';
session_start();
date_default_timezone_set('America/Los_Angeles');



if (!isset($_SESSION["pwrd"]))  {

    die("You are not allowed here");

}
?>

    <?php
    $emptyErr = $emailErr = $passMatchErr = $emailExErr = $passLenErr = $fullnameErr = "";
    $email = "";
    $referral = $age = $phone = $fitness = $beauty = $wellness = "";
    
    if(isset($_POST['wellness']))
            $wellness = 'wellness';
    if(isset($_POST['beauty']))
            $beauty = 'beauty';
    if(isset($_POST['fitness']))
            $fitness= 'fitness';


    

    $setstring = $beauty.",".$fitness.",".$wellness;

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {



        $email = $_POST['email'];
        $email = strtoupper($email);

        $firstname = $_POST['firstname'];
        $firstname = strtoupper($firstname);
        
        $lastname = $_POST['lastname'];
        $lastname = strtoupper($lastname);
        
        $age = $_POST['age'];
        
        if(isset($_POST['referral']))
            $referral = $_POST['referral'];

        if(isset($_POST['gender']))
            $gender = $_POST['gender'];
        
        $phone = $_POST['customfield_10117'];

        $date = date('Y-m-d');

        $query = "SELECT email FROM Customers WHERE email='$email'";
        $result = $conn->query($query);
        
        $query2 = "SELECT firstname FROM Customers WHERE firstname='$firstname' AND lastname='$lastname'";
        $result2 = $conn->query($query2);
        
        if($email== "" || $firstname == "" || $lastname == ""  ){
            $emptyErr = "You left something empty. Fix that!";
        }
       
        else if($result->num_rows >= 1){
            $emailExErr = "Email already exists. Fix that!";
        }
        else if($result2->num_rows >= 1){
            $fullnameErr = "Name and Last name combination already exists. Fixx that!";
        }
        else{
            $q = "INSERT INTO Customers (firstname, lastname, email, phoneNumber, age, gender, referral, interest, dateadded) values ('$firstname', 
                '$lastname', '$email', '$phone', '$age', '$gender', '$referral', '$setstring' , '$date' )";
            //INSERT INTO pizza VALUES (""), ("pepperoni"), ("anchovies,tuna")
            $res = mysqli_query($conn, $q);
            if (!$res)
            {
              //echo "<h1>*Error Occured while inserting customer</h1>";
              
            }
            else
            {
                
                //echo "<h1>Successfully added new customer</h1>";
                
                $sqlquery = "SELECT cid FROM Customers ORDER BY cid DESC LIMIT 1";

                        if ($result = $conn->query($sqlquery)) {
                            $row = $result->fetch_assoc();

                             $id = $row['cid'];
                        }
                        else
                        /*
                            echo "<h1>SOME ERROR OCCURRED</h1>";
                        */
                /*
                $host = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = "profile.php?id=";
                $extra = $extra.$id;
                header("Location: http://$host$uri/$extra");
                */

                header("Location: profile.php?id=$id");
                //header("Location: index.php");
                
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

    <title>Sign Up - REDUX</title>

    <!-- Bootstrap Core CSS -->
    <link href="css2/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">

    <link href="css2/textinput.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />  

     <link href="css2/bootstrap4.css" rel="stylesheet"/>

     <!-- <link href="css2/mdb/css/mdb.css" rel="stylesheet"/>
     <link href="css2/mdb/css/style.css" rel="stylesheet"/> -->

      <script src="js2/jquery.js"></script>
     <script src="js2/addcust.js"></script>

      <!--<script src="js2/mdb.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

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
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li class="activex">
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


    <!--<div class="errormessages">
    <?php           

                    echo $emptyErr; 
                    echo $fullnameErr;
                    echo $passMatchErr;
                    echo $emailExErr;
                    echo $passLenErr;
                    echo "<br>";
        
    ?>
    </div> -->
    
    

        <div class="addclient boxy">
           
            <h2 class="intro-text text-center">Create New Client</h2>

            <form id="target" name="myForm">
                        <div class="textinput">
                               
                             <label>
                                 <input name="email" type="email" id="email" name="cardholder-name" class="field is-empty required" placeholder="janedoe@email.com" />
                                    
                                     <span>
                                          <p id="emailerror" class="inerror"></p>
                                        <span>Email</span>
                                    </span>
                            </label>

                           

                            <label>
                                 <input id="firstname" name="firstname" class="field is-empty alphaValidate required" placeholder="Jane" />
                                     <span>
                                          <p id="fnameerror" class="inerror"></p>
                                        <span>ID First Name</span>
                                    </span>
                            </label>

                             <label>
                                 <input id="lastname" name="lastname" class="field is-empty alphaValidate required" placeholder="Doe" />
                                     <span>
                                          <p id="lnameerror" class="inerror"></p>
                                        <span>ID Last Name</span>
                                    </span>
                            </label>
                                  
                            <label>
                                <input id="phone" name="phone" class="field is-empty secinfo" type="tel" placeholder="(123) 456-7890" onkeypress="formatPhone(this);"/>
                               
                                <span>
                                     <p id="phoneerror" class="inerror"></p>
                                    <span>Phone number</span>
                                </span>
                            </label>
                             
                              <label id="agelabel">
                                 <input type="number" id="age" name="age" class="field is-empty secinfo" type="num" min="1" max="100"/>
                                <span><span>Age</span></span>
                              </label>
                              
                                <div class="referral row">
                                    <div class="col-md-12">
                                        <select id="referral" name="referral" class="styled-select black rounded secinfo">
                                                    <option value="" selected disabled>Referral Method</option>
                                                    <option id="google" value="google">Google</option>
                                                    <option id="facebook" value="facebook">Facebook</option>
                                                    <option id="friend" value="friend">Family/Friend</option>
                                                    <option id="street" value="street">Steet/Passing By</option>
                                                    <option id="yelp" value="yelp">Yelp</option>
                                                    <option id="other" value="other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="gender row">
                                  
                                        <div class="col-md-12">  
                                            <select id="gender" name="gender" class="styled-select black rounded secinfo">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option id="Male" value="M">Male</option>
                                                            <option id="Female" value="F">Female</option>
                                                        </select>                    
                                        </div>                                     
                                </div>
                                <div class="row int">
                                    <div class="form-group">
                                        <div class="bootstrap4" >
                                            <div >
                                                <div class="aligncenter">
                                                     <label class="white">Interest:</label>
                                                </div>  
                                                <div class="align">
                                                    <div class="checkoption">
                                                        <input class="secinfo" id="fitness" type="checkbox" name="fitness" value="fitness" >
                                                        <label class="intoption" for="checkbox110">Fitness</label>
                                                    </div>

                                                    <div class="checkoption">
                                                        <input class="secinfo" id="wellness" type="checkbox" name="wellness" value="wellness" >
                                                        <label class="intoption" for="checkbox110">Wellness</label>
                                                    </div>

                                                    <div class="checkoption">
                                                        <input class="secinfo" id="beauty" type="checkbox" name="beauty" value="beauty" >
                                                        <label class="intoption" for="checkbox110">Beauty</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="formerror">
                                <p id="formerror"></p>
                                <p id="attaboy"></p>
                            </div>   

                              <div class="searchbtn">
                                <input  id="btnLogin" class="btn cool btn-primary btn-lg btn-block" value="Add Client" />
                            </div>


                </div>
            </form>
        </div>

    <!-- /.container -->


    <!-- jQuery -->
   

   
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

    .errormessages {

        font-size: 1.7em;
        color: red;
    }
        .drop {
        padding-bottom: 40px;
    }
    .btn {
        padding: 11px 52px;
    }
    .btn-primary {
        background-color: #343434;
        border-color:  #343434;
    }
    .btn-primary:hover{
         background-color: #474747;
    }
    .input-lg {
        font-size: 22px;
        font-weight: 360;
        color: #181818;
        text-align: center;
        background-color: #19191924;
    }   
    label  {
        text-align: center;
        font-size: 1.3em;
        font-weight: 440;
       
    }/*
    .row  {
        padding-top: 30px;
    }
    */
    #empty {
        
    }
    input:focus {
        background-color: #B8B8B8;
    }

    .tel .form-group {
        margin-bottom: 35px;
    }
    .alphaValidate, #email {
            text-transform: uppercase;
        }
    </style>


<script src="js2/main.js"></script>

</body>

</html>
