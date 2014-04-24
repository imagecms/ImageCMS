(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                width: 0,
                scale: 5,
                afterClick: function() {
                    return true;
                }
            }, options);
            var width = settings.width,
                    scale = settings.scale;
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
                                if (!e) {
                                    e = window.event;
                                }
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
                                        modOffsetX = scale * offsetX % this.offsetWidth;
                                rating = parseInt(scale * offsetX / this.offsetWidth);

                                if (modOffsetX > 0) {
                                    rating += 1;
                                }
                                jQuery(this).find("span").eq(0).css("width", rating * width);
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
(function() {
    $(".frameRate").starRating({
        width: 53,
        scale: 10,
        afterClick: function(el, value) {
            el.find('.for_comment').css('width', (value * 10) + '%')
            el.find('input').val(value / 10);
            el.find('i').text(value / 10);
        }
    });
})();