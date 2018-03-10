$(document).ready(function() {
    $("#addPackx").click(function() { 
    	
    	$("#addpack").hide();

		var e = document.getElementById("type");
		var strUser = e.options[e.selectedIndex].value;

		var productid;
	

		var manualName = $('#packname').val();
		var manualNumberType = $('#manualNumber').val();
		console.log("manualName: " + manualName.length + " manualNumberType: " + manualNumberType.length);
		var manualFlag = false;
		//var productid;
		if ( manualName != "" || manualNumberType != "" )  { 
			manualFlag = true;
			productid = 11; /* Made up Packages with Any number of Sessions belongs is a Product with id of '11' */
		}
		else
			productid = strUser;

		console.log("PRODUCT ID: " + productid);
		
		if (strUser != 0 && manualFlag == true) { 
			console.log("strUser: " + strUser + " manualFlag: " + manualFlag);
			alert("Choose from the drop down menu OR create a manual package"); /* input in both */
			return;
		}

		if (strUser == 0 && !manualFlag) { 
			alert("Select a package from the drop down menu or enter one manually"); /* No input anywhere */
			return;
		}

		console.log("strUser: " + strUser);
		console.log("manual number type: " + manualNumberType);
		
		if (manualNumberType <= 0 && strUser == 0) { 
			alert("Number of sesssions must be greater than 0");
			return;
		}

		if (manualName != "" && manualNumberType == null ) { 
			alert("Fill in both fields for a manual package entry");
			return;

		}
		if (manualName == "" && manualNumberType != null && strUser == 0) { 
			alert("Fill in both fields for a manual package entry");
			return;

		}
		console.log("before");
		if (strUser == 0 || strUser == null) { 
			strUser = manualNumberType;
			console.log("hereee");
		}

		console.log("*strUser: " + strUser);

		
		var last = $('#lname').val();
		var first = $('#fname').val();
		var id = $('#custidnum').val();

		
		var isManualPackage = $('#manualNumber').val();
		console.log("manualNumber.val(): " + isManualPackage);
		

		console.log("productid&&&: " + productid);

		var obj = {cid: id,
				ptype: strUser,
				lastname: last,
				firstname: first,
				packname: manualName,
				prodid: productid

		};
		

		$.post('package.php', obj, function(data){  

			var report = data;

			if (report == "Successfully added new package!")
				$('#reportsuccess').text(report);
			else 
				$('#reporterror').text(report);
			$('#redirect').text("redirecting to profile...");
			setTimeout(function () {
   				window.location.href= "profile.php?id=" + id; // the redirect goes here

			},3000); // 3 seconds
				
           });

	});

});