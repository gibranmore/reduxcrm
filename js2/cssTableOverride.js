$(document).ready(function() {
            $( "tr:odd" ).addClass("odd");
            $( "tr:even" ).addClass("even");
            $('tr').mouseenter(function() {
                var classId = $(this).attr("class");
                console.log("classID: " + classId);
                $(this).css("background", "#7abaff");
                 $(this).css("color", "#fff");

            });
            $('tr').mouseout(function() {
                var classId = $(this).attr("class");
                if (classId == "odd")
                    $(this).css("background", "#2d2a2a");
                else
                     $(this).css("background", "#383a40");
                
            });
             $('tr').click(function() {
                 window.location = "profile.php?id=" + $(this).data('href');
                
            });
});