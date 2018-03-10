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

         
            $('#error').hide();
            $("#addPackx").prop('disabled', true);
             $("#addPackx").hide();
            $('.miscamt').hide();

            $('#type').on('change', function() {
                var selection = $('#type option:selected').val();
                var prodPrice = $('#type option:selected').data('price');
                console.log(">> " + selection + " -- " + prodPrice) ;
                if (prodPrice == 0) {
                    $("#addPackx").hide();
                    $("#addPackx").prop('disabled',  true);
                    $('#error').hide();
                    $('.totaldue').hide();
                    $('.miscamt').hide();
                }
                else  {
                    console.log("hello");
                        $("#addPackx").fadeIn();
                        $('#error').hide();
                        $('.totaldue').text("");
                        $('.totaldue').text("New Price:");
                        $('.totaldue').show();
                       
                        $('.miscamt').show();
                        $("#addPackx").prop('disabled',  false);   
                } 
            });

            $("#addPackx").click(function() {
                if ($('#miscamt').val() == '' || $('#miscamt').val() == '$') {
                    $('#error').text('Please fill in a value of a new price');
                    $('#error').fadeIn();
                    console.log("error")

                }
                else  {
                    $('#error').text('');
                    $('#error').hide();
                }
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
            
});

