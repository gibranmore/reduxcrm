$(document).ready(function() {
	$('#emailerror').hide();

	function checkPhoneLength() {
		var x = $("#phone").val();
        console.log("xy: " + x.length);
        if (x.length != 16 && x.length !=0 ) {
            $('#phoneerror').text('format error cPL');
            $('#phoneerror').fadeIn();
            console.log(">>>: " + x.length);
        }
        else
          $('#phoneerror').fadeOut();
	}
    
  
    $('#phone').keydown(function(e){

    	var x = $("#phone").val();
        if (x.length == 16 && e.keyCode !=8) {  //Limit typing to 16 characters. 
        	// 8 = backspace					//howerver, when deleting down to 16 chars, keypress is allowed
        	e.preventDefault();        	
        }
        //console.log("x.length: " + x.length)	
     });

	function foo() {
		return $('#phone').val().length;
	}

    
	 $('#phone').blur(function(e){
	 	formatPhone2();
	 	foo();
        console.log("**: " + foo());
        if (foo() != 16 && foo() != 0) {
	            $('#phoneerror').text('format error2');
	            $('#phoneerror').fadeIn();
	           //foo();   
	     }
	     else {
	     	$('#phoneerror').text('');
	     	 $('#phoneerror').fadeOut();
	     }


	 });

     function checkEmail() {
     	var x = $('#email').val();
        console.log('check3email():  ' + x);
        if (x == '') {
        	console.log("empty OK");
        	return;
        }
		 else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(x))  {  
		 	 $('#emailerror').hide();
		 	 console.log("email OK")
		    //return (true)  
		  } 
		  else{
		  	console.log("email BAD")
		   	$('#emailerror').text("Invalid Format");
            $('#emailerror').fadeIn();  
          }
     }
     $('#email').blur(function() {
    	if ($('#email').val() == '' ) {
    		console.log('blurring out email empty');
    		$('#emailerror').hide();
    	}
    		
    });

    $('#email').keyup(function(){
    	checkEmail();
    	if ($('#email').val() == '') {
    		$('#emailerror').text("");
            $('#emailerror').fadeOut();  
    	}
    });
    $(".alphaValidate").keypress(function(event){
            var regex = /^[a-zA-Z\s]+$/;
            var x = event.keyCode || event.which;  
            var y = String.fromCharCode(x); // Convert the value into a character
            if (regex.test(y) )
            	console.log("^^^^");
            else
            	event.preventDefault();

     });

	function isEmpty(str) {
      return (!str || 0 === str.length);
    }
    function goToResultsEmpty() {
        window.location.href= "list.php";
    }
    function formatPhone(obj) {
            var numbers = obj.value.replace(/\D/g, ''),
                char = {0:'(',3:') ',6:' - '};
            obj.value = '';
            for (var i = 0; i < numbers.length; i++) {
                obj.value += (char[i]||'') + numbers[i];
            }
    }

    function formatPhone2() {
    	phone = $('#phone').val();
          if (phone != '') {
            	    phone = phone.replace(/[^0-9]/g,'');
            		console.log("formatting phone2 (on blur)");
                    area = phone.substring(0,3);
                    prefix = phone.substring(3,6);
                    line = phone.substring(6);
                    $('#phone').val('(' + area + ') ' + prefix + ' - ' + line);
            
           }
    }
   
	$("#search").click(function (e) {
		console.log('clicked');
			var phone = $('#phone').val();
			var email = $('#email').val();
			var pfirst = $('#preferredfirst').val();
			var plast = $('#preferredlast').val();
			var idfirst = $('#firstname').val();
			var idlast = $('#lastname').val();

		if (isEmpty(phone + email + pfirst + plast + idfirst + idlast)) {
			$("#all").text("Retrieving all clients!")
            $('#empty').addClass('loader');
            console.log("click search > all empty");
            $('.formerror').text('');
            setTimeout(function() {
                   goToResultsEmpty();
                }, 1100);
		}
		else {
			console.log("else");
		      $('form input[type="text"]').each(function() {
                    if ($(this).val() != null) {
                        var xx = $(this).val();
                        $(this).val(xx.trim());
                        console.log("<>:<>:<>:<>:<>:<>:<>:<>:" + xx.trim() ) ;
                    }
                });
                submitForm();
			//submitForm();
		}
	});

	$(document).keypress(function(e){
		
		var keycode = e.keyCode;
		if (keycode ==  '13') {
			
		
			var phone = $('#phone').val();
			var email = $('#email').val();
			var pfirst = $('#preferredfirst').val();
			var plast = $('#preferredlast').val();
			var idfirst = $('#firstname').val();
			var idlast = $('#lastname').val();
			if (isEmpty(phone + email + pfirst + plast + idfirst + idlast)) {

				$("#all").html("Retrieving all customers!")
	            $('#empty').addClass('loader');
	            $('.formerror').text('');
                goToResultsEmpty();
			}
			else {
				console.log(" submitting not not empty > " + phone + email + pfirst + plast + idfirst + idlast);
                $("input:text").each(function() {
                    if ($(this).val() != null) {
                        var xx = $(this).val();
                        //$(this).val() = xx.trim();
                        console.log("<>:<>:<>:<>:<>:<>:<>:<>:" + xx.trim() ) ;
                    }
                });
                submitForm();
			}
		}
		
	});


	function submitForm(){

		checkPhoneLength();
		checkEmail();

        

		if ( !$('.inerror').is(":visible") ) {
			$('.formerror').text('');
			$('form').submit();
		}
		else {
			console.log('correct errors pls');
			$('.formerror').text('Please correct errors');
		}
	}
	
	
});