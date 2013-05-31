function renderPosts($this)
{
    $.ajax({
        url: "/comments/commentsapi/renderPosts",
        dataType: "json",
        type: "post",
        success: function(obj) {
            $('#for_comments').empty();

            if (obj !== null) {
                var tpl = obj.comments;

                $('#for_comments').append(tpl);
                $('#comment').val('');
                $('#plus').val('');
                $('#minus').val('');
                $('.comment_ajax_refer > a').bind('click', function() {
                    $this = $(this);
                    $this.next().slideToggle(200, function() {
                        $this.parent().toggleClass('visible');
                    }).end().parent().parent().next().slideToggle(200).end().find('.blue_arrow').toggleClass('up');
                    return false;
                });

                if (obj.total_comments !== 0) {
                    $('#cc').html('');
                    $('#cc').append(obj.total_comments);
                }
            }
        }
    });
}

function post($this)
{
    $.ajax({
        url: "/comments/commentsapi/newPost",
        data: $($this).closest('form').serialize() +
                '&action=newPost',
        dataType: "json",
        type: "post",
        success: function(obj) {


            if (obj.answer === 'sucesfull') {
                $('#comment_text').val('');
                $('#comment_plus').val('');
                $('#comment_minus').val('');
                renderPosts();
            }
            else {
                $($this).closest('form').find('.error_text').html('');
                $($this).closest('form').find('.error_text').append('<div class="msg"><div class="error">' + obj.validation_errors + '</div></div>');
            }
        }
    });
}

/** Start. Star Rating */
$(document).ready(function() {
    (function($) {
        var methods = {
            init: function(options) {
                var settings = $.extend({
                    width: 0,
                    afterClick: function() {
                        return true;
                    }
                }, options);
                var width = settings.width;
                this.each(function() {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {
                        $this.hover(
                                function() {
                                    $(this).append("<span></span>");
                                },
                                function()
                                {
                                    $(this).find("span").remove();
                                });

                        var rating;

                        $this.mousemove(
                                function(e) {
                                    if (!e)
                                        e = window.event;
                                    if (e.pageX) {
                                        x = e.pageX;
                                    } else if (e.clientX) {
                                        x = e.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft) - document.documentElement.clientLeft;

                                    }
                                    var posLeft = 0;
                                    var obj = this;
                                    while (obj.offsetParent)
                                    {
                                        posLeft += obj.offsetLeft;
                                        obj = obj.offsetParent;
                                    }
                                    var offsetX = x - posLeft,
                                            modOffsetX = 5 * offsetX % this.offsetWidth;
                                    rating = parseInt(5 * offsetX / this.offsetWidth);

                                    if (modOffsetX > 0)
                                        rating += 1;

                                    jQuery(this).find("span").eq(0).css("width", rating * width + "px");

                                });

                        $this.click(function() {
                            settings.afterClick($this, rating);
                            return false;
                        });
                    }
                });
            }
        };
        $.fn.starRating = function(method) {
            if (methods[method]) {
                return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if (typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.starRating');
            }
        }
    })(jQuery);
})
/** End. Star Rating */