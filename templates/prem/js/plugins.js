/*
 *imagecms frontend plugins
 ** @author Domovoj
 * @copyright ImageCMS (c) 2013, Avgustus <domovoj1@gmail.com>
 */
var isTouch = 'ontouchstart' in document.documentElement,
        aC = 'active',
        dC = 'disabled',
        fC = 'focus',
        сC = 'cloned',
        wnd = $(window),
        body = $('body');
$.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
            validLabels = /^(data|css):/,
            attr = {
                method: matchParams[0].match(validLabels) ?
                        matchParams[0].split(':')[0] : 'attr',
                property: matchParams.shift().replace(validLabels, '')
            },
    regexFlags = 'ig',
            regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g, ''), regexFlags);
    return regex.test($(elem)[attr.method](attr.property));
};
if (!Array.indexOf) {
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0); i < this.length; i++) {
            if (this[i] === obj) {
                return i;
            }
        }
        return -1;
    };
}
String.prototype.trimMiddle = function()
{
    var r = /\s\s+/g;
    return $.trim(this).replace(r, ' ');

};
String.prototype.pasteSAcomm = function() {
    var r = /\s,/g;
    return this.replace(r, ',');
};
$.exists = function(selector) {
    return ($(selector).length > 0);
};
$.existsN = function(nabir) {
    return (nabir.length > 0);
};
returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
$.fn.setCursorPosition = function(pos) {
    if (!isTouch)
        this.each(function() {
            this.select();
            try {
                this.setSelectionRange(pos, pos);
            } catch (err) {
            }

        });
    return this;
};
$.fn.getCursorPosition = function() {
    var el = $(this).get(0),
            pos = 0;
    if ('selectionStart' in el) {
        pos = el.selectionStart;
    } else if ('selection' in document) {
        el.focus();
        var Sel = document.selection.createRange();
        var SelLength = document.selection.createRange().text.length;
        Sel.moveStart('character', -el.value.length);
        pos = Sel.text.length - SelLength;
    }
    return pos;
};
/*plugin actual*/
(function($) {
    $.fn.actual = function() {
        if (arguments.length && typeof arguments[0] === 'string') {
            var dim = arguments[0],
                    clone = this.clone().addClass(сC);
            if (arguments[1] === undefined)
                clone.css({
                    position: 'absolute',
                    top: '-9999px'
                }).show().appendTo(body).find('*:not([style*="display:none"])').show();
            var dimS = clone[dim]();
            clone.remove();
            return dimS;
        }
        return undefined;
    };
})(jQuery);
/*/plugin actual end*/
$(document).on('textanimatechange', function(e) {
    var $this = e.el,
            nv = e.nvalue,
            ov = e.ovalue,
            rank = e.rank,
            dif = nv - ov,
            temp = ov;
    if (dif > 0) {
        var ndif = dif,
                step = Math.floor(dif / 100);
    }
    else
    {
        ndif = Math.abs(dif),
                step = -Math.floor(ndif / 100);
    }
    var cond = '',
            numb = setInterval(function() {
                temp += step;
                cond = temp < nv;
                if (dif < 0)
                    cond = temp > nv;
                if (cond && step !== 0)
                    $this.text(rank ? temp.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : temp);
                else {
                    $this.text(rank ? nv.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : nv);
                    clearInterval(numb);
                    temp = nv;
                }
            }, 1);
});
function setCookie(name, value, expires, path, domain, secure)
{
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
}
function getCookie(c_name)
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
}
/*plugin nstCheck*/

/*!
 * jCarousel - Riding carousels with jQuery
 *   http://sorgalla.com/jcarousel/
 *
 * Copyright (c) 2006 Jan Sorgalla (http://sorgalla.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Built on top of the jQuery library
 *   http://jquery.com
 *
 * Inspired by the "Carousel Component" by Bill Scott
 *   http://billwscott.com/carousel/
 */
