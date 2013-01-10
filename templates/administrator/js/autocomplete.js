$(document).ready(function() {
    // Fade out the suggestions box when not active
    $("input").blur(function(){
        $('#suggestions').fadeOut();
    });
    $('div .ac_item').live('hover',function(){
        $(this).toggleClass('hover');
    });
    $('div .ac_item').live('click',function(){
        window.location = $(this).attr('href');
    });
});


// 38 - up
// 40 - down
// 13 - enter
var selectorPosition = -1;
function lookup(event)
{
    var code = event.keyCode;
    if(code == 38 || code == 40)
    {
        if(code == 38)
        {
            selectorPosition -= 1;
        }
        if(code == 40)
        {
            selectorPosition += 1;
        }
        if(selectorPosition < 0)
        {
            selectorPosition = 0;
        }
        if(selectorPosition > $("#suggestions > div").length-1)
        {
            selectorPosition = $("#suggestions > div").length-1;
        }

        $("#suggestions .list_frame_searh").each(function(i, el) {
            $(el).removeClass('selected');
            if (i == selectorPosition)
            {
                $(el).addClass('selected');
            }
        });

        return false;
    }

    // Enter pressed
    if (code == 13)
    {
        $("#suggestions > div").each(function(i, el) {
            if($(el).hasClass('selected'))
            {
                window.location = $(el).children('a').attr('href');
            }
        });
    }

    var inputString = $('#inputString');
    if(inputString.val().length == 0)
    {
        $('#suggestions').fadeOut(); // Hide the suggestions box
    }
    else
    {
        $.post("/shop/search", {
            queryString: inputString.val()
            }, function(data) {
            if (data.length > 0) {    
                $('#suggestions').fadeIn(); // Show the suggestions box
                $('#suggestions').html(data); // Fill the suggestions box
                selectorPosition = -1;

                $('#suggestions > div').each(function(i, el) {
                    $(el).mouseover(function(){
                        $('#suggestions > div').removeClass('selected');
                        $(this).addClass('selected');
                        selectorPosition = i;
                    });
                });
            }
            else 
                $('#suggestions').fadeOut();
        });
    }
}