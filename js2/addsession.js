$(document).ready(function() {
	$("#confirmsingle").hide();
    $("#cancelsingle").hide();
    $('#singleSession').hide();
    $("#chargeNsubmit").hide();
    $("#canceledit").hide();
    $("#editfirst").hide();
    $("#editlast").hide();
    $("#submitedit").hide();
    

        $("#confirmsinglex").click(function() { 
                    var id =  $('#idCustomerID').text();
        var packagetype =  $(this).data('packtype');
        var productid = $(this).data('prodid');
        var raiders = $('#raiders').val();
            
        var obj = {customerid: id,
                    packType: packagetype,
                    isRaiders: raiders,
                    productid: productid};
            $.post('addsinglesession.php', obj, function(data, response){  

                alert("data: " + data + " respnse: " +  response);
              
           });
        window.location.href= "profile.php?id=" + id; // the redirect goes here
        
    });

    $("#confirm-localx").click(function() { 
      
        var id =  $('#idCustomerID').text();
        var packagetype =  $(this).data('packtype');
        var productid = $(this).data('prodid');
        var raiders = $('#raiders').val();
  
            
        console.log("packagetype: " + packagetype);
        console.log("productid: " + productid);
        var obj = {customerid: id,
                    packType: packagetype,
                    isRaiders: raiders,
                    productid: productid};
        console.log(JSON.stringify(obj));
            $.post('addsinglesession.php', obj, function(data, response){  

                alert("data: " + data + " respnse: " +  response);
                console.log("DATA: " +  data);
              
           });
        window.location.href= "profile.php?id=" + id; // the redirect goes here
        
    });

});