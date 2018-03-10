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

            $(".usesession").click(function() { 

        
                    var id =  $('#idCustomerID').text();
                    var packid = $(this).data('packid');
                    var packtype = $(this).data('packtype');
                    var prodid = $(this).data('prodid');

                    console.log('packtype: ' + packtype);
                    console.log('pid: ' + packid);
                    if (confirm ('Are you sure you want to use a session of this package?')) { 
                        
                        var obj = {customerid: id,
                        packType: packtype,
                        productid: prodid
                        };
                        var obj2 = {customerid: id,
                        packageid: packid
                        };

                        console.log("id: " + id);
                        console.log("packid: " + packid);
                        console.log("packtype: " + packtype);
                        console.log("prod_id: " + prodid);


                        console.log("about to exe addsinglesession.php");
                        $.post('addsinglesession.php', obj, function(data, response){  

                            alert("data: " + data + " response: " + response);
                         });

                        
                        $.post('useSession.php', obj2, function(data, response){  

                            

                            window.location.href= "profile.php?id=" + id; // the redirect goes here
                            
                       });
                        console.log("<><><>");
                        
                    }
                    else { 
                    }



                });

                $('#editname').submit(function(e){
                    e.preventDefault();
                    var fname = $('#firstname').val();
                    var lname = $('#lastname').val();
                    var customerid = $('#idCustomerID').text();
                    var data = { customerid: customerid,
                                preferredFirst: fname,
                                preferredLast: lname
                    };
                    var url = "updatename.php";

                    $.ajax({
                          type: "POST",
                          url: url,
                          data: data,
                          dataType: 'JSON',
                          success: function(data) {
                                if (data.success == "success") {
                                    $('.successname').text(data.msge);
                                    $('.successname').fadeIn();
                                    setTimeout(function() {
                                        $('#nameModal').modal("toggle");
                                         window.location.href= "profile.php?id=" + customerid; 
                                    }, 2500);
                                }
                                else {
                                    $('.failname').text(data.msge);
                                    $('#formbtn').hide();
                                    $('.failname').fadeIn();
                                    setTimeout(function() {
                                        $('#nameModal').modal("toggle");
                                        $('.failname').hide();
                                        $('#formbtn').show();
                                    }, 4500);
                                }

                        },
                        error: function(data) { /* This function callback is invoked on http errors; anything other than a 200 http response*/
                                    $('.successname').fadeIn();
                                    $('.successname').text('*Network error has occurred');
                                    setTimeout(function() {
                                        $('#nameModal').modal("toggle");
                                        $('.successname').hide();
                                    }, 4500);
                        }
                        });

                });
    $('.successname').hide();
    $('.failname').hide();

    if ($('div').hasClass('outerTableContainer')) {
    
    }
    else {
        $('#divContainer').hide();
    }
    if ( $('[data-target="#modalWBC"]').length == 0 &&  $('[data-target="#modalLocal"]').length == 0) {
                $('#sessions').hide();
    }

});