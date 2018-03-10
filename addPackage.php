<?php
require 'include/connect.php';
session_start();
ob_start();
date_default_timezone_set('America/Los_Angeles');

$cusID = $_GET["id"];
$firstname = $_GET["name"];
$lastname =  $_GET["lastname"];

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

     <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">

       <link href="css2/textinput.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <style >

    .charge {
        font-size: 1.7em;
        margin: auto;
       
    }

    .chargeSubmit {
        font-size: 1.1em;
        color: #337ab7;
        padding-bottom: 10px;
    }
   
    .reportresp {
        position: absolute;
        top: 720px;
        left: 440px;
        width: 390px;
        height: 90px;
        border: purple;

        font-size: 17px;
        color: #60DE71;
    }
    .reportresp h1 {
        font-size: 17px;
    }

    #reperror{
        color: #dc2828;
    }
    #redirect {
       
        color: white;
    }

    .totaldue{
        /*
        display: inline-block;
        */
        font-size: 19px;
        font-weight: 700;

      
    }  
    
    .td {
        position: absolute;
        top: 720px;
        left: 540px;
        width: 190px;
        height: 50px;
        color: #7abaff;
        /*
        border: 1px solid red;
        */
    }
    .ch {
        position: absolute;
        top: 775px;
        left: 540px;
        width: 190px;
        height: 50px;
        /*
        border: 1px solid yellow;
        */
    }
    .miscamt {
     
    }
    .enteramt  {
        width: 165px;
        height: 75px;

        /*
        border: 1px solid green;
        */
        position: absolute;
        top: 845px;
        left: 554px;
        margin: auto
    }   
    .textinput .addpack label {
        margin-bottom: 30px;
    }

    .sp {
       background-color: transparent;
       border-color: #7abaff;
        padding: 10px;
        font-weight: 200;
        font-size: 1.4em;
       width: 100%;
       border-radius: 4px;
       font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
       -webkit-transition-duration:0.4s;

    }
    .sp:hover{
        background-color: #474747;
       
        cursor: pointer;
    }
    .addpackerror {
        position: absolute;
        top: 932px;
        width: 695px;
        left: 300px;
        height: 35px;
        /*
        border: 1px solid orange;
        */
        color: #efb183;
        font-size: 1.2em;
    }
    .addpackerror p {
        font-size: 1.1em;
        padding: 6px;
    }
    #redirect {

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

                    <li >
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

    <div class="addpack aligncenter"> <div class="container">

        <div class="row">
            <div class="boxy">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center ad">Add Package For
                        <span> <? print $firstname. " ".$lastname ?></span>
                    </h2>
                    <hr>
                </div>


                <!--<form  name="myForm" action= "package.php" method="POST"> -->
                        <div class="row">
                            <div class="col-md-12">


                                    <h2>Choose Product:</h2>
                    
                                         
                                       <select name="type" id="type" required> 
                                            <option id="noneselect" value="" data-price="0">products</option>
                                            <option id="pr3" value="3" data-price="">Trinity Pack (3)</option>
                                            <option id="pr5" value="5"  data-price="">Penta Pack (5)</option>
                                            <option id="pr10" value="10"  data-price="">Penta Pack (10)</option>
                                            <option id="pr1000" value="1000"  data-price="">REDUX Membersip</option>
                                            <option id="pr11" value="11"  data-price="">Manual (arbitrary no. of WBC sessions)</option>
                                            <option id="pr15" value="15"  data-price="">Localized Cryo Session</option>
                                        </select>
                              
                            </div>
                       </div>

                                 
                                         <!-- <div class="manualPackName">
                                            <label>Package Name (Descriptive Label): &nbsp; &nbsp;
                                                <input id="packname" type="text" name="packname" class="input-small" size="50" placeholder="Joe's Gym"/>
                                            </label>
                                        </div> -->

                                        

                                        <div class="manualPackName">
                                             <div class="textinput"> 
                                                 <label>
                                                     <input name="packname" type="text" id="packname" name="cardholder-name" class="field is-empty required"  />
                                                         <span>
                                                            
                                                            <span>Name (Descriptive Label)</span>
                                                        </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="numberSessions">
                                            <div class="textinput"> 
                                                <label>
                                                    <input type="number" id="manualNumber" name="manualNumber" type="num" class="field is-empty required" min="2" max="100"/>
                                                    <span>
                                                        <span>Number of Sessions</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                       
                                        <!-- <div class="numberSessions">
                                            <label>Number of Sessions: &nbsp; &nbsp;
                                                <input id="manualNumber" type="number" name="manualNumber" min="2" class="input-small"/>
                                            </label>
                                        </div> -->
                                        <? print " <input id=\"custidnum\" type=\"hidden\" name=\"cid\" value=\"$cusID\"  />"   ?>
                                        <? print " <input id=\"fname\" type=\"hidden\" name=\"firstname\" value=\"$firstname\" />"  ?>
                                        <? print " <input id=\"lname\"  type=\"hidden\" name=\"lastname\" value=\"$lastname\" />"  ?>
                                   

                                 <input id="pr1" type="hidden" data-price="" />
                                  <input id="pr2" type="hidden" data-price="" />


                                    <div class="td">
                                        <h3 class="totaldue"></h3>
                                    </div>

                                    <div class="ch">    
                                        <h2 class="charge"></h2>
                                    </div>
                                    <div class="enteramt">
                                        <!-- <input id="miscamt" type="number" class="input-small miscamt" placeholder="enter amount" /> -->
                                        <div class="miscamt"> 
                                            <div class="textinput">
                                                <label>
                                                    <input type="text" id="miscamt" name="manualNumber" type="num" class="field is-empty required" min="2" max="100"/>
                                                    <span>
                                                        <span>Enter a total:</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                       <!-- <h2 class="chargeSubmit">Charge Customer and Submit</h2> -->
                                <div class="addpackerror">
                                    <p id="error"></p> 
                                </div>
                                <div >   <!-- row -->
                                    <div >    <!-- colmd12 -->
                                        <div class="submitPack">
                                            <!-- <input  type="submit" name="sub" id="addPackx"  value= "Submit"> -->
                                             <input  type="submit" name="sub" id="addPackx" class="sp" value="Charge Customer and Submit">
                                          
                                        </div>
                                    </div>
                                </div>
                           <!--  </div> --> 

                            <div class="reportresp">
                                <h1 id="repsuc"></h1>
                                <h1 id="reperror"></h1>
                                <h1 id="redirect"></h1>
                            </div>
                        

                          
           <!-- </form>-->
            </div>
        </div>        
     
    </div> </div>
    <!-- /.container -->


    <!-- jQuery -->
    <script src="js2/jquery.js"></script>
     <script src="js2/main.js"></script>
   
    <script src="js2/addpackSub.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){

             function isNumberKey(evt){
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                    console.log("false");
                 return false;
             }
              console.log("true");
              return true;
            }
            
            $('#miscamt').keypress(function (e) {
               if (!isNumberKey(e)) {
                    e.preventDefault();
                    console.log('after');
                }
            });
            
            $('#miscamt').val('$' + $('#miscamt').val() );

            $('.manualPackName').hide();
            $('.numberSessions').hide();
            $('.chargeSubmit').hide();
            $('#error').hide();
            $("#addPackx").prop('disabled', true);
            $('.miscamt').hide();

            $('#type').on('change', function() {
                var selection = $('#type option:selected').val();
                var prodPrice = $('#type option:selected').data('price');
                console.log(">> " + selection + " -- " + prodPrice) ;
                

                if (selection == 11 ) {
                    $('.miscamt').hide();
                    $('.chargeSubmit').hide();
                    $('.totaldue').hide();
                     $('#error').hide();
                    $('.charge').hide();
                    $('#manualNumber').val('');
                    $('.manualPackName').show();
                    $('.numberSessions').show();
                     $("#addPackx").prop('disabled', false);
                    $('#manualNumber').on('keyup', function(){
                         $('#error').hide();
                         $('.totaldue').text("");
                          $('.totaldue').text("Total Due:");
                        $('.totaldue').show();
                        //$('.charge').show();
                        //$('.charge').text("");
                        $('.miscamt').show();
                        $('.charge').hide();
                        $('.chargeSubmit').show();
                    });
                    $('#packname').on('keyup', function(){
                         $('#error').hide();
                    });
                }
                else if (selection == 15) {
                    $('.miscamt').hide();
                    $('.totaldue').hide();
                    $('.charge').hide();
                     $('.chargeSubmit').hide();
                    $('#error').hide();
                    $('#manualNumber').val('');
                    $('.manualPackName').hide();

                    $('.numberSessions').show();
                      $("#addPackx").prop('disabled', false);
                    $('#manualNumber').on('keyup', function(){
                        console.log('keyup detected');
                         $('.miscamt').hide();
                        $('#error').hide();
                        var qty = $('#manualNumber').val();
                        
                        var mult = prodPrice * qty;
                        $('.totaldue').text("Total Duex:");

                        $('.totaldue').show();
                        $('.charge').text("$"+mult);
                        $('.charge').show();
                        $('.chargeSubmit').show();
                    });
                }
                else if (selection == 0) {
                    $('.miscamt').hide();
                    $('.totaldue').hide();
                    $('.chargeSubmit').hide();
                     $('.manualPackName').hide();
                        $('.numberSessions').hide();
                         $('.charge').text("Total Due: " + prodPrice);
                    $("#addPackx").prop('disabled', true);
                }
                else {
                    $('.miscamt').hide();
                    $('.totaldue').hide();
                    $('.manualPackName').hide();
                    $('#error').hide();
                    $('.numberSessions').hide();
                    console.log("hello");
                    $('.totaldue').text("Total Due:");
                    $('.totaldue').show();
                    $('.charge').text("$" + prodPrice);
                    $('.charge').show();
                    $('.chargeSubmit').show();
                    $("#addPackx").prop('disabled', false);


                }
            });
            
        });

        $(document).ready(function(){
            $.ajax({
              url : 'getprices.php',
              type : 'GET',
              dataType: "json",
              success : function(data) {
                //console.log(">> *" + jQuery.parseJSON(data));
                console.log("FUCK: " + data.length);
                
                  var obj1 = data[0];
                    console.log('? ' + obj1.p1);
                    console.log("data: " + data);
                
                $.each(data, function(key, value){
                    $.each(value, function(key, value){
                        console.log(key, value);
                        
                        console.log("key: " + key);
                         var prod = $('#'+key);
                         
                        prod.attr("data-price", value);
                        if (key == "pr11")
                            prod.append(" - N/A");
                        else
                            prod.append(" - $" +  value);
                        

                    });
                });
              },
              error: function(data) {
                console.log("data error:  " + data.errorThrown);
            }
          });
        });


    </script>



</body>

</html>
