<?php
require 'include/connect.php';
session_start();
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

    <title>Redux Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="css2/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
  
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />
     <link href="//fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    
</style>

<body>

    <div class="reduxBrand">
         <h1>R<span>EDU</span>X</h1>
    </div>
    <div class="address-bar">Customer Management</div>
   



    
    <!-- Navigation -->
    <nav id="homenav" class="navbar navbar-default" role="navigation">
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
                <a class="navbar-brand" href="index.html">Welp</a>
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

                    
                    
                    <?php
                        
                        if (isset($_SESSION["pwrd"]) == false )
                        {
                            print "<li class=\"dropdown pull-right\">";
								print "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Login/Signup <b class=\"caret\"></b></a>";
								print "<ul class=\"dropdown-menu\">";
                                                                print "<li id=\"tag\"><a href=\"login.php\">Login</a></li>";
								
								print "</ul>";
							print "</li>";
                            
                        }else if(isset($_SESSION["pwrd"]))
                            {
                                print "<li>";
                                    print "<a href=\"logout.php\">Logout</a>";
                                print "</li>";
                            }
                     
                    ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

   <div class="mainx">
        <div class="zz">
            <div class="full-circle">
              <h1>REDUX</h1>
            </div>
        </div>

    </div>
 
  

    <style>



    .yy {
        text-align: center;
    }
    .carousel-inner  h1 {
        font-size: 6.0em;
        text-align: center;
        height: 400px;
        font-family: "Roboto", Verdana, sans-serif;
        font-weight: 150;

    }
    .sitetitle {
    }
    #myCarousel {
        width: 100%;
        -webkit-font-smoothing: antialiased

    }
    circle {
      fill: white;
      stroke: black;
      stroke-width: 2;
      stroke-dasharray: 250;
      stroke-dashoffset: 1000;
      animation: rotate 5s linear infinite;
    }
    @keyframes rotate {
      to {
        stroke-dashoffset: 0;
      }
    }
    .grad {
       color: #f35626;
        background: -webkit-linear-gradient(92deg,#f35626,#feab3a, #c2228d, #6222c2, #16a54c);

        
       

        -webkit-animation: AnimationName 9s ease infinite;
    }
    @-webkit-keyframes AnimationName {
    0%{background-position:14% 0%}
    50%{background-position:87% 100%}
    100%{background-position:14% 0%}
}
@keyframes AnimationName { 
    0%{background-position:14% 0%}
    50%{background-position:87% 100%}
    100%{background-position:14% 0%}
}
    
    .full-circle {

            margin: auto;
            text-align: center;
         background: #DCDCDC;
         border: 3px solid #333;
         height: 550px;
         width: 550px;
         -moz-border-radius: 550px;
         -webkit-border-radius: 550px;
          

           font-size: 50px;
           font-family: "Circo","Helvetica Neue",Helvetica,Arial,sans-serif;
    }
    .full-circle h1 {

            margin: auto;
            text-align: center;
         line-height: 550px;
           font-size: 50px;
           font-family: "Circo","Helvetica Neue",Helvetica,Arial,sans-serif;
          
    }
    }
    .mainx {
      
        font-size: 3em;
    }
    .zz{
       
        padding-top: 35px;
    }
    #homenav {
        margin-bottom: 0px;
    }

    </style>

    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->

     <script>
    $("[data-toggle=popover1]").popover({
    html: true, 
    content: function() {
          return $('#popover-content1').html();
        }
    });
    </script>
     
    <script>
    $("[data-toggle=popover2]").popover({
    html: true, 
    content: function() {
          return $('#popover-content2').html();
        }
    });

    words = ["Revitilize", "Rejuvenate", "Revive"];
    </script>


</body>

</html>
