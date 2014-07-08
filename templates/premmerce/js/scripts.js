$(document).ready(function() {
    $.exists = function(selector) {
        return ($(selector).length > 0);
    };
    $.existsN = function(nabir) {
        return (nabir.length > 0);
    };
    var constructAdaptive = function() {
    };
    constructAdaptive.prototype = {
        moveContent: function(el) {
            this.mediaQuires = {}
            , this.init = function() {
                var _self = this;
                this.mediaQuires = {};
                el.each(function(ind, val) {
                    var $this = $(this),
                            data = $this.data();
                    _self.mediaQuires[ind] = {};
                    _self.mediaQuires[ind]['mqContent'] = $this.html();
                    _self.mediaQuires[ind]['mqMainTarget'] = $this;
                    for (var i in data) {
                        if (/mq/.test(i)) {
                            $.map(data[i].toString().split('|'), function(val, j) {
                                if (!_self.mediaQuires[ind][i])
                                    _self.mediaQuires[ind][i] = [];
                                if (!/mqContent/.test(i))
                                    _self.mediaQuires[ind][i].push(val);
                            });
                        }
                    }
                });
                return _self;
            }
            , this.update = function(wWidth) {
                var _self = this;
                for (var i in _self.mediaQuires) {
                    $.map(_self.mediaQuires[i]['mqTarget'], function(val, ind) {
                        var content = _self.mediaQuires[i].mqContent;
                        $(val).empty();
                        if (!!_self.mediaQuires[i].mqUpdateContent)
                            content = _self.mediaQuires[i].mqMainTarget.html();
                        else
                            _self.mediaQuires[i].mqMainTarget.empty();

                        if (wWidth < +eval(_self.mediaQuires[i].mqMax[ind]) && wWidth >= +eval(_self.mediaQuires[i].mqMin[ind]))
                            $(val).html(content);
                        else if (_self.mediaQuires[i].mqMainTarget.is(':empty'))
                            _self.mediaQuires[i].mqMainTarget.html(content);
                    });
                }
                return this;
            };
        },
        elemPoll: function(el) {
            this.mediaQuires = {}
            , this.isNumeric = function(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
            , this.init = function() {
                var _self = this;
                el.each(function(ind, val) {
                    var $this = $(this),
                            data = $this.data();
                    if (!_self.mediaQuires[ind])
                        _self.mediaQuires[ind] = {};
                    if (!_self.mediaQuires[ind]['target'])
                        _self.mediaQuires[ind]['target'] = $this;
                    for (var i in data) {
                        if (/mq/.test(i)) {
                            $.map(data[i].toString().split('|'), function(val, j) {
                                if (!_self.mediaQuires[ind][i])
                                    _self.mediaQuires[ind][i] = [];
                                _self.mediaQuires[ind][i].push(val);
                            });
                        }
                    }
                });
                return this;
            }
            , this.update = function() {
                var _self = this;
                for (var i in _self.mediaQuires) {
                    $.map(_self.mediaQuires[i]['mqElemPool'], function(val, ind) {
                        $(_self.mediaQuires[i].target).css(_self.mediaQuires[i].mqProp[ind], '');

                        var pixel = parseFloat($(_self.mediaQuires[i].mqElemPool[ind]).css(_self.mediaQuires[i].mqPropPool[ind])),
                                addPixel = parseFloat(_self.mediaQuires[i].mqPropAdd ? eval(_self.mediaQuires[i].mqPropAdd[ind]) : 0);

                        $(_self.mediaQuires[i].target).css(
                                _self.mediaQuires[i].mqProp[ind],
                                +(
                                        (_self.mediaQuires[i].mqPropPref ? _self.mediaQuires[i].mqPropPref[ind] : '')
                                        + ((_self.isNumeric(pixel) ? pixel : 0)
                                                + (_self.isNumeric(addPixel) ? addPixel : 0))
                                        )
                                );
                    });
                }
                return this;
            };
        },
        getWindowWidth: function() {
            return $(window).width() + ($(window).height() < $(document).height() || $('body').css('overflow') === 'scroll' ? this.widthScroll : 0);
        }
    }
    var el = $('<div/>').appendTo('body').css({
        'height': 100,
        'width': 100,
        'overflow': 'scroll'
    }).wrap($('<div style="width:0;height:0;overflow:hidden;"></div>'));
    constructAdaptive.prototype.widthScroll = el.width() - el.get(0).clientWidth;
    el.parent().remove();
    var Adaptive = new constructAdaptive(),
            moveContent = new Adaptive.moveContent($('[data-mq-target]')),
            elemPoll = new Adaptive.elemPoll($('[data-mq-elem-pool]')),
            wWidth = Adaptive.getWindowWidth();

    elemPoll.init();
    moveContent.init();
    moveContent.update(wWidth);
    elemPoll.update(wWidth);

    $('body').on('keyup', '[data-value-const]', function() {
        var $this = $(this),
                val = $this.val(),
                valC = $this.data('valueConst');

        if (val.match(/w{3}\./) == null)
            $this.val(val.replace($this.val().match(/w{1,3}\.?/), valC));
        if (val.length < valC.length)
            $this.val(valC);
    });
    $('body').on('focus', '[data-value-const]', function() {
        if (!$(this).val())
            $(this).val($(this).data('valueConst'))
    });

    $(window).resize(function() {
        if (timer)
            clearTimeout(timer);
        var timer = setTimeout(function() {
            wWidth = Adaptive.getWindowWidth();
            elemPoll.update(wWidth);
            moveContent.update(wWidth);
        }, 350);
    });

    $('body').on('change', '.hidden-type-file input[type="file"]', function() {
        var p = $(this).parent();
        p.next('.path-absolute').remove();
        p.after('<span class="path-absolute">' + $(this).val().replace(/.+[\\\/]/, "") + '</span>');
    });
    $('body').on('click', '.nav-sidebar a', function(e) {
        if ($(this).next().is('ul')) {
            e.preventDefault();
            $(this).next().toggle();
            $(this).closest('li').toggleClass('active');
        }
    });
    $('body').on('click', '.btn-profile', function() {
        $(this).toggleClass('active');
    });

    var lineForm = $('.line-form'),
            lineFormL = lineForm.length;

    lineForm.each(function(i) {
        $(this).closest('.frame-label').css({
            'position': 'relative',
            'z-index': lineFormL - i
        });
    });

    if ($.isFunction(window.cuSel))
        cuSel({
            changedEl: ".line-form:visible select",
            visRows: 15,
            scrollArrows: false
        });
    if ($.fn.tabs)
        $('.tabs').tabs({
            after: function(el, div) {
                cuSel({
                    changedEl: ".line-form:visible select",
                    visRows: 15,
                    scrollArrows: false
                });
            }
        });

    if ($.fn.fancybox)
        $('.fancybox').fancybox({
            overlayOpacity: 0.6,
            overlayColor: '#000',
            padding: 0,
            height: false,
            width: false
        });


    if ($.fn.nStRadio)
        $('.checkboxes-payments').nStRadio({
            wrapper: $(".items > li"),
            elCheckWrap: '.niceRadio'
        });

    $('.pay-check').on('nStRadio.RC', function() {
        $('.sub-pay-check').parent().nStRadio('radioUnCheck');
        $('[id*=sub-payments_]').hide();
        $('.btn-pay-check').attr('disabled', 'disabled');
        var subPayments = $('#sub-payments_' + $(this).val());
        if (!$.existsN(subPayments))
            $('.btn-pay-check').removeAttr('disabled');
        else
            subPayments.show();
    });
    $('.sub-pay-check').on('nStRadio.RC', function() {
        $('.btn-pay-check').removeAttr('disabled');
    });
});