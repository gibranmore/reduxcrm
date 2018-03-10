$(document).ready(function() {
    $("#addPack").click(function() { 
    	console.log("DFKDJFKJFKLJSLKJDLFJ");
    	$("#addpack").hide();

		var e = document.getElementById("type");
		var strUser = e.options[e.selectedIndex].value;

		if (!document.getElementById("manualNumber"))
			console.log("1111");

		if (!document.getElementById("packname"));
			console.log("2222");


		var manualName = $('#packname').val();
		var manualNumberType = $('#manualNumber').val();
		console.log("manualName: " + manualName.length + " manualNumberType: " + manualNumberType.length);
		var manualFlag = false;

		if ( manualName != "" || manualNumberType != "" )
			manualFlag = true;

		if (strUser != 0 && manualFlag == true) { 
			console.log("strUser: " + strUser + " manualFlag: " + manualFlag);
			alert("Choose from the drop down menu OR create a manual package"); /* input in both */
			return;
		}

		if (strUser == 0 && !manualFlag) { 
			alert("Select a package from the drop down menu or enter one manually"); /* No input anywhere */
			return;
		}
		/*

		if (strUser == 0 && (manualName != "" || manualName != null) && (manualNumberType == "0" || manualNumberType == null) ) { 
			//strUser = manualNumberType;
			
			alert("A manual package needs a 'Package Name' AND number of sessions");
			return;
		}
		if (strUser == 0 && (manualName == "" || manualName == null) && (manualNumberType != "0" || manualNumberType != null) ) { 
			//strUser = manualNumberType;
			
			alert("A manual package needs a 'Package Name' AND number of sessions");
			return;
		}
		*/
		
		var last = $('#lname').val();
		var first = $('#fname').val();
		var id = $('#custidnum').val();

		
		/*
		if ( (manualName == null || manualName == "") && (manualNumberType != null || manualNumberType != "") ) {

			alert("A manual package requires a 'Package Name' AND  'Number of Sessions'!");
			return;

		}
		*/
		var obj = {cid: id,
				ptype: strUser,
				lastname: last,
				firstname: first,
				packname: manualName

		};
		

		$.post('package.php', obj, function(data){  

			var report = data;

			if (report == "Successfully added new package!")
				$('#reportsuccess').text(report);
			else 
				$('#reporterror').text(report);
			$('#redirect').text("redirecting to profile in 7 seconds...");
			setTimeout(function () {
   				window.location.href= "profile.php?id=" + id; // the redirect goes here

			},7000); // 7 seconds
				
           });

	});

});