//_underscore-min
(function(){var n=this,t=n._,r={},e=Array.prototype,u=Object.prototype,i=Function.prototype,a=e.push,o=e.slice,c=e.concat,l=u.toString,f=u.hasOwnProperty,s=e.forEach,p=e.map,h=e.reduce,v=e.reduceRight,d=e.filter,g=e.every,m=e.some,y=e.indexOf,b=e.lastIndexOf,x=Array.isArray,_=Object.keys,j=i.bind,w=function(n){return n instanceof w?n:this instanceof w?(this._wrapped=n,void 0):new w(n)};"undefined"!=typeof exports?("undefined"!=typeof module&&module.exports&&(exports=module.exports=w),exports._=w):n._=w,w.VERSION="1.4.4";var A=w.each=w.forEach=function(n,t,e){if(null!=n)if(s&&n.forEach===s)n.forEach(t,e);else if(n.length===+n.length){for(var u=0,i=n.length;i>u;u++)if(t.call(e,n[u],u,n)===r)return}else for(var a in n)if(w.has(n,a)&&t.call(e,n[a],a,n)===r)return};w.map=w.collect=function(n,t,r){var e=[];return null==n?e:p&&n.map===p?n.map(t,r):(A(n,function(n,u,i){e[e.length]=t.call(r,n,u,i)}),e)};var O="Reduce of empty array with no initial value";w.reduce=w.foldl=w.inject=function(n,t,r,e){var u=arguments.length>2;if(null==n&&(n=[]),h&&n.reduce===h)return e&&(t=w.bind(t,e)),u?n.reduce(t,r):n.reduce(t);if(A(n,function(n,i,a){u?r=t.call(e,r,n,i,a):(r=n,u=!0)}),!u)throw new TypeError(O);return r},w.reduceRight=w.foldr=function(n,t,r,e){var u=arguments.length>2;if(null==n&&(n=[]),v&&n.reduceRight===v)return e&&(t=w.bind(t,e)),u?n.reduceRight(t,r):n.reduceRight(t);var i=n.length;if(i!==+i){var a=w.keys(n);i=a.length}if(A(n,function(o,c,l){c=a?a[--i]:--i,u?r=t.call(e,r,n[c],c,l):(r=n[c],u=!0)}),!u)throw new TypeError(O);return r},w.find=w.detect=function(n,t,r){var e;return E(n,function(n,u,i){return t.call(r,n,u,i)?(e=n,!0):void 0}),e},w.filter=w.select=function(n,t,r){var e=[];return null==n?e:d&&n.filter===d?n.filter(t,r):(A(n,function(n,u,i){t.call(r,n,u,i)&&(e[e.length]=n)}),e)},w.reject=function(n,t,r){return w.filter(n,function(n,e,u){return!t.call(r,n,e,u)},r)},w.every=w.all=function(n,t,e){t||(t=w.identity);var u=!0;return null==n?u:g&&n.every===g?n.every(t,e):(A(n,function(n,i,a){return(u=u&&t.call(e,n,i,a))?void 0:r}),!!u)};var E=w.some=w.any=function(n,t,e){t||(t=w.identity);var u=!1;return null==n?u:m&&n.some===m?n.some(t,e):(A(n,function(n,i,a){return u||(u=t.call(e,n,i,a))?r:void 0}),!!u)};w.contains=w.include=function(n,t){return null==n?!1:y&&n.indexOf===y?n.indexOf(t)!=-1:E(n,function(n){return n===t})},w.invoke=function(n,t){var r=o.call(arguments,2),e=w.isFunction(t);return w.map(n,function(n){return(e?t:n[t]).apply(n,r)})},w.pluck=function(n,t){return w.map(n,function(n){return n[t]})},w.where=function(n,t,r){return w.isEmpty(t)?r?null:[]:w[r?"find":"filter"](n,function(n){for(var r in t)if(t[r]!==n[r])return!1;return!0})},w.findWhere=function(n,t){return w.where(n,t,!0)},w.max=function(n,t,r){if(!t&&w.isArray(n)&&n[0]===+n[0]&&65535>n.length)return Math.max.apply(Math,n);if(!t&&w.isEmpty(n))return-1/0;var e={computed:-1/0,value:-1/0};return A(n,function(n,u,i){var a=t?t.call(r,n,u,i):n;a>=e.computed&&(e={value:n,computed:a})}),e.value},w.min=function(n,t,r){if(!t&&w.isArray(n)&&n[0]===+n[0]&&65535>n.length)return Math.min.apply(Math,n);if(!t&&w.isEmpty(n))return 1/0;var e={computed:1/0,value:1/0};return A(n,function(n,u,i){var a=t?t.call(r,n,u,i):n;e.computed>a&&(e={value:n,computed:a})}),e.value},w.shuffle=function(n){var t,r=0,e=[];return A(n,function(n){t=w.random(r++),e[r-1]=e[t],e[t]=n}),e};var k=function(n){return w.isFunction(n)?n:function(t){return t[n]}};w.sortBy=function(n,t,r){var e=k(t);return w.pluck(w.map(n,function(n,t,u){return{value:n,index:t,criteria:e.call(r,n,t,u)}}).sort(function(n,t){var r=n.criteria,e=t.criteria;if(r!==e){if(r>e||r===void 0)return 1;if(e>r||e===void 0)return-1}return n.index<t.index?-1:1}),"value")};var F=function(n,t,r,e){var u={},i=k(t||w.identity);return A(n,function(t,a){var o=i.call(r,t,a,n);e(u,o,t)}),u};w.groupBy=function(n,t,r){return F(n,t,r,function(n,t,r){(w.has(n,t)?n[t]:n[t]=[]).push(r)})},w.countBy=function(n,t,r){return F(n,t,r,function(n,t){w.has(n,t)||(n[t]=0),n[t]++})},w.sortedIndex=function(n,t,r,e){r=null==r?w.identity:k(r);for(var u=r.call(e,t),i=0,a=n.length;a>i;){var o=i+a>>>1;u>r.call(e,n[o])?i=o+1:a=o}return i},w.toArray=function(n){return n?w.isArray(n)?o.call(n):n.length===+n.length?w.map(n,w.identity):w.values(n):[]},w.size=function(n){return null==n?0:n.length===+n.length?n.length:w.keys(n).length},w.first=w.head=w.take=function(n,t,r){return null==n?void 0:null==t||r?n[0]:o.call(n,0,t)},w.initial=function(n,t,r){return o.call(n,0,n.length-(null==t||r?1:t))},w.last=function(n,t,r){return null==n?void 0:null==t||r?n[n.length-1]:o.call(n,Math.max(n.length-t,0))},w.rest=w.tail=w.drop=function(n,t,r){return o.call(n,null==t||r?1:t)},w.compact=function(n){return w.filter(n,w.identity)};var R=function(n,t,r){return A(n,function(n){w.isArray(n)?t?a.apply(r,n):R(n,t,r):r.push(n)}),r};w.flatten=function(n,t){return R(n,t,[])},w.without=function(n){return w.difference(n,o.call(arguments,1))},w.uniq=w.unique=function(n,t,r,e){w.isFunction(t)&&(e=r,r=t,t=!1);var u=r?w.map(n,r,e):n,i=[],a=[];return A(u,function(r,e){(t?e&&a[a.length-1]===r:w.contains(a,r))||(a.push(r),i.push(n[e]))}),i},w.union=function(){return w.uniq(c.apply(e,arguments))},w.intersection=function(n){var t=o.call(arguments,1);return w.filter(w.uniq(n),function(n){return w.every(t,function(t){return w.indexOf(t,n)>=0})})},w.difference=function(n){var t=c.apply(e,o.call(arguments,1));return w.filter(n,function(n){return!w.contains(t,n)})},w.zip=function(){for(var n=o.call(arguments),t=w.max(w.pluck(n,"length")),r=Array(t),e=0;t>e;e++)r[e]=w.pluck(n,""+e);return r},w.object=function(n,t){if(null==n)return{};for(var r={},e=0,u=n.length;u>e;e++)t?r[n[e]]=t[e]:r[n[e][0]]=n[e][1];return r},w.indexOf=function(n,t,r){if(null==n)return-1;var e=0,u=n.length;if(r){if("number"!=typeof r)return e=w.sortedIndex(n,t),n[e]===t?e:-1;e=0>r?Math.max(0,u+r):r}if(y&&n.indexOf===y)return n.indexOf(t,r);for(;u>e;e++)if(n[e]===t)return e;return-1},w.lastIndexOf=function(n,t,r){if(null==n)return-1;var e=null!=r;if(b&&n.lastIndexOf===b)return e?n.lastIndexOf(t,r):n.lastIndexOf(t);for(var u=e?r:n.length;u--;)if(n[u]===t)return u;return-1},w.range=function(n,t,r){1>=arguments.length&&(t=n||0,n=0),r=arguments[2]||1;for(var e=Math.max(Math.ceil((t-n)/r),0),u=0,i=Array(e);e>u;)i[u++]=n,n+=r;return i},w.bind=function(n,t){if(n.bind===j&&j)return j.apply(n,o.call(arguments,1));var r=o.call(arguments,2);return function(){return n.apply(t,r.concat(o.call(arguments)))}},w.partial=function(n){var t=o.call(arguments,1);return function(){return n.apply(this,t.concat(o.call(arguments)))}},w.bindAll=function(n){var t=o.call(arguments,1);return 0===t.length&&(t=w.functions(n)),A(t,function(t){n[t]=w.bind(n[t],n)}),n},w.memoize=function(n,t){var r={};return t||(t=w.identity),function(){var e=t.apply(this,arguments);return w.has(r,e)?r[e]:r[e]=n.apply(this,arguments)}},w.delay=function(n,t){var r=o.call(arguments,2);return setTimeout(function(){return n.apply(null,r)},t)},w.defer=function(n){return w.delay.apply(w,[n,1].concat(o.call(arguments,1)))},w.throttle=function(n,t){var r,e,u,i,a=0,o=function(){a=new Date,u=null,i=n.apply(r,e)};return function(){var c=new Date,l=t-(c-a);return r=this,e=arguments,0>=l?(clearTimeout(u),u=null,a=c,i=n.apply(r,e)):u||(u=setTimeout(o,l)),i}},w.debounce=function(n,t,r){var e,u;return function(){var i=this,a=arguments,o=function(){e=null,r||(u=n.apply(i,a))},c=r&&!e;return clearTimeout(e),e=setTimeout(o,t),c&&(u=n.apply(i,a)),u}},w.once=function(n){var t,r=!1;return function(){return r?t:(r=!0,t=n.apply(this,arguments),n=null,t)}},w.wrap=function(n,t){return function(){var r=[n];return a.apply(r,arguments),t.apply(this,r)}},w.compose=function(){var n=arguments;return function(){for(var t=arguments,r=n.length-1;r>=0;r--)t=[n[r].apply(this,t)];return t[0]}},w.after=function(n,t){return 0>=n?t():function(){return 1>--n?t.apply(this,arguments):void 0}},w.keys=_||function(n){if(n!==Object(n))throw new TypeError("Invalid object");var t=[];for(var r in n)w.has(n,r)&&(t[t.length]=r);return t},w.values=function(n){var t=[];for(var r in n)w.has(n,r)&&t.push(n[r]);return t},w.pairs=function(n){var t=[];for(var r in n)w.has(n,r)&&t.push([r,n[r]]);return t},w.invert=function(n){var t={};for(var r in n)w.has(n,r)&&(t[n[r]]=r);return t},w.functions=w.methods=function(n){var t=[];for(var r in n)w.isFunction(n[r])&&t.push(r);return t.sort()},w.extend=function(n){return A(o.call(arguments,1),function(t){if(t)for(var r in t)n[r]=t[r]}),n},w.pick=function(n){var t={},r=c.apply(e,o.call(arguments,1));return A(r,function(r){r in n&&(t[r]=n[r])}),t},w.omit=function(n){var t={},r=c.apply(e,o.call(arguments,1));for(var u in n)w.contains(r,u)||(t[u]=n[u]);return t},w.defaults=function(n){return A(o.call(arguments,1),function(t){if(t)for(var r in t)null==n[r]&&(n[r]=t[r])}),n},w.clone=function(n){return w.isObject(n)?w.isArray(n)?n.slice():w.extend({},n):n},w.tap=function(n,t){return t(n),n};var I=function(n,t,r,e){if(n===t)return 0!==n||1/n==1/t;if(null==n||null==t)return n===t;n instanceof w&&(n=n._wrapped),t instanceof w&&(t=t._wrapped);var u=l.call(n);if(u!=l.call(t))return!1;switch(u){case"[object String]":return n==t+"";case"[object Number]":return n!=+n?t!=+t:0==n?1/n==1/t:n==+t;case"[object Date]":case"[object Boolean]":return+n==+t;case"[object RegExp]":return n.source==t.source&&n.global==t.global&&n.multiline==t.multiline&&n.ignoreCase==t.ignoreCase}if("object"!=typeof n||"object"!=typeof t)return!1;for(var i=r.length;i--;)if(r[i]==n)return e[i]==t;r.push(n),e.push(t);var a=0,o=!0;if("[object Array]"==u){if(a=n.length,o=a==t.length)for(;a--&&(o=I(n[a],t[a],r,e)););}else{var c=n.constructor,f=t.constructor;if(c!==f&&!(w.isFunction(c)&&c instanceof c&&w.isFunction(f)&&f instanceof f))return!1;for(var s in n)if(w.has(n,s)&&(a++,!(o=w.has(t,s)&&I(n[s],t[s],r,e))))break;if(o){for(s in t)if(w.has(t,s)&&!a--)break;o=!a}}return r.pop(),e.pop(),o};w.isEqual=function(n,t){return I(n,t,[],[])},w.isEmpty=function(n){if(null==n)return!0;if(w.isArray(n)||w.isString(n))return 0===n.length;for(var t in n)if(w.has(n,t))return!1;return!0},w.isElement=function(n){return!(!n||1!==n.nodeType)},w.isArray=x||function(n){return"[object Array]"==l.call(n)},w.isObject=function(n){return n===Object(n)},A(["Arguments","Function","String","Number","Date","RegExp"],function(n){w["is"+n]=function(t){return l.call(t)=="[object "+n+"]"}}),w.isArguments(arguments)||(w.isArguments=function(n){return!(!n||!w.has(n,"callee"))}),"function"!=typeof/./&&(w.isFunction=function(n){return"function"==typeof n}),w.isFinite=function(n){return isFinite(n)&&!isNaN(parseFloat(n))},w.isNaN=function(n){return w.isNumber(n)&&n!=+n},w.isBoolean=function(n){return n===!0||n===!1||"[object Boolean]"==l.call(n)},w.isNull=function(n){return null===n},w.isUndefined=function(n){return n===void 0},w.has=function(n,t){return f.call(n,t)},w.noConflict=function(){return n._=t,this},w.identity=function(n){return n},w.times=function(n,t,r){for(var e=Array(n),u=0;n>u;u++)e[u]=t.call(r,u);return e},w.random=function(n,t){return null==t&&(t=n,n=0),n+Math.floor(Math.random()*(t-n+1))};var M={escape:{"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","/":"&#x2F;"}};M.unescape=w.invert(M.escape);var S={escape:RegExp("["+w.keys(M.escape).join("")+"]","g"),unescape:RegExp("("+w.keys(M.unescape).join("|")+")","g")};w.each(["escape","unescape"],function(n){w[n]=function(t){return null==t?"":(""+t).replace(S[n],function(t){return M[n][t]})}}),w.result=function(n,t){if(null==n)return null;var r=n[t];return w.isFunction(r)?r.call(n):r},w.mixin=function(n){A(w.functions(n),function(t){var r=w[t]=n[t];w.prototype[t]=function(){var n=[this._wrapped];return a.apply(n,arguments),D.call(this,r.apply(w,n))}})};var N=0;w.uniqueId=function(n){var t=++N+"";return n?n+t:t},w.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};var T=/(.)^/,q={"'":"'","\\":"\\","\r":"r","\n":"n","	":"t","\u2028":"u2028","\u2029":"u2029"},B=/\\|'|\r|\n|\t|\u2028|\u2029/g;w.template=function(n,t,r){var e;r=w.defaults({},r,w.templateSettings);var u=RegExp([(r.escape||T).source,(r.interpolate||T).source,(r.evaluate||T).source].join("|")+"|$","g"),i=0,a="__p+='";n.replace(u,function(t,r,e,u,o){return a+=n.slice(i,o).replace(B,function(n){return"\\"+q[n]}),r&&(a+="'+\n((__t=("+r+"))==null?'':_.escape(__t))+\n'"),e&&(a+="'+\n((__t=("+e+"))==null?'':__t)+\n'"),u&&(a+="';\n"+u+"\n__p+='"),i=o+t.length,t}),a+="';\n",r.variable||(a="with(obj||{}){\n"+a+"}\n"),a="var __t,__p='',__j=Array.prototype.join,"+"print=function(){__p+=__j.call(arguments,'');};\n"+a+"return __p;\n";try{e=Function(r.variable||"obj","_",a)}catch(o){throw o.source=a,o}if(t)return e(t,w);var c=function(n){return e.call(this,n,w)};return c.source="function("+(r.variable||"obj")+"){\n"+a+"}",c},w.chain=function(n){return w(n).chain()};var D=function(n){return this._chain?w(n).chain():n};w.mixin(w),A(["pop","push","reverse","shift","sort","splice","unshift"],function(n){var t=e[n];w.prototype[n]=function(){var r=this._wrapped;return t.apply(r,arguments),"shift"!=n&&"splice"!=n||0!==r.length||delete r[0],D.call(this,r)}}),A(["concat","join","slice"],function(n){var t=e[n];w.prototype[n]=function(){return D.call(this,t.apply(this._wrapped,arguments))}}),w.extend(w.prototype,{chain:function(){return this._chain=!0,this},value:function(){return this._wrapped}})}).call(this);
                    
                    /*
 * jScrollPane - v2.0.0beta11 - 2011-06-11
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2010 Kelvin Luck
 * Dual licensed under the MIT and GPL licenses.
 */
(function(b,a,c){b.fn.jScrollPane=function(e){function d(D,O){var az,Q=this,Y,ak,v,am,T,Z,y,q,aA,aF,av,i,I,h,j,aa,U,aq,X,t,A,ar,af,an,G,l,au,ay,x,aw,aI,f,L,aj=true,P=true,aH=false,k=false,ap=D.clone(false,false).empty(),ac=b.fn.mwheelIntent?"mwheelIntent.jsp":"mousewheel.jsp";aI=D.css("paddingTop")+" "+D.css("paddingRight")+" "+D.css("paddingBottom")+" "+D.css("paddingLeft");f=(parseInt(D.css("paddingLeft"),10)||0)+(parseInt(D.css("paddingRight"),10)||0);function at(aR){var aM,aO,aN,aK,aJ,aQ,aP=false,aL=false;az=aR;if(Y===c){aJ=D.scrollTop();aQ=D.scrollLeft();D.css({overflow:"hidden",padding:0});ak=D.innerWidth()+f;v=D.innerHeight();D.width(ak);Y=b('<div class="jspPane" />').css("padding",aI).append(D.children());am=b('<div class="jspContainer" />').css({width:ak+"px",height:v+"px"}).append(Y).appendTo(D)}else{D.css("width","");aP=az.stickToBottom&&K();aL=az.stickToRight&&B();aK=D.innerWidth()+f!=ak||D.outerHeight()!=v;if(aK){ak=D.innerWidth()+f;v=D.innerHeight();am.css({width:ak+"px",height:v+"px"})}if(!aK&&L==T&&Y.outerHeight()==Z){D.width(ak);return}L=T;Y.css("width","");D.width(ak);am.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()}Y.css("overflow","auto");if(aR.contentWidth){T=aR.contentWidth}else{T=Y[0].scrollWidth}Z=Y[0].scrollHeight;Y.css("overflow","");y=T/ak;q=Z/v;aA=q>1;aF=y>1;if(!(aF||aA)){D.removeClass("jspScrollable");Y.css({top:0,width:am.width()-f});n();E();R();w();ai()}else{D.addClass("jspScrollable");aM=az.maintainPosition&&(I||aa);if(aM){aO=aD();aN=aB()}aG();z();F();if(aM){N(aL?(T-ak):aO,false);M(aP?(Z-v):aN,false)}J();ag();ao();if(az.enableKeyboardNavigation){S()}if(az.clickOnTrack){p()}C();if(az.hijackInternalLinks){m()}}if(az.autoReinitialise&&!aw){aw=setInterval(function(){at(az)},az.autoReinitialiseDelay)}else{if(!az.autoReinitialise&&aw){clearInterval(aw)}}aJ&&D.scrollTop(0)&&M(aJ,false);aQ&&D.scrollLeft(0)&&N(aQ,false);D.trigger("jsp-initialised",[aF||aA])}function aG(){if(aA){am.append(b('<div class="jspVerticalBar" />').append(b('<div class="jspCap jspCapTop" />'),b('<div class="jspTrack" />').append(b('<div class="jspDrag" />').append(b('<div class="jspDragTop" />'),b('<div class="jspDragBottom" />'))),b('<div class="jspCap jspCapBottom" />')));U=am.find(">.jspVerticalBar");aq=U.find(">.jspTrack");av=aq.find(">.jspDrag");if(az.showArrows){ar=b('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp",aE(0,-1)).bind("click.jsp",aC);af=b('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp",aE(0,1)).bind("click.jsp",aC);if(az.arrowScrollOnHover){ar.bind("mouseover.jsp",aE(0,-1,ar));af.bind("mouseover.jsp",aE(0,1,af))}al(aq,az.verticalArrowPositions,ar,af)}t=v;am.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function(){t-=b(this).outerHeight()});av.hover(function(){av.addClass("jspHover")},function(){av.removeClass("jspHover")}).bind("mousedown.jsp",function(aJ){b("html").bind("dragstart.jsp selectstart.jsp",aC);av.addClass("jspActive");var s=aJ.pageY-av.position().top;b("html").bind("mousemove.jsp",function(aK){V(aK.pageY-s,false)}).bind("mouseup.jsp mouseleave.jsp",ax);return false});o()}}function o(){aq.height(t+"px");I=0;X=az.verticalGutter+aq.outerWidth();Y.width(ak-X-f);try{if(U.position().left===0){Y.css("margin-left",X+"px")}}catch(s){}}function z(){if(aF){am.append(b('<div class="jspHorizontalBar" />').append(b('<div class="jspCap jspCapLeft" />'),b('<div class="jspTrack" />').append(b('<div class="jspDrag" />').append(b('<div class="jspDragLeft" />'),b('<div class="jspDragRight" />'))),b('<div class="jspCap jspCapRight" />')));an=am.find(">.jspHorizontalBar");G=an.find(">.jspTrack");h=G.find(">.jspDrag");if(az.showArrows){ay=b('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp",aE(-1,0)).bind("click.jsp",aC);x=b('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp",aE(1,0)).bind("click.jsp",aC);
if(az.arrowScrollOnHover){ay.bind("mouseover.jsp",aE(-1,0,ay));x.bind("mouseover.jsp",aE(1,0,x))}al(G,az.horizontalArrowPositions,ay,x)}h.hover(function(){h.addClass("jspHover")},function(){h.removeClass("jspHover")}).bind("mousedown.jsp",function(aJ){b("html").bind("dragstart.jsp selectstart.jsp",aC);h.addClass("jspActive");var s=aJ.pageX-h.position().left;b("html").bind("mousemove.jsp",function(aK){W(aK.pageX-s,false)}).bind("mouseup.jsp mouseleave.jsp",ax);return false});l=am.innerWidth();ah()}}function ah(){am.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function(){l-=b(this).outerWidth()});G.width(l+"px");aa=0}function F(){if(aF&&aA){var aJ=G.outerHeight(),s=aq.outerWidth();t-=aJ;b(an).find(">.jspCap:visible,>.jspArrow").each(function(){l+=b(this).outerWidth()});l-=s;v-=s;ak-=aJ;G.parent().append(b('<div class="jspCorner" />').css("width",aJ+"px"));o();ah()}if(aF){Y.width((am.outerWidth()-f)+"px")}Z=Y.outerHeight();q=Z/v;if(aF){au=Math.ceil(1/y*l);if(au>az.horizontalDragMaxWidth){au=az.horizontalDragMaxWidth}else{if(au<az.horizontalDragMinWidth){au=az.horizontalDragMinWidth}}h.width(au+"px");j=l-au;ae(aa)}if(aA){A=Math.ceil(1/q*t);if(A>az.verticalDragMaxHeight){A=az.verticalDragMaxHeight}else{if(A<az.verticalDragMinHeight){A=az.verticalDragMinHeight}}av.height(A+"px");i=t-A;ad(I)}}function al(aK,aM,aJ,s){var aO="before",aL="after",aN;if(aM=="os"){aM=/Mac/.test(navigator.platform)?"after":"split"}if(aM==aO){aL=aM}else{if(aM==aL){aO=aM;aN=aJ;aJ=s;s=aN}}aK[aO](aJ)[aL](s)}function aE(aJ,s,aK){return function(){H(aJ,s,this,aK);this.blur();return false}}function H(aM,aL,aP,aO){aP=b(aP).addClass("jspActive");var aN,aK,aJ=true,s=function(){if(aM!==0){Q.scrollByX(aM*az.arrowButtonSpeed)}if(aL!==0){Q.scrollByY(aL*az.arrowButtonSpeed)}aK=setTimeout(s,aJ?az.initialDelay:az.arrowRepeatFreq);aJ=false};s();aN=aO?"mouseout.jsp":"mouseup.jsp";aO=aO||b("html");aO.bind(aN,function(){aP.removeClass("jspActive");aK&&clearTimeout(aK);aK=null;aO.unbind(aN)})}function p(){w();if(aA){aq.bind("mousedown.jsp",function(aO){if(aO.originalTarget===c||aO.originalTarget==aO.currentTarget){var aM=b(this),aP=aM.offset(),aN=aO.pageY-aP.top-I,aK,aJ=true,s=function(){var aS=aM.offset(),aT=aO.pageY-aS.top-A/2,aQ=v*az.scrollPagePercent,aR=i*aQ/(Z-v);if(aN<0){if(I-aR>aT){Q.scrollByY(-aQ)}else{V(aT)}}else{if(aN>0){if(I+aR<aT){Q.scrollByY(aQ)}else{V(aT)}}else{aL();return}}aK=setTimeout(s,aJ?az.initialDelay:az.trackClickRepeatFreq);aJ=false},aL=function(){aK&&clearTimeout(aK);aK=null;b(document).unbind("mouseup.jsp",aL)};s();b(document).bind("mouseup.jsp",aL);return false}})}if(aF){G.bind("mousedown.jsp",function(aO){if(aO.originalTarget===c||aO.originalTarget==aO.currentTarget){var aM=b(this),aP=aM.offset(),aN=aO.pageX-aP.left-aa,aK,aJ=true,s=function(){var aS=aM.offset(),aT=aO.pageX-aS.left-au/2,aQ=ak*az.scrollPagePercent,aR=j*aQ/(T-ak);if(aN<0){if(aa-aR>aT){Q.scrollByX(-aQ)}else{W(aT)}}else{if(aN>0){if(aa+aR<aT){Q.scrollByX(aQ)}else{W(aT)}}else{aL();return}}aK=setTimeout(s,aJ?az.initialDelay:az.trackClickRepeatFreq);aJ=false},aL=function(){aK&&clearTimeout(aK);aK=null;b(document).unbind("mouseup.jsp",aL)};s();b(document).bind("mouseup.jsp",aL);return false}})}}function w(){if(G){G.unbind("mousedown.jsp")}if(aq){aq.unbind("mousedown.jsp")}}function ax(){b("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp");if(av){av.removeClass("jspActive")}if(h){h.removeClass("jspActive")}}function V(s,aJ){if(!aA){return}if(s<0){s=0}else{if(s>i){s=i}}if(aJ===c){aJ=az.animateScroll}if(aJ){Q.animate(av,"top",s,ad)}else{av.css("top",s);ad(s)}}function ad(aJ){if(aJ===c){aJ=av.position().top}am.scrollTop(0);I=aJ;var aM=I===0,aK=I==i,aL=aJ/i,s=-aL*(Z-v);if(aj!=aM||aH!=aK){aj=aM;aH=aK;D.trigger("jsp-arrow-change",[aj,aH,P,k])}u(aM,aK);Y.css("top",s);D.trigger("jsp-scroll-y",[-s,aM,aK]).trigger("scroll")}function W(aJ,s){if(!aF){return}if(aJ<0){aJ=0}else{if(aJ>j){aJ=j}}if(s===c){s=az.animateScroll}if(s){Q.animate(h,"left",aJ,ae)
}else{h.css("left",aJ);ae(aJ)}}function ae(aJ){if(aJ===c){aJ=h.position().left}am.scrollTop(0);aa=aJ;var aM=aa===0,aL=aa==j,aK=aJ/j,s=-aK*(T-ak);if(P!=aM||k!=aL){P=aM;k=aL;D.trigger("jsp-arrow-change",[aj,aH,P,k])}r(aM,aL);Y.css("left",s);D.trigger("jsp-scroll-x",[-s,aM,aL]).trigger("scroll")}function u(aJ,s){if(az.showArrows){ar[aJ?"addClass":"removeClass"]("jspDisabled");af[s?"addClass":"removeClass"]("jspDisabled")}}function r(aJ,s){if(az.showArrows){ay[aJ?"addClass":"removeClass"]("jspDisabled");x[s?"addClass":"removeClass"]("jspDisabled")}}function M(s,aJ){var aK=s/(Z-v);V(aK*i,aJ)}function N(aJ,s){var aK=aJ/(T-ak);W(aK*j,s)}function ab(aW,aR,aK){var aO,aL,aM,s=0,aV=0,aJ,aQ,aP,aT,aS,aU;try{aO=b(aW)}catch(aN){return}aL=aO.outerHeight();aM=aO.outerWidth();am.scrollTop(0);am.scrollLeft(0);while(!aO.is(".jspPane")){s+=aO.position().top;aV+=aO.position().left;aO=aO.offsetParent();if(/^body|html$/i.test(aO[0].nodeName)){return}}aJ=aB();aP=aJ+v;if(s<aJ||aR){aS=s-az.verticalGutter}else{if(s+aL>aP){aS=s-v+aL+az.verticalGutter}}if(aS){M(aS,aK)}aQ=aD();aT=aQ+ak;if(aV<aQ||aR){aU=aV-az.horizontalGutter}else{if(aV+aM>aT){aU=aV-ak+aM+az.horizontalGutter}}if(aU){N(aU,aK)}}function aD(){return -Y.position().left}function aB(){return -Y.position().top}function K(){var s=Z-v;return(s>20)&&(s-aB()<10)}function B(){var s=T-ak;return(s>20)&&(s-aD()<10)}function ag(){am.unbind(ac).bind(ac,function(aM,aN,aL,aJ){var aK=aa,s=I;Q.scrollBy(aL*az.mouseWheelSpeed,-aJ*az.mouseWheelSpeed,false);return aK==aa&&s==I})}function n(){am.unbind(ac)}function aC(){return false}function J(){Y.find(":input,a").unbind("focus.jsp").bind("focus.jsp",function(s){ab(s.target,false)})}function E(){Y.find(":input,a").unbind("focus.jsp")}function S(){var s,aJ,aL=[];aF&&aL.push(an[0]);aA&&aL.push(U[0]);Y.focus(function(){D.focus()});D.attr("tabindex",0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp",function(aO){if(aO.target!==this&&!(aL.length&&b(aO.target).closest(aL).length)){return}var aN=aa,aM=I;switch(aO.keyCode){case 40:case 38:case 34:case 32:case 33:case 39:case 37:s=aO.keyCode;aK();break;case 35:M(Z-v);s=null;break;case 36:M(0);s=null;break}aJ=aO.keyCode==s&&aN!=aa||aM!=I;return !aJ}).bind("keypress.jsp",function(aM){if(aM.keyCode==s){aK()}return !aJ});if(az.hideFocus){D.css("outline","none");if("hideFocus" in am[0]){D.attr("hideFocus",true)}}else{D.css("outline","");if("hideFocus" in am[0]){D.attr("hideFocus",false)}}function aK(){var aN=aa,aM=I;switch(s){case 40:Q.scrollByY(az.keyboardSpeed,false);break;case 38:Q.scrollByY(-az.keyboardSpeed,false);break;case 34:case 32:Q.scrollByY(v*az.scrollPagePercent,false);break;case 33:Q.scrollByY(-v*az.scrollPagePercent,false);break;case 39:Q.scrollByX(az.keyboardSpeed,false);break;case 37:Q.scrollByX(-az.keyboardSpeed,false);break}aJ=aN!=aa||aM!=I;return aJ}}function R(){D.attr("tabindex","-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp")}function C(){if(location.hash&&location.hash.length>1){var aL,aJ,aK=escape(location.hash);try{aL=b(aK)}catch(s){return}if(aL.length&&Y.find(aK)){if(am.scrollTop()===0){aJ=setInterval(function(){if(am.scrollTop()>0){ab(aK,true);b(document).scrollTop(am.position().top);clearInterval(aJ)}},50)}else{ab(aK,true);b(document).scrollTop(am.position().top)}}}}function ai(){b("a.jspHijack").unbind("click.jsp-hijack").removeClass("jspHijack")}function m(){ai();b("a[href^=#]").addClass("jspHijack").bind("click.jsp-hijack",function(){var s=this.href.split("#"),aJ;if(s.length>1){aJ=s[1];if(aJ.length>0&&Y.find("#"+aJ).length>0){ab("#"+aJ,true);return false}}})}function ao(){var aK,aJ,aM,aL,aN,s=false;am.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp",function(aO){var aP=aO.originalEvent.touches[0];aK=aD();aJ=aB();aM=aP.pageX;aL=aP.pageY;aN=false;s=true}).bind("touchmove.jsp",function(aR){if(!s){return}var aQ=aR.originalEvent.touches[0],aP=aa,aO=I;Q.scrollTo(aK+aM-aQ.pageX,aJ+aL-aQ.pageY);aN=aN||Math.abs(aM-aQ.pageX)>5||Math.abs(aL-aQ.pageY)>5;
return aP==aa&&aO==I}).bind("touchend.jsp",function(aO){s=false}).bind("click.jsp-touchclick",function(aO){if(aN){aN=false;return false}})}function g(){var s=aB(),aJ=aD();D.removeClass("jspScrollable").unbind(".jsp");D.replaceWith(ap.append(Y.children()));ap.scrollTop(s);ap.scrollLeft(aJ)}b.extend(Q,{reinitialise:function(aJ){aJ=b.extend({},az,aJ);at(aJ)},scrollToElement:function(aK,aJ,s){ab(aK,aJ,s)},scrollTo:function(aK,s,aJ){N(aK,aJ);M(s,aJ)},scrollToX:function(aJ,s){N(aJ,s)},scrollToY:function(s,aJ){M(s,aJ)},scrollToPercentX:function(aJ,s){N(aJ*(T-ak),s)},scrollToPercentY:function(aJ,s){M(aJ*(Z-v),s)},scrollBy:function(aJ,s,aK){Q.scrollByX(aJ,aK);Q.scrollByY(s,aK)},scrollByX:function(s,aK){var aJ=aD()+Math[s<0?"floor":"ceil"](s),aL=aJ/(T-ak);W(aL*j,aK)},scrollByY:function(s,aK){var aJ=aB()+Math[s<0?"floor":"ceil"](s),aL=aJ/(Z-v);V(aL*i,aK)},positionDragX:function(s,aJ){W(s,aJ)},positionDragY:function(aJ,s){V(aJ,s)},animate:function(aJ,aM,s,aL){var aK={};aK[aM]=s;aJ.animate(aK,{duration:az.animateDuration,ease:az.animateEase,queue:false,step:aL})},getContentPositionX:function(){return aD()},getContentPositionY:function(){return aB()},getContentWidth:function(){return T},getContentHeight:function(){return Z},getPercentScrolledX:function(){return aD()/(T-ak)},getPercentScrolledY:function(){return aB()/(Z-v)},getIsScrollableH:function(){return aF},getIsScrollableV:function(){return aA},getContentPane:function(){return Y},scrollToBottom:function(s){V(i,s)},hijackInternalLinks:function(){m()},destroy:function(){g()}});at(O)}e=b.extend({},b.fn.jScrollPane.defaults,e);b.each(["mouseWheelSpeed","arrowButtonSpeed","trackClickSpeed","keyboardSpeed"],function(){e[this]=e[this]||e.speed});return this.each(function(){var f=b(this),g=f.data("jsp");if(g){g.reinitialise(e)}else{g=new d(f,e);f.data("jsp",g)}})};b.fn.jScrollPane.defaults={showArrows:false,maintainPosition:true,stickToBottom:false,stickToRight:false,clickOnTrack:true,autoReinitialise:false,autoReinitialiseDelay:500,verticalDragMinHeight:0,verticalDragMaxHeight:99999,horizontalDragMinWidth:0,horizontalDragMaxWidth:99999,contentWidth:c,animateScroll:false,animateDuration:300,animateEase:"linear",hijackInternalLinks:false,verticalGutter:4,horizontalGutter:4,mouseWheelSpeed:0,arrowButtonSpeed:0,arrowRepeatFreq:50,arrowScrollOnHover:false,trackClickSpeed:0,trackClickRepeatFreq:70,verticalArrowPositions:"split",horizontalArrowPositions:"split",enableKeyboardNavigation:true,hideFocus:false,keyboardSpeed:0,initialDelay:300,speed:30,scrollPagePercent:0.8}})(jQuery,this);
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
(function(g){var q={vertical:!1,rtl:!1,start:1,offset:1,size:null,scroll:3,visible:null,animation:"normal",easing:"swing",auto:0,wrap:null,initCallback:null,setupCallback:null,reloadCallback:null,itemLoadCallback:null,itemFirstInCallback:null,itemFirstOutCallback:null,itemLastInCallback:null,itemLastOutCallback:null,itemVisibleInCallback:null,itemVisibleOutCallback:null,animationStepCallback:null,buttonNextHTML:"<div></div>",buttonPrevHTML:"<div></div>",buttonNextEvent:"click",buttonPrevEvent:"click", buttonNextCallback:null,buttonPrevCallback:null,itemFallbackDimension:null},m=!1;g(window).bind("load.jcarousel",function(){m=!0});g.jcarousel=function(a,c){this.options=g.extend({},q,c||{});this.autoStopped=this.locked=!1;this.buttonPrevState=this.buttonNextState=this.buttonPrev=this.buttonNext=this.list=this.clip=this.container=null;if(!c||c.rtl===void 0)this.options.rtl=(g(a).attr("dir")||g("html").attr("dir")||"").toLowerCase()=="rtl";this.wh=!this.options.vertical?"width":"height";this.lt=!this.options.vertical? this.options.rtl?"right":"left":"top";for(var b="",d=a.className.split(" "),f=0;f<d.length;f++)if(d[f].indexOf("jcarousel-skin")!=-1){g(a).removeClass(d[f]);b=d[f];break}a.nodeName.toUpperCase()=="UL"||a.nodeName.toUpperCase()=="OL"?(this.list=g(a),this.clip=this.list.parents(".jcarousel-clip"),this.container=this.list.parents(".jcarousel-container")):(this.container=g(a),this.list=this.container.find("ul,ol").eq(0),this.clip=this.container.find(".jcarousel-clip"));if(this.clip.size()===0)this.clip= this.list.wrap("<div></div>").parent();if(this.container.size()===0)this.container=this.clip.wrap("<div></div>").parent();b!==""&&this.container.parent()[0].className.indexOf("jcarousel-skin")==-1&&this.container.wrap('<div class=" '+b+'"></div>');this.buttonPrev=g(".jcarousel-prev",this.container);if(this.buttonPrev.size()===0&&this.options.buttonPrevHTML!==null)this.buttonPrev=g(this.options.buttonPrevHTML).appendTo(this.container);this.buttonPrev.addClass(this.className("jcarousel-prev"));this.buttonNext= g(".jcarousel-next",this.container);if(this.buttonNext.size()===0&&this.options.buttonNextHTML!==null)this.buttonNext=g(this.options.buttonNextHTML).appendTo(this.container);this.buttonNext.addClass(this.className("jcarousel-next"));this.clip.addClass(this.className("jcarousel-clip")).css({position:"relative"});this.list.addClass(this.className("jcarousel-list")).css({overflow:"hidden",position:"relative",top:0,margin:0,padding:0}).css(this.options.rtl?"right":"left",0);this.container.addClass(this.className("jcarousel-container")).css({position:"relative"}); !this.options.vertical&&this.options.rtl&&this.container.addClass("jcarousel-direction-rtl").attr("dir","rtl");var j=this.options.visible!==null?Math.ceil(this.clipping()/this.options.visible):null,b=this.list.children("li"),e=this;if(b.size()>0){var h=0,i=this.options.offset;b.each(function(){e.format(this,i++);h+=e.dimension(this,j)});this.list.css(this.wh,h+100+"px");if(!c||c.size===void 0)this.options.size=b.size()}this.container.css("display","block");this.buttonNext.css("display","block");this.buttonPrev.css("display", "block");this.funcNext=function(){e.next()};this.funcPrev=function(){e.prev()};this.funcResize=function(){e.resizeTimer&&clearTimeout(e.resizeTimer);e.resizeTimer=setTimeout(function(){e.reload()},100)};this.options.initCallback!==null&&this.options.initCallback(this,"init");!m&&g.browser.safari?(this.buttons(!1,!1),g(window).bind("load.jcarousel",function(){e.setup()})):this.setup()};var f=g.jcarousel;f.fn=f.prototype={jcarousel:"0.2.8"};f.fn.extend=f.extend=g.extend;f.fn.extend({setup:function(){this.prevLast= this.prevFirst=this.last=this.first=null;this.animating=!1;this.tail=this.resizeTimer=this.timer=null;this.inTail=!1;if(!this.locked){this.list.css(this.lt,this.pos(this.options.offset)+"px");var a=this.pos(this.options.start,!0);this.prevFirst=this.prevLast=null;this.animate(a,!1);g(window).unbind("resize.jcarousel",this.funcResize).bind("resize.jcarousel",this.funcResize);this.options.setupCallback!==null&&this.options.setupCallback(this)}},reset:function(){this.list.empty();this.list.css(this.lt, "0px");this.list.css(this.wh,"10px");this.options.initCallback!==null&&this.options.initCallback(this,"reset");this.setup()},reload:function(){this.tail!==null&&this.inTail&&this.list.css(this.lt,f.intval(this.list.css(this.lt))+this.tail);this.tail=null;this.inTail=!1;this.options.reloadCallback!==null&&this.options.reloadCallback(this);if(this.options.visible!==null){var a=this,c=Math.ceil(this.clipping()/this.options.visible),b=0,d=0;this.list.children("li").each(function(f){b+=a.dimension(this, c);f+1<a.first&&(d=b)});this.list.css(this.wh,b+"px");this.list.css(this.lt,-d+"px")}this.scroll(this.first,!1)},lock:function(){this.locked=!0;this.buttons()},unlock:function(){this.locked=!1;this.buttons()},size:function(a){if(a!==void 0)this.options.size=a,this.locked||this.buttons();return this.options.size},has:function(a,c){if(c===void 0||!c)c=a;if(this.options.size!==null&&c>this.options.size)c=this.options.size;for(var b=a;b<=c;b++){var d=this.get(b);if(!d.length||d.hasClass("jcarousel-item-placeholder"))return!1}return!0}, get:function(a){return g(">.jcarousel-item-"+a,this.list)},add:function(a,c){var b=this.get(a),d=0,p=g(c);if(b.length===0)for(var j,e=f.intval(a),b=this.create(a);;){if(j=this.get(--e),e<=0||j.length){e<=0?this.list.prepend(b):j.after(b);break}}else d=this.dimension(b);p.get(0).nodeName.toUpperCase()=="LI"?(b.replaceWith(p),b=p):b.empty().append(c);this.format(b.removeClass(this.className("jcarousel-item-placeholder")),a);p=this.options.visible!==null?Math.ceil(this.clipping()/this.options.visible): null;d=this.dimension(b,p)-d;a>0&&a<this.first&&this.list.css(this.lt,f.intval(this.list.css(this.lt))-d+"px");this.list.css(this.wh,f.intval(this.list.css(this.wh))+d+"px");return b},remove:function(a){var c=this.get(a);if(c.length&&!(a>=this.first&&a<=this.last)){var b=this.dimension(c);a<this.first&&this.list.css(this.lt,f.intval(this.list.css(this.lt))+b+"px");c.remove();this.list.css(this.wh,f.intval(this.list.css(this.wh))-b+"px")}},next:function(){this.tail!==null&&!this.inTail?this.scrollTail(!1): this.scroll((this.options.wrap=="both"||this.options.wrap=="last")&&this.options.size!==null&&this.last==this.options.size?1:this.first+this.options.scroll)},prev:function(){this.tail!==null&&this.inTail?this.scrollTail(!0):this.scroll((this.options.wrap=="both"||this.options.wrap=="first")&&this.options.size!==null&&this.first==1?this.options.size:this.first-this.options.scroll)},scrollTail:function(a){if(!this.locked&&!this.animating&&this.tail){this.pauseAuto();var c=f.intval(this.list.css(this.lt)), c=!a?c-this.tail:c+this.tail;this.inTail=!a;this.prevFirst=this.first;this.prevLast=this.last;this.animate(c)}},scroll:function(a,c){!this.locked&&!this.animating&&(this.pauseAuto(),this.animate(this.pos(a),c))},pos:function(a,c){var b=f.intval(this.list.css(this.lt));if(this.locked||this.animating)return b;this.options.wrap!="circular"&&(a=a<1?1:this.options.size&&a>this.options.size?this.options.size:a);for(var d=this.first>a,g=this.options.wrap!="circular"&&this.first<=1?1:this.first,j=d?this.get(g): this.get(this.last),e=d?g:g-1,h=null,i=0,k=!1,l=0;d?--e>=a:++e<a;){h=this.get(e);k=!h.length;if(h.length===0&&(h=this.create(e).addClass(this.className("jcarousel-item-placeholder")),j[d?"before":"after"](h),this.first!==null&&this.options.wrap=="circular"&&this.options.size!==null&&(e<=0||e>this.options.size)))j=this.get(this.index(e)),j.length&&(h=this.add(e,j.clone(!0)));j=h;l=this.dimension(h);k&&(i+=l);if(this.first!==null&&(this.options.wrap=="circular"||e>=1&&(this.options.size===null||e<= this.options.size)))b=d?b+l:b-l}for(var g=this.clipping(),m=[],o=0,n=0,j=this.get(a-1),e=a;++o;){h=this.get(e);k=!h.length;if(h.length===0){h=this.create(e).addClass(this.className("jcarousel-item-placeholder"));if(j.length===0)this.list.prepend(h);else j[d?"before":"after"](h);if(this.first!==null&&this.options.wrap=="circular"&&this.options.size!==null&&(e<=0||e>this.options.size))j=this.get(this.index(e)),j.length&&(h=this.add(e,j.clone(!0)))}j=h;l=this.dimension(h);if(l===0)throw Error("jCarousel: No width/height set for items. This will cause an infinite loop. Aborting..."); this.options.wrap!="circular"&&this.options.size!==null&&e>this.options.size?m.push(h):k&&(i+=l);n+=l;if(n>=g)break;e++}for(h=0;h<m.length;h++)m[h].remove();i>0&&(this.list.css(this.wh,this.dimension(this.list)+i+"px"),d&&(b-=i,this.list.css(this.lt,f.intval(this.list.css(this.lt))-i+"px")));i=a+o-1;if(this.options.wrap!="circular"&&this.options.size&&i>this.options.size)i=this.options.size;if(e>i){o=0;e=i;for(n=0;++o;){h=this.get(e--);if(!h.length)break;n+=this.dimension(h);if(n>=g)break}}e=i-o+ 1;this.options.wrap!="circular"&&e<1&&(e=1);if(this.inTail&&d)b+=this.tail,this.inTail=!1;this.tail=null;if(this.options.wrap!="circular"&&i==this.options.size&&i-o+1>=1&&(d=f.intval(this.get(i).css(!this.options.vertical?"marginRight":"marginBottom")),n-d>g))this.tail=n-g-d;if(c&&a===this.options.size&&this.tail)b-=this.tail,this.inTail=!0;for(;a-- >e;)b+=this.dimension(this.get(a));this.prevFirst=this.first;this.prevLast=this.last;this.first=e;this.last=i;return b},animate:function(a,c){if(!this.locked&& !this.animating){this.animating=!0;var b=this,d=function(){b.animating=!1;a===0&&b.list.css(b.lt,0);!b.autoStopped&&(b.options.wrap=="circular"||b.options.wrap=="both"||b.options.wrap=="last"||b.options.size===null||b.last<b.options.size||b.last==b.options.size&&b.tail!==null&&!b.inTail)&&b.startAuto();b.buttons();b.notify("onAfterAnimation");if(b.options.wrap=="circular"&&b.options.size!==null)for(var c=b.prevFirst;c<=b.prevLast;c++)c!==null&&!(c>=b.first&&c<=b.last)&&(c<1||c>b.options.size)&&b.remove(c)}; this.notify("onBeforeAnimation");if(!this.options.animation||c===!1)this.list.css(this.lt,a+"px"),d();else{var f=!this.options.vertical?this.options.rtl?{right:a}:{left:a}:{top:a},d={duration:this.options.animation,easing:this.options.easing,complete:d};if(g.isFunction(this.options.animationStepCallback))d.step=this.options.animationStepCallback;this.list.animate(f,d)}}},startAuto:function(a){if(a!==void 0)this.options.auto=a;if(this.options.auto===0)return this.stopAuto();if(this.timer===null){this.autoStopped= !1;var c=this;this.timer=window.setTimeout(function(){c.next()},this.options.auto*1E3)}},stopAuto:function(){this.pauseAuto();this.autoStopped=!0},pauseAuto:function(){if(this.timer!==null)window.clearTimeout(this.timer),this.timer=null},buttons:function(a,c){if(a==null&&(a=!this.locked&&this.options.size!==0&&(this.options.wrap&&this.options.wrap!="first"||this.options.size===null||this.last<this.options.size),!this.locked&&(!this.options.wrap||this.options.wrap=="first")&&this.options.size!==null&& this.last>=this.options.size))a=this.tail!==null&&!this.inTail;if(c==null&&(c=!this.locked&&this.options.size!==0&&(this.options.wrap&&this.options.wrap!="last"||this.first>1),!this.locked&&(!this.options.wrap||this.options.wrap=="last")&&this.options.size!==null&&this.first==1))c=this.tail!==null&&this.inTail;var b=this;this.buttonNext.size()>0?(this.buttonNext.unbind(this.options.buttonNextEvent+".jcarousel",this.funcNext),a&&this.buttonNext.bind(this.options.buttonNextEvent+".jcarousel",this.funcNext), this.buttonNext[a?"removeClass":"addClass"](this.className("jcarousel-next-disabled")).attr("disabled",a?!1:!0),this.options.buttonNextCallback!==null&&this.buttonNext.data("jcarouselstate")!=a&&this.buttonNext.each(function(){b.options.buttonNextCallback(b,this,a)}).data("jcarouselstate",a)):this.options.buttonNextCallback!==null&&this.buttonNextState!=a&&this.options.buttonNextCallback(b,null,a);this.buttonPrev.size()>0?(this.buttonPrev.unbind(this.options.buttonPrevEvent+".jcarousel",this.funcPrev), c&&this.buttonPrev.bind(this.options.buttonPrevEvent+".jcarousel",this.funcPrev),this.buttonPrev[c?"removeClass":"addClass"](this.className("jcarousel-prev-disabled")).attr("disabled",c?!1:!0),this.options.buttonPrevCallback!==null&&this.buttonPrev.data("jcarouselstate")!=c&&this.buttonPrev.each(function(){b.options.buttonPrevCallback(b,this,c)}).data("jcarouselstate",c)):this.options.buttonPrevCallback!==null&&this.buttonPrevState!=c&&this.options.buttonPrevCallback(b,null,c);this.buttonNextState= a;this.buttonPrevState=c},notify:function(a){var c=this.prevFirst===null?"init":this.prevFirst<this.first?"next":"prev";this.callback("itemLoadCallback",a,c);this.prevFirst!==this.first&&(this.callback("itemFirstInCallback",a,c,this.first),this.callback("itemFirstOutCallback",a,c,this.prevFirst));this.prevLast!==this.last&&(this.callback("itemLastInCallback",a,c,this.last),this.callback("itemLastOutCallback",a,c,this.prevLast));this.callback("itemVisibleInCallback",a,c,this.first,this.last,this.prevFirst, this.prevLast);this.callback("itemVisibleOutCallback",a,c,this.prevFirst,this.prevLast,this.first,this.last)},callback:function(a,c,b,d,f,j,e){if(!(this.options[a]==null||typeof this.options[a]!="object"&&c!="onAfterAnimation")){var h=typeof this.options[a]=="object"?this.options[a][c]:this.options[a];if(g.isFunction(h)){var i=this;if(d===void 0)h(i,b,c);else if(f===void 0)this.get(d).each(function(){h(i,this,d,b,c)});else for(var a=function(a){i.get(a).each(function(){h(i,this,a,b,c)})},k=d;k<=f;k++)k!== null&&!(k>=j&&k<=e)&&a(k)}}},create:function(a){return this.format("<li></li>",a)},format:function(a,c){for(var a=g(a),b=a.get(0).className.split(" "),d=0;d<b.length;d++)b[d].indexOf("jcarousel-")!=-1&&a.removeClass(b[d]);a.addClass(this.className("jcarousel-item")).addClass(this.className("jcarousel-item-"+c)).css({"float":this.options.rtl?"right":"left","list-style":"none"}).attr("jcarouselindex",c);return a},className:function(a){return a+" "+a+(!this.options.vertical?"-horizontal":"-vertical")}, dimension:function(a,c){var b=g(a);if(c==null)return!this.options.vertical?b.outerWidth(!0)||f.intval(this.options.itemFallbackDimension):b.outerHeight(!0)||f.intval(this.options.itemFallbackDimension);else{var d=!this.options.vertical?c-f.intval(b.css("marginLeft"))-f.intval(b.css("marginRight")):c-f.intval(b.css("marginTop"))-f.intval(b.css("marginBottom"));g(b).css(this.wh,d+"px");return this.dimension(b)}},clipping:function(){return!this.options.vertical?this.clip[0].offsetWidth-f.intval(this.clip.css("borderLeftWidth"))- f.intval(this.clip.css("borderRightWidth")):this.clip[0].offsetHeight-f.intval(this.clip.css("borderTopWidth"))-f.intval(this.clip.css("borderBottomWidth"))},index:function(a,c){if(c==null)c=this.options.size;return Math.round(((a-1)/c-Math.floor((a-1)/c))*c)+1}});f.extend({defaults:function(a){return g.extend(q,a||{})},intval:function(a){a=parseInt(a,10);return isNaN(a)?0:a},windowLoaded:function(){m=!0}});g.fn.jcarousel=function(a){if(typeof a=="string"){var c=g(this).data("jcarousel"),b=Array.prototype.slice.call(arguments, 1);return c[a].apply(c,b)}else return this.each(function(){var b=g(this).data("jcarousel");b?(a&&g.extend(b.options,a),b.reload()):g(this).data("jcarousel",new f(this,a))})}})(jQuery);
/*! Copyright (c) 2013 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.1.3
 *
 * Requires: 1.2.2+
 */
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof exports==="object"){module.exports=a}else{a(jQuery)}}}(function(e){var d=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"];var g="onwheel" in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"];var f,a;if(e.event.fixHooks){for(var b=d.length;b;){e.event.fixHooks[d[--b]]=e.event.mouseHooks}}e.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var h=g.length;h;){this.addEventListener(g[--h],c,false)}}else{this.onmousewheel=c}},teardown:function(){if(this.removeEventListener){for(var h=g.length;h;){this.removeEventListener(g[--h],c,false)}}else{this.onmousewheel=null}}};e.fn.extend({mousewheel:function(h){return h?this.bind("mousewheel",h):this.trigger("mousewheel")},unmousewheel:function(h){return this.unbind("mousewheel",h)}});function c(h){var i=h||window.event,n=[].slice.call(arguments,1),p=0,k=0,j=0,m=0,l=0,o;h=e.event.fix(i);h.type="mousewheel";if(i.wheelDelta){p=i.wheelDelta}if(i.detail){p=i.detail*-1}if(i.deltaY){j=i.deltaY*-1;p=j}if(i.deltaX){k=i.deltaX;p=k*-1}if(i.wheelDeltaY!==undefined){j=i.wheelDeltaY}if(i.wheelDeltaX!==undefined){k=i.wheelDeltaX*-1}m=Math.abs(p);if(!f||m<f){f=m}l=Math.max(Math.abs(j),Math.abs(k));if(!a||l<a){a=l}o=p>0?"floor":"ceil";p=Math[o](p/f);k=Math[o](k/a);j=Math[o](j/a);n.unshift(h,p,k,j);return(e.event.dispatch||e.event.handle).apply(this,n)}}));

