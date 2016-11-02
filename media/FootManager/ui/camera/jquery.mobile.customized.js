/*! jQuery Mobile v1.3.0 | Copyright 2010, 2013 jQuery Foundation, Inc. | jquery.org/license */

(function(a, b, c) { typeof define == "function" && define.amd ? define(["jquery"], function(d) { return c(d, a, b), d.mobile }) : c(a.jQuery, a, b) })(this, document, function(a, b, c, d) {
    (function(a, b, d) {
        function k(a) { return a = a || location.href, "#" + a.replace(/^[^#]*#?(.*)$/, "$1") }

        var e = "hashchange", f = c, g, h = a.event.special, i = f.documentMode, j = "on" + e in b && (i === d || i > 7);
        a.fn[e] = function(a) { return a ? this.bind(e, a) : this.trigger(e) }, a.fn[e].delay = 50, h[e] = a.extend(h[e], {
            setup: function() {
                if (j)return!1;
                a(g.start)
            },
            teardown: function() {
                if (j)return!1;
                a(g.stop)
            }
        }), g = function() {
            function n() {
                var c = k(), d = m(h);
                c !== h ? (l(h = c, d), a(b).trigger(e)) : d !== h && (location.href = location.href.replace(/#.*/, "") + d), g = setTimeout(n, a.fn[e].delay)
            }

            var c = {}, g, h = k(), i = function(a) { return a }, l = i, m = i;
            return c.start = function() { g || n() }, c.stop = function() { g && clearTimeout(g), g = d }, b.attachEvent && !b.addEventListener && !j && function() {
                var b, d;
                c.start = function() {
                    b || (d = a.fn[e].src, d = d && d + k(), b = a('<iframe tabindex="-1" title="empty"/>').hide().one("load", function() { d || l(k()), n() }).attr("src", d || "javascript:0").insertAfter("body")[0].contentWindow, f.onpropertychange = function() {
                        try {
                            event.propertyName === "title" && (b.document.title = f.title)
                        } catch (a) {
                        }
                    })
                }, c.stop = i, m = function() { return k(b.location.href) }, l = function(c, d) {
                    var g = b.document, h = a.fn[e].domain;
                    c !== d && (g.title = f.title, g.open(), h && g.write('<script>document.domain="' + h + '"</script>'), g.close(), b.location.hash = c)
                }
            }(), c
        }()
    })(a, this), function(a) {
        a.event.special.throttledresize = { setup: function() { a(this).bind("resize", c) }, teardown: function() { a(this).unbind("resize", c) } };
        var b = 250, c = function() { f = (new Date).getTime(), g = f - d, g >= b ? (d = f, a(this).trigger("throttledresize")) : (e && clearTimeout(e), e = setTimeout(c, b - g)) }, d = 0, e, f, g
    }(a), function(a, b) { a.fn.fieldcontain = function(a) { return this.addClass("ui-field-contain ui-body ui-br").contents().filter(function() { return this.nodeType === 3 && !/\S/.test(this.nodeValue) }).remove() }, a(c).bind("pagecreate create", function(b) { a(":jqmData(role='fieldcontain')", b.target).jqmEnhanceable().fieldcontain() }) }(a), function(a, b) {
        a.fn.grid = function(b) {
            return this.each(function() {
                var c = a(this), d = a.extend({ grid: null }, b), e = c.children(), f = { solo: 1, a: 2, b: 3, c: 4, d: 5 }, g = d.grid, h;
                if (!g)
                    if (e.length <= 5)for (var i in f)f[i] === e.length && (g = i);
                    else g = "a", c.addClass("ui-grid-duo");
                h = f[g], c.addClass("ui-grid-" + g), e.filter(":nth-child(" + h + "n+1)").addClass("ui-block-a"), h > 1 && e.filter(":nth-child(" + h + "n+2)").addClass("ui-block-b"), h > 2 && e.filter(":nth-child(" + h + "n+3)").addClass("ui-block-c"), h > 3 && e.filter(":nth-child(" + h + "n+4)").addClass("ui-block-d"), h > 4 && e.filter(":nth-child(" + h + "n+5)").addClass("ui-block-e")
            })
        }
    }(a), function(a) { a.mobile = {} }(a), function(a, b, d) {
        var e = {};
        a.mobile = a.extend(a.mobile, {
            version: "1.3.0", ns: "", subPageUrlKey: "ui-page", activePageClass: "ui-page-active", activeBtnClass: "ui-btn-active", focusClass: "ui-focus", ajaxEnabled: !0, hashListeningEnabled: !0, linkBindingEnabled: !0, defaultPageTransition: "fade", maxTransitionWidth: !1, minScrollBack: 250, touchOverflowEnabled: !1, defaultDialogTransition: "pop", pageLoadErrorMessage: "Error Loading Page", pageLoadErrorMessageTheme: "e", phonegapNavigationEnabled: !1, autoInitializePage: !0, pushStateEnabled: !0, ignoreContentEnabled: !1, orientationChangeEnabled: !0, buttonMarkup: { hoverDelay: 200 }, window: a(b), document: a(c), keyCode: { ALT: 18, BACKSPACE: 8, CAPS_LOCK: 20, COMMA: 188, COMMAND: 91, COMMAND_LEFT: 91, COMMAND_RIGHT: 93, CONTROL: 17, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, INSERT: 45, LEFT: 37, MENU: 93, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108, NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SHIFT: 16, SPACE: 32, TAB: 9, UP: 38, WINDOWS: 91 }, behaviors: {}, silentScroll: function(c) { a.type(c) !== "number" && (c = a.mobile.defaultHomeScroll), a.event.special.scrollstart.enabled = !1, setTimeout(function() { b.scrollTo(0, c), a.mobile.document.trigger("silentscroll", { x: 0, y: c }) }, 20), setTimeout(function() { a.event.special.scrollstart.enabled = !0 }, 150) }, nsNormalizeDict: e,
            nsNormalize: function(b) {
                if (!b)return;
                return e[b] || (e[b] = a.camelCase(a.mobile.ns + b))
            },
            getInheritedTheme: function(a, b) {
                var c = a[0], d = "", e = /ui-(bar|body|overlay)-([a-z])\b/, f, g;
                while (c) {
                    f = c.className || "";
                    if (f && (g = e.exec(f)) && (d = g[2]))break;
                    c = c.parentNode
                }
                return d || b || "a"
            },
            closestPageData: function(a) { return a.closest(':jqmData(role="page"), :jqmData(role="dialog")').data("mobile-page") },
            enhanceable: function(a) { return this.haveParents(a, "enhance") },
            hijackable: function(a) { return this.haveParents(a, "ajax") },
            haveParents: function(b, c) {
                if (!a.mobile.ignoreContentEnabled)return b;
                var d = b.length, e = a(), f, g, h;
                for (var i = 0; i < d; i++) {
                    g = b.eq(i), h = !1, f = b[i];
                    while (f) {
                        var j = f.getAttribute ? f.getAttribute("data-" + a.mobile.ns + c) : "";
                        if (j === "false") {
                            h = !0;
                            break
                        }
                        f = f.parentNode
                    }
                    h || (e = e.add(g))
                }
                return e
            },
            getScreenHeight: function() { return b.innerHeight || a.mobile.window.height() }
        }, a.mobile), a.fn.jqmData = function(b, c) {
            var e;
            return typeof b != "undefined" && (b && (b = a.mobile.nsNormalize(b)), arguments.length < 2 || c === d ? e = this.data(b) : e = this.data(b, c)), e
        }, a.jqmData = function(b, c, d) {
            var e;
            return typeof c != "undefined" && (e = a.data(b, c ? a.mobile.nsNormalize(c) : c, d)), e
        }, a.fn.jqmRemoveData = function(b) { return this.removeData(a.mobile.nsNormalize(b)) }, a.jqmRemoveData = function(b, c) { return a.removeData(b, a.mobile.nsNormalize(c)) }, a.fn.removeWithDependents = function() { a.removeWithDependents(this) }, a.removeWithDependents = function(b) {
            var c = a(b);
            (c.jqmData("dependents") || a()).remove(), c.remove()
        }, a.fn.addDependents = function(b) { a.addDependents(a(this), b) }, a.addDependents = function(b, c) {
            var d = a(b).jqmData("dependents") || a();
            a(b).jqmData("dependents", a.merge(d, c))
        }, a.fn.getEncodedText = function() { return a("<div/>").text(a(this).text()).html() }, a.fn.jqmEnhanceable = function() { return a.mobile.enhanceable(this) }, a.fn.jqmHijackable = function() { return a.mobile.hijackable(this) };
        var f = a.find, g = /:jqmData\(([^)]*)\)/g;
        a.find = function(b, c, d, e) { return b = b.replace(g, "[data-" + (a.mobile.ns || "") + "$1]"), f.call(this, b, c, d, e) }, a.extend(a.find, f), a.find.matches = function(b, c) { return a.find(b, null, null, c) }, a.find.matchesSelector = function(b, c) { return a.find(c, null, null, [b]).length > 0 }
    }(a, this), function(a, d) {
        b.matchMedia = b.matchMedia || function(a, b) {
            var c, d = a.documentElement, e = d.firstElementChild || d.firstChild, f = a.createElement("body"), g = a.createElement("div");
            return g.id = "mq-test-1", g.style.cssText = "position:absolute;top:-100em", f.style.background = "none", f.appendChild(g), function(a) { return g.innerHTML = '&shy;<style media="' + a + '"> #mq-test-1 { width: 42px; }</style>', d.insertBefore(f, e), c = g.offsetWidth === 42, d.removeChild(f), { matches: c, media: a } }
        }(c), a.mobile.media = function(a) { return b.matchMedia(a).matches }
    }(a), function(a, c) { a.extend(a.support, { orientation: "orientation" in b && "onorientationchange" in b }) }(a), function(a, b) {
        function o() {
            var a = g();
            a !== h && (h = a, d.trigger(e))
        }

        var d = a(b), e = "orientationchange", f, g, h, i, j, k = { 0: !0, 180: !0 };
        if (a.support.orientation) {
            var l = b.innerWidth || d.width(), m = b.innerHeight || d.height(), n = 50;
            i = l > m && l - m > n, j = k[b.orientation];
            if (i && j || !i && !j)k = { "-90": !0, 90: !0 }
        }
        a.event.special.orientationchange = a.extend({}, a.event.special.orientationchange, {
            setup: function() {
                if (a.support.orientation && !a.event.special.orientationchange.disabled)return!1;
                h = g(), d.bind("throttledresize", o)
            },
            teardown: function() {
                if (a.support.orientation && !a.event.special.orientationchange.disabled)return!1;
                d.unbind("throttledresize", o)
            },
            add: function(a) {
                var b = a.handler;
                a.handler = function(a) { return a.orientation = g(), b.apply(this, arguments) }
            }
        }), a.event.special.orientationchange.orientation = g = function() {
            var d = !0, e = c.documentElement;
            return a.support.orientation ? d = k[b.orientation] : d = e && e.clientWidth / e.clientHeight < 1.1, d ? "portrait" : "landscape"
        }, a.fn[e] = function(a) { return a ? this.bind(e, a) : this.trigger(e) }, a.attrFn && (a.attrFn[e] = !0)
    }(a, this), function(a, b) {
        var d = { touch: "ontouchend" in c };
        a.mobile.support = a.mobile.support || {}, a.extend(a.support, d), a.extend(a.mobile.support, d)
    }(a), function(a, d) {
        function e(a) {
            var b = a.charAt(0).toUpperCase() + a.substr(1), c = (a + " " + h.join(b + " ") + b).split(" ");
            for (var e in c)if (g[c[e]] !== d)return!0
        }

        function m(a, b, d) {
            var e = c.createElement("div"), f = function(a) { return a.charAt(0).toUpperCase() + a.substr(1) }, g = function(a) { return a === "" ? "" : "-" + a.charAt(0).toLowerCase() + a.substr(1) + "-" },
                i = function(c) {
                    var d = g(c) + a + ": " + b + ";", h = f(c), i = h + (h === "" ? a : f(a));
                    e.setAttribute("style", d), !e.style[i] || (k = !0)
                },
                j = d ? d : h,
                k;
            for (var l = 0; l < j.length; l++)i(j[l]);
            return!!k
        }

        function n() {
            var e = "transform-3d", g = a.mobile.media("(-" + h.join("-" + e + "),(-") + "-" + e + "),(" + e + ")");
            if (g)return!!g;
            var i = c.createElement("div"), j = { MozTransform: "-moz-transform", transform: "transform" };
            f.append(i);
            for (var k in j)i.style[k] !== d && (i.style[k] = "translate3d( 100px, 1px, 1px )", g = b.getComputedStyle(i).getPropertyValue(j[k]));
            return!!g && g !== "none"
        }

        function o() {
            var b = location.protocol + "//" + location.host + location.pathname + "ui-dir/", c = a("head base"), d = null, e = "", g, h;
            return c.length ? e = c.attr("href") : c = d = a("<base>", { href: b }).appendTo("head"), g = a("<a href='testurl' />").prependTo(f), h = g[0].href, c[0].href = e || location.pathname, d && d.remove(), h.indexOf(b) === 0
        }

        function p() {
            var a = c.createElement("x"), d = c.documentElement, e = b.getComputedStyle, f;
            return"pointerEvents" in a.style ? (a.style.pointerEvents = "auto", a.style.pointerEvents = "x", d.appendChild(a), f = e && e(a, "").pointerEvents === "auto", d.removeChild(a), !!f) : !1
        }

        function q() {
            var a = c.createElement("div");
            return typeof a.getBoundingClientRect != "undefined"
        }

        function r() {
            var a = b, c = navigator.userAgent, d = navigator.platform, e = c.match(/AppleWebKit\/([0-9]+)/), f = !!e && e[1], g = c.match(/Fennec\/([0-9]+)/), h = !!g && g[1], i = c.match(/Opera Mobi\/([0-9]+)/), j = !!i && i[1];
            return(d.indexOf("iPhone") > -1 || d.indexOf("iPad") > -1 || d.indexOf("iPod") > -1) && f && f < 534 || a.operamini && {}.toString.call(a.operamini) === "[object OperaMini]" || i && j < 7458 || c.indexOf("Android") > -1 && f && f < 533 || h && h < 6 || "palmGetResource" in b && f && f < 534 || c.indexOf("MeeGo") > -1 && c.indexOf("NokiaBrowser/8.5.0") > -1 ? !1 : !0
        }

        var f = a("<body>").prependTo("html"), g = f[0].style, h = ["Webkit", "Moz", "O"], i = "palmGetResource" in b, j = b.opera, k = b.operamini && {}.toString.call(b.operamini) === "[object OperaMini]", l = b.blackberry && !e("-webkit-transform");
        a.extend(a.mobile, { browser: {} }), a.mobile.browser.oldIE = function() {
            var a = 3, b = c.createElement("div"), d = b.all || [];
            do b.innerHTML = "<!--[if gt IE " + ++a + "]><br><![endif]-->";
            while (d[0]);
            return a > 4 ? a : !a
        }(), a.extend(a.support, { cssTransitions: "WebKitTransitionEvent" in b || m("transition", "height 100ms linear", ["Webkit", "Moz", ""]) && !a.mobile.browser.oldIE && !j, pushState: "pushState" in history && "replaceState" in history && b.navigator.userAgent.search(/CriOS/) === -1, mediaquery: a.mobile.media("only all"), cssPseudoElement: !!e("content"), touchOverflow: !!e("overflowScrolling"), cssTransform3d: n(), boxShadow: !!e("boxShadow") && !l, fixedPosition: r(), scrollTop: ("pageXOffset" in b || "scrollTop" in c.documentElement || "scrollTop" in f[0]) && !i && !k, dynamicBaseTag: o(), cssPointerEvents: p(), boundingRect: q() }), f.remove();
        var s = function() {
            var a = b.navigator.userAgent;
            return a.indexOf("Nokia") > -1 && (a.indexOf("Symbian/3") > -1 || a.indexOf("Series60/5") > -1) && a.indexOf("AppleWebKit") > -1 && a.match(/(BrowserNG|NokiaBrowser)\/7\.[0-3]/)
        }();
        a.mobile.gradeA = function() { return(a.support.mediaquery || a.mobile.browser.oldIE && a.mobile.browser.oldIE >= 7) && (a.support.boundingRect || a.fn.jquery.match(/1\.[0-7+]\.[0-9+]?/) !== null) }, a.mobile.ajaxBlacklist = b.blackberry && !b.WebKitPoint || k || s, s && a(function() { a("head link[rel='stylesheet']").attr("rel", "alternate stylesheet").attr("rel", "stylesheet") }), a.support.boxShadow || a("html").addClass("ui-mobile-nosupport-boxshadow")
    }(a), function(a, b) {
        var c = a.mobile.window, d, e;
        a.event.special.navigate = d = {
            bound: !1, pushStateEnabled: !0, originalEventName: b, isPushStateEnabled: function() { return a.support.pushState && a.mobile.pushStateEnabled === !0 && this.isHashChangeEnabled() }, isHashChangeEnabled: function() { return a.mobile.hashListeningEnabled === !0 },
            popstate: function(b) {
                var d = new a.Event("navigate"), e = new a.Event("beforenavigate"), f = b.originalEvent.state || {}, g = location.href;
                c.trigger(e);
                if (e.isDefaultPrevented())return;
                b.historyState && a.extend(f, b.historyState), d.originalEvent = b, setTimeout(function() { c.trigger(d, { state: f }) }, 0)
            },
            hashchange: function(b, d) {
                var e = new a.Event("navigate"), f = new a.Event("beforenavigate");
                c.trigger(f);
                if (f.isDefaultPrevented())return;
                e.originalEvent = b, c.trigger(e, { state: b.hashchangeState || {} })
            },
            setup: function(a, b) {
                if (d.bound)return;
                d.bound = !0, d.isPushStateEnabled() ? (d.originalEventName = "popstate", c.bind("popstate.navigate", d.popstate)) : d.isHashChangeEnabled() && (d.originalEventName = "hashchange", c.bind("hashchange.navigate", d.hashchange))
            }
        }
    }(a), function(a, b, c) {
        var d = function(d) {
                return d === c && (d = !0), function(c, e, f, g) {
                    var h = new a.Deferred, i = e ? " reverse" : "", j = a.mobile.urlHistory.getActive(), k = j.lastScroll || a.mobile.defaultHomeScroll, l = a.mobile.getScreenHeight(), m = a.mobile.maxTransitionWidth !== !1 && a.mobile.window.width() > a.mobile.maxTransitionWidth, n = !a.support.cssTransitions || m || !c || c === "none" || Math.max(a.mobile.window.scrollTop(), k) > a.mobile.getMaxScrollForTransition(), o = " ui-page-pre-in", p = function() { a.mobile.pageContainer.toggleClass("ui-mobile-viewport-transitioning viewport-" + c) }, q = function() { a.event.special.scrollstart.enabled = !1, b.scrollTo(0, k), setTimeout(function() { a.event.special.scrollstart.enabled = !0 }, 150) }, r = function() { g.removeClass(a.mobile.activePageClass + " out in reverse " + c).height("") }, s = function() { d ? g.animationComplete(t) : t(), g.height(l + a.mobile.window.scrollTop()).addClass(c + " out" + i) }, t = function() { g && d && r(), u() }, u = function() { f.css("z-index", -10), f.addClass(a.mobile.activePageClass + o), a.mobile.focusPage(f), f.height(l + k), q(), f.css("z-index", ""), n || f.animationComplete(v), f.removeClass(o).addClass(c + " in" + i), n && v() }, v = function() { d || g && r(), f.removeClass("out in reverse " + c).height(""), p(), a.mobile.window.scrollTop() !== k && q(), h.resolve(c, e, f, g, !0) };
                    return p(), g && !n ? s() : t(), h.promise()
                }
            },
            e = d(),
            f = d(!1),
            g = function() { return a.mobile.getScreenHeight() * 3 };
        a.mobile.defaultTransitionHandler = e, a.mobile.transitionHandlers = { "default": a.mobile.defaultTransitionHandler, sequential: e, simultaneous: f }, a.mobile.transitionFallbacks = {}, a.mobile._maybeDegradeTransition = function(b) { return b && !a.support.cssTransform3d && a.mobile.transitionFallbacks[b] && (b = a.mobile.transitionFallbacks[b]), b }, a.mobile.getMaxScrollForTransition = a.mobile.getMaxScrollForTransition || g
    }(a, this), function(a, b, c, d) {
        function x(a) {
            while (a && typeof a.originalEvent != "undefined")a = a.originalEvent;
            return a
        }

        function y(b, c) {
            var e = b.type, f, g, i, k, l, m, n, o, p;
            b = a.Event(b), b.type = c, f = b.originalEvent, g = a.event.props, e.search(/^(mouse|click)/) > -1 && (g = j);
            if (f)for (n = g.length, k; n;)k = g[--n], b[k] = f[k];
            e.search(/mouse(down|up)|click/) > -1 && !b.which && (b.which = 1);
            if (e.search(/^touch/) !== -1) {
                i = x(f), e = i.touches, l = i.changedTouches, m = e && e.length ? e[0] : l && l.length ? l[0] : d;
                if (m)for (o = 0, p = h.length; o < p; o++)k = h[o], b[k] = m[k]
            }
            return b
        }

        function z(b) {
            var c = {}, d, f;
            while (b) {
                d = a.data(b, e);
                for (f in d)d[f] && (c[f] = c.hasVirtualBinding = !0);
                b = b.parentNode
            }
            return c
        }

        function A(b, c) {
            var d;
            while (b) {
                d = a.data(b, e);
                if (d && (!c || d[c]))return b;
                b = b.parentNode
            }
            return null
        }

        function B() { r = !1 }

        function C() { r = !0 }

        function D() { v = 0, p.length = 0, q = !1, C() }

        function E() { B() }

        function F() { G(), l = setTimeout(function() { l = 0, D() }, a.vmouse.resetTimerDuration) }

        function G() { l && (clearTimeout(l), l = 0) }

        function H(b, c, d) {
            var e;
            if (d && d[b] || !d && A(c.target, b))e = y(c, b), a(c.target).trigger(e);
            return e
        }

        function I(b) {
            var c = a.data(b.target, f);
            if (!q && (!v || v !== c)) {
                var d = H("v" + b.type, b);
                d && (d.isDefaultPrevented() && b.preventDefault(), d.isPropagationStopped() && b.stopPropagation(), d.isImmediatePropagationStopped() && b.stopImmediatePropagation())
            }
        }

        function J(b) {
            var c = x(b).touches, d, e;
            if (c && c.length === 1) {
                d = b.target, e = z(d);
                if (e.hasVirtualBinding) {
                    v = u++, a.data(d, f, v), G(), E(), o = !1;
                    var g = x(b).touches[0];
                    m = g.pageX, n = g.pageY, H("vmouseover", b, e), H("vmousedown", b, e)
                }
            }
        }

        function K(a) {
            if (r)return;
            o || H("vmousecancel", a, z(a.target)), o = !0, F()
        }

        function L(b) {
            if (r)return;
            var c = x(b).touches[0], d = o, e = a.vmouse.moveDistanceThreshold, f = z(b.target);
            o = o || Math.abs(c.pageX - m) > e || Math.abs(c.pageY - n) > e, o && !d && H("vmousecancel", b, f), H("vmousemove", b, f), F()
        }

        function M(a) {
            if (r)return;
            C();
            var b = z(a.target), c;
            H("vmouseup", a, b);
            if (!o) {
                var d = H("vclick", a, b);
                d && d.isDefaultPrevented() && (c = x(a).changedTouches[0], p.push({ touchID: v, x: c.clientX, y: c.clientY }), q = !0)
            }
            H("vmouseout", a, b), o = !1, F()
        }

        function N(b) {
            var c = a.data(b, e), d;
            if (c)for (d in c)if (c[d])return!0;
            return!1
        }

        function O() {}

        function P(b) {
            var c = b.substr(1);
            return{
                setup: function(d, f) {
                    N(this) || a.data(this, e, {});
                    var g = a.data(this, e);
                    g[b] = !0, k[b] = (k[b] || 0) + 1, k[b] === 1 && t.bind(c, I), a(this).bind(c, O), s && (k.touchstart = (k.touchstart || 0) + 1, k.touchstart === 1 && t.bind("touchstart", J).bind("touchend", M).bind("touchmove", L).bind("scroll", K))
                },
                teardown: function(d, f) {
                    --k[b], k[b] || t.unbind(c, I), s && (--k.touchstart, k.touchstart || t.unbind("touchstart", J).unbind("touchmove", L).unbind("touchend", M).unbind("scroll", K));
                    var g = a(this), h = a.data(this, e);
                    h && (h[b] = !1), g.unbind(c, O), N(this) || g.removeData(e)
                }
            }
        }

        var e = "virtualMouseBindings", f = "virtualTouchID", g = "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "), h = "clientX clientY pageX pageY screenX screenY".split(" "), i = a.event.mouseHooks ? a.event.mouseHooks.props : [], j = a.event.props.concat(i), k = {}, l = 0, m = 0, n = 0, o = !1, p = [], q = !1, r = !1, s = "addEventListener" in c, t = a(c), u = 1, v = 0, w;
        a.vmouse = { moveDistanceThreshold: 10, clickDistanceThreshold: 10, resetTimerDuration: 1500 };
        for (var Q = 0; Q < g.length; Q++)a.event.special[g[Q]] = P(g[Q]);
        s && c.addEventListener("click", function(b) {
            var c = p.length, d = b.target, e, g, h, i, j, k;
            if (c) {
                e = b.clientX, g = b.clientY, w = a.vmouse.clickDistanceThreshold, h = d;
                while (h) {
                    for (i = 0; i < c; i++) {
                        j = p[i], k = 0;
                        if (h === d && Math.abs(j.x - e) < w && Math.abs(j.y - g) < w || a.data(h, f) === j.touchID) {
                            b.preventDefault(), b.stopPropagation();
                            return
                        }
                    }
                    h = h.parentNode
                }
            }
        }, !0)
    }(a, b, c), function(a, b, d) {
        function k(b, c, d) {
            var e = d.type;
            d.type = c, a.event.dispatch.call(b, d), d.type = e
        }

        var e = a(c);
        a.each("touchstart touchmove touchend tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(" "), function(b, c) { a.fn[c] = function(a) { return a ? this.bind(c, a) : this.trigger(c) }, a.attrFn && (a.attrFn[c] = !0) });
        var f = a.mobile.support.touch, g = "touchmove scroll", h = f ? "touchstart" : "mousedown", i = f ? "touchend" : "mouseup", j = f ? "touchmove" : "mousemove";
        a.event.special.scrollstart = {
            enabled: !0,
            setup: function() {
                function f(a, c) { d = c, k(b, d ? "scrollstart" : "scrollstop", a) }

                var b = this, c = a(b), d, e;
                c.bind(g, function(b) {
                    if (!a.event.special.scrollstart.enabled)return;
                    d || f(b, !0), clearTimeout(e), e = setTimeout(function() { f(b, !1) }, 50)
                })
            }
        }, a.event.special.tap = {
            tapholdThreshold: 750,
            setup: function() {
                var b = this, c = a(b);
                c.bind("vmousedown", function(d) {
                    function i() { clearTimeout(h) }

                    function j() { i(), c.unbind("vclick", l).unbind("vmouseup", i), e.unbind("vmousecancel", j) }

                    function l(a) { j(), f === a.target && k(b, "tap", a) }

                    if (d.which && d.which !== 1)return!1;
                    var f = d.target, g = d.originalEvent, h;
                    c.bind("vmouseup", i).bind("vclick", l), e.bind("vmousecancel", j), h = setTimeout(function() { k(b, "taphold", a.Event("taphold", { target: f })) }, a.event.special.tap.tapholdThreshold)
                })
            }
        }, a.event.special.swipe = {
            scrollSupressionThreshold: 30, durationThreshold: 1e3, horizontalDistanceThreshold: 30, verticalDistanceThreshold: 75,
            start: function(b) {
                var c = b.originalEvent.touches ? b.originalEvent.touches[0] : b;
                return{ time: (new Date).getTime(), coords: [c.pageX, c.pageY], origin: a(b.target) }
            },
            stop: function(a) {
                var b = a.originalEvent.touches ? a.originalEvent.touches[0] : a;
                return{ time: (new Date).getTime(), coords: [b.pageX, b.pageY] }
            },
            handleSwipe: function(b, c) { c.time - b.time < a.event.special.swipe.durationThreshold && Math.abs(b.coords[0] - c.coords[0]) > a.event.special.swipe.horizontalDistanceThreshold && Math.abs(b.coords[1] - c.coords[1]) < a.event.special.swipe.verticalDistanceThreshold && b.origin.trigger("swipe").trigger(b.coords[0] > c.coords[0] ? "swipeleft" : "swiperight") },
            setup: function() {
                var b = this, c = a(b);
                c.bind(h, function(b) {
                    function g(b) {
                        if (!e)return;
                        f = a.event.special.swipe.stop(b), Math.abs(e.coords[0] - f.coords[0]) > a.event.special.swipe.scrollSupressionThreshold && b.preventDefault()
                    }

                    var e = a.event.special.swipe.start(b), f;
                    c.bind(j, g).one(i, function() { c.unbind(j, g), e && f && a.event.special.swipe.handleSwipe(e, f), e = f = d })
                })
            }
        }, a.each({ scrollstop: "scrollstart", taphold: "tap", swipeleft: "swipe", swiperight: "swipe" }, function(b, c) { a.event.special[b] = { setup: function() { a(this).bind(c, a.noop) } } })
    }(a, this), function(a, b) {
        function e(a) {
            var b;
            while (a) {
                b = typeof a.className == "string" && a.className + " ";
                if (b && b.indexOf("ui-btn ") > -1 && b.indexOf("ui-disabled ") < 0)break;
                a = a.parentNode
            }
            return a
        }

        function f(d, e, f, g, h) {
            var i = a.data(d[0], "buttonElements");
            d.removeClass(e).addClass(f), i && (i.bcls = a(c.createElement("div")).addClass(i.bcls + " " + f).removeClass(e).attr("class"), g !== b && (i.hover = g), i.state = h)
        }

        var d = function(a, c) {
            var d = a.getAttribute(c);
            return d === "true" ? !0 : d === "false" ? !1 : d === null ? b : d
        };
        a.fn.buttonMarkup = function(e) {
            var f = this, h = "data-" + a.mobile.ns, i;
            e = e && a.type(e) === "object" ? e : {};
            for (var j = 0; j < f.length; j++) {
                var k = f.eq(j), l = k[0], m = a.extend({}, a.fn.buttonMarkup.defaults, { icon: e.icon !== b ? e.icon : d(l, h + "icon"), iconpos: e.iconpos !== b ? e.iconpos : d(l, h + "iconpos"), theme: e.theme !== b ? e.theme : d(l, h + "theme") || a.mobile.getInheritedTheme(k, "c"), inline: e.inline !== b ? e.inline : d(l, h + "inline"), shadow: e.shadow !== b ? e.shadow : d(l, h + "shadow"), corners: e.corners !== b ? e.corners : d(l, h + "corners"), iconshadow: e.iconshadow !== b ? e.iconshadow : d(l, h + "iconshadow"), mini: e.mini !== b ? e.mini : d(l, h + "mini") }, e), n = "ui-btn-inner", o = "ui-btn-text", p, q, r = !1, s = "up", t, u, v, w;
                for (i in m)l.setAttribute(h + i, m[i]);
                d(l, h + "rel") === "popup" && k.attr("href") && (l.setAttribute("aria-haspopup", !0), l.setAttribute("aria-owns", k.attr("href"))), w = a.data(l.tagName === "INPUT" || l.tagName === "BUTTON" ? l.parentNode : l, "buttonElements"), w ? (l = w.outer, k = a(l), t = w.inner, u = w.text, a(w.icon).remove(), w.icon = null, r = w.hover, s = w.state) : (t = c.createElement(m.wrapperEls), u = c.createElement(m.wrapperEls)), v = m.icon ? c.createElement("span") : null, g && !w && g(), m.theme || (m.theme = a.mobile.getInheritedTheme(k, "c")), p = "ui-btn ", p += r ? "ui-btn-hover-" + m.theme : "", p += s ? " ui-btn-" + s + "-" + m.theme : "", p += m.shadow ? " ui-shadow" : "", p += m.corners ? " ui-btn-corner-all" : "", m.mini !== b && (p += m.mini === !0 ? " ui-mini" : " ui-fullsize"), m.inline !== b && (p += m.inline === !0 ? " ui-btn-inline" : " ui-btn-block"), m.icon && (m.icon = "ui-icon-" + m.icon, m.iconpos = m.iconpos || "left", q = "ui-icon " + m.icon, m.iconshadow && (q += " ui-icon-shadow")), m.iconpos && (p += " ui-btn-icon-" + m.iconpos, m.iconpos === "notext" && !k.attr("title") && k.attr("title", k.getEncodedText())), m.iconpos && m.iconpos === "notext" && !k.attr("title") && k.attr("title", k.getEncodedText()), w && k.removeClass(w.bcls || ""), k.removeClass("ui-link").addClass(p), t.className = n, u.className = o, w || t.appendChild(u);
                if (v) {
                    v.className = q;
                    if (!w || !w.icon)v.innerHTML = "&#160;", t.appendChild(v)
                }
                while (l.firstChild && !w)u.appendChild(l.firstChild);
                w || l.appendChild(t), w = { hover: r, state: s, bcls: p, outer: l, inner: t, text: u, icon: v }, a.data(l, "buttonElements", w), a.data(t, "buttonElements", w), a.data(u, "buttonElements", w), v && a.data(v, "buttonElements", w)
            }
            return this
        }, a.fn.buttonMarkup.defaults = { corners: !0, shadow: !0, iconshadow: !0, wrapperEls: "span" };
        var g = function() {
            var c = a.mobile.buttonMarkup.hoverDelay, d, h;
            a.mobile.document.bind({
                "vmousedown vmousecancel vmouseup vmouseover vmouseout focus blur scrollstart": function(g) {
                    var i, j = a(e(g.target)), k = g.originalEvent && /^touch/.test(g.originalEvent.type), l = g.type;
                    if (j.length) {
                        i = j.attr("data-" + a.mobile.ns + "theme");
                        if (l === "vmousedown")k ? d = setTimeout(function() { f(j, "ui-btn-up-" + i, "ui-btn-down-" + i, b, "down") }, c) : f(j, "ui-btn-up-" + i, "ui-btn-down-" + i, b, "down");
                        else if (l === "vmousecancel" || l === "vmouseup")f(j, "ui-btn-down-" + i, "ui-btn-up-" + i, b, "up");
                        else if (l === "vmouseover" || l === "focus")k ? h = setTimeout(function() { f(j, "ui-btn-up-" + i, "ui-btn-hover-" + i, !0, "") }, c) : f(j, "ui-btn-up-" + i, "ui-btn-hover-" + i, !0, "");
                        else if (l === "vmouseout" || l === "blur" || l === "scrollstart")f(j, "ui-btn-hover-" + i + " ui-btn-down-" + i, "ui-btn-up-" + i, !1, "up"), d && clearTimeout(d), h && clearTimeout(h)
                    }
                },
                "focusin focus": function(b) { a(e(b.target)).addClass(a.mobile.focusClass) },
                "focusout blur": function(b) { a(e(b.target)).removeClass(a.mobile.focusClass) }
            }), g = null
        };
        a.mobile.document.bind("pagecreate create", function(b) { a(":jqmData(role='button'), .ui-bar > a, .ui-header > a, .ui-footer > a, .ui-bar > :jqmData(role='controlgroup') > a", b.target).jqmEnhanceable().not("button, input, .ui-btn, :jqmData(role='none'), :jqmData(role='nojs')").buttonMarkup() })
    }(a), function(a, b) {
        var c = 0, d = Array.prototype.slice, e = a.cleanData;
        a.cleanData = function(b) {
            for (var c = 0, d; (d = b[c]) != null; c++)
                try {
                    a(d).triggerHandler("remove")
                } catch (f) {
                }
            e(b)
        }, a.widget = function(b, c, d) {
            var e, f, g, h, i = b.split(".")[0];
            b = b.split(".")[1], e = i + "-" + b, d || (d = c, c = a.Widget), a.expr[":"][e.toLowerCase()] = function(b) { return!!a.data(b, e) }, a[i] = a[i] || {}, f = a[i][b], g = a[i][b] = function(a, b) {
                if (!this._createWidget)return new g(a, b);
                arguments.length && this._createWidget(a, b)
            }, a.extend(g, f, { version: d.version, _proto: a.extend({}, d), _childConstructors: [] }), h = new c, h.options = a.widget.extend({}, h.options), a.each(d, function(b, e) {
                a.isFunction(e) && (d[b] = function() {
                    var a = function() { return c.prototype[b].apply(this, arguments) }, d = function(a) { return c.prototype[b].apply(this, a) };
                    return function() {
                        var b = this._super, c = this._superApply, f;
                        return this._super = a, this._superApply = d, f = e.apply(this, arguments), this._super = b, this._superApply = c, f
                    }
                }())
            }), g.prototype = a.widget.extend(h, { widgetEventPrefix: f ? h.widgetEventPrefix : b }, d, { constructor: g, namespace: i, widgetName: b, widgetFullName: e }), f ? (a.each(f._childConstructors, function(b, c) {
                var d = c.prototype;
                a.widget(d.namespace + "." + d.widgetName, g, c._proto)
            }), delete f._childConstructors) : c._childConstructors.push(g), a.widget.bridge(b, g)
        }, a.widget.extend = function(c) {
            var e = d.call(arguments, 1), f = 0, g = e.length, h, i;
            for (; f < g; f++)for (h in e[f])i = e[f][h], e[f].hasOwnProperty(h) && i !== b && (a.isPlainObject(i) ? c[h] = a.isPlainObject(c[h]) ? a.widget.extend({}, c[h], i) : a.widget.extend({}, i) : c[h] = i);
            return c
        }, a.widget.bridge = function(c, e) {
            var f = e.prototype.widgetFullName || c;
            a.fn[c] = function(g) {
                var h = typeof g == "string", i = d.call(arguments, 1), j = this;
                return g = !h && i.length ? a.widget.extend.apply(null, [g].concat(i)) : g, h ? this.each(function() {
                    var d, e = a.data(this, f);
                    if (!e)return a.error("cannot call methods on " + c + " prior to initialization; " + "attempted to call method '" + g + "'");
                    if (!a.isFunction(e[g]) || g.charAt(0) === "_")return a.error("no such method '" + g + "' for " + c + " widget instance");
                    d = e[g].apply(e, i);
                    if (d !== e && d !== b)return j = d && d.jquery ? j.pushStack(d.get()) : d, !1
                }) : this.each(function() {
                    var b = a.data(this, f);
                    b ? b.option(g || {})._init() : a.data(this, f, new e(g, this))
                }), j
            }
        }, a.Widget = function() {}, a.Widget._childConstructors = [], a.Widget.prototype = {
            widgetName: "widget", widgetEventPrefix: "", defaultElement: "<div>", options: { disabled: !1, create: null }, _createWidget: function(b, d) { d = a(d || this.defaultElement || this)[0], this.element = a(d), this.uuid = c++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = a.widget.extend({}, this.options, this._getCreateOptions(), b), this.bindings = a(), this.hoverable = a(), this.focusable = a(), d !== this && (a.data(d, this.widgetFullName, this), this._on(!0, this.element, { remove: function(a) { a.target === d && this.destroy() } }), this.document = a(d.style ? d.ownerDocument : d.document || d), this.window = a(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init() }, _getCreateOptions: a.noop, _getCreateEventData: a.noop, _create: a.noop, _init: a.noop, destroy: function() { this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(a.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled " + "ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus") }, _destroy: a.noop, widget: function() { return this.element },
            option: function(c, d) {
                var e = c, f, g, h;
                if (arguments.length === 0)return a.widget.extend({}, this.options);
                if (typeof c == "string") {
                    e = {}, f = c.split("."), c = f.shift();
                    if (f.length) {
                        g = e[c] = a.widget.extend({}, this.options[c]);
                        for (h = 0; h < f.length - 1; h++)g[f[h]] = g[f[h]] || {}, g = g[f[h]];
                        c = f.pop();
                        if (d === b)return g[c] === b ? null : g[c];
                        g[c] = d
                    } else {
                        if (d === b)return this.options[c] === b ? null : this.options[c];
                        e[c] = d
                    }
                }
                return this._setOptions(e), this
            },
            _setOptions: function(a) {
                var b;
                for (b in a)this._setOption(b, a[b]);
                return this
            },
            _setOption: function(a, b) { return this.options[a] = b, a === "disabled" && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!b).attr("aria-disabled", b), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this },
            enable: function() { return this._setOption("disabled", !1) },
            disable: function() { return this._setOption("disabled", !0) },
            _on: function(b, c, d) {
                var e, f = this;
                typeof b != "boolean" && (d = c, c = b, b = !1), d ? (c = e = a(c), this.bindings = this.bindings.add(c)) : (d = c, c = this.element, e = this.widget()), a.each(d, function(d, g) {
                    function h() {
                        if (!b && (f.options.disabled === !0 || a(this).hasClass("ui-state-disabled")))return;
                        return(typeof g == "string" ? f[g] : g).apply(f, arguments)
                    }

                    typeof g != "string" && (h.guid = g.guid = g.guid || h.guid || a.guid++);
                    var i = d.match(/^(\w+)\s*(.*)$/), j = i[1] + f.eventNamespace, k = i[2];
                    k ? e.delegate(k, j, h) : c.bind(j, h)
                })
            },
            _off: function(a, b) { b = (b || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, a.unbind(b).undelegate(b) },
            _delay: function(a, b) {
                function c() { return(typeof a == "string" ? d[a] : a).apply(d, arguments) }

                var d = this;
                return setTimeout(c, b || 0)
            },
            _hoverable: function(b) { this.hoverable = this.hoverable.add(b), this._on(b, { mouseenter: function(b) { a(b.currentTarget).addClass("ui-state-hover") }, mouseleave: function(b) { a(b.currentTarget).removeClass("ui-state-hover") } }) },
            _focusable: function(b) { this.focusable = this.focusable.add(b), this._on(b, { focusin: function(b) { a(b.currentTarget).addClass("ui-state-focus") }, focusout: function(b) { a(b.currentTarget).removeClass("ui-state-focus") } }) },
            _trigger: function(b, c, d) {
                var e, f, g = this.options[b];
                d = d || {}, c = a.Event(c), c.type = (b === this.widgetEventPrefix ? b : this.widgetEventPrefix + b).toLowerCase(), c.target = this.element[0], f = c.originalEvent;
                if (f)for (e in f)e in c || (c[e] = f[e]);
                return this.element.trigger(c, d), !(a.isFunction(g) && g.apply(this.element[0], [c].concat(d)) === !1 || c.isDefaultPrevented())
            }
        }, a.each({ show: "fadeIn", hide: "fadeOut" }, function(b, c) {
            a.Widget.prototype["_" + b] = function(d, e, f) {
                typeof e == "string" && (e = { effect: e });
                var g, h = e ? e === !0 || typeof e == "number" ? c : e.effect || c : b;
                e = e || {}, typeof e == "number" && (e = { duration: e }), g = !a.isEmptyObject(e), e.complete = f, e.delay && d.delay(e.delay), g && a.effects && a.effects.effect[h] ? d[b](e) : h !== b && d[h] ? d[h](e.duration, e.easing, f) : d.queue(function(c) { a(this)[b](), f && f.call(d[0]), c() })
            }
        })
    }(a), function(a, b) {
        a.widget("mobile.widget", {
            _createWidget: function() { a.Widget.prototype._createWidget.apply(this, arguments), this._trigger("init") },
            _getCreateOptions: function() {
                var c = this.element, d = {};
                return a.each(this.options, function(a) {
                    var e = c.jqmData(a.replace(/[A-Z]/g, function(a) { return"-" + a.toLowerCase() }));
                    e !== b && (d[a] = e)
                }), d
            },
            enhanceWithin: function(b, c) { this.enhance(a(this.options.initSelector, a(b)), c) },
            enhance: function(b, c) {
                var d, e, f = a(b), g = this;
                f = a.mobile.enhanceable(f), c && f.length && (d = a.mobile.closestPageData(f), e = d && d.keepNativeSelector() || "", f = f.not(e)), f[this.widgetName]()
            },
            raise: function(a) { throw"Widget [" + this.widgetName + "]: " + a }
        })
    }(a), function(a) {
        var b = a("meta[name=viewport]"), c = b.attr("content"), d = c + ",maximum-scale=1, user-scalable=no", e = c + ",maximum-scale=10, user-scalable=yes", f = /(user-scalable[\s]*=[\s]*no)|(maximum-scale[\s]*=[\s]*1)[$,\s]/.test(c);
        a.mobile.zoom = a.extend({}, { enabled: !f, locked: !1, disable: function(c) { !f && !a.mobile.zoom.locked && (b.attr("content", d), a.mobile.zoom.enabled = !1, a.mobile.zoom.locked = c || !1) }, enable: function(c) { !f && (!a.mobile.zoom.locked || c === !0) && (b.attr("content", e), a.mobile.zoom.enabled = !0, a.mobile.zoom.locked = !1) }, restore: function() { f || (b.attr("content", c), a.mobile.zoom.enabled = !0) } })
    }(a), function(a, c) {
        var d, e, f, g = "&ui-state=dialog";
        a.mobile.path = d = {
            uiStateKey: "&ui-state", urlParseRE: /^\s*(((([^:\/#\?]+:)?(?:(\/\/)((?:(([^:@\/#\?]+)(?:\:([^:@\/#\?]+))?)@)?(([^:\/#\?\]\[]+|\[[^\/\]@#?]+\])(?:\:([0-9]+))?))?)?)?((\/?(?:[^\/\?#]+\/+)*)([^\?#]*)))?(\?[^#]+)?)(#.*)?/,
            getLocation: function(a) {
                var b = a ? this.parseUrl(a) : location, c = this.parseUrl(a || location.href).hash;
                return c = c === "#" ? "" : c, b.protocol + "//" + b.host + b.pathname + b.search + c
            },
            parseLocation: function() { return this.parseUrl(this.getLocation()) },
            parseUrl: function(b) {
                if (a.type(b) === "object")return b;
                var c = d.urlParseRE.exec(b || "") || [];
                return{ href: c[0] || "", hrefNoHash: c[1] || "", hrefNoSearch: c[2] || "", domain: c[3] || "", protocol: c[4] || "", doubleSlash: c[5] || "", authority: c[6] || "", username: c[8] || "", password: c[9] || "", host: c[10] || "", hostname: c[11] || "", port: c[12] || "", pathname: c[13] || "", directory: c[14] || "", filename: c[15] || "", search: c[16] || "", hash: c[17] || "" }
            },
            makePathAbsolute: function(a, b) {
                if (a && a.charAt(0) === "/")return a;
                a = a || "", b = b ? b.replace(/^\/|(\/[^\/]*|[^\/]+)$/g, "") : "";
                var c = b ? b.split("/") : [], d = a.split("/");
                for (var e = 0; e < d.length; e++) {
                    var f = d[e];
                    switch (f) {
                    case".":
                        break;
                    case"..":
                        c.length && c.pop();
                        break;
                    default:
                        c.push(f)
                    }
                }
                return"/" + c.join("/")
            },
            isSameDomain: function(a, b) { return d.parseUrl(a).domain === d.parseUrl(b).domain },
            isRelativeUrl: function(a) { return d.parseUrl(a).protocol === "" },
            isAbsoluteUrl: function(a) { return d.parseUrl(a).protocol !== "" },
            makeUrlAbsolute: function(a, b) {
                if (!d.isRelativeUrl(a))return a;
                b === c && (b = this.documentBase);
                var e = d.parseUrl(a), f = d.parseUrl(b), g = e.protocol || f.protocol, h = e.protocol ? e.doubleSlash : e.doubleSlash || f.doubleSlash, i = e.authority || f.authority, j = e.pathname !== "", k = d.makePathAbsolute(e.pathname || f.filename, f.pathname), l = e.search || !j && f.search || "", m = e.hash;
                return g + h + i + k + l + m
            },
            addSearchParams: function(b, c) {
                var e = d.parseUrl(b), f = typeof c == "object" ? a.param(c) : c, g = e.search || "?";
                return e.hrefNoSearch + g + (g.charAt(g.length - 1) !== "?" ? "&" : "") + f + (e.hash || "")
            },
            convertUrlToDataUrl: function(a) {
                var c = d.parseUrl(a);
                return d.isEmbeddedPage(c) ? c.hash.split(g)[0].replace(/^#/, "").replace(/\?.*$/, "") : d.isSameDomain(c, this.documentBase) ? c.hrefNoHash.replace(this.documentBase.domain, "").split(g)[0] : b.decodeURIComponent(a)
            },
            get: function(a) { return a === c && (a = d.parseLocation().hash), d.stripHash(a).replace(/[^\/]*\.[^\/*]+$/, "") },
            set: function(a) { location.hash = a },
            isPath: function(a) { return/\//.test(a) },
            clean: function(a) { return a.replace(this.documentBase.domain, "") },
            stripHash: function(a) { return a.replace(/^#/, "") },
            stripQueryParams: function(a) { return a.replace(/\?.*$/, "") },
            cleanHash: function(a) { return d.stripHash(a.replace(/\?.*$/, "").replace(g, "")) },
            isHashValid: function(a) { return/^#[^#]+$/.test(a) },
            isExternal: function(a) {
                var b = d.parseUrl(a);
                return b.protocol && b.domain !== this.documentUrl.domain ? !0 : !1
            },
            hasProtocol: function(a) { return/^(:?\w+:)/.test(a) },
            isEmbeddedPage: function(a) {
                var b = d.parseUrl(a);
                return b.protocol !== "" ? !this.isPath(b.hash) && b.hash && (b.hrefNoHash === this.documentUrl.hrefNoHash || this.documentBaseDiffers && b.hrefNoHash === this.documentBase.hrefNoHash) : /^#/.test(b.href)
            },
            squash: function(a, b) {
                var c, e, f, g, h, i = this.isPath(a), j = this.parseUrl(a), k = j.hash, l = "";
                b = b || (d.isPath(a) ? d.getLocation() : d.getDocumentUrl()), f = i ? d.stripHash(a) : a, f = d.isPath(j.hash) ? d.stripHash(j.hash) : f, h = f.indexOf(this.uiStateKey), h > -1 && (l = f.slice(h), f = f.slice(0, h)), e = d.makeUrlAbsolute(f, b), g = this.parseUrl(e).search;
                if (i) {
                    if (d.isPath(k) || k.replace("#", "").indexOf(this.uiStateKey) === 0)k = "";
                    l && k.indexOf(this.uiStateKey) === -1 && (k += l), k.indexOf("#") === -1 && k !== "" && (k = "#" + k), e = d.parseUrl(e), e = e.protocol + "//" + e.host + e.pathname + g + k
                } else e += e.indexOf("#") > -1 ? l : "#" + l;
                return e
            },
            isPreservableHash: function(a) { return a.replace("#", "").indexOf(this.uiStateKey) === 0 }
        }, d.documentUrl = d.parseLocation(), f = a("head").find("base"), d.documentBase = f.length ? d.parseUrl(d.makeUrlAbsolute(f.attr("href"), d.documentUrl.href)) : d.documentUrl, d.documentBaseDiffers = d.documentUrl.hrefNoHash !== d.documentBase.hrefNoHash, d.getDocumentUrl = function(b) { return b ? a.extend({}, d.documentUrl) : d.documentUrl.href }, d.getDocumentBase = function(b) { return b ? a.extend({}, d.documentBase) : d.documentBase.href }
    }(a), function(a, b) {
        var c = a.mobile.path;
        a.mobile.History = function(a, b) { this.stack = a || [], this.activeIndex = b || 0 }, a.extend(a.mobile.History.prototype, {
            getActive: function() { return this.stack[this.activeIndex] }, getLast: function() { return this.stack[this.previousIndex] }, getNext: function() { return this.stack[this.activeIndex + 1] }, getPrev: function() { return this.stack[this.activeIndex - 1] }, add: function(a, b) { b = b || {}, this.getNext() && this.clearForward(), b.hash && b.hash.indexOf("#") === -1 && (b.hash = "#" + b.hash), b.url = a, this.stack.push(b), this.activeIndex = this.stack.length - 1 }, clearForward: function() { this.stack = this.stack.slice(0, this.activeIndex + 1) },
            find: function(a, b, c) {
                b = b || this.stack;
                var d, e, f = b.length, g;
                for (e = 0; e < f; e++) {
                    d = b[e];
                    if (decodeURIComponent(a) === decodeURIComponent(d.url) || decodeURIComponent(a) === decodeURIComponent(d.hash)) {
                        g = e;
                        if (c)return g
                    }
                }
                return g
            },
            closest: function(a) {
                var c, d = this.activeIndex;
                return c = this.find(a, this.stack.slice(0, d)), c === b && (c = this.find(a, this.stack.slice(d), !0), c = c === b ? c : c + d), c
            },
            direct: function(c) {
                var d = this.closest(c.url), e = this.activeIndex;
                d !== b && (this.activeIndex = d, this.previousIndex = e), d < e ? (c.present || c.back || a.noop)(this.getActive(), "back") : d > e ? (c.present || c.forward || a.noop)(this.getActive(), "forward") : d === b && c.missing && c.missing(this.getActive())
            }
        })
    }(a), function(a, d) {
        var e = a.mobile.path;
        a.mobile.Navigator = function(b) { this.history = b, this.ignoreInitialHashChange = !0, setTimeout(a.proxy(function() { this.ignoreInitialHashChange = !1 }, this), 200), a.mobile.window.bind({ "popstate.history": a.proxy(this.popstate, this), "hashchange.history": a.proxy(this.hashchange, this) }) }, a.extend(a.mobile.Navigator.prototype, {
            squash: function(d, f) {
                var g, h, i = e.isPath(d) ? e.stripHash(d) : d;
                return h = e.squash(d), g = a.extend({ hash: i, url: h }, f), b.history.replaceState(g, g.title || c.title, h), g
            },
            hash: function(a, b) {
                var c, d, f;
                c = e.parseUrl(a), d = e.parseLocation();
                if (d.pathname + d.search === c.pathname + c.search)f = c.hash ? c.hash : c.pathname + c.search;
                else if (e.isPath(a)) {
                    var g = e.parseUrl(b);
                    f = g.pathname + g.search + (e.isPreservableHash(g.hash) ? g.hash.replace("#", "") : "")
                } else f = a;
                return f
            },
            go: function(d, f, g) {
                var h, i, j, k, l = a.event.special.navigate.isPushStateEnabled();
                i = e.squash(d), j = this.hash(d, i), g && j !== e.stripHash(e.parseLocation().hash) && (this.preventNextHashChange = g), this.preventHashAssignPopState = !0, b.location.hash = j, this.preventHashAssignPopState = !1, h = a.extend({ url: i, hash: j, title: c.title }, f), l && (k = new a.Event("popstate"), k.originalEvent = { type: "popstate", state: null }, this.squash(d, h), g || (this.ignorePopState = !0, a.mobile.window.trigger(k))), this.history.add(h.url, h)
            },
            popstate: function(b) {
                var c, d, f, g;
                if (!a.event.special.navigate.isPushStateEnabled())return;
                if (this.preventHashAssignPopState) {
                    this.preventHashAssignPopState = !1, b.stopImmediatePropagation();
                    return
                }
                if (this.ignorePopState) {
                    this.ignorePopState = !1;
                    return
                }
                if (!b.originalEvent.state && this.history.stack.length === 1 && this.ignoreInitialHashChange) {
                    this.ignoreInitialHashChange = !1;
                    return
                }
                d = e.parseLocation().hash;
                if (!b.originalEvent.state && d) {
                    f = this.squash(d), this.history.add(f.url, f), b.historyState = f;
                    return
                }
                this.history.direct({ url: (b.originalEvent.state || {}).url || d, present: function(c, d) { b.historyState = a.extend({}, c), b.historyState.direction = d } })
            },
            hashchange: function(b) {
                var d, f;
                if (!a.event.special.navigate.isHashChangeEnabled() || a.event.special.navigate.isPushStateEnabled())return;
                if (this.preventNextHashChange) {
                    this.preventNextHashChange = !1, b.stopImmediatePropagation();
                    return
                }
                d = this.history, f = e.parseLocation().hash, this.history.direct({ url: f, present: function(c, d) { b.hashchangeState = a.extend({}, c), b.hashchangeState.direction = d }, missing: function() { d.add(f, { hash: f, title: c.title }) } })
            }
        })
    }(a), function(a, b) {
        a.mobile.navigate = function(b, c, d) { a.mobile.navigate.navigator.go(b, c, d) }, a.mobile.navigate.history = new a.mobile.History, a.mobile.navigate.navigator = new a.mobile.Navigator(a.mobile.navigate.history);
        var c = a.mobile.path.parseLocation();
        a.mobile.navigate.history.add(c.href, { hash: c.hash })
    }(a), function(a, b) {
        a.mobile.behaviors.addFirstLastClasses = {
            _getVisibles: function(a, b) {
                var c;
                return b ? c = a.not(".ui-screen-hidden") : (c = a.filter(":visible"), c.length === 0 && (c = a.not(".ui-screen-hidden"))), c
            },
            _addFirstLastClasses: function(a, b, c) { a.removeClass("ui-first-child ui-last-child"), b.eq(0).addClass("ui-first-child").end().last().addClass("ui-last-child"), c || this.element.trigger("updatelayout") }
        }
    }(a), function(a, b) {
        a.widget("mobile.collapsible", a.mobile.widget, {
            options: { expandCueText: " click to expand contents", collapseCueText: " click to collapse contents", collapsed: !0, heading: "h1,h2,h3,h4,h5,h6,legend", collapsedIcon: "plus", expandedIcon: "minus", iconpos: "left", theme: null, contentTheme: null, inset: !0, corners: !0, mini: !1, initSelector: ":jqmData(role='collapsible')" },
            _create: function() {
                var c = this.element, d = this.options, e = c.addClass("ui-collapsible"), f = c.children(d.heading).first(), g = e.wrapInner("<div class='ui-collapsible-content'></div>").children(".ui-collapsible-content"), h = c.closest(":jqmData(role='collapsible-set')").addClass("ui-collapsible-set"), i = "";
                f.is("legend") && (f = a("<div role='heading'>" + f.html() + "</div>").insertBefore(f), f.next().remove()), h.length ? (d.theme || (d.theme = h.jqmData("theme") || a.mobile.getInheritedTheme(h, "c")), d.contentTheme || (d.contentTheme = h.jqmData("content-theme")), d.collapsedIcon = c.jqmData("collapsed-icon") || h.jqmData("collapsed-icon") || d.collapsedIcon, d.expandedIcon = c.jqmData("expanded-icon") || h.jqmData("expanded-icon") || d.expandedIcon, d.iconpos = c.jqmData("iconpos") || h.jqmData("iconpos") || d.iconpos, h.jqmData("inset") !== b ? d.inset = h.jqmData("inset") : d.inset = !0, d.corners = !1, d.mini || (d.mini = h.jqmData("mini"))) : d.theme || (d.theme = a.mobile.getInheritedTheme(c, "c")), !d.inset || (i += " ui-collapsible-inset", !d.corners || (i += " ui-corner-all")), d.contentTheme && (i += " ui-collapsible-themed-content", g.addClass("ui-body-" + d.contentTheme)), i !== "" && e.addClass(i), f.insertBefore(g).addClass("ui-collapsible-heading").append("<span class='ui-collapsible-heading-status'></span>").wrapInner("<a href='#' class='ui-collapsible-heading-toggle'></a>").find("a").first().buttonMarkup({ shadow: !1, corners: !1, iconpos: d.iconpos, icon: d.collapsedIcon, mini: d.mini, theme: d.theme }), e.bind("expand collapse", function(b) {
                    if (!b.isDefaultPrevented()) {
                        var c = a(this), e = b.type === "collapse";
                        b.preventDefault(), f.toggleClass("ui-collapsible-heading-collapsed", e).find(".ui-collapsible-heading-status").text(e ? d.expandCueText : d.collapseCueText).end().find(".ui-icon").toggleClass("ui-icon-" + d.expandedIcon, !e).toggleClass("ui-icon-" + d.collapsedIcon, e || d.expandedIcon === d.collapsedIcon).end().find("a").first().removeClass(a.mobile.activeBtnClass), c.toggleClass("ui-collapsible-collapsed", e), g.toggleClass("ui-collapsible-content-collapsed", e).attr("aria-hidden", e), g.trigger("updatelayout")
                    }
                }).trigger(d.collapsed ? "collapse" : "expand"), f.bind("tap", function(b) { f.find("a").first().addClass(a.mobile.activeBtnClass) }).bind("click", function(a) {
                    var b = f.is(".ui-collapsible-heading-collapsed") ? "expand" : "collapse";
                    e.trigger(b), a.preventDefault(), a.stopPropagation()
                })
            }
        }), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.collapsible.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.widget("mobile.collapsibleset", a.mobile.widget, {
            options: { initSelector: ":jqmData(role='collapsible-set')" },
            _create: function() {
                var c = this.element.addClass("ui-collapsible-set"), d = this.options;
                d.theme || (d.theme = a.mobile.getInheritedTheme(c, "c")), d.contentTheme || (d.contentTheme = c.jqmData("content-theme")), d.corners || (d.corners = c.jqmData("corners")), c.jqmData("inset") !== b && (d.inset = c.jqmData("inset")), d.inset = d.inset !== b ? d.inset : !0, d.corners = d.corners !== b ? d.corners : !0, !!d.corners && !!d.inset && c.addClass("ui-corner-all"), c.jqmData("collapsiblebound") || c.jqmData("collapsiblebound", !0).bind("expand", function(b) {
                    var c = a(b.target).closest(".ui-collapsible");
                    c.parent().is(":jqmData(role='collapsible-set')") && c.siblings(".ui-collapsible").trigger("collapse")
                })
            },
            _init: function() {
                var a = this.element, b = a.children(":jqmData(role='collapsible')"), c = b.filter(":jqmData(collapsed='false')");
                this._refresh("true"), c.trigger("expand")
            },
            _refresh: function(b) {
                var c = this.element.children(":jqmData(role='collapsible')");
                a.mobile.collapsible.prototype.enhance(c.not(".ui-collapsible")), this._addFirstLastClasses(c, this._getVisibles(c, b), b)
            },
            refresh: function() { this._refresh(!1) }
        }), a.widget("mobile.collapsibleset", a.mobile.collapsibleset, a.mobile.behaviors.addFirstLastClasses), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.collapsibleset.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.extend(a.mobile, { loadingMessageTextVisible: d, loadingMessageTheme: d, loadingMessage: d, showPageLoadingMsg: function(b, c, d) { a.mobile.loading("show", b, c, d) }, hidePageLoadingMsg: function() { a.mobile.loading("hide") }, loading: function() { this.loaderWidget.loader.apply(this.loaderWidget, arguments) } });
        var c = "ui-loader", e = a("html"), f = a.mobile.window;
        a.widget("mobile.loader", {
            options: { theme: "a", textVisible: !1, html: "", text: "loading" }, defaultHtml: "<div class='" + c + "'>" + "<span class='ui-icon ui-icon-loading'></span>" + "<h1></h1>" + "</div>",
            fakeFixLoader: function() {
                var b = a("." + a.mobile.activeBtnClass).first();
                this.element.css({ top: a.support.scrollTop && f.scrollTop() + f.height() / 2 || b.length && b.offset().top || 100 })
            },
            checkLoaderPosition: function() {
                var b = this.element.offset(), c = f.scrollTop(), d = a.mobile.getScreenHeight();
                if (b.top < c || b.top - c > d)this.element.addClass("ui-loader-fakefix"), this.fakeFixLoader(), f.unbind("scroll", this.checkLoaderPosition).bind("scroll", a.proxy(this.fakeFixLoader, this))
            },
            resetHtml: function() { this.element.html(a(this.defaultHtml).html()) },
            show: function(b, g, h) {
                var i, j, k, l;
                this.resetHtml(), a.type(b) === "object" ? (l = a.extend({}, this.options, b), b = l.theme || a.mobile.loadingMessageTheme) : (l = this.options, b = b || a.mobile.loadingMessageTheme || l.theme), j = g || a.mobile.loadingMessage || l.text, e.addClass("ui-loading");
                if (a.mobile.loadingMessage !== !1 || l.html)a.mobile.loadingMessageTextVisible !== d ? i = a.mobile.loadingMessageTextVisible : i = l.textVisible, this.element.attr("class", c + " ui-corner-all ui-body-" + b + " ui-loader-" + (i || g || b.text ? "verbose" : "default") + (l.textonly || h ? " ui-loader-textonly" : "")), l.html ? this.element.html(l.html) : this.element.find("h1").text(j), this.element.appendTo(a.mobile.pageContainer), this.checkLoaderPosition(), f.bind("scroll", a.proxy(this.checkLoaderPosition, this))
            },
            hide: function() { e.removeClass("ui-loading"), a.mobile.loadingMessage && this.element.removeClass("ui-loader-fakefix"), a.mobile.window.unbind("scroll", this.fakeFixLoader), a.mobile.window.unbind("scroll", this.checkLoaderPosition) }
        }), f.bind("pagecontainercreate", function() { a.mobile.loaderWidget = a.mobile.loaderWidget || a(a.mobile.loader.prototype.defaultHtml).loader() })
    }(a, this), function(a, b) {
        a.widget("mobile.navbar", a.mobile.widget, {
            options: { iconpos: "top", grid: null, initSelector: ":jqmData(role='navbar')" },
            _create: function() {
                var d = this.element, e = d.find("a"), f = e.filter(":jqmData(icon)").length ? this.options.iconpos : b;
                d.addClass("ui-navbar ui-mini").attr("role", "navigation").find("ul").jqmEnhanceable().grid({ grid: this.options.grid }), e.buttonMarkup({ corners: !1, shadow: !1, inline: !0, iconpos: f }), d.delegate("a", "vclick", function(b) {
                    if (!a(b.target).hasClass("ui-disabled")) {
                        e.removeClass(a.mobile.activeBtnClass), a(this).addClass(a.mobile.activeBtnClass);
                        var d = a(this);
                        a(c).one("pagechange", function(b) { d.removeClass(a.mobile.activeBtnClass) })
                    }
                }), d.closest(".ui-page").bind("pagebeforeshow", function() { e.filter(".ui-state-persist").addClass(a.mobile.activeBtnClass) })
            }
        }), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.navbar.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.widget("mobile.page", a.mobile.widget, {
            options: { theme: "c", domCache: !1, keepNativeDefault: ":jqmData(role='none'), :jqmData(role='nojs')" },
            _create: function() {
                if (this._trigger("beforecreate") === !1)return!1;
                this.element.attr("tabindex", "0").addClass("ui-page ui-body-" + this.options.theme), this._on(this.element, { pagebeforehide: "removeContainerBackground", pagebeforeshow: "_handlePageBeforeShow" })
            },
            _handlePageBeforeShow: function(a) { this.setContainerBackground() },
            removeContainerBackground: function() { a.mobile.pageContainer.removeClass("ui-overlay-" + a.mobile.getInheritedTheme(this.element.parent())) },
            setContainerBackground: function(b) { this.options.theme && a.mobile.pageContainer.addClass("ui-overlay-" + (b || this.options.theme)) },
            keepNativeSelector: function() {
                var b = this.options, c = b.keepNative && a.trim(b.keepNative);
                return c && b.keepNative !== b.keepNativeDefault ? [b.keepNative, b.keepNativeDefault].join(", ") : b.keepNativeDefault
            }
        })
    }(a), function(a, b) {
        a.mobile.page.prototype.options.degradeInputs = { color: !1, date: !1, datetime: !1, "datetime-local": !1, email: !1, month: !1, number: !1, range: "number", search: "text", tel: !1, time: !1, url: !1, week: !1 }, a.mobile.document.bind("pagecreate create", function(b) {
            var c = a.mobile.closestPageData(a(b.target)), d;
            if (!c)return;
            d = c.options, a(b.target).find("input").not(c.keepNativeSelector()).each(function() {
                var b = a(this), c = this.getAttribute("type"), e = d.degradeInputs[c] || "text";
                if (d.degradeInputs[c]) {
                    var f = a("<div>").html(b.clone()).html(), g = f.indexOf(" type=") > -1, h = g ? /\s+type=["']?\w+['"]?/ : /\/?>/, i = ' type="' + e + '" data-' + a.mobile.ns + 'type="' + c + '"' + (g ? "" : ">");
                    b.replaceWith(f.replace(h, i))
                }
            })
        })
    }(a), function(a, b) {
        a.widget("mobile.textinput", a.mobile.widget, {
            options: { theme: null, mini: !1, preventFocusZoom: /iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1, initSelector: "input[type='text'], input[type='search'], :jqmData(type='search'), input[type='number'], :jqmData(type='number'), input[type='password'], input[type='email'], input[type='url'], input[type='tel'], textarea, input[type='time'], input[type='date'], input[type='month'], input[type='week'], input[type='datetime'], input[type='datetime-local'], input[type='color'], input:not([type]), input[type='file']", clearBtn: !1, clearSearchButtonText: null, clearBtnText: "clear text", disabled: !1 },
            _create: function() {
                function o() { setTimeout(function() { j.toggleClass("ui-input-clear-hidden", !c.val()) }, 0) }

                var b = this, c = this.element, d = this.options, e = d.theme || a.mobile.getInheritedTheme(this.element, "c"), f = " ui-body-" + e, g = d.mini ? " ui-mini" : "", h = c.is("[type='search'], :jqmData(type='search')"), i, j, k = d.clearSearchButtonText || d.clearBtnText, l = c.is("textarea, :jqmData(type='range')"), m = !!d.clearBtn && !l, n = c.is("input") && !c.is(":jqmData(type='range')");
                a("label[for='" + c.attr("id") + "']").addClass("ui-input-text"), i = c.addClass("ui-input-text ui-body-" + e), typeof c[0].autocorrect != "undefined" && !a.support.touchOverflow && (c[0].setAttribute("autocorrect", "off"), c[0].setAttribute("autocomplete", "off")), h ? i = c.wrap("<div class='ui-input-search ui-shadow-inset ui-btn-corner-all ui-btn-shadow ui-icon-searchfield" + f + g + "'></div>").parent() : n && (i = c.wrap("<div class='ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow" + f + g + "'></div>").parent()), m || h ? (j = a("<a href='#' class='ui-input-clear' title='" + k + "'>" + k + "</a>").bind("click", function(a) { c.val("").focus().trigger("change"), j.addClass("ui-input-clear-hidden"), a.preventDefault() }).appendTo(i).buttonMarkup({ icon: "delete", iconpos: "notext", corners: !0, shadow: !0, mini: d.mini }), h || i.addClass("ui-input-has-clear"), o(), c.bind("paste cut keyup input focus change blur", o)) : !n && !h && c.addClass("ui-corner-all ui-shadow-inset" + f + g), c.focus(function() { d.preventFocusZoom && a.mobile.zoom.disable(!0), i.addClass(a.mobile.focusClass) }).blur(function() { i.removeClass(a.mobile.focusClass), d.preventFocusZoom && a.mobile.zoom.enable(!0) });
                if (c.is("textarea")) {
                    var p = 15, q = 100, r;
                    this._keyup = function() {
                        var a = c[0].scrollHeight, b = c[0].clientHeight;
                        b < a && c.height(a + p)
                    }, c.on("keyup change input paste", function() { clearTimeout(r), r = setTimeout(b._keyup, q) }), this._on(a.mobile.document, { pagechange: "_keyup" }), a.trim(c.val()) && this._on(a.mobile.window, { load: "_keyup" })
                }
                c.attr("disabled") && this.disable()
            },
            disable: function() {
                var a, b = this.element.is("[type='search'], :jqmData(type='search')"), c = this.element.is("input") && !this.element.is(":jqmData(type='range')"), d = this.element.attr("disabled", !0) && (c || b);
                return d ? a = this.element.parent() : a = this.element, a.addClass("ui-disabled"), this._setOption("disabled", !0)
            },
            enable: function() {
                var a, b = this.element.is("[type='search'], :jqmData(type='search')"), c = this.element.is("input") && !this.element.is(":jqmData(type='range')"), d = this.element.attr("disabled", !1) && (c || b);
                return d ? a = this.element.parent() : a = this.element, a.removeClass("ui-disabled"), this._setOption("disabled", !1)
            }
        }), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.textinput.prototype.enhanceWithin(b.target, !0) })
    }(a), function(a, d) {
        function w(b) { !!j && (!j.closest("." + a.mobile.activePageClass).length || b) && j.removeClass(a.mobile.activeBtnClass), j = null }

        function x() { o = !1, n.length > 0 && a.mobile.changePage.apply(null, n.pop()) }

        function B(b, c, d, e) {
            c && c.data("mobile-page")._trigger("beforehide", null, { nextPage: b }), b.data("mobile-page")._trigger("beforeshow", null, { prevPage: c || a("") }), a.mobile.hidePageLoadingMsg(), d = a.mobile._maybeDegradeTransition(d);
            var f = a.mobile.transitionHandlers[d || "default"] || a.mobile.defaultTransitionHandler, g = f(d, e, b, c);
            return g.done(function() { c && c.data("mobile-page")._trigger("hide", null, { nextPage: b }), b.data("mobile-page")._trigger("show", null, { prevPage: c || a("") }) }), g
        }

        function C(b, c) { c && b.attr("data-" + a.mobile.ns + "role", c), b.page() }

        function D() {
            var b = a.mobile.activePage && F(a.mobile.activePage);
            return b || s.hrefNoHash
        }

        function E(a) {
            while (a) {
                if (typeof a.nodeName == "string" && a.nodeName.toLowerCase() === "a")break;
                a = a.parentNode
            }
            return a
        }

        function F(b) {
            var c = a(b).closest(".ui-page").jqmData("url"), d = s.hrefNoHash;
            if (!c || !h.isPath(c))c = d;
            return h.makeUrlAbsolute(c, d)
        }

        var e = a.mobile.window, f = a("html"), g = a("head"),
            h = a.extend(a.mobile.path, {
                getFilePath: function(b) {
                    var c = "&" + a.mobile.subPageUrlKey;
                    return b && b.split(c)[0].split(p)[0]
                },
                isFirstPageUrl: function(b) {
                    var c = h.parseUrl(h.makeUrlAbsolute(b, this.documentBase)), e = c.hrefNoHash === this.documentUrl.hrefNoHash || this.documentBaseDiffers && c.hrefNoHash === this.documentBase.hrefNoHash, f = a.mobile.firstPage, g = f && f[0] ? f[0].id : d;
                    return e && (!c.hash || c.hash === "#" || g && c.hash.replace(/^#/, "") === g)
                },
                isPermittedCrossDomainRequest: function(b, c) { return a.mobile.allowCrossDomainPages && b.protocol === "file:" && c.search(/^https?:/) !== -1 }
            }),
            i = null,
            j = null,
            k = a.Deferred(),
            l = a.mobile.navigate.history,
            m = "[tabindex],a,button:visible,select:visible,input",
            n = [],
            o = !1,
            p = "&ui-state=dialog",
            q = g.children("base"),
            r = h.documentUrl,
            s = h.documentBase,
            t = h.documentBaseDiffers,
            u = a.mobile.getScreenHeight,
            v = a.support.dynamicBaseTag ? { element: q.length ? q : a("<base>", { href: s.hrefNoHash }).prependTo(g), set: function(a) { a = h.parseUrl(a).hrefNoHash, v.element.attr("href", h.makeUrlAbsolute(a, s)) }, reset: function() { v.element.attr("href", s.hrefNoSearch) } } : d;
        a.mobile.getDocumentUrl = h.getDocumentUrl, a.mobile.getDocumentBase = h.getDocumentBase, a.mobile.back = function() {
            var a = b.navigator;
            this.phonegapNavigationEnabled && a && a.app && a.app.backHistory ? a.app.backHistory() : b.history.back()
        }, a.mobile.focusPage = function(a) {
            var b = a.find("[autofocus]"), c = a.find(".ui-title:eq(0)");
            if (b.length) {
                b.focus();
                return
            }
            c.length ? c.focus() : a.focus()
        };
        var y = !0, z, A;
        z = function() {
            if (!y)return;
            var b = a.mobile.urlHistory.getActive();
            if (b) {
                var c = e.scrollTop();
                b.lastScroll = c < a.mobile.minScrollBack ? a.mobile.defaultHomeScroll : c
            }
        }, A = function() { setTimeout(z, 100) }, e.bind(a.support.pushState ? "popstate" : "hashchange", function() { y = !1 }), e.one(a.support.pushState ? "popstate" : "hashchange", function() { y = !0 }), e.one("pagecontainercreate", function() { a.mobile.pageContainer.bind("pagechange", function() { y = !0, e.unbind("scrollstop", A), e.bind("scrollstop", A) }) }), e.bind("scrollstop", A), a.mobile._maybeDegradeTransition = a.mobile._maybeDegradeTransition || function(a) { return a }, a.mobile.resetActivePageHeight = function(c) {
            var d = a("." + a.mobile.activePageClass), e = parseFloat(d.css("padding-top")), f = parseFloat(d.css("padding-bottom")), g = parseFloat(d.css("border-top-width")), h = parseFloat(d.css("border-bottom-width"));
            c = typeof c == "number" ? c : u(), d.css("min-height", c - e - f - g - h)
        }, a.fn.animationComplete = function(b) { return a.support.cssTransitions ? a(this).one("webkitAnimationEnd animationend", b) : (setTimeout(b, 0), a(this)) }, a.mobile.path = h, a.mobile.base = v, a.mobile.urlHistory = l, a.mobile.dialogHashKey = p, a.mobile.allowCrossDomainPages = !1, a.mobile._bindPageRemove = function() {
            var b = a(this);
            !b.data("mobile-page").options.domCache && b.is(":jqmData(external-page='true')") && b.bind("pagehide.remove", function(b) {
                var c = a(this), d = new a.Event("pageremove");
                c.trigger(d), d.isDefaultPrevented() || c.removeWithDependents()
            })
        }, a.mobile.loadPage = function(b, c) {
            var e = a.Deferred(), f = a.extend({}, a.mobile.loadPage.defaults, c), g = null, i = null, j = h.makeUrlAbsolute(b, D());
            f.data && f.type === "get" && (j = h.addSearchParams(j, f.data), f.data = d), f.data && f.type === "post" && (f.reloadPage = !0);
            var k = h.getFilePath(j), l = h.convertUrlToDataUrl(j);
            f.pageContainer = f.pageContainer || a.mobile.pageContainer, g = f.pageContainer.children("[data-" + a.mobile.ns + "url='" + l + "']"), g.length === 0 && l && !h.isPath(l) && (g = f.pageContainer.children("#" + l).attr("data-" + a.mobile.ns + "url", l).jqmData("url", l));
            if (g.length === 0)
                if (a.mobile.firstPage && h.isFirstPageUrl(k))a.mobile.firstPage.parent().length && (g = a(a.mobile.firstPage));
                else if (h.isEmbeddedPage(k))return e.reject(j, c), e.promise();
            if (g.length) {
                if (!f.reloadPage)return C(g, f.role), e.resolve(j, c, g), e.promise();
                i = g
            }
            var m = f.pageContainer, n = new a.Event("pagebeforeload"), o = { url: b, absUrl: j, dataUrl: l, deferred: e, options: f };
            m.trigger(n, o);
            if (n.isDefaultPrevented())return e.promise();
            if (f.showLoadMsg)var p = setTimeout(function() { a.mobile.showPageLoadingMsg() }, f.loadMsgDelay), q = function() { clearTimeout(p), a.mobile.hidePageLoadingMsg() };
            return v && v.reset(), !a.mobile.allowCrossDomainPages && !h.isSameDomain(r, j) ? e.reject(j, c) : a.ajax({
                url: k, type: f.type, data: f.data, dataType: "html",
                success: function(d, m, n) {
                    var p = a("<div></div>"), r = d.match(/<title[^>]*>([^<]*)/) && RegExp.$1, s = new RegExp("(<[^>]+\\bdata-" + a.mobile.ns + "role=[\"']?page[\"']?[^>]*>)"), t = new RegExp("\\bdata-" + a.mobile.ns + "url=[\"']?([^\"'>]*)[\"']?");
                    s.test(d) && RegExp.$1 && t.test(RegExp.$1) && RegExp.$1 && (b = k = h.getFilePath(a("<div>" + RegExp.$1 + "</div>").text())), v && v.set(k), p.get(0).innerHTML = d, g = p.find(":jqmData(role='page'), :jqmData(role='dialog')").first(), g.length || (g = a("<div data-" + a.mobile.ns + "role='page'>" + (d.split(/<\/?body[^>]*>/gmi)[1] || "") + "</div>")), r && !g.jqmData("title") && (~r.indexOf("&") && (r = a("<div>" + r + "</div>").text()), g.jqmData("title", r));
                    if (!a.support.dynamicBaseTag) {
                        var u = h.get(k);
                        g.find("[src], link[href], a[rel='external'], :jqmData(ajax='false'), a[target]").each(function() {
                            var b = a(this).is("[href]") ? "href" : a(this).is("[src]") ? "src" : "action", c = a(this).attr(b);
                            c = c.replace(location.protocol + "//" + location.host + location.pathname, ""), /^(\w+:|#|\/)/.test(c) || a(this).attr(b, u + c)
                        })
                    }
                    g.attr("data-" + a.mobile.ns + "url", h.convertUrlToDataUrl(k)).attr("data-" + a.mobile.ns + "external-page", !0).appendTo(f.pageContainer), g.one("pagecreate", a.mobile._bindPageRemove), C(g, f.role), j.indexOf("&" + a.mobile.subPageUrlKey) > -1 && (g = f.pageContainer.children("[data-" + a.mobile.ns + "url='" + l + "']")), f.showLoadMsg && q(), o.xhr = n, o.textStatus = m, o.page = g, f.pageContainer.trigger("pageload", o), e.resolve(j, c, g, i)
                },
                error: function(b, d, g) {
                    v && v.set(h.get()), o.xhr = b, o.textStatus = d, o.errorThrown = g;
                    var i = new a.Event("pageloadfailed");
                    f.pageContainer.trigger(i, o);
                    if (i.isDefaultPrevented())return;
                    f.showLoadMsg && (q(), a.mobile.showPageLoadingMsg(a.mobile.pageLoadErrorMessageTheme, a.mobile.pageLoadErrorMessage, !0), setTimeout(a.mobile.hidePageLoadingMsg, 1500)), e.reject(j, c)
                }
            }), e.promise()
        }, a.mobile.loadPage.defaults = { type: "get", data: d, reloadPage: !1, role: d, showLoadMsg: !1, pageContainer: d, loadMsgDelay: 50 }, a.mobile.changePage = function(b, e) {
            if (o) {
                n.unshift(arguments);
                return
            }
            var f = a.extend({}, a.mobile.changePage.defaults, e), g;
            f.pageContainer = f.pageContainer || a.mobile.pageContainer, f.fromPage = f.fromPage || a.mobile.activePage, g = typeof b == "string";
            var i = f.pageContainer, j = new a.Event("pagebeforechange"), k = { toPage: b, options: f };
            g ? k.absUrl = h.makeUrlAbsolute(b, D()) : k.absUrl = b.data("absUrl"), i.trigger(j, k);
            if (j.isDefaultPrevented())return;
            b = k.toPage, g = typeof b == "string", o = !0;
            if (g) {
                f.target = b, a.mobile.loadPage(b, f).done(function(b, c, d, e) { o = !1, c.duplicateCachedPage = e, d.data("absUrl", k.absUrl), a.mobile.changePage(d, c) }).fail(function(a, b) { o = !1, w(!0), x(), f.pageContainer.trigger("pagechangefailed", k) });
                return
            }
            b[0] === a.mobile.firstPage[0] && !f.dataUrl && (f.dataUrl = r.hrefNoHash);
            var m = f.fromPage, q = f.dataUrl && h.convertUrlToDataUrl(f.dataUrl) || b.jqmData("url"), s = q, t = h.getFilePath(q), u = l.getActive(), v = l.activeIndex === 0, y = 0, z = c.title, A = f.role === "dialog" || b.jqmData("role") === "dialog";
            if (m && m[0] === b[0] && !f.allowSamePageTransition) {
                o = !1, i.trigger("pagechange", k), f.fromHashChange && l.direct({ url: q });
                return
            }
            C(b, f.role), f.fromHashChange && (y = e.direction === "back" ? -1 : 1);
            try {
                c.activeElement && c.activeElement.nodeName.toLowerCase() !== "body" ? a(c.activeElement).blur() : a("input:focus, textarea:focus, select:focus").blur()
            } catch (E) {
            }
            var F = !1;
            A && u && (u.url && u.url.indexOf(p) > -1 && a.mobile.activePage && !a.mobile.activePage.is(".ui-dialog") && l.activeIndex > 0 && (f.changeHash = !1, F = !0), q = u.url || "", !F && q.indexOf("#") > -1 ? q += p : q += "#" + p, l.activeIndex === 0 && q === l.initialDst && (q += p));
            var G = u ? b.jqmData("title") || b.children(":jqmData(role='header')").find(".ui-title").getEncodedText() : z;
            !!G && z === c.title && (z = G), b.jqmData("title") || b.jqmData("title", z), f.transition = f.transition || (y && !v ? u.transition : d) || (A ? a.mobile.defaultDialogTransition : a.mobile.defaultPageTransition), !y && F && (l.getActive().pageUrl = s);
            if (q && !f.fromHashChange) {
                var H;
                !h.isPath(q) && q.indexOf("#") < 0 && (q = "#" + q), H = { transition: f.transition, title: z, pageUrl: s, role: f.role }, f.changeHash !== !1 && a.mobile.hashListeningEnabled ? a.mobile.navigate(q, H, !0) : b[0] !== a.mobile.firstPage[0] && a.mobile.navigate.history.add(q, H)
            }
            c.title = z, a.mobile.activePage = b, f.reverse = f.reverse || y < 0, B(b, m, f.transition, f.reverse).done(function(c, d, e, g, h) { w(), f.duplicateCachedPage && f.duplicateCachedPage.remove(), h || a.mobile.focusPage(b), x(), i.trigger("pagechange", k) })
        }, a.mobile.changePage.defaults = { transition: d, reverse: !1, changeHash: !0, fromHashChange: !1, role: d, duplicateCachedPage: d, pageContainer: d, showLoadMsg: !0, dataUrl: d, fromPage: d, allowSamePageTransition: !1 }, a.mobile.navreadyDeferred = a.Deferred(), a.mobile._registerInternalEvents = function() {
            var c = function(b, c) {
                var d, e, f, g = !0, j, k;
                return!a.mobile.ajaxEnabled || b.is(":jqmData(ajax='false')") || !b.jqmHijackable().length ? !1 : (e = b.attr("target"), f = b.attr("action"), f || (f = F(b), f === s.hrefNoHash && (f = r.hrefNoSearch)), f = h.makeUrlAbsolute(f, F(b)), h.isExternal(f) && !h.isPermittedCrossDomainRequest(r, f) || e ? !1 : (c || (d = b.attr("method"), j = b.serializeArray(), i && i[0].form === b[0] && (k = i.attr("name"), k && (a.each(j, function(a, b) { if (b.name === k)return k = "", !1 }), k && j.push({ name: k, value: i.attr("value") }))), g = { url: f, options: { type: d && d.length && d.toLowerCase() || "get", data: a.param(j), transition: b.jqmData("transition"), reverse: b.jqmData("direction") === "reverse", reloadPage: !0 } }), g))
            };
            a.mobile.document.delegate("form", "submit", function(b) {
                var d = c(a(this));
                d && (a.mobile.changePage(d.url, d.options), b.preventDefault())
            }), a.mobile.document.bind("vclick", function(b) {
                var d, e, f = b.target, g = !1;
                if (b.which > 1 || !a.mobile.linkBindingEnabled)return;
                i = a(f);
                if (a.data(f, "mobile-button")) {
                    if (!c(a(f).closest("form"), !0))return;
                    f.parentNode && (f = f.parentNode)
                } else {
                    f = E(f);
                    if (!f || h.parseUrl(f.getAttribute("href") || "#").hash === "#")return;
                    if (!a(f).jqmHijackable().length)return
                }
                ~f.className.indexOf("ui-link-inherit") ? f.parentNode && (e = a.data(f.parentNode, "buttonElements")) : e = a.data(f, "buttonElements"), e ? f = e.outer : g = !0, d = a(f), g && (d = d.closest(".ui-btn")), d.length > 0 && !d.hasClass("ui-disabled") && (w(!0), j = d, j.addClass(a.mobile.activeBtnClass))
            }), a.mobile.document.bind("click", function(c) {
                if (!a.mobile.linkBindingEnabled || c.isDefaultPrevented())return;
                var e = E(c.target), f = a(e), g;
                if (!e || c.which > 1 || !f.jqmHijackable().length)return;
                g = function() { b.setTimeout(function() { w(!0) }, 200) };
                if (f.is(":jqmData(rel='back')"))return a.mobile.back(), !1;
                var i = F(f), j = h.makeUrlAbsolute(f.attr("href") || "#", i);
                if (!a.mobile.ajaxEnabled && !h.isEmbeddedPage(j)) {
                    g();
                    return
                }
                if (j.search("#") !== -1) {
                    j = j.replace(/[^#]*#/, "");
                    if (!j) {
                        c.preventDefault();
                        return
                    }
                    h.isPath(j) ? j = h.makeUrlAbsolute(j, i) : j = h.makeUrlAbsolute("#" + j, r.hrefNoHash)
                }
                var k = f.is("[rel='external']") || f.is(":jqmData(ajax='false')") || f.is("[target]"), l = k || h.isExternal(j) && !h.isPermittedCrossDomainRequest(r, j);
                if (l) {
                    g();
                    return
                }
                var m = f.jqmData("transition"), n = f.jqmData("direction") === "reverse" || f.jqmData("back"), o = f.attr("data-" + a.mobile.ns + "rel") || d;
                a.mobile.changePage(j, { transition: m, reverse: n, role: o, link: f }), c.preventDefault()
            }), a.mobile.document.delegate(".ui-page", "pageshow.prefetch", function() {
                var b = [];
                a(this).find("a:jqmData(prefetch)").each(function() {
                    var c = a(this), d = c.attr("href");
                    d && a.inArray(d, b) === -1 && (b.push(d), a.mobile.loadPage(d, { role: c.attr("data-" + a.mobile.ns + "rel") }))
                })
            }), a.mobile._handleHashChange = function(c, e) {
                var f = h.stripHash(c), g = a.mobile.urlHistory.stack.length === 0 ? "none" : d, i = { changeHash: !1, fromHashChange: !0, reverse: e.direction === "back" };
                a.extend(i, e, { transition: (l.getLast() || {}).transition || g });
                if (l.activeIndex > 0 && f.indexOf(p) > -1 && l.initialDst !== f) {
                    if (a.mobile.activePage && !a.mobile.activePage.is(".ui-dialog")) {
                        e.direction === "back" ? a.mobile.back() : b.history.forward();
                        return
                    }
                    f = e.pageUrl;
                    var j = a.mobile.urlHistory.getActive();
                    a.extend(i, { role: j.role, transition: j.transition, reverse: e.direction === "back" })
                }
                f ? (f = h.isPath(f) ? f : h.makeUrlAbsolute("#" + f, s), f === h.makeUrlAbsolute("#" + l.initialDst, s) && l.stack.length && l.stack[0].url !== l.initialDst.replace(p, "") && (f = a.mobile.firstPage), a.mobile.changePage(f, i)) : a.mobile.changePage(a.mobile.firstPage, i)
            }, e.bind("navigate", function(b, c) {
                var d = a.event.special.navigate.originalEventName.indexOf("hashchange") > -1 ? c.state.hash : c.state.url;
                d || (d = a.mobile.path.parseLocation().hash);
                if (!d || d === "#" || d.indexOf("#" + a.mobile.path.uiStateKey) === 0)d = location.href;
                a.mobile._handleHashChange(d, c.state)
            }), a.mobile.document.bind("pageshow", a.mobile.resetActivePageHeight), a.mobile.window.bind("throttledresize", a.mobile.resetActivePageHeight)
        }, a(function() { k.resolve() }), a.when(k, a.mobile.navreadyDeferred).done(function() { a.mobile._registerInternalEvents() })
    }(a), function(a, b, c) {
        a.widget("mobile.dialog", a.mobile.widget, {
            options: { closeBtn: "left", closeBtnText: "Close", overlayTheme: "a", corners: !0, initSelector: ":jqmData(role='dialog')" }, _handlePageBeforeShow: function() { this._isCloseable = !0, this.options.overlayTheme && this.element.page("removeContainerBackground").page("setContainerBackground", this.options.overlayTheme) },
            _create: function() {
                var b = this, c = this.element, d = this.options.corners ? " ui-corner-all" : "", e = a("<div/>", { role: "dialog", "class": "ui-dialog-contain ui-overlay-shadow" + d });
                c.addClass("ui-dialog ui-overlay-" + this.options.overlayTheme), c.wrapInner(e), c.bind("vclick submit", function(b) {
                    var c = a(b.target).closest(b.type === "vclick" ? "a" : "form"), d;
                    c.length && !c.jqmData("transition") && (d = a.mobile.urlHistory.getActive() || {}, c.attr("data-" + a.mobile.ns + "transition", d.transition || a.mobile.defaultDialogTransition).attr("data-" + a.mobile.ns + "direction", "reverse"))
                }), this._on(c, { pagebeforeshow: "_handlePageBeforeShow" }), a.extend(this, { _createComplete: !1 }), this._setCloseBtn(this.options.closeBtn)
            },
            _setCloseBtn: function(b) {
                var c = this, d, e;
                this._headerCloseButton && (this._headerCloseButton.remove(), this._headerCloseButton = null), b !== "none" && (e = b === "left" ? "left" : "right", d = a("<a href='#' class='ui-btn-" + e + "' data-" + a.mobile.ns + "icon='delete' data-" + a.mobile.ns + "iconpos='notext'>" + this.options.closeBtnText + "</a>"), this.element.children().find(":jqmData(role='header')").first().prepend(d), this._createComplete && a.fn.buttonMarkup && d.buttonMarkup(), this._createComplete = !0, d.bind("click", function() { c.close() }), this._headerCloseButton = d)
            },
            _setOption: function(b, c) { b === "closeBtn" && (this._setCloseBtn(c), this._super(b, c), this.element.attr("data-" + (a.mobile.ns || "") + "close-btn", c)) },
            close: function() {
                var b, c, d = a.mobile.navigate.history;
                this._isCloseable && (this._isCloseable = !1, a.mobile.hashListeningEnabled && d.activeIndex > 0 ? a.mobile.back() : (b = Math.max(0, d.activeIndex - 1), c = d.stack[b].pageUrl || d.stack[b].url, d.previousIndex = d.activeIndex, d.activeIndex = b, a.mobile.path.isPath(c) || (c = a.mobile.path.makeUrlAbsolute("#" + c)), a.mobile.changePage(c, { direction: "back", changeHash: !1, fromHashChange: !0 })))
            }
        }), a.mobile.document.delegate(a.mobile.dialog.prototype.options.initSelector, "pagecreate", function() { a.mobile.dialog.prototype.enhance(this) })
    }(a, this), function(a, b) {
        a.mobile.page.prototype.options.backBtnText = "Back", a.mobile.page.prototype.options.addBackBtn = !1, a.mobile.page.prototype.options.backBtnTheme = null, a.mobile.page.prototype.options.headerTheme = "a", a.mobile.page.prototype.options.footerTheme = "a", a.mobile.page.prototype.options.contentTheme = null, a.mobile.document.bind("pagecreate", function(b) {
            var c = a(b.target), d = c.data("mobile-page").options, e = c.jqmData("role"), f = d.theme;
            a(":jqmData(role='header'), :jqmData(role='footer'), :jqmData(role='content')", c).jqmEnhanceable().each(function() {
                var b = a(this), g = b.jqmData("role"), h = b.jqmData("theme"), i = h || d.contentTheme || e === "dialog" && f, j, k, l, m;
                b.addClass("ui-" + g);
                if (g === "header" || g === "footer") {
                    var n = h || (g === "header" ? d.headerTheme : d.footerTheme) || f;
                    b.addClass("ui-bar-" + n).attr("role", g === "header" ? "banner" : "contentinfo"), g === "header" && (j = b.children("a, button"), k = j.hasClass("ui-btn-left"), l = j.hasClass("ui-btn-right"), k = k || j.eq(0).not(".ui-btn-right").addClass("ui-btn-left").length, l = l || j.eq(1).addClass("ui-btn-right").length), d.addBackBtn && g === "header" && a(".ui-page").length > 1 && c.jqmData("url") !== a.mobile.path.stripHash(location.hash) && !k && (m = a("<a href='javascript:void(0);' class='ui-btn-left' data-" + a.mobile.ns + "rel='back' data-" + a.mobile.ns + "icon='arrow-l'>" + d.backBtnText + "</a>").attr("data-" + a.mobile.ns + "theme", d.backBtnTheme || n).prependTo(b)), b.children("h1, h2, h3, h4, h5, h6").addClass("ui-title").attr({ role: "heading", "aria-level": "1" })
                } else g === "content" && (i && b.addClass("ui-body-" + i), b.attr("role", "main"))
            })
        })
    }(a), function(a, b) {
        a.widget("mobile.fixedtoolbar", a.mobile.widget, {
            options: { visibleOnPageShow: !0, disablePageZoom: !0, transition: "slide", fullscreen: !1, tapToggle: !0, tapToggleBlacklist: "a, button, input, select, textarea, .ui-header-fixed, .ui-footer-fixed, .ui-popup, .ui-panel, .ui-panel-dismiss-open", hideDuringFocus: "input, textarea, select", updatePagePadding: !0, trackPersistentToolbars: !0, supportBlacklist: function() { return!a.support.fixedPosition }, initSelector: ":jqmData(position='fixed')" },
            _create: function() {
                var b = this, c = b.options, d = b.element, e = d.is(":jqmData(role='header')") ? "header" : "footer", f = d.closest(".ui-page");
                if (c.supportBlacklist()) {
                    b.destroy();
                    return
                }
                d.addClass("ui-" + e + "-fixed"), c.fullscreen ? (d.addClass("ui-" + e + "-fullscreen"), f.addClass("ui-page-" + e + "-fullscreen")) : f.addClass("ui-page-" + e + "-fixed"), a.extend(this, { _thisPage: null }), b._addTransitionClass(), b._bindPageEvents(), b._bindToggleHandlers()
            },
            _addTransitionClass: function() {
                var a = this.options.transition;
                a && a !== "none" && (a === "slide" && (a = this.element.is(".ui-header") ? "slidedown" : "slideup"), this.element.addClass(a))
            },
            _bindPageEvents: function() { this._thisPage = this.element.closest(".ui-page"), this._on(this._thisPage, { pagebeforeshow: "_handlePageBeforeShow", webkitAnimationStart: "_handleAnimationStart", animationstart: "_handleAnimationStart", updatelayout: "_handleAnimationStart", pageshow: "_handlePageShow", pagebeforehide: "_handlePageBeforeHide" }) },
            _handlePageBeforeShow: function() {
                var b = this.options;
                b.disablePageZoom && a.mobile.zoom.disable(!0), b.visibleOnPageShow || this.hide(!0)
            },
            _handleAnimationStart: function() { this.options.updatePagePadding && this.updatePagePadding(this._thisPage) },
            _handlePageShow: function() { this.updatePagePadding(this._thisPage), this.options.updatePagePadding && this._on(a.mobile.window, { throttledresize: "updatePagePadding" }) },
            _handlePageBeforeHide: function(b, c) {
                var d = this.options;
                d.disablePageZoom && a.mobile.zoom.enable(!0), d.updatePagePadding && this._off(a.mobile.window, "throttledresize");
                if (d.trackPersistentToolbars) {
                    var e = a(".ui-footer-fixed:jqmData(id)", this._thisPage), f = a(".ui-header-fixed:jqmData(id)", this._thisPage), g = e.length && c.nextPage && a(".ui-footer-fixed:jqmData(id='" + e.jqmData("id") + "')", c.nextPage) || a(), h = f.length && c.nextPage && a(".ui-header-fixed:jqmData(id='" + f.jqmData("id") + "')", c.nextPage) || a();
                    if (g.length || h.length)g.add(h).appendTo(a.mobile.pageContainer), c.nextPage.one("pageshow", function() { h.prependTo(this), g.appendTo(this) })
                }
            },
            _visible: !0,
            updatePagePadding: function(b) {
                var c = this.element, d = c.is(".ui-header"), e = parseFloat(c.css(d ? "top" : "bottom"));
                if (this.options.fullscreen)return;
                b = b || this._thisPage || c.closest(".ui-page"), a(b).css("padding-" + (d ? "top" : "bottom"), c.outerHeight() + e)
            },
            _useTransition: function(b) {
                var c = a.mobile.window, d = this.element, e = c.scrollTop(), f = d.height(), g = d.closest(".ui-page").height(), h = a.mobile.getScreenHeight(), i = d.is(":jqmData(role='header')") ? "header" : "footer";
                return!b && (this.options.transition && this.options.transition !== "none" && (i === "header" && !this.options.fullscreen && e > f || i === "footer" && !this.options.fullscreen && e + h < g - f) || this.options.fullscreen)
            },
            show: function(a) {
                var b = "ui-fixed-hidden", c = this.element;
                this._useTransition(a) ? c.removeClass("out " + b).addClass("in").animationComplete(function() { c.removeClass("in") }) : c.removeClass(b), this._visible = !0
            },
            hide: function(a) {
                var b = "ui-fixed-hidden", c = this.element, d = "out" + (this.options.transition === "slide" ? " reverse" : "");
                this._useTransition(a) ? c.addClass(d).removeClass("in").animationComplete(function() { c.addClass(b).removeClass(d) }) : c.addClass(b).removeClass(d), this._visible = !1
            },
            toggle: function() { this[this._visible ? "hide" : "show"]() },
            _bindToggleHandlers: function() {
                var b = this, c, d = b.options, e = b.element;
                e.closest(".ui-page").bind("vclick", function(c) { d.tapToggle && !a(c.target).closest(d.tapToggleBlacklist).length && b.toggle() }).bind("focusin focusout", function(e) { screen.width < 1025 && a(e.target).is(d.hideDuringFocus) && !a(e.target).closest(".ui-header-fixed, .ui-footer-fixed").length && (e.type === "focusout" && !b._visible ? c = setTimeout(function() { b.show() }, 0) : e.type === "focusin" && b._visible && (clearTimeout(c), b.hide())) })
            },
            _destroy: function() {
                var a = this.element, b = a.is(".ui-header");
                a.closest(".ui-page").css("padding-" + (b ? "top" : "bottom"), ""), a.removeClass("ui-header-fixed ui-footer-fixed ui-header-fullscreen ui-footer-fullscreen in out fade slidedown slideup ui-fixed-hidden"), a.closest(".ui-page").removeClass("ui-page-header-fixed ui-page-footer-fixed ui-page-header-fullscreen ui-page-footer-fullscreen")
            }
        }), a.mobile.document.bind("pagecreate create", function(b) { a(b.target).jqmData("fullscreen") && a(a.mobile.fixedtoolbar.prototype.options.initSelector, b.target).not(":jqmData(fullscreen)").jqmData("fullscreen", !0), a.mobile.fixedtoolbar.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.widget("mobile.fixedtoolbar", a.mobile.fixedtoolbar, {
            _create: function() { this._super(), this._workarounds() },
            _workarounds: function() {
                var a = navigator.userAgent, b = navigator.platform, c = a.match(/AppleWebKit\/([0-9]+)/), d = !!c && c[1], e = null, f = this;
                if (b.indexOf("iPhone") > -1 || b.indexOf("iPad") > -1 || b.indexOf("iPod") > -1)e = "ios";
                else {
                    if (!(a.indexOf("Android") > -1))return;
                    e = "android"
                }
                if (e === "ios")f._bindScrollWorkaround();
                else {
                    if (!(e === "android" && d && d < 534))return;
                    f._bindScrollWorkaround(), f._bindListThumbWorkaround()
                }
            },
            _viewportOffset: function() {
                var b = this.element, c = b.is(".ui-header"), d = Math.abs(b.offset().top - a.mobile.window.scrollTop());
                return c || (d = Math.round(d - a.mobile.window.height() + b.outerHeight()) - 60), d
            },
            _bindScrollWorkaround: function() {
                var b = this;
                this._on(a.mobile.window, {
                    scrollstop: function() {
                        var a = b._viewportOffset();
                        a > 2 && b._visible && b._triggerRedraw()
                    }
                })
            },
            _bindListThumbWorkaround: function() { this.element.closest(".ui-page").addClass("ui-android-2x-fixed") },
            _triggerRedraw: function() {
                var b = parseFloat(a(".ui-page-active").css("padding-bottom"));
                a(".ui-page-active").css("padding-bottom", b + 1 + "px"), setTimeout(function() { a(".ui-page-active").css("padding-bottom", b + "px") }, 0)
            },
            destroy: function() { this._super(), this.element.closest(".ui-page-active").removeClass("ui-android-2x-fix") }
        })
    }(a), function(a, b) {
        var d = {};
        a.widget("mobile.listview", a.mobile.widget, {
            options: { theme: null, countTheme: "c", headerTheme: "b", dividerTheme: "b", icon: "arrow-r", splitIcon: "arrow-r", splitTheme: "b", corners: !0, shadow: !0, inset: !1, initSelector: ":jqmData(role='listview')" },
            _create: function() {
                var a = this, b = "";
                b += a.options.inset ? " ui-listview-inset" : "", !a.options.inset || (b += a.options.corners ? " ui-corner-all" : "", b += a.options.shadow ? " ui-shadow" : ""), a.element.addClass(function(a, c) { return c + " ui-listview" + b }), a.refresh(!0)
            },
            _findFirstElementByTagName: function(a, b, c, d) {
                var e = {};
                e[c] = e[d] = !0;
                while (a) {
                    if (e[a.nodeName])return a;
                    a = a[b]
                }
                return null
            },
            _getChildrenByTagName: function(b, c, d) {
                var e = [], f = {};
                f[c] = f[d] = !0, b = b.firstChild;
                while (b)f[b.nodeName] && e.push(b), b = b.nextSibling;
                return a(e)
            },
            _addThumbClasses: function(b) {
                var c, d, e = b.length;
                for (c = 0; c < e; c++)d = a(this._findFirstElementByTagName(b[c].firstChild, "nextSibling", "img", "IMG")), d.length && (d.addClass("ui-li-thumb"), a(this._findFirstElementByTagName(d[0].parentNode, "parentNode", "li", "LI")).addClass(d.is(".ui-li-icon") ? "ui-li-has-icon" : "ui-li-has-thumb"))
            },
            refresh: function(b) {
                this.parentPage = this.element.closest(".ui-page"), this._createSubPages();
                var d = this.options, e = this.element, f = this, g = e.jqmData("dividertheme") || d.dividerTheme, h = e.jqmData("splittheme"), i = e.jqmData("spliticon"), j = e.jqmData("icon"), k = this._getChildrenByTagName(e[0], "li", "LI"), l = !!a.nodeName(e[0], "ol"), m = !a.support.cssPseudoElement, n = e.attr("start"), o = {}, p, q, r, s, t, u, v, w, x, y, z, A, B, C;
                l && m && e.find(".ui-li-dec").remove(), l && (n || n === 0 ? m ? v = parseInt(n, 10) : (w = parseInt(n, 10) - 1, e.css("counter-reset", "listnumbering " + w)) : m && (v = 1)), d.theme || (d.theme = a.mobile.getInheritedTheme(this.element, "c"));
                for (var D = 0, E = k.length; D < E; D++) {
                    p = k.eq(D), q = "ui-li";
                    if (b || !p.hasClass("ui-li")) {
                        r = p.jqmData("theme") || d.theme, s = this._getChildrenByTagName(p[0], "a", "A");
                        var F = p.jqmData("role") === "list-divider";
                        s.length && !F ? (z = p.jqmData("icon"), p.buttonMarkup({ wrapperEls: "div", shadow: !1, corners: !1, iconpos: "right", icon: s.length > 1 || z === !1 ? !1 : z || j || d.icon, theme: r }), z !== !1 && s.length === 1 && p.addClass("ui-li-has-arrow"), s.first().removeClass("ui-link").addClass("ui-link-inherit"), s.length > 1 && (q += " ui-li-has-alt", t = s.last(), u = h || t.jqmData("theme") || d.splitTheme, C = t.jqmData("icon"), t.appendTo(p).attr("title", a.trim(t.getEncodedText())).addClass("ui-li-link-alt").empty().buttonMarkup({ shadow: !1, corners: !1, theme: r, icon: !1, iconpos: "notext" }).find(".ui-btn-inner").append(a(c.createElement("span")).buttonMarkup({ shadow: !0, corners: !0, theme: u, iconpos: "notext", icon: C || z || i || d.splitIcon })))) : F ? (q += " ui-li-divider ui-bar-" + (p.jqmData("theme") || g), p.attr("role", "heading"), l && (n || n === 0 ? m ? v = parseInt(n, 10) : (x = parseInt(n, 10) - 1, p.css("counter-reset", "listnumbering " + x)) : m && (v = 1))) : q += " ui-li-static ui-btn-up-" + r
                    }
                    l && m && q.indexOf("ui-li-divider") < 0 && (y = q.indexOf("ui-li-static") > 0 ? p : p.find(".ui-link-inherit"), y.addClass("ui-li-jsnumbering").prepend("<span class='ui-li-dec'>" + v++ + ". </span>")), o[q] || (o[q] = []), o[q].push(p[0])
                }
                for (q in o)a(o[q]).addClass(q).children(".ui-btn-inner").addClass(q);
                e.find("h1, h2, h3, h4, h5, h6").addClass("ui-li-heading").end().find("p, dl").addClass("ui-li-desc").end().find(".ui-li-aside").each(function() {
                    var b = a(this);
                    b.prependTo(b.parent())
                }).end().find(".ui-li-count").each(function() { a(this).closest("li").addClass("ui-li-has-count") }).addClass("ui-btn-up-" + (e.jqmData("counttheme") || this.options.countTheme) + " ui-btn-corner-all"), this._addThumbClasses(k), this._addThumbClasses(e.find(".ui-link-inherit")), this._addFirstLastClasses(k, this._getVisibles(k, b), b), this._trigger("afterrefresh")
            },
            _idStringEscape: function(a) { return a.replace(/[^a-zA-Z0-9]/g, "-") },
            _createSubPages: function() {
                var b = this.element, c = b.closest(".ui-page"), e = c.jqmData("url"), f = e || c[0][a.expando], g = b.attr("id"), h = this.options, i = "data-" + a.mobile.ns, j = this, k = c.find(":jqmData(role='footer')").jqmData("id"), l;
                typeof d[f] == "undefined" && (d[f] = -1), g = g || ++d[f], a(b.find("li>ul, li>ol").toArray().reverse()).each(function(c) {
                    var d = this, f = a(this), j = f.attr("id") || g + "-" + c, m = f.parent(), n = a(f.prevAll().toArray().reverse()), p = n.length ? n : a("<span>" + a.trim(m.contents()[0].nodeValue) + "</span>"), q = p.first().getEncodedText(), r = (e || "") + "&" + a.mobile.subPageUrlKey + "=" + j, s = f.jqmData("theme") || h.theme, t = f.jqmData("counttheme") || b.jqmData("counttheme") || h.countTheme, u, v;
                    l = !0, u = f.detach().wrap("<div " + i + "role='page' " + i + "url='" + r + "' " + i + "theme='" + s + "' " + i + "count-theme='" + t + "'><div " + i + "role='content'></div></div>").parent().before("<div " + i + "role='header' " + i + "theme='" + h.headerTheme + "'><div class='ui-title'>" + q + "</div></div>").after(k ? a("<div " + i + "role='footer' " + i + "id='" + k + "'>") : "").parent().appendTo(a.mobile.pageContainer), u.page(), v = m.find("a:first"), v.length || (v = a("<a/>").html(p || q).prependTo(m.empty())), v.attr("href", "#" + r)
                }).listview();
                if (l && c.is(":jqmData(external-page='true')") && c.data("mobile-page").options.domCache === !1) {
                    var m = function(b, d) {
                        var f = d.nextPage, g, h = new a.Event("pageremove");
                        d.nextPage && (g = f.jqmData("url"), g.indexOf(e + "&" + a.mobile.subPageUrlKey) !== 0 && (j.childPages().remove(), c.trigger(h), h.isDefaultPrevented() || c.removeWithDependents()))
                    };
                    c.unbind("pagehide.remove").bind("pagehide.remove", m)
                }
            },
            childPages: function() {
                var b = this.parentPage.jqmData("url");
                return a(":jqmData(url^='" + b + "&" + a.mobile.subPageUrlKey + "')")
            }
        }), a.widget("mobile.listview", a.mobile.listview, a.mobile.behaviors.addFirstLastClasses), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.listview.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.mobile.listview.prototype.options.autodividers = !1, a.mobile.listview.prototype.options.autodividersSelector = function(b) {
            var c = a.trim(b.text()) || null;
            return c ? (c = c.slice(0, 1).toUpperCase(), c) : null
        }, a.mobile.document.delegate("ul,ol", "listviewcreate", function() {
            var b = a(this), d = b.data("mobile-listview");
            if (!d || !d.options.autodividers)return;
            var e = function() {
                    b.find("li:jqmData(role='list-divider')").remove();
                    var e = b.find("li"), f = null, g, h;
                    for (var i = 0; i < e.length; i++) {
                        g = e[i], h = d.options.autodividersSelector(a(g));
                        if (h && f !== h) {
                            var j = c.createElement("li");
                            j.appendChild(c.createTextNode(h)), j.setAttribute("data-" + a.mobile.ns + "role", "list-divider"), g.parentNode.insertBefore(j, g)
                        }
                        f = h
                    }
                },
                f = function() { b.unbind("listviewafterrefresh", f), e(), d.refresh(), b.bind("listviewafterrefresh", f) };
            f()
        })
    }(a), function(a, b) {
        a.mobile.listview.prototype.options.filter = !1, a.mobile.listview.prototype.options.filterPlaceholder = "Filter items...", a.mobile.listview.prototype.options.filterTheme = "c", a.mobile.listview.prototype.options.filterReveal = !1;
        var c = function(a, b, c) { return a.toString().toLowerCase().indexOf(b) === -1 };
        a.mobile.listview.prototype.options.filterCallback = c, a.mobile.document.delegate("ul, ol", "listviewcreate", function() {
            var b = a(this), d = b.data("mobile-listview");
            if (!d.options.filter)return;
            d.options.filterReveal && b.children().addClass("ui-screen-hidden");
            var e = a("<form>", { "class": "ui-listview-filter ui-bar-" + d.options.filterTheme, role: "search" }).submit(function(a) { a.preventDefault(), g.blur() }),
                f = function(e) {
                    var f = a(this), g = this.value.toLowerCase(), h = null, i = b.children(), j = f.jqmData("lastval") + "", k = !1, l = "", m, n = d.options.filterCallback !== c;
                    if (j && j === g)return;
                    d._trigger("beforefilter", "beforefilter", { input: this }), f.jqmData("lastval", g), n || g.length < j.length || g.indexOf(j) !== 0 ? h = b.children() : (h = b.children(":not(.ui-screen-hidden)"), !h.length && d.options.filterReveal && (h = b.children(".ui-screen-hidden")));
                    if (g) {
                        for (var o = h.length - 1; o >= 0; o--)m = a(h[o]), l = m.jqmData("filtertext") || m.text(), m.is("li:jqmData(role=list-divider)") ? (m.toggleClass("ui-filter-hidequeue", !k), k = !1) : d.options.filterCallback(l, g, m) ? m.toggleClass("ui-filter-hidequeue", !0) : k = !0;
                        h.filter(":not(.ui-filter-hidequeue)").toggleClass("ui-screen-hidden", !1), h.filter(".ui-filter-hidequeue").toggleClass("ui-screen-hidden", !0).toggleClass("ui-filter-hidequeue", !1)
                    } else h.toggleClass("ui-screen-hidden", !!d.options.filterReveal);
                    d._addFirstLastClasses(i, d._getVisibles(i, !1), !1)
                },
                g = a("<input>", { placeholder: d.options.filterPlaceholder }).attr("data-" + a.mobile.ns + "type", "search").jqmData("lastval", "").bind("keyup change input", f).appendTo(e).textinput();
            d.options.inset && e.addClass("ui-listview-filter-inset"), e.bind("submit", function() { return!1 }).insertBefore(b)
        })
    }(a), function(a, d) {
        a.widget("mobile.panel", a.mobile.widget, {
            options: { classes: { panel: "ui-panel", panelOpen: "ui-panel-open", panelClosed: "ui-panel-closed", panelFixed: "ui-panel-fixed", panelInner: "ui-panel-inner", modal: "ui-panel-dismiss", modalOpen: "ui-panel-dismiss-open", pagePanel: "ui-page-panel", pagePanelOpen: "ui-page-panel-open", contentWrap: "ui-panel-content-wrap", contentWrapOpen: "ui-panel-content-wrap-open", contentWrapClosed: "ui-panel-content-wrap-closed", contentFixedToolbar: "ui-panel-content-fixed-toolbar", contentFixedToolbarOpen: "ui-panel-content-fixed-toolbar-open", contentFixedToolbarClosed: "ui-panel-content-fixed-toolbar-closed", animate: "ui-panel-animate" }, animate: !0, theme: "c", position: "left", dismissible: !0, display: "reveal", initSelector: ":jqmData(role='panel')", swipeClose: !0, positionFixed: !1 }, _panelID: null, _closeLink: null, _page: null, _modal: null, _pannelInner: null, _wrapper: null, _fixedToolbar: null,
            _create: function() {
                var b = this, c = b.element, d = c.closest(":jqmData(role='page')"),
                    e = function() {
                        var b = a.data(d[0], "mobilePage").options.theme, c = "ui-body-" + b;
                        return c
                    },
                    f = function() {
                        var a = c.find("." + b.options.classes.panelInner);
                        return a.length === 0 && (a = c.children().wrapAll('<div class="' + b.options.classes.panelInner + '" />').parent()), a
                    },
                    g = function() {
                        var c = d.find("." + b.options.classes.contentWrap);
                        return c.length === 0 && (c = d.children(".ui-header:not(:jqmData(position='fixed')), .ui-content:not(:jqmData(role='popup')), .ui-footer:not(:jqmData(position='fixed'))").wrapAll('<div class="' + b.options.classes.contentWrap + " " + e() + '" />').parent(), a.support.cssTransform3d && !!b.options.animate && c.addClass(b.options.classes.animate)), c
                    },
                    h = function() {
                        var c = d.find("." + b.options.classes.contentFixedToolbar);
                        return c.length === 0 && (c = d.find(".ui-header:jqmData(position='fixed'), .ui-footer:jqmData(position='fixed')").addClass(b.options.classes.contentFixedToolbar), a.support.cssTransform3d && !!b.options.animate && c.addClass(b.options.classes.animate)), c
                    };
                a.extend(this, { _panelID: c.attr("id"), _closeLink: c.find(":jqmData(rel='close')"), _page: c.closest(":jqmData(role='page')"), _pageTheme: e(), _pannelInner: f(), _wrapper: g(), _fixedToolbar: h() }), b._addPanelClasses(), b._wrapper.addClass(this.options.classes.contentWrapClosed), b._fixedToolbar.addClass(this.options.classes.contentFixedToolbarClosed), b._page.addClass(b.options.classes.pagePanel), a.support.cssTransform3d && !!b.options.animate && this.element.addClass(b.options.classes.animate), b._bindUpdateLayout(), b._bindCloseEvents(), b._bindLinkListeners(), b._bindPageEvents(), !b.options.dismissible || b._createModal(), b._bindSwipeEvents()
            },
            _createModal: function(b) {
                var c = this;
                c._modal = a("<div class='" + c.options.classes.modal + "' data-panelid='" + c._panelID + "'></div>").on("mousedown", function() { c.close() }).appendTo(this._page)
            },
            _getPosDisplayClasses: function(a) { return a + "-position-" + this.options.position + " " + a + "-display-" + this.options.display },
            _getPanelClasses: function() {
                var a = this.options.classes.panel + " " + this._getPosDisplayClasses(this.options.classes.panel) + " " + this.options.classes.panelClosed;
                return this.options.theme && (a += " ui-body-" + this.options.theme), !this.options.positionFixed || (a += " " + this.options.classes.panelFixed), a
            },
            _addPanelClasses: function() { this.element.addClass(this._getPanelClasses()) },
            _bindCloseEvents: function() {
                var a = this;
                a._closeLink.on("click.panel", function(b) { return b.preventDefault(), a.close(), !1 }), a.element.on("click.panel", "a:jqmData(ajax='false')", function(b) { a.close() })
            },
            _positionPanel: function() {
                var b = this, c = b._pannelInner.outerHeight(), d = c > a.mobile.getScreenHeight();
                d || !b.options.positionFixed ? (d && (b._unfixPanel(), a.mobile.resetActivePageHeight(c)), b._scrollIntoView(c)) : b._fixPanel()
            },
            _scrollIntoView: function(c) { c < a(b).scrollTop() && b.scrollTo(0, 0) },
            _bindFixListener: function() { this._on(a(b), { throttledresize: "_positionPanel" }) },
            _unbindFixListener: function() { this._off(a(b), "throttledresize") },
            _unfixPanel: function() { !!this.options.positionFixed && a.support.fixedPosition && this.element.removeClass(this.options.classes.panelFixed) },
            _fixPanel: function() { !!this.options.positionFixed && a.support.fixedPosition && this.element.addClass(this.options.classes.panelFixed) },
            _bindUpdateLayout: function() {
                var a = this;
                a.element.on("updatelayout", function(b) { a._open && a._positionPanel() })
            },
            _bindLinkListeners: function() {
                var b = this;
                b._page.on("click.panel", "a", function(c) {
                    if (this.href.split("#")[1] === b._panelID && b._panelID !== d) {
                        c.preventDefault();
                        var e = a(this);
                        return e.hasClass("ui-link") || (e.addClass(a.mobile.activeBtnClass), b.element.one("panelopen panelclose", function() { e.removeClass(a.mobile.activeBtnClass) })), b.toggle(), !1
                    }
                })
            },
            _bindSwipeEvents: function() {
                var a = this, b = a._modal ? a.element.add(a._modal) : a.element;
                !a.options.swipeClose || (a.options.position === "left" ? b.on("swipeleft.panel", function(b) { a.close() }) : b.on("swiperight.panel", function(b) { a.close() }))
            },
            _bindPageEvents: function() {
                var a = this;
                a._page.on("panelbeforeopen", function(b) { a._open && b.target !== a.element[0] && a.close() }).on("pagehide", function(b) { a._open && a.close(!0) }).on("keyup.panel", function(b) { b.keyCode === 27 && a._open && a.close() })
            },
            _open: !1,
            _contentWrapOpenClasses: null,
            _fixedToolbarOpenClasses: null,
            _modalOpenClasses: null,
            open: function(b) {
                if (!this._open) {
                    var c = this, d = c.options, e = function() { c._page.off("panelclose"), c._page.jqmData("panel", "open"), !b && a.support.cssTransform3d && !!d.animate ? c.element.add(c._wrapper).on(c._transitionEndEvents, f) : setTimeout(f, 0), c.options.theme && c.options.display !== "overlay" && c._page.removeClass(c._pageTheme).addClass("ui-body-" + c.options.theme), c.element.removeClass(d.classes.panelClosed).addClass(d.classes.panelOpen), c._contentWrapOpenClasses = c._getPosDisplayClasses(d.classes.contentWrap), c._wrapper.removeClass(d.classes.contentWrapClosed).addClass(c._contentWrapOpenClasses + " " + d.classes.contentWrapOpen), c._fixedToolbarOpenClasses = c._getPosDisplayClasses(d.classes.contentFixedToolbar), c._fixedToolbar.removeClass(d.classes.contentFixedToolbarClosed).addClass(c._fixedToolbarOpenClasses + " " + d.classes.contentFixedToolbarOpen), c._modalOpenClasses = c._getPosDisplayClasses(d.classes.modal) + " " + d.classes.modalOpen, c._modal && c._modal.addClass(c._modalOpenClasses) }, f = function() { c.element.add(c._wrapper).off(c._transitionEndEvents, f), c._page.addClass(d.classes.pagePanelOpen), c._positionPanel(), c._bindFixListener(), c._trigger("open") };
                    this.element.closest(".ui-page-active").length < 0 && (b = !0), c._trigger("beforeopen"), c._page.jqmData("panel") === "open" ? c._page.on("panelclose", function() { e() }) : e(), c._open = !0
                }
            },
            close: function(b) {
                if (this._open) {
                    var c = this.options, d = this, e = function() { !b && a.support.cssTransform3d && !!c.animate ? d.element.add(d._wrapper).on(d._transitionEndEvents, f) : setTimeout(f, 0), d._page.removeClass(c.classes.pagePanelOpen), d.element.removeClass(c.classes.panelOpen), d._wrapper.removeClass(c.classes.contentWrapOpen), d._fixedToolbar.removeClass(c.classes.contentFixedToolbarOpen), d._modal && d._modal.removeClass(d._modalOpenClasses) }, f = function() { d.options.theme && d.options.display !== "overlay" && d._page.removeClass("ui-body-" + d.options.theme).addClass(d._pageTheme), d.element.add(d._wrapper).off(d._transitionEndEvents, f), d.element.addClass(c.classes.panelClosed), d._wrapper.removeClass(d._contentWrapOpenClasses).addClass(c.classes.contentWrapClosed), d._fixedToolbar.removeClass(d._fixedToolbarOpenClasses).addClass(c.classes.contentFixedToolbarClosed), d._fixPanel(), d._unbindFixListener(), a.mobile.resetActivePageHeight(), d._page.jqmRemoveData("panel"), d._trigger("close") };
                    this.element.closest(".ui-page-active").length < 0 && (b = !0), d._trigger("beforeclose"), e(), d._open = !1
                }
            },
            toggle: function(a) { this[this._open ? "close" : "open"]() },
            _transitionEndEvents: "webkitTransitionEnd oTransitionEnd otransitionend transitionend msTransitionEnd",
            _destroy: function() {
                var b = this.options.classes, c = this.options.theme, d = this.element.siblings("." + b.panel).length;
                d ? this._open && (this._wrapper.removeClass(b.contentWrapOpen), this._fixedToolbar.removeClass(b.contentFixedToolbarOpen), this._page.jqmRemoveData("panel"), this._page.removeClass(b.pagePanelOpen), c && this._page.removeClass("ui-body-" + c).addClass(this._pageTheme)) : (this._wrapper.children().unwrap(), this._page.find("a").unbind("panelopen panelclose"), this._page.removeClass(b.pagePanel), this._open && (this._page.jqmRemoveData("panel"), this._page.removeClass(b.pagePanelOpen), c && this._page.removeClass("ui-body-" + c).addClass(this._pageTheme), a.mobile.resetActivePageHeight())), this._pannelInner.children().unwrap(), this.element.removeClass([this._getPanelClasses(), b.panelAnimate].join(" ")).off("swipeleft.panel swiperight.panel").off("panelbeforeopen").off("panelhide").off("keyup.panel").off("updatelayout"), this._closeLink.off("click.panel"), this._modal && this._modal.remove(), this.element.off(this._transitionEndEvents).removeClass([b.panelUnfixed, b.panelClosed, b.panelOpen].join(" "))
            }
        }), a(c).bind("pagecreate create", function(b) { a.mobile.panel.prototype.enhanceWithin(b.target) })
    }(a), function(a, d) {
        function e(a, b, c, d) {
            var e = d;
            return a < b ? e = c + (a - b) / 2 : e = Math.min(Math.max(c, d - b / 2), c + a - b), e
        }

        function f() {
            var c = a.mobile.window;
            return{ x: c.scrollLeft(), y: c.scrollTop(), cx: b.innerWidth || c.width(), cy: b.innerHeight || c.height() }
        }

        a.widget("mobile.popup", a.mobile.widget, {
            options: { theme: null, overlayTheme: null, shadow: !0, corners: !0, transition: "none", positionTo: "origin", tolerance: null, initSelector: ":jqmData(role='popup')", closeLinkSelector: "a:jqmData(rel='back')", closeLinkEvents: "click.popup", navigateEvents: "navigate.popup", closeEvents: "navigate.popup pagebeforechange.popup", dismissible: !0, history: !a.mobile.browser.oldIE }, _eatEventAndClose: function(a) { return a.preventDefault(), a.stopImmediatePropagation(), this.options.dismissible && this.close(), !1 },
            _resizeScreen: function() {
                var a = this._ui.container.outerHeight(!0);
                this._ui.screen.removeAttr("style"), a > this._ui.screen.height() && this._ui.screen.height(a)
            },
            _handleWindowKeyUp: function(b) { if (this._isOpen && b.keyCode === a.mobile.keyCode.ESCAPE)return this._eatEventAndClose(b) },
            _expectResizeEvent: function() {
                var b = f();
                if (this._resizeData) {
                    if (b.x === this._resizeData.winCoords.x && b.y === this._resizeData.winCoords.y && b.cx === this._resizeData.winCoords.cx && b.cy === this._resizeData.winCoords.cy)return!1;
                    clearTimeout(this._resizeData.timeoutId)
                }
                return this._resizeData = { timeoutId: setTimeout(a.proxy(this, "_resizeTimeout"), 200), winCoords: b }, !0
            },
            _resizeTimeout: function() { this._isOpen ? this._expectResizeEvent() || (this._ui.container.hasClass("ui-popup-hidden") && (this._ui.container.removeClass("ui-popup-hidden"), this.reposition({ positionTo: "window" }), this._ignoreResizeEvents()), this._resizeScreen(), this._resizeData = null, this._orientationchangeInProgress = !1) : (this._resizeData = null, this._orientationchangeInProgress = !1) },
            _ignoreResizeEvents: function() {
                var a = this;
                this._ignoreResizeTo && clearTimeout(this._ignoreResizeTo), this._ignoreResizeTo = setTimeout(function() { a._ignoreResizeTo = 0 }, 1e3)
            },
            _handleWindowResize: function(a) { this._isOpen && this._ignoreResizeTo === 0 && (this._expectResizeEvent() || this._orientationchangeInProgress) && !this._ui.container.hasClass("ui-popup-hidden") && this._ui.container.addClass("ui-popup-hidden").removeAttr("style") },
            _handleWindowOrientationchange: function(a) { !this._orientationchangeInProgress && this._isOpen && this._ignoreResizeTo === 0 && (this._expectResizeEvent(), this._orientationchangeInProgress = !0) },
            _handleDocumentFocusIn: function(b) {
                var d = b.target, e, f = this._ui;
                if (!this._isOpen)return;
                if (d !== f.container[0]) {
                    e = a(b.target);
                    if (0 === e.parents().filter(f.container[0]).length)return a(c.activeElement).one("focus", function(a) { e.blur() }), f.focusElement.focus(), b.preventDefault(), b.stopImmediatePropagation(), !1;
                    f.focusElement[0] === f.container[0] && (f.focusElement = e)
                } else f.focusElement && f.focusElement[0] !== f.container[0] && (f.container.blur(), f.focusElement.focus());
                this._ignoreResizeEvents()
            },
            _create: function() {
                var b = { screen: a("<div class='ui-screen-hidden ui-popup-screen'></div>"), placeholder: a("<div style='display: none;'><!-- placeholder --></div>"), container: a("<div class='ui-popup-container ui-popup-hidden'></div>") }, c = this.element.closest(".ui-page"), e = this.element.attr("id"), f = this;
                this.options.history = this.options.history && a.mobile.ajaxEnabled && a.mobile.hashListeningEnabled, c.length === 0 && (c = a("body")), this.options.container = this.options.container || a.mobile.pageContainer, c.append(b.screen), b.container.insertAfter(b.screen), b.placeholder.insertAfter(this.element), e && (b.screen.attr("id", e + "-screen"), b.container.attr("id", e + "-popup"), b.placeholder.html("<!-- placeholder for " + e + " -->")), b.container.append(this.element), b.focusElement = b.container, this.element.addClass("ui-popup"), a.extend(this, { _scrollTop: 0, _page: c, _ui: b, _fallbackTransition: "", _currentTransition: !1, _prereqs: null, _isOpen: !1, _tolerance: null, _resizeData: null, _ignoreResizeTo: 0, _orientationchangeInProgress: !1 }), a.each(this.options, function(a, b) { f.options[a] = d, f._setOption(a, b, !0) }), b.screen.bind("vclick", a.proxy(this, "_eatEventAndClose")), this._on(a.mobile.window, { orientationchange: a.proxy(this, "_handleWindowOrientationchange"), resize: a.proxy(this, "_handleWindowResize"), keyup: a.proxy(this, "_handleWindowKeyUp") }), this._on(a.mobile.document, { focusin: a.proxy(this, "_handleDocumentFocusIn") })
            },
            _applyTheme: function(a, b, c) {
                var d = (a.attr("class") || "").split(" "), e = !0, f = null, g, h = String(b);
                while (d.length > 0) {
                    f = d.pop(), g = (new RegExp("^ui-" + c + "-([a-z])$")).exec(f);
                    if (g && g.length > 1) {
                        f = g[1];
                        break
                    }
                    f = null
                }
                b !== f && (a.removeClass("ui-" + c + "-" + f), b !== null && b !== "none" && a.addClass("ui-" + c + "-" + h))
            },
            _setTheme: function(a) { this._applyTheme(this.element, a, "body") },
            _setOverlayTheme: function(a) { this._applyTheme(this._ui.screen, a, "overlay"), this._isOpen && this._ui.screen.addClass("in") },
            _setShadow: function(a) { this.element.toggleClass("ui-overlay-shadow", a) },
            _setCorners: function(a) { this.element.toggleClass("ui-corner-all", a) },
            _applyTransition: function(b) { this._ui.container.removeClass(this._fallbackTransition), b && b !== "none" && (this._fallbackTransition = a.mobile._maybeDegradeTransition(b), this._fallbackTransition === "none" && (this._fallbackTransition = ""), this._ui.container.addClass(this._fallbackTransition)) },
            _setTransition: function(a) { this._currentTransition || this._applyTransition(a) },
            _setTolerance: function(b) {
                var c = { t: 30, r: 15, b: 30, l: 15 };
                if (b !== d) {
                    var e = String(b).split(",");
                    a.each(e, function(a, b) { e[a] = parseInt(b, 10) });
                    switch (e.length) {
                    case 1:
                        isNaN(e[0]) || (c.t = c.r = c.b = c.l = e[0]);
                        break;
                    case 2:
                        isNaN(e[0]) || (c.t = c.b = e[0]), isNaN(e[1]) || (c.l = c.r = e[1]);
                        break;
                    case 4:
                        isNaN(e[0]) || (c.t = e[0]), isNaN(e[1]) || (c.r = e[1]), isNaN(e[2]) || (c.b = e[2]), isNaN(e[3]) || (c.l = e[3]);
                        break;
                    default:
                    }
                }
                this._tolerance = c
            },
            _setOption: function(b, c) {
                var e, f = "_set" + b.charAt(0).toUpperCase() + b.slice(1);
                this[f] !== d && this[f](c), e = ["initSelector", "closeLinkSelector", "closeLinkEvents", "navigateEvents", "closeEvents", "history", "container"], a.mobile.widget.prototype._setOption.apply(this, arguments), a.inArray(b, e) === -1 && this.element.attr("data-" + (a.mobile.ns || "") + b.replace(/([A-Z])/, "-$1").toLowerCase(), c)
            },
            _placementCoords: function(a) {
                var b = f(), d = { x: this._tolerance.l, y: b.y + this._tolerance.t, cx: b.cx - this._tolerance.l - this._tolerance.r, cy: b.cy - this._tolerance.t - this._tolerance.b }, g, h;
                this._ui.container.css("max-width", d.cx), g = { cx: this._ui.container.outerWidth(!0), cy: this._ui.container.outerHeight(!0) }, h = { x: e(d.cx, g.cx, d.x, a.x), y: e(d.cy, g.cy, d.y, a.y) }, h.y = Math.max(0, h.y);
                var i = c.documentElement, j = c.body, k = Math.max(i.clientHeight, j.scrollHeight, j.offsetHeight, i.scrollHeight, i.offsetHeight);
                return h.y -= Math.min(h.y, Math.max(0, h.y + g.cy - k)), { left: h.x, top: h.y }
            },
            _createPrereqs: function(b, c, d) {
                var e = this, f;
                f = { screen: a.Deferred(), container: a.Deferred() }, f.screen.then(function() { f === e._prereqs && b() }), f.container.then(function() { f === e._prereqs && c() }), a.when(f.screen, f.container).done(function() { f === e._prereqs && (e._prereqs = null, d()) }), e._prereqs = f
            },
            _animate: function(b) {
                this._ui.screen.removeClass(b.classToRemove).addClass(b.screenClassToAdd), b.prereqs.screen.resolve();
                if (b.transition && b.transition !== "none") {
                    b.applyTransition && this._applyTransition(b.transition);
                    if (this._fallbackTransition) {
                        this._ui.container.animationComplete(a.proxy(b.prereqs.container, "resolve")).addClass(b.containerClassToAdd).removeClass(b.classToRemove);
                        return
                    }
                }
                this._ui.container.removeClass(b.classToRemove), b.prereqs.container.resolve()
            },
            _desiredCoords: function(b) {
                var c = null, d, e = f(), g = b.x, h = b.y, i = b.positionTo;
                if (i && i !== "origin")
                    if (i === "window")g = e.cx / 2 + e.x, h = e.cy / 2 + e.y;
                    else {
                        try {
                            c = a(i)
                        } catch (j) {
                            c = null
                        }
                        c && (c.filter(":visible"), c.length === 0 && (c = null))
                    }
                c && (d = c.offset(), g = d.left + c.outerWidth() / 2, h = d.top + c.outerHeight() / 2);
                if (a.type(g) !== "number" || isNaN(g))g = e.cx / 2 + e.x;
                if (a.type(h) !== "number" || isNaN(h))h = e.cy / 2 + e.y;
                return{ x: g, y: h }
            },
            _reposition: function(a) { a = { x: a.x, y: a.y, positionTo: a.positionTo }, this._trigger("beforeposition", a), this._ui.container.offset(this._placementCoords(this._desiredCoords(a))) },
            reposition: function(a) { this._isOpen && this._reposition(a) },
            _openPrereqsComplete: function() { this._ui.container.addClass("ui-popup-active"), this._isOpen = !0, this._resizeScreen(), this._ui.container.attr("tabindex", "0").focus(), this._ignoreResizeEvents(), this._trigger("afteropen") },
            _open: function(c) {
                var d = a.extend({}, this.options, c),
                    e = function() {
                        var a = b, c = navigator.userAgent, d = c.match(/AppleWebKit\/([0-9\.]+)/), e = !!d && d[1], f = c.match(/Android (\d+(?:\.\d+))/), g = !!f && f[1], h = c.indexOf("Chrome") > -1;
                        return f !== null && g === "4.0" && e && e > 534.13 && !h ? !0 : !1
                    }();
                this._createPrereqs(a.noop, a.noop, a.proxy(this, "_openPrereqsComplete")), this._currentTransition = d.transition, this._applyTransition(d.transition), this.options.theme || this._setTheme(this._page.jqmData("theme") || a.mobile.getInheritedTheme(this._page, "c")), this._ui.screen.removeClass("ui-screen-hidden"), this._ui.container.removeClass("ui-popup-hidden"), this._reposition(d), this.options.overlayTheme && e && this.element.closest(".ui-page").addClass("ui-popup-open"), this._animate({ additionalCondition: !0, transition: d.transition, classToRemove: "", screenClassToAdd: "in", containerClassToAdd: "in", applyTransition: !1, prereqs: this._prereqs })
            },
            _closePrereqScreen: function() { this._ui.screen.removeClass("out").addClass("ui-screen-hidden") },
            _closePrereqContainer: function() { this._ui.container.removeClass("reverse out").addClass("ui-popup-hidden").removeAttr("style") },
            _closePrereqsDone: function() {
                var b = this.options;
                this._ui.container.removeAttr("tabindex"), a.mobile.popup.active = d, this._trigger("afterclose")
            },
            _close: function(b) { this._ui.container.removeClass("ui-popup-active"), this._page.removeClass("ui-popup-open"), this._isOpen = !1, this._createPrereqs(a.proxy(this, "_closePrereqScreen"), a.proxy(this, "_closePrereqContainer"), a.proxy(this, "_closePrereqsDone")), this._animate({ additionalCondition: this._ui.screen.hasClass("in"), transition: b ? "none" : this._currentTransition, classToRemove: "in", screenClassToAdd: "out", containerClassToAdd: "reverse out", applyTransition: !0, prereqs: this._prereqs }) },
            _unenhance: function() { this._setTheme("none"), this.element.detach().insertAfter(this._ui.placeholder).removeClass("ui-popup ui-overlay-shadow ui-corner-all"), this._ui.screen.remove(), this._ui.container.remove(), this._ui.placeholder.remove() },
            _destroy: function() { a.mobile.popup.active === this ? (this.element.one("popupafterclose", a.proxy(this, "_unenhance")), this.close()) : this._unenhance() },
            _closePopup: function(c, d) {
                var e, f, g = this.options, h = !1;
                b.scrollTo(0, this._scrollTop), c && c.type === "pagebeforechange" && d && (typeof d.toPage == "string" ? e = d.toPage : e = d.toPage.jqmData("url"), e = a.mobile.path.parseUrl(e), f = e.pathname + e.search + e.hash, this._myUrl !== a.mobile.path.makeUrlAbsolute(f) ? h = !0 : c.preventDefault()), g.container.unbind(g.closeEvents), this.element.undelegate(g.closeLinkSelector, g.closeLinkEvents), this._close(h)
            },
            _bindContainerClose: function() { this.options.container.one(this.options.closeEvents, a.proxy(this, "_closePopup")) },
            open: function(c) {
                var d = this, e = this.options, f, g, h, i, j, k;
                if (a.mobile.popup.active)return;
                a.mobile.popup.active = this, this._scrollTop = a.mobile.window.scrollTop();
                if (!e.history) {
                    d._open(c), d._bindContainerClose(), d.element.delegate(e.closeLinkSelector, e.closeLinkEvents, function(a) { d.close(), a.preventDefault() });
                    return
                }
                k = a.mobile.urlHistory, g = a.mobile.dialogHashKey, h = a.mobile.activePage, i = h.is(".ui-dialog"), this._myUrl = f = k.getActive().url, j = f.indexOf(g) > -1 && !i && k.activeIndex > 0;
                if (j) {
                    d._open(c), d._bindContainerClose();
                    return
                }
                f.indexOf(g) === -1 && !i ? f += f.indexOf("#") > -1 ? g : "#" + g : f = a.mobile.path.parseLocation().hash + g, k.activeIndex === 0 && f === k.initialDst && (f += g), a(b).one("beforenavigate", function(a) { a.preventDefault(), d._open(c), d._bindContainerClose() }), this.urlAltered = !0, a.mobile.navigate(f, { role: "dialog" })
            },
            close: function() {
                if (a.mobile.popup.active !== this)return;
                this._scrollTop = a.mobile.window.scrollTop(), this.options.history && this.urlAltered ? (a.mobile.back(), this.urlAltered = !1) : this._closePopup()
            }
        }), a.mobile.popup.handleLink = function(b) {
            var c = b.closest(":jqmData(role='page')"), d = c.length === 0 ? a("body") : c, e = a(a.mobile.path.parseUrl(b.attr("href")).hash, d[0]), f;
            e.data("mobile-popup") && (f = b.offset(), e.popup("open", { x: f.left + b.outerWidth() / 2, y: f.top + b.outerHeight() / 2, transition: b.jqmData("transition"), positionTo: b.jqmData("position-to") })), setTimeout(function() {
                var c = b.parent().parent();
                c.hasClass("ui-li") && (b = c.parent()), b.removeClass(a.mobile.activeBtnClass)
            }, 300)
        }, a.mobile.document.bind("pagebeforechange", function(b, c) { c.options.role === "popup" && (a.mobile.popup.handleLink(c.options.link), b.preventDefault()) }), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.popup.prototype.enhanceWithin(b.target, !0) })
    }(a), function(a, b) {
        a.widget("mobile.table", a.mobile.widget, {
            options: { classes: { table: "ui-table" }, initSelector: ":jqmData(role='table')" },
            _create: function() {
                var b = this, c = this.element.find("thead tr");
                this.element.addClass(this.options.classes.table), b.headers = this.element.find("tr:eq(0)").children(), b.allHeaders = b.headers.add(c.children()), c.each(function() {
                    var d = 0;
                    a(this).children().each(function(e) {
                        var f = parseInt(a(this).attr("colspan"), 10), g = ":nth-child(" + (d + 1) + ")";
                        a(this).jqmData("colstart", d + 1);
                        if (f)for (var h = 0; h < f - 1; h++)d++, g += ", :nth-child(" + (d + 1) + ")";
                        a(this).jqmData("cells", b.element.find("tr").not(c.eq(0)).not(this).children(g)), d++
                    })
                })
            }
        }), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.table.prototype.enhanceWithin(b.target) })
    }(a), function(a, b) {
        a.widget("mobile.controlgroup", a.mobile.widget, {
            options: { shadow: !1, corners: !0, excludeInvisible: !0, type: "vertical", mini: !1, initSelector: ":jqmData(role='controlgroup')" },
            _create: function() {
                var c = this.element, d = { inner: a("<div class='ui-controlgroup-controls'></div>"), legend: a("<div role='heading' class='ui-controlgroup-label'></div>") }, e = c.children("legend"), f = this;
                c.wrapInner(d.inner), e.length && d.legend.append(e).insertBefore(c.children(0)), c.addClass("ui-corner-all ui-controlgroup"), a.extend(this, { _initialRefresh: !0 }), a.each(this.options, function(a, c) { f.options[a] = b, f._setOption(a, c, !0) })
            },
            _init: function() { this.refresh() },
            _setOption: function(c, d) {
                var e = "_set" + c.charAt(0).toUpperCase() + c.slice(1);
                this[e] !== b && this[e](d), this._super(c, d), this.element.attr("data-" + (a.mobile.ns || "") + c.replace(/([A-Z])/, "-$1").toLowerCase(), d)
            },
            _setType: function(a) { this.element.removeClass("ui-controlgroup-horizontal ui-controlgroup-vertical").addClass("ui-controlgroup-" + a), this.refresh() },
            _setCorners: function(a) { this.element.toggleClass("ui-corner-all", a) },
            _setShadow: function(a) { this.element.toggleClass("ui-shadow", a) },
            _setMini: function(a) { this.element.toggleClass("ui-mini", a) },
            container: function() { return this.element.children(".ui-controlgroup-controls") },
            refresh: function() {
                var b = this.element.find(".ui-btn").not(".ui-slider-handle"), c = this._initialRefresh;
                a.mobile.checkboxradio && this.element.find(":mobile-checkboxradio").checkboxradio("refresh"), this._addFirstLastClasses(b, this.options.excludeInvisible ? this._getVisibles(b, c) : b, c), this._initialRefresh = !1
            }
        }), a.widget("mobile.controlgroup", a.mobile.controlgroup, a.mobile.behaviors.addFirstLastClasses), a(function() { a.mobile.document.bind("pagecreate create", function(b) { a.mobile.controlgroup.prototype.enhanceWithin(b.target, !0) }) })
    }(a), function(a, b) { a.mobile.behaviors.formReset = { _handleFormReset: function() { this._on(this.element.closest("form"), { reset: function() { this._delay("_reset") } }) } } }(a), function(a, b) {
        a.widget("mobile.checkboxradio", a.mobile.widget, {
            options: { theme: null, mini: !1, initSelector: "input[type='checkbox'],input[type='radio']" },
            _create: function() {
                var b = this, d = this.element, e = this.options, f = function(a, b) { return a.jqmData(b) || a.closest("form, fieldset").jqmData(b) }, g = a(d).closest("label"), h = g.length ? g : a(d).closest("form, fieldset, :jqmData(role='page'), :jqmData(role='dialog')").find("label").filter("[for='" + d[0].id + "']").first(), i = d[0].type, j = f(d, "mini") || e.mini, k = i + "-on", l = i + "-off", m = f(d, "iconpos"), n = "ui-" + k, o = "ui-" + l;
                if (i !== "checkbox" && i !== "radio")return;
                a.extend(this, { label: h, inputtype: i, checkedClass: n, uncheckedClass: o, checkedicon: k, uncheckedicon: l }), e.theme || (e.theme = a.mobile.getInheritedTheme(this.element, "c")), h.buttonMarkup({ theme: e.theme, icon: l, shadow: !1, mini: j, iconpos: m });
                var p = c.createElement("div");
                p.className = "ui-" + i, d.add(h).wrapAll(p), h.bind({
                    vmouseover: function(b) { a(this).parent().is(".ui-disabled") && b.stopPropagation() },
                    vclick: function(a) {
                        if (d.is(":disabled")) {
                            a.preventDefault();
                            return
                        }
                        return b._cacheVals(), d.prop("checked", i === "radio" && !0 || !d.prop("checked")), d.triggerHandler("click"), b._getInputSet().not(d).prop("checked", !1), b._updateAll(), !1
                    }
                }), d.bind({
                    vmousedown: function() { b._cacheVals() },
                    vclick: function() {
                        var c = a(this);
                        c.is(":checked") ? (c.prop("checked", !0), b._getInputSet().not(c).prop("checked", !1)) : c.prop("checked", !1), b._updateAll()
                    },
                    focus: function() { h.addClass(a.mobile.focusClass) },
                    blur: function() { h.removeClass(a.mobile.focusClass) }
                }), this._handleFormReset && this._handleFormReset(), this.refresh()
            },
            _cacheVals: function() { this._getInputSet().each(function() { a(this).jqmData("cacheVal", this.checked) }) },
            _getInputSet: function() { return this.inputtype === "checkbox" ? this.element : this.element.closest("form, :jqmData(role='page'), :jqmData(role='dialog')").find("input[name='" + this.element[0].name + "'][type='" + this.inputtype + "']") },
            _updateAll: function() {
                var b = this;
                this._getInputSet().each(function() {
                    var c = a(this);
                    (this.checked || b.inputtype === "checkbox") && c.trigger("change")
                }).checkboxradio("refresh")
            },
            _reset: function() { this.refresh() },
            refresh: function() {
                var b = this.element[0], c = " " + a.mobile.activeBtnClass, d = this.checkedClass + (this.element.parents(".ui-controlgroup-horizontal").length ? c : ""), e = this.label;
                b.checked ? e.removeClass(this.uncheckedClass + c).addClass(d).buttonMarkup({ icon: this.checkedicon }) : e.removeClass(d).addClass(this.uncheckedClass).buttonMarkup({ icon: this.uncheckedicon }), b.disabled ? this.disable() : this.enable()
            },
            disable: function() { this.element.prop("disabled", !0).parent().addClass("ui-disabled") },
            enable: function() { this.element.prop("disabled", !1).parent().removeClass("ui-disabled") }
        }), a.widget("mobile.checkboxradio", a.mobile.checkboxradio, a.mobile.behaviors.formReset), a.mobile.document.bind("pagecreate create", function(b) { a.mobile.checkboxradio.prototype.enhanceWithin(b.target, !0) })
    }(a), function(a, b) {
        a.mobile.table.prototype.options.mode = "columntoggle", a.mobile.table.prototype.options.columnBtnTheme = null, a.mobile.table.prototype.options.columnPopupTheme = null, a.mobile.table.prototype.options.columnBtnText = "Columns...", a.mobile.table.prototype.options.classes = a.extend(a.mobile.table.prototype.options.classes, { popup: "ui-table-columntoggle-popup", columnBtn: "ui-table-columntoggle-btn", priorityPrefix: "ui-table-priority-", columnToggleTable: "ui-table-columntoggle" }), a.mobile.document.delegate(":jqmData(role='table')", "tablecreate", function() {
            var b = a(this), c = b.data("mobile-table"), d = c.options, e = a.mobile.ns;
            if (d.mode !== "columntoggle")return;
            c.element.addClass(d.classes.columnToggleTable);
            var f = (b.attr("id") || d.classes.popup) + "-popup", g = a("<a href='#" + f + "' class='" + d.classes.columnBtn + "' data-" + e + "rel='popup' data-" + e + "mini='true'>" + d.columnBtnText + "</a>"), h = a("<div data-" + e + "role='popup' data-" + e + "role='fieldcontain' class='" + d.classes.popup + "' id='" + f + "'></div>"), i = a("<fieldset data-" + e + "role='controlgroup'></fieldset>");
            c.headers.not("td").each(function() {
                var b = a(this).jqmData("priority"), c = a(this).add(a(this).jqmData("cells"));
                b && (c.addClass(d.classes.priorityPrefix + b), a("<label><input type='checkbox' checked />" + a(this).text() + "</label>").appendTo(i).children(0).jqmData("cells", c).checkboxradio({ theme: d.columnPopupTheme }))
            }), i.appendTo(h), i.on("change", "input", function(b) { this.checked ? a(this).jqmData("cells").removeClass("ui-table-cell-hidden").addClass("ui-table-cell-visible") : a(this).jqmData("cells").removeClass("ui-table-cell-visible").addClass("ui-table-cell-hidden") }), g.insertBefore(b).buttonMarkup({ theme: d.columnBtnTheme }), h.insertBefore(b).popup(), c.refresh = function() { i.find("input").each(function() { this.checked = a(this).jqmData("cells").eq(0).css("display") === "table-cell", a(this).checkboxradio("refresh") }) }, a.mobile.window.on("throttledresize", c.refresh), c.refresh()
        })
    }(a), function(a, b) {
        a.mobile.table.prototype.options.mode = "reflow", a.mobile.table.prototype.options.classes = a.extend(a.mobile.table.prototype.options.classes, { reflowTable: "ui-table-reflow", cellLabels: "ui-table-cell-label" }), a.mobile.document.delegate(":jqmData(role='table')", "tablecreate", function() {
            var b = a(this), c = b.data("mobile-table"), d = c.options;
            if (d.mode !== "reflow")return;
            c.element.addClass(d.classes.reflowTable);
            var e = a(c.allHeaders.get().reverse());
            e.each(function(b) {
                var c = a(this).jqmData("cells"), e = a(this).jqmData("colstart"), f = c.not(this).filter("thead th").length && " ui-table-cell-label-top", g = a(this).text();
                if (g !== "")
                    if (f) {
                        var h = parseInt(a(this).attr("colspan"), 10), i = "";
                        h && (i = "td:nth-child(" + h + "n + " + e + ")"), c.filter(i).prepend("<b class='" + d.classes.cellLabels + f + "'>" + g + "</b>")
                    } else c.prepend("<b class='" + d.classes.cellLabels + "'>" + g + "</b>")
            })
        })
    }(a)
});