(function(g) {
    var q = {vertical: !1, rtl: !1, start: 1, offset: 1, size: null, scroll: 3, visible: null, animation: "normal", easing: "swing", auto: 0, wrap: null, initCallback: null, setupCallback: null, reloadCallback: null, itemLoadCallback: null, itemFirstInCallback: null, itemFirstOutCallback: null, itemLastInCallback: null, itemLastOutCallback: null, itemVisibleInCallback: null, itemVisibleOutCallback: null, animationStepCallback: null, buttonNextHTML: "<div></div>", buttonPrevHTML: "<div></div>", buttonNextEvent: "click", buttonPrevEvent: "click", buttonNextCallback: null, buttonPrevCallback: null, itemFallbackDimension: null}, m = !1;
    g(window).bind("load.jcarousel", function() {
        m = !0
    });
    g.jcarousel = function(a, c) {
        this.options = g.extend({}, q, c || {});
        this.autoStopped = this.locked = !1;
        this.buttonPrevState = this.buttonNextState = this.buttonPrev = this.buttonNext = this.list = this.clip = this.container = null;
        if (!c || c.rtl === void 0)
            this.options.rtl = (g(a).attr("dir") || g("html").attr("dir") || "").toLowerCase() == "rtl";
        this.wh = !this.options.vertical ? "width" : "height";
        this.lt = !this.options.vertical ? this.options.rtl ? "right" : "left" : "top";
        for (var b = "", d = a.className.split(" "), f = 0; f < d.length; f++)
            if (d[f].indexOf("jcarousel-skin") != -1) {
                g(a).removeClass(d[f]);
                b = d[f];
                break
            }
        a.nodeName.toUpperCase() == "UL" || a.nodeName.toUpperCase() == "OL" ? (this.list = g(a), this.clip = this.list.parents(".jcarousel-clip"), this.container = this.list.parents(".jcarousel-container")) : (this.container = g(a), this.list = this.container.find("ul,ol").eq(0), this.clip = this.container.find(".jcarousel-clip"));
        if (this.clip.size() === 0)
            this.clip = this.list.wrap("<div></div>").parent();
        if (this.container.size() === 0)
            this.container = this.clip.wrap("<div></div>").parent();
        b !== "" && this.container.parent()[0].className.indexOf("jcarousel-skin") == -1 && this.container.wrap('<div class=" ' + b + '"></div>');
        this.buttonPrev = g(".jcarousel-prev", this.container);
        if (this.buttonPrev.size() === 0 && this.options.buttonPrevHTML !== null)
            this.buttonPrev = g(this.options.buttonPrevHTML).appendTo(this.container);
        this.buttonPrev.addClass(this.className("jcarousel-prev"));
        this.buttonNext = g(".jcarousel-next", this.container);
        if (this.buttonNext.size() === 0 && this.options.buttonNextHTML !== null)
            this.buttonNext = g(this.options.buttonNextHTML).appendTo(this.container);
        this.buttonNext.addClass(this.className("jcarousel-next"));
        this.clip.addClass(this.className("jcarousel-clip")).css({position: "relative"});
        this.list.addClass(this.className("jcarousel-list")).css({overflow: "hidden", position: "relative", top: 0, margin: 0, padding: 0}).css(this.options.rtl ? "right" : "left", 0);
        this.container.addClass(this.className("jcarousel-container")).css({position: "relative"});
        !this.options.vertical && this.options.rtl && this.container.addClass("jcarousel-direction-rtl").attr("dir", "rtl");
        var j = this.options.visible !== null ? Math.ceil(this.clipping() / this.options.visible) : null, b = this.list.children("li"), e = this;
        if (b.size() > 0) {
            var h = 0, i = this.options.offset;
            b.each(function() {
                e.format(this, i++);
                h += e.dimension(this, j)
            });
            this.list.css(this.wh, h + 100 + "px");
            if (!c || c.size === void 0)
                this.options.size = b.size()
        }
        this.container.css("display", "block");
        this.buttonNext.css("display", "block");
        this.buttonPrev.css("display", "block");
        this.funcNext = function() {
            e.next()
        };
        this.funcPrev = function() {
            e.prev()
        };
        this.funcResize = function() {
            e.resizeTimer && clearTimeout(e.resizeTimer);
            e.resizeTimer = setTimeout(function() {
                e.reload()
            }, 100)
        };
        this.options.initCallback !== null && this.options.initCallback(this, "init");
        this.setup()
    };
    var f = g.jcarousel;
    f.fn = f.prototype = {jcarousel: "0.2.8"};
    f.fn.extend = f.extend = g.extend;
    f.fn.extend({setup: function() {
            this.prevLast = this.prevFirst = this.last = this.first = null;
            this.animating = !1;
            this.tail = this.resizeTimer = this.timer = null;
            this.inTail = !1;
            if (!this.locked) {
                this.list.css(this.lt, this.pos(this.options.offset) + "px");
                var a = this.pos(this.options.start, !0);
                this.prevFirst = this.prevLast = null;
                this.animate(a, !1);
                g(window).unbind("resize.jcarousel", this.funcResize).bind("resize.jcarousel", this.funcResize);
                this.options.setupCallback !== null && this.options.setupCallback(this)
            }
        }, reset: function() {
            this.list.empty();
            this.list.css(this.lt, "0px");
            this.list.css(this.wh, "10px");
            this.options.initCallback !== null && this.options.initCallback(this, "reset");
            this.setup()
        }, reload: function() {
            this.tail !== null && this.inTail && this.list.css(this.lt, f.intval(this.list.css(this.lt)) + this.tail);
            this.tail = null;
            this.inTail = !1;
            this.options.reloadCallback !== null && this.options.reloadCallback(this);
            if (this.options.visible !== null) {
                var a = this, c = Math.ceil(this.clipping() / this.options.visible), b = 0, d = 0;
                this.list.children("li").each(function(f) {
                    b += a.dimension(this, c);
                    f + 1 < a.first && (d = b)
                });
                this.list.css(this.wh, b + "px");
                this.list.css(this.lt, -d + "px")
            }
            this.scroll(this.first, !1)
        }, lock: function() {
            this.locked = !0;
            this.buttons()
        }, unlock: function() {
            this.locked = !1;
            this.buttons()
        }, size: function(a) {
            if (a !== void 0)
                this.options.size = a, this.locked || this.buttons();
            return this.options.size
        }, has: function(a, c) {
            if (c === void 0 || !c)
                c = a;
            if (this.options.size !== null && c > this.options.size)
                c = this.options.size;
            for (var b = a; b <= c; b++) {
                var d = this.get(b);
                if (!d.length || d.hasClass("jcarousel-item-placeholder"))
                    return!1
            }
            return!0
        }, get: function(a) {
            return g(">.jcarousel-item-" + a, this.list)
        }, add: function(a, c) {
            var b = this.get(a), d = 0, p = g(c);
            if (b.length === 0)
                for (var j, e = f.intval(a), b = this.create(a); ; ) {
                    if (j = this.get(--e), e <= 0 || j.length) {
                        e <= 0 ? this.list.prepend(b) : j.after(b);
                        break
                    }
                }
            else
                d = this.dimension(b);
            p.get(0).nodeName.toUpperCase() == "LI" ? (b.replaceWith(p), b = p) : b.empty().append(c);
            this.format(b.removeClass(this.className("jcarousel-item-placeholder")), a);
            p = this.options.visible !== null ? Math.ceil(this.clipping() / this.options.visible) : null;
            d = this.dimension(b, p) - d;
            a > 0 && a < this.first && this.list.css(this.lt, f.intval(this.list.css(this.lt)) - d + "px");
            this.list.css(this.wh, f.intval(this.list.css(this.wh)) + d + "px");
            return b
        }, remove: function(a) {
            var c = this.get(a);
            if (c.length && !(a >= this.first && a <= this.last)) {
                var b = this.dimension(c);
                a < this.first && this.list.css(this.lt, f.intval(this.list.css(this.lt)) + b + "px");
                c.remove();
                this.list.css(this.wh, f.intval(this.list.css(this.wh)) - b + "px")
            }
        }, next: function() {
            this.tail !== null && !this.inTail ? this.scrollTail(!1) : this.scroll((this.options.wrap == "both" || this.options.wrap == "last") && this.options.size !== null && this.last == this.options.size ? 1 : this.first + this.options.scroll)
        }, prev: function() {
            this.tail !== null && this.inTail ? this.scrollTail(!0) : this.scroll((this.options.wrap == "both" || this.options.wrap == "first") && this.options.size !== null && this.first == 1 ? this.options.size : this.first - this.options.scroll)
        }, scrollTail: function(a) {
            if (!this.locked && !this.animating && this.tail) {
                this.pauseAuto();
                var c = f.intval(this.list.css(this.lt)), c = !a ? c - this.tail : c + this.tail;
                this.inTail = !a;
                this.prevFirst = this.first;
                this.prevLast = this.last;
                this.animate(c)
            }
        }, scroll: function(a, c) {
            !this.locked && !this.animating && (this.pauseAuto(), this.animate(this.pos(a), c))
        }, pos: function(a, c) {
            var b = f.intval(this.list.css(this.lt));
            if (this.locked || this.animating)
                return b;
            this.options.wrap != "circular" && (a = a < 1 ? 1 : this.options.size && a > this.options.size ? this.options.size : a);
            for (var d = this.first > a, g = this.options.wrap != "circular" && this.first <= 1 ? 1 : this.first, j = d ? this.get(g) : this.get(this.last), e = d ? g : g - 1, h = null, i = 0, k = !1, l = 0; d ? --e >= a : ++e < a; ) {
                h = this.get(e);
                k = !h.length;
                if (h.length === 0 && (h = this.create(e).addClass(this.className("jcarousel-item-placeholder")), j[d ? "before" : "after"](h), this.first !== null && this.options.wrap == "circular" && this.options.size !== null && (e <= 0 || e > this.options.size)))
                    j = this.get(this.index(e)), j.length && (h = this.add(e, j.clone(!0)));
                j = h;
                l = this.dimension(h);
                k && (i += l);
                if (this.first !== null && (this.options.wrap == "circular" || e >= 1 && (this.options.size === null || e <= this.options.size)))
                    b = d ? b + l : b - l
            }
            for (var g = this.clipping(), m = [], o = 0, n = 0, j = this.get(a - 1), e = a; ++o; ) {
                h = this.get(e);
                k = !h.length;
                if (h.length === 0) {
                    h = this.create(e).addClass(this.className("jcarousel-item-placeholder"));
                    if (j.length === 0)
                        this.list.prepend(h);
                    else
                        j[d ? "before" : "after"](h);
                    if (this.first !== null && this.options.wrap == "circular" && this.options.size !== null && (e <= 0 || e > this.options.size))
                        j = this.get(this.index(e)), j.length && (h = this.add(e, j.clone(!0)))
                }
                j = h;
                l = this.dimension(h);
                if (l === 0)
                    throw Error("jCarousel: No width/height set for items. This will cause an infinite loop. Aborting...");
                this.options.wrap != "circular" && this.options.size !== null && e > this.options.size ? m.push(h) : k && (i += l);
                n += l;
                if (n >= g)
                    break;
                e++
            }
            for (h = 0; h < m.length; h++)
                m[h].remove();
            i > 0 && (this.list.css(this.wh, this.dimension(this.list) + i + "px"), d && (b -= i, this.list.css(this.lt, f.intval(this.list.css(this.lt)) - i + "px")));
            i = a + o - 1;
            if (this.options.wrap != "circular" && this.options.size && i > this.options.size)
                i = this.options.size;
            if (e > i) {
                o = 0;
                e = i;
                for (n = 0; ++o; ) {
                    h = this.get(e--);
                    if (!h.length)
                        break;
                    n += this.dimension(h);
                    if (n >= g)
                        break
                }
            }
            e = i - o + 1;
            this.options.wrap != "circular" && e < 1 && (e = 1);
            if (this.inTail && d)
                b += this.tail, this.inTail = !1;
            this.tail = null;
            if (this.options.wrap != "circular" && i == this.options.size && i - o + 1 >= 1 && (d = f.intval(this.get(i).css(!this.options.vertical ? "marginRight" : "marginBottom")), n - d > g))
                this.tail = n - g - d;
            if (c && a === this.options.size && this.tail)
                b -= this.tail, this.inTail = !0;
            for (; a-- > e; )
                b += this.dimension(this.get(a));
            this.prevFirst = this.first;
            this.prevLast = this.last;
            this.first = e;
            this.last = i;
            return b
        }, animate: function(a, c) {
            if (!this.locked && !this.animating) {
                this.animating = !0;
                var b = this, d = function() {
                    b.animating = !1;
                    a === 0 && b.list.css(b.lt, 0);
                    !b.autoStopped && (b.options.wrap == "circular" || b.options.wrap == "both" || b.options.wrap == "last" || b.options.size === null || b.last < b.options.size || b.last == b.options.size && b.tail !== null && !b.inTail) && b.startAuto();
                    b.buttons();
                    b.notify("onAfterAnimation");
                    if (b.options.wrap == "circular" && b.options.size !== null)
                        for (var c = b.prevFirst; c <= b.prevLast; c++)
                            c !== null && !(c >= b.first && c <= b.last) && (c < 1 || c > b.options.size) && b.remove(c)
                };
                this.notify("onBeforeAnimation");
                if (!this.options.animation || c === !1)
                    this.list.css(this.lt, a + "px"), d();
                else {
                    var f = !this.options.vertical ? this.options.rtl ? {right: a} : {left: a} : {top: a}, d = {duration: this.options.animation, easing: this.options.easing, complete: d};
                    if (g.isFunction(this.options.animationStepCallback))
                        d.step = this.options.animationStepCallback;
                    this.list.animate(f, d)
                }
            }
        }, startAuto: function(a) {
            if (a !== void 0)
                this.options.auto = a;
            if (this.options.auto === 0)
                return this.stopAuto();
            if (this.timer === null) {
                this.autoStopped = !1;
                var c = this;
                this.timer = window.setTimeout(function() {
                    c.next()
                }, this.options.auto * 1E3)
            }
        }, stopAuto: function() {
            this.pauseAuto();
            this.autoStopped = !0
        }, pauseAuto: function() {
            if (this.timer !== null)
                window.clearTimeout(this.timer), this.timer = null
        }, buttons: function(a, c) {
            if (a == null && (a = !this.locked && this.options.size !== 0 && (this.options.wrap && this.options.wrap != "first" || this.options.size === null || this.last < this.options.size), !this.locked && (!this.options.wrap || this.options.wrap == "first") && this.options.size !== null && this.last >= this.options.size))
                a = this.tail !== null && !this.inTail;
            if (c == null && (c = !this.locked && this.options.size !== 0 && (this.options.wrap && this.options.wrap != "last" || this.first > 1), !this.locked && (!this.options.wrap || this.options.wrap == "last") && this.options.size !== null && this.first == 1))
                c = this.tail !== null && this.inTail;
            var b = this;
            this.buttonNext.size() > 0 ? (this.buttonNext.unbind(this.options.buttonNextEvent + ".jcarousel", this.funcNext), a && this.buttonNext.bind(this.options.buttonNextEvent + ".jcarousel", this.funcNext), this.buttonNext[a ? "removeClass" : "addClass"](this.className("jcarousel-next-disabled")).attr("disabled", a ? !1 : !0), this.options.buttonNextCallback !== null && this.buttonNext.data("jcarouselstate") != a && this.buttonNext.each(function() {
                b.options.buttonNextCallback(b, this, a)
            }).data("jcarouselstate", a)) : this.options.buttonNextCallback !== null && this.buttonNextState != a && this.options.buttonNextCallback(b, null, a);
            this.buttonPrev.size() > 0 ? (this.buttonPrev.unbind(this.options.buttonPrevEvent + ".jcarousel", this.funcPrev), c && this.buttonPrev.bind(this.options.buttonPrevEvent + ".jcarousel", this.funcPrev), this.buttonPrev[c ? "removeClass" : "addClass"](this.className("jcarousel-prev-disabled")).attr("disabled", c ? !1 : !0), this.options.buttonPrevCallback !== null && this.buttonPrev.data("jcarouselstate") != c && this.buttonPrev.each(function() {
                b.options.buttonPrevCallback(b, this, c)
            }).data("jcarouselstate", c)) : this.options.buttonPrevCallback !== null && this.buttonPrevState != c && this.options.buttonPrevCallback(b, null, c);
            this.buttonNextState = a;
            this.buttonPrevState = c
        }, notify: function(a) {
            var c = this.prevFirst === null ? "init" : this.prevFirst < this.first ? "next" : "prev";
            this.callback("itemLoadCallback", a, c);
            this.prevFirst !== this.first && (this.callback("itemFirstInCallback", a, c, this.first), this.callback("itemFirstOutCallback", a, c, this.prevFirst));
            this.prevLast !== this.last && (this.callback("itemLastInCallback", a, c, this.last), this.callback("itemLastOutCallback", a, c, this.prevLast));
            this.callback("itemVisibleInCallback", a, c, this.first, this.last, this.prevFirst, this.prevLast);
            this.callback("itemVisibleOutCallback", a, c, this.prevFirst, this.prevLast, this.first, this.last)
        }, callback: function(a, c, b, d, f, j, e) {
            if (!(this.options[a] == null || typeof this.options[a] != "object" && c != "onAfterAnimation")) {
                var h = typeof this.options[a] == "object" ? this.options[a][c] : this.options[a];
                if (g.isFunction(h)) {
                    var i = this;
                    if (d === void 0)
                        h(i, b, c);
                    else if (f === void 0)
                        this.get(d).each(function() {
                            h(i, this, d, b, c)
                        });
                    else
                        for (var a = function(a) {
                            i.get(a).each(function() {
                                h(i, this, a, b, c)
                            })
                        }, k = d; k <= f; k++)
                            k !== null && !(k >= j && k <= e) && a(k)
                }
            }
        }, create: function(a) {
            return this.format("<li></li>", a)
        }, format: function(a, c) {
            for (var a = g(a), b = a.get(0).className.split(" "), d = 0; d < b.length; d++)
                b[d].indexOf("jcarousel-") != -1 && a.removeClass(b[d]);
            a.addClass(this.className("jcarousel-item")).addClass(this.className("jcarousel-item-" + c)).css({"float": this.options.rtl ? "right" : "left", "list-style": "none"}).attr("jcarouselindex", c);
            return a
        }, className: function(a) {
            return a + " " + a + (!this.options.vertical ? "-horizontal" : "-vertical")
        }, dimension: function(a, c) {
            var b = g(a);
            if (c == null)
                return!this.options.vertical ? b.outerWidth(!0) || f.intval(this.options.itemFallbackDimension) : b.outerHeight(!0) || f.intval(this.options.itemFallbackDimension);
            else {
                var d = !this.options.vertical ? c - f.intval(b.css("marginLeft")) - f.intval(b.css("marginRight")) : c - f.intval(b.css("marginTop")) - f.intval(b.css("marginBottom"));
                g(b).css(this.wh, d + "px");
                return this.dimension(b)
            }
        }, clipping: function() {
            return!this.options.vertical ? this.clip[0].offsetWidth - f.intval(this.clip.css("borderLeftWidth")) - f.intval(this.clip.css("borderRightWidth")) : this.clip[0].offsetHeight - f.intval(this.clip.css("borderTopWidth")) - f.intval(this.clip.css("borderBottomWidth"))
        }, index: function(a, c) {
            if (c == null)
                c = this.options.size;
            return Math.round(((a - 1) / c - Math.floor((a - 1) / c)) * c) + 1
        }});
    f.extend({defaults: function(a) {
            return g.extend(q, a || {})
        }, intval: function(a) {
            a = parseInt(a, 10);
            return isNaN(a) ? 0 : a
        }, windowLoaded: function() {
            m = !0
        }});
    g.fn.jcarousel = function(a) {
        if (typeof a == "string") {
            var c = g(this).data("jcarousel"), b = Array.prototype.slice.call(arguments, 1);
            return c[a].apply(c, b)
        } else
            return this.each(function() {
                var b = g(this).data("jcarousel");
                b ? (a && g.extend(b.options, a), b.reload()) : g(this).data("jcarousel", new f(this, a))
            })
    }
})(jQuery);