/*
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2013 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.8.4
 *
 */
(function(a,b,c,d){var e=a(b);a.fn.lazyload=function(c){function i(){var b=0;f.each(function(){var c=a(this);if(h.skip_invisible&&!c.is(":visible"))return;if(!a.abovethetop(this,h)&&!a.leftofbegin(this,h))if(!a.belowthefold(this,h)&&!a.rightoffold(this,h))c.trigger("appear"),b=0;else if(++b>h.failure_limit)return!1})}var f=this,g,h={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return c&&(d!==c.failurelimit&&(c.failure_limit=c.failurelimit,delete c.failurelimit),d!==c.effectspeed&&(c.effect_speed=c.effectspeed,delete c.effectspeed),a.extend(h,c)),g=h.container===d||h.container===b?e:a(h.container),0===h.event.indexOf("scroll")&&g.bind(h.event,function(a){return i()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,c.one("appear",function(){if(!this.loaded){if(h.appear){var d=f.length;h.appear.call(b,d,h)}a("<img />").bind("load",function(){$(document).trigger({type:'lazy.after', el: c});c.hide().attr("src",c.data(h.data_attribute))[h.effect](h.effect_speed),b.loaded=!0;var d=a.grep(f,function(a){return!a.loaded});f=a(d);if(h.load){var e=f.length;h.load.call(b,e,h)}}).attr("src",c.data(h.data_attribute))}}),0!==h.event.indexOf("scroll")&&c.bind(h.event,function(a){b.loaded||c.trigger("appear")})}),e.bind("resize",function(a){i()}),/iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent.persisted&&f.each(function(){a(this).trigger("appear")})}),a(b).load(function(){i()}),this},a.belowthefold=function(c,f){var g;return f.container===d||f.container===b?g=e.height()+e.scrollTop():g=a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return f.container===d||f.container===b?g=e.width()+e.scrollLeft():g=a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return f.container===d||f.container===b?g=e.scrollTop():g=a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return f.container===d||f.container===b?g=e.scrollLeft():g=a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!a.rightoffold(b,c)&&!a.leftofbegin(b,c)&&!a.belowthefold(b,c)&&!a.abovethetop(b,c)},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})})(jQuery,window,document)
/*
 *imagecms frontend plugins
 ** @author Domovoj
 * @copyright <domovoj1@gmail.com>
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
String.prototype.trimMiddle = function()
{
    var r = /\s\s+/g;
    return $.trim(this).replace(r, ' ');
};
String.prototype.isNumeric = function() {
    return !isNaN(parseFloat(this)) && isFinite(this);
};
String.prototype.pasteSAcomm = function() {
    var r = /\s,/g;
    return this.replace(r, ',');
};
$.exists = function(selector) {
    return $(selector).length > 0 && $(selector) instanceof jQuery;
};
$.existsN = function(nabir) {
    return nabir.length > 0 && nabir instanceof jQuery;
};
getChar = function(e) {
    if (e.which === null) {  // IE
        if (e.keyCode < 32)
            return null;
        return String.fromCharCode(e.keyCode);
    }

    if (e.which !== 0 && e.charCode !== 0) { // non IE
        if (e.which < 32)
            return null;
        return String.fromCharCode(e.which);
    }
    return null;
};
returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
$.fn.testNumber = function(add) {
    $(this).off('keypress.testNumber').on('keypress.testNumber', function(e) {
        var $this = $(this);
        if (e.ctrlKey || e.altKey || e.metaKey)
            return;
        var chr = getChar(e);
        if (chr === null)
            return;
        if (!isNaN(parseFloat(chr)) || $.inArray(chr, add) !== -1) {
            $this.trigger({
                type: 'testNumber',
                'res': true
            });
            return true;
        }
        else {
            $this.trigger({
                type: 'testNumber',
                'res': false
            });
            return false;
        }
    });
};
$.fn.pricetext = function(e, rank) {
    var $this = $(this);
    rank = rank !== undefined ? rank : true;
    $(document).trigger({
        type: 'textanimatechange',
        el: $this,
        ovalue: parseFloat($this.text().replace(/\s+/g, '')),
        nvalue: e,
        rank: rank
    });
    return $this;
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
        Sel.moveStart('character', -el.value.length);
        pos = Sel.text.length - document.selection.createRange().text.length;
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
(function($) {
    var nS = "nstcheck",
            methods = {
                init: function(options) {
                    if ($.existsN(this)) {
                        var settings = $.extend({
                            wrapper: $("label:has(.niceCheck)"),
                            elCheckWrap: '.niceCheck',
                            evCond: false,
                            classRemove: '',
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
                            e.stopPropagation();
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
                            e.preventDefault();
                            if (e.button === 0)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('click.' + nS).on('click.' + nS, function(e) {
                            e.stopPropagation();
                            e.preventDefault();
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
                            e.preventDefault();
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
                    if (el.find("input").attr("checked") !== undefined) {
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
/*plugin nstRadio*/
(function($) {
    var nS = "nstradio",
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
                    $(document).trigger({
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
                    $(document).trigger({
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
/*plugin autocomplete*/
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                item: 'ul > li',
                duration: 300,
                searchPath: "/shop/search/ac" + locale,
                inputString: $('#inputString'),
                minValue: 3,
                underscoreLayout: '#searchResultsTemplate',
                blockEnter: true
            }, options);
            function postSearch() {
                $(document).trigger({
                    'type': 'autocomplete.before',
                    'el': inputString
                });
                $.post(searchPath, {
                    queryString: inputString.val()
                }, function(data) {
                    try {
                        var dataObj = JSON.parse(data),
                                html = _.template($(underscoreLayout).html(), {
                                    'items': dataObj
                                });
                    } catch (e) {
                        var html = e.toString();
                    }
                    $thisS.html(html);
                    $thisS.fadeIn(durationA, function() {
                        $(document).trigger({
                            'type': 'autocomplete.after',
                            'el': $thisS,
                            'input': inputString
                        });
                        $thisS.off('click.autocomplete').on('click.autocomplete', function(e) {
                            e.stopImmediatePropagation();
                        });
                        body.off('click.autocomplete').on('click.autocomplete', function(event) {
                            closeFrame();
                        }).off('keydown.autocomplete').on('keydown.autocomplete', function(e) {
                            if (!e)
                                var e = window.event;
                            if (e.keyCode === 27) {
                                closeFrame();
                            }
                        });
                    });
                    if (inputString.val().length === 0)
                        closeFrame();
                    selectorPosition = -1;
                    var itemserch = $thisS.find(itemA);
                    itemserch.mouseover(function() {
                        var $this = $(this);
                        $this.addClass('selected');
                        selectorPosition = $this.index();
                        lookup(itemserch, selectorPosition);
                    }).mouseleave(function() {
                        $(this).removeClass('selected');
                    });
                    lookup(itemserch, selectorPosition);
                });
            }
            function lookup(itemserch, selectorPosition) {
                inputString.keyup(function(event) {
                    if (!event)
                        var event = window.event;
                    var code = event.keyCode;
                    if (code === 38 || code === 40)
                    {
                        if (code === 38)
                        {
                            selectorPosition -= 1;
                        }
                        if (code === 40)
                        {
                            selectorPosition += 1;
                        }

                        if (selectorPosition < 0)
                        {
                            selectorPosition = itemserch.length - 1;
                        }
                        if (selectorPosition > itemserch.length - 1)
                        {
                            selectorPosition = 0;
                        }
                        itemserch.removeClass('selected');
                        itemserch.eq(selectorPosition).addClass('selected');
                        return false;
                    }

                    // Enter pressed
                    if (code === 13)
                    {
                        var itemserchS = itemserch.filter('.selected');
                        if ($.existsN(itemserchS))
                            itemserchS.each(function(i, el) {
                                window.location = $(el).attr('href');
                                window.location = $(el).find('a').attr('href');
                            });
                        else {
                            $thisS.closest('form').submit();
                        }
                    }
                    return false;
                });
            }

            function closeFrame() {
                $(document).trigger({
                    'type': 'autocomplete.close',
                    'el': $thisS
                });
                $thisS.stop(true, false).fadeOut(durationA);
                $thisS.off('click.autocomplete');
                body.off('click.autocomplete').off('keydown.autocomplete');
            }

            var $thisS = this,
                    blockEnter = settings.blockEnter,
                    itemA = settings.item,
                    durationA = settings.duration,
                    searchPath = settings.searchPath,
                    selectorPosition = -1,
                    inputString = settings.inputString,
                    underscoreLayout = settings.underscoreLayout,
                    minValue = settings.minValue;
            var submit = inputString.closest('form').find('[type="submit"]');
            if (blockEnter)
                submit.on('click.autocomplete', function(e) {
                    e.preventDefault();
                    inputString.focus();
                    $(document).trigger({
                        type: 'autocomplete.fewLength',
                        el: inputString,
                        value: minValue
                    });
                });
            inputString.keyup(function(event) {
                var $this = $(this);
                var inputValL = $this.val().length;
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (inputValL > minValue) {
                    $this.tooltip('remove');
                    if (code !== 27 && code !== 40 && code !== 38 && code !== 39 && code !== 37 && code !== 13 && inputValL !== 0 && $.trim($this.val()) !== "")
                        postSearch();
                    else if (inputValL === 0)
                        closeFrame();
                }
                else {
                    if (code === 13 && !blockEnter)
                        submit.closest('form').submit();
                    else
                        $(document).trigger({
                            type: 'autocomplete.fewLength',
                            el: $this,
                            value: minValue
                        });
                }
                if (inputString.val().length <= minValue && blockEnter)
                    submit.off('click.autocomplete').on('click.autocomplete', function(e) {
                        e.preventDefault();
                        inputString.focus();
                        $(document).trigger({
                            type: 'autocomplete.fewLength',
                            el: inputString,
                            value: minValue
                        });
                    });
                else {
                    submit.off('click.autocomplete');
                }
            }).blur(function() {
                closeFrame();
            });
            inputString.keypress(function(event) {
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (code === 13 && $(this).val().length <= minValue)
                    return false;
            });
        }
    };
    $.fn.autocomplete = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.autocomplete');
        }
    };
    $.autocomplete = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin autocomplete end*/
