$(document).ready(function() {
    $("#addPackx").click(function() { 
    	
    	var dropdownSelection = $('#type option:selected').val();

    	var packName = $('#packname').val();
    	var manualNumber = $("#manualNumber").val();

    	var last = $('#lname').val();
		var first = $('#fname').val();
		var id = $('#custidnum').val();
        var amt = $('.charge').text();
        amt = amt.replace("$", "");
        var miscamt = $('#miscamt').val();
        miscamt = miscamt.replace("$", "");
		var packageType;

		var validInputFlag = true;

        console.log("********CHaRGE>>>> " + amt );

    	console.log('packname: ' + packName + " manualNumber: " + manualNumber + " dropdownSelection: " + dropdownSelection);
    	if (dropdownSelection == 11 )  {  /* Manual (arbitrary )number of WBC sessions*/

    		if (manualNumber == "") {
    			console.log(" num == empty"); 
    			$('#error').show();
    			$('#error').text('*Error: Please enter number of sessions');
    			validInputFlag = false;
    		}
    		if (manualNumber <= 0) {
    			$('#error').show();
    			$('#error').text('*Error: Enter a positive number of sessions');
    			validInputFlag = false;
    		}
    		
    		if (packName == "") {
    			console.log(" packname == empty"); 
    			$('#error').show();
    			$('#error').text('*Error: Please label the package with a short description ');
    			validInputFlag = false;
    		}

            if ( miscamt == "")  {
                console.log(" miscamt == empty"); 
                $('#error').show();
                $('#error').text('*Error: Please enter amount that will be charged ');
                validInputFlag = false;
            }

    	}
    	else if (dropdownSelection == 15)  { /*Facials selected */
    		if (manualNumber == ""){ /*check if number of sessions field is empty */
    			$('#error').show();
    			$('#error').text('*Error: Please enter number of sessions');
    			validInputFlag = false;
    		}
    		if (manualNumber <= 0) {
    			$('#error').show();
    			$('#error').text('*Error: Enter a positive number of sessions');
    			validInputFlag = false;
    		}
    	}

    	/* 'packageType' field in Packages table conditioning for the 2 'tricky' products */
    	if (dropdownSelection  == 11 || dropdownSelection == 15) { 
    		packageType = manualNumber;

    	}
    	else {
    		packageType = dropdownSelection;
    		packName = null;
    	}

        if (dropdownSelection == 11) { 
            amt = miscamt;
        }

    	var obj = {cid: id,
				ptype: packageType,
				lastname: last,
				firstname: first,
				packname: packName,
				prodid: dropdownSelection,
                amt: amt

		};

		console.log("DP: " + dropdownSelection + " patype: " + packageType);
		
		if (validInputFlag)  { 
			$.post('package.php', obj, function(json){  

			
				console.log("json: " +  json);
                //console.log( jQuery.parseJSON(json) );
				if (json.success == "1") {  
                    
                    $('.td').hide();
                    $('.ch').hide();
                    $('.enteramt').hide();
                    $('.addpackerror').hide();

                    $('#repsuc').text(json.msge);
                   
                }
				else { 
                    $('.td').hide();
                    $('.ch').hide();
                    $('.enteramt').hide();
                    $('.addpackerror').hide();

                   
					$('#reperror').text(json.msge);

                }
				
                $('#redirect').text("redirecting to profile...");
				setTimeout(function () {
	   				window.location.href= "profile.php?id=" + id; // the redirect goes here

				},4000); // 3 seconds
				
	         }, 'json');

		}
        else
            console.log("invalid input");
	});	

});