/*plugin myCarousel use jQarousel with correction behavior prev and next buttons*/
(function($) {
    var methods = {
        init: function(options) {
            if ($.existsN(this)) {
                var $jsCarousel = this,
                        settings = $.extend({
                            item: 'li',
                            prev: '.prev',
                            next: '.next',
                            content: '.c-carousel',
                            groupButtons: '.b-carousel',
                            vCarousel: '.v-carousel',
                            hCarousel: '.h-carousel',
                            adding: {},
                            before: function() {
                            },
                            after: function() {
                            }
                        }, options);
                var item = settings.item,
                        prev = settings.prev,
                        next = settings.next,
                        content = settings.content,
                        groupButtons = settings.groupButtons,
                        hCarousel = settings.hCarousel,
                        vCarousel = settings.vCarousel,
                        addO = settings.adding,
                        nS = 'mycarousel';
                $jsCarousel.each(function() {
                    var $this = $(this);
                    settings.before($this);
                    var m = 'show';
                    if (addO.refresh || $this.hasClass('iscarousel'))
                        m = 'children';
                    var $content = $this.find(content),
                            $items = $content.children()[m]().children(item),
                            $itemL = $items.length,
                            $itemW = $items.outerWidth(true),
                            $itemH = $items.outerHeight(true),
                            $thisPrev = $this.find(prev),
                            $thisNext = $this.find(next),
                            $marginR = $itemW - $items.outerWidth(),
                            $marginB = $itemH - $items.outerHeight(),
                            contW = $content.width(),
                            contH = $content.height(),
                            groupButton = $this.find(groupButtons);
                    var $countV = (contW / $itemW).toFixed(1);
                    var k = false, isVert = $.existsN($this.closest(vCarousel)),
                            isHorz = $.existsN($this.closest(hCarousel)),
                            condH = $itemW * $itemL - $marginR > contW && isHorz,
                            condV = ($itemH * $itemL - $marginB > contH) && isVert;
                    var vertical = condV ? true : false;
                    if (condH || condV)
                        k = true;
                    if (k) {
                        var mainO = {
                            buttonNextHTML: $thisNext,
                            buttonPrevHTML: $thisPrev,
                            visible: $countV,
                            scroll: 1,
                            vertical: vertical,
                            itemVisibleInCallback: function() {
                                wnd.scroll();
                            }
                        };
                        $this.jcarousel($.extend(
                                mainO
                                , addO)).addClass('iscarousel');
                        $thisNext.add($thisPrev).css('display', 'inline-block');
                        groupButton.append($thisNext.add($thisPrev));
                        groupButton.append($thisNext.add($thisPrev));
                        var elSet = $this.data();
                        function _handlTouch(type) {
                            if (isTouch && type) {
                                var f = 'pageX',
                                        s = 'pageY';
                                if (type === 'v') {
                                    f = 'pageY';
                                    s = 'pageX';
                                }

                                $this.off('touchstart.' + nS).on('touchstart.' + nS, function(e) {
                                    e = e.originalEvent.touches[0];
                                    elSet.sP = e[f];
                                    elSet.sPs = e[s];
                                });
                                $this.off('touchmove.' + nS).on('touchmove.' + nS, function(e) {
                                    e = e.originalEvent.touches[0];
                                    elSet.eP = e[f];
                                    elSet.ePs = e[s];
                                    e.preventDefault();
                                });

                                $this.off('touchend.' + nS).on('touchend.' + nS, function(e) {
                                    if (Math.abs(elSet.eP - elSet.sP) > Math.abs(elSet.ePs - elSet.sPs))
                                        e.preventDefault();
                                    if (Math.abs(elSet.eP - elSet.sP) > 200) {
                                        if (elSet.eP - elSet.sP > 0)
                                            $thisPrev.click();
                                        else
                                            $thisNext.click();
                                    }
                                });
                            }
                        }
                        var type = false;
                        if (isHorz)
                            type = 'h';
                        if (isVert)
                            type = 'v';
                        _handlTouch(type);
                    }
                    else {
                        if (isHorz) {
                            $items.parent().css('width', $itemW * $itemL);
                        }
                        if (isVert) {
                            $items.parent().css('height', $itemH * $itemL);
                            $content.css('height', 'auto');
                        }
                        $thisNext.add($thisPrev).hide();
                    }
                    settings.after($this);
                });
            }
            return $jsCarousel;
        }
    };
    $.fn.myCarousel = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.myCarousel');
        }
    };
    $.myCarousel = function(m) {
        return methods[m];
    };
})(jQuery);
/*/plugin myCarousel use jQarousel with correction behavior prev and next buttons end*/