/*plugin tooltip*/
(function($) {
    var nS = 'tooltip',
            tooltip = '.tooltip',
            methods = {
                def: {
                    title: '',
                    otherClass: '',
                    effect: '',
                    textEl: '.text-el',
                    placement: 'top',
                    offsetX: 0,
                    offsetY: 0,
                    tooltip: '.tooltip',
                    durationOn: 300,
                    durationOff: 200,
                    show: false
                },
                init: function(options) {
                    this.each(function() {
                        if (!options)
                            options = {};

                        var $this = $(this),
                                elSet = $this.data(),
                                set = {};

                        for (var i in methods.def) {
                            var prop = (elSet[i] !== undefined ? elSet[i] : '').toString() || (options[i] !== undefined ? options[i] : '').toString() || methods.def[i].toString();
                            if (!isNaN(parseFloat(methods.def[i])) && isFinite(methods.def[i]))
                                set[i] = +(prop);
                            else
                                set[i] = prop;
                        }

                        if ($.exists(set.tooltip))
                            tooltip = $(set.tooltip);
                        else
                            tooltip = $(set.tooltip).appendTo(body);

                        if (set.effect !== 'always')
                            $this.data(set);
                        else
                            $this.data('title', '');

                        var textEl = $this.find(set.textEl);
                        if (textEl.is(':visible') && $.existsN(textEl))
                            return $this;
                        tooltip.html(set.title);
                        if (set.otherClass) {
                            if (!$.exists(set.tooltip + '.' + set.otherClass))
                                $(tooltip).first().clone().appendTo(body).addClass(set.otherClass);

                            tooltip = $(set.tooltip + '.' + set.otherClass).data(set);
                        }

                        if (set.effect === 'mouse')
                            $this.off('mousemove.' + nS).on('mousemove.' + nS, function(e) {
                                tooltip.html(set.title).show().css({
                                    'left': methods.left($(this), tooltip, set.placement, e.pageX, set.effect, set.offsetX),
                                    'top': methods.top($(this), tooltip, set.placement, e.pageY, set.effect, set.offsetY)
                                });
                            });
                        tooltip.removeClass('top bottom right left').addClass(set.placement);
                        tooltip.css({
                            'left': methods.left($this, tooltip, set.placement, $this.offset().left, set.effect, set.offsetX),
                            'top': methods.top($this, tooltip, set.placement, $this.offset().top, set.effect, set.offsetY)
                        });
                        if (set.show === 'true')
                            tooltip.fadeIn(set.durationOn);
                        $this.off('mouseleave.' + nS).on('mouseleave.' + nS, function(e) {
                            var el = $(this);
                            if (set.effect !== 'always')
                                el.tooltip('remove', e);
                        });
                        $this.filter(':input').off('blur.' + nS).on('blur.' + nS, function(e) {
                            $(this).tooltip('remove', e);
                        });
                    });
                    return this;
                },
                show: function(options) {
                    methods.init.call(this, $.extend({show: true}, options));
                },
                left: function(el, tooltip, placement, left, eff, offset) {
                    if (placement === 'left')
                        return Math.ceil(left - (eff === 'mouse' ? offset : tooltip.actual('outerWidth') - offset));
                    if (placement === 'right')
                        return Math.ceil(left + (eff === 'mouse' ? offset : el.outerWidth() + offset));
                    else
                        return Math.ceil(left - (eff === 'mouse' ? offset : (tooltip.actual('outerWidth') - el.outerWidth()) / 2));
                },
                top: function(el, tooltip, placement, top, eff, offset) {
                    if (placement === 'top')
                        return Math.ceil(top - (eff === 'mouse' ? offset : tooltip.actual('outerHeight') - offset));
                    if (placement === 'bottom')
                        return Math.ceil(top + (eff === 'mouse' ? offset : tooltip.actual('outerHeight') + offset));
                    else {
                        return Math.ceil(top - (eff === 'mouse' ? offset : (tooltip.actual('outerHeight') - el.outerHeight()) / 2));
                    }
                },
                remove: function(e) {
                    this.each(function() {
                        var $this = $(this),
                                tooltip = $(methods.def.tooltip);

                        if ($this instanceof jQuery && $this['data']) {
                            var data = $this.data(),
                                    durOff = $this.data('durationOff');

                            if (data.tooltip !== '.tooltip')
                                tooltip = tooltip.add($(data.tooltip));
                            if (data.otherClass)
                                tooltip = tooltip.add($('.' + data.otherClass));
                        }
                        else
                            durOff = methods.def.durationOff;

                        $(tooltip).stop().fadeOut(durOff, function() {
                            var $this = $(this);
                            if ($this.data('otherClass') && $this.data('otherClass') !== '')
                                $this.remove();
                        });
                    });
                    return this;
                }
            };
    $.fn.tooltip = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return handlerTooltip.call(this, arguments[0], null);
        } else {
            $.error('Method ' + method + ' does not exist on $.tooltip');
        }
    };
    $.tooltip = function(m) {
        return methods[m];
    };
    function handlerTooltip(o, e) {
        $(this).each(function() {
            if (e && $(e.relatedTarget).has('[data-rel="tooltip"]'))
                $(tooltip).hide();
            $(this).tooltip('init', o);
        });
        return $(this);
    }
    ;
    body.on('mouseenter.' + nS, '[data-rel="tooltip"]', function(e) {
        handlerTooltip.call(this, {show: true}, e);
    }).on('click.' + nS + ' mouseup.' + nS, function(e) {
        if ($(this).data('effect') === 'always')
            $.tooltip('remove')(e);
    });
    if (!$.exists(tooltip))
        body.append('<span class="tooltip"></span>');
})(jQuery);
/*plugin tooltip end*/
/*plugin menuImageCms for main menu shop*/
(function($) {
    var methods = {
        _position: function(menuW, $thisL, dropW, drop, $thisW, countColumn, sub2, direction) {
            if ((menuW - $thisL < dropW && dropW < menuW && direction !== 'left') || direction === 'right') {
                drop.removeClass('left-drop');
                if (drop.children().children().length >= countColumn && !sub2)
                    drop.css('right', 0).addClass('right-drop');
                else {
                    var right = menuW - $thisW - $thisL;
                    if ($thisL + $thisW < dropW) {
                        right = menuW - dropW;
                    }
                    drop.css('right', right).addClass('right-drop');
                }
            } else if (direction !== 'right' || direction === 'left') {
                drop.removeClass('right-drop');
                if (sub2 && dropW > menuW)
                    drop.css('left', $thisL).addClass('left-drop');
                else if (drop.children().children().length >= countColumn || dropW >= menuW)
                    drop.css('left', 0).addClass('left-drop');
                else
                    drop.css('left', $thisL).addClass('left-drop');
            }
        },
        init: function(options) {
            this.each(function() {
                var menu = $(this);
                if ($.existsN(menu)) {
                    var sH = 0,
                            optionsMenu = $.extend({
                                item: 'li:first',
                                direction: null,
                                effectOn: 'fadeIn',
                                effectOff: 'fadeOut',
                                effectOnS: 'fadeIn',
                                effectOffS: 'fadeOut',
                                duration: 0,
                                drop: 'li > ul',
                                countColumn: 'none',
                                columnPart: false,
                                columnPart2: false,
                                maxC: 10,
                                sub3Frame: 'ul ul',
                                columnClassPref: 'column_',
                                columnClassPref2: 'column2_',
                                durationOn: 0,
                                durationOff: 0,
                                durationOnS: 0,
                                animatesub3: false,
                                dropWidth: null,
                                sub2Frame: null,
                                evLF: 'hover',
                                evLS: 'hover',
                                hM: 'hoverM',
                                menuCache: false,
                                activeFl: aC,
                                parentTl: 'li',
                                refresh: false,
                                otherPage: undefined,
                                classRemove: 'not-js',
                                vertical: false
                            }, options);
                    menu.data('options', optionsMenu);
                    var settings = optionsMenu,
                            menuW = menu.width(),
                            item = settings.item,
                            menuItem = menu.find(item),
                            direction = settings.direction,
                            drop = settings.drop,
                            dropOJ = menu.find(drop),
                            effOn = settings.effectOn,
                            effOff = settings.effectOff,
                            effOnS = settings.effectOnS,
                            countColumn = settings.countColumn,
                            columnPart = settings.columnPart,
                            columnPart2 = settings.columnPart2,
                            maxC = settings.maxC,
                            sub3Frame = settings.sub3Frame,
                            columnClassPref = settings.columnClassPref,
                            columnClassPref2 = settings.columnClassPref2,
                            itemMenuL = menuItem.length,
                            dropW = settings.dropWidth,
                            sub2Frame = settings.sub2Frame,
                            duration = settings.duration,
                            timeDurM = settings.duration,
                            durationOn = settings.durationOn,
                            durationOff = settings.durationOff,
                            durationOnS = settings.durationOnS,
                            animatesub3 = settings.animatesub3,
                            evLF = settings.evLF,
                            evLS = settings.evLS,
                            hM = settings.frAClass,
                            refresh = settings.refresh,
                            menuCache = settings.menuCache,
                            activeFl = settings.activeFl,
                            parentTl = settings.parentTl,
                            otherPage = settings.otherPage,
                            classRemove = settings.classRemove,
                            vertical = settings.vertical;

                    if (menuCache && !refresh) {
                        menu.find('a').each(function() {//if start without cache and remove active item
                            var $this = $(this);
                            $this.closest(activeFl.split(' ')[0]).removeClass(aC);
                            $this.removeClass(aC);
                        });
                        var locHref = location.origin + location.pathname,
                                locationHref = otherPage !== undefined ? otherPage : locHref;
                        menu.find('a[href="' + locationHref + '"]').each(function() {
                            var $this = $(this);
                            $this.closest(activeFl.split(' ')[0]).addClass(aC);
                            $this.closest(parentTl.split(' ')[0]).addClass(aC).prev().addClass(aC);
                            $this.addClass(aC);
                        });
                    }
                    if (isTouch) {
                        evLF = 'toggle';
                        evLS = 'toggle';
                    }
                    if (!refresh) {
                        if (columnPart2) {
                            dropOJ.find(sub3Frame).each(function() {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref2 + '([0-9]+))'),
                                        numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(new RegExp(columnClassPref2 + '([0-9]+)'))[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL > 1) {
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var currC = columnsObj.filter('.' + n),
                                                classCuurC = currC.first().attr('class');
                                        $this.children().append('<li class="' + classCuurC + '" data-column="' + n + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append(currC.clone());
                                        numbColumnL = numbColumnL > maxC ? maxC : numbColumnL;
                                        if (sub2Frame)
                                            $this.addClass('x' + numbColumnL);
                                        else {
                                            $this.closest('li').addClass('x' + numbColumnL).attr('data-x', numbColumnL);
                                        }
                                    });
                                    columnsObj.remove();
                                }
                            });
                        }
                        if (columnPart && !sub2Frame)
                            dropOJ.each(function() {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref + '([0-9]|-1+))'),
                                        numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(/([0-9]|-1+)/)[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL === 1 && $.inArray('0', numbColumn) === -1 || numbColumnL > 1) {
                                    if ($.inArray('-1', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('-1');
                                    }
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var $thisLi = columnsObj.filter('.' + columnClassPref + n),
                                                sumx = 0;
                                        $thisLi.each(function() {
                                            var datax = +$(this).attr('data-x');
                                            sumx = parseInt(datax === 0 || !datax ? 1 : datax) > sumx ? parseInt(datax === 0 || !datax ? 1 : datax) : sumx;
                                        });
                                        $this.children().append('<li class="x' + sumx + '" data-column="' + n + '" data-x="' + sumx + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append($thisLi.clone());
                                    });
                                    columnsObj.remove();
                                }
                                var sumx = 0;
                                $this.children().children().each(function() {
                                    var datax = +$(this).attr('data-x');
                                    sumx = sumx + parseInt(datax === 0 || !datax ? 1 : datax);
                                });
                                sumx = sumx > maxC ? maxC : sumx;
                                $this.addClass('x' + sumx);
                            });
                        $(document).trigger({
                            type: 'columnRenderComplete',
                            el: dropOJ
                        });
                    }
                    var k = [];
                    if (!vertical)
                        menuItem.add(menuItem.find('.helper:first')).css('height', '');
                    menuItem.each(function(index) {
                        var $this = $(this),
                                $thisW = $this.width(),
                                $thisL = $this.position().left,
                                $thisH = $this.height(),
                                $thisDrop = $this.find(drop);
                        k[index] = false;
                        if ($thisH > sH)
                            sH = $thisH;
                        if ($.existsN($thisDrop)) {
                            if (!dropW) {
                                menu.css('overflow', 'hidden');
                                var dropW2 = $thisDrop.show().width();
                                $thisDrop.hide();
                                menu.css('overflow', '');
                            }
                            else
                                dropW2 = dropW;
                            methods._position(menuW, $thisL, dropW2, $thisDrop, $thisW, countColumn, sub2Frame, direction);
                        }
                        $this.data('kk', 0);
                    });
                    if (!vertical)
                        menuItem.css('height', sH);
                    if (!vertical)
                        menuItem.find('.helper:first').css('height', sH);
                    menu.removeClass(classRemove);
                    var hoverTO = '';
                    function closeMenu(el) {
                        if (el && $.existsN(el.parents(item)))
                            return false;
                        var $thisDrop = menu.find(drop);
                        if ($thisDrop.length !== 0)
                            menu.removeClass(hM);
                        if (evLS === 'click' || evLF === 'click') {
                            menu.find('.' + hM).click();
                            dropOJ.hide();
                        }

                        $('.firstH, .lastH').removeClass('firstH lastH');
                        clearTimeout(hoverTO);
                    }
                    if (evLF === 'toggle')
                        evLF = 'click';
                    if (evLS === 'toggle')
                        evLS = 'click';

                    menuItem.off('click').off('hover')[evLF](
                            function(e) {
                                var $this = $(this);
                                if (evLF === 'click')
                                    e.stopPropagation();
                                if ($this.data("show") === "no" || !$this.data("show")) {
                                    $this.data("show", "yes");
                                    clearTimeout(hoverTO);
                                    closeMenu($this);
                                    var $thisI = $this.index(),
                                            $thisDrop = $this.find(drop).first();
                                    $this.addClass(hM);
                                    if ($thisI === 0)
                                        $this.addClass('firstH');
                                    if ($thisI === itemMenuL - 1)
                                        $this.addClass('lastH');
                                    if ($(e.relatedTarget).is(menuItem) || $.existsN($(e.relatedTarget).parents(menuItem)) || $this.data('kk') === 0)
                                        k[$thisI] = true;
                                    if (k[$thisI]) {
                                        hoverTO = setTimeout(function() {
                                            $thisDrop[effOn](durationOn, function(e) {
                                                $this.data('kk', $this.data('kk') + 1);
                                                $(document).trigger({
                                                    type: 'menu.showDrop',
                                                    el: $thisDrop
                                                });
                                                if ($thisDrop.length !== 0)
                                                    menu.addClass(hM);
                                                if (sub2Frame) {
                                                    var listDrop = $thisDrop.children();
                                                    $thisDrop.find(sub2Frame).addClass('is-side');
                                                    listDrop.children().off('click').off('hover')[evLS](function(e) {
                                                        var $this = $(this);
                                                        if (evLS === 'click')
                                                            e.stopPropagation();
                                                        if ($this.data("show") === "no" || !$this.data("show")) {
                                                            $this.data("show", "yes");
                                                            subFrame = $this.find(sub2Frame);
                                                            if (e.type !== 'click' && evLS !== 'click') {
                                                                $this.siblings().removeClass(hM);
                                                            }
                                                            if ($.existsN(subFrame)) {
                                                                if (e.type === 'click' && evLS === 'click') {
                                                                    e.stopPropagation();
                                                                    $this.siblings().filter('.' + hM).click();
                                                                    $this.addClass(hM);
                                                                }
                                                                else
                                                                    $this.has(sub2Frame).addClass(hM);

                                                                $thisDrop.css('width', '');
                                                                listDrop.add(subFrame).css('height', '');
                                                                var dropW = $thisDrop.width(),
                                                                        sumW = dropW + subFrame.width(),
                                                                        subHL2 = subFrame.outerHeight(),
                                                                        dropDH = listDrop.height();
                                                                var addH = listDrop.outerHeight() - dropDH;
                                                                if (subHL2 < dropDH)
                                                                    subHL2 = dropDH;
                                                                if (animatesub3) {
                                                                    listDrop.animate({
                                                                        'height': subHL2
                                                                    }, {
                                                                        queue: false,
                                                                        duration: durationOnS,
                                                                        complete: function() {
                                                                            $thisDrop.animate({
                                                                                'width': sumW,
                                                                                'height': subHL2 + addH
                                                                            }, {
                                                                                queue: false,
                                                                                duration: durationOnS
                                                                            });
                                                                        }
                                                                    });
                                                                }
                                                                else {
                                                                    listDrop.css('height', subHL2);
                                                                    $thisDrop.css({
                                                                        'height': subHL2 + addH,
                                                                        'width': sumW
                                                                    });
                                                                }
                                                                subFrame[effOnS](durationOnS, function() {
                                                                    subFrame.css('height', subHL2);
                                                                });
                                                            }
                                                            else
                                                                return true;
                                                        }
                                                        else {
                                                            $this.data("show", "no");
                                                            if (e.type === 'click' && evLS === 'click') {
                                                                e.stopPropagation();
                                                            }
                                                            var subFrame = $this.find(sub2Frame);
                                                            if ($.existsN(subFrame)) {
                                                                subFrame.hide();
                                                                $thisDrop.css({
                                                                    'width': '',
                                                                    'height': ''
                                                                });
                                                                listDrop.add(subFrame).stop().css('height', '');
                                                                $this.removeClass(hM);
                                                            }
                                                        }
                                                    });
                                                }
                                            });
                                        }, timeDurM);
                                    }
                                }
                                else {
                                    $this.data("show", "no");
                                    var $thisI = $this.index();
                                    k[$thisI] = true;
                                    if ($this.index() === 0)
                                        $this.removeClass('firstH');
                                    if ($this.index() === itemMenuL - 1)
                                        $this.removeClass('lastH');
                                    var $thisDrop = $this.find(drop);
                                    if ($.existsN($thisDrop)) {
                                        $thisDrop.stop(true, false)[effOff](durationOff);
                                    }
                                    $this.removeClass(hM);
                                }
                            });
                    menu.off('hover')['hover'](
                            function(e) {
                                menuItem.each(function() {
                                    $(this).data('kk', 0);
                                });
                                timeDurM = 0;
                            },
                            function(e) {
                                closeMenu();
                                menuItem.each(function() {
                                    $(this).data('kk', -1);
                                });
                                timeDurM = duration;
                            });
                    body.off('click.menu').on('click.menu', function(e) {
                        closeMenu();
                    }).off('keydown.menu').on('keydown.menu', function(e) {
                        if (!e)
                            var e = window.event;
                        if (e.keyCode === 27) {
                            closeMenu();
                        }
                    });
                    dropOJ.find('a').off('click.menuref').on('click.menuref', function(e) {
                        if (evLS === 'click') {
                            if ($.existsN($(this).next()) && sub2Frame) {
                                e.preventDefault();
                                return true;
                            }
                            e.stopPropagation();
                            return true;
                        }
                        else
                            e.stopPropagation();
                    });
                    menuItem.find('a:first').off('click.menuref').on('click.menuref', function(e) {
                        if (!$.existsN($(this).closest(item).find(drop)))
                            e.stopPropagation();
                        if (evLF === 'click' && $.existsN($(this).closest(item).find(drop)))
                            e.preventDefault();
                    });
                }
            });
            return this;
        },
        refresh: function(optionsMenu) {
            methods.init.call(this, $.extend({}, optionsMenu ? optionsMenu : this.data('options'), {
                refresh: true
            }));
            return this;
        }
    };
    $.fn.menuImageCms = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.menuImageCms');
        }
    };
    $.menuImageCms = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin menuImageCms end*/
