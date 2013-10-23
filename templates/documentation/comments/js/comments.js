(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                pasteAfter: $(this),
                pasteWhat: $('[data-rel="whoCloneAddPaste"]'),
                evPaste: 'click',
                effectIn: 'fadeIn',
                effectOff: 'fadeOut',
                wherePasteAdd: this,
                whatPasteAdd: '<input type="hidden">',
                duration: 300,
                before: function(el) {
                    return;
                },
                after: function(el, elInserted) {
                    return;
                }
            }, options);
            var $this = $(this);

            pasteAfter = settings.pasteAfter;
            pasteWhat = settings.pasteWhat;
            evPaste = settings.evPaste;
            effectIn = settings.effectIn;
            effectOff = settings.effectOff;
            duration = settings.duration;
            wherePasteAdd = settings.wherePasteAdd;
            whatPasteAdd = settings.whatPasteAdd;
            before = settings.before;
            after = settings.after;

            pasteAfter = pasteAfter.split('.'),
                    $this.on(evPaste, function() {
                methods.evClick($(this));
            });
        },
        evClick: function($this) {
            var pasteAfter2 = $this;
            $.each(pasteAfter, function(i, v) {
                pasteAfter2 = pasteAfter2[v]();
            });

            var insertedEl = pasteAfter2.next(),
                    pasteAfterEL = pasteAfter2;

            before($this);

            if (!pasteAfterEL.hasClass('already')) {
                pasteAfterEL.after(pasteWhat.clone().hide().find(wherePasteAdd).prepend(whatPasteAdd).end()).addClass('already');
                pasteAfterEL.next()[effectIn](duration, function() {
                    if (ltie7)
                        ieInput();
                });
                after($this, pasteAfterEL.next());
            }
            else if (insertedEl.is(':visible'))
                insertedEl[effectOff](duration);
            else if (!insertedEl.is(':visible'))
                insertedEl[effectIn](duration);

        }
    };
    $.fn.cloneAddPaste = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.cloneaddpaste');
        }
    };
})(jQuery);
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
    };
})(jQuery);
function initComments() {
    $(".star-big").starRating({
        width: 26,
        afterClick: function(el, value) {
            if (el.hasClass("clicktemprate")) {
                $('.productRate > div.for_comment').css("width", value * 20 + '%');
                $('#ratec').attr('value', value);
            }
        }
    });
    $('[data-rel="cloneAddPaste"]').cloneAddPaste({
        pasteAfter: 'parent.parent',
        pasteWhat: $('[data-rel="whoCloneAddPaste"]'),
        evPaste: 'click',
        effectIn: 'slideDown',
        effectOff: 'slideUp',
        duration: 300,
        wherePasteAdd: 'form',
        whatPasteAdd: '',
        before: function(el) {
            el.parent().toggleClass('active');
        },
        after: function(el, elInserted) {
            $(elInserted).find('input[name=comment_parent]').val(el.data('parid'));
            $('#comment__icsi-css form').submit(function() {
                return false;
            });
        }
    });
    $('#comment__icsi-css form').submit(function(e) {
        e.preventDefault();
    });
    $('.usefullyes').bind('click', function() {
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid=" + comid,
            dataType: "json",
            url: '/comments/commentsapi/setyes',
            success: function(obj) {
                if (obj !== null)
                    $('#yesholder' + comid).html("(" + obj.y_count + ")");
            }
        });
    });

    $('.usefullno').bind('click', function() {
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid=" + comid,
            dataType: "json",
            url: '/comments/commentsapi/setno',
            success: function(obj) {
                if (obj !== null)
                    $('#noholder' + comid).html("(" + obj.n_count + ")");
            }
        });
    });
}
renderPosts = function(el, data) {
    var dataSend = "";
    if (data != undefined)
        dataSend = data;
    if (el.data() != undefined) {
        dataSend = el.data();
    }
    $.ajax({
        url: "/comments/commentsapi/renderPosts",
        dataType: "json",
        data: dataSend,
        type: "post",
        success: function(obj) {
            el.each(function() {
                $(this).empty();
            });

            if (obj !== null) {
                var tpl = obj.comments;

                var elL = el.length;
                el.each(function(i, n) {
                    $(this).append(tpl);
                    if (i + 1 == elL)
                        initComments();
                });

                if (obj.commentsCount !== 0) {
                    $('#cc').html('');
                    $('#cc').append(obj.commentsCount);
                }
                $(document).trigger({'type': 'rendercomment.after', 'el': el});
            }
        }
    });
};

function post(el) {
    $.ajax({
        url: "/comments/commentsapi/newPost",
        data: $(el).closest('form').serialize() +
                '&action=newPost',
        dataType: "json",
        type: "post",
        success: function(obj) {
            if (obj.answer === 'sucesfull') {
                $('.comment_text').each(function() {
                    $(this).val('');
                });
                $('#comment_plus').val('');
                $('#comment_minus').val('');
                renderPosts($(el).closest('.for_comments'));
            }
            else {
                var errText = $(el).closest('form').find('.error_text');
                errText.html('');
                errText.append('<div class="msg"><div class="error">' + obj.validation_errors + '</div></div>');
            }
        }
    });
}