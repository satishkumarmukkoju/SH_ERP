! function(a, b, c, d) {
    "use strict";
    function e(b, c) {
        g = this, this.element = a(b), this.options = a.extend({}, h, c), this._defaults = h, this._name = f, this.init()
    }
    var f = "ripples",
        g = null,
        h = {};
    e.prototype.init = function() {
        var c = this.element;
        c.on("mousedown touchstart", function(d) {
            if (g.isTouch() && "mousedown" === d.type) return !1;
            c.find(".ripple-wrapper").length || c.append('<div class="ripple-wrapper"></div>');
            var e = c.children(".ripple-wrapper"),
                f = g.getRelY(e, d),
                h = g.getRelX(e, d);
            if (f || h) {
                var i = g.getRipplesColor(c),
                    j = a("<div></div>");
                j.addClass("ripple").css({
                        left: h,
                        top: f,
                        "background-color": i
                    }), e.append(j),
                    function() {
                        return b.getComputedStyle(j[0]).opacity
                    }(), g.rippleOn(c, j), setTimeout(function() {
                        g.rippleEnd(j)
                    }, 500), c.on("mouseup mouseleave touchend", function() {
                        j.data("mousedown", "off"), "off" === j.data("animating") && g.rippleOut(j)
                    })
            }
        })
    }, e.prototype.getNewSize = function(a, b) {
        return Math.max(a.outerWidth(), a.outerHeight()) / b.outerWidth() * 2.5
    }, e.prototype.getRelX = function(a, b) {
        var c = a.offset();
        return g.isTouch() ? (b = b.originalEvent, 1 !== b.touches.length ? b.touches[0].pageX - c.left : !1) : b.pageX - c.left
    }, e.prototype.getRelY = function(a, b) {
        var c = a.offset();
        return g.isTouch() ? (b = b.originalEvent, 1 !== b.touches.length ? b.touches[0].pageY - c.top : !1) : b.pageY - c.top
    }, e.prototype.getRipplesColor = function(a) {
        var c = a.data("ripple-color") ? a.data("ripple-color") : b.getComputedStyle(a[0]).color;
        return c
    }, e.prototype.hasTransitionSupport = function() {
        var a = c.body || c.documentElement,
            b = a.style,
            e = b.transition !== d || b.WebkitTransition !== d || b.MozTransition !== d || b.MsTransition !== d || b.OTransition !== d;
        return e
    }, e.prototype.isTouch = function() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    }, e.prototype.rippleEnd = function(a) {
        a.data("animating", "off"), "off" === a.data("mousedown") && g.rippleOut(a)
    }, e.prototype.rippleOut = function(a) {
        a.off(), g.hasTransitionSupport() ? a.addClass("ripple-out") : a.animate({
            opacity: 0
        }, 100, function() {
            a.trigger("transitionend")
        }), a.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
            a.remove()
        })
    }, e.prototype.rippleOn = function(a, b) {
        var c = g.getNewSize(a, b);
        g.hasTransitionSupport() ? b.css({
            "-ms-transform": "scale(" + c + ")",
            "-moz-transform": "scale(" + c + ")",
            "-webkit-transform": "scale(" + c + ")",
            transform: "scale(" + c + ")"
        }).addClass("ripple-on").data("animating", "on").data("mousedown", "on") : b.animate({
            width: 2 * Math.max(a.outerWidth(), a.outerHeight()),
            height: 2 * Math.max(a.outerWidth(), a.outerHeight()),
            "margin-left": -1 * Math.max(a.outerWidth(), a.outerHeight()),
            "margin-top": -1 * Math.max(a.outerWidth(), a.outerHeight()),
            opacity: .2
        }, 500, function() {
            b.trigger("transitionend")
        })
    }, a.fn.ripples = function(b) {
        return this.each(function() {
            a.data(this, "plugin_" + f) || a.data(this, "plugin_" + f, new e(this, b))
        })
    }
}(jQuery, window, document);
//# sourceMappingURL=ripples.min.js.map