/*plugin tabs*/
(function($) {
    var methods = {
        index: 0,
        init: function(options) {
            var $this = this;
            if ($.existsN($this)) {
                var settings = $.extend({
                    effectOn: 'show',
                    effectOff: 'hide',
                    durationOn: '0',
                    durationOff: '0',
                    before: function() {
                    },
                    after: function() {
                    }
                }, options);
                var tabsDiv = [],
                        tabsId = [],
                        navTabsLi = [],
                        regRefs = [],
                        thisL = this.length,
                        k = true,
                        refs = [],
                        attrOrdata = [];
                $this.each(function() {
                    var index = methods.index,
                            $thiss = $(this),
                            data = $thiss.data(),
                            effectOn = data.effectOn || settings.effectOn,
                            effectOff = data.effectOff || settings.effectOff,
                            durationOn = +(data.durationOn ? data.durationOn.toString() : data.durationOn || settings.durationOn ? settings.durationOn.toString() : settings.durationOn),
                            durationOff = +(data.durationOff ? data.durationOff.toString() : data.durationOff || settings.durationOff ? settings.durationOff.toString() : settings.durationOff);
                    navTabsLi[index] = $thiss.children();
                    refs[index] = navTabsLi[index].children(':first-child');
                    attrOrdata[index] = refs[index].attr('href') !== undefined ? 'attr' : 'data';
                    var tempO = $([]),
                            tempO2 = $([]),
                            tempRefs = [];
                    methods.index += 1;
                    refs[index].each(function(ind) {
                        var tHref = $(this)[attrOrdata[index]]('href');
                        if (tHref.indexOf('#') !== -1) {
                            tempO = tempO.add($(tHref));
                            tempO2 = tempO2.add('[data-id=' + tHref + ']');
                            tempRefs.push(tHref);
                        }
                    });
                    tabsDiv[index] = tempO;
                    tabsId[index] = tempO2;
                    regRefs[index] = tempRefs;
                    refs[index].off('click.tabs').on('click.tabs', function(e) {
                        var $this = $(this),
                                resB = settings.before($this);
                        if (resB === undefined || resB === true) {
                            if ($this.is('a'))
                                e.preventDefault();
                            var cookie = $thiss.data('cookie') !== undefined,
                                    toggle = $thiss.data('type') === 'toggle',
                                    condStart = e.start;
                            if (!$this.parent().hasClass('disabled')) {
                                var $thisA = $this[attrOrdata[index]]('href'),
                                        $thisAOld = navTabsLi[index].filter('.' + aC).children()[attrOrdata[index]]('href'),
                                        $thisAOld = $thisAOld === $thisA ? undefined : $thisAOld,
                                        $thisAO = $($thisA),
                                        $thisS = $this.data('source') || $this.attr('href'),
                                        $thisData = $this.data('data'),
                                        $thisSel = $this.data('selector');
                                function tabsDivT() {
                                    var showBlock = $thisAO.add($('[data-id=' + $thisA + ']')),
                                            addDiv = toggle ? ($thisAO.is(':visible') && !condStart ? $([]) : showBlock) : showBlock;
                                    if ($thisA.indexOf('#') !== -1 && !$thisAO.is(':visible')) {
                                        showBlock[effectOn](durationOn, function() {
                                            settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                        }).addClass(aC);
                                    }
                                    else if ($thisA.indexOf('#') === -1)
                                        settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                    tabsDiv[index].add(tabsId[index]).not(addDiv)[effectOff](durationOff).removeClass(aC);
                                }
                                var activeP = $this.parent();
                                navTabsLi[index].not(activeP).removeClass(aC);
                                if (activeP.hasClass(aC) && toggle)
                                    activeP.removeClass(aC);
                                else
                                    activeP.addClass(aC);
                                if (!condStart && $thisS !== undefined)
                                    tabsDivT();
                                if ($thisS !== undefined && !$thisAO.hasClass('visited')) {
                                    $thisAO.addClass('visited');
                                    $(document).trigger({
                                        'type': 'tabs.beforeload',
                                        "els": tabsDiv[index],
                                        "el": $thisAO
                                    });
                                    if ($thisData !== undefined)
                                        $.ajax({
                                            type: 'post',
                                            url: $thisS,
                                            data: $thisData,
                                            success: function(data) {
                                                tabsDivT();
                                                $thisAO.find($thisSel).html(data);
                                                $(document).trigger({
                                                    'type': 'tabs.afterload',
                                                    "els": tabsDiv[index],
                                                    "el": $thisAO
                                                });
                                            }
                                        });
                                    else
                                        $thisAO.load($thisS, function() {
                                            $(document).trigger({
                                                'type': 'tabs.afterload',
                                                "els": tabsDiv[index],
                                                "el": $thisAO
                                            });
                                            tabsDivT();
                                        });
                                }
                                else {
                                    tabsDivT();
                                }

                                if (e.scroll)
                                    $('html, body').scrollTop($this.offset().top);
                                $(document).trigger({
                                    'type': 'tabs.showtabs',
                                    'el': $thisAO
                                });
                                if (cookie) {
                                    setCookie($thiss.data('cookie') === undefined ? 'cookie' + index : $thiss.data('cookie'), $this.data('href'), 0, '/');
                                }
                                var wLH = window.location.hash,
                                        i = 0;
                                _.map(regRefs[index], function(n, j) {
                                    _.map(methods.hashs[0], function(m, j) {
                                        if (m === n)
                                            i++;
                                    });
                                });
                                if (attrOrdata[index] !== 'data' || i > 0 || cookie) {
                                    if (!condStart) {
                                        var temp = wLH;
                                        if (!toggle) {
                                            if ($thisAOld !== undefined) {
                                                if (wLH.indexOf($thisAOld) !== -1) {
                                                    temp = temp.replace($thisAOld, $thisA);
                                                }
                                                else if ($thisA !== $thisAOld && wLH.indexOf($thisA) === -1) {
                                                    temp += $thisA;
                                                }
                                            }
                                            else if (wLH.indexOf($thisA) === -1) {
                                                temp += $thisA;
                                            }
                                        }
                                        else {
                                            temp = temp.replace($thisAOld, $thisA);
                                        }
                                        window.location.hash = temp;
                                    }
                                    else if (k) {
                                        window.location.hash = _.uniq(methods.hashs[0]).join('');
                                        k = false;
                                    }
                                }
                                if ($thiss.data('elchange') !== undefined) {
                                    refs[index].each(function() {
                                        var $thisDH = $(this).data('href');
                                        if ($thisDH === $thisA)
                                            $($thiss.data('elchange')).addClass($thisA);
                                        else
                                            $($thiss.data('elchange')).removeClass($thisDH);
                                    });
                                }
                            }
                            return false;
                        }
                    });
                    if (thisL - 1 === index)
                        methods.location(regRefs, refs);
                });
                wnd.off('hashchange.tabs').on('hashchange.tabs', function(e) {
                    e.preventDefault();
                    _.map(location.hash.split('#'), function(i, n) {
                        if (i !== '') {
                            var el = $('[data-href="#' + i + '"], [href="#' + i + '"]');
                            if (!$.existsN(el.closest('[data-type="toggle"]'))) {
                                if (!el.parent().hasClass(aC))
                                    el.trigger('click.tabs');
                            }
                        }
                    });
                });
            }
            return $this;
        },
        location: function(regrefs, refs) {
            var hashs1 = [],
                    hashs2 = [];
            if (location.hash === '')
            {
                var i = 0,
                        j = 0;
                _.map(refs, function(n, i) {
                    var $this = n.first(),
                            attrOrdataL = $this.attr('href') !== undefined ? 'attr' : 'data';
                    if (attrOrdataL !== 'data') {
                        hashs1[i] = $this[attrOrdataL]('href');
                        i++;
                    }
                    else if (attrOrdataL === 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                });
                var hashs = [hashs1, hashs2];
            }
            else {
                _.map(refs, function(n, i) {
                    var j = 0,
                            $this = n.first(),
                            attrOrdataL = $this.attr('href') !== undefined ? 'attr' : 'data';
                    if (attrOrdataL === 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                });
                var t = location.hash,
                        s = '#',
                        m = s.length, res = 0,
                        i = 0, pos = [];
                while (i < t.length - 1)
                {
                    var ch = t.substr(i, m);
                    if (ch === s) {
                        res += 1;
                        i = i + m;
                        pos[res - 1] = t.indexOf(s, i - m);
                    } else
                        i++;
                }
                i = 0;
                while (i < pos.length) {
                    hashs1[i] = t.substring(pos[i], pos[i + 1]);
                    i++;
                }
                var hashs = [hashs1, hashs2];
            }
            methods.hashs = hashs;
            methods.startCheck(regrefs, methods.hashs);
        },
        startCheck: function(regrefs, hashs) {
            var hash = hashs[0].concat(hashs[1]),
                    regrefsL = regrefs.length,
                    sim = 0;
            $.map(regrefs, function(n, k) {
                var i = 0,
                        hashs2 = [].concat(hash);
                $.map(hash, function(n, j) {
                    if ($.inArray(n, regrefs[k]) >= 0)
                        i++;
                    if ($.inArray(n, regrefs[k]) >= 0 && i > 1) {
                        hashs2.splice(hashs2.indexOf(n), 1);
                    }
                });
                if (hashs2.join() === hash.join())
                    sim++;
                if (hashs2.join() !== hash.join() || sim === regrefsL)
                    $.map(hashs2, function(n, i) {
                        var attrOrdataNew = "";
                        $('[href=' + n + ']').length === 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                        if ($.inArray(n, hashs[0]) === -1 && $.existsN($('[' + attrOrdataNew + '=' + n + ']').parent().siblings('.' + aC))) {
                            $('[' + attrOrdataNew + '=' + n + ']').parent().siblings('.' + aC).children().trigger({
                                'type': 'click.tabs',
                                'start': true
                            });
                        }
                        else {
                            $('[' + attrOrdataNew + '=' + n + ']').trigger({
                                'type': 'click.tabs',
                                'start': true
                            });
                        }
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
    $.tabs = function(m) {
        return methods[m];
    };
})(jQuery);
/*/plugin tabs end*/
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
/*plugin plusminus*/
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                prev: 'prev',
                next: 'next',
                step: 1,
                checkProdStock: false,
                after: function() {
                },
                before: function() {
                },
                hover: function() {
                }
            }, options);
            if (this.length > 0) {
                return this.each(function() {
                    var $this = $(this),
                            $thisVal = $this.val(),
                            checkProdStock = settings.checkProdStock,
                            step = settings.step,
                            max = +$this.data('max'),
                            min = +$this.data('min'),
                            prev = settings.prev,
                            next = settings.next;

                    function _checkBtn(type) {
                        var btn = $this,
                                regS = '',
                                regM = '';
                        $.each(type, function(i, v) {
                            regS = v.match(/\(.*\)/);
                            if (regS !== null) {
                                regM = regS['input'].replace(regS[0], '');
                                regS = regS[0].substring(1, regS[0].length - 1);
                            }
                            if (regS === null)
                                regM = v;
                            btn = btn[regM](regS);
                        });
                        return btn;
                    }

                    var $thisPrev = typeof prev === 'string' ? _checkBtn(prev.split('.')) : prev,
                            $thisNext = typeof next === 'string' ? _checkBtn(next.split('.')) : next;
                    if (max !== '' && $thisVal >= max && checkProdStock) {
                        $this.val(max);
                        $thisNext.attr('disabled', 'disabled');
                    }
                    if (min !== '' && $thisVal <= min && checkProdStock) {
                        $this.val(min);
                        $thisPrev.attr('disabled', 'disabled');
                    }
                    $thisNext.add($thisPrev).off('hover').hover(function(e) {
                        settings.hover(e, $(this), $this, $(this).is($thisNext) ? 'next' : 'prev');
                    });
                    $thisNext.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisPrev.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseFloat(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input, 'next');
                                var nextVal = +(inputVal + step).toFixed(10);
                                if (isNaN(inputVal))
                                    input.val(min || 1);
                                else
                                    input.val(nextVal);
                                if (nextVal === max && checkProdStock) {
                                    el.attr('disabled', 'disabled');
                                }
                                settings.after(e, el, input, 'next');
                            }
                        }
                    });
                    $thisPrev.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisNext.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseFloat(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input, 'prev');
                                var nextVal = +(inputVal - step).toFixed(10);

                                if (isNaN(inputVal))
                                    input.val(min || 1);
                                else if (inputVal > (min || 1)) {
                                    input.val(nextVal);
                                    if (nextVal === min && checkProdStock)
                                        el.attr('disabled', 'disabled');
                                }
                                settings.after(e, el, input, 'prev');
                            }
                        }
                    });
                });
            }
        }
    };
    $.fn.plusminus = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.plusminus');
        }
    };
    $.plusminus = function(m) {
        return methods[m];
    };
})($);
/*/plugin plusminus end*/
/*plugin maxminValue*/
(function($) {
    var methods = {
        init: function(e, f) {
            var $this = this,
                    $thisVal = $this.val(),
                    set = $.maxminValue.settings,
                    $max = parseInt($this.attr('data-max'));
            if ($thisVal > $max && set.addCond) {
                $this.val($max);
                if (typeof f === 'function')
                    f();
                return $max;
            }
            else
                return false;
        }
    };
    $.fn.maxminValue = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.maxminValue');
        }
    };
    $.maxminValue = {
        settings: {
            addCond: false
        }
    };
    $.maxminValue = function(m) {
        return methods[m];
    };
    body.off('keypress.max', '[data-max]').on('keypress.max', '[data-max]', function(e) {
        var el = $(this);
        setTimeout(function() {
            var res = el.maxminValue(e);
            el.trigger({
                'type': 'maxminValue',
                'event': e,
                'res': res
            });
        }, 0);
    });
    body.off('keypress', '[data-min]').on('keypress', '[data-min]', function(e) {
        var key = e.keyCode,
                keyChar = parseInt(String.fromCharCode(key));
        var $this = $(this),
                $min = $this.attr('data-min');
        if ($this.val() === "" && keyChar === 0) {
            $this.val($min);
            return false;
        }
    });
    body.off('keyup', '[data-min]').on('keyup', '[data-min]', function(e) {
        var $this = $(this),
                $min = $this.attr('data-min');
        if ($this.val() === "0") {
            $this.val($min);
            $this.trigger({
                'type': 'maxminValue',
                'event': e
            });
            return false;
        }
        else {
            if (e.which !== null) {  // IE
                if (e.keyCode === 46 || e.keyCode === 8)
                    $this.trigger({
                        'type': 'maxminValue',
                        'event': e
                    });
            }
            else if (e.which !== 0 && e.charCode !== 0) { // non IE
                if (e.keyCode === 46 || e.keyCode === 8)
                    $this.trigger({
                        'type': 'maxminValue',
                        'event': e
                    });
            }
        }
    });
})(jQuery);
/*/plugin maxminValue end*/
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
$.dropInit.prototype.extendDrop = function() {
    var addmethods = {
        droppable: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                drop.off('mousedown.' + $.drop.nS).on('mousedown.' + $.drop.nS, function(e) {
                    if (!$(e.target).is(':input')) {
                        body.on('mouseup.' + $.drop.nS, function(e) {
                            drop.css('cursor', '');
                            body.off('selectstart.' + $.drop.nS + ' mousemove.' + $.drop.nS + ' mouseup.' + $.drop.nS);
                        });
                        var $this = $(this).css('cursor', 'move'),
                                left = e.pageX - $this.offset().left,
                                top = e.pageY - $this.offset().top,
                                w = $this.outerWidth(),
                                h = $this.outerHeight(),
                                wndW = wnd.width(),
                                wndH = wnd.height();
                        body.on('selectstart.' + $.drop.nS, function(e) {
                            e.preventDefault();
                        });
                        var condScroll = body.hasClass('isScroll');
                        body.on('mousemove.' + $.drop.nS, function(e) {
                            drop.data('drp').droppableIn = true;
                            var l = e.pageX - left,
                                    t = e.pageY - top;

                            if (!drop.data('drp').droppableLimit) {
                                l = l < 0 ? 0 : l;
                                t = t < 0 ? 0 : t;
                                var addW = condScroll ? $.drop.widthScroll : 0;
                                l = l + w + addW < wndW ? l : wndW - w - addW;
                                t = t + h < wndH ? t : wndH - h;
                            }
                            $this.css({
                                'left': l,
                                'top': t
                            });
                        });
                    }
                });
            });
            return drop;
        },
        noinherit: function(drop, start) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                if (drop.data('drp') && !drop.data('drp').droppableIn) {
                    var method = drop.data('drp').animate && !start ? 'animate' : 'css',
                            placement = drop.data('drp').placement,
                            $this = drop.data('drp').elrun,
                            t = 0,
                            l = 0,
                            $thisW = $this.width(),
                            $thisH = $this.height(),
                            $thisT = 0,
                            $thisL = 0;
                    if (typeof placement === 'object') {
                        var tempObj = {};
                        for (var key in placement) {
                            tempObj[key] = placement[key];
                        }
                        drop[method](tempObj, {
                            duration: drop.data('drp').durationOn,
                            queue: false
                        });
                    }
                    else {
                        var $thisPMT = placement.toLowerCase().split(' ');
                        if ($thisPMT[0] === 'bottom' || $thisPMT[1] === 'bottom')
                            t = -drop.actual('outerHeight');
                        if ($thisPMT[0] === 'top' || $thisPMT[1] === 'top')
                            t = $thisH;
                        if ($thisPMT[0] === 'left' || $thisPMT[1] === 'left')
                            l = 0;
                        if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                            l = -drop.actual('width') - $thisW;
                        if ($thisPMT[0] === 'center')
                            l = -drop.actual('width') / 2 + $thisW / 2;
                        if ($thisPMT[1] === 'center')
                            t = -drop.actual('height') / 2 + $thisH / 2;

                        $thisT = $this.offset().top + t;
                        $thisL = $this.offset().left + l;
                        if ($thisL < 0)
                            $thisL = 0;
                        drop[method]({
                            'bottom': 'auto',
                            'top': $thisT,
                            'left': $thisL
                        }, {
                            duration: drop.data('drp').durationOn,
                            queue: false
                        });
                    }
                }
            });
            return drop;
        },
        heightContent: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this),
                        drp = $.extend({}, drop.data('drp'));

                if (drp.limitContentSize) {
                    var dropV = drop.is(':visible'),
                            forCenter = drp.forCenter;
                    if (!dropV) {
                        drop.show();
                        if (forCenter)
                            forCenter.show();
                    }

                    if (drp.dropContent) {
                        var el = drop.find($(drp.dropContent)).filter(':visible');

                        if (el.data('jsp'))
                            el.data('jsp').destroy();

                        el = drop.find($(drp.dropContent)).filter(':visible').css({'height': ''});

                        if ($.existsN(el)) {
                            var refer = drp.elrun;

                            var api = false,
                                    elCH = el.css({'overflow': ''}).outerHeight();

                            if (drp.scrollContent) {
                                try {
                                    api = el.jScrollPane(scrollPane).data('jsp');
                                    if ($.existsN(el.find('.jspPane')))
                                        elCH = el.find('.jspPane').outerHeight();
                                } catch (err) {
                                    el.css('overflow', 'auto');
                                }
                            }

                            var dropH = drop.outerHeight(),
                                    dropHm = drop.height();

                            var footerHeader = drop.find($(drp.dropHeader)).outerHeight() + drop.find($(drp.dropFooter)).outerHeight();

                            if (drp.place === 'noinherit') {
                                var mayHeight = 0,
                                        placement = drp.placement;
                                if (typeof placement === 'object') {
                                    if (placement.top !== undefined)
                                        mayHeight = wnd.height() - placement.top - footerHeader - (dropH - dropHm);
                                    if (placement.bottom !== undefined)
                                        mayHeight = placement.bottom - footerHeader - (dropH - dropHm);
                                }
                                else {
                                    if (placement.search(/top/) >= 0) {
                                        mayHeight = wnd.height() - refer.offset().top - footerHeader - refer.outerHeight() - (dropH - dropHm);
                                    }
                                    if (placement.search(/bottom/) >= 0) {
                                        mayHeight = refer.offset().top - footerHeader - (dropH - dropHm);
                                    }
                                }
                                if (mayHeight > elCH)
                                    el.css('height', elCH);
                                else
                                    el.css('height', mayHeight);
                            }
                            else {
                                if (elCH + footerHeader > dropHm)
                                    el.css('height', dropHm - footerHeader);
                                else
                                    el.css('height', elCH);
                            }

                            if (api)
                                api.reinitialise();
                        }
                    }
                    if (!dropV) {
                        drop.hide();
                        if (forCenter)
                            forCenter.hide();
                    }
                }
            });
            return drop;
        },
        limitSize: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                if (drop.data('drp').limitSize) {
                    if (drop.data('drp').place === 'center') {
                        drop.css({
                            'width': '',
                            'height': ''
                        });
                        var wndW = wnd.width(),
                                wndH = wnd.height();

                        var dropV = drop.is(':visible'),
                                w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                                h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                                ws = dropV ? drop.width() : drop.actual('width'),
                                hs = dropV ? drop.height() : drop.actual('height');

                        if (w + $.drop.widthScroll > wndW)
                            drop.css('width', wndW - w + ws - $.drop.widthScroll);
                        if (h > wndH)
                            drop.css('height', wndH - h + hs);
                    }
                }
            });
            return drop;
        },
        galleries: function($this, set, methods) {
            var elSet = $this.data(),
                    relO = $this.get(0).rel;

            if (relO !== '' && relO !== undefined) {
                var source = methods._checkProp(elSet, set, 'source') || $this.attr('href'),
                        next = methods._checkProp(elSet, set, 'next'),
                        prev = methods._checkProp(elSet, set, 'prev'),
                        cycle = methods._checkProp(elSet, set, 'cycle'),
                        rel = relO.replace(/[^a-zA-Z0-9]+/ig, ''),
                        relA = $.drop.drp.galleries[rel],
                        drop = $('[data-elrun][data-rel="' + rel + '"]');

                if (relA !== undefined) {
                    var relL = relA.length,
                            relP = $.inArray(source ? source : drop.find($(methods._checkProp(elSet, set, 'placePaste'))).find('img').attr('src'), relA);
                    $(prev).add($(next)).hide().attr('disabled', 'disabled');
                    if (relP >= 0 && relP !== relL - 1)
                        $(next).show().removeAttr('disabled');
                    if (relP <= relL - 1 && relP !== 0)
                        $(prev).show().removeAttr('disabled');
                    if (cycle)
                        $(prev).add($(next)).show().removeAttr('disabled');
                }
                $(prev).add($(next)).attr('data-rel', rel).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    var $thisB = $(this).attr('disabled', 'disabled'),
                            relNext = relP + ($thisB.is(prev) ? -1 : 1);
                    if (cycle) {
                        if (relNext >= relL)
                            relNext = 0;
                        if (relNext < 0)
                            relNext = relL - 1;
                    }
                    if (relA[relNext]) {
                        var $this = $('[data-source="' + relA[relP] + '"][rel], [href="' + relA[relP] + '"][rel]').filter(':last'),
                                $next = $('[data-source="' + relA[relNext] + '"][rel], [href="' + relA[relNext] + '"][rel]').filter(':last');

                        methods.close($($this.data('drop')), undefined, function() {
                            methods.open({}, undefined, $next);
                        });
                    }
                });
            }
        },
        placeBeforeShow: function(drop, $this, methods, place, placeBeforeShow) {
            if (place !== 'inherit') {
                var pmt = placeBeforeShow.toLowerCase().split(' '),
                        t = -drop.actual('outerHeight'),
                        l = -drop.actual('outerWidth');

                if (pmt[0] === 'center' || pmt[1] === 'center') {
                    methods._checkMethod(function() {
                        methods[place](drop, true);
                    });
                    t = drop.css('top');
                    l = drop.css('left');
                }
                if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                    t = wnd.height();
                if (pmt[0] === 'right' || pmt[1] === 'right')
                    l = wnd.width();
                if (pmt[0] === 'center' || pmt[1] === 'center') {
                    if (pmt[0] === 'left')
                        l = -drop.actual('outerWidth');
                    if (pmt[0] === 'right')
                        l = wnd.width();
                    if (pmt[1] === 'top')
                        t = -drop.actual('outerHeight');
                    if (pmt[1] === 'bottom')
                        t = wnd.height();
                }
                drop.css({
                    'left': l, 'top': t
                });
                if (pmt[0] === 'inherit')
                    drop.css({
                        'left': $this.offset().left,
                        'top': $this.offset().top
                    });
            }
        },
        placeAfterClose: function(drop, $this, set) {
            var
                    method = set.animate ? 'animate' : 'css',
                    pmt = set.placeAfterClose.toLowerCase().split(' '),
                    t = -drop.actual('outerHeight'),
                    l = -drop.actual('outerWidth');

            if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                t = wnd.height();
            if (pmt[0] === 'right' || pmt[1] === 'right')
                l = wnd.width();
            if (pmt[0] === 'center' || pmt[1] === 'center') {
                if (pmt[0] === 'left') {
                    l = -drop.actual('outerWidth');
                    t = drop.css('top');
                }
                if (pmt[0] === 'right') {
                    l = wnd.width();
                    t = drop.css('top');
                }
                if (pmt[1] === 'top') {
                    t = -drop.actual('outerHeight');
                    l = drop.css('left');
                }
                if (pmt[1] === 'bottom') {
                    t = wnd.height();
                    l = drop.css('left');
                }
            }
            if (pmt[0] !== 'center' || pmt[1] !== 'center')
                drop.stop()[method]({
                    'top': t,
                    'left': l
                }, {
                    queue: false,
                    duration: set.durationOff
                });
            if (pmt[0] === 'inherit')
                drop.stop()[method]({
                    'left': $this.offset().left,
                    'top': $this.offset().top
                }, {
                    queue: false,
                    duration: set.durationOff
                });
        },
        confirmPrompt: function(source, methods, elSet, opt, hashChange, _confirmF, e) {
            var prompt = methods._checkProp(elSet, opt, 'prompt'),
                    confirm = methods._checkProp(elSet, opt, 'confirm');
            if (confirm) {
                var confirmBtnDrop = methods._checkProp(elSet, opt, 'confirmBtnDrop'),
                        confirmPattern = methods._checkProp(elSet, opt, 'patternConfirm');

                if (!$.exists('[data-drop="' + confirmBtnDrop + '"]'))
                    var confirmBtn = $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', confirmBtnDrop);
                else
                    confirmBtn = $('[data-drop="' + confirmBtnDrop + '"]');

                confirmBtn.data({
                    'drop': confirmBtnDrop,
                    'confirm': true
                });
                if (!$.exists(confirmBtnDrop))
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, confirmBtn.data()), confirmPattern);
                else
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, confirmBtn.data()), $(confirmBtnDrop));
                setTimeout(function() {
                    methods._show(confirmBtn, e, opt, false, hashChange);
                });
                $(methods._checkProp(elSet, opt, 'confirmActionBtn')).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    if (elSet.after)
                        $(confirmBtnDrop).data({
                            'drp': $.extend($(confirmBtnDrop).data('drp'), {
                                'elClosed': elSet.after
                            })
                        });
                    methods.close($(confirmBtnDrop));
                    if (source)
                        _confirmF();
                });
            }
            if (prompt) {
                var promptPattern = methods._checkProp(elSet, opt, 'patternPrompt'),
                        promptBtnDrop = methods._checkProp(elSet, opt, 'promptBtnDrop');

                if (!$.exists('[data-drop="' + promptBtnDrop + '"]'))
                    var promptBtn = $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', promptBtnDrop);
                else
                    promptBtn = $('[data-drop="' + promptBtnDrop + '"]');

                promptBtn.data({
                    'drop': promptBtnDrop,
                    'prompt': true,
                    'promptInputValue': methods._checkProp(elSet, opt, 'promptInputValue')
                });

                if (!$.exists(promptBtnDrop))
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, promptBtn.data()), promptPattern);
                else
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, promptBtn.data()), $(promptBtnDrop));
                setTimeout(function() {
                    methods._show(promptBtn, e, opt, false, hashChange);
                }, 0);
                $(methods._checkProp(elSet, opt, 'promptActionBtn')).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    if (elSet.after)
                        $(promptBtnDrop).data({
                            'drp': $.extend($(promptBtnDrop).data('drp'), {
                                'elClosed': elSet.after
                            })
                        });
                    methods.close($(promptBtnDrop));
                    function getUrlVars(url) {
                        var hash, myJson = {}, hashes = url.slice(url.indexOf('?') + 1).split('&');
                        for (var i = 0; i < hashes.length; i++) {
                            hash = hashes[i].split('=');
                            myJson[hash[0]] = hash[1];
                        }
                        return myJson;
                    }

                    elSet.dataPrompt = getUrlVars($(this).closest('form').serialize());
                    if (source)
                        _confirmF();
                });
            }
        }
    };
    var newMethods = {};
    for (var i = 0, length = arguments.length; i < length; i++) {
        if (arguments[i] in addmethods) {
            newMethods[arguments[i]] = addmethods[arguments[i]];
        }
    }
    this.setMethods(newMethods);
    return this;
};
/*
 *imagecms shop plugins
 **/
