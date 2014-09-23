$(document).on('scriptDefer', function() {
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({
                    width:0,
                    afterClick: function(){
                        return true;
                    }
                }, options);
                var width = settings.width;
                this.each(function(){
                    var $this = $(this);
                    if (!$this.hasClass('disabled')){
                        $this.hover (
                            function(){
                                $(this).append("<span></span>");
                            },
                            function()
                            {
                                $(this).find("span").remove();
                            });

                        var rating;

                        $this.mousemove (
                            function(e){
                                if (!e) e = window.event;
                                if (e.pageX){
                                    x = e.pageX;
                                } else if (e.clientX){
                                    x = e.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft) - document.documentElement.clientLeft;
	     
                                }
                                var posLeft = 0;
                                var obj = this;
                                while (obj.offsetParent)
                                {
                                    posLeft += obj.offsetLeft;
                                    obj = obj.offsetParent;
                                }
                                var offsetX = x-posLeft,
                                modOffsetX = 5*offsetX%this.offsetWidth;
                                rating = parseInt(5*offsetX/this.offsetWidth);

                                if(modOffsetX > 0) rating+=1;
		
                                jQuery(this).find("span").eq(0).css("width",rating*width);

                            });

                        $this.click (function(){
                            settings.afterClick($this, rating);
                            return false;
                        });
                    }
                });
            }
        };
        $.fn.starRating = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.starRating' );
            }
        };
    })(jQuery);
    $(".star-big").starRating({
        width:26,
        afterClick: function(el, value){
            $.ajax({
                type: "POST",
                data: "cid=" + el.data('id') + "&type=" + el.data('type') + "&val=" + value,
                dataType: "json",
                url: '/star_rating/ajax_rate',
                success: function(obj) {
                    if (obj.rate != null){}
                        el.children().css('width',obj.rate+'%');
                        $('#count_votes_g').text(obj.votes);
                    }
                }
            );
        }
    });
});

