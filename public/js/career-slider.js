(function () {
    function t() { }
    function n(t) {
        return null == t ? (t === l ? m : y) : W && W in Object(t) ? e(t) : r(t);
    }
    function e(t) {
        var n = N.call(t, W)
            , e = t[W];
        try {
            t[W] = l;
            var r = true;
        } catch (t) { }
        var i = E.call(t);
        return r && (n ? (t[W] = e) : delete t[W]),
            i;
    }
    function r(t) {
        return E.call(t);
    }
    function i(t, n, e) {
        function r(n) {
            var e = m
                , r = v;
            return (m = v = l),
                (T = n),
                (O = t.apply(r, e));
        }
        function i(t) {
            return (T = t),
                (h = setTimeout(a, n)),
                w ? r(t) : O;
        }
        function o(t) {
            var e = t - d
                , r = t - T
                , i = n - e;
            return x ? M(i, j - r) : i;
        }
        function c(t) {
            var e = t - d
                , r = t - T;
            return d === l || e >= n || e < 0 || (x && r >= j);
        }
        function a() {
            var t = k();
            return c(t) ? b(t) : ((h = setTimeout(a, o(t))),
                l);
        }
        function b(t) {
            return (h = l),
                S && m ? r(t) : ((m = v = l),
                    O);
        }
        function p() {
            h !== l && clearTimeout(h),
                (T = 0),
                (m = d = v = h = l);
        }
        function y() {
            return h === l ? O : b(k());
        }
        function g() {
            var t = k()
                , e = c(t);
            if (((m = arguments),
                (v = this),
                (d = t),
                e)) {
                if (h === l)
                    return i(d);
                if (x)
                    return (h = setTimeout(a, n)),
                        r(d);
            }
            return h === l && (h = setTimeout(a, n)),
                O;
        }
        var m, v, j, O, h, d, T = 0, w = false, x = false, S = true;
        if (typeof t != "function")
            throw new TypeError(s);
        return ((n = f(n) || 0),
            u(e) && ((w = !!e.leading),
                (x = "maxWait" in e),
                (j = x ? I(f(e.maxWait) || 0, n) : j),
                (S = "trailing" in e ? !!e.trailing : S)),
            (g.cancel = p),
            (g.flush = y),
            g);
    }
    function o(t, n, e) {
        var r = true
            , o = true;
        if (typeof t != "function")
            throw new TypeError(s);
        return (u(e) && ((r = "leading" in e ? !!e.leading : r),
            (o = "trailing" in e ? !!e.trailing : o)),
            i(t, n, {
                leading: r,
                maxWait: n,
                trailing: o
            }));
    }
    function u(t) {
        var n = typeof t;
        return null != t && ("object" == n || "function" == n);
    }
    function c(t) {
        return null != t && typeof t == "object";
    }
    function a(t) {
        return typeof t == "symbol" || (c(t) && n(t) == g);
    }
    function f(t) {
        if (typeof t == "number")
            return t;
        if (a(t))
            return p;
        if (u(t)) {
            var n = typeof t.valueOf == "function" ? t.valueOf() : t;
            t = u(n) ? n + "" : n;
        }
        if (typeof t != "string")
            return 0 === t ? t : +t;
        t = t.replace(v, "");
        var e = O.test(t);
        return e || h.test(t) ? d(t.slice(2), e ? 2 : 8) : j.test(t) ? p : +t;
    }
    var l, b = "4.17.5", s = "Expected a function", p = NaN, y = "[object Null]", g = "[object Symbol]", m = "[object Undefined]", v = /^\s+|\s+$/g, j = /^[-+]0x[0-9a-f]+$/i, O = /^0b[01]+$/i, h = /^0o[0-7]+$/i, d = parseInt, T = typeof global == "object" && global && global.Object === Object && global, w = typeof self == "object" && self && self.Object === Object && self, x = T || w || Function("return this")(), S = Object.prototype, N = S.hasOwnProperty, E = S.toString, $ = x.Symbol, W = $ ? $.toStringTag : l, I = Math.max, M = Math.min, k = function () {
        return x.Date.now();
    };
    (t.debounce = i),
        (t.throttle = o),
        (t.isObject = u),
        (t.isObjectLike = c),
        (t.isSymbol = a),
        (t.now = k),
        (t.toNumber = f),
        (t.VERSION = b),
        (x._ = t);
}.call(this));