if (!Array.indexOf)
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0); i < this.length; i++) {
            if (this[i] === obj) {
                return i;
            }
        }
        return -1;
    };
if (!Object.keys)
    Object.prototype.keys = function(obj) {
        var keys = [];
        for (var i in obj) {
            if (obj.hasOwnProperty(i))
                keys.push(i);
        }
        return keys;
    };
var Shop = {
    Cart: {
        baseUrl: siteUrl + 'shop/cart/api/',
        xhr: {
        },
        add: function(obj, id, kit) {
            var method = kit ? 'addKit' : 'addProductByVariantId';
            $(document).trigger({
                'type': 'beforeAdd.Cart',
                'id': id,
                'kit': kit
            });
            if (this.xhr['add' + id])
                this.xhr['add' + id].abort();
            this.xhr['add' + id] = $.ajax({
                'type': 'get',
                'url': this.baseUrl + method + '/' + id,
                'data': obj,
                success: function(data) {
                    $(document).trigger({
                        'type': 'add.Cart',
                        'datas': JSON.parse(data),
                        'id': id,
                        'kit': kit,
                        'obj': obj
                    });
                }
            });
            return this;
        },
        remove: function(id, kit) {
            var method = kit ? 'removeKit' : 'removeProductByVariantId';
            $(document).trigger({
                'type': 'beforeRemove.Cart',
                'id': id,
                'kit': kit
            });
            if (this.xhr['remove' + id])
                this.xhr['remove' + id].abort();
            this.xhr['remove' + id] = $.getJSON(this.baseUrl + method + '/' + id, function(data) {
                $(document).trigger({
                    'type': 'remove.Cart',
                    'datas': data,
                    'id': id,
                    'kit': kit
                });
            });
            return this;
        },
        getAmount: function(kit, id) {
            $(document).trigger({
                'type': 'beforeGetAmount.Cart',
                'kit': kit,
                'id': id
            });
            if (this.xhr['amount' + id])
                this.xhr['amount' + id].abort();
            this.xhr['amount' + id] = $.ajax({
                'type': 'post',
                'url': this.baseUrl + 'getAmountInCart',
                'data': {
                    'id': id,
                    'instance': kit ? 'ShopKit' : 'SProducts'
                },
                success: function(data) {
                    $(document).trigger({
                        'type': 'getAmount.Cart',
                        'kit': kit,
                        'id': id,
                        'datas': data
                    });
                }
            });
            return this;
        },
        changeCount: function(count, id, kit) {
            var method = kit ? 'setQuantityKitById' : 'setQuantityProductByVariantId';
            $(document).trigger({
                'type': 'beforeChange.Cart',
                'count': count,
                'kit': kit,
                'id': id
            });
            if (this.xhr['count' + id])
                this.xhr['count' + id].abort();
            this.xhr['count' + id] = $.ajax({
                'type': 'get',
                'url': this.baseUrl + method + '/' + id,
                'data': {
                    'quantity': count
                },
                success: function(data) {
                    $(document).trigger({
                        'type': 'сhange.Cart',
                        'datas': JSON.parse(data),
                        'count': count,
                        'kit': kit,
                        'id': id
                    });
                }
            });
            return this;
        },
        getPayment: function(id, tpl) {
            tpl = tpl ? tpl : '';
            $(document).trigger({
                'type': 'beforeGetPayment.Cart',
                'id': id,
                'datas': tpl
            });
            if (this.xhr['payment'])
                this.xhr['payment'].abort();
            this.xhr['payment'] = $.get(siteUrl + 'shop/order/getPaymentsMethodsTpl/' + id + '/' + tpl, function(data) {
                $(document).trigger({
                    'type': 'getPayment.Cart',
                    'id': id,
                    'datas': data
                });
            });
            return this;
        },
        getTpl: function(obj, objF) {
            $(document).trigger({
                'type': 'beforeGetTpl.Cart',
                'obj': obj,
                'objF': objF
            });
            if (this.xhr[obj.template])
                this.xhr[obj.template].abort();
            this.xhr[obj.template] = $.ajax({
                'type': 'post',
                'url': siteUrl + 'shop/cart',
                'data': obj,
                success: function(data) {
                    $(document).trigger({
                        'type': 'getTpl.Cart',
                        'obj': obj,
                        'objF': objF,
                        'datas': data
                    });
                }
            });
            return this;
        },
        composeCartItem: function($context) {
            var cartItem = {},
                    data = $context.data();
            for (var i in data)
                cartItem[i] = data[i];
            return cartItem;
        }
    },
    CompareList: {
        items: [],
        all: function() {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add: function(key) {
            var _self = this;
            _self.items = _self.all();
            $(document).trigger({
                type: 'before_add_to_compare'
            });
            if (_self.items.indexOf(key) === -1) {
                $.getJSON(siteUrl + 'shop/compare_api/add/' + key, function(data) {
                    if (data.success) {
                        data.id = key;
                        _self.items.push(key);
                        localStorage.setItem('compareList', JSON.stringify(_self.items));
                        $(document).trigger({
                            type: 'compare_list_add',
                            dataObj: data
                        });
                        returnMsg("=== add Compare Item. call compare_list_add ===");
                    }
                    else {
                        returnMsg("=== Error. add Compare ===");
                        $(document).trigger('hideActivity');
                    }
                    try {
                        var dataObj = JSON.parse(data);

                    } catch (e) {
                    }
                });
            }
            return _self;
        },
        rm: function(key, el) {
            var _self = this;
            _self.items = _self.all();
            $(document).trigger({
                type: 'before_delete_compare'
            });
            if (_self.items.indexOf(key) !== -1) {
                _self.items = _.without(_self.items, key);
                _self.items = _self.all();
                $.getJSON(siteUrl + 'shop/compare_api/remove/' + key, function(data) {
                    if (data.success) {
                        data.id = key;
                        _self.items = _.without(_self.items, key);
                        localStorage.setItem('compareList', JSON.stringify(_self.items));
                        $(document).trigger({
                            type: 'compare_list_rm',
                            dataObj: data,
                            el: $(el)
                        });
                        returnMsg("=== remove Compare Item. call compare_list_rm ===");
                    }
                    else {
                        returnMsg("=== Error. remove Compare Item ===");
                        $(document).trigger('hideActivity');
                    }
                });
            }
            return _self;
        },
        sync: function() {
            $.getJSON(siteUrl + 'shop/compare_api/sync', function(data) {
                if (typeof data === 'object' || typeof data === 'Array') {
                    localStorage.setItem('compareList', JSON.stringify(data));
                }
                else if (data === false) {
                    localStorage.removeItem('compareList');
                }
                $(document).trigger({
                    type: 'compare_list_sync',
                    dataObj: data
                });
                returnMsg("=== Compare sync. call compare_list_sync ===");
            });
            return this;
        }
    }
};
if (typeof (wishList) !== 'object')
    var wishList = {
        all: function() {
            try {
                return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [];
            } catch (err) {
                return [];
            }
        },
        sync: function() {
            $.get('/wishlist/wishlistApi/sync', function(data) {
                localStorage.setItem('wishList', data);
                $(document).trigger({
                    'type': 'wish_list_sync',
                    dataObj: data
                });
                returnMsg("=== WishList sync. call wish_list_sync ===");
            });
        }
    };
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
        return imageCmsApiDefaults;
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
var
        isTouch = 'ontouchstart' in document.documentElement,
        wnd = $(window),
        body = $('body'),
        ie = $.browser.msie,
        ieV = $.browser.version,
        ltie7 = ie && (ieV <= 7),
        ltie8 = ie && (ieV <= 8),
        checkProdStock = checkProdStock === "" ? false : true,
        hrefCategoryProduct = hrefCategoryProduct ? hrefCategoryProduct : undefined;

var optionsMenu = {
    item: 'td',
    duration: 200,
    drop: '.frame-item-menu > .frame-drop-menu',
    //direction: 'left', //when menu place left and drop go to right (if vertical menu)

    //if need column partition level 2
    columnPart: true,
    columnClassPref: 'column_',
    //if need column partition level 3
    columnPart2: true,
    columnClassPref2: 'column2_',
    maxC: 5,
    effectOn: 'show',
    effectOff: 'hide',
    effectOnS: 'fadeIn',
    effectOffS: 'fadeOut',
    durationOn: 200,
    durationOff: 100,
    durationOnS: 100,
    durationOffS: 100,
    animatesub3: true,
    sub3Frame: '.frame-l2',
    evLF: 'hover',
    evLS: 'hover',
    frAClass: 'hoverM', //active class

    menuCache: true,
    activeFl: '.frame-item-menu > .frame-title > a', //
    parentTl: '.frame-l2', //prev a level 2
    otherPage: hrefCategoryProduct, //for product [undefined or value not other]

    vertical: false
};
if (typeMenu === 'col')
    optionsMenu.countColumn = 5; //if not drop-side
if (typeMenu === 'row') {
    optionsMenu.sub2Frame = '.frame-l2'; //if drop-side
    optionsMenu.dropWidth = 475; //if not define than will be actual width needs when drop-side
}
var scrollPane = {
    animateScroll: true,
    showArrows: true,
    arrowButtonSpeed: 256
};
var carousel = {
    prev: '.prev',
    next: '.next',
    content: '.content-carousel',
    groupButtons: '.group-button-carousel',
    vCarousel: '.vertical-carousel',
    hCarousel: '.horizontal-carousel'
};
var optionsCycle = {
    speed: 600,
    timeout: 5000,
    fx: 'fade',
    pauseOnPagerHover: true,
    pagerAnchorBuilder: function(idx, slide) {
        return '<a href="#"></a>';
    }
};
var optionsDrop = {
    overlayColor: '#000',
    overlayOpacity: 0.6,
    place: 'center', //noinherit(default) || inherit(ex. for ViewedProducts)
    durationOn: 500,
    durationOff: 200,
    dropContent: '.drop-content',
    dropFooter: '.drop-footer',
    dropHeader: '.drop-header',
    animate: true,
    timeclosemodal: 2000,
    modalPlace: '.notification',
    moreOne: false,
    closeClick: true,
    closeEsc: true,
    position: 'absolute',
    confirmBtnDrop: '#confirm',
    limitSize: true,
    limitContentSize: true,
    scrollContent: true,
    keyNavigate: true,
    cycle: true
};
var productStatus = {
    action: '<span class="product-status action"></span>',
    hit: '<span class="product-status hit"></span>',
    hot: '<span class="product-status nowelty"></span>',
    disc: function(disc) {
        return '<span class="product-status discount"><span class="text-el">' + disc.toFixed(0) + '%</span></span>';
    }
};
var imageCmsApiDefaults = {
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
                        </span></div>';
    },
    captchaBlock: '#captcha_block',
    cMsg: function(name, text, classN, form) {
        form.find('[for="' + name + '"]').remove();
        return '<label for="' + name + '" class="for_validations ' + classN + '">' + text + '</label>';
    }
// callback (callback accept (msg, status, form, DS)) where DS - imageCmsApiDefaults and "any other" ex. report_appereance has drop:".drop-report" if callback return true form hide
// any other
};
var icons = {
    icon_enter: "M18.386,16.009l0.009-0.006l-0.58-0.912c1.654-2.226,1.876-5.319,0.3-7.8c-2.043-3.213-6.303-4.161-9.516-2.118c-3.212,2.042-4.163,6.302-2.12,9.517c1.528,2.402,4.3,3.537,6.944,3.102l0.424,0.669l0.206,0.045l0.779-0.447l-0.305,1.377l2.483,0.552l-0.296,1.325l1.903,0.424l-0.68,3.06l1.406,0.313l-0.424,1.906l4.135,0.918l0.758-3.392L18.386,16.009z M10.996,8.944c-0.685,0.436-1.593,0.233-2.029-0.452C8.532,7.807,8.733,6.898,9.418,6.463s1.594-0.233,2.028,0.452C11.883,7.6,11.68,8.509,10.996,8.944z",
    icon_reg: "M20.771,12.364c0,0,0.849-3.51,0-4.699c-0.85-1.189-1.189-1.981-3.058-2.548s-1.188-0.454-2.547-0.396c-1.359,0.057-2.492,0.792-2.492,1.188c0,0-0.849,0.057-1.188,0.397c-0.34,0.34-0.906,1.924-0.906,2.321s0.283,3.058,0.566,3.624l-0.337,0.113c-0.283,3.283,1.132,3.68,1.132,3.68c0.509,3.058,1.019,1.756,1.019,2.548s-0.51,0.51-0.51,0.51s-0.452,1.245-1.584,1.698c-1.132,0.452-7.416,2.886-7.927,3.396c-0.511,0.511-0.453,2.888-0.453,2.888h26.947c0,0,0.059-2.377-0.452-2.888c-0.512-0.511-6.796-2.944-7.928-3.396c-1.132-0.453-1.584-1.698-1.584-1.698s-0.51,0.282-0.51-0.51s0.51,0.51,1.02-2.548c0,0,1.414-0.397,1.132-3.68H20.771z",
    icon_skype: "M28.777,18.438c0.209-0.948,0.318-1.934,0.318-2.944c0-7.578-6.144-13.722-13.724-13.722c-0.799,0-1.584,0.069-2.346,0.2C11.801,1.199,10.35,0.75,8.793,0.75c-4.395,0-7.958,3.562-7.958,7.958c0,1.47,0.399,2.845,1.094,4.024c-0.183,0.893-0.277,1.814-0.277,2.76c0,7.58,6.144,13.723,13.722,13.723c0.859,0,1.699-0.078,2.515-0.23c1.119,0.604,2.399,0.945,3.762,0.945c4.395,0,7.957-3.562,7.957-7.959C29.605,20.701,29.309,19.502,28.777,18.438zM22.412,22.051c-0.635,0.898-1.573,1.609-2.789,2.115c-1.203,0.5-2.646,0.754-4.287,0.754c-1.971,0-3.624-0.346-4.914-1.031C9.5,23.391,8.74,22.717,8.163,21.885c-0.583-0.842-0.879-1.676-0.879-2.479c0-0.503,0.192-0.939,0.573-1.296c0.375-0.354,0.857-0.532,1.432-0.532c0.471,0,0.878,0.141,1.209,0.422c0.315,0.269,0.586,0.662,0.805,1.174c0.242,0.558,0.508,1.027,0.788,1.397c0.269,0.355,0.656,0.656,1.151,0.89c0.497,0.235,1.168,0.354,1.992,0.354c1.135,0,2.064-0.241,2.764-0.721c0.684-0.465,1.016-1.025,1.016-1.711c0-0.543-0.173-0.969-0.529-1.303c-0.373-0.348-0.865-0.621-1.465-0.807c-0.623-0.195-1.47-0.404-2.518-0.623c-1.424-0.306-2.634-0.668-3.596-1.076c-0.984-0.419-1.777-1-2.357-1.727c-0.59-0.736-0.889-1.662-0.889-2.75c0-1.036,0.314-1.971,0.933-2.776c0.613-0.8,1.51-1.423,2.663-1.849c1.139-0.422,2.494-0.635,4.027-0.635c1.225,0,2.303,0.141,3.201,0.421c0.904,0.282,1.668,0.662,2.267,1.13c0.604,0.472,1.054,0.977,1.335,1.5c0.284,0.529,0.43,1.057,0.43,1.565c0,0.49-0.189,0.937-0.563,1.324c-0.375,0.391-0.851,0.589-1.408,0.589c-0.509,0-0.905-0.124-1.183-0.369c-0.258-0.227-0.523-0.58-0.819-1.09c-0.342-0.65-0.756-1.162-1.229-1.523c-0.463-0.351-1.232-0.529-2.292-0.529c-0.984,0-1.784,0.197-2.379,0.588c-0.572,0.375-0.85,0.805-0.85,1.314c0,0.312,0.09,0.574,0.273,0.799c0.195,0.238,0.471,0.447,0.818,0.621c0.36,0.182,0.732,0.326,1.104,0.429c0.382,0.106,1.021,0.263,1.899,0.466c1.11,0.238,2.131,0.506,3.034,0.793c0.913,0.293,1.703,0.654,2.348,1.072c0.656,0.429,1.178,0.979,1.547,1.635c0.369,0.658,0.558,1.471,0.558,2.416C23.371,20.119,23.049,21.148,22.412,22.051z",
    icon_mail: "M28.516,7.167H3.482l12.517,7.108L28.516,7.167zM16.74,17.303C16.51,17.434,16.255,17.5,16,17.5s-0.51-0.066-0.741-0.197L2.5,10.06v14.773h27V10.06L16.74,17.303z",
    icon_search: "M29.772,26.433l-7.126-7.126c0.96-1.583,1.523-3.435,1.524-5.421C24.169,8.093,19.478,3.401,13.688,3.399C7.897,3.401,3.204,8.093,3.204,13.885c0,5.789,4.693,10.481,10.484,10.481c1.987,0,3.839-0.563,5.422-1.523l7.128,7.127L29.772,26.433zM7.203,13.885c0.006-3.582,2.903-6.478,6.484-6.486c3.579,0.008,6.478,2.904,6.484,6.486c-0.007,3.58-2.905,6.476-6.484,6.484C10.106,20.361,7.209,17.465,7.203,13.885z",
    icon_cleaner: "M29.02,11.754L8.416,9.473L7.16,4.716C7.071,4.389,6.772,4.158,6.433,4.158H3.341C3.114,3.866,2.775,3.667,2.377,3.667c-0.686,0-1.242,0.556-1.242,1.242c0,0.686,0.556,1.242,1.242,1.242c0.399,0,0.738-0.201,0.965-0.493h2.512l5.23,19.8c-0.548,0.589-0.891,1.373-0.891,2.242c0,1.821,1.473,3.293,3.293,3.293c1.82,0,3.294-1.472,3.297-3.293c0-0.257-0.036-0.504-0.093-0.743h5.533c-0.056,0.239-0.092,0.486-0.092,0.743c0,1.821,1.475,3.293,3.295,3.293s3.295-1.472,3.295-3.293c0-1.82-1.473-3.295-3.295-3.297c-0.951,0.001-1.801,0.409-2.402,1.053h-7.136c-0.601-0.644-1.451-1.052-2.402-1.053c-0.379,0-0.738,0.078-1.077,0.196l-0.181-0.685H26.81c1.157-0.027,2.138-0.83,2.391-1.959l1.574-7.799c0.028-0.145,0.041-0.282,0.039-0.414C30.823,12.733,30.051,11.86,29.02,11.754zM25.428,27.994c-0.163,0-0.295-0.132-0.297-0.295c0.002-0.165,0.134-0.297,0.297-0.297s0.295,0.132,0.297,0.297C25.723,27.862,25.591,27.994,25.428,27.994zM27.208,20.499l0.948-0.948l-0.318,1.578L27.208,20.499zM12.755,11.463l1.036,1.036l-1.292,1.292l-1.292-1.292l1.087-1.087L12.755,11.463zM17.253,11.961l0.538,0.538l-1.292,1.292l-1.292-1.292l0.688-0.688L17.253,11.961zM9.631,14.075l0.868-0.868l1.292,1.292l-1.292,1.292l-0.564-0.564L9.631,14.075zM9.335,12.956l-0.328-1.24L9.792,12.5L9.335,12.956zM21.791,16.499l-1.292,1.292l-1.292-1.292l1.292-1.292L21.791,16.499zM21.207,14.5l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,14.5zM18.5,15.791l-1.293-1.292l1.292-1.292l1.292,1.292L18.5,15.791zM17.791,16.499L16.5,17.791l-1.292-1.292l1.292-1.292L17.791,16.499zM14.499,15.791l-1.292-1.292l1.292-1.292l1.292,1.292L14.499,15.791zM13.791,16.499l-1.292,1.291l-1.292-1.291l1.292-1.292L13.791,16.499zM10.499,17.207l1.292,1.292l-0.785,0.784l-0.54-2.044L10.499,17.207zM11.302,20.404l1.197-1.197l1.292,1.292L12.5,21.791l-1.131-1.13L11.302,20.404zM13.208,18.499l1.291-1.292l1.292,1.292L14.5,19.791L13.208,18.499zM16.5,19.207l1.292,1.292L16.5,21.79l-1.292-1.291L16.5,19.207zM17.208,18.499l1.292-1.292l1.291,1.292L18.5,19.79L17.208,18.499zM20.499,19.207l1.292,1.292L20.5,21.79l-1.292-1.292L20.499,19.207zM21.207,18.499l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,18.499zM23.207,16.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,16.499zM25.207,14.499l1.292-1.292L27.79,14.5l-1.291,1.292L25.207,14.499zM24.499,13.792l-1.156-1.156l2.082,0.23L24.499,13.792zM21.791,12.5l-1.292,1.292L19.207,12.5l0.29-0.29l2.253,0.25L21.791,12.5zM14.5,11.791l-0.152-0.152l0.273,0.03L14.5,11.791zM10.5,11.792l-0.65-0.65l1.171,0.129L10.5,11.792zM14.5,21.207l1.205,1.205h-2.409L14.5,21.207zM18.499,21.207l1.206,1.206h-2.412L18.499,21.207zM22.499,21.207l1.208,1.207l-2.414-0.001L22.499,21.207zM23.207,20.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,20.499zM25.207,18.499l1.292-1.291l1.291,1.291l-1.291,1.292L25.207,18.499zM28.499,17.791l-1.291-1.292l1.291-1.291l0.444,0.444l-0.429,2.124L28.499,17.791zM29.001,13.289l-0.502,0.502l-0.658-0.658l1.016,0.112C28.911,13.253,28.956,13.271,29.001,13.289zM13.487,27.994c-0.161,0-0.295-0.132-0.295-0.295c0-0.165,0.134-0.297,0.295-0.297c0.163,0,0.296,0.132,0.296,0.297C13.783,27.862,13.651,27.994,13.487,27.994zM26.81,22.414h-1.517l1.207-1.207l0.93,0.93C27.243,22.306,27.007,22.428,26.81,22.414z",
    icon_cleaner_buy: "M29.02,11.754L8.416,9.473L7.16,4.716C7.071,4.389,6.772,4.158,6.433,4.158H3.341C3.114,3.866,2.775,3.667,2.377,3.667c-0.686,0-1.242,0.556-1.242,1.242c0,0.686,0.556,1.242,1.242,1.242c0.399,0,0.738-0.201,0.965-0.493h2.512l5.23,19.8c-0.548,0.589-0.891,1.373-0.891,2.242c0,1.821,1.473,3.293,3.293,3.293c1.82,0,3.294-1.472,3.297-3.293c0-0.257-0.036-0.504-0.093-0.743h5.533c-0.056,0.239-0.092,0.486-0.092,0.743c0,1.821,1.475,3.293,3.295,3.293s3.295-1.472,3.295-3.293c0-1.82-1.473-3.295-3.295-3.297c-0.951,0.001-1.801,0.409-2.402,1.053h-7.136c-0.601-0.644-1.451-1.052-2.402-1.053c-0.379,0-0.738,0.078-1.077,0.196l-0.181-0.685H26.81c1.157-0.027,2.138-0.83,2.391-1.959l1.574-7.799c0.028-0.145,0.041-0.282,0.039-0.414C30.823,12.733,30.051,11.86,29.02,11.754zM25.428,27.994c-0.163,0-0.295-0.132-0.297-0.295c0.002-0.165,0.134-0.297,0.297-0.297s0.295,0.132,0.297,0.297C25.723,27.862,25.591,27.994,25.428,27.994zM27.208,20.499l0.948-0.948l-0.318,1.578L27.208,20.499zM12.755,11.463l1.036,1.036l-1.292,1.292l-1.292-1.292l1.087-1.087L12.755,11.463zM17.253,11.961l0.538,0.538l-1.292,1.292l-1.292-1.292l0.688-0.688L17.253,11.961zM9.631,14.075l0.868-0.868l1.292,1.292l-1.292,1.292l-0.564-0.564L9.631,14.075zM9.335,12.956l-0.328-1.24L9.792,12.5L9.335,12.956zM21.791,16.499l-1.292,1.292l-1.292-1.292l1.292-1.292L21.791,16.499zM21.207,14.5l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,14.5zM18.5,15.791l-1.293-1.292l1.292-1.292l1.292,1.292L18.5,15.791zM17.791,16.499L16.5,17.791l-1.292-1.292l1.292-1.292L17.791,16.499zM14.499,15.791l-1.292-1.292l1.292-1.292l1.292,1.292L14.499,15.791zM13.791,16.499l-1.292,1.291l-1.292-1.291l1.292-1.292L13.791,16.499zM10.499,17.207l1.292,1.292l-0.785,0.784l-0.54-2.044L10.499,17.207zM11.302,20.404l1.197-1.197l1.292,1.292L12.5,21.791l-1.131-1.13L11.302,20.404zM13.208,18.499l1.291-1.292l1.292,1.292L14.5,19.791L13.208,18.499zM16.5,19.207l1.292,1.292L16.5,21.79l-1.292-1.291L16.5,19.207zM17.208,18.499l1.292-1.292l1.291,1.292L18.5,19.79L17.208,18.499zM20.499,19.207l1.292,1.292L20.5,21.79l-1.292-1.292L20.499,19.207zM21.207,18.499l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,18.499zM23.207,16.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,16.499zM25.207,14.499l1.292-1.292L27.79,14.5l-1.291,1.292L25.207,14.499zM24.499,13.792l-1.156-1.156l2.082,0.23L24.499,13.792zM21.791,12.5l-1.292,1.292L19.207,12.5l0.29-0.29l2.253,0.25L21.791,12.5zM14.5,11.791l-0.152-0.152l0.273,0.03L14.5,11.791zM10.5,11.792l-0.65-0.65l1.171,0.129L10.5,11.792zM14.5,21.207l1.205,1.205h-2.409L14.5,21.207zM18.499,21.207l1.206,1.206h-2.412L18.499,21.207zM22.499,21.207l1.208,1.207l-2.414-0.001L22.499,21.207zM23.207,20.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,20.499zM25.207,18.499l1.292-1.291l1.291,1.291l-1.291,1.292L25.207,18.499zM28.499,17.791l-1.291-1.292l1.291-1.291l0.444,0.444l-0.429,2.124L28.499,17.791zM29.001,13.289l-0.502,0.502l-0.658-0.658l1.016,0.112C28.911,13.253,28.956,13.271,29.001,13.289zM13.487,27.994c-0.161,0-0.295-0.132-0.295-0.295c0-0.165,0.134-0.297,0.295-0.297c0.163,0,0.296,0.132,0.296,0.297C13.783,27.862,13.651,27.994,13.487,27.994zM26.81,22.414h-1.517l1.207-1.207l0.93,0.93C27.243,22.306,27.007,22.428,26.81,22.414z",
    icon_arrow: "M11.166,23.963L22.359,17.5c1.43-0.824,1.43-2.175,0-3L11.166,8.037c-1.429-0.826-2.598-0.15-2.598,1.5v12.926C8.568,24.113,9.737,24.789,11.166,23.963z",
    icon_arrow_n: "M10.129,22.186 16.316,15.999 10.129,9.812 13.665,6.276 23.389,15.999 13.665,25.725z",
    icon_arrow_p: "M21.871,9.814 15.684,16.001 21.871,22.188 18.335,25.725 8.612,16.001 18.335,6.276z",
    icon_time: "M15.5,2.374C8.251,2.375,2.376,8.251,2.374,15.5C2.376,22.748,8.251,28.623,15.5,28.627c7.249-0.004,13.124-5.879,13.125-13.127C28.624,8.251,22.749,2.375,15.5,2.374zM15.5,25.623C9.909,25.615,5.385,21.09,5.375,15.5C5.385,9.909,9.909,5.384,15.5,5.374c5.59,0.01,10.115,4.535,10.124,10.125C25.615,21.09,21.091,25.615,15.5,25.623zM8.625,15.5c-0.001-0.552-0.448-0.999-1.001-1c-0.553,0-1,0.448-1,1c0,0.553,0.449,1,1,1C8.176,16.5,8.624,16.053,8.625,15.5zM8.179,18.572c-0.478,0.277-0.642,0.889-0.365,1.367c0.275,0.479,0.889,0.641,1.365,0.365c0.479-0.275,0.643-0.887,0.367-1.367C9.27,18.461,8.658,18.297,8.179,18.572zM9.18,10.696c-0.479-0.276-1.09-0.112-1.366,0.366s-0.111,1.09,0.365,1.366c0.479,0.276,1.09,0.113,1.367-0.366C9.821,11.584,9.657,10.973,9.18,10.696zM22.822,12.428c0.478-0.275,0.643-0.888,0.366-1.366c-0.275-0.478-0.89-0.642-1.366-0.366c-0.479,0.278-0.642,0.89-0.366,1.367C21.732,12.54,22.344,12.705,22.822,12.428zM12.062,21.455c-0.478-0.275-1.089-0.111-1.366,0.367c-0.275,0.479-0.111,1.09,0.366,1.365c0.478,0.277,1.091,0.111,1.365-0.365C12.704,22.344,12.54,21.732,12.062,21.455zM12.062,9.545c0.479-0.276,0.642-0.888,0.366-1.366c-0.276-0.478-0.888-0.642-1.366-0.366s-0.642,0.888-0.366,1.366C10.973,9.658,11.584,9.822,12.062,9.545zM22.823,18.572c-0.48-0.275-1.092-0.111-1.367,0.365c-0.275,0.479-0.112,1.092,0.367,1.367c0.477,0.275,1.089,0.113,1.365-0.365C23.464,19.461,23.3,18.848,22.823,18.572zM19.938,7.813c-0.477-0.276-1.091-0.111-1.365,0.366c-0.275,0.48-0.111,1.091,0.366,1.367s1.089,0.112,1.366-0.366C20.581,8.702,20.418,8.089,19.938,7.813zM23.378,14.5c-0.554,0.002-1.001,0.45-1.001,1c0.001,0.552,0.448,1,1.001,1c0.551,0,1-0.447,1-1C24.378,14.949,23.929,14.5,23.378,14.5zM15.501,6.624c-0.552,0-1,0.448-1,1l-0.466,7.343l-3.004,1.96c-0.478,0.277-0.642,0.889-0.365,1.365c0.275,0.479,0.889,0.643,1.365,0.367l3.305-1.676C15.39,16.99,15.444,17,15.501,17c0.828,0,1.5-0.671,1.5-1.5l-0.5-7.876C16.501,7.072,16.053,6.624,15.501,6.624zM15.501,22.377c-0.552,0-1,0.447-1,1s0.448,1,1,1s1-0.447,1-1S16.053,22.377,15.501,22.377zM18.939,21.455c-0.479,0.277-0.643,0.889-0.366,1.367c0.275,0.477,0.888,0.643,1.366,0.365c0.478-0.275,0.642-0.889,0.366-1.365C20.028,21.344,19.417,21.18,18.939,21.455z",
    icon_phone_header: "M22.065,18.53c-0.467-0.29-1.167-0.21-1.556,0.179l-3.093,3.092c-0.389,0.389-1.025,0.389-1.414,0L9.05,14.848c-0.389-0.389-0.389-1.025,0-1.414l2.913-2.912c0.389-0.389,0.447-1.075,0.131-1.524L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29c0,0-4.134,3.281-4.134,6.295c0,12.335,10,22.334,22.334,22.334c3.015,0,5.948-5.533,5.948-5.533c0.258-0.486,0.087-1.122-0.38-1.412L22.065,18.53z",
    icon_phone_footer: "M20.755,1H10.62C9.484,1,8.562,1.921,8.562,3.058v24.385c0,1.136,0.921,2.058,2.058,2.058h10.135c1.136,0,2.058-0.922,2.058-2.058V3.058C22.812,1.921,21.891,1,20.755,1zM14.659,3.264h2.057c0.101,0,0.183,0.081,0.183,0.18c0,0.1-0.082,0.18-0.183,0.18h-2.057c-0.1,0-0.181-0.081-0.181-0.18C14.478,3.344,14.559,3.264,14.659,3.264zM13.225,3.058c0.199,0,0.359,0.162,0.359,0.36c0,0.198-0.161,0.36-0.359,0.36c-0.2,0-0.36-0.161-0.36-0.36S13.025,3.058,13.225,3.058zM15.688,28.473c-0.796,0-1.44-0.646-1.44-1.438c0-0.799,0.645-1.439,1.44-1.439s1.44,0.646,1.44,1.439S16.483,28.473,15.688,28.473zM22.041,24.355c0,0.17-0.139,0.309-0.309,0.309H9.642c-0.17,0-0.308-0.139-0.308-0.309V6.042c0-0.17,0.138-0.309,0.308-0.309h12.09c0.17,0,0.309,0.138,0.309,0.309V24.355z",
    icon_phone_product: "M22.065,18.53c-0.467-0.29-1.167-0.21-1.556,0.179l-3.093,3.092c-0.389,0.389-1.025,0.389-1.414,0L9.05,14.848c-0.389-0.389-0.389-1.025,0-1.414l2.913-2.912c0.389-0.389,0.447-1.075,0.131-1.524L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29c0,0-4.134,3.281-4.134,6.295c0,12.335,10,22.334,22.334,22.334c3.015,0,5.948-5.533,5.948-5.533c0.258-0.486,0.087-1.122-0.38-1.412L22.065,18.53z",
    icon_exit: "M24.086,20.904c-1.805,3.113-5.163,5.212-9.023,5.219c-5.766-0.01-10.427-4.672-10.438-10.435C4.636,9.922,9.297,5.261,15.063,5.25c3.859,0.007,7.216,2.105,9.022,5.218l3.962,2.284l0.143,0.082C26.879,6.784,21.504,2.25,15.063,2.248C7.64,2.25,1.625,8.265,1.624,15.688c0.002,7.42,6.017,13.435,13.439,13.437c6.442-0.002,11.819-4.538,13.127-10.589l-0.141,0.081L24.086,20.904zM28.4,15.688l-7.15-4.129v2.297H10.275v3.661H21.25v2.297L28.4,15.688z",
    icon_times_drop: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times_cart: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_wish: "M24.132,7.971c-2.203-2.205-5.916-2.098-8.25,0.235L15.5,8.588l-0.382-0.382c-2.334-2.333-6.047-2.44-8.25-0.235c-2.204,2.203-2.098,5.916,0.235,8.249l8.396,8.396l8.396-8.396C26.229,13.887,26.336,10.174,24.132,7.971z",
    icon_wish_list: "M24.132,7.971c-2.203-2.205-5.916-2.098-8.25,0.235L15.5,8.588l-0.382-0.382c-2.334-2.333-6.047-2.44-8.25-0.235c-2.204,2.203-2.098,5.916,0.235,8.249l8.396,8.396l8.396-8.396C26.229,13.887,26.336,10.174,24.132,7.971z",
    icon_compare_list: "M21.786,12.876l7.556-4.363l-7.556-4.363v2.598H2.813v3.5h18.973V12.876zM10.368,18.124l-7.556,4.362l7.556,4.362V24.25h18.974v-3.501H10.368V18.124z",
    icon_compare: "M21.786,12.876l7.556-4.363l-7.556-4.363v2.598H2.813v3.5h18.973V12.876zM10.368,18.124l-7.556,4.362l7.556,4.362V24.25h18.974v-3.501H10.368V18.124z",
    icon_already_show: "M14.075,9.531c0,0-2.705-1.438-5.158-1.438c-2.453,0-4.862,0.593-4.862,0.593L3.971,9.869c0,0,0.19,0.19,0.528,0.53c0.338,0.336,0.486,3.741,1.838,5.094c1.353,1.354,4.82,1.396,5.963,0.676c1.14-0.718,2.241-3.466,2.241-4.693c0-0.38,0-0.676,0-0.676c0.274-0.275,1.615-0.303,1.917,0c0,0,0,0.296,0,0.676c0,1.227,1.101,3.975,2.241,4.693c1.144,0.72,4.611,0.678,5.963-0.676c1.355-1.353,1.501-4.757,1.839-5.094c0.338-0.34,0.528-0.53,0.528-0.53l-0.084-1.183c0,0-2.408-0.593-4.862-0.593c-2.453,0-5.158,1.438-5.158,1.438C16.319,9.292,14.737,9.32,14.075,9.531z",
    icon_info: "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466z M14.757,8h2.42v2.574h-2.42V8z M18.762,23.622H16.1c-1.034,0-1.475-0.44-1.475-1.496v-6.865c0-0.33-0.176-0.484-0.484-0.484h-0.88V12.4h2.662c1.035,0,1.474,0.462,1.474,1.496v6.887c0,0.309,0.176,0.484,0.484,0.484h0.88V23.622z",
    icon_home: "M27.812,16l-3.062-3.062V5.625h-2.625v4.688L16,4.188L4.188,16L7,15.933v11.942h17.875V16H27.812zM16,26.167h-5.833v-7H16V26.167zM21.667,23.167h-3.833v-4.042h3.833V23.167z",
    icon_list_cat: "M4.082,4.083v2.999h22.835V4.083H4.082zM4.082,20.306h22.835v-2.999H4.082V20.306zM4.082,13.694h22.835v-2.999H4.082V13.694zM4.082,26.917h22.835v-2.999H4.082V26.917z",
    icon_table_cat: "M4.083,14H14V4.083H4.083V14zM17,4.083V14h9.917V4.083H17zM17,26.917h9.917v-9.918H17V26.917zM4.083,26.917H14v-9.918H4.083V26.917z",
    icon_delivery: "M17.078,22.004l-1.758-4.129l-2.007,4.752l-7.519-3.289l0.174,3.905l9.437,4.374l10.909-5.365l-0.149-4.989L17.078,22.004zM29.454,6.619L18.521,3.383l-3.006,2.671l-3.091-2.359L1.546,8.199l3.795,3.048l-3.433,5.302l10.879,4.757l2.53-5.998l2.257,5.308l11.393-5.942l-3.105-4.709L29.454,6.619zM15.277,14.579l-9.059-3.83l9.275-4.101l9.608,3.255L15.277,14.579z",
    icon_payment: "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466z M17.255,23.88v2.047h-1.958v-2.024c-3.213-0.44-4.621-3.08-4.621-3.08l2.002-1.673c0,0,1.276,2.223,3.586,2.223c1.276,0,2.244-0.683,2.244-1.849c0-2.729-7.349-2.398-7.349-7.459c0-2.2,1.738-3.785,4.137-4.159V5.859h1.958v2.046c1.672,0.22,3.652,1.1,3.652,2.993v1.452h-2.596v-0.704c0-0.726-0.925-1.21-1.959-1.21c-1.32,0-2.288,0.66-2.288,1.584c0,2.794,7.349,2.112,7.349,7.415C21.413,21.614,19.785,23.506,17.255,23.88z",
    icon_comment: "M16,5.333c-7.732,0-14,4.701-14,10.5c0,1.982,0.741,3.833,2.016,5.414L2,25.667l5.613-1.441c2.339,1.317,5.237,2.107,8.387,2.107c7.732,0,14-4.701,14-10.5C30,10.034,23.732,5.333,16,5.333z",
    icon_success: "M2.379,14.729 5.208,11.899 12.958,19.648 25.877,6.733 28.707,9.561 12.958,25.308z",
    icon_error: "M26.711,14.086L16.914,4.29c-0.778-0.778-2.051-0.778-2.829,0L4.29,14.086c-0.778,0.778-0.778,2.05,0,2.829l9.796,9.796c0.778,0.777,2.051,0.777,2.829,0l9.797-9.797C27.488,16.136,27.488,14.864,26.711,14.086zM14.702,8.981c0.22-0.238,0.501-0.357,0.844-0.357s0.624,0.118,0.844,0.353c0.221,0.235,0.33,0.531,0.33,0.885c0,0.306-0.101,1.333-0.303,3.082c-0.201,1.749-0.379,3.439-0.531,5.072H15.17c-0.135-1.633-0.301-3.323-0.5-5.072c-0.198-1.749-0.298-2.776-0.298-3.082C14.372,9.513,14.482,9.22,14.702,8.981zM16.431,21.799c-0.247,0.241-0.542,0.362-0.885,0.362s-0.638-0.121-0.885-0.362c-0.248-0.241-0.372-0.533-0.372-0.876s0.124-0.638,0.372-0.885c0.247-0.248,0.542-0.372,0.885-0.372s0.638,0.124,0.885,0.372c0.248,0.247,0.372,0.542,0.372,0.885S16.679,21.558,16.431,21.799z",
    icon_edit: "M25.31,2.872l-3.384-2.127c-0.854-0.536-1.979-0.278-2.517,0.576l-1.334,2.123l6.474,4.066l1.335-2.122C26.42,4.533,26.164,3.407,25.31,2.872zM6.555,21.786l6.474,4.066L23.581,9.054l-6.477-4.067L6.555,21.786zM5.566,26.952l-0.143,3.819l3.379-1.787l3.14-1.658l-6.246-3.925L5.566,26.952z",
    icon_remove: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_arrow_down: "M23.963,20.834L17.5,9.64c-0.825-1.429-2.175-1.429-3,0L8.037,20.834c-0.825,1.429-0.15,2.598,1.5,2.598h12.926C24.113,23.432,24.788,22.263,23.963,20.834z",
    icon_ask: "M26.711,14.086L16.914,4.29c-0.778-0.778-2.051-0.778-2.829,0L4.29,14.086c-0.778,0.778-0.778,2.05,0,2.829l9.796,9.796c0.778,0.777,2.051,0.777,2.829,0l9.797-9.797C27.488,16.136,27.488,14.864,26.711,14.086zM16.431,21.799c-0.248,0.241-0.543,0.362-0.885,0.362c-0.343,0-0.638-0.121-0.886-0.362c-0.247-0.241-0.371-0.533-0.371-0.876s0.124-0.638,0.371-0.885c0.248-0.248,0.543-0.372,0.886-0.372c0.342,0,0.637,0.124,0.885,0.372c0.248,0.247,0.371,0.542,0.371,0.885S16.679,21.558,16.431,21.799zM18.911,15.198c-0.721,0.716-1.712,1.147-2.972,1.294v2.027h-0.844v-3.476c0.386-0.03,0.768-0.093,1.146-0.188c0.38-0.095,0.719-0.25,1.019-0.464c0.312-0.227,0.555-0.5,0.729-0.822c0.174-0.322,0.261-0.77,0.261-1.346c0-0.918-0.194-1.623-0.582-2.113c-0.389-0.49-0.956-0.735-1.701-0.735c-0.281,0-0.527,0.042-0.738,0.124s-0.366,0.16-0.464,0.234c0.031,0.146,0.072,0.357,0.124,0.633c0.052,0.275,0.078,0.486,0.078,0.633c0,0.226-0.098,0.433-0.294,0.619c-0.195,0.187-0.479,0.28-0.853,0.28c-0.33,0-0.565-0.113-0.706-0.339s-0.211-0.489-0.211-0.789c0-0.244,0.067-0.484,0.201-0.72c0.135-0.235,0.346-0.463,0.633-0.684c0.245-0.195,0.577-0.364,0.995-0.504c0.419-0.141,0.854-0.211,1.308-0.211c0.647,0,1.223,0.103,1.724,0.308c0.502,0.205,0.914,0.479,1.238,0.822c0.337,0.355,0.586,0.755,0.748,1.198c0.162,0.444,0.243,0.926,0.243,1.446C19.994,13.558,19.633,14.482,18.911,15.198z"
};
var cuselOptions = {
    changedEl: ".lineForm:visible select",
    visRows: 100,
    scrollArrows: false
};
var message = {
    success: function(text) {
        return '<div class = "msg js-msg"><div class = "success ' + genObj.scs + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
    },
    error: function(text) {
        return '<div class = "msg js-msg"><div class = "error ' + genObj.err + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
    },
    info: function(text) {
        return '<div class = "msg js-msg"><div class = "info ' + genObj.info + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
    }
};
var lazyload = {
    effect: "fadeIn"
};
var optionsPlusminus = {
    prev: 'prev().children(:eq(1)).children()',
    next: 'prev().children(:eq(0)).children()',
    step: 1,
    checkProdStock: checkProdStock
};
$.maxminValue.settings = {
    addCond: checkProdStock
};
/*declaration shop functions*/
//variants
var ShopFront = {
    Cart: {
        processBtnBuyCount: function(id, status, kit, count) {
            var el = $(genObj.btnBuy).filter('[data-id="' + id + '"]').removeAttr('disabled');
            if (kit)
                el = el.filter(genObj.btnBuyKit);

            el.each(function() {
                var el = $(this);
                if (status === 'add') {
                    el.parent(genObj.btnToCart).addClass('d_n');
                    el.parent(genObj.btnInCart).removeClass('d_n');
                    el.closest(genObj.parentBtnBuy).removeClass(genObj.toCart).addClass(genObj.inCart)
                            .find(genObj.frameCount)
                            .find(':input').attr('disabled', 'disabled');
                }
                if (status === 'remove') {
                    el.parent(genObj.btnToCart).removeClass('d_n');
                    el.parent(genObj.btnInCart).addClass('d_n');
                    el.closest(genObj.parentBtnBuy).addClass(genObj.toCart).removeClass(genObj.inCart)
                            .find(genObj.frameCount)
                            .find(':input').removeAttr('disabled', 'disabled')
                            .end().find(genObj.plusMinus).attr('value', function() {
                        return $(this).data('min');
                    });
                }
                if (status === 'change') {
                    el.closest(genObj.parentBtnBuy).find(genObj.frameCount).find('input').attr('value', count);
                }
            });

            decorElemntItemProduct(el.closest(genObj.parentBtnBuy));

            $(document).trigger({
                'type': 'processPageEnd'
            });
        },
        changeVariant: function(el) {
            el = el ? el : body;
            /*Variants in Category*/
            el.find(genObj.parentBtnBuy).find(genObj.changeVariantCategory).on('change', function() {
                var productId = parseInt($(this).attr('value')),
                        liBlock = $(this).closest(genObj.parentBtnBuy),
                        btnInfo = liBlock.find(genObj.prefV + productId).find(genObj.infoBut),
                        vMediumImage = $.trim(btnInfo.data('mediumImage')),
                        vId = btnInfo.data('id'),
                        vName = $.trim(btnInfo.data('vname')),
                        vNumber = $.trim(btnInfo.data('number')),
                        vPrice = btnInfo.data('price'),
                        vOrigPrice = btnInfo.data('origPrice'),
                        vAddPrice = btnInfo.data('addPrice'),
                        vStock = btnInfo.data('maxcount');

                liBlock.find(genObj.imgVC).attr('src', vMediumImage).attr('alt', vName);

                liBlock.find(genObj.selVariant).hide();
                liBlock.find(genObj.prefV + vId).show();
                if (vOrigPrice !== '')
                    liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
                liBlock.find(genObj.priceVariant).html(vPrice);
                liBlock.find(genObj.priceAddPrice).html(vAddPrice);
                ShopFront.Cart.existsVnumber(vNumber, liBlock);
                ShopFront.Cart.existsVnames(vName, liBlock);
                ShopFront.Cart.condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId).find(genObj.infoBut));

                decorElemntItemProduct(liBlock);
            });
            /*/Variants in Category*/
        },
        changeCount: function(inputs) {
            inputs.plusminus($.extend({}, optionsPlusminus, {
                after: function(e, el, input) {
                    if (checkProdStock && input.val() === input.data('max'))
                        el.closest(genObj.numberC).tooltip('show');
                }
            }));
            testNumber(inputs);
            inputs.off('maxminValue').on('maxminValue', function(e) {
                if (checkProdStock && e.res)
                    $(this).closest(genObj.numberC).tooltip('show');
            });
        },
        baskChangeCount: function(inputs) {
            inputs.plusminus($.extend({}, optionsPlusminus, {
                after: function(e, el, input) {
                    Shop.Cart.changeCount(input.val(), input.data('id'), input.data('kit'));
                }
            }));
            testNumber(inputs);
            inputs.off('maxminValue').on('maxminValue', function(e) {
                var input = $(this);
                if (input.val() !== '')
                    Shop.Cart.changeCount(input.val(), input.data('id'), input.data('kit'));
            });
        },
        existsVnumber: function(vNumber, liBlock) {
            if ($.trim(vNumber) !== '') {
                var $number = liBlock.find(genObj.frameNumber).show();
                $number.find(genObj.code).html(vNumber);
            } else {
                liBlock.find(genObj.frameNumber).hide();
            }
        },
        existsVnames: function(vName, liBlock) {
            if ($.trim(vName) !== '') {
                var $vname = liBlock.find(genObj.frameVName).show();
                $vname.find(genObj.code).html(vName);
            } else {
                liBlock.find(genObj.frameVName).hide();
            }
        },
        condProduct: function(vStock, liBlock, btnBuy) {
            liBlock.removeClass(genObj.notAvail + ' ' + genObj.inCart + ' ' + genObj.toCart);
            if (vStock === 0)
                liBlock.addClass(genObj.notAvail);
            else if (btnBuy.parent().hasClass(genObj.btnCartCss))
                liBlock.addClass(genObj.inCart);
            else
                liBlock.addClass(genObj.toCart);
        },
        pasteItems: function(el) {
            el.find("img.lazy").lazyload(lazyload);
            wnd.scroll(); //for lazyload
            drawIcons(el.find(selIcons));
            el.find('[data-drop]').drop();
        }
    },
    CompareList: {
        process: function() {
            //comparelist checking
            var comparelist = Shop.CompareList.all();
            $('.' + genObj.toCompare).each(function() {
                if (comparelist.indexOf($(this).data('id')) !== -1) {
                    var $this = $(this);
                    $this.
                            removeClass(genObj.toCompare).
                            addClass(genObj.inCompare).
                            parent().
                            addClass(genObj.compareIn).
                            end().
                            data('title', $this.attr('data-sectitle')).tooltip('remove').
                            find(genObj.textEl).
                            text($this.attr('data-sectitle'));
                }
            });
            $('.' + genObj.inCompare).each(function() {
                if (comparelist.indexOf($(this).data('id')) === -1) {
                    var $this = $(this);
                    $this.
                            addClass(genObj.toCompare).
                            removeClass(genObj.inCompare).
                            parent().
                            removeClass(genObj.compareIn).
                            end().
                            data('title', $this.attr('data-firtitle')).tooltip('remove').
                            find(genObj.textEl).
                            text($this.attr('data-firtitle'));
                }
            });
        },
        count: function() {
            var count = Shop.CompareList.all().length,
                    btn = $(genObj.tinyCompareList).find('[data-href]').drop('destroy').off('click.tocompare');

            if (count > 0) {
                $(genObj.tinyCompareList).addClass(genObj.isAvail).find(genObj.blockNoEmpty).show().end().find(genObj.blockEmpty).hide();
                btn.on('click.tocompare', function() {
                    location.href = $(this).data('href');
                });
            }
            else {
                $(genObj.tinyCompareList).removeClass(genObj.isAvail).find(genObj.blockNoEmpty).hide().end().find(genObj.blockEmpty).show();
                btn.drop();
            }
            $(genObj.countTinyCompareList).each(function() {
                $(this).html(count);
            });
            Shop.CompareList.count = count;
            $(document).trigger({
                'type': 'change_count_cl'
            });
        }
    }

};
var global = {
    processWish: function() {
        var wishlist = wishList.all();
        $(genObj.btnWish).each(function() {
            var $this = $(this);
            if (wishlist.indexOf($this.data('id').toString()) !== -1) {
                $this.addClass(genObj.wishIn);
                $this.find(genObj.toWishlist).hide();
                $this.find(genObj.inWishlist).show();
            }
            else {
                $this.removeClass(genObj.wishIn);
                $this.find(genObj.toWishlist).show();
                $this.find(genObj.inWishlist).hide();
            }
        });
    },
    wishListCount: function() {
        var count = wishList.all().length,
                btn = $(genObj.tinyWishList).find('[data-href]').drop('destroy').off('click.towish');

        if (count > 0) {
            $(genObj.tinyWishList).addClass(genObj.isAvail).find(genObj.blockNoEmpty).show().end().find(genObj.blockEmpty).hide();
            btn.on('click.towish', function() {
                location.href = $(this).data('href');
            });
        }
        else {
            $(genObj.tinyWishList).removeClass(genObj.isAvail).find(genObj.blockNoEmpty).hide().end().find(genObj.blockEmpty).show();
            btn.drop();
        }
        $(genObj.countTinyWishList).each(function() {
            $(this).html(count);
        });
        wishList.count = count;
        $(document).trigger({
            'type': 'change_count_wl'
        });
    },
    checkSyncs: function() {
        if (!isNaN(inServerCompare))
        {
            if (Shop.CompareList.all().length !== inServerCompare)
                Shop.CompareList.sync();
        }
        if (!isNaN(inServerWishList))
        {
            if (wishList.all().length !== inServerWishList)
                wishList.sync();
        }
    }
};
/*declaration shop functions*/

