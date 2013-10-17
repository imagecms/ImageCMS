(function($){
    var framechecks = ".frame-group-checks",
    frameFilter = '.frame-filter',
    catalogForm = '#catalog_form',
    apply = '.apply';
    function filtertype(el, totalProducts, otherClass) {
        var $this = el.closest(framechecks),
        $thisRel = $this.data('rel');
        if ($thisRel != undefined) {
            var arr = $thisRel.split(' ');
            $.map(arr, function(n, i) {
                if (n == 'dropDown') {
                    $this.find('.title').next().show();
                    cleaverFilterObj.cleaverFilterFunc(el, totalProducts, otherClass);
                }
                if (n == 'scroll') {
                    cleaverFilterObj.cleaverFilterFunc(el, totalProducts, otherClass);
                }
            });
        }
    }
    function changeSelectFilter(el) {
        ajaxRecount('#cuselFrame-' + $(el).attr('id'), false);
    }
    (function($) {
        var methods = {
            init: function() {
                $(this).each(function() {
                    var $this = $(this),
                    settings = $.extend({
                        slider: $this.find('.slider'),
                        minCost: null,
                        maxCost: null,
                        leftSlider: $this.find('.left-slider'),
                        rightSlider: $this.find('.right-slider')
                    }, eval($this.data('rel')));
                    var slider = settings.slider,
                    minCost = $(settings.minCost),
                    maxCost = $(settings.maxCost),
                    left = settings.leftSlider,
                    right = settings.rightSlider,
                    defMin = settings.defMin,
                    defMax = settings.defMax,
                    curMin = settings.curMin,
                    curMax = settings.curMax,
                    lS = settings.lS,
                    rS = settings.rS;
                    if (!$.existsN(minCost)) {
                        minCost = $('<input type="text" class="minCost" data-mins="' + defMin + '" value="' + curMin + '" name="' + lS + '" />').appendTo($this.closest('form')).hide();
                    }
                    if (!$.existsN(maxCost)) {
                        maxCost = $('<input type="text" class="maxCost" data-maxs="' + defMax + '" value="' + curMax + '" name="' + rS + '"/>').appendTo($this.closest('form')).hide();
                    }
                    slider.slider({
                        min: defMin,
                        max: defMax,
                        values: [curMin, curMax],
                        range: true,
                        slide: function(e, ui) {
                            if ($(ui.handle).is(left)) {
                                $(ui.handle).tooltip({
                                    'title': ui.values[0],
                                    'effect': 'always',
                                    'otherClass': 'tooltip-slider'
                                });
                            }
                            if ($(ui.handle).is(right)) {
                                $(ui.handle).tooltip({
                                    'title': ui.values[1],
                                    'effect': 'always',
                                    'otherClass': 'tooltip-slider'
                                })
                            }

                            minCost.val(ui.values[0]);
                            maxCost.val(ui.values[1]);
                        },
                        stop: function() {
                            ajaxRecount('#' + slider.attr('id'), 'apply-slider');
                        }
                    });
                    minCost.change(function() {
                        var value1 = minCost.val(),
                        value2 = maxCost.val(),
                        minS = minCost.data('mins');
                        if (parseInt(value1) > parseInt(value2)) {
                            value1 = value2;
                            minCost.val(minS);
                        }
                    
                        if (parseInt(value1) < minS) {
                            minCost.val(minS);
                            value1 = minS;
                        }
                        slider.slider("values", 0, value1);
                    });
                    maxCost.change(function() {
                        var value1 = minCost.val(),
                        value2 = maxCost.val(),
                        maxS = maxCost.data('maxs');
                        if (value2 > defMax) {
                            value2 = defMax;
                            maxCost.val(defMax);
                        }

                        if (parseInt(value1) > parseInt(value2)) {
                            value2 = maxS;
                            maxCost.val(maxS);
                        }
                        if (parseInt(value2) > maxS) {
                            maxCost.val(maxS);
                            value2 = maxS;
                        }
                        slider.slider("values", 1, value2);
                    });
                    minCost.add(maxCost).change(function() {
                        ajaxRecount('#' + slider.attr('id'), 'apply-slider');
                    });
                    $('[type="reset"]').click(function() {
                        slider.slider({
                            values: [defMin, defMax]
                        });
                        minCost.attr('value', defMin);
                        maxCost.attr('value', defMax);
                    });
                })
            }
        };
        $.fn.sliderInit = function(method) {
            if (methods[method]) {
                return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if (typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.sliderInit');
            }
        };
    })(jQuery);
    (function($) {
        var methods = {
            init: function(options) {
                $.extend(cleaverFilterObj, {
                    mainWraper: $(this),
                    cleaverFilterFunc: function(elPos, countTov, clas) {
                        cleaverFilterObj.mainWraper.hide();

                        $(cleaverFilterObj.elCount).text(countTov);
                        cleaverFilterObj.mainWraper.find(genObj.plurProd).html(pluralStr(countTov, plurProd));
                        var left = 0;
                        if (cleaverFilterObj.location == 'right') {
                            left = elPos.width() + elPos.offset().left;
                        }
                        if (cleaverFilterObj.location == 'left') {
                            left = elPos.offset().left - cleaverFilterObj.mainWraper.actual('outerWidth');
                        }
                        cleaverFilterObj.mainWraper.css({
                            'left': left,
                            'top': elPos.offset().top - cleaverFilterObj.currentPosScroll[elPos.closest(framechecks).index()]
                        }).removeClass().addClass('apply ' + clas + ' ' + cleaverFilterObj.addingClass);
                        cleaverFilterObj.mainWraper[cleaverFilterObj.effectIn](cleaverFilterObj.duration, function() {
                            $(document).trigger({
                                'type': 'showCleaverFilter', 
                                'el': $(this)
                            });
                        });
                        cleaverFilterObj.mainWraper.find('a').focus();

                    }
                }
                );
                (function() {
                    $(cleaverFilterObj.elClosed).click(function() {
                        methods.triggerBtnClick();
                    });
                    $('body').bind('click', function(e) {
                        if ($(e.target).parents().is(cleaverFilterObj.mainWraper) || $(e.target).is(cleaverFilterObj.mainWraper) || $(e.target).parents().is(cleaverFilterObj.elPos) || $(e.target).is(cleaverFilterObj.elPos)){
                            e.stopPropagation();
                            return;
                        }
                        else {
                            methods.triggerBtnClick();
                        }
                    }).on('keydown', function(e) {
                        var key;
                        if (!e) {
                            var e = window.event;
                        }
                        if (e.keyCode) {
                            key = e.keyCode;
                        }
                        else if (e.which) {
                            key = e.which;
                        }
                        if (key == 27) {
                            methods.triggerBtnClick();
                        }
                    });
                })();
            },
            triggerBtnClick: function() {
                cleaverFilterObj.mainWraper[cleaverFilterObj.effectOff](cleaverFilterObj.duration);
            }
        };
        $.fn.cleaverFilterMethod = function(method) {
            if (methods[method]) {
                return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if (typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.cleaverFilterMethod');
            }
        };
    })(jQuery);
    function afterAjaxInitializeFilter() {
        var $sliders = $('.frame-slider');

        $sliders.sliderInit();
        if ($.exists('#catalog_form .lineForm:visible')) {
            cuSel($.extend({}, cuselOptions, {
                changedEl: '#catalog_form .lineForm select'
            }));
            if (ltie7)
                ieInput($('#catalog_form .cuselText'));
        }
        $(framechecks).nStCheck({
            wrapper: $(".frame-label:has(.niceCheck)"),
            elCheckWrap: '.niceCheck',
            evCond: true,
            //classRemove: 'b_n',//if not standart
            //if evCond: true
            before: function(a, b, c, e) {
                c.nStCheck('changeCheck');
                ajaxRecount('#' + b.attr('id'), false);
                var $thisframechecks = $('#' + b.attr('id')).closest(framechecks);
                if ($thisframechecks.data('rel') != undefined) {
                    if ($thisframechecks.data('rel').match('scroll')) {
                        var scrollabel = $thisframechecks.find('.jspScrollable');
                        if ($.existsN(scrollabel)) {
                            var scrollabelH = scrollabel.height(),
                            posY = scrollabel.data('jsp').getContentPositionY(),
                            addH = posY > scrollabelH ? $thisframechecks.find('.jspArrowUp').height() : 0;
                            cleaverFilterObj.currentPosScroll[$thisframechecks.index()] = scrollabel.data('jsp').getContentPositionY() + addH;
                        }
                        else {
                            cleaverFilterObj.currentPosScroll[$thisframechecks.index()] = 0;
                        }
                    }
                    else {
                        cleaverFilterObj.currentPosScroll[$thisframechecks.index()] = 0;
                    }
                }
                else {
                    cleaverFilterObj.currentPosScroll[$thisframechecks.index()] = 0;
                }
            }
        });
        $(framechecks).each(function() {
            var $this = $(this),
            $thisRel = $this.data('rel'),
            filtersContent = $this.find('.filters-content');
            if ($thisRel != undefined) {
                var arr = $thisRel.split(' '),
                arrL = arr.length;
                $.map(arr, function(n, i) {
                    if (n == 'dropDown') {
                        $this.find('.title .text-el').addClass('d_l');

                        $this.find('.title > span').bind('click.filter', function(e) {
                            var $thisi = $(this);
                            $thisi.parent().next()[cleaverFilterObj.dropDownEff](cleaverFilterObj.dropDownEffDur, function() {
                                if ($(this).is(':visible')) {
                                    cleaverFilterObj.dropDownArr.push($this.attr('id'));
                                }
                                else {
                                    cleaverFilterObj.dropDownArr.splice(cleaverFilterObj.dropDownArr.indexOf($this.attr('id')), 1);
                                }
                                $thisi.toggleClass('valuePD');
                            });
                        });
                    }
                    if (n == 'scroll') {
                        $this.show();
                        var el = filtersContent.show().jScrollPane(scrollPane);
                        if (cleaverFilterObj.currentPosScroll[$this.index()])
                            el.data('jsp').scrollToY(cleaverFilterObj.currentPosScroll[$this.index()]);
                        $this.hide();
                    }
                    if (n == 'dropDown') {
                        filtersContent.hide();
                    }
                    if (arrL - 1 == i) {
                        $this.show();
                        $this.next(preloader).hide()
                    }
                });
                if ($.inArray($this.attr('id'), cleaverFilterObj.dropDownArr) != -1 || $thisRel.match('dropDown') == undefined) {
                    filtersContent.show();
                    $this.find('.title').children().addClass('valuePD');
                }
                else{
                    filtersContent.hide();
                    $this.find('.title').children().removeClass('valuePD');
                }
            }
        });
        $(apply).cleaverFilterMethod();
        $('.tooltip').tooltip('remove');
        $('.clear-filter').click(function() {
            var nm = $(this).data('name');
            $('#' + nm + ' input').attr('checked', false);
            $(catalogForm).submit();
            return false;
        });
        $('.clear-slider').click(function() {
            var obj = eval($(this).data('rel'));
            $(obj.minCost).val(obj.defMin);
            $(obj.maxCost).val(obj.defMax);
            $(catalogForm).submit();

            return false;
        });
    }
    function ajaxRecount(el, slChk) {
        $(frameFilter).children(preloader).show();
        //    $(catalogForm).submit();

        var $this = el,
        data = $(catalogForm).serialize(),
        catUrl = window.location.pathname,
        catUrl = catUrl.replace('shop/category', 'smart_filter/filter');
        $.ajax({
            type: 'get',
            url: catUrl,
            data: data,
            beforeSend: function() {
                $.fancybox.showActivity();
            },
            success: function(msg) {
                var otherClass = '';
                $(frameFilter).html(msg).children(preloader).hide();
                afterAjaxInitializeFilter();
                $.fancybox.hideActivity();
                if (slChk) {
                    otherClass = slChk;
                }
                var frameChecks = $($this).closest(framechecks);
                if (frameChecks.data('rel') == undefined || frameChecks.data('rel').match('cusel')) {
                    cleaverFilterObj.currentPosScroll[frameChecks.index()] = 0;
                    cleaverFilterObj.cleaverFilterFunc($($this), totalProducts, otherClass);
                }
                else {
                    filtertype($($this), totalProducts, otherClass);
                }
            }
        });
        return false;
    }

    $(document).on('scriptDefer', function() {
        $(frameFilter).children(preloader).hide();
        afterAjaxInitializeFilter();
        $(apply).find('a').click(function() {
            $(catalogForm).submit();
            return false;
        });
    });
})(jQuery)