class Showslider {
    constructor(el) {
        this.el = el;
        this.prev = this.el.querySelector("[data-showslider-prev]");
        this.next = this.el.querySelector("[data-showslider-next]");
        this.slider = this.el.querySelector("[data-showslider-slider]");
        this.slides = this.el.querySelectorAll("[data-showslider-slide]");
        this.currIndex = 0;
        this.sliderLength = this.slides.length;
        this.offsets = [];
        this.slideWidth = this.slides[0].getBoundingClientRect().width;

        this.countOffsets();

        if (this.checkIfSlider()) {
            this.el.classList.add("showslider--activated");
            this.slideToIndex(0);
            this.checkEdges();
            this.setCurrentSlide(0);
            this.addListeners();
        }
    }

    countOffsets() {
        const elOffset = this.el.getBoundingClientRect().left;
        const sliderScroll = this.slider.scrollLeft;

        this.el.style.setProperty("--showslider-width", this.el.getBoundingClientRect().width);

        this.el.style.setProperty("--showslider-slide-width", this.slideWidth);

        this.offsets = [...this.slides].map((slide) => {
            const offset = slide.getBoundingClientRect().left - elOffset + sliderScroll;
            slide.style.setProperty("--showslider-slide-offset", offset);
            return offset;
        }
        );
    }

    moveSlider(offset) {
        this.slider.scrollTo(offset, 0);
    }

    setCurrentSlide(index) {
        this.el.style.setProperty("--showslider-slider-scroll", this.slider.scrollLeft);
        this.currIndex = index;
        [...this.slides].map((slide) => slide.classList.remove("is-first-active"));
        this.slides[index].classList.add("is-first-active");
    }

    slideToIndex(index) {
        if (index < 0 || index >= this.sliderLength) {
            return;
        }

        this.moveSlider(this.offsets[index]);
    }

    slidePrev() {
        this.slideToIndex(this.currIndex - 1);
    }

    slideNext() {
        this.slideToIndex(this.currIndex + 1);
    }

    checkIfSlider() {
        return this.slider.scrollWidth - this.slider.offsetWidth > 10;
    }

    handleFocusIn(slide) {
        if (document.body.classList.contains("is-tabbed")) {
            const index = [...this.slides].findIndex((thisSlide) => thisSlide === slide);

            this.slideToIndex(index);
        }
    }

    checkEdges() {
        if (this.slider.scrollLeft == this.offsets[0]) {
            this.prev.setAttribute("disabled", "");
            this.next.removeAttribute("disabled");
        } else if (this.slider.scrollLeft + this.slider.offsetWidth == this.slider.scrollWidth) {
            this.prev.removeAttribute("disabled");
            this.next.setAttribute("disabled", "");
        } else {
            [this.prev, this.next].map((button) => button.removeAttribute("disabled"));
        }
    }

    addListeners() {
        if (this.prev && this.next) {
            this.prev.addEventListener("click", () => this.slidePrev());
            this.next.addEventListener("click", () => this.slideNext());
        }

        [...this.slides].map((slide) => {
            slide.addEventListener("focusin", () => this.handleFocusIn(slide));
        }
        );

        this.slider.addEventListener("scroll", () => {
            requestAnimationFrame(() => {
                this.setCurrentSlide(this.offsets.findIndex((offset) => offset >= this.slider.scrollLeft));
            }
            );
        }
        );

        this.slider.addEventListener("scroll", _.debounce(() => this.checkEdges(), 10));

        window.addEventListener("resize", () => {
            this.countOffsets();
        }
        );
    }
}

const showsliders = document.querySelectorAll("[data-showslider]");

showsliders.forEach((showslider) => new Showslider(showslider));
