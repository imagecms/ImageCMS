<div class="page-main">
    {/*}
    {$CI->load->module('banners')->render()}
    { */}
    {$w = 300}
    {$dur = 2}
    {$delay = 5}
    {$cr = 3}
    {$cc = 2}
    {literal}
        <style>
            [data-r*="9"]{
                -webkit-animation-duration: {/literal}{$dur}{literal}s;
                -webkit-animation-timing-function: linear;

                -moz-animation-duration: {/literal}{$dur}{literal}s;
                -moz-animation-timing-function: linear;

                -ms-animation-duration: {/literal}{$dur}{literal}s;
                -ms-animation-timing-function: linear;

                animation-duration: {/literal}{$dur}{literal}s;
                animation-timing-function: linear;
            }
            @-webkit-keyframes y90 {
                from { -webkit-transform: rotateY(0); }
                to { -webkit-transform: rotateY(90deg); }
            }

            @-ms-keyframes y90 {
                from { ms-transform: rotateY(0); }
                to { ms-transform: rotateY(90deg); }
            }

            @keyframes y90 {
                from { transform: rotateY(0); }
                to { transform: rotateY(90deg); }
            }

            [data-r = "y90"]{
                -webkit-animation-name: y90;
                -moz-animation-name: y90;
                -ms-animation-name: y90;
                animation-name: y90;
            }
            [data-cur-r = "y90"]{
                -webkit-transform: rotateY(90deg);
                ms-transform: rotateY(90deg);
                transform: rotateY(90deg);
            }

            @-webkit-keyframes y-90 {
                from { -webkit-transform: rotateY(0); }
                to { -webkit-transform: rotateY(-90deg); }
            }

            @-ms-keyframes y-90 {
                from { ms-transform: rotateY(0); }
                to { ms-transform: rotateY(-90deg); }
            }

            @keyframes y-90 {
                from { transform: rotateY(0); }
                to { transform: rotateY(-90deg); }
            }

            [data-r = "y-90"]{
                -webkit-animation-name: y-90;
                -moz-animation-name: y-90;
                -ms-animation-name: y-90;
                animation-name: y-90;
            }
            [data-cur-r = "y-90"]{
                -webkit-transform: rotateY(-90deg);
                ms-transform: rotateY(-90deg);
                transform: rotateY(-90deg);
            }

            @-webkit-keyframes x-90 {
                from { -webkit-transform: rotateX(0); }
                to { -webkit-transform: rotateX(-90deg); }
            }

            @-ms-keyframes x-90 {
                from { ms-transform: rotateX(0); }
                to { ms-transform: rotateX(-90deg); }
            }

            @keyframes x-90 {
                from { transform: rotateX(0); }
                to { transform: rotateX(-90deg); }
            }

            [data-r = "x-90"]{
                -webkit-animation-name: x-90;
                -moz-animation-name: x-90;
                -ms-animation-name: x-90;
                animation-name: x-90;
            }
            [data-cur-r = "x-90"]{
                -webkit-transform: rotateX(-90deg);
                ms-transform: rotateX(-90deg);
                transform: rotateX(-90deg);
            }

            @-webkit-keyframes x90 {
                from { -webkit-transform: rotateX(0); }
                to { -webkit-transform: rotateX(90deg); }
            }

            @-ms-keyframes x90 {
                from { ms-transform: rotateX(0); }
                to { ms-transform: rotateX(90deg); }
            }

            @keyframes x90 {
                from { transform: rotateX(0); }
                to { transform: rotateX(90deg); }
            }

            [data-r = "x90"]{
                -webkit-animation-name: x90;
                -moz-animation-name: x90;
                -ms-animation-name: x90;
                animation-name: x90;
            }
            [data-cur-r = "x90"]{
                -webkit-transform: rotateX(90deg);
                ms-transform: rotateX(90deg);
                transform: rotateX(90deg);
            }

            .cubes-wrap{position: relative;z-index: 100;}
            .cubes-wrap a{position: absolute;z-index: 2;}
            .cubes-wrap{width: {/literal}{echo $w*3}{literal}px;margin: auto;height: {/literal}{echo $w*$cc}{literal}px;}
            /*************** STANDARD CUBE ***************/
            .cube-wrap {float: left;position: relative;z-index: 1;}

            .cube {
                position: relative;
                height: {/literal}{$w}{literal}px;
                width: {/literal}{$w}{literal}px;

                -webkit-transform-style: preserve-3d;

                -moz-transform-style: preserve-3d;

                -ms-transform-style: preserve-3d;

                transform-style: preserve-3d;
            }

            .cube div {
                position: absolute;
                width: {/literal}{$w}{literal}px;
                height: {/literal}{$w}{literal}px;
                background: rgba(255,255,255,1);
                font-size: 20px;
                text-align: center;
                line-height: 300px;
                color: rgba(0,0,0,1);
                font-family: sans-serif;
                text-transform: uppercase;
            }

            /*************** DEPTH CUBE ***************/
            .depth div.back {
                -webkit-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateY(180deg);
                -moz-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateY(180deg);
                -ms-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateY(180deg);

                transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateY(180deg);
            }
            .depth div.right {
                -webkit-transform:rotateY(-270deg) translateX({/literal}{echo $w/2}{literal}px);
                -webkit-transform-origin: top right;

                -moz-transform:rotateY(-270deg) translateX({/literal}{echo $w/2}{literal}px);
                -moz-transform-origin: top right;

                -ms-transform:rotateY(-270deg) translateX({/literal}{echo $w/2}{literal}px);
                -ms-transform-origin: top right;

                transform:rotateY(-270deg) translateX({/literal}{echo $w/2}{literal}px);
                transform-origin: top right;
            }
            .depth div.left {
                -webkit-transform:rotateY(270deg) translateX(-{/literal}{echo $w/2}{literal}px);
                -webkit-transform-origin: center left;

                -moz-transform:rotateY(270deg) translateX(-{/literal}{echo $w/2}{literal}px);
                -moz-transform-origin: center left;

                -ms-transform:rotateY(270deg) translateX(-{/literal}{echo $w/2}{literal}px);
                -ms-transform-origin: center left;

                transform:rotateY(270deg) translateX(-{/literal}{echo $w/2}{literal}px);
                transform-origin: center left;
            }
            .depth div.top {
                -webkit-transform:rotateX(-90deg) translateY(-{/literal}{echo $w/2}{literal}px);
                -webkit-transform-origin: top center;

                -moz-transform:rotateX(-90deg) translateY(-{/literal}{echo $w/2}{literal}px);
                -moz-transform-origin: top center;

                -ms-transform:rotateX(-90deg) translateY(-{/literal}{echo $w/2}{literal}px);
                -ms-transform-origin: top center;

                transform:rotateX(-90deg) translateY(-{/literal}{echo $w/2}{literal}px);
                transform-origin: top center;
            }
            .depth div.bottom {
                -webkit-transform:rotateX(90deg) translateY({/literal}{echo $w/2}{literal}px);
                -webkit-transform-origin: bottom center;

                -moz-transform:rotateX(90deg) translateY({/literal}{echo $w/2}{literal}px);
                -moz-transform-origin: bottom center;

                -ms-transform:rotateX(90deg) translateY({/literal}{echo $w/2}{literal}px);
                -ms-transform-origin: bottom center;

                transform:rotateX(90deg) translateY({/literal}{echo $w/2}{literal}px);
                transform-origin: bottom center;
            }
            .depth div.front {
                -webkit-transform: translateZ({/literal}{echo $w/2}{literal}px);
                -moz-transform: translateZ({/literal}{echo $w/2}{literal}px);
                -ms-transform: translateZ({/literal}{echo $w/2}{literal}px);

                transform: translateZ({/literal}{echo $w/2}{literal}px);
            }

            .cube-wrap.vertical .cube {
                -webkit-transform-origin: 0 {/literal}{echo $w/2}{literal}px;
                -moz-transform-origin: 0 {/literal}{echo $w/2}{literal}px;
                -ms-transform-origin: 0 {/literal}{echo $w/2}{literal}px;
                transform-origin: 0 {/literal}{echo $w/2}{literal}px;
            }

            .cube-wrap.vertical .depth div.top {
                -webkit-transform:rotateX(-270deg) translateY(-{/literal}{echo $w/2}{literal}px);
                -moz-transform:rotateX(-270deg) translateY(-{/literal}{echo $w/2}{literal}px);
                -ms-transform:rotateX(-270deg) translateY(-{/literal}{echo $w/2}{literal}px);

                transform:rotateX(-270deg) translateY(-{/literal}{echo $w/2}{literal}px);
            }

            .cube-wrap.vertical .depth div.back {
                -webkit-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateX(180deg);
                -moz-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateX(180deg);
                -ms-transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateX(180deg);

                transform: translateZ(-{/literal}{echo $w/2}{literal}px) rotateX(180deg);
            }

            .cube-wrap.vertical .depth div.bottom {
                -webkit-transform: rotateX(-90deg) translateY({/literal}{echo $w/2}{literal}px);
                -moz-transform: rotateX(-90deg) translateY({/literal}{echo $w/2}{literal}px);
                -ms-transform: rotateX(-90deg) translateY({/literal}{echo $w/2}{literal}px);
                transform: rotateX(-90deg) translateY({/literal}{echo $w/2}{literal}px);
            }
        </style>
    {/literal}
    <div class="d_n">
        {$arr = []}
        {$arr[] = $CI->load->module('banners')->getByGroup('1')}
        {$arr[] = $CI->load->module('banners')->getByGroup('2')}
        {$arr[] = $CI->load->module('banners')->getByGroup('6')}
    </div>
    {foreach $arr as $a}
        {$c = count($a)}
        {foreach $a as $oa}
            {echo '<span class="photo' . $oa.position . $c . '" style="background-image: url('.site_url($oa.photo).');"></span>'}
        {/foreach}
    {/foreach}
    <div class="cubes-wrap">
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
        <div class="cube-wrap">
            <div class="cube depth" data-r="">
                <div class="front"></div>
                <div class="back"></div>
                <div class="top"></div>
                <div class="bottom"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
    </div>
    <div class="frame-benefits">
        {widget('benefits')}
    </div>
    <div id="popular_products">
        {widget('popular_products', TRUE)}
    </div>
    <div id="action_products">
        {widget('action_products', TRUE)}
    </div>
    <div id="new_products">
        {widget('new_products', TRUE)}
    </div>
    {widget('brands')}
    <div class="frame-seotext-news">
        <div class="frame-seo-text">
            <div class="container">
                <div class="text seo-text">
                    {widget('start_page_seo_text')}
                </div>
            </div>
        </div>
        {widget('latest_news', TRUE)}
    </div>
