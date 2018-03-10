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

    <title>Search - REDUX</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="css2/bootstrap4.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">
    <link href="css2/textinput.css" rel="stylesheet">
    

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />

</head>

<style>
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
        background-color: #DCDCDC;
    }   
    label  {
        text-align: center;
        font-size: 1.3em;
        font-weight: 440;
        color: #337ab7;

    }
    .row  {
        padding-top: 30px;
    }
    #empty {
        
    }
    input:focus {
        background-color: #B8B8B8;
    }

    .tel .form-group {
        margin-bottom: 35px;
    }
    .space {
        height: 90px;
        padding-top: 20px;
    }
    .loading img{
        width: 20px;
        background-image: url("img/loading.gif");
    }
    .searchclient .loader {
          border: 6px solid #7abaff;
          border-radius: 50%;
          border-top: 6px solid #474747;
          width: 40px;
          height: 40px;
          margin: auto;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        #all{
            color: #7abaff;
            font-size: 1.2em;
        }
        .alphaValidate, #email {
            text-transform: uppercase;
        }



</style>

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

                    <li class="activex">
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

     <div>  <!-- *container -->

        <div >
            <div class="searchclient boxy">
                <div >
                  <a name="anchorTag"></a>
                    <hr>
                    <h2 class="intro-text text-center">SEARCH BY</h2>
                    <hr>
                </div>

                <form id="target" name="myForm" action="middle.php" method="POST">
                        

                        <div class="textinput"> 
                             <label>
                                 <input name="email" type="email" id="email" name="cardholder-name" class="field is-empty required" placeholder="janedoe@email.com" />
                                    
                                     <span>
                                          <p id="emailerror" class="inerror"></p>
                                        <span>Email</span>
                                    </span>
                            </label>
                        </div>



                        <div class="names row">
                            <div class="form-group">
                                
                                <div class="col-sm-6">
                                    <div class="textinput"> 
                                         <label>
                                             <input name="firstname" type="text" id="firstname" class="field is-empty required alphaValidate" placeholder="Jane" />
                                                
                                                 <span>
                                                      <p  class="inerror"></p>
                                                    <span>ID First name</span>
                                                </span>
                                        </label>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-6">
                                   <div class="textinput"> 
                                         <label>
                                             <input name="lastname" type="text" id="lastname"  class="field is-empty required alphaValidate" placeholder="Doe" />
                                                 <span>
                                                      <p class="inerror"></p>
                                                    <span>ID Last name</span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="preferred-names row">
                           <div class="form-group">
                                
                                <div class="col-sm-6">
                                    <div class="textinput"> 
                                         <label>
                                             <input name="pfirstname" type="text" id="preferredfirst" class="field is-empty required alphaValidate" placeholder="Jane" />
                                                
                                                 <span>
                                                      <p  class="inerror"></p>
                                                    <span>Preferred First name</span>
                                                </span>
                                        </label>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-6">
                                   <div class="textinput"> 
                                         <label>
                                             <input name="plastname" type="text" id="preferredlast" class="field is-empty required alphaValidate" placeholder="Doe" />
                                                 <span>
                                                      <p class="inerror"></p>
                                                    <span>Preferred Last name</span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="textinput">
                                <label>
                                     <input type="tel" name="phonenum"  id="phone" class="field is-empty required" placeholder="(123) 456-7890" onkeypress="formatPhone(this);"/>
                                        
                                         <span>
                                              <p id="phoneerror" class="inerror"></p>
                                            <span>Phone</span>
                                        </span>
                                </label>
                            </div>
                        </div>

                        <div class="aligncenter">
                             <div class="space">
                                 <div id="empty">
                                 </div>
                                  <div id="all"></div>
                            </div>
                        </div>

                        <div class="formerror">

                        </div>
                        
                         <div >
                            <input name="sub" id="search" class="btn cool btn-primary btn-lg btn-block" value="Search" />
                        </div>
                </form>


            
           
            </div>
     


    </div> 
    <!-- /.container -->


    <!-- jQuery -->
    <script src="js2/jquery.js"></script>
    <script src="js2/main.js"></script>
     <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>-->
      <script src="js2/searchcust.js"></script>
    <!-- Bootstrap Core JavaScript -->
      <script src="js2/bootstrap.min.js"></script> 
    <script>

        function formatPhone(obj) {
            var numbers = obj.value.replace(/\D/g, ''),
                char = {0:'(',3:') ',6:' - '};
            obj.value = '';
            for (var i = 0; i < numbers.length; i++) {
                obj.value += (char[i]||'') + numbers[i];
            }
        }

</script>



</body>

</html>
