$(document).ready(function() {

	    $('#phoneerror').hide();
        $('#emailerror').hide();
        $('#fnameerror').hide();
        $('#lnameerror').hide();

        var existMsge = "";
      
        $('.secinfo').focus(function() {
            console.log("HALL");
            checkEmptyFields();
            
        });

        function checkEmptyFields() {
            var ctr = 0;
            $('.required').each(function(){
               
                if ($(this).val() == '' ) {
                   
                    if($(this).attr('id') == 'email') {

                        $('#emailerror').text("required");
                        $('#emailerror').fadeIn();
                    }
                    else if ($(this).attr('id') == 'firstname'){
                        $('#fnameerror').text("required");
                        $('#fnameerror').fadeIn();
                    }
                    else {
                        $('#lnameerror').text("required");
                        $('#lnameerror').fadeIn();
                    }

                }
                ctr++;
            }); 
        }

        $('#email').blur(function(e){
            //checkExistingEmail();
        });

        $('#phone').blur(function(e){
             var x = $("#phone").val();
             console.log("xxxxxxxxxxyyyyyyyyyyyy: " + x.length);
            if (x.length != 16 && x.length !=0 ) {
                 $('#phoneerror').text('length error');
                 $('#phoneerror').fadeIn();
            }
            else
                $('#phoneerror').fadeOut();
        });

        $('#phone').keyup(function(e){
        	if  ( $('#phoneerror').text('length error') )
        		if ( $('#phone').val().length == 0 || $('#phone').val().length == 16 ) {
        			$('#phoneerror').fadeOut();
        		}
        });

        $('#phone').keypress(function(e){
                if ( $('#phone').val().length == 16 ) {
                    e.preventDefault();
                    console.log("limit reahed")
                }
                else
                    console.log($('#phone').val().length );
        });
        
        $('#email').keydown(function(e){
        	console.log("blurrring");
            checkemail3OnBlur();
        });
        
        $('#email').keydown(function(e){
        	console.log("fuck");
        	if ( $('#email').val() != '' ) {
        		console.log('!=');
	        	if ( $('#emailerror').text() == "required" ){
	        		console.log('===================');
        			$('#emailerror').fadeOut();
	        	}
	        }
        });

				
		
		$('#lastname').keydown(function(e){
			if ( $('#lastname').val() != '' ) {
        		console.log('!=');
	        	if ( $('#lnameerror').text() == "required" ){
	        		console.log('===================');
        			$('#lnameerror').fadeOut();
	        	}
	        }
		});
		
        $('#firstname').blur(function(e){
            checkFirstName();
        });
        $('#lastname').blur(function(e){
            var x = $('#lastname').val();
            if (x.length == 0) {
                $('#lnameerror').text('required');
                $('#lnameerror').fadeIn();
            }
            else
                $('#lnameerror').fadeOut();
        });

        function checkFirstName(){
            var x = $('#firstname').val();
            if (x.length == 0) {
                $('#fnameerror').text('required');
                $('#fnameerror').fadeIn();
            }
            else
                $('#fnameerror').fadeOut();

        }

        function checkemail2OnBlur() {
            var x = document.forms["myForm"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");

            if (x.length == 0)  {
                $('#emailerror').text("required");
                $('#emailerror').fadeIn();
                return;
            }
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                    $('#emailerror').text("Invalid Format");
                    $('#emailerror').fadeIn();
                    //return false;

            }
            else
                $('#emailerror').fadeOut();
               
            
        }
        function checkemail3OnBlur(mail)   {  
        	 var x = document.forms["myForm"]["email"].value;
        	 console.log('check3');
		 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(x))  {  
		 	 $('#emailerror').hide();
		    //return (true)  
		  } 
		  else{
		   	$('#emailerror').text("Invalid Format");
            $('#emailerror').fadeIn();  
          }
		}  

        function checkExistingEmail() { 
            var x = document.forms["myForm"]["email"].value;
           
            if (x != "") {
                var obj = { email: x };
                console.log("check4");
                $.ajax({
                  url : 'existsEmail.php',
                  type : 'GET',
                  dataType: "json",
                  data: obj,
                  success : function(data) {

                    var obj1 = data;
                    if (obj1.code == 1) {
                        var inter = "hello";
                        var message = obj1.msge;
                        $('#emailerror').text(message);
                        $('#emailerror').fadeIn();
                        
                        existMsge = message;
                       console.log("email exists");
                    }
                    else {
                        $('#emailerror').text("");
                        $('#emailerror').fadeOut();
                       
                        console.log("email does NOT exists");
                    }
                  },
                  error: function(data) {
                    console.log("data error:  " + data.errorThrown);
                }
              });
            }
           
          

        }
        $(".alphaValidate").keypress(function(event){
            var regex = /^[a-zA-Z\s]+$/;
            var x = event.keyCode || event.which;  
            var y = String.fromCharCode(x); // Convert the value into a character
            if (regex.test(y) )
            	console.log("^^^^");
            else
            	event.preventDefault();

        });

        /*
        function checkemail2() {
            var x = document.forms["myForm"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");

            if (countEmailTries > 0 ) {
                if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                    $('.emailerror').text("Invalid Format");
                    $('.emailerror').fadeIn();
            }
            else
                $('.emailerror').fadeOut();
            }
            
        }
    */
    $('input').keyup(function(e){
    	if ( ! $('.inerror').is(":visible")) {
    		$('#formerror').text('');
    	}
    });

    function goToIndex() {
        window.location.href= "index.php";
    }
	$('#btnLogin').click(function(e){
		checkEmptyFields();
		checkemail3OnBlur();
        //checkExistingEmail();
        var xy = $('#emailerror').val();
		
		if ( $('.inerror').is(":visible") ) {
			$('#formerror').text('please correct errors');

			console.log("preventDefaultxxxxx");
			setTimeout(function() {
                    $('html, body').animate({scrollTop:320}, 'slow');
                }, 600);
			return false;
		}
		else {
	
			$('#formerror').text('');
			console.log("success");
           

			var email = $('#email').val().trim();
            email = email.toUpperCase();
			
            var first = $('#firstname').val().trim();
            first = first.toUpperCase();

			var last = $('#lastname').val().trim();
            last = last.toUpperCase();

			var age = $('#age').val();
            if (age != null)
                age = age.trim();

			var gender = $('#gender').val();
			
            var phone = $('#phone').val();
            if (phone != null)
                phone = phone.trim();

			var ref = document.getElementById("referral");
			var referral = ref.options[ref.selectedIndex].value;
			if (document.getElementById('fitness').checked) { 
				var fitness = "FITNESS";
			}
			if (document.getElementById('beauty').checked) { 
				var beauty = "BEAUTY";
			}
			if (document.getElementById('wellness').checked) { 
				var wellness = "WELLNESS";
			}

			var pfirst = first;
			var plast = last;
			
			var obj = {email: email,
				first: first,
				last: last,
				age: age,
				gender: gender,
				phoneNumber: phone,
				beauty: beauty,
				fitness: fitness,
				wellness: wellness,
				referral: referral,
				preferredLast: plast,
				preferredFirst: pfirst

			};
			$.post('addcust.php', obj, function(data, response){  
                console.log("data.message " +  data.message + " code " + data.success );
                console.log(JSON.stringify("f: " + fitness + " b: " + beauty + " w: " + wellness));
                if (data.success == 0) {  
                    if (data.message == 'Existing email') {
                        $('#formerror').text('Please correct errors');
                        $('#emailerror').text(data.message);
                        $('#emailerror').fadeIn();
                        setTimeout(function() {
                            $('html, body').animate({scrollTop:320}, 'slow');
                        }, 600);
                    }
                    else { 
                        $('#formerror').text(data.message);

                    }
                }
                else { 
                        /*  
                            Check dangling Online Orders.  Scan the Online Orders table checking for past
                            orders submitted an email matching this same email of the newly created customer
                            so we can attach a customer to those dangling online orders. 

                        */
                            var noOrder = -1; // We don't have an order id. The backend will use this parameter
                                             // to  make the necessay updates but we are passing an order id that
                                            // we know for sure will not exist.    
                            var obj2 = {custID : data.cid, order : noOrder , email: email  };
                            $.post('updateOrder.php', obj2, function(res){ 
                                console.log("stringify: " + JSON.stringify(res));
                                if (res.success == 1) {
                                    console.log("INNER: " + res.message);
                                    console.log("INNER data.success: " + res.success);
                                    
                                }
                                else { 
                                    console.log("INNER ERROR: " + res.tran);
                                    console.log("INNER ERROR: " + res.message);
                                }
                            });

                           window.location.href= "profile.php?id="+data.cid;
                }
                
			 }, 'json');
		}
	});

	function isScrolledIntoView(e) {
	    var t = $(window).scrollTop(),
	        i = t + $(window).height(),
	        n = $(e).offset().top,
	        l = n + $(e).height();
	    return l >= t && n <= i && l <= i && n >= t
	}

	
});