</div>
<script>
    Banner = new Object();

    Banner.arrBanners = {json_encode($arr)};
    Banner.w = {$w};
    Banner.cr = {$cr};
    Banner.dur = {$dur} * 1000;
    Banner.delay = {$delay} * 1000;
    Banner.cc = {$cc};
</script>
<script>
    {literal}
        //(function() {
        if (!Object.keys) {
            Object.keys = (function() {
                'use strict';
                var hasOwnProperty = Object.prototype.hasOwnProperty,
                        hasDontEnumBug = !({toString: null}).propertyIsEnumerable('toString'),
                        dontEnums = [
                            'toString',
                            'toLocaleString',
                            'valueOf',
                            'hasOwnProperty',
                            'isPrototypeOf',
                            'propertyIsEnumerable',
                            'constructor'
                        ],
                        dontEnumsLength = dontEnums.length;
                return function(obj) {
                    if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
                        throw new TypeError('Object.keys called on non-object');
                    }

                    var result = [], prop, i;
                    for (prop in obj) {
                        if (hasOwnProperty.call(obj, prop)) {
                            result.push(prop);
                        }
                    }

                    if (hasDontEnumBug) {
                        for (i = 0; i < dontEnumsLength; i++) {
                            if (hasOwnProperty.call(obj, dontEnums[i])) {
                                result.push(dontEnums[i]);
                            }
                        }
                    }
                    return result;
                };
            }());
        }

        var arrBannersN = new Object();
        for (var i in Banner.arrBanners)
            arrBannersN[Object.keys(Banner.arrBanners[i]).length] = Banner.arrBanners[i];

        var arrD = [1, 2, 6],
                arrSeq = [];

        var ii = 0;
        for (var i in arrBannersN) {
            var k = 0;
            for (var j in arrBannersN[i]) {
                if (k == 0) {
                    arrSeq[+j] = [];
                    arrSeq[+j].push(arrD[ii]);
                    ii++;
                    k++;
                }
                else
                    break;
            }
        }
        var seq = [];
        arrSeq.map(function(n, i) {
            seq.push(n[0]);
        });

        var mainWrapper = $('.cubes-wrap'),
                sections = {};
        mainWrapper.children().each(function(i) {
            sections[$(this).index()] = {};
            $(this).find('.cube').children().each(function(j) {
                sections[i][j] = $(this);
            });
        });

        var neighbors = [2, 3, 4, 5];
        var dataR = {4: 'y90', 5: 'y-90', 3: 'x90', 2: 'x-90'};
        var activeSections = [0, 0, 0, 0, 0, 0];
        var activeSection = [0, 0, 0, 0, 0, 0];

        $.fn.setRotate = function(i) {
            var $this = $(this),
                    p = $this.parent(),
                    pp = p.parent();
            if (/x/.test(dataR[i]))
                pp.addClass('vertical');
            else
                pp.removeClass('vertical');
            p.attr('data-r', dataR[i]);

            (function($this, i) {
                setTimeout(function() {
                    var p = $this.parent(),
                            f = p.children().first();

                    var style = $this.attr('style'),
                            html = $this.html();

                    if (!$this.is(f)) {
                        f.attr('style', style);
                        f.html(html);
                    }
                }, Banner.dur);
            })($this, i);

            return $this;
        }
        function setArrayFronts() {
            var newA = [];
            activeSections.map(function(n, i) {
                var n = [].concat(neighbors);
                var v = n[Math.floor(Math.random() * n.length)]
                if (v === activeSection[i]) {
                    n.splice(n.indexOf(v), 1);
                    v = n[Math.floor(Math.random() * n.length)]
                }
                newA.push(v);
            })
            return newA;
        }
        function setPictures(type, start) {
            if (!start)
                activeSection = setArrayFronts();

            mainWrapper.find('a').remove();
            if (arrBannersN[type])
                switch (type) {
                    case 1:
                        {
                            var setPhoto = function(selector, baner) {
                                for (var i in sections) {
                                    var j = i,
                                            k = 0;
                                    if (i > Banner.cr - 1) {
                                        j = i % Banner.cr;
                                        k = Banner.cc - 1;
                                    }

                                    sections[i][activeSection[i]].css({
                                        'background-image': $(selector).css('background-image'),
                                        'background-position': '-' + j * Banner.w + 'px -' + k * Banner.w + 'px'
                                    }).setRotate(activeSection[i]);
                                    if (i == Banner.cc * Banner.cr - 1) {
                                        var link = $('<a style="left: 0;top: 0;width: ' + (Banner.w * Banner.cr) + 'px;height: ' + (Banner.w * Banner.cc) + 'px;"></a>').appendTo(mainWrapper);
                                        if (baner.name)
                                            link.attr('title', baner.name);
                                        if (baner.url)
                                            link.attr('href', baner.url);
                                    }
                                }
                            }
                            for (var i in arrBannersN[type]) {
                                var selector = 'span.photo' + i + type,
                                        photo = $(selector);
                                if (photo.length === 0) {
                                    var img = new Image();
                                    $(img).load(function() {
                                        photo = $('<span class="photo' + i + type + '"></span>').appendTo($('body'));
                                        photo.css('background-image', 'url(' + $(this).attr('src') + ')');
                                        $(this).remove();
                                        setPhoto(selector, arrBannersN[type][i]);
                                    });
                                    img.src = arrBannersN[type][i].photo;
                                }
                                else
                                    setPhoto(selector, arrBannersN[type][i]);
                            }
                        }
                        break;
                    case 2:
                        {
                            var z = [];
                            setPhoto = function(selector, l, baner) {
                                z.push(l);
                                var cPhoto = z.length;

                                for (var i = (cPhoto === 1 ? 0 : Banner.cr); i < (cPhoto === 1 ? Banner.cr : Banner.cr * cPhoto); i++) {
                                    var j = i,
                                            k = 0;
                                    if (i > Banner.cr - 1) {
                                        j = i % Banner.cr;
                                        k = Banner.cc - 1;
                                    }
                                    sections[i][activeSection[i]].css({
                                        'background-image': $(selector).css('background-image'),
                                        'background-position': '-' + j * Banner.w + 'px -' + k * Banner.w + 'px'
                                    }).setRotate(activeSection[i]);

                                    if (i % Banner.cr === 0) {
                                        var link = $('<a style="left: 0;top: ' + (k * Banner.w) + 'px;width: ' + (Banner.w * Banner.cr) + 'px;height: ' + Banner.w + 'px;"></a>').appendTo(mainWrapper);
                                        if (baner.name)
                                            link.attr('title', baner.name);
                                        if (baner.url)
                                            link.attr('href', baner.url);
                                    }
                                }
                            }
                            var j = 0;
                            for (var i in arrBannersN[type]) {
                                var selector = 'span.photo' + i + type,
                                        photo = $(selector);
                                if (photo.length === 0) {
                                    var img = new Image();
                                    (function(j, selector, type, i) {
                                        $(img).load(function() {
                                            photo = $('<span class="photo' + i + type + '"></span>').appendTo($('body'));
                                            photo.css('background-image', 'url(' + $(this).attr('src') + ')');
                                            $(this).remove();
                                            setPhoto(selector, j, arrBannersN[type][i]);
                                        });
                                        img.src = arrBannersN[type][i].photo;
                                    })(j, selector, type, i);
                                }
                                else
                                    setPhoto(selector, j, arrBannersN[type][i]);
                                j++;
                            }
                        }
                        break;
                    case 6:
                        {
                            var setPhoto = function(selector, i, baner) {
                                sections[i][activeSection[i]].css({
                                    'background-image': $(selector).css('background-image'),
                                    'background-position': '0 0'
                                }).setRotate(activeSection[i]);
                                var link = $('<a style="left: 0;top: 0;width: ' + Banner.w + 'px;height: ' + Banner.w + 'px;"></a>').appendTo(sections[i][activeSection[i]]);
                                if (baner.name)
                                    link.attr('title', baner.name);
                                if (baner.url)
                                    link.attr('href', baner.url);
                            }
                            var j = 0;
                            for (var i in arrBannersN[type]) {
                                var selector = 'span.photo' + i + type,
                                        photo = $(selector);
                                if (photo.length === 0) {
                                    var img = new Image();
                                    (function(j, selector, type, i) {
                                        $(img).load(function() {
                                            photo = $('<span class="photo' + i + type + '"></span>').appendTo($('body'));
                                            photo.css('background-image', 'url(' + $(this).attr('src') + ')');
                                            $(this).remove();
                                            setPhoto(selector, j, arrBannersN[type][i]);
                                        });
                                        img.src = arrBannersN[type][i].photo;
                                    })(j, selector, type, i);
                                }
                                else
                                    setPhoto(selector, j, arrBannersN[type][i]);
                                j++;
                            }
                            break;
                        }
                }
            else
                throw 'type: ' + type + ' - not detected';
        }
        $(window).load(function() {
            setPictures(seq[0], true);
            var i = 0;
            setInterval(function() {
                i++;
                i = i < seq.length ? i : 0;
                setPictures(seq[i]);
            }, Banner.delay);
        });
        //})();
    {/literal}
</script>