/*plugin drop*/
(function($) {
    var methods = {
        init: function(options) {
            this.each(function() {
                var el = methods.destroy($(this)),
                        elSet = el.data(),
                        trigger = methods._checkProp(elSet, options, 'trigger'),
                        triggerOn = methods._checkProp(elSet, options, 'triggerOn'),
                        triggerOff = methods._checkProp(elSet, options, 'triggerOff'),
                        condTrigger = methods._checkProp(elSet, options, 'condTrigger'),
                        modal = methods._checkProp(elSet, options, 'modal');
                if (modal)
                    methods._modalTrigger(el, elSet, options);

                var rel = this.rel;
                if (rel) {
                    rel = rel.replace(methods._reg(), '');
                    var source = el.data('source') || this.href;
                    if (source) {
                        if (!$.drop.drp.galleries[rel])
                            $.drop.drp.galleries[rel] = new Array();
                        $.drop.drp.galleries[rel].push(source);
                    }
                }

                el.data({
                    'drp': options
                }).addClass('isDrop');

                if (triggerOn || triggerOff)
                    el.data({'triggerOn': triggerOn, 'triggerOff': triggerOff}).on(triggerOn + '.' + $.drop.nS + ' ' + triggerOff + '.' + $.drop.nS, function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                    }).on(triggerOn + '.' + $.drop.nS, function(e) {
                        if (condTrigger && eval('(function(){' + condTrigger + '})()'))
                            methods.open(options, null, $(this), e);
                    }).on(triggerOff + '.' + $.drop.nS, function() {
                        methods.close($(el.attr('data-drop')));
                    });
                else
                    el.data('trigger', trigger).on(trigger + '.' + $.drop.nS, function(e) {
                        if (el.parent().hasClass(aC))
                            methods.close($(el.attr('data-drop')));
                        else
                            methods.open(options, null, $(this), e);

                        e.stopPropagation();
                        e.preventDefault();
                    });
                el.on('contextmenu.' + $.drop.nS, function(e) {
                    e.preventDefault();
                });
                var href = el.data('href');
                if (href && window.location.hash.indexOf(href) !== -1 && !$.drop.drp.hrefs[href])
                    methods.open(options, null, el, null);
                if (/#/.test(href) && !$.drop.drp.hrefs[href])
                    $.drop.drp.hrefs[href] = el;
            });
            for (var i in $.drop.drp.galleries)
                if ($.drop.drp.galleries[i].length <= 1)
                    delete $.drop.drp.galleries[i];
            return $(this);
        },
        destroy: function(el) {
            el = el ? el : this;
            el.each(function() {
                var el = $(this),
                        elSet = el.data();
                el.removeClass('isDrop');
                if (elSet.trigger)
                    el.off(elSet.trigger + '.' + $.drop.nS).removeData(elSet.trigger);
                if (elSet.triggerOn)
                    el.off(elSet.triggerOn + '.' + $.drop.nS).removeData(elSet.triggerOn);
                if (elSet.triggerOff)
                    el.off(elSet.triggerOff + '.' + $.drop.nS).removeData(elSet.triggerOff);
            });
            return el;
        },
        get: function(el, set, e, hashChange) {
            if (!el)
                el = this;
            if (!set)
                set = el.data('drp');
            var elSet = el.data(),
                    source = methods._checkProp(elSet, set, 'source') || el.attr('href'),
                    always = methods._checkProp(elSet, set, 'always'),
                    modal = methods._checkProp(elSet, set, 'modal'),
                    type = methods._checkProp(elSet, set, 'type'),
                    dataType = methods._checkProp(elSet, set, 'dataType'),
                    datas = methods._checkProp(elSet, set, 'datas');
            var rel = null;
            if (el.get(0).rel)
                rel = el.get(0).rel.replace(methods._reg(), '');

            function _update(data) {
                $.drop.hideActivity();
                if (!always && !modal)
                    $.drop.drp.drops[source.replace(methods._reg(), '')] = data;

                var drop = methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), methods._checkProp(elSet, set, 'pattern'), $.drop.drp.curDefault, rel);
                drop.attr('pattern', 'yes');
                drop.find($(methods._checkProp(elSet, set, 'placePaste'))).html(data);
                methods._show(el, e, set, data, hashChange);
            }

            if ($.drop.drp.drops[source.replace(methods._reg(), '')]) {
                methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), $.drop.drp.drops[source.replace(methods._reg(), '')], null, rel);
                methods._show(el, e, set, false, hashChange);
                return el;
            }
            if (elSet.drop)
                $.ajax({
                    type: type,
                    data: datas,
                    url: source,
                    beforeSend: function() {
                        if (!methods._checkProp(elSet, set, 'moreOne'))
                            methods._closeMoreOne();

                        $.drop.showActivity();
                    },
                    dataType: modal ? 'json' : dataType,
                    success: function(data) {
                        $.drop.hideActivity();
                        if (!always && !modal)
                            $.drop.drp.drops[source.replace(methods._reg(), '')] = data;

                        if (modal)
                            methods._pasteModal(el, data, set, rel, hashChange);
                        else {
                            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), data, null, rel);
                            var drop = $(elSet.drop);
                            $(document).trigger({
                                type: 'successHtml.' + $.drop.nS,
                                el: drop,
                                datas: data
                            });
                            methods._show(el, e, set, data, hashChange);
                        }
                    }
                });
            else {
                $.drop.drp.curDefault = methods._checkProp(elSet, set, 'defaultClassBtnDrop') + (rel ? rel : (source ? source.replace(methods._reg(), '') : (new Date()).getTime()));
                el.data('drop', '.' + $.drop.drp.curDefault).attr('data-drop', '.' + $.drop.drp.curDefault);

                $.drop.showActivity();
                if (source.match(/jpg|gif|png|bmp|jpeg/)) {
                    var img = new Image();
                    $(img).load(function() {
                        _update($(this));
                    });
                    img.src = source;
                }
                else
                    $.ajax({
                        type: type,
                        url: source,
                        data: datas,
                        dataType: dataType ? dataType : 'html',
                        success: function(data) {
                            _update(data);
                        }
                    });
            }
            return el;
        },
        open: function(opt, datas, $this, e, hashChange) {
            e = e ? e : window.event;
            if (!$this) {
                if ($(this).hasClass('isDrop'))
                    $this = this;
                else {
                    if (datas) {
                        var modalBtnDrop = methods._checkProp(null, opt, 'modalBtnDrop');
                        if (!$.exists('[data-drop="' + modalBtnDrop + '"]')) {
                            $this = $('<div><button data-drop="' + modalBtnDrop + '" data-modal="true"></button></div>').appendTo(body).hide().children();
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, $this.data()), methods._checkProp($this.data(), opt, 'patternNotif'));
                        }
                        else
                            $this = $('[data-drop="' + modalBtnDrop + '"]');
                        $this.data('datas', datas);
                        methods._modalTrigger($this, $this.data(), opt);
                    }
                    else {
                        var sourcePref = opt.source.replace(methods._reg(), ''),
                                defaultClassBtnDrop = methods._checkProp(null, opt, 'defaultClassBtnDrop');

                        if (!$.exists('.refer' + defaultClassBtnDrop + sourcePref))
                            $this = $('<div><button class="refer' + (defaultClassBtnDrop + sourcePref) + '"></button></div>').appendTo(body).hide().children();
                        else
                            $this = $('.refer' + defaultClassBtnDrop + sourcePref);
                    }
                }
            }
            $this.each(function() {
                var $this = $(this),
                        elSet = $this.data(),
                        moreOne = methods._checkProp(elSet, opt, 'moreOne'),
                        source = methods._checkProp(elSet, opt, 'source') || $this.attr('href'),
                        modal = methods._checkProp(elSet, opt, 'modal'),
                        always = methods._checkProp(elSet, opt, 'always'),
                        drop = $(elSet.drop),
                        dropFilter = methods._checkProp(elSet, opt, 'dropFilter'),
                        start = elSet.start;

                if (always && $.existsN(drop) && !modal) {
                    drop.remove();
                    delete $.drop.drp.drops[source.replace(methods._reg(), '')];
                }
                elSet.source = source;//may delete?
                if (dropFilter && !elSet.drop) {
                    drop = methods._filterSource($this, dropFilter);
                    var _classFilter = methods._checkProp(elSet, opt, 'defaultClassBtnDrop') + (new Date()).getTime();
                    $this.attr('data-drop', '.' + _classFilter);
                    elSet.drop = '.' + _classFilter;
                    drop.addClass(_classFilter);
                }
                function _confirmF() {
                    if (!$.existsN(drop) || $.existsN(drop) && source && !$.drop.drp.drops[source.replace(methods._reg(), '')] || modal || always) {
                        if (datas && modal)
                            methods._pasteModal($this, datas, opt, null, hashChange);
                        else
                            methods.get($this, opt, e, hashChange);
                    }
                    else
                        methods._show($this, e, opt, false, hashChange);

                }

                if (!$this.parent().hasClass(aC)) {
                    if (!moreOne && !start)
                        methods._closeMoreOne();

                    if (!$this.is(':disabled')) {
                        var confirm = methods._checkProp(elSet, opt, 'confirm'),
                                prompt = methods._checkProp(elSet, opt, 'prompt');
                        if (start && !eval(start)($this, drop))
                            return false;
                        if (($.existsN(drop) && !modal || source && $.drop.drp.drops[source.replace(methods._reg(), '')]) && !always && !confirm && !prompt) {
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, elSet), $.existsN(drop) ? drop : $.drop.drp.drops[source.replace(methods._reg(), '')]);
                            methods._show($this, e, opt, false, hashChange);
                        }
                        else if (prompt || confirm || source || always) {
                            if (!confirm && !prompt)
                                _confirmF();
                            else//for cofirm && prompt
                                methods._checkMethod(function() {
                                    methods.confirmPrompt(source, methods, elSet, opt, hashChange, _confirmF, e);
                                });
                        }
                        else //for front validations
                            methods._pasteModal($this, datas, opt, null, hashChange);
                    }
                }
                else
                    methods.close($($this.data('drop')));
            });
            return $this;
        },
        close: function(sel, hashChange, f) {
            var sel2 = sel;
            if (!sel2)
                sel2 = this.self ? this.self : this;
            var drop = sel2 instanceof jQuery ? sel2 : $('[data-elrun].' + aC);
            if ((drop instanceof jQuery) && $.existsN(drop)) {
                clearTimeout($.drop.drp.closeDropTime);
                drop.each(function() {
                    var drop = $(this),
                            set = $.extend({}, drop.data('drp'));

                    if (set && drop.is(':visible') && (set.modal || sel || set.place !== 'inherit' || set.inheritClose || set.overlayOpacity !== 0)) {
                        var $thisB = set.elrun;
                        if ($thisB) {
                            var $thisEOff = set.effectOff,
                                    durOff = set.durationOff;
                            function _hide() {
                                $thisB.parent().removeClass(aC);

                                $thisB.each(function() {
                                    var $thisHref = $(this).data('href');

                                    if ($thisHref) {
                                        clearTimeout($.drop.drp.curHashTimeout);
                                        $.drop.drp.curHash = hashChange ? $thisHref : null;
                                        $.drop.drp.scrollTop = wnd.scrollTop();
                                        location.hash = location.hash.replace($thisHref, '');

                                        $.drop.drp.curHashTimeout = setTimeout(function() {
                                            $.drop.drp.curHash = null;
                                            $.drop.drp.scrollTop = null;
                                        }, 400);
                                    }
                                });

                                drop.removeClass(aC);

                                methods._checkMethod(function() {
                                    methods.placeAfterClose(drop, $thisB, set);
                                });

                                drop[$thisEOff](durOff, function() {
                                    var $this = $(this),
                                            ev = set.drop ? set.drop.replace(methods._reg(), '') : '';

                                    if (set.forCenter)
                                        set.forCenter.hide();

                                    wnd.off('resize.' + $.drop.nS + ev).off('scroll.' + $.drop.nS + ev);
                                    body.off('keyup.' + $.drop.nS + ev).off('keyup.' + $.drop.nS).off('click.' + $.drop.nS);

                                    var zInd = 0,
                                            drpV = null;
                                    $('[data-elrun]:visible').each(function() {
                                        var $this = $(this);
                                        if (parseInt($this.css('z-index')) > zInd) {
                                            zInd = parseInt($this.css('z-index'));
                                            drpV = $.extend({}, $this.data('drp'));
                                        }
                                    });

                                    if (drpV && drpV.overlayOpacity !== 0 && !isTouch)
                                        body.addClass('isScroll').css({
                                            'overflow': 'hidden',
                                            'margin-right': $.drop.widthScroll
                                        });
                                    else
                                        body.removeClass('isScroll').css({
                                            'overflow': '',
                                            'margin-right': ''
                                        });

                                    if (set.dropOver && !f)
                                        set.dropOver.fadeOut(durOff);

                                    methods._resetStyleDrop($(this));

                                    $this.removeClass(set.place);
                                    if (set.closed)
                                        set.closed($thisB, $this);
                                    if (set.elClosed)
                                        eval(set.elClosed)($thisB, $this);
                                    if (set.closedG)
                                        eval(set.closedG)($thisB, $this);

                                    $this.add($(document)).trigger({
                                        type: 'closed.' + $.drop.nS,
                                        el: $thisB,
                                        drop: $this
                                    });
                                    var dC = $this.find($(set.dropContent)).data('jsp');
                                    if (dC)
                                        dC.destroy();
                                    if (f)
                                        f();
                                    if (!$.exists('[data-elrun].center:visible, [data-elrun].noinherit:visible'))
                                        $('body, html').css('height', '');
                                });
                            }
                            drop.add($(document)).trigger({
                                type: 'close.' + $.drop.nS,
                                el: $thisB,
                                drop: drop
                            });
                            var close = set.elClose || set.close || set.closeG;
                            if (close) {
                                if (typeof close === 'string')
                                    var res = eval(close)($thisB, $(this));
                                else
                                    var res = close($thisB, $(this));
                                if (res === false && res !== true) {
                                    if (window.console)
                                        console.log(res);
                                }
                                else
                                    _hide();
                            }
                            else
                                _hide();
                        }
                    }
                });
            }
            return sel;
        },
        center: function(drop, start) {
            if (!drop)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this),
                        drp = drop.data('drp');
                if (drp && !drp.droppableIn) {
                    var method = drp.animate && !start ? 'animate' : 'css',
                            dropV = drop.is(':visible'),
                            w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                            h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                            top = Math.floor((wnd.height() - h) / 2),
                            left = Math.floor((wnd.width() - w - $.drop.widthScroll) / 2);
                    drop[method]({
                        'top': top > 0 ? top : 0,
                        'left': left > 0 ? left : 0
                    }, {
                        duration: drp.durationOn,
                        queue: false
                    });
                }
            });
            return drop;
        },
        _resetStyleDrop: function(drop) {
            return drop.css({
                'z-index': '',
                'width': '',
                'height': '',
                'top': '',
                'left': '',
                'bottom': '',
                'right': '',
                'position': ''
            });
        },
        _checkProp: function(elSet, opt, prop) {
            if (!elSet)
                elSet = {};
            if (!opt)
                opt = {};
            if (!isNaN(parseFloat($.drop.dP[prop])) && isFinite($.drop.dP[prop]))
                return +((elSet[prop] !== undefined && elSet[prop] !== null ? elSet[prop].toString() : elSet[prop]) || (opt[prop] !== undefined && opt[prop] !== null ? opt[prop].toString() : opt[prop]) || $.drop.dP[prop].toString());
            if ($.drop.dP[prop] !== undefined && $.drop.dP[prop] !== null && ($.drop.dP[prop].toString().toLowerCase() === 'false' || $.drop.dP[prop].toString().toLowerCase() === 'true'))
                return ((/^true$/i).test(elSet[prop] !== undefined && elSet[prop] !== null ? elSet[prop].toString().toLowerCase() : elSet[prop])) || ((/^true$/i).test(opt[prop] !== undefined && opt[prop] !== null ? opt[prop].toString().toLowerCase() : opt[prop])) || (elSet[prop] !== undefined && elSet[prop] !== null || opt[prop] !== undefined && opt[prop] !== null ? false : $.drop.dP[prop]);
            else
                return elSet[prop] || (opt[prop] ? opt[prop] : false) || $.drop.dP[prop];
            return this;
        },
        _closeMoreOne: function() {
            if ($.exists('[data-elrun].center:visible, [data-elrun].noinherit:visible'))
                methods.close($('[data-elrun].center:visible, [data-elrun].noinherit:visible'));
            return this;
        },
        _modalTrigger: function(el, elSet, set) {
            el.off('successJson.' + $.drop.nS).on('successJson.' + $.drop.nS, function(e) {
                if (e.datas) {
                    if (e.datas.answer === "success")
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').success(e.datas.data));
                    else if (e.datas.answer === "error")
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').error(e.datas.data));
                    else
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').info(e.datas.data));
                }
            });
            return this;
        },
        _pasteModal: function(el, datas, set, rel, hashChange) {
            var elSet = el.data(),
                    drop = $(elSet.drop);
            datas = datas || el.data('datas');
            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), drop, null, rel);
            el.trigger({
                type: 'successJson.' + $.drop.nS,
                el: drop,
                datas: datas
            });
            methods._show(el, null, set, datas, hashChange);
            return this;
        },
        _reg: function() {
            return /[^a-zA-Z0-9]+/ig;
        },
        _pasteDrop: function(set, drop, addClass, rel) {
            if (drop instanceof jQuery && drop.attr('pattern'))
                drop.find(drop.data('drp').placePaste).empty().append($.drop.drp.drops[set.source.replace(methods._reg(), '')]);

            addClass = addClass ? addClass : '';
            rel = rel ? rel : '';

            if (set.place === 'inherit') {
                if (set.placeInherit)
                    drop = $(drop).appendTo($(set.placeInherit).empty());
            }
            else {
                function _for_center(rel) {
                    body.append('<div class="forCenter" data-rel="' + rel + '" style="left: 0;width: 100%;display:none;height: 100%;position: absolute;height: 100%;overflow-x: auto;overflow-y: scroll;"></div>');
                }
                if (set.place === 'noinherit')
                    drop = $(drop).appendTo(body);
                else {
                    var sel = '[data-rel="' + set.drop + '"].forCenter';
                    if (!$.exists(sel))
                        _for_center(set.drop);
                    var drp = $(sel).find('[data-elrun]').data('drp') || {};
                    drop = $(drop).appendTo($(sel).empty());
                    drop.data('drp', drp);
                }
            }
            return drop.addClass(addClass).filter(set.drop).attr('data-rel', rel).attr('data-elrun', set.drop);
        },
        _pasteContent: function($this, drop, opt) {
            function _pasteContent(content, place) {
                if (content) {
                    place = drop.find(place);
                    if (typeof content === 'string' || typeof content === 'number' || typeof content === 'object')
                        place.empty().append(content);
                    else if (typeof content === 'function')
                        content(place, $this, drop);
                }
            }
            _pasteContent(opt.contentHeader, opt.dropHeader);
            _pasteContent(opt.contentContent, opt.dropContent);
            _pasteContent(opt.contentFooter, opt.dropFooter);
            return this;
        },
        _show: function($this, e, set, data, hashChange) {
            $this = $this ? $this : this;
            e = e ? e : window.event;

            var elSet = $this.data(),
                    rel = null,
                    opt = {},
                    self = $this.get(0);

            set = $.extend({}, set ? set : elSet.drp);

            if (self.rel)
                rel = self.rel.replace(methods._reg(), '');

            for (var i in $.drop.dP)
                opt[i] = methods._checkProp(elSet, set, i);

            //callbacks for element, options and global $.drop.dP
            opt.elStart = elSet.start;
            opt.elBefore = elSet.before;
            opt.elAfter = elSet.after;
            opt.elClose = elSet.close;
            opt.elClosed = elSet.closed;
            //
            opt.before = set.before;
            opt.after = set.after;
            opt.close = set.close;
            opt.closed = set.closed;
            //
            opt.beforeG = $.drop.dP.before;
            opt.afterG = $.drop.dP.after;
            opt.closeG = $.drop.dP.close;
            opt.closedG = $.drop.dP.closed;
            //
            opt.drop = elSet.drop;
            var drop = $('[data-elrun="' + opt.drop + '"]'),
                    drp = $.extend({}, drop.data('drp'));

            opt.elrun = drp.elrun ? drp.elrun.add($this) : $this;
            opt.rel = rel;

            $this.attr({
                'data-drop': opt.drop
            }).parent().addClass(aC);

            drop.data('drp', $.extend(drp, opt, {
                'methods': $.extend({}, {
                    'self': drop,
                    'elrun': opt.elrun
                }, $.drop.methods())
            }));

            methods._checkMethod(function() {
                methods.galleries($this, set, methods);
            });

            var overlays = $('.overlayDrop').css('z-index', 1103),
                    condOverlay = opt.overlayOpacity !== 0,
                    dropOver = null;
            if (condOverlay) {
                if (!$.exists('[data-rel="' + opt.drop + '"].overlayDrop'))
                    body.append('<div class="overlayDrop" data-rel="' + opt.drop + '" style="display:none;position:absolute;width:100%;left:0;top:0;"></div>');

                dropOver = $('[data-rel="' + opt.drop + '"].overlayDrop');

                drop.data('drp').dropOver = dropOver;

                dropOver.css('height', '').css({
                    'background-color': opt.overlayColor,
                    'opacity': opt.overlayOpacity,
                    'height': $(document).height(),
                    'z-index': overlays.length + 1103
                });
            }

            $('.forCenter').css('z-index', 1104);
            var forCenter = null,
                    objForC = $('[data-rel="' + opt.drop + '"].forCenter');
            if ($.existsN(objForC))
                forCenter = objForC;

            if (forCenter) {
                if (isTouch)
                    forCenter.css('height', '').css('height', $(document).height());
                drop.data('drp').forCenter = forCenter;
                forCenter.css('z-index', overlays.length + 1104);
            }
            drop.css('z-index', overlays.length + 1104);

            methods._pasteContent($this, drop, opt);

            if (opt.elBefore)
                eval(opt.elBefore)($this, drop, data);
            if (opt.before)
                opt.before($this, drop, data);
            if (opt.beforeG)
                opt.beforeG($this, drop, data);
            drop.add($(document)).trigger({
                'type': 'before.' + $.drop.nS,
                'el': $this,
                'drop': drop,
                'datas': data
            });

            drop.addClass(opt.place);
            methods._positionType(drop);
            if (!isTouch && opt.place !== 'inherit' && opt.overlayOpacity !== 0)
                body.addClass('isScroll').css({'overflow': 'hidden', 'margin-right': $.drop.widthScroll});

            methods._checkMethod(function() {
                methods.limitSize(drop);
            });
            methods._checkMethod(function() {
                methods.heightContent(drop);
            });

            if (forCenter)
                forCenter.css('top', wnd.scrollTop()).show();

            methods._checkMethod(function() {
                methods.placeBeforeShow(drop, $this, methods, opt.place, opt.placeBeforeShow);
            });
            if (opt.place !== 'inherit')
                methods._checkMethod(function() {
                    methods[opt.place](drop);
                });

            var href = $this.data('href');
            if (href) {
                clearTimeout($.drop.drp.curHashTimeout);
                $.drop.drp.curHash = !hashChange ? href : null;
                $.drop.drp.scrollTop = wnd.scrollTop();

                var wlh = window.location.hash;
                if (href.indexOf('#') !== -1 && (new RegExp(href + '#|' + href + '$').exec(wlh) === null))
                    window.location.hash = wlh + href;

                $.drop.drp.curHashTimeout = setTimeout(function() {
                    $.drop.drp.curHash = null;
                    $.drop.drp.scrollTop = null;
                }, 400);
            }
            if (opt.confirm) {
                function focusConfirm() {
                    $(opt.confirmActionBtn).focus();
                }
                setTimeout(focusConfirm, 0);
                drop.click(focusConfirm);
            }
            $(opt.next).add($(opt.prev)).css('height', drop.actual('height'));

            var ev = opt.drop ? opt.drop.replace(methods._reg(), '') : '';
            wnd.off('resize.' + $.drop.nS + ev).on('resize.' + $.drop.nS + ev, function() {
                methods._checkMethod(function() {
                    methods.limitSize(drop);
                });
                methods._checkMethod(function() {
                    methods.heightContent(drop);
                });
                if (opt.place !== 'inherit')
                    methods[opt.place](drop);
                setTimeout(function() {
                    if (dropOver)
                        dropOver.css('height', '').css('height', $(document).height());
                    if (forCenter && isTouch)
                        forCenter.css('height', '').css('height', $(document).height());
                }, 100);
            });
            if (condOverlay)
                dropOver.stop().fadeIn(opt.durationOn / 2);

            if (opt.closeClick)
                $(forCenter).add(dropOver).off('click.' + $.drop.nS + ev).on('click.' + $.drop.nS + ev, function(e) {
                    if ($(e.target).is('.overlayDrop') || $(e.target).is('.forCenter'))
                        methods.close($($(e.target).attr('data-rel')));
                });
            if (opt.prompt) {
                var input = drop.find(opt.promptInput).val(opt.promptInputValue);
                function focusInput() {
                    input.focus();
                }
                setTimeout(focusInput, 0);
                drop.find('form').off('submit.' + $.drop.nS + ev).on('submit.' + $.drop.nS + ev, function(e) {
                    e.preventDefault();
                });
                drop.click(focusInput);
            }
            drop.attr('data-elrun', opt.drop).off('click.' + $.drop.nS, opt.exit).on('click.' + $.drop.nS, opt.exit, function(e) {
                e.stopPropagation();
                methods.close($(this).closest('[data-elrun]'));
            });
            body.off('keyup.' + $.drop.nS);
            if (opt.closeEsc)
                body.on('keyup.' + $.drop.nS, function(e) {
                    var key = e.keyCode;
                    if (key === 27)
                        methods.close(false);
                });
            $('html').css('height', '100%');
            body.css('height', '100%').off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                if (opt.closeClick && !$.existsN($(e.target).closest('[data-elrun]')))
                    methods.close(false);
            });
            drop[opt.effectOn](opt.durationOn, function(e) {
                var drop = $(this);
                $.drop.drp.curDrop = drop;

                if ($.existsN(drop.find('[data-drop]')))
                    methods.init.call(drop.find('[data-drop]'));
                drop.addClass(aC);
                if (opt.modal && opt.timeclosemodal)
                    $.drop.drp.closeDropTime = setTimeout(function() {
                        methods.close(drop);
                    }, opt.timeclosemodal);
                var cB = opt.elAfter;
                if (cB)
                    eval(cB)($this, drop, data);
                if (opt.after)
                    opt.after($this, drop, data);
                if (opt.afterG)
                    opt.afterG($this, drop, data);
                drop.add($(document)).trigger({
                    'type': 'after.' + $.drop.nS,
                    'el': $this,
                    'drop': drop,
                    'datas': data
                });
                if (opt.droppable && opt.place !== 'inherit')
                    methods._checkMethod(function() {
                        methods.droppable(drop);
                    });

                wnd.off('scroll.' + $.drop.nS + ev).on('scroll.' + $.drop.nS + ev, function(e) {
                    if (opt.place === 'center')
                        methods.center(drop);
                });

                if (rel && opt.keyNavigate && methods.galleries)
                    body.off('keyup.' + $.drop.nS + ev).on('keyup.' + $.drop.nS + ev, function(e) {
                        $(this).off('keyup.' + $.drop.nS + ev);
                        var key = e.keyCode;
                        if (key === 37)
                            $(opt.prev).trigger('click.' + $.drop.nS);
                        if (key === 39)
                            $(opt.next).trigger('click.' + $.drop.nS);
                    });
            });
            return this;
        },
        _checkMethod: function(f) {
            try {
                f();
            } catch (e) {
                var method = f.toString().match(/\.\S*\(/);
                returnMsg('need connect ' + method[0].substring(1, method[0].length - 1) + ' method');
            }
            return this;
        },
        _positionType: function(drop) {
            if (drop.data('drp').place !== 'inherit')
                drop.css({
                    'position': drop.data('drp').position
                });
            return this;
        },
        _filterSource: function(btn, s) {
            var source = s.split(').'),
                    regS, regM = '';

            $.each(source, function(i, v) {
                regS = (v[v.length - 1] !== ')' ? v + ')' : v).match(/\(.*\)/);
                regM = regS['input'].replace(regS[0], '');
                regS = regS[0].substring(1, regS[0].length - 1);
                btn = btn[regM](regS);
            });
            return btn;
        }
    };
    $.fn.drop = function(method) {
        if (methods[method]) {
            if (!/_/.test(method))
                return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
            else
                $.error('Method ' + method + ' is private on $.drop');
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.drop');
        }
    };
    $.dropInit = function() {
        this.nS = 'drop';
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
            source: null,
            dataPrompt: null,
            dropContent: '.drop-content-default',
            dropHeader: '.drop-header-default',
            dropFooter: '.drop-footer-default',
            placePaste: '.placePaste',
            modalPlace: '.drop-notification-default',
            datas: null,
            contentHeader: null,
            contentFooter: null,
            contentContent: null,
            start: null,
            placeInherit: null,
            condTrigger: null,
            dropFilter: null,
            message: {
                success: function(text) {
                    return '<div class = "msg js-msg"><div class = "success"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                error: function(text) {
                    return '<div class = "msg js-msg"><div class = "error"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                info: function(text) {
                    return '<div class = "msg js-msg"><div class = "info"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                }
            },
            trigger: 'click',
            triggerOn: '',
            triggerOff: '',
            exit: '[data-closed = "closed-js"]',
            effectOn: 'fadeIn',
            effectOff: 'fadeOut',
            place: 'center',
            placement: 'top left',
            overlayColor: '#fff',
            position: 'absolute',
            placeBeforeShow: 'center center',
            placeAfterClose: 'center center',
            before: function() {
            },
            after: function() {
            },
            close: function() {
            },
            closed: function() {
            },
            pattern: '<div class="drop drop-style drop-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default"></div><div class="drop-content-default"><button class="drop-prev" type="button"  style="display:none;font-size: 30px;position:absolute;width: 35%;left: 20px;top:0;text-align: left;"><</button><button class="drop-next" type="button" style="display:none;font-size: 30px;position:absolute;width: 35%;right: 20px;top:0;text-align: right;">></button><div class="inside-padd placePaste" style="padding: 20px 40px;text-align: center;"></div></div><div class="drop-footer-default"></div></div>',
            modalBtnDrop: '#drop-notification-default',
            defaultClassBtnDrop: 'drop-default',
            patternNotif: '<div class="drop drop-style" id="drop-notification-default" style="background-color: #fff;"><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;"></div><div class="drop-content-default"><div class="inside-padd drop-notification-default"></div></div><div class="drop-footer-default"></div></div>',
            confirmBtnDrop: '#drop-confirm-default',
            confirmActionBtn: '[data-button-confirm]',
            patternConfirm: '<div class="drop drop-style" id="drop-confirm-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Confirm</div><div class="drop-content-default"><div class="inside-padd" style="padding: 20px 40px;text-align: center;"><div class="drop-btn-confirm" style="margin-right: 10px;"><button type="button" data-button-confirm><span class="text-el">confirm</span></button></div><div class="drop-btn-cancel"><button type="button" data-closed="closed-js"><span class="text-el">cancel</span></button></div></div></div><div class="drop-footer-default"></div></div>',
            promptBtnDrop: '#drop-prompt-default',
            promptActionBtn: '[data-button-prompt]',
            promptInput: '[name="promptInput"]',
            patternPrompt: '<div class="drop drop-style" id="drop-prompt-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Prompt</div><div class="drop-content-default"><form class="inside-padd" style="padding: 20px 40px;text-align: center;"><input type="text" name="promptInput"/><div class="drop-btn-prompt" style="margin-right: 10px;"><button type="button" data-button-prompt><span class="text-el">ok</span></button></div><div class="drop-btn-cancel"><button type="submit" data-closed="closed-js"><span class="text-el">cancel</span></button></div></form></div><div class="drop-footer-default"></div></div>',
            promptInputValue: '',
            next: '.drop-next',
            prev: '.drop-prev',
            type: 'post',
            dataType: null,
            overlayOpacity: 0.7,
            durationOn: 200,
            durationOff: 100,
            timeclosemodal: 2000,
            modal: false,
            confirm: false,
            prompt: false,
            always: false,
            animate: false,
            moreOne: false,
            closeClick: false,
            closeEsc: false,
            droppable: false,
            cycle: false,
            limitSize: false,
            limitContentSize: false,
            scrollContent: false,
            droppableLimit: false,
            inheritClose: false,
            keyNavigate: false
        };
        this.drp = {
            hrefs: {},
            drops: {},
            galleries: {},
            scrollemulatetimeout: null,
            curHash: null,
            curDrop: null,
            curHashTimeout: null,
            scrollTop: null
        };
        this.setParameters = function(options) {
            $.extend($.drop.dP, options);
        };
        this.setMethods = function(ms) {
            $.extend(methods, ms);
        };
    };

    var el = $('<div/>').appendTo(body).css({
        'height': 100,
        'width': 100,
        'overflow': 'scroll'
    }).wrap($('<div style="width:0;height:0;overflow:hidden;"></div>'));
    $.dropInit.prototype.widthScroll = el.width() - el.get(0).clientWidth;
    el.parent().remove();

    var loadingTimer, loadingFrame = 1,
            loading = $('<div id="fancybox-loading"><div></div></div>').appendTo(body),
            _animate_loading = function() {
                if (!loading.is(':visible')) {
                    clearInterval(loadingTimer);
                    return;
                }
                $('div', loading).css('top', (loadingFrame * -40) + 'px');
                loadingFrame = (loadingFrame + 1) % 12;
            };
    $.dropInit.prototype.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.dropInit.prototype.hideActivity = function() {
        loading.hide();
    };

    $.drop = new $.dropInit();

    var wLH = window.location.hash;
    wnd.off('hashchange.' + $.drop.nS).on('hashchange.' + $.drop.nS, function(e) {
        e.preventDefault();
        if ($.drop.drp.scrollTop)
            $('html, body').scrollTop($.drop.drp.scrollTop);
        var wLHN = window.location.hash;
        if (!$.drop.drp.curHash)
            for (var i in $.drop.drp.hrefs) {
                if (wLH.indexOf(i) === -1 && wLHN.indexOf(i) !== -1)
                    methods.open({}, null, $.drop.drp.hrefs[i], e, true);
                else
                    methods.close($($.drop.drp.hrefs[i].data('drop')), true);
            }
        wLH = wLHN;
    });
})(jQuery);
/*/plugin drop end*/

