/*plugin nstRadio*/
(function($) {
    $.exists = function(selector) {
        return ($(selector).length > 0);
    };
    $.existsN = function(nabir) {
        return (nabir.length > 0);
    };
    var nS = "nstradio",
            aC = 'active',
            dC = 'disabled',
            methods = {
                init: function(options) {
                    var optionsRadio = $.extend({
                        wrapper: $(".frame-label:has(.niceRadio)"),
                        elCheckWrap: '.niceRadio',
                        classRemove: null,
                        before: function() {
                        },
                        after: function() {
                        }
                    }, options),
                            settings = optionsRadio;
                    var $this = this;
                    if ($.existsN($this)) {
                        $this.each(function() {
                            var $this = $(this),
                                    after = settings.after,
                                    before = settings.before,
                                    classRemove = settings.classRemove,
                                    wrapper = settings.wrapper,
                                    elCheckWrap = settings.elCheckWrap,
                                    input = $this.find(elCheckWrap).find('input');
                            $this.find(elCheckWrap).each(function() {
                                methods.changeRadioStart($(this), classRemove, after, true);
                            });
                            input.each(function() {
                                var input = $(this);
                                $(input.data('link')).focus(function(e) {
                                    if (e.which === 0)
                                        methods.radioCheck(input.parent(), after, false);
                                });
                            });
                            $this.find(wrapper).off('click.' + nS).on('click.' + nS, function(e) {
                                var input = $(this).find('input');
                                if (!input.is(':disabled') && !input.is(':checked')) {
                                    before($(this));
                                    methods.changeRadio($(this).find(elCheckWrap), after, false);
                                }
                            });
                            input.off('click.' + nS).off('change.' + nS).on('click.' + nS + ' change.' + nS, function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                            });
                            input.off('mousedown.' + nS).on('mousedown.' + nS, function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                $(this).closest(wrapper).trigger('click.' + nS);
                            });
                        });
                    }
                },
                changeRadioStart: function(el, classRemove, after, start)
                {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    if (input.is(":checked")) {
                        methods.radioCheck(el, after, start);
                    }
                    if (input.is(":disabled")) {
                        methods.radioDisabled(el);
                    }
                    el.removeClass(classRemove);
                    return false;
                },
                changeRadio: function(el, after, start)
                {
                    if (el === undefined)
                        el = this;
                    methods.radioCheck(el, after, start);
                },
                radioCheck: function(el, after, start) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    el.addClass(aC).removeClass(dC);
                    el.parent().addClass(aC).removeClass(dC);
                    input.attr("checked", true);
                    $(input.data('link')).focus();
                    input.closest('form').find('[name=' + input.attr('name') + ']').not(input).each(function() {
                        methods.radioUnCheck($(this).parent());
                    });
                    after(el, start);
                    input.trigger({
                        'type': 'nStRadio.RC',
                        'el': el,
                        'input': input
                    });
                },
                radioUnCheck: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    el.removeClass(aC);
                    el.parent().removeClass(aC);
                    input.attr("checked", false);
                    input.trigger({
                        'type': 'nStRadio.RUC',
                        'el': el,
                        'input': input
                    });
                },
                radioDisabled: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.attr('disabled', 'disabled');
                    el.removeClass(aC).addClass(dC);
                    el.parent().removeClass(aC).addClass(dC);
                },
                radioUnDisabled: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.removeAttr('disabled');
                    el.removeClass(aC + ' ' + dC);
                    el.parent().removeClass(aC + ' ' + dC);
                }
            };
    $.fn.nStRadio = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.nStRadio');
        }
    };
    $.nStRadio = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstRadio end*/