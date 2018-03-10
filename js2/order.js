$(document).ready(function(){
	$('.myButton').mouseover(
	    function(){
	        //$('table .').anim({'backgroundColor': '#6093e7'},400);
	        //$("table#myTable tr.private").css("background-color", "#000000");
	        
	        $(".giftrow td").css("background-color", "#E1A08D");
	        //$(".giftrow td").css("border", "3px", "solid", "#fffff");        
	    }

	);
	$('.myButton').mouseout(
	    function(){
	        //$('table .').anim({'backgroundColor': '#6093e7'},400);
	        //$("table#myTable tr.private").css("background-color", "#000000");
	        
	        $(".giftrow td").css("background-color", "#E18062");
	    }

	);
	 var newcustemail = $("#src-email").text();
           var newcustemail = newcustemail.toUpperCase();
           $("#email").attr('value', newcustemail);
           $('#myModal').on('shown.bs.modal', function (e) {
               $('.dark').css({ opacity: 0.1 });              
           });

           $('#myModal').on('hidden.bs.modal', function (e) {
            $(".dark").css({ opacity: 1 });
           });
        
            $(".clickable-row").click(function() {
                window.location = "profile.php?id=" + $(this).data("href");
            });
            
            $('.clickable-email').click(function(){
                window.location = "profile.php?id=" + $(this).data("href");
            });

    function formatPhone(obj) {
            var numbers = obj.value.replace(/\D/g, ''),
                char = {0:'(',3:') ',6:' - '};
            obj.value = '';
            for (var i = 0; i < numbers.length; i++) {
                obj.value += (char[i]||'') + numbers[i];
            }
           
    }
});