/*plugin tabs*/
(function($, wnd) {
    $.existsN = function(nabir) {
        return nabir.length > 0 && nabir instanceof jQuery;
    };
    var aC = 'active';
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
                                            });
                                        else
                                            _after();
                                        showBlock.addClass(aC);
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
                                                console.log(1)
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

/*plugin nstCheck*/
(function($) {
    var nS = "nstcheck",
            methods = {
                init: function(options) {
                    if ($.existsN(this)) {
                        var settings = $.extend({
                            wrapper: $("label:has(.niceCheck)"),
                            elCheckWrap: '.niceCheck',
                            evCond: false,
                            classRemove: 'b_n',
                            resetChecked: false,
                            trigger: function() {
                            },
                            after: function() {
                            }
                        }, options);
                        var frameChecks = $(this),
                                wrapper = settings.wrapper,
                                elCheckWrap = settings.elCheckWrap,
                                evCond = settings.evCond,
                                classRemove = settings.classRemove,
                                after = settings.after,
                                trigger = settings.trigger,
                                resetChecked = settings.resetChecked;
                        frameChecks.find(elCheckWrap).removeClass(dC + ' ' + aC + ' ' + fC);
                        //init event click on wrapper change state
                        frameChecks.find(wrapper).removeClass(dC + ' ' + aC + ' ' + fC).off('click.' + nS).on('click.' + nS, function(e) {
                            var $this = $(this),
                                    nstcheck = $this.find(elCheckWrap);
                            if (!$.existsN(nstcheck))
                                nstcheck = $this;
                            if (!$this.hasClass(dC)) {
                                if (!evCond) {
                                    methods.changeCheck(nstcheck);
                                    after(frameChecks, $this, nstcheck, e);
                                }
                                else {
                                    trigger(frameChecks, $this, nstcheck, e);
                                }
                            }
                            e.preventDefault();
                        });
                        //init event reset
                        frameChecks.closest('form').each(function() {
                            var $this = $(this);
                            if (resetChecked)
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function(e) {
                                    methods.checkAllReset($this.find(elCheckWrap).filter('.' + aC));
                                });
                            else {
                                var checked = $([]);
                                $this.find('input:checked').each(function() {
                                    checked = checked.add($(this).closest(elCheckWrap));
                                });
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function(e) {
                                    var wrap = $this.find(elCheckWrap);
                                    methods.checkAllReset(wrap.not(checked));
                                    methods.checkAllChecks(wrap.not('.' + aC).filter(checked));
                                    e.preventDefault();
                                });
                            }
                        });
                        //init events input
                        wrapper.find('input').off('mousedown.' + nS).on('mousedown.' + nS, function(e) {
                            e.stopPropagation();
                            e.preventDefault()
                            if (e.button == 0)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('click.' + nS).on('click.' + nS, function(e) {
                            e.stopPropagation();
                            e.preventDefault()
                        }).off('keyup.' + nS).on('keyup.' + nS, function(e) {
                            if (e.keyCode === 32)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('focus.' + nS).on('focus.' + nS, function(e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).addClass(fC);
                        }).off('blur.' + nS).on('blur.' + nS, function(e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).removeClass(fC);
                        }).off('change.' + nS).on('change.' + nS, function(e) {
                            e.preventDefault()
                        });
                        //init states of checkboxes
                        frameChecks.find(elCheckWrap).each(function() {
                            var $this = $(this).removeClass(classRemove).addClass(nS),
                                    input = $this.find('input');
                            methods._changeCheckStart($this);
                            if (input.is(':focus'))
                                input.trigger('focus.' + nS);
                            if (input.is(':disabled'))
                                methods.checkAllDisabled($this);
                            else
                                methods.checkAllEnabled($this);
                        });
                    }
                },
                _changeCheckStart: function(el) {
                    if (el === undefined)
                        el = this;
                    el.find("input").is(":checked") ? methods.checkChecked(el) : methods.checkUnChecked(el);
                },
                checkChecked: function(el) {
                    if (el === undefined)
                        el = this;
                    el.addClass(aC).parent().addClass(aC).end().find("input").attr("checked", "checked");
                    el.find('input').trigger({
                        'type': nS + '.cc',
                        'el': el
                    });
                },
                checkUnChecked: function(el) {
                    if (el === undefined)
                        el = this;
                    el.removeClass(aC).parent().removeClass(aC).end().find("input").removeAttr("checked");
                    el.find('input').trigger({
                        'type': nS + '.cuc',
                        'el': el
                    });
                },
                changeCheck: function(el)
                {
                    if (el === undefined)
                        el = this;
                    if (el.find("input").attr("checked") != undefined) {
                        methods.checkUnChecked(el);
                    }
                    else {
                        methods.checkChecked(el);
                    }
                },
                checkAllChecks: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        methods.checkChecked($(this));
                    });
                },
                checkAllReset: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        methods.checkUnChecked($(this));
                    });
                },
                checkAllDisabled: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        var $this = $(this);
                        $this.addClass(dC).parent().addClass(dC).end().find("input").attr('disabled', 'disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ad',
                            'el': $this
                        });
                    });
                },
                checkAllEnabled: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        var $this = $(this);
                        $this.removeClass(dC).parent().removeClass(dC).end().find("input").removeAttr('disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ae',
                            'el': $this
                        });
                    });
                }
            };
    $.fn.nStCheck = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.nStCheck');
        }
    };
    $.nStCheck = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstCheck end*/