/*declaration front functions*/
function pluralStr(i, str) {
    function plural(a) {
        if (a % 10 === 1 && a % 100 !== 11)
            return 0;
        else if (a % 10 >= 2 && a % 10 <= 4 && (a % 100 < 10 || a % 100 >= 20))
            return 1;
        else
            return 2;
    }

    switch (plural(i)) {
        case 0:
            return str[0];
        case 1:
            return str[1];
        default:
            return str[2];
    }
}
function serializeForm(el) {
    var $this = $(el);
    return $this.data('datas', $this.closest('form').serialize());
}
if (!$.isFunction($.fancybox)) {
    var loadingTimer, loadingFrame = 1;
    body.append(loading = $('<div id="fancybox-loading"><div></div></div>'));
    _animate_loading = function() {
        if (!loading.is(':visible')) {
            clearInterval(loadingTimer);
            return;
        }

        $('div', loading).css('top', (loadingFrame * -40) + 'px');
        loadingFrame = (loadingFrame + 1) % 12;
    };
    $.fancybox = function() {
    };
    $.fancybox.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.fancybox.hideActivity = function() {
        loading.hide();
    };
}
function banerResize(el) {
    $(el).each(function() {
        var $this = $(this).css('height', '');
        if ($this.hasClass('resize')) {
            var h = 0;
            $this.find('img').each(function() {
                var $thisH = $(this).height();
                h = $thisH > h ? $thisH : h;
            });
            $this.css('height', h + $this.children().outerHeight() - $this.children().height());
        }
        else {
            var img = $this.find('img');
            img.css('margin-left', -img.filter(':visible').css('max-width', 'none').width() / 2);
        }
    });
}
function removePreloaderBaner(el) {
    var img = el.find('img[data-original]'),
            imgL = img.length,
            i = 0;
    img.each(function() {
        var $this = $(this);
        $this.attr('src', $this.attr('data-original')).load(function() {
            $(this).fadeIn();
            el.find(preloader).remove();
            i++;
            if (i === imgL) {
                banerResize(el);
            }
        });
    });
}
function initCarouselJscrollPaneCycle(el) {
    function _jC() {
        clearInterval(_jCI);
        el.find('.horizontal-carousel .carousel-js-css:not(.cycleFrame):not(.frame-scroll-pane):visible').myCarousel(carousel);
        el.find('.vertical-carousel .carousel-js-css:visible').myCarousel(carousel);
    }
    var _jCI;
    if (body.myCarousel)
        _jC();
    else
        _jCI = setInterval(_jC, 100);

    function _sP() {
        clearInterval(_sPI);
        if ($.exists(selScrollPane)) {
            el.find(selScrollPane).filter(':visible').each(function() {
                var $this = $(this),
                        api = $this.jScrollPane(scrollPane),
                        api = api.data('jsp');
                $this.on('mousewheel', function(e, b, c, delta) {
                    if (delta === -1 && api.getContentWidth() - api.getContentPositionX() !== api.getContentPane().width())
                    {
                        //            ширина блоку товару разом з мергінами
                        api.scrollByX(scrollPane.arrowButtonSpeed);
                        return false;
                    }
                    if (delta === 1 && api.getContentPositionX() !== 0) {
                        api.scrollByX(-scrollPane.arrowButtonSpeed);
                        return false;
                    }
                });
            });
        }
    }
    var _sPI;
    if (body.jScrollPane)
        _sP();
    else
        _sPI = setInterval(_sP, 100);

    function _c() {
        clearInterval(_cI);
        el.find('.cycleFrame').each(function() {
            var $this = $(this),
                    cycle = $this.find('.cycle'),
                    next = $this.find('.next'),
                    prev = $this.find('.prev');

            if (cycle.find('li').length > 1) {
                cycle.cycle('destroy').cycle($.extend({}, optionsCycle, {
                    'next': next,
                    'prev': prev,
                    'pager': $this.find('.pager'),
                    'after': function() {
                        wnd.scroll();
                    }
                })).hover(function() {
                    cycle.cycle('pause');
                }, function() {
                    cycle.cycle('resume');
                });
                $(next).add(prev).show();
            }
            removePreloaderBaner($('.baner:has(.cycle)')); //cycle - parent for images
        });
    }
    var _cI;
    if (body.cycle)
        _c();
    else
        _cI = setInterval(_c, 100);
}
function hideDrop(drop, form, durationHideForm) {
    drop = $(drop);
    var closedrop = setTimeout(function() {
        drop.drop('close');
    }, durationHideForm - drop.data('drp').durationOff);
    setTimeout(function() {
        drop.find(genObj.msgF).hide().remove();
        form.show();
        drop.drop('heightContent');
    }, durationHideForm);

    //    if close "esc" or click on body
    drop.off('closed.' + $.drop.nS).on('closed.' + $.drop.nS, function(e) {
        clearTimeout(closedrop);

        e.drop.find(genObj.msgF).hide().remove();
        form.show();
    });
}
function showHidePart(el, time, btnPlace, callback) {
    if (!time)
        time = 300;
    if (!btnPlace)
        btnPlace = 'next';
    if (btnPlace instanceof jQuery)
        btnPlace.hide();
    el.each(function() {
        var $this = $(this),
                $thisH = isNaN(parseInt($this.css('max-height'))) ? parseInt($this.css('height')) : parseInt($this.css('max-height')),
                sumHeight = 0;
        $this.addClass('showHidePart');
        var attrS = $this.attr('style');
        sumHeight = $this.removeAttr('style').css('max-height', 'none').outerHeight(true);
        $this.css('max-height', '').attr('style', attrS);
        var btn = typeof btnPlace === 'string' ? $this[btnPlace]() : btnPlace;
        btn.hide();
        if (sumHeight > $thisH) {
            $this.css({
                'max-height': 'none',
                'height': $thisH
            });
            var textEl = btn.find(genObj.textEl);
            btn.addClass('hidePart').show();
            if (!btn.is('[data-trigger]')) {
                textEl.html(textEl.data('show'));
                btn.removeData('show').off('click.showhidepart').on('click.showhidepart', function() {
                    var $thisB = $(this);
                    if ($thisB.data("show") === "no" || !$thisB.data("show")) {
                        $thisB.addClass('showPart').removeClass('hidePart');
                        var textEl = $thisB.find(genObj.textEl);
                        $this.animate({
                            'height': sumHeight
                        }, time, function() {
                            $(this).removeClass('cut-height').addClass('full-height');
                            textEl.hide().html(textEl.data('hide')).show(time);
                            if (callback)
                                callback($(this), $thisB, 'show');
                        });
                        $thisB.data('show', "yes");
                    }
                    else {
                        var $thisB = $(this).removeClass('showPart').addClass('hidePart'),
                                textEl = $thisB.find(genObj.textEl);
                        $this.stop().animate({
                            'height': $thisH
                        }, time, function() {
                            $(this).css('max-height', 'none').removeClass('full-height').addClass('cut-height');
                            textEl.hide().html(textEl.data('show')).show(time);
                            if (callback)
                                callback($(this), $thisB, 'hide');
                        });
                        $thisB.data('show', "no");
                    }
                });
            }
        }
        else
            btn.removeClass('hidePart showPart');
    });
}
function decorElemntItemProduct(el) {
    try {
        clearTimeout(curFuncTime);
    } catch (err) {
    }
    if (!el)
        el = $('.animateListItems > li');
    if ($.existsN(el.closest('.animateListItems'))) {
        function curFunc() {
            clearTimeout(curFuncTime);
            el.each(function() {
                var $thisLi = $(this).css({'min-height': 0, 'max-height': 'none'}),
                sumH = 0,
                        sumW = 0,
                        decEl = $thisLi.find('.decor-element').css({
                    'height': '100%',
                    'width': '100%',
                    'position': 'absolute',
                    'right': 'auto',
                    'left': 0,
                    'bottom': 'auto',
                    'top': 0
                }),
                decElH = decEl.height(),
                        decElW = decEl.width(),
                        noVisT = $thisLi.find('.no-vis-table'),
                        noVisTL = noVisT.length,
                        $thisS = $thisLi.data('pos').match(/top|bottom|left|right/)[0];
                $thisLi.css('overflow', 'hidden');
                noVisT.each(function() {
                    var $this = $(this);
                    if ($thisS) {
                        var descW = $thisLi.find('.description').width();
                        if ($thisS === 'top')
                            $this.parent().css({
                                'position': 'relative',
                                'width': ''
                            });
                        else
                            $this.parent().css({
                                'position': 'absolute',
                                'width': '100%'
                            });
                        switch ($thisS) {
                            case 'top':
                                $this.parent().css('top', sumH);
                                sumH = sumH + $this.outerHeight(true);
                                break;
                            case 'bottom':
                                $this.parent().css('top', -(sumH + $this.outerHeight(true)));
                                sumH = sumH + $this.outerHeight(true);
                                decEl.css({
                                    'bottom': 0,
                                    'top': 'auto'
                                });
                                break;
                            case 'left':
                                $this.parent().css({
                                    'left': descW,
                                    'top': sumH
                                });
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                break;
                            case 'right':
                                $this.parent().css({
                                    'left': -descW,
                                    'top': sumH
                                });
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                decEl.css({
                                    'right': 0,
                                    'left': 'auto'
                                });
                                break;
                        }
                    }
                });
                $thisLi.css({
                    'width': '',
                    'height': '',
                    'overflow': '',
                    'min-height': '',
                    'max-height': ''
                });
                switch ($thisS) {
                    case 'top':
                        decEl.css({
                            'height': sumH + decElH
                        });
                        break;
                    case 'bottom':
                        decEl.css({
                            'height': sumH + decElH
                        });
                        break;
                    case 'left':
                        decEl.css({
                            'width': sumW / noVisTL + decElW,
                            'height': sumH > decElH ? sumH : decElH
                        });
                        break;
                    case 'right':
                        decEl.css({
                            'width': sumW / noVisTL + decElW,
                            'height': sumH > decElH ? sumH : decElH
                        });
                        break;
                }
            });
            wnd.scroll(); //if lazyload
        }
        var curFuncTime = setTimeout(curFunc, 400);
    }
}

