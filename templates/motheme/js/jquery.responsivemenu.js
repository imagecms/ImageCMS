(function($) {
	$.fn.responsiveMenu = function(options) {
		var defaults = {autoArrows: false}
		var options = $.extend(defaults, options);
		return this.each(function() {
			var $this = $(this);
			var $window = $(window);
			var setClass = function() {
				if ($window.width() > 768) {$this.addClass('dropdown').removeClass('accordion').find('li:has(ul)').removeClass('accorChild');}
				else {$this.addClass('accordion').find('li:has(ul)').addClass('accorChild').parent().removeClass('dropdown');}
			}
			$window.resize(function() {
				setClass();
				$this.find('ul').css('display', 'none');
			});
			setClass();
			$this
				.addClass('responsive-menu')
				.find('li.current a')
				.live('click', function(e) {
					var $a = $(this);
					var container = $a.next('ul,div');
					if ($this.hasClass('accordion') && container.length > 0) {
						container.slideToggle();
						return false;
					}
				})
				.stop()
				.siblings('ul').parent('li').addClass('hasChild');
			if (options.autoArrows) {
				$('.hasChild > a', $this)
				.find('strong').append('<span class="arrow">&nbsp;</span>');
			}
		});
	}
})(jQuery);