/**
 * AuthApi ajax client
 * Makes simple request to api controllers and get return data in json
 * 
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 * 
 * Get JSON object with fields list:
 *      'status'    -   true/false - if the operation was successful,
 *      'msg'       -   info message about result,
 *      'refresh'   -   true/false - if true refreshes the page,
 *      'redirect'  -   url - redirects to needed url
 *    
 * List of api methods:
 *      Auth.php:
 *          '/auth/authapi/login',
 *          '/auth/authapi/logout',
 *          '/auth/authapi/register',
 *          '/auth/authapi/forgot_password',
 *          '/auth/authapi/reset_password',
 *          '/auth/authapi/change_password',
 *          '/auth/authapi/cancel_account',
 *          '/auth/authapi/banned',
 *          '/shop/ajax/getApiNotifyingRequest',
 *          '/shop/callbackApi'
 * 
 **/

var ImageCMSApi = {
    defSet: function() {
        return {
            msgF: '.msg',
            err: 'error', //клас
            scs: 'success', //клас
            hideForm: true,
            messagePlace: 'ahead', // behind
            durationHideForm: 3000,
            cMsgPlace: 'after', //place error
            captcha: function(ci) {
                return '<div class="frame-label"><span class="title">' + text.captchaText + '</span>\n\
                        <span class="frame-form-field">\n\
                            <input type="text" name="captcha" value="' + text.captchaText + '"/> \n\
                            <span class="help-block" id="for_captcha_image">' + ci + '</span>\n\
                        </span></div>'
            },
            captchaBlock: '#captcha_block',
            cMsg: function(name, text, classN, form) {
                form.find('[for="' + name + '"]').remove();
                return '<label for="' + name + '" class="for_validations ' + classN + '">' + text + '</label>';
            }
// callback (callback accept (msg, status, form, DS)) where DS - imageCmsApiDefaults and "any other" ex. report_appereance has drop:".drop-report" if callback return true form hide
// any other
        };
    },
    formAction: function(url, selector, obj) {
        //collect data from form
        var DS = $.extend($.extend({}, this.defSet()), obj);
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        //send api request to api controller
        $(document).trigger({
            'type': 'showActivity'
        });
        $.ajax({
            type: "POST",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                $(document).trigger({
                    'type': 'imageapi.success',
                    'obj': DS,
                    'el': form,
                    'message': obj
                });
                if (obj !== null) {
                    var form = $(selector);
                    returnMsg("[status]:" + obj.status);
                    returnMsg("[message]: " + obj.msg);

                    obj.refresh = obj.refresh != undefined ? obj.refresh.toString() : obj.refresh;
                    obj.redirect = obj.redirect != undefined ? obj.redirect.toString() : obj.redirect;

                    var cond = (obj.refresh && obj.refresh === 'true' && obj.redirect === 'false') || (obj.redirect && obj.redirect !== 'false' && obj.redirect !== '');
                    if (cond)
                        $(document).trigger({
                            'type': 'imageapi.before_refresh_reload',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    if (typeof DS.callback === 'function')
                        DS.callback(obj.msg, obj.status, form, DS);
                    else if (obj.status === true && !cond)
                        setTimeout((function() {
                            form.parent().find(DS.msgF).fadeOut(function() {
                                $(this).remove();
                            });
                            if (DS.hideForm)
                                form.show();
                        }), DS.durationHideForm);

                    setTimeout(function() {
                        if (obj.refresh === 'true' && obj.redirect === 'false')
                            location.reload();
                        if (obj.refresh === 'false' && obj.redirect !== '' && obj.redirect !== 'false')
                            location.href = obj.redirect;
                    }, DS.durationHideForm);

                    if ($.trim(obj.msg) !== '' && obj.validations === undefined) {
                        if (DS.hideForm)
                            form.hide();
                        var type = obj.status === true ? 'success' : 'error';
                        if (DS.messagePlace === 'ahead')
                            $(message[type](obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace === 'behind')
                            $(message[type](obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    }
                    if (obj.cap_image) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations) {
                        ImageCMSApi.sendValidations(obj.validations, form, DS, obj);
                    }
                    $(form).find(':input').off('input.imageapi').on('input.imageapi', function() {
                        var $this = $(this),
                                form = $this.closest('form'),
                                $thisТ = $this.attr('name'),
                                elMsg = form.find('[for=' + $thisТ + ']');
                        if ($.exists(elMsg)) {
                            $this.removeClass(DS.err + ' ' + DS.scs);
                            elMsg.remove();
                            $(document).trigger({
                                'type': 'imageapi.hidemsg',
                                'el': form,
                                'obj': DS,
                                'message': obj
                            });
                            $this.focus();
                        }
                    });
                }
                return this;
            }
        }).done(function() {
            returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $(selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    sendValidations: function(validations, selector, DS, obj) {
        /**
         * for displaying validation messages 
         * in the form, which needs validation, for each validate input
         * 
         * */
        var sel = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] !== "") {
                    var input = sel.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, sel));
                }
                if (i === Object.keys(validations).length) {
                    $(document).trigger({
                        'type': 'imageapi.pastemsg',
                        'el': sel,
                        'obj': DS,
                        'message': obj
                    });
                    var finput = sel.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
                i++;
            }
        } else {
            return false;
        }
    },
    addCaptcha: function(cI, DS) {
        /**
         * add captcha block if needed
         * @param {type} captcha_image
         */
        DS.captchaBlock.html(DS.captcha(cI));
        return false;
    }
};