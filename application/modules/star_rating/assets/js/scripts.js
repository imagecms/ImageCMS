$('span.clickrate_g').on('click', function() {
        var val = $(this).attr('title');
        $.ajax({
            type: "POST",
            data: "cid=" + currentId + "&type=" + type + "&val=" + val,
            dataType: "json",
            url: '/star_rating/ajax_rate',
            success: function(obj) {
                if (obj.classrate != null)
                    $('#' + 'star_rating_g_' + currentId).removeClass().addClass('rating ' + obj.classrate + ' star_rait');
                    $('#count_votes_g').text(obj.votes);
                    $('#' + 'star_rating_' + currentId).removeClass().addClass('rating_nohover ' + obj.classrate + ' star_rait');
                    $('#count_votes').text(obj.votes);
            }
        });
    });
 