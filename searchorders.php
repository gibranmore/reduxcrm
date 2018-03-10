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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="css2/business-casual.css" rel="stylesheet">

    <link href="css2/textinput.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carme" />

</head>

<body>
    <style>
    .space {
        height: 70px;
    }
    /*
    input {
        text-align: center;
    }
    */
    #empty {
        
    }
    .loading img{
        width: 20px;
        background-image: url("img/loading.gif");
    }
    .loader {
          border: 6px solid #7abaff;
          border-radius: 50%;
          border-top: 6px solid transparent;
          width: 40px;
          height: 40px;
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
        .box #myForm .form-group{
            margin-bottom: 35px;
        }
        #casewarning {
             color: #f9f9f9;
             font-size: 0.8em;
             font-weight: 300;
             padding-top: 
        }
        /****************************/
        /*
        .navbar.navbar-default{
          margin-bottom: 90px;
        }
        .testx{
          background-color: #5f5f5fe3;
        }
        .bordertop{
          width: 100%;
          height: 24px;
          background-color: #5f5f5fe3;
        }
        */
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

                    <li class="activex">
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

    <center> 

        <div ></div>
          <div class="srchorders container">

            <div >
              <div class="boxy">
                  <div >
                    <a name="anchorTag"></a>
                      <hr>
                      <h2 class="intro-text text-center">SEARCH Online Orders
                          <strong>BY</strong>
                      </h2>
                      <hr>
                  </div>
                  
                      <form id="myForm" >

                            <div class="textinput"> 
                                 <label>
                                    <input name="packname" type="text" id="email"  class="field is-empty"  />
                                       <span>               
                                          <span>Email</span>
                                       </span>
                                 </label>
                            </div>

                            <div class="textinput"> 
                                 <label>
                                    <input type="text" id="orderconfirm" class="field is-empty"  />
                                       <span> 
                                          <p id="casewarning" class="inerror">Code is Case Sensative<p>              
                                          <span>Confirmation Code</span>
                                       </span>
                                 </label>
                            </div>

                            <div class="textinput"> 
                                 <label>
                                    <input type="number" id="zipcode"  class="field is-empty" min="0"  />
                                       <span>               
                                          <span>Zipcode</span>
                                       </span>
                                 </label>
                            </div>


                            <!-- <div class="form-group">
                               <label for="email" class="col-form-label">Email:</label>
                               <input type="text" class="form-control input-lg" id="email" />
                             </div> 
                           <div class="form-group">
                             <label for="orderconfirm" class="col-form-label">Confirmation Code:</label>
                             <input type="text" class="form-control input-lg" id="orderconfirm"  />
                             <p id="casewarning">Code is case sensitive!<p>
                           </div> 
                            <div class="form-group">
                             <label for="last-name" class="col-form-label">Zipcode</label>
                             <input type="number" class="form-control input-lg" id="zipcode"  min="0"/>
                           </div> -->
                           <div class="space">
                               <div id="empty">
                               </div>
                                <div id="all"></div>
                          </div>
                          
                           <div class="searchbtn">
                              <input id="submit" class="btn cool btn-primary btn-lg btn-block" value="Search" />
                          </div>
                      </form>

              </div>
            </div>
    </div> <center/>
    <!-- /.container -->


    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <script src="js2/main.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>
    <script>

     $(document).ready(function() {
        $('#orderconfirm').focus(function(){
            $('#casewarning').fadeIn(500);
        });
        $('#orderconfirm').blur(function(){
            $('#casewarning').hide();
        });
    });

        function formatPhone(obj) {
            var numbers = obj.value.replace(/\D/g, ''),
                char = {0:'(',3:') ',6:' - '};
            obj.value = '';
            for (var i = 0; i < numbers.length; i++) {
                obj.value += (char[i]||'') + numbers[i];
            }
        }
        function goToResultsEmpty() {
            window.location.href= "listorders.php";
        }
        function isEmpty(str) {
                    return (!str || 0 === str.length);
        }

        $(document).keypress(function(e) {
            if(e.which == 13) {
                $('#submit').click();
            }
        });
           

        $(document).ready(function() {
            var url = "listorders.php";
            $("#casewarning").hide();
            //var 
           $("#submit").click(function(){
               var email = $('#email').val().trim();
               var code = $('#orderconfirm').val().trim();
               var zipcode = $('#zipcode').val().trim();
               
                
               if (isEmpty(code) && isEmpty(email) && isEmpty(zipcode)) {
                    $("#all").html("Retrieving all orders!")
                    $('#empty').addClass('loader');
                    setTimeout(function(){ goToResultsEmpty() }, 2000);
               }
               else {
                //console.log("code: " + code, " email: " + email + " zipcoe: " + zipcode));
                console.log("emai: " + email + "fuck");
                console.log("code: " + code + "fuck");
                var oneFlag = false;
                    if (!isEmpty(email)) {
                        url += "?email="+email;
                        oneFlag = true;
                    }
                    if (!isEmpty(code)) {
                        if (oneFlag )
                            url += "&orderconfirm="+code;
                        else
                            url += "?orderconfirm="+code;
                        oneFlag = true;
                    }
                    if (!isEmpty(zipcode)) {
                        zipcode = Number(zipcode);
                        if (oneFlag)
                            url+= "&zipcode="+zipcode;
                        else
                            url+="?zipcode="+zipcode;
                    }
                     window.location.href= url;

               }
            

                
            });
    
        });
        
</script>



</body>

</html>
