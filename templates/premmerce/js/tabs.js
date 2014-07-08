/*plugin tabs*/
(function($, wnd) {
    $.existsN = function(nabir) {
        return nabir.length > 0 && nabir instanceof jQuery;
    };
    var aC = 'tab-active';
    var methods = {
        init: function(options) {
            var $this = this;
            if ($.existsN($this)) {
                var thisL = this.length;
                $this.each(function(ind) {
                    var settings = $.extend({}, $.tabs.dP, options),
                            index = methods._index,
                            ul = $(this),
                            li = ul.children(),
                            data = ul.data(),
                            opt = $.extend({}, settings, data),
                            tabsDiv = $([]),
                            tabsId = $([]);
                    opt.toggle = opt.toggle !== undefined ? true : false;
                    
                    methods._index += 1;
                    methods._refs[index] = li.children('[href], [data-href]');
                    methods._cookie[index] = opt.cookie !== undefined ? opt.cookie : null;
                    methods._attrOrdata[index] = methods._refs[index].attr('href') ? 'attr' : 'data';
                    methods._regRefs[index] = [];

                    methods._refs[index].each(function() {
                        var tHref = $(this)[methods._attrOrdata[index]]('href');
                        tabsDiv = tabsDiv.add($(tHref));
                        tabsId = tabsId.add('[data-id=' + tHref + ']');
                        methods._regRefs[index].push(tHref);
                    });
                    methods._refs[index].removeData('start').off('click.' + $.tabs.nS).on('click.' + $.tabs.nS, function(e) {
                        e.preventDefault();
                        var $this = $(this),
                                condStart = e.start,
                                $thisA = $this[methods._attrOrdata[index]]('href'),
                                $thisOld = li.filter('.' + aC).children(),
                                $thisAOld = $thisOld[methods._attrOrdata[index]]('href'),
                                $thisAOld = $thisAOld === $thisA ? null : $thisAOld,
                                $thisAO = $($thisA),
                                $thisS = $this.data('source'),
                                $thisData = $this.data('data'),
                                $thisSel = $this.data('selector'),
                                resB = true;
                        $this.data('start', true);
                        if (settings.before)
                            resB = settings.before.call(ul, $this, $thisAO.add('[data-id=' + $thisA + ']'), condStart);
                        if (resB !== false && !$this.hasClass('tab-disabled') && !$this.is(':disabled')) {
                            function _tabsDivT(callback) {
                                var showBlock = $thisAO.add($('[data-id=' + $thisA + ']'));
                                showBlock = opt.toggle && $thisAO.is(':visible') ? $([]) : showBlock;
                                var blocks = tabsDiv.add(tabsId).not(showBlock);
                                function _after() {
                                    if (settings.after)
                                        settings.after.call(ul, $this, $thisAO.add('[data-id=' + $thisA + ']'), resB);
                                    if (callback)
                                        callback();
                                }
                                function _after2() {
                                    var wLH = window.location.hash;
                                    if (!condStart && ($thisAOld || opt.toggle)) {
                                        var temp = wLH,
                                                changeHash = false;
                                        if (methods.hashsArr)
                                            $.map(methods.hashsArr, function(n, i) {
                                                if ($.inArray('#' + n, methods._regRefs[index]) !== -1)
                                                    changeHash = true;
                                            });
                                        if (changeHash || methods._attrOrdata[index] === 'attr') {
                                            $.map(methods._regRefs[index], function(n, i) {
                                                temp = temp.replace(new RegExp(n, 'ig'), '');
                                            });
                                            if (opt.toggle && !$thisAO.is(':visible')) {
                                                methods.changeHash(temp);
                                                return;
                                            }

                                            temp += $thisA;
                                        }
                                        methods.changeHash(temp);
                                    }
                                }
                                if ($.existsN(blocks)) {
                                    blocks.stop()[opt.effectOff](opt.durationOff, function() {
                                        if (!$thisAO.is(':visible') || opt.elchange)
                                            showBlock[opt.effectOn](opt.durationOn, function() {
                                                _after();
                                            }).addClass(aC);
                                        _after2();
                                    }).removeClass(aC);
                                }
                                else {
                                    _after();
                                    _after2();
                                }
                            }
                            var activeP = $this.parent();
                            li.not(activeP).removeClass(aC);
                            if (activeP.hasClass(aC) && opt.toggle)
                                activeP.removeClass(aC);
                            else
                                activeP.addClass(aC);
                            
                            if (!opt.elchange) {
                                if ($thisS && !$this.hasClass('tab-visited')) {
                                    methods._refs[index].addClass('tab-disabled').attr('disabled', 'disabled');
                                    $this.addClass('tab-visited');
                                    var options = {
                                        el: $this,
                                        div: $thisAO,
                                        start: condStart
                                    };
                                    if ($thisAOld) {
                                        options.elOld = $thisOld;
                                        options.divOld = $($thisAOld);
                                    }
                                    ul.trigger('tabs.beforeload', options);
                                    var optAjax = {
                                        type: 'post',
                                        url: $thisS,
                                        success: function(data) {
                                            _tabsDivT(function() {
                                                methods._refs[index].removeClass('tab-disabled').removeAttr('disabled');
                                            });
                                            if ($thisSel)
                                                $thisAO.find($thisSel).html(data);
                                            else
                                                $thisAO.html(data);
                                            ul.trigger('tabs.afterload', options);
                                        }
                                    };
                                    if ($thisData)
                                        optAjax.data = $thisData;
                                    $.ajax(optAjax);
                                }
                                else {
                                    _tabsDivT();
                                }
                            }
                            else {
                                $(opt.elchange).removeClass(methods._regRefs[index].join(' ').replace(new RegExp('#', 'g'), '')).addClass($thisA.replace('#', ''));
                                if (opt.toggle && !$this.parent().hasClass(aC))
                                    $(opt.elchange).removeClass($thisA.replace('#', ''));
                                _tabsDivT();
                            }

                            if (methods._cookie[index]) {
                                methods.setCookie(methods._cookie[index], $thisA, 0, '/');
                                if (opt.toggle && !$this.parent().hasClass(aC))
                                    methods.setCookie(methods._cookie[index], '', 0, '/');
                            }

                            if (e.scroll)
                                $('html, body').scrollTop($this.offset().top);
                        }
                    });
                    if (thisL - 1 === ind)
                        methods._start(aC);
                });
                wnd.off('hashchange.' + $.tabs.nS).on('hashchange.' + $.tabs.nS, function(e) {
                    var curHash = methods.curHash;
                    var curTop = methods.curTop;
                    methods.curHash = location.hash;
                    methods.curTop = wnd.scrollTop();
                    e.preventDefault();
                    $.map(location.hash.split('#'), function(n, i) {
                        if (n !== '') {
                            var el = $('[data-href="#' + n + '"], [href="#' + n + '"]');
                            if (!$.existsN(el.closest('[data-toggle]')) && !el.parent().hasClass(aC))
                                methods.show.call(el);
                        }
                    });
                    if (curHash) {
                        var curHashArr = curHash.split('#'),
                                curHashArr2 = methods.curHash.split('#');
                        if (curHashArr.length !== curHashArr2.length && curHashArr.length !== 0 && curHashArr2.length !== 0) {
                            $.map([].concat(curHashArr), function(n, i) {
                                $.map([].concat(curHashArr2), function(m, j) {
                                    if (n === m) {
                                        curHashArr2.splice(j, 1);
                                        curHashArr.splice(j, 1);
                                    }
                                });
                            });
                            $.map(methods._regRefs, function(n, i) {
                                if ($.inArray('#' + curHashArr[0], n) !== -1 && !$.existsN(methods._refs[i].first().closest('[data-toggle]')))
                                    methods.show.call(methods._refs[i].first());
                            });
                        }
                    }
                    if (curTop && curTop !== methods.curTop)
                        setTimeout(function() {
                            $('html, body').scrollTop(curTop);
                        }, 10);
                }).off('scroll.' + $.tabs.nS).on('scroll.' + $.tabs.nS, function(e) {
                    methods.curTop = wnd.scrollTop();
                });
            }
            return $this;
        },
        show: function() {
            this.trigger('click.' + $.tabs.nS);
        },
        setCookie: function(name, value, expires, path, domain, secure) {
            var today = new Date();
            today.setTime(today.getTime());
            if (expires)
            {
                expires = expires * 1000 * 60 * 60 * 24;
            }
            var expiresDate = new Date(today.getTime() + (expires));
            document.cookie = name + "=" + encodeURIComponent(value) +
                    ((expires) ? ";expires=" + expiresDate.toGMTString() : "") + ((path) ? ";path=" + path : "") +
                    ((domain) ? ";domain=" + domain : "") +
                    ((secure) ? ";secure" : "");
        },
        getCookie: function(c_name)
        {
            var c_value = document.cookie,
                    c_start = c_value.indexOf(" " + c_name + "=");
            if (c_start === -1)
                c_start = c_value.indexOf(c_name + "=");
            if (c_start === -1)
                c_value = null;
            else
            {
                c_start = c_value.indexOf("=", c_start) + 1;
                var c_end = c_value.indexOf(";", c_start);
                if (c_end === -1)
                    c_end = c_value.length;
                c_value = unescape(c_value.substring(c_start, c_end));
            }
            return c_value;
        },
        changeHash: function(temp) {
            methods.top = wnd.scrollTop();
            window.location.hash = temp;
            $('html, body').scrollTop(methods.top);
        },
        _index: 0,
        _refs: [],
        _regRefs: [],
        _attrOrdata: [],
        _cookie: [],
        _start: function(aC) {
            var hashs = [];
            $.map(methods._refs, function(n, i) {
                var $this = $.existsN(n.parent('.' + aC)) ? n.parent('.' + aC).children(n) : (methods._cookie[i] && methods.getCookie(methods._cookie[i]) ? $('[' + (methods._attrOrdata[i] === 'attr' ? 'href' : 'data-href') + '=' + methods.getCookie(methods._cookie[i]) + ']') : n.first());
                hashs.push($this.data('nonStart') !== undefined ? null : $this[$this.attr('href') ? 'attr' : 'data']('href'));
            });
            var hashsClone = [].concat(hashs);
            if (location.hash !== '') {
                var hashsArr = location.hash.split('#');
                $.map(hashsArr, function(n, i) {
                    $.map(hashsClone, function(m, j) {
                        if ($.inArray('#' + n, methods._regRefs[j]) !== -1)
                            hashs.splice(j, 1, '#' + n);
                    });
                });
            }
            if (hashsArr) {
                $.map(hashsArr, function(n, i) {
                    if (n === '')
                        hashsArr.splice(i, 1);
                });
                methods.hashsArr = hashsArr;
            }
            methods.hashs = hashs;

            $.map(hashs, function(n, i) {
                var tab = $('[' + (methods._attrOrdata[i] === 'attr' ? 'href' : 'data-href') + '=' + n + ']');
                if (!tab.data('start'))
                    tab.trigger({
                        'type': 'click.' + $.tabs.nS,
                        'start': true
                    });
            });
        }
    };
    $.fn.tabs = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.tabs');
        }
    };
    $.tabsInit = function() {
        this.nS = 'tabs';
        this.method = function(m) {
            if (!/_/.test(m))
                return methods[m];
        };
        this.methods = function() {
            var newM = {};
            for (var i in methods) {
                if (!/_/.test(i))
                    newM[i] = methods[i];
            }
            return newM;
        };
        this.dP = {
            effectOn: 'show',
            effectOff: 'hide',
            durationOn: 0,
            durationOff: 0
        };
        this.setParameters = function(options) {
            $.extend(this.dP, options);
        };
    };
    $.tabs = new $.tabsInit();
    $(document).ready(function() {
        $('[data-rel="tabs"]').tabs();
    });
})(jQuery, $(window));
/*/plugin tabs end*/