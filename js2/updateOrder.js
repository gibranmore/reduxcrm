$(document).ready(function() {

	 $('#phone').keypress(function(e){
               if ( $('#phone').val().length == 16 ) {
                    e.preventDefault();
                    console.log("limit reahed")
                }
                else
                    console.log($('#phone').val().length );
    });

    $("#btnLogin").click(function() { 

    	var email =  $('#email').val().trim();
		var first = $('#username').val().trim();
		var last = $('#password').val().trim();
		var phone = $('#phone').val().trim(); 

		var orderid = $('#order').val();

		if (email == null || email == "") { 
			alert("EMAIL field cannot be empty");
			return;
		}
		if (first == null || first == "") { 
			alert("First Name field cannot be empty");
			return;
		}
		if (last == null || last == "") { 
			alert("Last Name field cannot be empty");
			return;
		}

		if (phone.length > 0 && phone.length < 16 ) { 
			alert("Phone number format error");
			return;
		}
    	
    	
    	var age =  $('#age').val();
    	var e = document.getElementById("gender");
		var gender = e.options[e.selectedIndex].value;
    

    	console.log("AGE: " + age);
    	console.log("GENDEr: " + gender);
    	console.log("PHONE: " + phone);

    	if (document.getElementById('fitness').checked) { 
			var fitness = $('#fitness').val();

		}
		if (document.getElementById('beauty').checked) { 
			var beauty = $('#beauty').val();

		}
		if (document.getElementById('wellness').checked) { 
			var wellness = $('#wellness').val();
		}

		var pfirst = $('#preferredFirst').val();
		var plast = $('#preferredLast').val();

		if (pfirst == null || pfirst == "") { 
			pfirst = first;
		}

		if (plast == null || plast == "") { 
			plast = last;
		}

		var ref = document.getElementById("referral");
		var referral = ref.options[ref.selectedIndex].value;

		console.log("wellness: " + wellness);
		console.log("REFERRALLL>: " + referral);
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

			$.post('addcust.php', obj, function(data){  
				console.log("data.cid: " + data.cid + " data.success: " + data.success);

				if (data.success == 1) {
					console.log("HREEREERE#$#43");
					var obj2 = {custID : data.cid, order : orderid, email: email  };
					console.log(JSON.stringify(obj2));
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
					console.log("sssss");
					window.location = "profile.php?id=" + data.cid;
				
				}
				else {
					console.log("&ERROR: " + data.message);
					
				}
							
			 });
	});
	
});