function drawIcons(selIcons) {
}

function itemUserToolbar() {
    this.show = function(itemsUT, btn, hideSet, btnUp) {
        btn.on('click.UT', function() {
            var $this = $(this),
                    dataRel = $this.data('rel');
            setCookie('condUserToolbar', dataRel, 0, '/')
            if (dataRel == 0) {
                $this.removeClass('activeUT').hide().next().show().addClass('activeUT');
                itemsUT.closest('.frame-user-toolbar').removeClass('active');
                itemsUT.stop().css('width', btn.width());
            }
            else {
                $this.removeClass('activeUT').hide().prev().show().addClass('activeUT');
                itemsUT.stop().css('width', '');
                itemsUT.closest('.frame-user-toolbar').addClass('active');
            }
        }).not('.activeUT').trigger('click.UT');
        wnd.off('scroll.UT').on('scroll.UT', function() {
            if (wnd.scrollTop() > wnd.height() && !btnUp.hasClass('non-v'))
                btnUp.fadeIn();
            else
                btnUp.hide();
        });
        return itemsUT;
    }
    , this.resize = function(itemsUT, btnUp) {
        itemsUT = $(itemsUT);
        var btnW = btnUp.show().outerWidth(true),
                itemsUTCW = itemsUT.children().width();
        btnUp.hide();
        if ((wnd.width() - itemsUTCW) / 2 > btnW)
            btnUp.show().removeClass('non-v');
        else
            btnUp.hide().addClass('non-v');
        return itemsUT;
    };
}
function reinitializeScrollPane(el) {
    if ($.exists(selScrollPane)) {
        wnd.on('resize.scroll', function() {
            el.find(selScrollPane).filter(':visible').each(function() {
                $(this).jScrollPane(scrollPane);
                var api = $(this).data('jsp');
                var throttleTimeout;
                if ($.browser.msie) {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                }
                else {
                    api.reinitialise();
                }
            });
        });
    }
}
function ieBoxSize(els) {
    if (!els)
        els = $(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])');
    els.not(':hidden').not('.visited').each(function() {
        var $this = $(this);
        $this.css({
            'width': function() {
                return 2 * $this.width() - $this.outerWidth();
            },
            'height': function() {
                return 2 * $this.height() - $this.outerHeight();
            }
        }).addClass('visited');
    });
}
function cuselInit(el, sel) {
    el = el ? el : body;
    sel = sel ? sel : cuselOptions.changedEl;
    if ($.existsN(el.find(sel)) && $.isFunction(window.cuSel)) {
        cuSel($.extend({}, cuselOptions, {
            changedEl: sel
        }));
        if (ltie7)
            ieBoxSize(el.find('.cuselText'));
    }
}
function testNumber(el) {
    el.on('testNumber', function(e) {
        if (e.res)
            $(this).tooltip('remove');
        else {
            $(this).tooltip('show');
        }
    }).testNumber();
//    ['.']
}
/*/declaration front functions*/
;
function init() {
    var doc = $(document);

    body.removeClass('not-js');
    if (isTouch)
        body.addClass('isTouch');
    else
        body.addClass('notTouch');

    /*call general functions and plugins*/
    cuselInit(body, '#sort, #sort2, #compare, [id ^= сVariantSwitcher_]');
    /*call general functions and plugins*/

    /*call functions for shop objects*/
    global.checkSyncs();

    ShopFront.Cart.changeVariant();
    global.processWish();
    ShopFront.CompareList.process();

    /*changecount product in category and product*/
    ShopFront.Cart.changeCount($('.items-catalog, .item-product').find(genObj.plusMinus));
    /*/changecount product in category and product*/
    /*/ call functions for shop objects*/

    /*call front plugins and functions*/
    if (ltie7) {
        ieBoxSize();
        ieBoxSize($('.photo-block, .frame-baner-start_page .content-carousel, .cloud-zoom-lens, .items-user-toolbar'));
    }
    optionsDrop.before = function(el, drop) {
        drop.find('label.' + genObj.err + ', label.' + genObj.scs).hide();
        drop.find(':input').removeClass(genObj.scs + ' ' + genObj.err);

        if (drop.hasClass('drop-report')) {
            var dropRep = drop.find('[data-rel="pastehere"]');
            dropRep.html(_.template($('#reportappearance').html(), {
                item: Shop.Cart.composeCartItem(el)
            }));

            dropRep.append($('[data-clone="data-report"]').find(genObj.msgF).remove().end().clone(true).removeClass('d_n'));
            dropRep.find('input[name="ProductId"]').val(el.data('productId'));
            dropRep.find('input[name="VariantId"]').val(el.data('id'));
        }

        try {
            var fAS = $('.frame-already-show'),
            zInd = parseFloat(fAS.data('drp').dropOver.css('z-index'));
            fAS.prev().css('z-index', zInd + 3).closest('.frame-user-toolbar').css('z-index', zInd + 1);
        } catch (err) {
        }
    };
    optionsDrop.after = function(el, drop) {
        drawIcons(drop.find(selIcons));

        drop.find("img.lazy:not(.load)").lazyload(lazyload);
        wnd.scroll(); //for lazyload

        if (drop.hasClass('drop-wishlist')) {
            drop.nStRadio({
                wrapper: $(".frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
        }
        if ($.existsN(drop.find('[onsubmit*="ImageCMSApi"]')) || drop.is('#sendMail')) {
            var input = drop.find('form input[type="text"]:first');
            input.setCursorPosition(input.val().length);
        }
        var carouselInDrop = drop.find('.carousel-js-css');
        if ($.existsN(carouselInDrop) && !carouselInDrop.hasClass('visited') && !drop.is('#photo')) {
            carouselInDrop.addClass('visited');
            carouselInDrop.myCarousel(carousel);
        }
        initCarouselJscrollPaneCycle(drop.find('#ViewedProducts'));
        cuselInit(drop, '.lineForm select');
    };
    optionsDrop.close = function(el, drop) {
    };
    optionsDrop.closed = function(el, drop) {
        if (drop.hasClass('frame-already-show')) {
            $('.frame-user-toolbar').css('z-index', '');
            drop.prev().css('z-index', '');
        }
    };
    $('.menu-main nav').menuImageCms(optionsMenu);
    $('.footer-category-menu').find('[href="' + $('.frame-item-menu.active > .frame-title > .title').attr('href') + '"]').parent().addClass('active');
    $.drop.setParameters(optionsDrop);
    $.drop.extendDrop('droppable', 'noinherit', 'heightContent', 'limitSize', 'galleries', 'placeBeforeShow', 'placeAfterClose', 'confirmPrompt');
    $('a.fancybox').drop();
    $('[data-drop]').drop();

    ShopFront.CompareList.count();
    global.wishListCount();
    $('.tabs').tabs({
        after: function(el) {
            if (el.hasClass('tabs-compare-category')) {
                optionCompare.compareChangeCategory();
            }
            if (el.hasClass('tabs-list-table')) {
                decorElemntItemProduct();
            }
            if (el.hasClass('tabs-product')) {
                showHidePart($('.patch-product-view'));
                showHidePart($('.frame-list-comments.sub-2'));
            }
            wnd.scroll();
        }
    });

    $('#suggestions').autocomplete({
        minValue: 2,
        blockEnter: false
    });
    drawIcons($(selIcons));
    showHidePart($('.sub-category'));
    showHidePart($('.patch-product-view'));
    showHidePart($('.frame-list-comments.sub-2'));
    showHidePart($('[class*="m-h_"]'));
    
    var userTool = new itemUserToolbar(),
    btnToUp = $('.btn-to-up');
    btnToUp.click(function() {
        $("html, body").animate({
            scrollTop: "0"
        });
    });
    userTool.show($('.items-user-toolbar'), $('.btn-toggle-toolbar > button'), '.box-1, .box-2, .box-3', btnToUp);
    userTool.resize($('.frame-user-toolbar'), btnToUp);
    if ($.existsN($('.animateListItems.table')))
        decorElemntItemProduct();
    var frLabL = $('.frame-label').length;
    $('.frame-label:has(.lineForm)').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': frLabL - index
        });
    });
    initCarouselJscrollPaneCycle(body);

    reinitializeScrollPane(body);
    
    $("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazy load start initialize
    /*/call front plugins and functions*/

    /*sample of events shop*/
    var catalogForm = $('#catalogForm');
    $('#sort').on('change.orderproducts', function() {
        catalogForm.find('input[name=order]').val($(this).val());
        catalogForm.submit();
    });
    $('#sort2').on('change.countvisibleproducts', function() {
        catalogForm.find('input[name=user_per_page]').val($(this).val());
        catalogForm.submit();
    });

    //Start. Cart
    $('.special-proposition').find(genObj.btnBuy).each(function() {
        ShopFront.Cart.processBtnBuyCount($(this).data('id'), 'remove', false);
    });
    _.map(cartItemsProductsId, function(n, i) {
        ShopFront.Cart.processBtnBuyCount(n, 'add', false);
        Shop.Cart.getAmount(false, n);
    });
    doc.on('getAmount.Cart', function(e) {
        ShopFront.Cart.processBtnBuyCount(e.id, 'change', false, e.datas);
    });    

    doc.on('beforeGetTpl.Cart', function(e) {
        if (e.obj.template === 'cart_popup' && !$(genObj.popupCart).is(':visible'))
            $(document).trigger('showActivity');
    });
    doc.on('getTpl.Cart', function(e) {
        var popup = $(genObj.popupCart),
        tinyBask = $(genObj.tinyBask);

        if (e.obj.template === 'cart_popup') {
            popup.empty().html(e.datas);
            
            if (popup.is(':visible')) {
                popup.drop('limitSize');
                popup.drop('heightContent');
                popup.drop('center');
            }
            
            if (e.objF.show)
                $(genObj.showCartPopup).drop('open');
            
            drawIcons(popup.find(selIcons));
            ShopFront.Cart.baskChangeCount(popup.find(genObj.plusMinus));

            if ($.exists(global.baskInput)) {
                var input = $(global.baskInput);
                input.setCursorPosition(input.val().length);
                global.baskInput = null;
            }
        }
        if (e.obj.template === 'cart_data') {
            tinyBask.html(e.datas);
            drawIcons(tinyBask.find(selIcons));
        }
    });
    body.on('click.getPopup', genObj.btnBask + ',' + genObj.btnInCart + ' ' + genObj.btnBuy + ',' + genObj.editCart, function(e) {
        Shop.Cart.getTpl({
            ignoreWrap: '1',
            template: 'cart_popup'
        }, {
            show: true,
            type: e.type
        });
    });

    doc.on('beforeAdd.Cart', function(e) {
        $(genObj.btnBuy).filter('[data-id="' + e.id + '"]').attr('disabled', 'disabled');
    });
    doc.on('beforeRemove.Cart beforeChange.Cart', function(e) {
        $(genObj.popupCart).find(preloader).show();
    });
    doc.on('сhange.Cart', function(e) {
        global.baskInput = '#inputChange' + e.id;
        ShopFront.Cart.processBtnBuyCount(e.id, 'change', e.kit, e.count);
    });
    doc.on('add.Cart', function(e) {
        ShopFront.Cart.processBtnBuyCount(e.id, 'add', e.kit);

        Shop.Cart.getTpl({
            ignoreWrap: '1',
            template: 'cart_popup'
        }, {
            show: true,
            type: e.type
        });
        Shop.Cart.getTpl({
            ignoreWrap: '1',
            template: 'cart_data'
        }, {
            type: e.type
        });
    });
    doc.on('remove.Cart', function(e) {
        ShopFront.Cart.processBtnBuyCount(e.id, 'remove', e.kit);
    });
    doc.on('remove.Cart сhange.Cart', function(e) {
        if ($.exists(genObj.orderDetails))
             Shop.Cart.getTpl({
                 ignoreWrap: '1',
                 template: 'cart_order',
                 gift: $(genObj.gift).val(),
                 deliveryMethodId: function() {
                     if (selectDeliv)
                         return $(genObj.dM).val();
                     else
                         return $(genObj.dM).filter(':checked').val();
                 }
             }, {
                 type: e.type
             });

        Shop.Cart.getTpl({
            ignoreWrap: '1',
            template: 'cart_popup'
        }, {
            type: e.type
        });
        Shop.Cart.getTpl({
            ignoreWrap: '1',
            template: 'cart_data'
        }, {
            type: e.type
        });
    });
    //End. Cart

    $(genObj.parentBtnBuy).on('click.toCompare', '.' + genObj.toCompare, function() {
        Shop.CompareList.add($(this).data('id'));
    });
    $(genObj.parentBtnBuy).on('click.inCompare', '.' + genObj.inCompare, function() {
        var pN = window.location.pathname,
        tab;

        if (/category|product/.test(pN)) {
            if (pN.indexOf('category') !== -1)
                tab = pN.substr(pN.lastIndexOf('/') + 1, pN.length);
            else if (pN.indexOf('product') !== -1)
                tab = hrefCategoryProduct.substr(hrefCategoryProduct.lastIndexOf('/') + 1, hrefCategoryProduct.length);
            document.location.href = locale + '/shop/compare#tab_' + tab;
        }
        else
            document.location.href = locale + '/shop/compare';
    });
    doc.on('compare_list_add', function(e) {
        ShopFront.CompareList.process();
    });
    doc.on('compare_list_add compare_list_rm compare_list_sync', function() {
        ShopFront.CompareList.count();
    });
    doc.on('compare_list_sync', function() {
        ShopFront.CompareList.process();
    });
    doc.on('wish_list_sync', function() {
        global.processWish();
        global.wishListCount();
    });
    doc.on('widget_ajax', function(e) {
        initCarouselJscrollPaneCycle(e.el);
        reinitializeScrollPane(e.el);

        e.el.find("img.lazy").lazyload(lazyload);
        wnd.scroll();

        e.el.find('.special-proposition').find(genObj.btnBuy).each(function() {
            ShopFront.Cart.processBtnBuyCount($(this).data('id'), 'remove', false);
        });
        _.map(cartItemsProductsId, function(n, i) {
            ShopFront.Cart.processBtnBuyCount(n, 'add', false);
        });

        ShopFront.Cart.pasteItems(e.el);
    });
    /*/sample of events shop/*/

    /*sample of events front*/
    doc.on('lazy.after', function(e) {
        e.el.addClass('load');
    });
    doc.on('tabs.beforeload', function(e) {
        e.els.filter('.active').append('<div class="preloader"></div>');
    });
    doc.on('tabs.afterload', function(e) {
        ShopFront.Cart.pasteItems(e.el);
        e.els.find(preloader).remove();
    });
    doc.on('autocomplete.fewLength', function(e) {
        e.el.tooltip('show', {
            'title': text.search(e.value)
        });
    });

    try {
        $('a.fancybox, [rel="group"]').fancybox();
    } catch (e) {
    }
    doc.on('rendercomment.after', function(e) {
        showHidePart(e.el.find('.frame-list-comments.sub-2'));
        showHidePart(e.el.find('.product-comment'));
        e.el.find('[data-drop]').drop();
        e.el.find(preloader).remove();
    });
    doc.on('autocomplete.after rendercomment.after imageapi.pastemsg showCleaverFilter tabs.afterload renderorder.after', function(e) {
        if (e.el.parent().is(':visible'))
            drawIcons(e.el.parent().find(selIcons));
    });
    doc.on('imageapi.pastemsg imageapi.hidemsg', function(e) {
        e.el.closest('[data-elrun]').drop('limitSize').drop('heightContent').drop('center');
    });
    doc.on('imageapi.before_refresh_reload', function(e) {
        var drop = e.el.closest('[data-elrun]');
        if (drop.data('drp') && drop.data('drp').durationOff !== undefined)
            setTimeout(function() {
                if ($.existsN(drop))
                    drop.drop('close');
            }, e.obj.durationHideForm - drop.data('drp').durationOff > 0 ? e.obj.durationHideForm - drop.data('drp').durationOff : e.obj.durationHideForm);
    });
    doc.on('autocomplete.before showActivity before_add_to_compare before_delete_compare discount.load_certificate beforeAdd.Cart', function(e) {
        $.fancybox.showActivity();
    });
    doc.on('autocomplete.after after.drop closed.drop hideActivity compare_list_add compare_list_rm imageapi.success getTpl.Cart', function(e) {
        $.fancybox.hideActivity();
    });

    doc.on('comments.showformreply tabs.showtabs after.drop', function(e) {
        if (ltie7)
            ieBoxSize(e.el.find(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])'));
    });
    doc.on('comments.beforeshowformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view'),
                h = patchCom.outerHeight(),
                elH = e.el.outerHeight();
        
        patchCom.css({
            'height': h + elH,
            'max-height': h + elH
        });
    });
    doc.on('comments.beforehideformreply', function(e) {
        e.el.closest('.patch-product-view').removeAttr('style');
    });
    doc.on('menu.showDrop', function(e) {
        if (ltie7)
            ieBoxSize($('.frame-drop-menu .frame-l2 > ul > li'));
    });
    body.on('click.trigger', '[data-trigger]', function(e) {
        var $thisT = $(this);
        $($thisT.data('trigger')).trigger({
            type: "click",
            scroll: $thisT.data('scroll') !== undefined || false,
            trigger: true
        });
    });
    /*/sample of events front*/

    if (!$.browser.opera)
        wnd.focus(function() {
            global.checkSyncs();

            ShopFront.CompareList.process();
            global.processWish();
            ShopFront.CompareList.count();
            global.wishListCount();
        });
    var genTimeout = "";
    wnd.resize(function() {
        clearTimeout(genTimeout);
        genTimeout = setTimeout(function() {
            var userTool = new itemUserToolbar();
            userTool.resize($('.frame-user-toolbar'), $('.btn-to-up'));
            $('.menu-main nav').menuImageCms('refresh');
            banerResize('.baner:has(.cycle)');
        }, 300);
    });
}