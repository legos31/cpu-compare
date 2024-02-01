(function () {


	/*!
	 * Bootstrap v4.5.0 (https://getbootstrap.com/)
	 * Copyright 2011-2020 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
	 */
	! function (t, e) {
		"object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && "undefined" != typeof module ? e(exports, require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "jquery"], e) : e((t = t || self).bootstrap = {}, t.jQuery);
	}(undefined, function (t, e) {

		function n(t, e) {
			for (var n = 0; n < e.length; n++) {
				var i = e[n];
				i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
			}
		}

		function i(t, e, i) {
			return e && n(t.prototype, e), i && n(t, i), t;
		}

		function o(t, e, n) {
			return e in t ? Object.defineProperty(t, e, {
				value: n,
				enumerable: !0,
				configurable: !0,
				writable: !0
			}) : t[e] = n, t;
		}

		function r(t, e) {
			var n = Object.keys(t);

			if (Object.getOwnPropertySymbols) {
				var i = Object.getOwnPropertySymbols(t);
				e && (i = i.filter(function (e) {
					return Object.getOwnPropertyDescriptor(t, e).enumerable;
				})), n.push.apply(n, i);
			}

			return n;
		}

		function s(t) {
			for (var e = 1; e < arguments.length; e++) {
				var n = null != arguments[e] ? arguments[e] : {};
				e % 2 ? r(Object(n), !0).forEach(function (e) {
					o(t, e, n[e]);
				}) : Object.getOwnPropertyDescriptors ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n)) : r(Object(n)).forEach(function (e) {
					Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e));
				});
			}

			return t;
		}

		e = e && Object.prototype.hasOwnProperty.call(e, "default") ? e["default"] : e;

		function a(t) {
			var n = this,
				i = !1;
			return e(this).one(l.TRANSITION_END, function () {
				i = !0;
			}), setTimeout(function () {
				i || l.triggerTransitionEnd(n);
			}, t), this;
		}

		var l = {
			TRANSITION_END: "bsTransitionEnd",
			getUID: function getUID(t) {
				do {
					t += ~~(1e6 * Math.random());
				} while (document.getElementById(t));

				return t;
			},
			getSelectorFromElement: function getSelectorFromElement(t) {
				var e = t.getAttribute("data-target");

				if (!e || "#" === e) {
					var n = t.getAttribute("href");
					e = n && "#" !== n ? n.trim() : "";
				}

				try {
					return document.querySelector(e) ? e : null;
				} catch (t) {
					return null;
				}
			},
			getTransitionDurationFromElement: function getTransitionDurationFromElement(t) {
				if (!t) return 0;
				var n = e(t).css("transition-duration"),
					i = e(t).css("transition-delay"),
					o = parseFloat(n),
					r = parseFloat(i);
				return o || r ? (n = n.split(",")[0], i = i.split(",")[0], 1e3 * (parseFloat(n) + parseFloat(i))) : 0;
			},
			reflow: function reflow(t) {
				return t.offsetHeight;
			},
			triggerTransitionEnd: function triggerTransitionEnd(t) {
				e(t).trigger("transitionend");
			},
			supportsTransitionEnd: function supportsTransitionEnd() {
				return Boolean("transitionend");
			},
			isElement: function isElement(t) {
				return (t[0] || t).nodeType;
			},
			typeCheckConfig: function typeCheckConfig(t, e, n) {
				for (var i in n) {
					if (Object.prototype.hasOwnProperty.call(n, i)) {
						var o = n[i],
							r = e[i],
							s = r && l.isElement(r) ? "element" : null === (a = r) || "undefined" == typeof a ? "" + a : {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase();
						if (!new RegExp(o).test(s)) throw new Error(t.toUpperCase() + ': Option "' + i + '" provided type "' + s + '" but expected type "' + o + '".');
					}
				}

				var a;
			},
			findShadowRoot: function findShadowRoot(t) {
				if (!document.documentElement.attachShadow) return null;

				if ("function" == typeof t.getRootNode) {
					var e = t.getRootNode();
					return e instanceof ShadowRoot ? e : null;
				}

				return t instanceof ShadowRoot ? t : t.parentNode ? l.findShadowRoot(t.parentNode) : null;
			},
			jQueryDetection: function jQueryDetection() {
				if ("undefined" == typeof e) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
				var t = e.fn.jquery.split(" ")[0].split(".");
				if (t[0] < 2 && t[1] < 9 || 1 === t[0] && 9 === t[1] && t[2] < 1 || t[0] >= 4) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0");
			}
		};
		l.jQueryDetection(), e.fn.emulateTransitionEnd = a, e.event.special[l.TRANSITION_END] = {
			bindType: "transitionend",
			delegateType: "transitionend",
			handle: function handle(t) {
				if (e(t.target).is(this)) return t.handleObj.handler.apply(this, arguments);
			}
		};

		var c = "alert",
			u = e.fn[c],
			h = function () {
				function t(t) {
					this._element = t;
				}

				var n = t.prototype;
				return n.close = function (t) {
					var e = this._element;
					t && (e = this._getRootElement(t)), this._triggerCloseEvent(e).isDefaultPrevented() || this._removeElement(e);
				}, n.dispose = function () {
					e.removeData(this._element, "bs.alert"), this._element = null;
				}, n._getRootElement = function (t) {
					var n = l.getSelectorFromElement(t),
						i = !1;
					return n && (i = document.querySelector(n)), i || (i = e(t).closest(".alert")[0]), i;
				}, n._triggerCloseEvent = function (t) {
					var n = e.Event("close.bs.alert");
					return e(t).trigger(n), n;
				}, n._removeElement = function (t) {
					var n = this;

					if (e(t).removeClass("show"), e(t).hasClass("fade")) {
						var i = l.getTransitionDurationFromElement(t);
						e(t).one(l.TRANSITION_END, function (e) {
							return n._destroyElement(t, e);
						}).emulateTransitionEnd(i);
					} else this._destroyElement(t);
				}, n._destroyElement = function (t) {
					e(t).detach().trigger("closed.bs.alert").remove();
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this),
							o = i.data("bs.alert");
						o || (o = new t(this), i.data("bs.alert", o)), "close" === n && o[n](this);
					});
				}, t._handleDismiss = function (t) {
					return function (e) {
						e && e.preventDefault(), t.close(this);
					};
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}]), t;
			}();

		e(document).on("click.bs.alert.data-api", '[data-dismiss="alert"]', h._handleDismiss(new h())), e.fn[c] = h._jQueryInterface, e.fn[c].Constructor = h, e.fn[c].noConflict = function () {
			return e.fn[c] = u, h._jQueryInterface;
		};

		var f = e.fn.button,
			d = function () {
				function t(t) {
					this._element = t;
				}

				var n = t.prototype;
				return n.toggle = function () {
					var t = !0,
						n = !0,
						i = e(this._element).closest('[data-toggle="buttons"]')[0];

					if (i) {
						var o = this._element.querySelector('input:not([type="hidden"])');

						if (o) {
							if ("radio" === o.type)
								if (o.checked && this._element.classList.contains("active")) t = !1;
								else {
									var r = i.querySelector(".active");
									r && e(r).removeClass("active");
								}
							t && ("checkbox" !== o.type && "radio" !== o.type || (o.checked = !this._element.classList.contains("active")), e(o).trigger("change")), o.focus(), n = !1;
						}
					}

					this._element.hasAttribute("disabled") || this._element.classList.contains("disabled") || (n && this._element.setAttribute("aria-pressed", !this._element.classList.contains("active")), t && e(this._element).toggleClass("active"));
				}, n.dispose = function () {
					e.removeData(this._element, "bs.button"), this._element = null;
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this).data("bs.button");
						i || (i = new t(this), e(this).data("bs.button", i)), "toggle" === n && i[n]();
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}]), t;
			}();

		e(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (t) {
			var n = t.target,
				i = n;
			if (e(n).hasClass("btn") || (n = e(n).closest(".btn")[0]), !n || n.hasAttribute("disabled") || n.classList.contains("disabled")) t.preventDefault();
			else {
				var o = n.querySelector('input:not([type="hidden"])');
				if (o && (o.hasAttribute("disabled") || o.classList.contains("disabled"))) return void t.preventDefault();
				"LABEL" === i.tagName && o && "checkbox" === o.type && t.preventDefault(), d._jQueryInterface.call(e(n), "toggle");
			}
		}).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (t) {
			var n = e(t.target).closest(".btn")[0];
			e(n).toggleClass("focus", /^focus(in)?$/.test(t.type));
		}), e(window).on("load.bs.button.data-api", function () {
			for (var t = [].slice.call(document.querySelectorAll('[data-toggle="buttons"] .btn')), e = 0, n = t.length; e < n; e++) {
				var i = t[e],
					o = i.querySelector('input:not([type="hidden"])');
				o.checked || o.hasAttribute("checked") ? i.classList.add("active") : i.classList.remove("active");
			}

			for (var r = 0, s = (t = [].slice.call(document.querySelectorAll('[data-toggle="button"]'))).length; r < s; r++) {
				var a = t[r];
				"true" === a.getAttribute("aria-pressed") ? a.classList.add("active") : a.classList.remove("active");
			}
		}), e.fn.button = d._jQueryInterface, e.fn.button.Constructor = d, e.fn.button.noConflict = function () {
			return e.fn.button = f, d._jQueryInterface;
		};

		var p = "carousel",
			m = ".bs.carousel",
			g = e.fn[p],
			v = {
				interval: 5e3,
				keyboard: !0,
				slide: !1,
				pause: "hover",
				wrap: !0,
				touch: !0
			},
			_ = {
				interval: "(number|boolean)",
				keyboard: "boolean",
				slide: "(boolean|string)",
				pause: "(string|boolean)",
				wrap: "boolean",
				touch: "boolean"
			},
			b = {
				TOUCH: "touch",
				PEN: "pen"
			},
			y = function () {
				function t(t, e) {
					this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(e), this._element = t, this._indicatorsElement = this._element.querySelector(".carousel-indicators"), this._touchSupported = "ontouchstart" in document.documentElement || navigator.maxTouchPoints > 0, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners();
				}

				var n = t.prototype;
				return n.next = function () {
					this._isSliding || this._slide("next");
				}, n.nextWhenVisible = function () {
					!document.hidden && e(this._element).is(":visible") && "hidden" !== e(this._element).css("visibility") && this.next();
				}, n.prev = function () {
					this._isSliding || this._slide("prev");
				}, n.pause = function (t) {
					t || (this._isPaused = !0), this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (l.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null;
				}, n.cycle = function (t) {
					t || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval));
				}, n.to = function (t) {
					var n = this;
					this._activeElement = this._element.querySelector(".active.carousel-item");

					var i = this._getItemIndex(this._activeElement);

					if (!(t > this._items.length - 1 || t < 0))
						if (this._isSliding) e(this._element).one("slid.bs.carousel", function () {
							return n.to(t);
						});
						else {
							if (i === t) return this.pause(), void this.cycle();
							var o = t > i ? "next" : "prev";

							this._slide(o, this._items[t]);
						}
				}, n.dispose = function () {
					e(this._element).off(m), e.removeData(this._element, "bs.carousel"), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null;
				}, n._getConfig = function (t) {
					return t = s(s({}, v), t), l.typeCheckConfig(p, t, _), t;
				}, n._handleSwipe = function () {
					var t = Math.abs(this.touchDeltaX);

					if (!(t <= 40)) {
						var e = t / this.touchDeltaX;
						this.touchDeltaX = 0, e > 0 && this.prev(), e < 0 && this.next();
					}
				}, n._addEventListeners = function () {
					var t = this;
					this._config.keyboard && e(this._element).on("keydown.bs.carousel", function (e) {
						return t._keydown(e);
					}), "hover" === this._config.pause && e(this._element).on("mouseenter.bs.carousel", function (e) {
						return t.pause(e);
					}).on("mouseleave.bs.carousel", function (e) {
						return t.cycle(e);
					}), this._config.touch && this._addTouchEventListeners();
				}, n._addTouchEventListeners = function () {
					var t = this;

					if (this._touchSupported) {
						var n = function n(e) {
								t._pointerEvent && b[e.originalEvent.pointerType.toUpperCase()] ? t.touchStartX = e.originalEvent.clientX : t._pointerEvent || (t.touchStartX = e.originalEvent.touches[0].clientX);
							},
							i = function i(e) {
								t._pointerEvent && b[e.originalEvent.pointerType.toUpperCase()] && (t.touchDeltaX = e.originalEvent.clientX - t.touchStartX), t._handleSwipe(), "hover" === t._config.pause && (t.pause(), t.touchTimeout && clearTimeout(t.touchTimeout), t.touchTimeout = setTimeout(function (e) {
									return t.cycle(e);
								}, 500 + t._config.interval));
							};

						e(this._element.querySelectorAll(".carousel-item img")).on("dragstart.bs.carousel", function (t) {
							return t.preventDefault();
						}), this._pointerEvent ? (e(this._element).on("pointerdown.bs.carousel", function (t) {
							return n(t);
						}), e(this._element).on("pointerup.bs.carousel", function (t) {
							return i(t);
						}), this._element.classList.add("pointer-event")) : (e(this._element).on("touchstart.bs.carousel", function (t) {
							return n(t);
						}), e(this._element).on("touchmove.bs.carousel", function (e) {
							return function (e) {
								e.originalEvent.touches && e.originalEvent.touches.length > 1 ? t.touchDeltaX = 0 : t.touchDeltaX = e.originalEvent.touches[0].clientX - t.touchStartX;
							}(e);
						}), e(this._element).on("touchend.bs.carousel", function (t) {
							return i(t);
						}));
					}
				}, n._keydown = function (t) {
					if (!/input|textarea/i.test(t.target.tagName)) switch (t.which) {
						case 37:
							t.preventDefault(), this.prev();
							break;

						case 39:
							t.preventDefault(), this.next();
					}
				}, n._getItemIndex = function (t) {
					return this._items = t && t.parentNode ? [].slice.call(t.parentNode.querySelectorAll(".carousel-item")) : [], this._items.indexOf(t);
				}, n._getItemByDirection = function (t, e) {
					var n = "next" === t,
						i = "prev" === t,
						o = this._getItemIndex(e),
						r = this._items.length - 1;

					if ((i && 0 === o || n && o === r) && !this._config.wrap) return e;
					var s = (o + ("prev" === t ? -1 : 1)) % this._items.length;
					return -1 === s ? this._items[this._items.length - 1] : this._items[s];
				}, n._triggerSlideEvent = function (t, n) {
					var i = this._getItemIndex(t),
						o = this._getItemIndex(this._element.querySelector(".active.carousel-item")),
						r = e.Event("slide.bs.carousel", {
							relatedTarget: t,
							direction: n,
							from: o,
							to: i
						});

					return e(this._element).trigger(r), r;
				}, n._setActiveIndicatorElement = function (t) {
					if (this._indicatorsElement) {
						var n = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
						e(n).removeClass("active");

						var i = this._indicatorsElement.children[this._getItemIndex(t)];

						i && e(i).addClass("active");
					}
				}, n._slide = function (t, n) {
					var i,
						o,
						r,
						s = this,
						a = this._element.querySelector(".active.carousel-item"),
						c = this._getItemIndex(a),
						u = n || a && this._getItemByDirection(t, a),
						h = this._getItemIndex(u),
						f = Boolean(this._interval);

					if ("next" === t ? (i = "carousel-item-left", o = "carousel-item-next", r = "left") : (i = "carousel-item-right", o = "carousel-item-prev", r = "right"), u && e(u).hasClass("active")) this._isSliding = !1;
					else if (!this._triggerSlideEvent(u, r).isDefaultPrevented() && a && u) {
						this._isSliding = !0, f && this.pause(), this._setActiveIndicatorElement(u);
						var d = e.Event("slid.bs.carousel", {
							relatedTarget: u,
							direction: r,
							from: c,
							to: h
						});

						if (e(this._element).hasClass("slide")) {
							e(u).addClass(o), l.reflow(u), e(a).addClass(i), e(u).addClass(i);
							var p = parseInt(u.getAttribute("data-interval"), 10);
							p ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, this._config.interval = p) : this._config.interval = this._config.defaultInterval || this._config.interval;
							var m = l.getTransitionDurationFromElement(a);
							e(a).one(l.TRANSITION_END, function () {
								e(u).removeClass(i + " " + o).addClass("active"), e(a).removeClass("active " + o + " " + i), s._isSliding = !1, setTimeout(function () {
									return e(s._element).trigger(d);
								}, 0);
							}).emulateTransitionEnd(m);
						} else e(a).removeClass("active"), e(u).addClass("active"), this._isSliding = !1, e(this._element).trigger(d);

						f && this.cycle();
					}
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this).data("bs.carousel"),
							o = s(s({}, v), e(this).data());
						"object" == _typeof(n) && (o = s(s({}, o), n));
						var r = "string" == typeof n ? n : o.slide;
						if (i || (i = new t(this, o), e(this).data("bs.carousel", i)), "number" == typeof n) i.to(n);
						else if ("string" == typeof r) {
							if ("undefined" == typeof i[r]) throw new TypeError('No method named "' + r + '"');
							i[r]();
						} else o.interval && o.ride && (i.pause(), i.cycle());
					});
				}, t._dataApiClickHandler = function (n) {
					var i = l.getSelectorFromElement(this);

					if (i) {
						var o = e(i)[0];

						if (o && e(o).hasClass("carousel")) {
							var r = s(s({}, e(o).data()), e(this).data()),
								a = this.getAttribute("data-slide-to");
							a && (r.interval = !1), t._jQueryInterface.call(e(o), r), a && e(o).data("bs.carousel").to(a), n.preventDefault();
						}
					}
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return v;
					}
				}]), t;
			}();

		e(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", y._dataApiClickHandler), e(window).on("load.bs.carousel.data-api", function () {
			for (var t = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), n = 0, i = t.length; n < i; n++) {
				var o = e(t[n]);

				y._jQueryInterface.call(o, o.data());
			}
		}), e.fn[p] = y._jQueryInterface, e.fn[p].Constructor = y, e.fn[p].noConflict = function () {
			return e.fn[p] = g, y._jQueryInterface;
		};

		var w = "collapse",
			E = e.fn[w],
			T = {
				toggle: !0,
				parent: ""
			},
			C = {
				toggle: "boolean",
				parent: "(string|element)"
			},
			S = function () {
				function t(t, e) {
					this._isTransitioning = !1, this._element = t, this._config = this._getConfig(e), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + t.id + '"],[data-toggle="collapse"][data-target="#' + t.id + '"]'));

					for (var n = [].slice.call(document.querySelectorAll('[data-toggle="collapse"]')), i = 0, o = n.length; i < o; i++) {
						var r = n[i],
							s = l.getSelectorFromElement(r),
							a = [].slice.call(document.querySelectorAll(s)).filter(function (e) {
								return e === t;
							});
						null !== s && a.length > 0 && (this._selector = s, this._triggerArray.push(r));
					}

					this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle();
				}

				var n = t.prototype;
				return n.toggle = function () {
					e(this._element).hasClass("show") ? this.hide() : this.show();
				}, n.show = function () {
					var n,
						i,
						o = this;

					if (!this._isTransitioning && !e(this._element).hasClass("show") && (this._parent && 0 === (n = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function (t) {
							return "string" == typeof o._config.parent ? t.getAttribute("data-parent") === o._config.parent : t.classList.contains("collapse");
						})).length && (n = null), !(n && (i = e(n).not(this._selector).data("bs.collapse")) && i._isTransitioning))) {
						var r = e.Event("show.bs.collapse");

						if (e(this._element).trigger(r), !r.isDefaultPrevented()) {
							n && (t._jQueryInterface.call(e(n).not(this._selector), "hide"), i || e(n).data("bs.collapse", null));

							var s = this._getDimension();

							e(this._element).removeClass("collapse").addClass("collapsing"), this._element.style[s] = 0, this._triggerArray.length && e(this._triggerArray).removeClass("collapsed").attr("aria-expanded", !0), this.setTransitioning(!0);
							var a = "scroll" + (s[0].toUpperCase() + s.slice(1)),
								c = l.getTransitionDurationFromElement(this._element);
							e(this._element).one(l.TRANSITION_END, function () {
								e(o._element).removeClass("collapsing").addClass("collapse show"), o._element.style[s] = "", o.setTransitioning(!1), e(o._element).trigger("shown.bs.collapse");
							}).emulateTransitionEnd(c), this._element.style[s] = this._element[a] + "px";
						}
					}
				}, n.hide = function () {
					var t = this;

					if (!this._isTransitioning && e(this._element).hasClass("show")) {
						var n = e.Event("hide.bs.collapse");

						if (e(this._element).trigger(n), !n.isDefaultPrevented()) {
							var i = this._getDimension();

							this._element.style[i] = this._element.getBoundingClientRect()[i] + "px", l.reflow(this._element), e(this._element).addClass("collapsing").removeClass("collapse show");
							var o = this._triggerArray.length;
							if (o > 0)
								for (var r = 0; r < o; r++) {
									var s = this._triggerArray[r],
										a = l.getSelectorFromElement(s);
									if (null !== a) e([].slice.call(document.querySelectorAll(a))).hasClass("show") || e(s).addClass("collapsed").attr("aria-expanded", !1);
								}
							this.setTransitioning(!0);
							this._element.style[i] = "";
							var c = l.getTransitionDurationFromElement(this._element);
							e(this._element).one(l.TRANSITION_END, function () {
								t.setTransitioning(!1), e(t._element).removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse");
							}).emulateTransitionEnd(c);
						}
					}
				}, n.setTransitioning = function (t) {
					this._isTransitioning = t;
				}, n.dispose = function () {
					e.removeData(this._element, "bs.collapse"), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null;
				}, n._getConfig = function (t) {
					return (t = s(s({}, T), t)).toggle = Boolean(t.toggle), l.typeCheckConfig(w, t, C), t;
				}, n._getDimension = function () {
					return e(this._element).hasClass("width") ? "width" : "height";
				}, n._getParent = function () {
					var n,
						i = this;
					l.isElement(this._config.parent) ? (n = this._config.parent, "undefined" != typeof this._config.parent.jquery && (n = this._config.parent[0])) : n = document.querySelector(this._config.parent);
					var o = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
						r = [].slice.call(n.querySelectorAll(o));
					return e(r).each(function (e, n) {
						i._addAriaAndCollapsedClass(t._getTargetFromElement(n), [n]);
					}), n;
				}, n._addAriaAndCollapsedClass = function (t, n) {
					var i = e(t).hasClass("show");
					n.length && e(n).toggleClass("collapsed", !i).attr("aria-expanded", i);
				}, t._getTargetFromElement = function (t) {
					var e = l.getSelectorFromElement(t);
					return e ? document.querySelector(e) : null;
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this),
							o = i.data("bs.collapse"),
							r = s(s(s({}, T), i.data()), "object" == _typeof(n) && n ? n : {});

						if (!o && r.toggle && "string" == typeof n && /show|hide/.test(n) && (r.toggle = !1), o || (o = new t(this, r), i.data("bs.collapse", o)), "string" == typeof n) {
							if ("undefined" == typeof o[n]) throw new TypeError('No method named "' + n + '"');
							o[n]();
						}
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return T;
					}
				}]), t;
			}();

		e(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (t) {
			"A" === t.currentTarget.tagName && t.preventDefault();
			var n = e(this),
				i = l.getSelectorFromElement(this),
				o = [].slice.call(document.querySelectorAll(i));
			e(o).each(function () {
				var t = e(this),
					i = t.data("bs.collapse") ? "toggle" : n.data();

				S._jQueryInterface.call(t, i);
			});
		}), e.fn[w] = S._jQueryInterface, e.fn[w].Constructor = S, e.fn[w].noConflict = function () {
			return e.fn[w] = E, S._jQueryInterface;
		};

		var D = "undefined" != typeof window && "undefined" != typeof document && "undefined" != typeof navigator,
			k = function () {
				for (var t = ["Edge", "Trident", "Firefox"], e = 0; e < t.length; e += 1) {
					if (D && navigator.userAgent.indexOf(t[e]) >= 0) return 1;
				}

				return 0;
			}();

		var N = D && window.Promise ? function (t) {
			var e = !1;
			return function () {
				e || (e = !0, window.Promise.resolve().then(function () {
					e = !1, t();
				}));
			};
		} : function (t) {
			var e = !1;
			return function () {
				e || (e = !0, setTimeout(function () {
					e = !1, t();
				}, k));
			};
		};

		function O(t) {
			return t && "[object Function]" === {}.toString.call(t);
		}

		function A(t, e) {
			if (1 !== t.nodeType) return [];
			var n = t.ownerDocument.defaultView.getComputedStyle(t, null);
			return e ? n[e] : n;
		}

		function I(t) {
			return "HTML" === t.nodeName ? t : t.parentNode || t.host;
		}

		function x(t) {
			if (!t) return document.body;

			switch (t.nodeName) {
				case "HTML":
				case "BODY":
					return t.ownerDocument.body;

				case "#document":
					return t.body;
			}

			var e = A(t),
				n = e.overflow,
				i = e.overflowX,
				o = e.overflowY;
			return /(auto|scroll|overlay)/.test(n + o + i) ? t : x(I(t));
		}

		function j(t) {
			return t && t.referenceNode ? t.referenceNode : t;
		}

		var L = D && !(!window.MSInputMethodContext || !document.documentMode),
			P = D && /MSIE 10/.test(navigator.userAgent);

		function F(t) {
			return 11 === t ? L : 10 === t ? P : L || P;
		}

		function R(t) {
			if (!t) return document.documentElement;

			for (var e = F(10) ? document.body : null, n = t.offsetParent || null; n === e && t.nextElementSibling;) {
				n = (t = t.nextElementSibling).offsetParent;
			}

			var i = n && n.nodeName;
			return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TH", "TD", "TABLE"].indexOf(n.nodeName) && "static" === A(n, "position") ? R(n) : n : t ? t.ownerDocument.documentElement : document.documentElement;
		}

		function M(t) {
			return null !== t.parentNode ? M(t.parentNode) : t;
		}

		function B(t, e) {
			if (!(t && t.nodeType && e && e.nodeType)) return document.documentElement;
			var n = t.compareDocumentPosition(e) & Node.DOCUMENT_POSITION_FOLLOWING,
				i = n ? t : e,
				o = n ? e : t,
				r = document.createRange();
			r.setStart(i, 0), r.setEnd(o, 0);
			var s,
				a,
				l = r.commonAncestorContainer;
			if (t !== l && e !== l || i.contains(o)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && R(s.firstElementChild) !== s ? R(l) : l;
			var c = M(t);
			return c.host ? B(c.host, e) : B(t, M(e).host);
		}

		function q(t) {
			var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "top",
				n = "top" === e ? "scrollTop" : "scrollLeft",
				i = t.nodeName;

			if ("BODY" === i || "HTML" === i) {
				var o = t.ownerDocument.documentElement,
					r = t.ownerDocument.scrollingElement || o;
				return r[n];
			}

			return t[n];
		}

		function H(t, e) {
			var n = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
				i = q(e, "top"),
				o = q(e, "left"),
				r = n ? -1 : 1;
			return t.top += i * r, t.bottom += i * r, t.left += o * r, t.right += o * r, t;
		}

		function Q(t, e) {
			var n = "x" === e ? "Left" : "Top",
				i = "Left" === n ? "Right" : "Bottom";
			return parseFloat(t["border" + n + "Width"], 10) + parseFloat(t["border" + i + "Width"], 10);
		}

		function W(t, e, n, i) {
			return Math.max(e["offset" + t], e["scroll" + t], n["client" + t], n["offset" + t], n["scroll" + t], F(10) ? parseInt(n["offset" + t]) + parseInt(i["margin" + ("Height" === t ? "Top" : "Left")]) + parseInt(i["margin" + ("Height" === t ? "Bottom" : "Right")]) : 0);
		}

		function U(t) {
			var e = t.body,
				n = t.documentElement,
				i = F(10) && getComputedStyle(n);
			return {
				height: W("Height", e, n, i),
				width: W("Width", e, n, i)
			};
		}

		var V = function V(t, e) {
				if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
			},
			Y = function () {
				function t(t, e) {
					for (var n = 0; n < e.length; n++) {
						var i = e[n];
						i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
					}
				}

				return function (e, n, i) {
					return n && t(e.prototype, n), i && t(e, i), e;
				};
			}(),
			z = function z(t, e, n) {
				return e in t ? Object.defineProperty(t, e, {
					value: n,
					enumerable: !0,
					configurable: !0,
					writable: !0
				}) : t[e] = n, t;
			},
			X = Object.assign || function (t) {
				for (var e = 1; e < arguments.length; e++) {
					var n = arguments[e];

					for (var i in n) {
						Object.prototype.hasOwnProperty.call(n, i) && (t[i] = n[i]);
					}
				}

				return t;
			};

		function K(t) {
			return X({}, t, {
				right: t.left + t.width,
				bottom: t.top + t.height
			});
		}

		function G(t) {
			var e = {};

			try {
				if (F(10)) {
					e = t.getBoundingClientRect();
					var n = q(t, "top"),
						i = q(t, "left");
					e.top += n, e.left += i, e.bottom += n, e.right += i;
				} else e = t.getBoundingClientRect();
			} catch (t) {}

			var o = {
					left: e.left,
					top: e.top,
					width: e.right - e.left,
					height: e.bottom - e.top
				},
				r = "HTML" === t.nodeName ? U(t.ownerDocument) : {},
				s = r.width || t.clientWidth || o.width,
				a = r.height || t.clientHeight || o.height,
				l = t.offsetWidth - s,
				c = t.offsetHeight - a;

			if (l || c) {
				var u = A(t);
				l -= Q(u, "x"), c -= Q(u, "y"), o.width -= l, o.height -= c;
			}

			return K(o);
		}

		function $(t, e) {
			var n = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
				i = F(10),
				o = "HTML" === e.nodeName,
				r = G(t),
				s = G(e),
				a = x(t),
				l = A(e),
				c = parseFloat(l.borderTopWidth, 10),
				u = parseFloat(l.borderLeftWidth, 10);
			n && o && (s.top = Math.max(s.top, 0), s.left = Math.max(s.left, 0));
			var h = K({
				top: r.top - s.top - c,
				left: r.left - s.left - u,
				width: r.width,
				height: r.height
			});

			if (h.marginTop = 0, h.marginLeft = 0, !i && o) {
				var f = parseFloat(l.marginTop, 10),
					d = parseFloat(l.marginLeft, 10);
				h.top -= c - f, h.bottom -= c - f, h.left -= u - d, h.right -= u - d, h.marginTop = f, h.marginLeft = d;
			}

			return (i && !n ? e.contains(a) : e === a && "BODY" !== a.nodeName) && (h = H(h, e)), h;
		}

		function J(t) {
			var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
				n = t.ownerDocument.documentElement,
				i = $(t, n),
				o = Math.max(n.clientWidth, window.innerWidth || 0),
				r = Math.max(n.clientHeight, window.innerHeight || 0),
				s = e ? 0 : q(n),
				a = e ? 0 : q(n, "left"),
				l = {
					top: s - i.top + i.marginTop,
					left: a - i.left + i.marginLeft,
					width: o,
					height: r
				};
			return K(l);
		}

		function Z(t) {
			var e = t.nodeName;
			if ("BODY" === e || "HTML" === e) return !1;
			if ("fixed" === A(t, "position")) return !0;
			var n = I(t);
			return !!n && Z(n);
		}

		function tt(t) {
			if (!t || !t.parentElement || F()) return document.documentElement;

			for (var e = t.parentElement; e && "none" === A(e, "transform");) {
				e = e.parentElement;
			}

			return e || document.documentElement;
		}

		function et(t, e, n, i) {
			var o = arguments.length > 4 && void 0 !== arguments[4] && arguments[4],
				r = {
					top: 0,
					left: 0
				},
				s = o ? tt(t) : B(t, j(e));
			if ("viewport" === i) r = J(s, o);
			else {
				var a = void 0;
				"scrollParent" === i ? "BODY" === (a = x(I(e))).nodeName && (a = t.ownerDocument.documentElement) : a = "window" === i ? t.ownerDocument.documentElement : i;
				var l = $(a, s, o);
				if ("HTML" !== a.nodeName || Z(s)) r = l;
				else {
					var c = U(t.ownerDocument),
						u = c.height,
						h = c.width;
					r.top += l.top - l.marginTop, r.bottom = u + l.top, r.left += l.left - l.marginLeft, r.right = h + l.left;
				}
			}
			var f = "number" == typeof (n = n || 0);
			return r.left += f ? n : n.left || 0, r.top += f ? n : n.top || 0, r.right -= f ? n : n.right || 0, r.bottom -= f ? n : n.bottom || 0, r;
		}

		function nt(t) {
			return t.width * t.height;
		}

		function it(t, e, n, i, o) {
			var r = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : 0;
			if (-1 === t.indexOf("auto")) return t;
			var s = et(n, i, r, o),
				a = {
					top: {
						width: s.width,
						height: e.top - s.top
					},
					right: {
						width: s.right - e.right,
						height: s.height
					},
					bottom: {
						width: s.width,
						height: s.bottom - e.bottom
					},
					left: {
						width: e.left - s.left,
						height: s.height
					}
				},
				l = Object.keys(a).map(function (t) {
					return X({
						key: t
					}, a[t], {
						area: nt(a[t])
					});
				}).sort(function (t, e) {
					return e.area - t.area;
				}),
				c = l.filter(function (t) {
					var e = t.width,
						i = t.height;
					return e >= n.clientWidth && i >= n.clientHeight;
				}),
				u = c.length > 0 ? c[0].key : l[0].key,
				h = t.split("-")[1];
			return u + (h ? "-" + h : "");
		}

		function ot(t, e, n) {
			var i = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null,
				o = i ? tt(e) : B(e, j(n));
			return $(n, o, i);
		}

		function rt(t) {
			var e = t.ownerDocument.defaultView.getComputedStyle(t),
				n = parseFloat(e.marginTop || 0) + parseFloat(e.marginBottom || 0),
				i = parseFloat(e.marginLeft || 0) + parseFloat(e.marginRight || 0);
			return {
				width: t.offsetWidth + i,
				height: t.offsetHeight + n
			};
		}

		function st(t) {
			var e = {
				left: "right",
				right: "left",
				bottom: "top",
				top: "bottom"
			};
			return t.replace(/left|right|bottom|top/g, function (t) {
				return e[t];
			});
		}

		function at(t, e, n) {
			n = n.split("-")[0];
			var i = rt(t),
				o = {
					width: i.width,
					height: i.height
				},
				r = -1 !== ["right", "left"].indexOf(n),
				s = r ? "top" : "left",
				a = r ? "left" : "top",
				l = r ? "height" : "width",
				c = r ? "width" : "height";
			return o[s] = e[s] + e[l] / 2 - i[l] / 2, o[a] = n === a ? e[a] - i[c] : e[st(a)], o;
		}

		function lt(t, e) {
			return Array.prototype.find ? t.find(e) : t.filter(e)[0];
		}

		function ct(t, e, n) {
			return (void 0 === n ? t : t.slice(0, function (t, e, n) {
				if (Array.prototype.findIndex) return t.findIndex(function (t) {
					return t[e] === n;
				});
				var i = lt(t, function (t) {
					return t[e] === n;
				});
				return t.indexOf(i);
			}(t, "name", n))).forEach(function (t) {
				t["function"] && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
				var n = t["function"] || t.fn;
				t.enabled && O(n) && (e.offsets.popper = K(e.offsets.popper), e.offsets.reference = K(e.offsets.reference), e = n(e, t));
			}), e;
		}

		function ut() {
			if (!this.state.isDestroyed) {
				var t = {
					instance: this,
					styles: {},
					arrowStyles: {},
					attributes: {},
					flipped: !1,
					offsets: {}
				};
				t.offsets.reference = ot(this.state, this.popper, this.reference, this.options.positionFixed), t.placement = it(this.options.placement, t.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), t.originalPlacement = t.placement, t.positionFixed = this.options.positionFixed, t.offsets.popper = at(this.popper, t.offsets.reference, t.placement), t.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", t = ct(this.modifiers, t), this.state.isCreated ? this.options.onUpdate(t) : (this.state.isCreated = !0, this.options.onCreate(t));
			}
		}

		function ht(t, e) {
			return t.some(function (t) {
				var n = t.name;
				return t.enabled && n === e;
			});
		}

		function ft(t) {
			for (var e = [!1, "ms", "Webkit", "Moz", "O"], n = t.charAt(0).toUpperCase() + t.slice(1), i = 0; i < e.length; i++) {
				var o = e[i],
					r = o ? "" + o + n : t;
				if ("undefined" != typeof document.body.style[r]) return r;
			}

			return null;
		}

		function dt() {
			return this.state.isDestroyed = !0, ht(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[ft("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this;
		}

		function pt(t) {
			var e = t.ownerDocument;
			return e ? e.defaultView : window;
		}

		function mt(t, e, n, i) {
			n.updateBound = i, pt(t).addEventListener("resize", n.updateBound, {
				passive: !0
			});
			var o = x(t);
			return function t(e, n, i, o) {
				var r = "BODY" === e.nodeName,
					s = r ? e.ownerDocument.defaultView : e;
				s.addEventListener(n, i, {
					passive: !0
				}), r || t(x(s.parentNode), n, i, o), o.push(s);
			}(o, "scroll", n.updateBound, n.scrollParents), n.scrollElement = o, n.eventsEnabled = !0, n;
		}

		function gt() {
			this.state.eventsEnabled || (this.state = mt(this.reference, this.options, this.state, this.scheduleUpdate));
		}

		function vt() {
			var t, e;
			this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (t = this.reference, e = this.state, pt(t).removeEventListener("resize", e.updateBound), e.scrollParents.forEach(function (t) {
				t.removeEventListener("scroll", e.updateBound);
			}), e.updateBound = null, e.scrollParents = [], e.scrollElement = null, e.eventsEnabled = !1, e));
		}

		function _t(t) {
			return "" !== t && !isNaN(parseFloat(t)) && isFinite(t);
		}

		function bt(t, e) {
			Object.keys(e).forEach(function (n) {
				var i = ""; -
				1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(n) && _t(e[n]) && (i = "px"), t.style[n] = e[n] + i;
			});
		}

		var yt = D && /Firefox/i.test(navigator.userAgent);

		function wt(t, e, n) {
			var i = lt(t, function (t) {
					return t.name === e;
				}),
				o = !!i && t.some(function (t) {
					return t.name === n && t.enabled && t.order < i.order;
				});

			if (!o) {
				var r = "`" + e + "`",
					s = "`" + n + "`";
				console.warn(s + " modifier is required by " + r + " modifier in order to work, be sure to include it before " + r + "!");
			}

			return o;
		}

		var Et = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
			Tt = Et.slice(3);

		function Ct(t) {
			var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
				n = Tt.indexOf(t),
				i = Tt.slice(n + 1).concat(Tt.slice(0, n));
			return e ? i.reverse() : i;
		}

		var St = "flip",
			Dt = "clockwise",
			kt = "counterclockwise";

		function Nt(t, e, n, i) {
			var o = [0, 0],
				r = -1 !== ["right", "left"].indexOf(i),
				s = t.split(/(\+|\-)/).map(function (t) {
					return t.trim();
				}),
				a = s.indexOf(lt(s, function (t) {
					return -1 !== t.search(/,|\s/);
				}));
			s[a] && -1 === s[a].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
			var l = /\s*,\s*|\s+/,
				c = -1 !== a ? [s.slice(0, a).concat([s[a].split(l)[0]]), [s[a].split(l)[1]].concat(s.slice(a + 1))] : [s];
			return (c = c.map(function (t, i) {
				var o = (1 === i ? !r : r) ? "height" : "width",
					s = !1;
				return t.reduce(function (t, e) {
					return "" === t[t.length - 1] && -1 !== ["+", "-"].indexOf(e) ? (t[t.length - 1] = e, s = !0, t) : s ? (t[t.length - 1] += e, s = !1, t) : t.concat(e);
				}, []).map(function (t) {
					return function (t, e, n, i) {
						var o = t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
							r = +o[1],
							s = o[2];
						if (!r) return t;

						if (0 === s.indexOf("%")) {
							var a = void 0;

							switch (s) {
								case "%p":
									a = n;
									break;

								case "%":
								case "%r":
								default:
									a = i;
							}

							return K(a)[e] / 100 * r;
						}

						if ("vh" === s || "vw" === s) {
							return ("vh" === s ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * r;
						}

						return r;
					}(t, o, e, n);
				});
			})).forEach(function (t, e) {
				t.forEach(function (n, i) {
					_t(n) && (o[e] += n * ("-" === t[i - 1] ? -1 : 1));
				});
			}), o;
		}

		var Ot = {
				placement: "bottom",
				positionFixed: !1,
				eventsEnabled: !0,
				removeOnDestroy: !1,
				onCreate: function onCreate() {},
				onUpdate: function onUpdate() {},
				modifiers: {
					shift: {
						order: 100,
						enabled: !0,
						fn: function fn(t) {
							var e = t.placement,
								n = e.split("-")[0],
								i = e.split("-")[1];

							if (i) {
								var o = t.offsets,
									r = o.reference,
									s = o.popper,
									a = -1 !== ["bottom", "top"].indexOf(n),
									l = a ? "left" : "top",
									c = a ? "width" : "height",
									u = {
										start: z({}, l, r[l]),
										end: z({}, l, r[l] + r[c] - s[c])
									};
								t.offsets.popper = X({}, s, u[i]);
							}

							return t;
						}
					},
					offset: {
						order: 200,
						enabled: !0,
						fn: function fn(t, e) {
							var n = e.offset,
								i = t.placement,
								o = t.offsets,
								r = o.popper,
								s = o.reference,
								a = i.split("-")[0],
								l = void 0;
							return l = _t(+n) ? [+n, 0] : Nt(n, r, s, a), "left" === a ? (r.top += l[0], r.left -= l[1]) : "right" === a ? (r.top += l[0], r.left += l[1]) : "top" === a ? (r.left += l[0], r.top -= l[1]) : "bottom" === a && (r.left += l[0], r.top += l[1]), t.popper = r, t;
						},
						offset: 0
					},
					preventOverflow: {
						order: 300,
						enabled: !0,
						fn: function fn(t, e) {
							var n = e.boundariesElement || R(t.instance.popper);
							t.instance.reference === n && (n = R(n));
							var i = ft("transform"),
								o = t.instance.popper.style,
								r = o.top,
								s = o.left,
								a = o[i];
							o.top = "", o.left = "", o[i] = "";
							var l = et(t.instance.popper, t.instance.reference, e.padding, n, t.positionFixed);
							o.top = r, o.left = s, o[i] = a, e.boundaries = l;
							var c = e.priority,
								u = t.offsets.popper,
								h = {
									primary: function primary(t) {
										var n = u[t];
										return u[t] < l[t] && !e.escapeWithReference && (n = Math.max(u[t], l[t])), z({}, t, n);
									},
									secondary: function secondary(t) {
										var n = "right" === t ? "left" : "top",
											i = u[n];
										return u[t] > l[t] && !e.escapeWithReference && (i = Math.min(u[n], l[t] - ("right" === t ? u.width : u.height))), z({}, n, i);
									}
								};
							return c.forEach(function (t) {
								var e = -1 !== ["left", "top"].indexOf(t) ? "primary" : "secondary";
								u = X({}, u, h[e](t));
							}), t.offsets.popper = u, t;
						},
						priority: ["left", "right", "top", "bottom"],
						padding: 5,
						boundariesElement: "scrollParent"
					},
					keepTogether: {
						order: 400,
						enabled: !0,
						fn: function fn(t) {
							var e = t.offsets,
								n = e.popper,
								i = e.reference,
								o = t.placement.split("-")[0],
								r = Math.floor,
								s = -1 !== ["top", "bottom"].indexOf(o),
								a = s ? "right" : "bottom",
								l = s ? "left" : "top",
								c = s ? "width" : "height";
							return n[a] < r(i[l]) && (t.offsets.popper[l] = r(i[l]) - n[c]), n[l] > r(i[a]) && (t.offsets.popper[l] = r(i[a])), t;
						}
					},
					arrow: {
						order: 500,
						enabled: !0,
						fn: function fn(t, e) {
							var n;
							if (!wt(t.instance.modifiers, "arrow", "keepTogether")) return t;
							var i = e.element;

							if ("string" == typeof i) {
								if (!(i = t.instance.popper.querySelector(i))) return t;
							} else if (!t.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), t;

							var o = t.placement.split("-")[0],
								r = t.offsets,
								s = r.popper,
								a = r.reference,
								l = -1 !== ["left", "right"].indexOf(o),
								c = l ? "height" : "width",
								u = l ? "Top" : "Left",
								h = u.toLowerCase(),
								f = l ? "left" : "top",
								d = l ? "bottom" : "right",
								p = rt(i)[c];
							a[d] - p < s[h] && (t.offsets.popper[h] -= s[h] - (a[d] - p)), a[h] + p > s[d] && (t.offsets.popper[h] += a[h] + p - s[d]), t.offsets.popper = K(t.offsets.popper);

							var m = a[h] + a[c] / 2 - p / 2,
								g = A(t.instance.popper),
								v = parseFloat(g["margin" + u], 10),
								_ = parseFloat(g["border" + u + "Width"], 10),
								b = m - t.offsets.popper[h] - v - _;

							return b = Math.max(Math.min(s[c] - p, b), 0), t.arrowElement = i, t.offsets.arrow = (z(n = {}, h, Math.round(b)), z(n, f, ""), n), t;
						},
						element: "[x-arrow]"
					},
					flip: {
						order: 600,
						enabled: !0,
						fn: function fn(t, e) {
							if (ht(t.instance.modifiers, "inner")) return t;
							if (t.flipped && t.placement === t.originalPlacement) return t;
							var n = et(t.instance.popper, t.instance.reference, e.padding, e.boundariesElement, t.positionFixed),
								i = t.placement.split("-")[0],
								o = st(i),
								r = t.placement.split("-")[1] || "",
								s = [];

							switch (e.behavior) {
								case St:
									s = [i, o];
									break;

								case Dt:
									s = Ct(i);
									break;

								case kt:
									s = Ct(i, !0);
									break;

								default:
									s = e.behavior;
							}

							return s.forEach(function (a, l) {
								if (i !== a || s.length === l + 1) return t;
								i = t.placement.split("-")[0], o = st(i);

								var c = t.offsets.popper,
									u = t.offsets.reference,
									h = Math.floor,
									f = "left" === i && h(c.right) > h(u.left) || "right" === i && h(c.left) < h(u.right) || "top" === i && h(c.bottom) > h(u.top) || "bottom" === i && h(c.top) < h(u.bottom),
									d = h(c.left) < h(n.left),
									p = h(c.right) > h(n.right),
									m = h(c.top) < h(n.top),
									g = h(c.bottom) > h(n.bottom),
									v = "left" === i && d || "right" === i && p || "top" === i && m || "bottom" === i && g,
									_ = -1 !== ["top", "bottom"].indexOf(i),
									b = !!e.flipVariations && (_ && "start" === r && d || _ && "end" === r && p || !_ && "start" === r && m || !_ && "end" === r && g),
									y = !!e.flipVariationsByContent && (_ && "start" === r && p || _ && "end" === r && d || !_ && "start" === r && g || !_ && "end" === r && m),
									w = b || y;

								(f || v || w) && (t.flipped = !0, (f || v) && (i = s[l + 1]), w && (r = function (t) {
									return "end" === t ? "start" : "start" === t ? "end" : t;
								}(r)), t.placement = i + (r ? "-" + r : ""), t.offsets.popper = X({}, t.offsets.popper, at(t.instance.popper, t.offsets.reference, t.placement)), t = ct(t.instance.modifiers, t, "flip"));
							}), t;
						},
						behavior: "flip",
						padding: 5,
						boundariesElement: "viewport",
						flipVariations: !1,
						flipVariationsByContent: !1
					},
					inner: {
						order: 700,
						enabled: !1,
						fn: function fn(t) {
							var e = t.placement,
								n = e.split("-")[0],
								i = t.offsets,
								o = i.popper,
								r = i.reference,
								s = -1 !== ["left", "right"].indexOf(n),
								a = -1 === ["top", "left"].indexOf(n);
							return o[s ? "left" : "top"] = r[n] - (a ? o[s ? "width" : "height"] : 0), t.placement = st(e), t.offsets.popper = K(o), t;
						}
					},
					hide: {
						order: 800,
						enabled: !0,
						fn: function fn(t) {
							if (!wt(t.instance.modifiers, "hide", "preventOverflow")) return t;
							var e = t.offsets.reference,
								n = lt(t.instance.modifiers, function (t) {
									return "preventOverflow" === t.name;
								}).boundaries;

							if (e.bottom < n.top || e.left > n.right || e.top > n.bottom || e.right < n.left) {
								if (!0 === t.hide) return t;
								t.hide = !0, t.attributes["x-out-of-boundaries"] = "";
							} else {
								if (!1 === t.hide) return t;
								t.hide = !1, t.attributes["x-out-of-boundaries"] = !1;
							}

							return t;
						}
					},
					computeStyle: {
						order: 850,
						enabled: !0,
						fn: function fn(t, e) {
							var n = e.x,
								i = e.y,
								o = t.offsets.popper,
								r = lt(t.instance.modifiers, function (t) {
									return "applyStyle" === t.name;
								}).gpuAcceleration;
							void 0 !== r && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");

							var s = void 0 !== r ? r : e.gpuAcceleration,
								a = R(t.instance.popper),
								l = G(a),
								c = {
									position: o.position
								},
								u = function (t, e) {
									var n = t.offsets,
										i = n.popper,
										o = n.reference,
										r = Math.round,
										s = Math.floor,
										a = function a(t) {
											return t;
										},
										l = r(o.width),
										c = r(i.width),
										u = -1 !== ["left", "right"].indexOf(t.placement),
										h = -1 !== t.placement.indexOf("-"),
										f = e ? u || h || l % 2 == c % 2 ? r : s : a,
										d = e ? r : a;

									return {
										left: f(l % 2 == 1 && c % 2 == 1 && !h && e ? i.left - 1 : i.left),
										top: d(i.top),
										bottom: d(i.bottom),
										right: f(i.right)
									};
								}(t, window.devicePixelRatio < 2 || !yt),
								h = "bottom" === n ? "top" : "bottom",
								f = "right" === i ? "left" : "right",
								d = ft("transform"),
								p = void 0,
								m = void 0;

							if (m = "bottom" === h ? "HTML" === a.nodeName ? -a.clientHeight + u.bottom : -l.height + u.bottom : u.top, p = "right" === f ? "HTML" === a.nodeName ? -a.clientWidth + u.right : -l.width + u.right : u.left, s && d) c[d] = "translate3d(" + p + "px, " + m + "px, 0)", c[h] = 0, c[f] = 0, c.willChange = "transform";
							else {
								var g = "bottom" === h ? -1 : 1,
									v = "right" === f ? -1 : 1;
								c[h] = m * g, c[f] = p * v, c.willChange = h + ", " + f;
							}
							var _ = {
								"x-placement": t.placement
							};
							return t.attributes = X({}, _, t.attributes), t.styles = X({}, c, t.styles), t.arrowStyles = X({}, t.offsets.arrow, t.arrowStyles), t;
						},
						gpuAcceleration: !0,
						x: "bottom",
						y: "right"
					},
					applyStyle: {
						order: 900,
						enabled: !0,
						fn: function fn(t) {
							var e, n;
							return bt(t.instance.popper, t.styles), e = t.instance.popper, n = t.attributes, Object.keys(n).forEach(function (t) {
								!1 !== n[t] ? e.setAttribute(t, n[t]) : e.removeAttribute(t);
							}), t.arrowElement && Object.keys(t.arrowStyles).length && bt(t.arrowElement, t.arrowStyles), t;
						},
						onLoad: function onLoad(t, e, n, i, o) {
							var r = ot(o, e, t, n.positionFixed),
								s = it(n.placement, r, e, t, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
							return e.setAttribute("x-placement", s), bt(e, {
								position: n.positionFixed ? "fixed" : "absolute"
							}), n;
						},
						gpuAcceleration: void 0
					}
				}
			},
			At = function () {
				function t(e, n) {
					var i = this,
						o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
					V(this, t), this.scheduleUpdate = function () {
						return requestAnimationFrame(i.update);
					}, this.update = N(this.update.bind(this)), this.options = X({}, t.Defaults, o), this.state = {
						isDestroyed: !1,
						isCreated: !1,
						scrollParents: []
					}, this.reference = e && e.jquery ? e[0] : e, this.popper = n && n.jquery ? n[0] : n, this.options.modifiers = {}, Object.keys(X({}, t.Defaults.modifiers, o.modifiers)).forEach(function (e) {
						i.options.modifiers[e] = X({}, t.Defaults.modifiers[e] || {}, o.modifiers ? o.modifiers[e] : {});
					}), this.modifiers = Object.keys(this.options.modifiers).map(function (t) {
						return X({
							name: t
						}, i.options.modifiers[t]);
					}).sort(function (t, e) {
						return t.order - e.order;
					}), this.modifiers.forEach(function (t) {
						t.enabled && O(t.onLoad) && t.onLoad(i.reference, i.popper, i.options, t, i.state);
					}), this.update();
					var r = this.options.eventsEnabled;
					r && this.enableEventListeners(), this.state.eventsEnabled = r;
				}

				return Y(t, [{
					key: "update",
					value: function value() {
						return ut.call(this);
					}
				}, {
					key: "destroy",
					value: function value() {
						return dt.call(this);
					}
				}, {
					key: "enableEventListeners",
					value: function value() {
						return gt.call(this);
					}
				}, {
					key: "disableEventListeners",
					value: function value() {
						return vt.call(this);
					}
				}]), t;
			}();

		At.Utils = ("undefined" != typeof window ? window : global).PopperUtils, At.placements = Et, At.Defaults = Ot;

		var It = "dropdown",
			xt = e.fn[It],
			jt = new RegExp("38|40|27"),
			Lt = {
				offset: 0,
				flip: !0,
				boundary: "scrollParent",
				reference: "toggle",
				display: "dynamic",
				popperConfig: null
			},
			Pt = {
				offset: "(number|string|function)",
				flip: "boolean",
				boundary: "(string|element)",
				reference: "(string|element)",
				display: "string",
				popperConfig: "(null|object)"
			},
			Ft = function () {
				function t(t, e) {
					this._element = t, this._popper = null, this._config = this._getConfig(e), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners();
				}

				var n = t.prototype;
				return n.toggle = function () {
					if (!this._element.disabled && !e(this._element).hasClass("disabled")) {
						var n = e(this._menu).hasClass("show");
						t._clearMenus(), n || this.show(!0);
					}
				}, n.show = function (n) {
					if (void 0 === n && (n = !1), !(this._element.disabled || e(this._element).hasClass("disabled") || e(this._menu).hasClass("show"))) {
						var i = {
								relatedTarget: this._element
							},
							o = e.Event("show.bs.dropdown", i),
							r = t._getParentFromElement(this._element);

						if (e(r).trigger(o), !o.isDefaultPrevented()) {
							if (!this._inNavbar && n) {
								if ("undefined" == typeof At) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
								var s = this._element;
								"parent" === this._config.reference ? s = r : l.isElement(this._config.reference) && (s = this._config.reference, "undefined" != typeof this._config.reference.jquery && (s = this._config.reference[0])), "scrollParent" !== this._config.boundary && e(r).addClass("position-static"), this._popper = new At(s, this._menu, this._getPopperConfig());
							}

							"ontouchstart" in document.documentElement && 0 === e(r).closest(".navbar-nav").length && e(document.body).children().on("mouseover", null, e.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), e(this._menu).toggleClass("show"), e(r).toggleClass("show").trigger(e.Event("shown.bs.dropdown", i));
						}
					}
				}, n.hide = function () {
					if (!this._element.disabled && !e(this._element).hasClass("disabled") && e(this._menu).hasClass("show")) {
						var n = {
								relatedTarget: this._element
							},
							i = e.Event("hide.bs.dropdown", n),
							o = t._getParentFromElement(this._element);

						e(o).trigger(i), i.isDefaultPrevented() || (this._popper && this._popper.destroy(), e(this._menu).toggleClass("show"), e(o).toggleClass("show").trigger(e.Event("hidden.bs.dropdown", n)));
					}
				}, n.dispose = function () {
					e.removeData(this._element, "bs.dropdown"), e(this._element).off(".bs.dropdown"), this._element = null, this._menu = null, null !== this._popper && (this._popper.destroy(), this._popper = null);
				}, n.update = function () {
					this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate();
				}, n._addEventListeners = function () {
					var t = this;
					e(this._element).on("click.bs.dropdown", function (e) {
						e.preventDefault(), e.stopPropagation(), t.toggle();
					});
				}, n._getConfig = function (t) {
					return t = s(s(s({}, this.constructor.Default), e(this._element).data()), t), l.typeCheckConfig(It, t, this.constructor.DefaultType), t;
				}, n._getMenuElement = function () {
					if (!this._menu) {
						var e = t._getParentFromElement(this._element);

						e && (this._menu = e.querySelector(".dropdown-menu"));
					}

					return this._menu;
				}, n._getPlacement = function () {
					var t = e(this._element.parentNode),
						n = "bottom-start";
					return t.hasClass("dropup") ? n = e(this._menu).hasClass("dropdown-menu-right") ? "top-end" : "top-start" : t.hasClass("dropright") ? n = "right-start" : t.hasClass("dropleft") ? n = "left-start" : e(this._menu).hasClass("dropdown-menu-right") && (n = "bottom-end"), n;
				}, n._detectNavbar = function () {
					return e(this._element).closest(".navbar").length > 0;
				}, n._getOffset = function () {
					var t = this,
						e = {};
					return "function" == typeof this._config.offset ? e.fn = function (e) {
						return e.offsets = s(s({}, e.offsets), t._config.offset(e.offsets, t._element) || {}), e;
					} : e.offset = this._config.offset, e;
				}, n._getPopperConfig = function () {
					var t = {
						placement: this._getPlacement(),
						modifiers: {
							offset: this._getOffset(),
							flip: {
								enabled: this._config.flip
							},
							preventOverflow: {
								boundariesElement: this._config.boundary
							}
						}
					};
					return "static" === this._config.display && (t.modifiers.applyStyle = {
						enabled: !1
					}), s(s({}, t), this._config.popperConfig);
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this).data("bs.dropdown");

						if (i || (i = new t(this, "object" == _typeof(n) ? n : null), e(this).data("bs.dropdown", i)), "string" == typeof n) {
							if ("undefined" == typeof i[n]) throw new TypeError('No method named "' + n + '"');
							i[n]();
						}
					});
				}, t._clearMenus = function (n) {
					if (!n || 3 !== n.which && ("keyup" !== n.type || 9 === n.which))
						for (var i = [].slice.call(document.querySelectorAll('[data-toggle="dropdown"]')), o = 0, r = i.length; o < r; o++) {
							var s = t._getParentFromElement(i[o]),
								a = e(i[o]).data("bs.dropdown"),
								l = {
									relatedTarget: i[o]
								};

							if (n && "click" === n.type && (l.clickEvent = n), a) {
								var c = a._menu;

								if (e(s).hasClass("show") && !(n && ("click" === n.type && /input|textarea/i.test(n.target.tagName) || "keyup" === n.type && 9 === n.which) && e.contains(s, n.target))) {
									var u = e.Event("hide.bs.dropdown", l);
									e(s).trigger(u), u.isDefaultPrevented() || ("ontouchstart" in document.documentElement && e(document.body).children().off("mouseover", null, e.noop), i[o].setAttribute("aria-expanded", "false"), a._popper && a._popper.destroy(), e(c).removeClass("show"), e(s).removeClass("show").trigger(e.Event("hidden.bs.dropdown", l)));
								}
							}
						}
				}, t._getParentFromElement = function (t) {
					var e,
						n = l.getSelectorFromElement(t);
					return n && (e = document.querySelector(n)), e || t.parentNode;
				}, t._dataApiKeydownHandler = function (n) {
					if (!(/input|textarea/i.test(n.target.tagName) ? 32 === n.which || 27 !== n.which && (40 !== n.which && 38 !== n.which || e(n.target).closest(".dropdown-menu").length) : !jt.test(n.which)) && !this.disabled && !e(this).hasClass("disabled")) {
						var i = t._getParentFromElement(this),
							o = e(i).hasClass("show");

						if (o || 27 !== n.which) {
							if (n.preventDefault(), n.stopPropagation(), !o || o && (27 === n.which || 32 === n.which)) return 27 === n.which && e(i.querySelector('[data-toggle="dropdown"]')).trigger("focus"), void e(this).trigger("click");
							var r = [].slice.call(i.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)")).filter(function (t) {
								return e(t).is(":visible");
							});

							if (0 !== r.length) {
								var s = r.indexOf(n.target);
								38 === n.which && s > 0 && s--, 40 === n.which && s < r.length - 1 && s++, s < 0 && (s = 0), r[s].focus();
							}
						}
					}
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return Lt;
					}
				}, {
					key: "DefaultType",
					get: function get() {
						return Pt;
					}
				}]), t;
			}();

		e(document).on("keydown.bs.dropdown.data-api", '[data-toggle="dropdown"]', Ft._dataApiKeydownHandler).on("keydown.bs.dropdown.data-api", ".dropdown-menu", Ft._dataApiKeydownHandler).on("click.bs.dropdown.data-api keyup.bs.dropdown.data-api", Ft._clearMenus).on("click.bs.dropdown.data-api", '[data-toggle="dropdown"]', function (t) {
			t.preventDefault(), t.stopPropagation(), Ft._jQueryInterface.call(e(this), "toggle");
		}).on("click.bs.dropdown.data-api", ".dropdown form", function (t) {
			t.stopPropagation();
		}), e.fn[It] = Ft._jQueryInterface, e.fn[It].Constructor = Ft, e.fn[It].noConflict = function () {
			return e.fn[It] = xt, Ft._jQueryInterface;
		};

		var Rt = e.fn.modal,
			Mt = {
				backdrop: !0,
				keyboard: !0,
				focus: !0,
				show: !0
			},
			Bt = {
				backdrop: "(boolean|string)",
				keyboard: "boolean",
				focus: "boolean",
				show: "boolean"
			},
			qt = function () {
				function t(t, e) {
					this._config = this._getConfig(e), this._element = t, this._dialog = t.querySelector(".modal-dialog"), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0;
				}

				var n = t.prototype;
				return n.toggle = function (t) {
					return this._isShown ? this.hide() : this.show(t);
				}, n.show = function (t) {
					var n = this;

					if (!this._isShown && !this._isTransitioning) {
						e(this._element).hasClass("fade") && (this._isTransitioning = !0);
						var i = e.Event("show.bs.modal", {
							relatedTarget: t
						});
						e(this._element).trigger(i), this._isShown || i.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), e(this._element).on("click.dismiss.bs.modal", '[data-dismiss="modal"]', function (t) {
							return n.hide(t);
						}), e(this._dialog).on("mousedown.dismiss.bs.modal", function () {
							e(n._element).one("mouseup.dismiss.bs.modal", function (t) {
								e(t.target).is(n._element) && (n._ignoreBackdropClick = !0);
							});
						}), this._showBackdrop(function () {
							return n._showElement(t);
						}));
					}
				}, n.hide = function (t) {
					var n = this;

					if (t && t.preventDefault(), this._isShown && !this._isTransitioning) {
						var i = e.Event("hide.bs.modal");

						if (e(this._element).trigger(i), this._isShown && !i.isDefaultPrevented()) {
							this._isShown = !1;
							var o = e(this._element).hasClass("fade");

							if (o && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), e(document).off("focusin.bs.modal"), e(this._element).removeClass("show"), e(this._element).off("click.dismiss.bs.modal"), e(this._dialog).off("mousedown.dismiss.bs.modal"), o) {
								var r = l.getTransitionDurationFromElement(this._element);
								e(this._element).one(l.TRANSITION_END, function (t) {
									return n._hideModal(t);
								}).emulateTransitionEnd(r);
							} else this._hideModal();
						}
					}
				}, n.dispose = function () {
					[window, this._element, this._dialog].forEach(function (t) {
						return e(t).off(".bs.modal");
					}), e(document).off("focusin.bs.modal"), e.removeData(this._element, "bs.modal"), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null;
				}, n.handleUpdate = function () {
					this._adjustDialog();
				}, n._getConfig = function (t) {
					return t = s(s({}, Mt), t), l.typeCheckConfig("modal", t, Bt), t;
				}, n._triggerBackdropTransition = function () {
					var t = this;

					if ("static" === this._config.backdrop) {
						var n = e.Event("hidePrevented.bs.modal");
						if (e(this._element).trigger(n), n.defaultPrevented) return;

						this._element.classList.add("modal-static");

						var i = l.getTransitionDurationFromElement(this._element);
						e(this._element).one(l.TRANSITION_END, function () {
							t._element.classList.remove("modal-static");
						}).emulateTransitionEnd(i), this._element.focus();
					} else this.hide();
				}, n._showElement = function (t) {
					var n = this,
						i = e(this._element).hasClass("fade"),
						o = this._dialog ? this._dialog.querySelector(".modal-body") : null;
					this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), e(this._dialog).hasClass("modal-dialog-scrollable") && o ? o.scrollTop = 0 : this._element.scrollTop = 0, i && l.reflow(this._element), e(this._element).addClass("show"), this._config.focus && this._enforceFocus();

					var r = e.Event("shown.bs.modal", {
							relatedTarget: t
						}),
						s = function s() {
							n._config.focus && n._element.focus(), n._isTransitioning = !1, e(n._element).trigger(r);
						};

					if (i) {
						var a = l.getTransitionDurationFromElement(this._dialog);
						e(this._dialog).one(l.TRANSITION_END, s).emulateTransitionEnd(a);
					} else s();
				}, n._enforceFocus = function () {
					var t = this;
					e(document).off("focusin.bs.modal").on("focusin.bs.modal", function (n) {
						document !== n.target && t._element !== n.target && 0 === e(t._element).has(n.target).length && t._element.focus();
					});
				}, n._setEscapeEvent = function () {
					var t = this;
					this._isShown ? e(this._element).on("keydown.dismiss.bs.modal", function (e) {
						t._config.keyboard && 27 === e.which ? (e.preventDefault(), t.hide()) : t._config.keyboard || 27 !== e.which || t._triggerBackdropTransition();
					}) : this._isShown || e(this._element).off("keydown.dismiss.bs.modal");
				}, n._setResizeEvent = function () {
					var t = this;
					this._isShown ? e(window).on("resize.bs.modal", function (e) {
						return t.handleUpdate(e);
					}) : e(window).off("resize.bs.modal");
				}, n._hideModal = function () {
					var t = this;
					this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._isTransitioning = !1, this._showBackdrop(function () {
						e(document.body).removeClass("modal-open"), t._resetAdjustments(), t._resetScrollbar(), e(t._element).trigger("hidden.bs.modal");
					});
				}, n._removeBackdrop = function () {
					this._backdrop && (e(this._backdrop).remove(), this._backdrop = null);
				}, n._showBackdrop = function (t) {
					var n = this,
						i = e(this._element).hasClass("fade") ? "fade" : "";

					if (this._isShown && this._config.backdrop) {
						if (this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", i && this._backdrop.classList.add(i), e(this._backdrop).appendTo(document.body), e(this._element).on("click.dismiss.bs.modal", function (t) {
								n._ignoreBackdropClick ? n._ignoreBackdropClick = !1 : t.target === t.currentTarget && n._triggerBackdropTransition();
							}), i && l.reflow(this._backdrop), e(this._backdrop).addClass("show"), !t) return;
						if (!i) return void t();
						var o = l.getTransitionDurationFromElement(this._backdrop);
						e(this._backdrop).one(l.TRANSITION_END, t).emulateTransitionEnd(o);
					} else if (!this._isShown && this._backdrop) {
						e(this._backdrop).removeClass("show");

						var r = function r() {
							n._removeBackdrop(), t && t();
						};

						if (e(this._element).hasClass("fade")) {
							var s = l.getTransitionDurationFromElement(this._backdrop);
							e(this._backdrop).one(l.TRANSITION_END, r).emulateTransitionEnd(s);
						} else r();
					} else t && t();
				}, n._adjustDialog = function () {
					var t = this._element.scrollHeight > document.documentElement.clientHeight;
					!this._isBodyOverflowing && t && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !t && (this._element.style.paddingRight = this._scrollbarWidth + "px");
				}, n._resetAdjustments = function () {
					this._element.style.paddingLeft = "", this._element.style.paddingRight = "";
				}, n._checkScrollbar = function () {
					var t = document.body.getBoundingClientRect();
					this._isBodyOverflowing = Math.round(t.left + t.right) < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth();
				}, n._setScrollbar = function () {
					var t = this;

					if (this._isBodyOverflowing) {
						var n = [].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top")),
							i = [].slice.call(document.querySelectorAll(".sticky-top"));
						e(n).each(function (n, i) {
							var o = i.style.paddingRight,
								r = e(i).css("padding-right");
							e(i).data("padding-right", o).css("padding-right", parseFloat(r) + t._scrollbarWidth + "px");
						}), e(i).each(function (n, i) {
							var o = i.style.marginRight,
								r = e(i).css("margin-right");
							e(i).data("margin-right", o).css("margin-right", parseFloat(r) - t._scrollbarWidth + "px");
						});
						var o = document.body.style.paddingRight,
							r = e(document.body).css("padding-right");
						e(document.body).data("padding-right", o).css("padding-right", parseFloat(r) + this._scrollbarWidth + "px");
					}

					e(document.body).addClass("modal-open");
				}, n._resetScrollbar = function () {
					var t = [].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top"));
					e(t).each(function (t, n) {
						var i = e(n).data("padding-right");
						e(n).removeData("padding-right"), n.style.paddingRight = i || "";
					});
					var n = [].slice.call(document.querySelectorAll(".sticky-top"));
					e(n).each(function (t, n) {
						var i = e(n).data("margin-right");
						"undefined" != typeof i && e(n).css("margin-right", i).removeData("margin-right");
					});
					var i = e(document.body).data("padding-right");
					e(document.body).removeData("padding-right"), document.body.style.paddingRight = i || "";
				}, n._getScrollbarWidth = function () {
					var t = document.createElement("div");
					t.className = "modal-scrollbar-measure", document.body.appendChild(t);
					var e = t.getBoundingClientRect().width - t.clientWidth;
					return document.body.removeChild(t), e;
				}, t._jQueryInterface = function (n, i) {
					return this.each(function () {
						var o = e(this).data("bs.modal"),
							r = s(s(s({}, Mt), e(this).data()), "object" == _typeof(n) && n ? n : {});

						if (o || (o = new t(this, r), e(this).data("bs.modal", o)), "string" == typeof n) {
							if ("undefined" == typeof o[n]) throw new TypeError('No method named "' + n + '"');
							o[n](i);
						} else r.show && o.show(i);
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return Mt;
					}
				}]), t;
			}();

		e(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (t) {
			var n,
				i = this,
				o = l.getSelectorFromElement(this);
			o && (n = document.querySelector(o));
			var r = e(n).data("bs.modal") ? "toggle" : s(s({}, e(n).data()), e(this).data());
			"A" !== this.tagName && "AREA" !== this.tagName || t.preventDefault();
			var a = e(n).one("show.bs.modal", function (t) {
				t.isDefaultPrevented() || a.one("hidden.bs.modal", function () {
					e(i).is(":visible") && i.focus();
				});
			});

			qt._jQueryInterface.call(e(n), r, this);
		}), e.fn.modal = qt._jQueryInterface, e.fn.modal.Constructor = qt, e.fn.modal.noConflict = function () {
			return e.fn.modal = Rt, qt._jQueryInterface;
		};
		var Ht = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"],
			Qt = {
				"*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
				a: ["target", "href", "title", "rel"],
				area: [],
				b: [],
				br: [],
				col: [],
				code: [],
				div: [],
				em: [],
				hr: [],
				h1: [],
				h2: [],
				h3: [],
				h4: [],
				h5: [],
				h6: [],
				i: [],
				img: ["src", "srcset", "alt", "title", "width", "height"],
				li: [],
				ol: [],
				p: [],
				pre: [],
				s: [],
				small: [],
				span: [],
				sub: [],
				sup: [],
				strong: [],
				u: [],
				ul: []
			},
			Wt = /^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/gi,
			Ut = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;

		function Vt(t, e, n) {
			if (0 === t.length) return t;
			if (n && "function" == typeof n) return n(t);

			for (var i = new window.DOMParser().parseFromString(t, "text/html"), o = Object.keys(e), r = [].slice.call(i.body.querySelectorAll("*")), s = function s(t, n) {
					var i = r[t],
						s = i.nodeName.toLowerCase();
					if (-1 === o.indexOf(i.nodeName.toLowerCase())) return i.parentNode.removeChild(i), "continue";
					var a = [].slice.call(i.attributes),
						l = [].concat(e["*"] || [], e[s] || []);
					a.forEach(function (t) {
						(function (t, e) {
							var n = t.nodeName.toLowerCase();
							if (-1 !== e.indexOf(n)) return -1 === Ht.indexOf(n) || Boolean(t.nodeValue.match(Wt) || t.nodeValue.match(Ut));

							for (var i = e.filter(function (t) {
									return t instanceof RegExp;
								}), o = 0, r = i.length; o < r; o++) {
								if (n.match(i[o])) return !0;
							}

							return !1;
						})(t, l) || i.removeAttribute(t.nodeName);
					});
				}, a = 0, l = r.length; a < l; a++) {
				s(a);
			}

			return i.body.innerHTML;
		}

		var Yt = "tooltip",
			zt = e.fn[Yt],
			Xt = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
			Kt = ["sanitize", "whiteList", "sanitizeFn"],
			Gt = {
				animation: "boolean",
				template: "string",
				title: "(string|element|function)",
				trigger: "string",
				delay: "(number|object)",
				html: "boolean",
				selector: "(string|boolean)",
				placement: "(string|function)",
				offset: "(number|string|function)",
				container: "(string|element|boolean)",
				fallbackPlacement: "(string|array)",
				boundary: "(string|element)",
				sanitize: "boolean",
				sanitizeFn: "(null|function)",
				whiteList: "object",
				popperConfig: "(null|object)"
			},
			$t = {
				AUTO: "auto",
				TOP: "top",
				RIGHT: "right",
				BOTTOM: "bottom",
				LEFT: "left"
			},
			Jt = {
				animation: !0,
				template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
				trigger: "hover focus",
				title: "",
				delay: 0,
				html: !1,
				selector: !1,
				placement: "top",
				offset: 0,
				container: !1,
				fallbackPlacement: "flip",
				boundary: "scrollParent",
				sanitize: !0,
				sanitizeFn: null,
				whiteList: Qt,
				popperConfig: null
			},
			Zt = {
				HIDE: "hide.bs.tooltip",
				HIDDEN: "hidden.bs.tooltip",
				SHOW: "show.bs.tooltip",
				SHOWN: "shown.bs.tooltip",
				INSERTED: "inserted.bs.tooltip",
				CLICK: "click.bs.tooltip",
				FOCUSIN: "focusin.bs.tooltip",
				FOCUSOUT: "focusout.bs.tooltip",
				MOUSEENTER: "mouseenter.bs.tooltip",
				MOUSELEAVE: "mouseleave.bs.tooltip"
			},
			te = function () {
				function t(t, e) {
					if ("undefined" == typeof At) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
					this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = t, this.config = this._getConfig(e), this.tip = null, this._setListeners();
				}

				var n = t.prototype;
				return n.enable = function () {
					this._isEnabled = !0;
				}, n.disable = function () {
					this._isEnabled = !1;
				}, n.toggleEnabled = function () {
					this._isEnabled = !this._isEnabled;
				}, n.toggle = function (t) {
					if (this._isEnabled)
						if (t) {
							var n = this.constructor.DATA_KEY,
								i = e(t.currentTarget).data(n);
							i || (i = new this.constructor(t.currentTarget, this._getDelegateConfig()), e(t.currentTarget).data(n, i)), i._activeTrigger.click = !i._activeTrigger.click, i._isWithActiveTrigger() ? i._enter(null, i) : i._leave(null, i);
						} else {
							if (e(this.getTipElement()).hasClass("show")) return void this._leave(null, this);

							this._enter(null, this);
						}
				}, n.dispose = function () {
					clearTimeout(this._timeout), e.removeData(this.element, this.constructor.DATA_KEY), e(this.element).off(this.constructor.EVENT_KEY), e(this.element).closest(".modal").off("hide.bs.modal", this._hideModalHandler), this.tip && e(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null;
				}, n.show = function () {
					var t = this;
					if ("none" === e(this.element).css("display")) throw new Error("Please use show on visible elements");
					var n = e.Event(this.constructor.Event.SHOW);

					if (this.isWithContent() && this._isEnabled) {
						e(this.element).trigger(n);
						var i = l.findShadowRoot(this.element),
							o = e.contains(null !== i ? i : this.element.ownerDocument.documentElement, this.element);
						if (n.isDefaultPrevented() || !o) return;
						var r = this.getTipElement(),
							s = l.getUID(this.constructor.NAME);
						r.setAttribute("id", s), this.element.setAttribute("aria-describedby", s), this.setContent(), this.config.animation && e(r).addClass("fade");

						var a = "function" == typeof this.config.placement ? this.config.placement.call(this, r, this.element) : this.config.placement,
							c = this._getAttachment(a);

						this.addAttachmentClass(c);

						var u = this._getContainer();

						e(r).data(this.constructor.DATA_KEY, this), e.contains(this.element.ownerDocument.documentElement, this.tip) || e(r).appendTo(u), e(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new At(this.element, r, this._getPopperConfig(c)), e(r).addClass("show"), "ontouchstart" in document.documentElement && e(document.body).children().on("mouseover", null, e.noop);

						var h = function h() {
							t.config.animation && t._fixTransition();
							var n = t._hoverState;
							t._hoverState = null, e(t.element).trigger(t.constructor.Event.SHOWN), "out" === n && t._leave(null, t);
						};

						if (e(this.tip).hasClass("fade")) {
							var f = l.getTransitionDurationFromElement(this.tip);
							e(this.tip).one(l.TRANSITION_END, h).emulateTransitionEnd(f);
						} else h();
					}
				}, n.hide = function (t) {
					var n = this,
						i = this.getTipElement(),
						o = e.Event(this.constructor.Event.HIDE),
						r = function r() {
							"show" !== n._hoverState && i.parentNode && i.parentNode.removeChild(i), n._cleanTipClass(), n.element.removeAttribute("aria-describedby"), e(n.element).trigger(n.constructor.Event.HIDDEN), null !== n._popper && n._popper.destroy(), t && t();
						};

					if (e(this.element).trigger(o), !o.isDefaultPrevented()) {
						if (e(i).removeClass("show"), "ontouchstart" in document.documentElement && e(document.body).children().off("mouseover", null, e.noop), this._activeTrigger.click = !1, this._activeTrigger.focus = !1, this._activeTrigger.hover = !1, e(this.tip).hasClass("fade")) {
							var s = l.getTransitionDurationFromElement(i);
							e(i).one(l.TRANSITION_END, r).emulateTransitionEnd(s);
						} else r();

						this._hoverState = "";
					}
				}, n.update = function () {
					null !== this._popper && this._popper.scheduleUpdate();
				}, n.isWithContent = function () {
					return Boolean(this.getTitle());
				}, n.addAttachmentClass = function (t) {
					e(this.getTipElement()).addClass("bs-tooltip-" + t);
				}, n.getTipElement = function () {
					return this.tip = this.tip || e(this.config.template)[0], this.tip;
				}, n.setContent = function () {
					var t = this.getTipElement();
					this.setElementContent(e(t.querySelectorAll(".tooltip-inner")), this.getTitle()), e(t).removeClass("fade show");
				}, n.setElementContent = function (t, n) {
					"object" != _typeof(n) || !n.nodeType && !n.jquery ? this.config.html ? (this.config.sanitize && (n = Vt(n, this.config.whiteList, this.config.sanitizeFn)), t.html(n)) : t.text(n) : this.config.html ? e(n).parent().is(t) || t.empty().append(n) : t.text(e(n).text());
				}, n.getTitle = function () {
					var t = this.element.getAttribute("data-original-title");
					return t || (t = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), t;
				}, n._getPopperConfig = function (t) {
					var e = this;
					return s(s({}, {
						placement: t,
						modifiers: {
							offset: this._getOffset(),
							flip: {
								behavior: this.config.fallbackPlacement
							},
							arrow: {
								element: ".arrow"
							},
							preventOverflow: {
								boundariesElement: this.config.boundary
							}
						},
						onCreate: function onCreate(t) {
							t.originalPlacement !== t.placement && e._handlePopperPlacementChange(t);
						},
						onUpdate: function onUpdate(t) {
							return e._handlePopperPlacementChange(t);
						}
					}), this.config.popperConfig);
				}, n._getOffset = function () {
					var t = this,
						e = {};
					return "function" == typeof this.config.offset ? e.fn = function (e) {
						return e.offsets = s(s({}, e.offsets), t.config.offset(e.offsets, t.element) || {}), e;
					} : e.offset = this.config.offset, e;
				}, n._getContainer = function () {
					return !1 === this.config.container ? document.body : l.isElement(this.config.container) ? e(this.config.container) : e(document).find(this.config.container);
				}, n._getAttachment = function (t) {
					return $t[t.toUpperCase()];
				}, n._setListeners = function () {
					var t = this;
					this.config.trigger.split(" ").forEach(function (n) {
						if ("click" === n) e(t.element).on(t.constructor.Event.CLICK, t.config.selector, function (e) {
							return t.toggle(e);
						});
						else if ("manual" !== n) {
							var i = "hover" === n ? t.constructor.Event.MOUSEENTER : t.constructor.Event.FOCUSIN,
								o = "hover" === n ? t.constructor.Event.MOUSELEAVE : t.constructor.Event.FOCUSOUT;
							e(t.element).on(i, t.config.selector, function (e) {
								return t._enter(e);
							}).on(o, t.config.selector, function (e) {
								return t._leave(e);
							});
						}
					}), this._hideModalHandler = function () {
						t.element && t.hide();
					}, e(this.element).closest(".modal").on("hide.bs.modal", this._hideModalHandler), this.config.selector ? this.config = s(s({}, this.config), {}, {
						trigger: "manual",
						selector: ""
					}) : this._fixTitle();
				}, n._fixTitle = function () {
					var t = _typeof(this.element.getAttribute("data-original-title"));

					(this.element.getAttribute("title") || "string" !== t) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""));
				}, n._enter = function (t, n) {
					var i = this.constructor.DATA_KEY;
					(n = n || e(t.currentTarget).data(i)) || (n = new this.constructor(t.currentTarget, this._getDelegateConfig()), e(t.currentTarget).data(i, n)), t && (n._activeTrigger["focusin" === t.type ? "focus" : "hover"] = !0), e(n.getTipElement()).hasClass("show") || "show" === n._hoverState ? n._hoverState = "show" : (clearTimeout(n._timeout), n._hoverState = "show", n.config.delay && n.config.delay.show ? n._timeout = setTimeout(function () {
						"show" === n._hoverState && n.show();
					}, n.config.delay.show) : n.show());
				}, n._leave = function (t, n) {
					var i = this.constructor.DATA_KEY;
					(n = n || e(t.currentTarget).data(i)) || (n = new this.constructor(t.currentTarget, this._getDelegateConfig()), e(t.currentTarget).data(i, n)), t && (n._activeTrigger["focusout" === t.type ? "focus" : "hover"] = !1), n._isWithActiveTrigger() || (clearTimeout(n._timeout), n._hoverState = "out", n.config.delay && n.config.delay.hide ? n._timeout = setTimeout(function () {
						"out" === n._hoverState && n.hide();
					}, n.config.delay.hide) : n.hide());
				}, n._isWithActiveTrigger = function () {
					for (var t in this._activeTrigger) {
						if (this._activeTrigger[t]) return !0;
					}

					return !1;
				}, n._getConfig = function (t) {
					var n = e(this.element).data();
					return Object.keys(n).forEach(function (t) {
						-1 !== Kt.indexOf(t) && delete n[t];
					}), "number" == typeof (t = s(s(s({}, this.constructor.Default), n), "object" == _typeof(t) && t ? t : {})).delay && (t.delay = {
						show: t.delay,
						hide: t.delay
					}), "number" == typeof t.title && (t.title = t.title.toString()), "number" == typeof t.content && (t.content = t.content.toString()), l.typeCheckConfig(Yt, t, this.constructor.DefaultType), t.sanitize && (t.template = Vt(t.template, t.whiteList, t.sanitizeFn)), t;
				}, n._getDelegateConfig = function () {
					var t = {};
					if (this.config)
						for (var e in this.config) {
							this.constructor.Default[e] !== this.config[e] && (t[e] = this.config[e]);
						}
					return t;
				}, n._cleanTipClass = function () {
					var t = e(this.getTipElement()),
						n = t.attr("class").match(Xt);
					null !== n && n.length && t.removeClass(n.join(""));
				}, n._handlePopperPlacementChange = function (t) {
					this.tip = t.instance.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(t.placement));
				}, n._fixTransition = function () {
					var t = this.getTipElement(),
						n = this.config.animation;
					null === t.getAttribute("x-placement") && (e(t).removeClass("fade"), this.config.animation = !1, this.hide(), this.show(), this.config.animation = n);
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this).data("bs.tooltip"),
							o = "object" == _typeof(n) && n;

						if ((i || !/dispose|hide/.test(n)) && (i || (i = new t(this, o), e(this).data("bs.tooltip", i)), "string" == typeof n)) {
							if ("undefined" == typeof i[n]) throw new TypeError('No method named "' + n + '"');
							i[n]();
						}
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return Jt;
					}
				}, {
					key: "NAME",
					get: function get() {
						return Yt;
					}
				}, {
					key: "DATA_KEY",
					get: function get() {
						return "bs.tooltip";
					}
				}, {
					key: "Event",
					get: function get() {
						return Zt;
					}
				}, {
					key: "EVENT_KEY",
					get: function get() {
						return ".bs.tooltip";
					}
				}, {
					key: "DefaultType",
					get: function get() {
						return Gt;
					}
				}]), t;
			}();

		e.fn[Yt] = te._jQueryInterface, e.fn[Yt].Constructor = te, e.fn[Yt].noConflict = function () {
			return e.fn[Yt] = zt, te._jQueryInterface;
		};

		var ee = "popover",
			ne = e.fn[ee],
			ie = new RegExp("(^|\\s)bs-popover\\S+", "g"),
			oe = s(s({}, te.Default), {}, {
				placement: "right",
				trigger: "click",
				content: "",
				template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
			}),
			re = s(s({}, te.DefaultType), {}, {
				content: "(string|element|function)"
			}),
			se = {
				HIDE: "hide.bs.popover",
				HIDDEN: "hidden.bs.popover",
				SHOW: "show.bs.popover",
				SHOWN: "shown.bs.popover",
				INSERTED: "inserted.bs.popover",
				CLICK: "click.bs.popover",
				FOCUSIN: "focusin.bs.popover",
				FOCUSOUT: "focusout.bs.popover",
				MOUSEENTER: "mouseenter.bs.popover",
				MOUSELEAVE: "mouseleave.bs.popover"
			},
			ae = function (t) {
				var n, o;

				function r() {
					return t.apply(this, arguments) || this;
				}

				o = t, (n = r).prototype = Object.create(o.prototype), n.prototype.constructor = n, n.__proto__ = o;
				var s = r.prototype;
				return s.isWithContent = function () {
					return this.getTitle() || this._getContent();
				}, s.addAttachmentClass = function (t) {
					e(this.getTipElement()).addClass("bs-popover-" + t);
				}, s.getTipElement = function () {
					return this.tip = this.tip || e(this.config.template)[0], this.tip;
				}, s.setContent = function () {
					var t = e(this.getTipElement());
					this.setElementContent(t.find(".popover-header"), this.getTitle());

					var n = this._getContent();

					"function" == typeof n && (n = n.call(this.element)), this.setElementContent(t.find(".popover-body"), n), t.removeClass("fade show");
				}, s._getContent = function () {
					return this.element.getAttribute("data-content") || this.config.content;
				}, s._cleanTipClass = function () {
					var t = e(this.getTipElement()),
						n = t.attr("class").match(ie);
					null !== n && n.length > 0 && t.removeClass(n.join(""));
				}, r._jQueryInterface = function (t) {
					return this.each(function () {
						var n = e(this).data("bs.popover"),
							i = "object" == _typeof(t) ? t : null;

						if ((n || !/dispose|hide/.test(t)) && (n || (n = new r(this, i), e(this).data("bs.popover", n)), "string" == typeof t)) {
							if ("undefined" == typeof n[t]) throw new TypeError('No method named "' + t + '"');
							n[t]();
						}
					});
				}, i(r, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return oe;
					}
				}, {
					key: "NAME",
					get: function get() {
						return ee;
					}
				}, {
					key: "DATA_KEY",
					get: function get() {
						return "bs.popover";
					}
				}, {
					key: "Event",
					get: function get() {
						return se;
					}
				}, {
					key: "EVENT_KEY",
					get: function get() {
						return ".bs.popover";
					}
				}, {
					key: "DefaultType",
					get: function get() {
						return re;
					}
				}]), r;
			}(te);

		e.fn[ee] = ae._jQueryInterface, e.fn[ee].Constructor = ae, e.fn[ee].noConflict = function () {
			return e.fn[ee] = ne, ae._jQueryInterface;
		};

		var le = "scrollspy",
			ce = e.fn[le],
			ue = {
				offset: 10,
				method: "auto",
				target: ""
			},
			he = {
				offset: "number",
				method: "string",
				target: "(string|element)"
			},
			fe = function () {
				function t(t, n) {
					var i = this;
					this._element = t, this._scrollElement = "BODY" === t.tagName ? window : t, this._config = this._getConfig(n), this._selector = this._config.target + " .nav-link," + this._config.target + " .list-group-item," + this._config.target + " .dropdown-item", this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, e(this._scrollElement).on("scroll.bs.scrollspy", function (t) {
						return i._process(t);
					}), this.refresh(), this._process();
				}

				var n = t.prototype;
				return n.refresh = function () {
					var t = this,
						n = this._scrollElement === this._scrollElement.window ? "offset" : "position",
						i = "auto" === this._config.method ? n : this._config.method,
						o = "position" === i ? this._getScrollTop() : 0;
					this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function (t) {
						var n,
							r = l.getSelectorFromElement(t);

						if (r && (n = document.querySelector(r)), n) {
							var s = n.getBoundingClientRect();
							if (s.width || s.height) return [e(n)[i]().top + o, r];
						}

						return null;
					}).filter(function (t) {
						return t;
					}).sort(function (t, e) {
						return t[0] - e[0];
					}).forEach(function (e) {
						t._offsets.push(e[0]), t._targets.push(e[1]);
					});
				}, n.dispose = function () {
					e.removeData(this._element, "bs.scrollspy"), e(this._scrollElement).off(".bs.scrollspy"), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null;
				}, n._getConfig = function (t) {
					if ("string" != typeof (t = s(s({}, ue), "object" == _typeof(t) && t ? t : {})).target && l.isElement(t.target)) {
						var n = e(t.target).attr("id");
						n || (n = l.getUID(le), e(t.target).attr("id", n)), t.target = "#" + n;
					}

					return l.typeCheckConfig(le, t, he), t;
				}, n._getScrollTop = function () {
					return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop;
				}, n._getScrollHeight = function () {
					return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
				}, n._getOffsetHeight = function () {
					return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height;
				}, n._process = function () {
					var t = this._getScrollTop() + this._config.offset,
						e = this._getScrollHeight(),
						n = this._config.offset + e - this._getOffsetHeight();

					if (this._scrollHeight !== e && this.refresh(), t >= n) {
						var i = this._targets[this._targets.length - 1];
						this._activeTarget !== i && this._activate(i);
					} else {
						if (this._activeTarget && t < this._offsets[0] && this._offsets[0] > 0) return this._activeTarget = null, void this._clear();

						for (var o = this._offsets.length; o--;) {
							this._activeTarget !== this._targets[o] && t >= this._offsets[o] && ("undefined" == typeof this._offsets[o + 1] || t < this._offsets[o + 1]) && this._activate(this._targets[o]);
						}
					}
				}, n._activate = function (t) {
					this._activeTarget = t, this._clear();

					var n = this._selector.split(",").map(function (e) {
							return e + '[data-target="' + t + '"],' + e + '[href="' + t + '"]';
						}),
						i = e([].slice.call(document.querySelectorAll(n.join(","))));

					i.hasClass("dropdown-item") ? (i.closest(".dropdown").find(".dropdown-toggle").addClass("active"), i.addClass("active")) : (i.addClass("active"), i.parents(".nav, .list-group").prev(".nav-link, .list-group-item").addClass("active"), i.parents(".nav, .list-group").prev(".nav-item").children(".nav-link").addClass("active")), e(this._scrollElement).trigger("activate.bs.scrollspy", {
						relatedTarget: t
					});
				}, n._clear = function () {
					[].slice.call(document.querySelectorAll(this._selector)).filter(function (t) {
						return t.classList.contains("active");
					}).forEach(function (t) {
						return t.classList.remove("active");
					});
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this).data("bs.scrollspy");

						if (i || (i = new t(this, "object" == _typeof(n) && n), e(this).data("bs.scrollspy", i)), "string" == typeof n) {
							if ("undefined" == typeof i[n]) throw new TypeError('No method named "' + n + '"');
							i[n]();
						}
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "Default",
					get: function get() {
						return ue;
					}
				}]), t;
			}();

		e(window).on("load.bs.scrollspy.data-api", function () {
			for (var t = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), n = t.length; n--;) {
				var i = e(t[n]);

				fe._jQueryInterface.call(i, i.data());
			}
		}), e.fn[le] = fe._jQueryInterface, e.fn[le].Constructor = fe, e.fn[le].noConflict = function () {
			return e.fn[le] = ce, fe._jQueryInterface;
		};

		var de = e.fn.tab,
			pe = function () {
				function t(t) {
					this._element = t;
				}

				var n = t.prototype;
				return n.show = function () {
					var t = this;

					if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && e(this._element).hasClass("active") || e(this._element).hasClass("disabled"))) {
						var n,
							i,
							o = e(this._element).closest(".nav, .list-group")[0],
							r = l.getSelectorFromElement(this._element);

						if (o) {
							var s = "UL" === o.nodeName || "OL" === o.nodeName ? "> li > .active" : ".active";
							i = (i = e.makeArray(e(o).find(s)))[i.length - 1];
						}

						var a = e.Event("hide.bs.tab", {
								relatedTarget: this._element
							}),
							c = e.Event("show.bs.tab", {
								relatedTarget: i
							});

						if (i && e(i).trigger(a), e(this._element).trigger(c), !c.isDefaultPrevented() && !a.isDefaultPrevented()) {
							r && (n = document.querySelector(r)), this._activate(this._element, o);

							var u = function u() {
								var n = e.Event("hidden.bs.tab", {
										relatedTarget: t._element
									}),
									o = e.Event("shown.bs.tab", {
										relatedTarget: i
									});
								e(i).trigger(n), e(t._element).trigger(o);
							};

							n ? this._activate(n, n.parentNode, u) : u();
						}
					}
				}, n.dispose = function () {
					e.removeData(this._element, "bs.tab"), this._element = null;
				}, n._activate = function (t, n, i) {
					var o = this,
						r = (!n || "UL" !== n.nodeName && "OL" !== n.nodeName ? e(n).children(".active") : e(n).find("> li > .active"))[0],
						s = i && r && e(r).hasClass("fade"),
						a = function a() {
							return o._transitionComplete(t, r, i);
						};

					if (r && s) {
						var c = l.getTransitionDurationFromElement(r);
						e(r).removeClass("show").one(l.TRANSITION_END, a).emulateTransitionEnd(c);
					} else a();
				}, n._transitionComplete = function (t, n, i) {
					if (n) {
						e(n).removeClass("active");
						var o = e(n.parentNode).find("> .dropdown-menu .active")[0];
						o && e(o).removeClass("active"), "tab" === n.getAttribute("role") && n.setAttribute("aria-selected", !1);
					}

					if (e(t).addClass("active"), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !0), l.reflow(t), t.classList.contains("fade") && t.classList.add("show"), t.parentNode && e(t.parentNode).hasClass("dropdown-menu")) {
						var r = e(t).closest(".dropdown")[0];

						if (r) {
							var s = [].slice.call(r.querySelectorAll(".dropdown-toggle"));
							e(s).addClass("active");
						}

						t.setAttribute("aria-expanded", !0);
					}

					i && i();
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this),
							o = i.data("bs.tab");

						if (o || (o = new t(this), i.data("bs.tab", o)), "string" == typeof n) {
							if ("undefined" == typeof o[n]) throw new TypeError('No method named "' + n + '"');
							o[n]();
						}
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}]), t;
			}();

		e(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function (t) {
			t.preventDefault(), pe._jQueryInterface.call(e(this), "show");
		}), e.fn.tab = pe._jQueryInterface, e.fn.tab.Constructor = pe, e.fn.tab.noConflict = function () {
			return e.fn.tab = de, pe._jQueryInterface;
		};

		var me = e.fn.toast,
			ge = {
				animation: "boolean",
				autohide: "boolean",
				delay: "number"
			},
			ve = {
				animation: !0,
				autohide: !0,
				delay: 500
			},
			_e = function () {
				function t(t, e) {
					this._element = t, this._config = this._getConfig(e), this._timeout = null, this._setListeners();
				}

				var n = t.prototype;
				return n.show = function () {
					var t = this,
						n = e.Event("show.bs.toast");

					if (e(this._element).trigger(n), !n.isDefaultPrevented()) {
						this._config.animation && this._element.classList.add("fade");

						var i = function i() {
							t._element.classList.remove("showing"), t._element.classList.add("show"), e(t._element).trigger("shown.bs.toast"), t._config.autohide && (t._timeout = setTimeout(function () {
								t.hide();
							}, t._config.delay));
						};

						if (this._element.classList.remove("hide"), l.reflow(this._element), this._element.classList.add("showing"), this._config.animation) {
							var o = l.getTransitionDurationFromElement(this._element);
							e(this._element).one(l.TRANSITION_END, i).emulateTransitionEnd(o);
						} else i();
					}
				}, n.hide = function () {
					if (this._element.classList.contains("show")) {
						var t = e.Event("hide.bs.toast");
						e(this._element).trigger(t), t.isDefaultPrevented() || this._close();
					}
				}, n.dispose = function () {
					clearTimeout(this._timeout), this._timeout = null, this._element.classList.contains("show") && this._element.classList.remove("show"), e(this._element).off("click.dismiss.bs.toast"), e.removeData(this._element, "bs.toast"), this._element = null, this._config = null;
				}, n._getConfig = function (t) {
					return t = s(s(s({}, ve), e(this._element).data()), "object" == _typeof(t) && t ? t : {}), l.typeCheckConfig("toast", t, this.constructor.DefaultType), t;
				}, n._setListeners = function () {
					var t = this;
					e(this._element).on("click.dismiss.bs.toast", '[data-dismiss="toast"]', function () {
						return t.hide();
					});
				}, n._close = function () {
					var t = this,
						n = function n() {
							t._element.classList.add("hide"), e(t._element).trigger("hidden.bs.toast");
						};

					if (this._element.classList.remove("show"), this._config.animation) {
						var i = l.getTransitionDurationFromElement(this._element);
						e(this._element).one(l.TRANSITION_END, n).emulateTransitionEnd(i);
					} else n();
				}, t._jQueryInterface = function (n) {
					return this.each(function () {
						var i = e(this),
							o = i.data("bs.toast");

						if (o || (o = new t(this, "object" == _typeof(n) && n), i.data("bs.toast", o)), "string" == typeof n) {
							if ("undefined" == typeof o[n]) throw new TypeError('No method named "' + n + '"');
							o[n](this);
						}
					});
				}, i(t, null, [{
					key: "VERSION",
					get: function get() {
						return "4.5.0";
					}
				}, {
					key: "DefaultType",
					get: function get() {
						return ge;
					}
				}, {
					key: "Default",
					get: function get() {
						return ve;
					}
				}]), t;
			}();

		e.fn.toast = _e._jQueryInterface, e.fn.toast.Constructor = _e, e.fn.toast.noConflict = function () {
			return e.fn.toast = me, _e._jQueryInterface;
		}, t.Alert = h, t.Button = d, t.Carousel = y, t.Collapse = S, t.Dropdown = Ft, t.Modal = qt, t.Popover = ae, t.Scrollspy = fe, t.Tab = pe, t.Toast = _e, t.Tooltip = te, t.Util = l, Object.defineProperty(t, "__esModule", {
			value: !0
		});
	});

	/**
	 * Owl Carousel v2.3.4
	 * Copyright 2013-2018 David Deutsch
	 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
	 */
	(function ($, window, document, undefined$1) {

		/**
		 * Creates a carousel.
		 * @class The Owl Carousel.
		 * @public
		 * @param {HTMLElement|jQuery} element - The element to create the carousel for.
		 * @param {Object} [options] - The options
		 */
		function Owl(element, options) {

			/**
			 * Current settings for the carousel.
			 * @public
			 */
			this.settings = null;

			/**
			 * Current options set by the caller including defaults.
			 * @public
			 */
			this.options = $.extend({}, Owl.Defaults, options);

			/**
			 * Plugin element.
			 * @public
			 */
			this.$element = $(element);

			/**
			 * Proxied event handlers.
			 * @protected
			 */
			this._handlers = {};

			/**
			 * References to the running plugins of this carousel.
			 * @protected
			 */
			this._plugins = {};

			/**
			 * Currently suppressed events to prevent them from being retriggered.
			 * @protected
			 */
			this._supress = {};

			/**
			 * Absolute current position.
			 * @protected
			 */
			this._current = null;

			/**
			 * Animation speed in milliseconds.
			 * @protected
			 */
			this._speed = null;

			/**
			 * Coordinates of all items in pixel.
			 * @todo The name of this member is missleading.
			 * @protected
			 */
			this._coordinates = [];

			/**
			 * Current breakpoint.
			 * @todo Real media queries would be nice.
			 * @protected
			 */
			this._breakpoint = null;

			/**
			 * Current width of the plugin element.
			 */
			this._width = null;

			/**
			 * All real items.
			 * @protected
			 */
			this._items = [];

			/**
			 * All cloned items.
			 * @protected
			 */
			this._clones = [];

			/**
			 * Merge values of all items.
			 * @todo Maybe this could be part of a plugin.
			 * @protected
			 */
			this._mergers = [];

			/**
			 * Widths of all items.
			 */
			this._widths = [];

			/**
			 * Invalidated parts within the update process.
			 * @protected
			 */
			this._invalidated = {};

			/**
			 * Ordered list of workers for the update process.
			 * @protected
			 */
			this._pipe = [];

			/**
			 * Current state information for the drag operation.
			 * @todo #261
			 * @protected
			 */
			this._drag = {
				time: null,
				target: null,
				pointer: null,
				stage: {
					start: null,
					current: null
				},
				direction: null
			};

			/**
			 * Current state information and their tags.
			 * @type {Object}
			 * @protected
			 */
			this._states = {
				current: {},
				tags: {
					'initializing': ['busy'],
					'animating': ['busy'],
					'dragging': ['interacting']
				}
			};

			$.each(['onResize', 'onThrottledResize'], $.proxy(function (i, handler) {
				this._handlers[handler] = $.proxy(this[handler], this);
			}, this));

			$.each(Owl.Plugins, $.proxy(function (key, plugin) {
				this._plugins[key.charAt(0).toLowerCase() + key.slice(1)] = new plugin(this);
			}, this));

			$.each(Owl.Workers, $.proxy(function (priority, worker) {
				this._pipe.push({
					'filter': worker.filter,
					'run': $.proxy(worker.run, this)
				});
			}, this));

			this.setup();
			this.initialize();
		}

		/**
		 * Default options for the carousel.
		 * @public
		 */
		Owl.Defaults = {
			items: 3,
			loop: false,
			center: false,
			rewind: false,
			checkVisibility: true,

			mouseDrag: true,
			touchDrag: true,
			pullDrag: true,
			freeDrag: false,

			margin: 0,
			stagePadding: 0,

			merge: false,
			mergeFit: true,
			autoWidth: false,

			startPosition: 0,
			rtl: false,

			smartSpeed: 250,
			fluidSpeed: false,
			dragEndSpeed: false,

			responsive: {},
			responsiveRefreshRate: 200,
			responsiveBaseElement: window,

			fallbackEasing: 'swing',
			slideTransition: '',

			info: false,

			nestedItemSelector: false,
			itemElement: 'div',
			stageElement: 'div',

			refreshClass: 'owl-refresh',
			loadedClass: 'owl-loaded',
			loadingClass: 'owl-loading',
			rtlClass: 'owl-rtl',
			responsiveClass: 'owl-responsive',
			dragClass: 'owl-drag',
			itemClass: 'owl-item',
			stageClass: 'owl-stage',
			stageOuterClass: 'owl-stage-outer',
			grabClass: 'owl-grab'
		};

		/**
		 * Enumeration for width.
		 * @public
		 * @readonly
		 * @enum {String}
		 */
		Owl.Width = {
			Default: 'default',
			Inner: 'inner',
			Outer: 'outer'
		};

		/**
		 * Enumeration for types.
		 * @public
		 * @readonly
		 * @enum {String}
		 */
		Owl.Type = {
			Event: 'event',
			State: 'state'
		};

		/**
		 * Contains all registered plugins.
		 * @public
		 */
		Owl.Plugins = {};

		/**
		 * List of workers involved in the update process.
		 */
		Owl.Workers = [{
			filter: ['width', 'settings'],
			run: function () {
				this._width = this.$element.width();
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function (cache) {
				cache.current = this._items && this._items[this.relative(this._current)];
			}
		}, {
			filter: ['items', 'settings'],
			run: function () {
				this.$stage.children('.cloned').remove();
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function (cache) {
				var margin = this.settings.margin || '',
					grid = !this.settings.autoWidth,
					rtl = this.settings.rtl,
					css = {
						'width': 'auto',
						'margin-left': rtl ? margin : '',
						'margin-right': rtl ? '' : margin
					};

				!grid && this.$stage.children().css(css);

				cache.css = css;
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function (cache) {
				var width = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
					merge = null,
					iterator = this._items.length,
					grid = !this.settings.autoWidth,
					widths = [];

				cache.items = {
					merge: false,
					width: width
				};

				while (iterator--) {
					merge = this._mergers[iterator];
					merge = this.settings.mergeFit && Math.min(merge, this.settings.items) || merge;

					cache.items.merge = merge > 1 || cache.items.merge;

					widths[iterator] = !grid ? this._items[iterator].width() : width * merge;
				}

				this._widths = widths;
			}
		}, {
			filter: ['items', 'settings'],
			run: function () {
				var clones = [],
					items = this._items,
					settings = this.settings,
					// TODO: Should be computed from number of min width items in stage
					view = Math.max(settings.items * 2, 4),
					size = Math.ceil(items.length / 2) * 2,
					repeat = settings.loop && items.length ? settings.rewind ? view : Math.max(view, size) : 0,
					append = '',
					prepend = '';

				repeat /= 2;

				while (repeat > 0) {
					// Switch to only using appended clones
					clones.push(this.normalize(clones.length / 2, true));
					append = append + items[clones[clones.length - 1]][0].outerHTML;
					clones.push(this.normalize(items.length - 1 - (clones.length - 1) / 2, true));
					prepend = items[clones[clones.length - 1]][0].outerHTML + prepend;
					repeat -= 1;
				}

				this._clones = clones;

				$(append).addClass('cloned').appendTo(this.$stage);
				$(prepend).addClass('cloned').prependTo(this.$stage);
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function () {
				var rtl = this.settings.rtl ? 1 : -1,
					size = this._clones.length + this._items.length,
					iterator = -1,
					previous = 0,
					current = 0,
					coordinates = [];

				while (++iterator < size) {
					previous = coordinates[iterator - 1] || 0;
					current = this._widths[this.relative(iterator)] + this.settings.margin;
					coordinates.push(previous + current * rtl);
				}

				this._coordinates = coordinates;
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function () {
				var padding = this.settings.stagePadding,
					coordinates = this._coordinates,
					css = {
						'width': Math.ceil(Math.abs(coordinates[coordinates.length - 1])) + padding * 2,
						'padding-left': padding || '',
						'padding-right': padding || ''
					};

				this.$stage.css(css);
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function (cache) {
				var iterator = this._coordinates.length,
					grid = !this.settings.autoWidth,
					items = this.$stage.children();

				if (grid && cache.items.merge) {
					while (iterator--) {
						cache.css.width = this._widths[this.relative(iterator)];
						items.eq(iterator).css(cache.css);
					}
				} else if (grid) {
					cache.css.width = cache.items.width;
					items.css(cache.css);
				}
			}
		}, {
			filter: ['items'],
			run: function () {
				this._coordinates.length < 1 && this.$stage.removeAttr('style');
			}
		}, {
			filter: ['width', 'items', 'settings'],
			run: function (cache) {
				cache.current = cache.current ? this.$stage.children().index(cache.current) : 0;
				cache.current = Math.max(this.minimum(), Math.min(this.maximum(), cache.current));
				this.reset(cache.current);
			}
		}, {
			filter: ['position'],
			run: function () {
				this.animate(this.coordinates(this._current));
			}
		}, {
			filter: ['width', 'position', 'items', 'settings'],
			run: function () {
				var rtl = this.settings.rtl ? 1 : -1,
					padding = this.settings.stagePadding * 2,
					begin = this.coordinates(this.current()) + padding,
					end = begin + this.width() * rtl,
					inner, outer, matches = [],
					i, n;

				for (i = 0, n = this._coordinates.length; i < n; i++) {
					inner = this._coordinates[i - 1] || 0;
					outer = Math.abs(this._coordinates[i]) + padding * rtl;

					if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end))) ||
						(this.op(outer, '<', begin) && this.op(outer, '>', end))) {
						matches.push(i);
					}
				}

				this.$stage.children('.active').removeClass('active');
				this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass('active');

				this.$stage.children('.center').removeClass('center');
				if (this.settings.center) {
					this.$stage.children().eq(this.current()).addClass('center');
				}
			}
		}];

		/**
		 * Create the stage DOM element
		 */
		Owl.prototype.initializeStage = function () {
			this.$stage = this.$element.find('.' + this.settings.stageClass);

			// if the stage is already in the DOM, grab it and skip stage initialization
			if (this.$stage.length) {
				return;
			}

			this.$element.addClass(this.options.loadingClass);

			// create stage
			this.$stage = $('<' + this.settings.stageElement + '>', {
				"class": this.settings.stageClass
			}).wrap($('<div/>', {
				"class": this.settings.stageOuterClass
			}));

			// append stage
			this.$element.append(this.$stage.parent());
		};

		/**
		 * Create item DOM elements
		 */
		Owl.prototype.initializeItems = function () {
			var $items = this.$element.find('.owl-item');

			// if the items are already in the DOM, grab them and skip item initialization
			if ($items.length) {
				this._items = $items.get().map(function (item) {
					return $(item);
				});

				this._mergers = this._items.map(function () {
					return 1;
				});

				this.refresh();

				return;
			}

			// append content
			this.replace(this.$element.children().not(this.$stage.parent()));

			// check visibility
			if (this.isVisible()) {
				// update view
				this.refresh();
			} else {
				// invalidate width
				this.invalidate('width');
			}

			this.$element
				.removeClass(this.options.loadingClass)
				.addClass(this.options.loadedClass);
		};

		/**
		 * Initializes the carousel.
		 * @protected
		 */
		Owl.prototype.initialize = function () {
			this.enter('initializing');
			this.trigger('initialize');

			this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl);

			if (this.settings.autoWidth && !this.is('pre-loading')) {
				var imgs, nestedSelector, width;
				imgs = this.$element.find('img');
				nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined$1;
				width = this.$element.children(nestedSelector).width();

				if (imgs.length && width <= 0) {
					this.preloadAutoWidthImages(imgs);
				}
			}

			this.initializeStage();
			this.initializeItems();

			// register event handlers
			this.registerEventHandlers();

			this.leave('initializing');
			this.trigger('initialized');
		};

		/**
		 * @returns {Boolean} visibility of $element
		 *                    if you know the carousel will always be visible you can set `checkVisibility` to `false` to
		 *                    prevent the expensive browser layout forced reflow the $element.is(':visible') does
		 */
		Owl.prototype.isVisible = function () {
			return this.settings.checkVisibility ?
				this.$element.is(':visible') :
				true;
		};

		/**
		 * Setups the current settings.
		 * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
		 * @todo Support for media queries by using `matchMedia` would be nice.
		 * @public
		 */
		Owl.prototype.setup = function () {
			var viewport = this.viewport(),
				overwrites = this.options.responsive,
				match = -1,
				settings = null;

			if (!overwrites) {
				settings = $.extend({}, this.options);
			} else {
				$.each(overwrites, function (breakpoint) {
					if (breakpoint <= viewport && breakpoint > match) {
						match = Number(breakpoint);
					}
				});

				settings = $.extend({}, this.options, overwrites[match]);
				if (typeof settings.stagePadding === 'function') {
					settings.stagePadding = settings.stagePadding();
				}
				delete settings.responsive;

				// responsive class
				if (settings.responsiveClass) {
					this.$element.attr('class',
						this.$element.attr('class').replace(new RegExp('(' + this.options.responsiveClass + '-)\\S+\\s', 'g'), '$1' + match)
					);
				}
			}

			this.trigger('change', {
				property: {
					name: 'settings',
					value: settings
				}
			});
			this._breakpoint = match;
			this.settings = settings;
			this.invalidate('settings');
			this.trigger('changed', {
				property: {
					name: 'settings',
					value: this.settings
				}
			});
		};

		/**
		 * Updates option logic if necessery.
		 * @protected
		 */
		Owl.prototype.optionsLogic = function () {
			if (this.settings.autoWidth) {
				this.settings.stagePadding = false;
				this.settings.merge = false;
			}
		};

		/**
		 * Prepares an item before add.
		 * @todo Rename event parameter `content` to `item`.
		 * @protected
		 * @returns {jQuery|HTMLElement} - The item container.
		 */
		Owl.prototype.prepare = function (item) {
			var event = this.trigger('prepare', {
				content: item
			});

			if (!event.data) {
				event.data = $('<' + this.settings.itemElement + '/>')
					.addClass(this.options.itemClass).append(item);
			}

			this.trigger('prepared', {
				content: event.data
			});

			return event.data;
		};

		/**
		 * Updates the view.
		 * @public
		 */
		Owl.prototype.update = function () {
			var i = 0,
				n = this._pipe.length,
				filter = $.proxy(function (p) {
					return this[p]
				}, this._invalidated),
				cache = {};

			while (i < n) {
				if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
					this._pipe[i].run(cache);
				}
				i++;
			}

			this._invalidated = {};

			!this.is('valid') && this.enter('valid');
		};

		/**
		 * Gets the width of the view.
		 * @public
		 * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
		 * @returns {Number} - The width of the view in pixel.
		 */
		Owl.prototype.width = function (dimension) {
			dimension = dimension || Owl.Width.Default;
			switch (dimension) {
				case Owl.Width.Inner:
				case Owl.Width.Outer:
					return this._width;
				default:
					return this._width - this.settings.stagePadding * 2 + this.settings.margin;
			}
		};

		/**
		 * Refreshes the carousel primarily for adaptive purposes.
		 * @public
		 */
		Owl.prototype.refresh = function () {
			this.enter('refreshing');
			this.trigger('refresh');

			this.setup();

			this.optionsLogic();

			this.$element.addClass(this.options.refreshClass);

			this.update();

			this.$element.removeClass(this.options.refreshClass);

			this.leave('refreshing');
			this.trigger('refreshed');
		};

		/**
		 * Checks window `resize` event.
		 * @protected
		 */
		Owl.prototype.onThrottledResize = function () {
			window.clearTimeout(this.resizeTimer);
			this.resizeTimer = window.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate);
		};

		/**
		 * Checks window `resize` event.
		 * @protected
		 */
		Owl.prototype.onResize = function () {
			if (!this._items.length) {
				return false;
			}

			if (this._width === this.$element.width()) {
				return false;
			}

			if (!this.isVisible()) {
				return false;
			}

			this.enter('resizing');

			if (this.trigger('resize').isDefaultPrevented()) {
				this.leave('resizing');
				return false;
			}

			this.invalidate('width');

			this.refresh();

			this.leave('resizing');
			this.trigger('resized');
		};

		/**
		 * Registers event handlers.
		 * @todo Check `msPointerEnabled`
		 * @todo #261
		 * @protected
		 */
		Owl.prototype.registerEventHandlers = function () {
			if ($.support.transition) {
				this.$stage.on($.support.transition.end + '.owl.core', $.proxy(this.onTransitionEnd, this));
			}

			if (this.settings.responsive !== false) {
				this.on(window, 'resize', this._handlers.onThrottledResize);
			}

			if (this.settings.mouseDrag) {
				this.$element.addClass(this.options.dragClass);
				this.$stage.on('mousedown.owl.core', $.proxy(this.onDragStart, this));
				this.$stage.on('dragstart.owl.core selectstart.owl.core', function () {
					return false
				});
			}

			if (this.settings.touchDrag) {
				this.$stage.on('touchstart.owl.core', $.proxy(this.onDragStart, this));
				this.$stage.on('touchcancel.owl.core', $.proxy(this.onDragEnd, this));
			}
		};

		/**
		 * Handles `touchstart` and `mousedown` events.
		 * @todo Horizontal swipe threshold as option
		 * @todo #261
		 * @protected
		 * @param {Event} event - The event arguments.
		 */
		Owl.prototype.onDragStart = function (event) {
			var stage = null;

			if (event.which === 3) {
				return;
			}

			if ($.support.transform) {
				stage = this.$stage.css('transform').replace(/.*\(|\)| /g, '').split(',');
				stage = {
					x: stage[stage.length === 16 ? 12 : 4],
					y: stage[stage.length === 16 ? 13 : 5]
				};
			} else {
				stage = this.$stage.position();
				stage = {
					x: this.settings.rtl ?
						stage.left + this.$stage.width() - this.width() + this.settings.margin : stage.left,
					y: stage.top
				};
			}

			if (this.is('animating')) {
				$.support.transform ? this.animate(stage.x) : this.$stage.stop();
				this.invalidate('position');
			}

			this.$element.toggleClass(this.options.grabClass, event.type === 'mousedown');

			this.speed(0);

			this._drag.time = new Date().getTime();
			this._drag.target = $(event.target);
			this._drag.stage.start = stage;
			this._drag.stage.current = stage;
			this._drag.pointer = this.pointer(event);

			$(document).on('mouseup.owl.core touchend.owl.core', $.proxy(this.onDragEnd, this));

			$(document).one('mousemove.owl.core touchmove.owl.core', $.proxy(function (event) {
				var delta = this.difference(this._drag.pointer, this.pointer(event));

				$(document).on('mousemove.owl.core touchmove.owl.core', $.proxy(this.onDragMove, this));

				if (Math.abs(delta.x) < Math.abs(delta.y) && this.is('valid')) {
					return;
				}

				event.preventDefault();

				this.enter('dragging');
				this.trigger('drag');
			}, this));
		};

		/**
		 * Handles the `touchmove` and `mousemove` events.
		 * @todo #261
		 * @protected
		 * @param {Event} event - The event arguments.
		 */
		Owl.prototype.onDragMove = function (event) {
			var minimum = null,
				maximum = null,
				pull = null,
				delta = this.difference(this._drag.pointer, this.pointer(event)),
				stage = this.difference(this._drag.stage.start, delta);

			if (!this.is('dragging')) {
				return;
			}

			event.preventDefault();

			if (this.settings.loop) {
				minimum = this.coordinates(this.minimum());
				maximum = this.coordinates(this.maximum() + 1) - minimum;
				stage.x = (((stage.x - minimum) % maximum + maximum) % maximum) + minimum;
			} else {
				minimum = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
				maximum = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
				pull = this.settings.pullDrag ? -1 * delta.x / 5 : 0;
				stage.x = Math.max(Math.min(stage.x, minimum + pull), maximum + pull);
			}

			this._drag.stage.current = stage;

			this.animate(stage.x);
		};

		/**
		 * Handles the `touchend` and `mouseup` events.
		 * @todo #261
		 * @todo Threshold for click event
		 * @protected
		 * @param {Event} event - The event arguments.
		 */
		Owl.prototype.onDragEnd = function (event) {
			var delta = this.difference(this._drag.pointer, this.pointer(event)),
				stage = this._drag.stage.current,
				direction = delta.x > 0 ^ this.settings.rtl ? 'left' : 'right';

			$(document).off('.owl.core');

			this.$element.removeClass(this.options.grabClass);

			if (delta.x !== 0 && this.is('dragging') || !this.is('valid')) {
				this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
				this.current(this.closest(stage.x, delta.x !== 0 ? direction : this._drag.direction));
				this.invalidate('position');
				this.update();

				this._drag.direction = direction;

				if (Math.abs(delta.x) > 3 || new Date().getTime() - this._drag.time > 300) {
					this._drag.target.one('click.owl.core', function () {
						return false;
					});
				}
			}

			if (!this.is('dragging')) {
				return;
			}

			this.leave('dragging');
			this.trigger('dragged');
		};

		/**
		 * Gets absolute position of the closest item for a coordinate.
		 * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
		 * @protected
		 * @param {Number} coordinate - The coordinate in pixel.
		 * @param {String} direction - The direction to check for the closest item. Ether `left` or `right`.
		 * @return {Number} - The absolute position of the closest item.
		 */
		Owl.prototype.closest = function (coordinate, direction) {
			var position = -1,
				pull = 30,
				width = this.width(),
				coordinates = this.coordinates();

			if (!this.settings.freeDrag) {
				// check closest item
				$.each(coordinates, $.proxy(function (index, value) {
					// on a left pull, check on current index
					if (direction === 'left' && coordinate > value - pull && coordinate < value + pull) {
						position = index;
						// on a right pull, check on previous index
						// to do so, subtract width from value and set position = index + 1
					} else if (direction === 'right' && coordinate > value - width - pull && coordinate < value - width + pull) {
						position = index + 1;
					} else if (this.op(coordinate, '<', value) &&
						this.op(coordinate, '>', coordinates[index + 1] !== undefined$1 ? coordinates[index + 1] : value - width)) {
						position = direction === 'left' ? index + 1 : index;
					}
					return position === -1;
				}, this));
			}

			if (!this.settings.loop) {
				// non loop boundries
				if (this.op(coordinate, '>', coordinates[this.minimum()])) {
					position = coordinate = this.minimum();
				} else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
					position = coordinate = this.maximum();
				}
			}

			return position;
		};

		/**
		 * Animates the stage.
		 * @todo #270
		 * @public
		 * @param {Number} coordinate - The coordinate in pixels.
		 */
		Owl.prototype.animate = function (coordinate) {
			var animate = this.speed() > 0;

			this.is('animating') && this.onTransitionEnd();

			if (animate) {
				this.enter('animating');
				this.trigger('translate');
			}

			if ($.support.transform3d && $.support.transition) {
				this.$stage.css({
					transform: 'translate3d(' + coordinate + 'px,0px,0px)',
					transition: (this.speed() / 1000) + 's' + (
						this.settings.slideTransition ? ' ' + this.settings.slideTransition : ''
					)
				});
			} else if (animate) {
				this.$stage.animate({
					left: coordinate + 'px'
				}, this.speed(), this.settings.fallbackEasing, $.proxy(this.onTransitionEnd, this));
			} else {
				this.$stage.css({
					left: coordinate + 'px'
				});
			}
		};

		/**
		 * Checks whether the carousel is in a specific state or not.
		 * @param {String} state - The state to check.
		 * @returns {Boolean} - The flag which indicates if the carousel is busy.
		 */
		Owl.prototype.is = function (state) {
			return this._states.current[state] && this._states.current[state] > 0;
		};

		/**
		 * Sets the absolute position of the current item.
		 * @public
		 * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
		 * @returns {Number} - The absolute position of the current item.
		 */
		Owl.prototype.current = function (position) {
			if (position === undefined$1) {
				return this._current;
			}

			if (this._items.length === 0) {
				return undefined$1;
			}

			position = this.normalize(position);

			if (this._current !== position) {
				var event = this.trigger('change', {
					property: {
						name: 'position',
						value: position
					}
				});

				if (event.data !== undefined$1) {
					position = this.normalize(event.data);
				}

				this._current = position;

				this.invalidate('position');

				this.trigger('changed', {
					property: {
						name: 'position',
						value: this._current
					}
				});
			}

			return this._current;
		};

		/**
		 * Invalidates the given part of the update routine.
		 * @param {String} [part] - The part to invalidate.
		 * @returns {Array.<String>} - The invalidated parts.
		 */
		Owl.prototype.invalidate = function (part) {
			if ($.type(part) === 'string') {
				this._invalidated[part] = true;
				this.is('valid') && this.leave('valid');
			}
			return $.map(this._invalidated, function (v, i) {
				return i
			});
		};

		/**
		 * Resets the absolute position of the current item.
		 * @public
		 * @param {Number} position - The absolute position of the new item.
		 */
		Owl.prototype.reset = function (position) {
			position = this.normalize(position);

			if (position === undefined$1) {
				return;
			}

			this._speed = 0;
			this._current = position;

			this.suppress(['translate', 'translated']);

			this.animate(this.coordinates(position));

			this.release(['translate', 'translated']);
		};

		/**
		 * Normalizes an absolute or a relative position of an item.
		 * @public
		 * @param {Number} position - The absolute or relative position to normalize.
		 * @param {Boolean} [relative=false] - Whether the given position is relative or not.
		 * @returns {Number} - The normalized position.
		 */
		Owl.prototype.normalize = function (position, relative) {
			var n = this._items.length,
				m = relative ? 0 : this._clones.length;

			if (!this.isNumeric(position) || n < 1) {
				position = undefined$1;
			} else if (position < 0 || position >= n + m) {
				position = ((position - m / 2) % n + n) % n + m / 2;
			}

			return position;
		};

		/**
		 * Converts an absolute position of an item into a relative one.
		 * @public
		 * @param {Number} position - The absolute position to convert.
		 * @returns {Number} - The converted position.
		 */
		Owl.prototype.relative = function (position) {
			position -= this._clones.length / 2;
			return this.normalize(position, true);
		};

		/**
		 * Gets the maximum position for the current item.
		 * @public
		 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
		 * @returns {Number}
		 */
		Owl.prototype.maximum = function (relative) {
			var settings = this.settings,
				maximum = this._coordinates.length,
				iterator,
				reciprocalItemsWidth,
				elementWidth;

			if (settings.loop) {
				maximum = this._clones.length / 2 + this._items.length - 1;
			} else if (settings.autoWidth || settings.merge) {
				iterator = this._items.length;
				if (iterator) {
					reciprocalItemsWidth = this._items[--iterator].width();
					elementWidth = this.$element.width();
					while (iterator--) {
						reciprocalItemsWidth += this._items[iterator].width() + this.settings.margin;
						if (reciprocalItemsWidth > elementWidth) {
							break;
						}
					}
				}
				maximum = iterator + 1;
			} else if (settings.center) {
				maximum = this._items.length - 1;
			} else {
				maximum = this._items.length - settings.items;
			}

			if (relative) {
				maximum -= this._clones.length / 2;
			}

			return Math.max(maximum, 0);
		};

		/**
		 * Gets the minimum position for the current item.
		 * @public
		 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
		 * @returns {Number}
		 */
		Owl.prototype.minimum = function (relative) {
			return relative ? 0 : this._clones.length / 2;
		};

		/**
		 * Gets an item at the specified relative position.
		 * @public
		 * @param {Number} [position] - The relative position of the item.
		 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
		 */
		Owl.prototype.items = function (position) {
			if (position === undefined$1) {
				return this._items.slice();
			}

			position = this.normalize(position, true);
			return this._items[position];
		};

		/**
		 * Gets an item at the specified relative position.
		 * @public
		 * @param {Number} [position] - The relative position of the item.
		 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
		 */
		Owl.prototype.mergers = function (position) {
			if (position === undefined$1) {
				return this._mergers.slice();
			}

			position = this.normalize(position, true);
			return this._mergers[position];
		};

		/**
		 * Gets the absolute positions of clones for an item.
		 * @public
		 * @param {Number} [position] - The relative position of the item.
		 * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
		 */
		Owl.prototype.clones = function (position) {
			var odd = this._clones.length / 2,
				even = odd + this._items.length,
				map = function (index) {
					return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2
				};

			if (position === undefined$1) {
				return $.map(this._clones, function (v, i) {
					return map(i)
				});
			}

			return $.map(this._clones, function (v, i) {
				return v === position ? map(i) : null
			});
		};

		/**
		 * Sets the current animation speed.
		 * @public
		 * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
		 * @returns {Number} - The current animation speed in milliseconds.
		 */
		Owl.prototype.speed = function (speed) {
			if (speed !== undefined$1) {
				this._speed = speed;
			}

			return this._speed;
		};

		/**
		 * Gets the coordinate of an item.
		 * @todo The name of this method is missleanding.
		 * @public
		 * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
		 * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
		 */
		Owl.prototype.coordinates = function (position) {
			var multiplier = 1,
				newPosition = position - 1,
				coordinate;

			if (position === undefined$1) {
				return $.map(this._coordinates, $.proxy(function (coordinate, index) {
					return this.coordinates(index);
				}, this));
			}

			if (this.settings.center) {
				if (this.settings.rtl) {
					multiplier = -1;
					newPosition = position + 1;
				}

				coordinate = this._coordinates[position];
				coordinate += (this.width() - coordinate + (this._coordinates[newPosition] || 0)) / 2 * multiplier;
			} else {
				coordinate = this._coordinates[newPosition] || 0;
			}

			coordinate = Math.ceil(coordinate);

			return coordinate;
		};

		/**
		 * Calculates the speed for a translation.
		 * @protected
		 * @param {Number} from - The absolute position of the start item.
		 * @param {Number} to - The absolute position of the target item.
		 * @param {Number} [factor=undefined] - The time factor in milliseconds.
		 * @returns {Number} - The time in milliseconds for the translation.
		 */
		Owl.prototype.duration = function (from, to, factor) {
			if (factor === 0) {
				return 0;
			}

			return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
		};

		/**
		 * Slides to the specified item.
		 * @public
		 * @param {Number} position - The position of the item.
		 * @param {Number} [speed] - The time in milliseconds for the transition.
		 */
		Owl.prototype.to = function (position, speed) {
			var current = this.current(),
				revert = null,
				distance = position - this.relative(current),
				direction = (distance > 0) - (distance < 0),
				items = this._items.length,
				minimum = this.minimum(),
				maximum = this.maximum();

			if (this.settings.loop) {
				if (!this.settings.rewind && Math.abs(distance) > items / 2) {
					distance += direction * -1 * items;
				}

				position = current + distance;
				revert = ((position - minimum) % items + items) % items + minimum;

				if (revert !== position && revert - distance <= maximum && revert - distance > 0) {
					current = revert - distance;
					position = revert;
					this.reset(current);
				}
			} else if (this.settings.rewind) {
				maximum += 1;
				position = (position % maximum + maximum) % maximum;
			} else {
				position = Math.max(minimum, Math.min(maximum, position));
			}

			this.speed(this.duration(current, position, speed));
			this.current(position);

			if (this.isVisible()) {
				this.update();
			}
		};

		/**
		 * Slides to the next item.
		 * @public
		 * @param {Number} [speed] - The time in milliseconds for the transition.
		 */
		Owl.prototype.next = function (speed) {
			speed = speed || false;
			this.to(this.relative(this.current()) + 1, speed);
		};

		/**
		 * Slides to the previous item.
		 * @public
		 * @param {Number} [speed] - The time in milliseconds for the transition.
		 */
		Owl.prototype.prev = function (speed) {
			speed = speed || false;
			this.to(this.relative(this.current()) - 1, speed);
		};

		/**
		 * Handles the end of an animation.
		 * @protected
		 * @param {Event} event - The event arguments.
		 */
		Owl.prototype.onTransitionEnd = function (event) {

			// if css2 animation then event object is undefined
			if (event !== undefined$1) {
				event.stopPropagation();

				// Catch only owl-stage transitionEnd event
				if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
					return false;
				}
			}

			this.leave('animating');
			this.trigger('translated');
		};

		/**
		 * Gets viewport width.
		 * @protected
		 * @return {Number} - The width in pixel.
		 */
		Owl.prototype.viewport = function () {
			var width;
			if (this.options.responsiveBaseElement !== window) {
				width = $(this.options.responsiveBaseElement).width();
			} else if (window.innerWidth) {
				width = window.innerWidth;
			} else if (document.documentElement && document.documentElement.clientWidth) {
				width = document.documentElement.clientWidth;
			} else {
				console.warn('Can not detect viewport width.');
			}
			return width;
		};

		/**
		 * Replaces the current content.
		 * @public
		 * @param {HTMLElement|jQuery|String} content - The new content.
		 */
		Owl.prototype.replace = function (content) {
			this.$stage.empty();
			this._items = [];

			if (content) {
				content = (content instanceof jQuery) ? content : $(content);
			}

			if (this.settings.nestedItemSelector) {
				content = content.find('.' + this.settings.nestedItemSelector);
			}

			content.filter(function () {
				return this.nodeType === 1;
			}).each($.proxy(function (index, item) {
				item = this.prepare(item);
				this.$stage.append(item);
				this._items.push(item);
				this._mergers.push(item.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
			}, this));

			this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

			this.invalidate('items');
		};

		/**
		 * Adds an item.
		 * @todo Use `item` instead of `content` for the event arguments.
		 * @public
		 * @param {HTMLElement|jQuery|String} content - The item content to add.
		 * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
		 */
		Owl.prototype.add = function (content, position) {
			var current = this.relative(this._current);

			position = position === undefined$1 ? this._items.length : this.normalize(position, true);
			content = content instanceof jQuery ? content : $(content);

			this.trigger('add', {
				content: content,
				position: position
			});

			content = this.prepare(content);

			if (this._items.length === 0 || position === this._items.length) {
				this._items.length === 0 && this.$stage.append(content);
				this._items.length !== 0 && this._items[position - 1].after(content);
				this._items.push(content);
				this._mergers.push(content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
			} else {
				this._items[position].before(content);
				this._items.splice(position, 0, content);
				this._mergers.splice(position, 0, content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
			}

			this._items[current] && this.reset(this._items[current].index());

			this.invalidate('items');

			this.trigger('added', {
				content: content,
				position: position
			});
		};

		/**
		 * Removes an item by its position.
		 * @todo Use `item` instead of `content` for the event arguments.
		 * @public
		 * @param {Number} position - The relative position of the item to remove.
		 */
		Owl.prototype.remove = function (position) {
			position = this.normalize(position, true);

			if (position === undefined$1) {
				return;
			}

			this.trigger('remove', {
				content: this._items[position],
				position: position
			});

			this._items[position].remove();
			this._items.splice(position, 1);
			this._mergers.splice(position, 1);

			this.invalidate('items');

			this.trigger('removed', {
				content: null,
				position: position
			});
		};

		/**
		 * Preloads images with auto width.
		 * @todo Replace by a more generic approach
		 * @protected
		 */
		Owl.prototype.preloadAutoWidthImages = function (images) {
			images.each($.proxy(function (i, element) {
				this.enter('pre-loading');
				element = $(element);
				$(new Image()).one('load', $.proxy(function (e) {
					element.attr('src', e.target.src);
					element.css('opacity', 1);
					this.leave('pre-loading');
					!this.is('pre-loading') && !this.is('initializing') && this.refresh();
				}, this)).attr('src', element.attr('src') || element.attr('data-src') || element.attr('data-src-retina'));
			}, this));
		};

		/**
		 * Destroys the carousel.
		 * @public
		 */
		Owl.prototype.destroy = function () {

			this.$element.off('.owl.core');
			this.$stage.off('.owl.core');
			$(document).off('.owl.core');

			if (this.settings.responsive !== false) {
				window.clearTimeout(this.resizeTimer);
				this.off(window, 'resize', this._handlers.onThrottledResize);
			}

			for (var i in this._plugins) {
				this._plugins[i].destroy();
			}

			this.$stage.children('.cloned').remove();

			this.$stage.unwrap();
			this.$stage.children().contents().unwrap();
			this.$stage.children().unwrap();
			this.$stage.remove();
			this.$element
				.removeClass(this.options.refreshClass)
				.removeClass(this.options.loadingClass)
				.removeClass(this.options.loadedClass)
				.removeClass(this.options.rtlClass)
				.removeClass(this.options.dragClass)
				.removeClass(this.options.grabClass)
				.attr('class', this.$element.attr('class').replace(new RegExp(this.options.responsiveClass + '-\\S+\\s', 'g'), ''))
				.removeData('owl.carousel');
		};

		/**
		 * Operators to calculate right-to-left and left-to-right.
		 * @protected
		 * @param {Number} [a] - The left side operand.
		 * @param {String} [o] - The operator.
		 * @param {Number} [b] - The right side operand.
		 */
		Owl.prototype.op = function (a, o, b) {
			var rtl = this.settings.rtl;
			switch (o) {
				case '<':
					return rtl ? a > b : a < b;
				case '>':
					return rtl ? a < b : a > b;
				case '>=':
					return rtl ? a <= b : a >= b;
				case '<=':
					return rtl ? a >= b : a <= b;
			}
		};

		/**
		 * Attaches to an internal event.
		 * @protected
		 * @param {HTMLElement} element - The event source.
		 * @param {String} event - The event name.
		 * @param {Function} listener - The event handler to attach.
		 * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
		 */
		Owl.prototype.on = function (element, event, listener, capture) {
			if (element.addEventListener) {
				element.addEventListener(event, listener, capture);
			} else if (element.attachEvent) {
				element.attachEvent('on' + event, listener);
			}
		};

		/**
		 * Detaches from an internal event.
		 * @protected
		 * @param {HTMLElement} element - The event source.
		 * @param {String} event - The event name.
		 * @param {Function} listener - The attached event handler to detach.
		 * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
		 */
		Owl.prototype.off = function (element, event, listener, capture) {
			if (element.removeEventListener) {
				element.removeEventListener(event, listener, capture);
			} else if (element.detachEvent) {
				element.detachEvent('on' + event, listener);
			}
		};

		/**
		 * Triggers a public event.
		 * @todo Remove `status`, `relatedTarget` should be used instead.
		 * @protected
		 * @param {String} name - The event name.
		 * @param {*} [data=null] - The event data.
		 * @param {String} [namespace=carousel] - The event namespace.
		 * @param {String} [state] - The state which is associated with the event.
		 * @param {Boolean} [enter=false] - Indicates if the call enters the specified state or not.
		 * @returns {Event} - The event arguments.
		 */
		Owl.prototype.trigger = function (name, data, namespace, state, enter) {
			var status = {
					item: {
						count: this._items.length,
						index: this.current()
					}
				},
				handler = $.camelCase(
					$.grep(['on', name, namespace], function (v) {
						return v
					})
					.join('-').toLowerCase()
				),
				event = $.Event(
					[name, 'owl', namespace || 'carousel'].join('.').toLowerCase(),
					$.extend({
						relatedTarget: this
					}, status, data)
				);

			if (!this._supress[name]) {
				$.each(this._plugins, function (name, plugin) {
					if (plugin.onTrigger) {
						plugin.onTrigger(event);
					}
				});

				this.register({
					type: Owl.Type.Event,
					name: name
				});
				this.$element.trigger(event);

				if (this.settings && typeof this.settings[handler] === 'function') {
					this.settings[handler].call(this, event);
				}
			}

			return event;
		};

		/**
		 * Enters a state.
		 * @param name - The state name.
		 */
		Owl.prototype.enter = function (name) {
			$.each([name].concat(this._states.tags[name] || []), $.proxy(function (i, name) {
				if (this._states.current[name] === undefined$1) {
					this._states.current[name] = 0;
				}

				this._states.current[name]++;
			}, this));
		};

		/**
		 * Leaves a state.
		 * @param name - The state name.
		 */
		Owl.prototype.leave = function (name) {
			$.each([name].concat(this._states.tags[name] || []), $.proxy(function (i, name) {
				this._states.current[name]--;
			}, this));
		};

		/**
		 * Registers an event or state.
		 * @public
		 * @param {Object} object - The event or state to register.
		 */
		Owl.prototype.register = function (object) {
			if (object.type === Owl.Type.Event) {
				if (!$.event.special[object.name]) {
					$.event.special[object.name] = {};
				}

				if (!$.event.special[object.name].owl) {
					var _default = $.event.special[object.name]._default;
					$.event.special[object.name]._default = function (e) {
						if (_default && _default.apply && (!e.namespace || e.namespace.indexOf('owl') === -1)) {
							return _default.apply(this, arguments);
						}
						return e.namespace && e.namespace.indexOf('owl') > -1;
					};
					$.event.special[object.name].owl = true;
				}
			} else if (object.type === Owl.Type.State) {
				if (!this._states.tags[object.name]) {
					this._states.tags[object.name] = object.tags;
				} else {
					this._states.tags[object.name] = this._states.tags[object.name].concat(object.tags);
				}

				this._states.tags[object.name] = $.grep(this._states.tags[object.name], $.proxy(function (tag, i) {
					return $.inArray(tag, this._states.tags[object.name]) === i;
				}, this));
			}
		};

		/**
		 * Suppresses events.
		 * @protected
		 * @param {Array.<String>} events - The events to suppress.
		 */
		Owl.prototype.suppress = function (events) {
			$.each(events, $.proxy(function (index, event) {
				this._supress[event] = true;
			}, this));
		};

		/**
		 * Releases suppressed events.
		 * @protected
		 * @param {Array.<String>} events - The events to release.
		 */
		Owl.prototype.release = function (events) {
			$.each(events, $.proxy(function (index, event) {
				delete this._supress[event];
			}, this));
		};

		/**
		 * Gets unified pointer coordinates from event.
		 * @todo #261
		 * @protected
		 * @param {Event} - The `mousedown` or `touchstart` event.
		 * @returns {Object} - Contains `x` and `y` coordinates of current pointer position.
		 */
		Owl.prototype.pointer = function (event) {
			var result = {
				x: null,
				y: null
			};

			event = event.originalEvent || event || window.event;

			event = event.touches && event.touches.length ?
				event.touches[0] : event.changedTouches && event.changedTouches.length ?
				event.changedTouches[0] : event;

			if (event.pageX) {
				result.x = event.pageX;
				result.y = event.pageY;
			} else {
				result.x = event.clientX;
				result.y = event.clientY;
			}

			return result;
		};

		/**
		 * Determines if the input is a Number or something that can be coerced to a Number
		 * @protected
		 * @param {Number|String|Object|Array|Boolean|RegExp|Function|Symbol} - The input to be tested
		 * @returns {Boolean} - An indication if the input is a Number or can be coerced to a Number
		 */
		Owl.prototype.isNumeric = function (number) {
			return !isNaN(parseFloat(number));
		};

		/**
		 * Gets the difference of two vectors.
		 * @todo #261
		 * @protected
		 * @param {Object} - The first vector.
		 * @param {Object} - The second vector.
		 * @returns {Object} - The difference.
		 */
		Owl.prototype.difference = function (first, second) {
			return {
				x: first.x - second.x,
				y: first.y - second.y
			};
		};

		/**
		 * The jQuery Plugin for the Owl Carousel
		 * @todo Navigation plugin `next` and `prev`
		 * @public
		 */
		$.fn.owlCarousel = function (option) {
			var args = Array.prototype.slice.call(arguments, 1);

			return this.each(function () {
				var $this = $(this),
					data = $this.data('owl.carousel');

				if (!data) {
					data = new Owl(this, typeof option == 'object' && option);
					$this.data('owl.carousel', data);

					$.each([
						'next', 'prev', 'to', 'destroy', 'refresh', 'replace', 'add', 'remove'
					], function (i, event) {
						data.register({
							type: Owl.Type.Event,
							name: event
						});
						data.$element.on(event + '.owl.carousel.core', $.proxy(function (e) {
							if (e.namespace && e.relatedTarget !== this) {
								this.suppress([event]);
								data[event].apply(this, [].slice.call(arguments, 1));
								this.release([event]);
							}
						}, data));
					});
				}

				if (typeof option == 'string' && option.charAt(0) !== '_') {
					data[option].apply(data, args);
				}
			});
		};

		/**
		 * The constructor for the jQuery Plugin
		 * @public
		 */
		$.fn.owlCarousel.Constructor = Owl;

	})(window.Zepto || window.jQuery, window, document);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the auto refresh plugin.
		 * @class The Auto Refresh Plugin
		 * @param {Owl} carousel - The Owl Carousel
		 */
		var AutoRefresh = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * Refresh interval.
			 * @protected
			 * @type {number}
			 */
			this._interval = null;

			/**
			 * Whether the element is currently visible or not.
			 * @protected
			 * @type {Boolean}
			 */
			this._visible = null;

			/**
			 * All event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'initialized.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.autoRefresh) {
						this.watch();
					}
				}, this)
			};

			// set default options
			this._core.options = $.extend({}, AutoRefresh.Defaults, this._core.options);

			// register event handlers
			this._core.$element.on(this._handlers);
		};

		/**
		 * Default options.
		 * @public
		 */
		AutoRefresh.Defaults = {
			autoRefresh: true,
			autoRefreshInterval: 500
		};

		/**
		 * Watches the element.
		 */
		AutoRefresh.prototype.watch = function () {
			if (this._interval) {
				return;
			}

			this._visible = this._core.isVisible();
			this._interval = window.setInterval($.proxy(this.refresh, this), this._core.settings.autoRefreshInterval);
		};

		/**
		 * Refreshes the element.
		 */
		AutoRefresh.prototype.refresh = function () {
			if (this._core.isVisible() === this._visible) {
				return;
			}

			this._visible = !this._visible;

			this._core.$element.toggleClass('owl-hidden', !this._visible);

			this._visible && (this._core.invalidate('width') && this._core.refresh());
		};

		/**
		 * Destroys the plugin.
		 */
		AutoRefresh.prototype.destroy = function () {
			var handler, property;

			window.clearInterval(this._interval);

			for (handler in this._handlers) {
				this._core.$element.off(handler, this._handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.AutoRefresh = AutoRefresh;

	})(window.Zepto || window.jQuery, window);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the lazy plugin.
		 * @class The Lazy Plugin
		 * @param {Owl} carousel - The Owl Carousel
		 */
		var Lazy = function (carousel) {

			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * Already loaded items.
			 * @protected
			 * @type {Array.<jQuery>}
			 */
			this._loaded = [];

			/**
			 * Event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'initialized.owl.carousel change.owl.carousel resized.owl.carousel': $.proxy(function (e) {
					if (!e.namespace) {
						return;
					}

					if (!this._core.settings || !this._core.settings.lazyLoad) {
						return;
					}

					if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
						var settings = this._core.settings,
							n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
							i = ((settings.center && n * -1) || 0),
							position = (e.property && e.property.value !== undefined$1 ? e.property.value : this._core.current()) + i,
							clones = this._core.clones().length,
							load = $.proxy(function (i, v) {
								this.load(v);
							}, this);
						//TODO: Need documentation for this new option
						if (settings.lazyLoadEager > 0) {
							n += settings.lazyLoadEager;
							// If the carousel is looping also preload images that are to the "left"
							if (settings.loop) {
								position -= settings.lazyLoadEager;
								n++;
							}
						}

						while (i++ < n) {
							this.load(clones / 2 + this._core.relative(position));
							clones && $.each(this._core.clones(this._core.relative(position)), load);
							position++;
						}
					}
				}, this)
			};

			// set the default options
			this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

			// register event handler
			this._core.$element.on(this._handlers);
		};

		/**
		 * Default options.
		 * @public
		 */
		Lazy.Defaults = {
			lazyLoad: false,
			lazyLoadEager: 0
		};

		/**
		 * Loads all resources of an item at the specified position.
		 * @param {Number} position - The absolute position of the item.
		 * @protected
		 */
		Lazy.prototype.load = function (position) {
			var $item = this._core.$stage.children().eq(position),
				$elements = $item && $item.find('.owl-lazy');

			if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
				return;
			}

			$elements.each($.proxy(function (index, element) {
				var $element = $(element),
					image,
					url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src') || $element.attr('data-srcset');

				this._core.trigger('load', {
					element: $element,
					url: url
				}, 'lazy');

				if ($element.is('img')) {
					$element.one('load.owl.lazy', $.proxy(function () {
						$element.css('opacity', 1);
						this._core.trigger('loaded', {
							element: $element,
							url: url
						}, 'lazy');
					}, this)).attr('src', url);
				} else if ($element.is('source')) {
					$element.one('load.owl.lazy', $.proxy(function () {
						this._core.trigger('loaded', {
							element: $element,
							url: url
						}, 'lazy');
					}, this)).attr('srcset', url);
				} else {
					image = new Image();
					image.onload = $.proxy(function () {
						$element.css({
							'background-image': 'url("' + url + '")',
							'opacity': '1'
						});
						this._core.trigger('loaded', {
							element: $element,
							url: url
						}, 'lazy');
					}, this);
					image.src = url;
				}
			}, this));

			this._loaded.push($item.get(0));
		};

		/**
		 * Destroys the plugin.
		 * @public
		 */
		Lazy.prototype.destroy = function () {
			var handler, property;

			for (handler in this.handlers) {
				this._core.$element.off(handler, this.handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

	})(window.Zepto || window.jQuery, window);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the auto height plugin.
		 * @class The Auto Height Plugin
		 * @param {Owl} carousel - The Owl Carousel
		 */
		var AutoHeight = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			this._previousHeight = null;

			/**
			 * All event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'initialized.owl.carousel refreshed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.autoHeight) {
						this.update();
					}
				}, this),
				'changed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.autoHeight && e.property.name === 'position') {
						this.update();
					}
				}, this),
				'loaded.owl.lazy': $.proxy(function (e) {
					if (e.namespace && this._core.settings.autoHeight &&
						e.element.closest('.' + this._core.settings.itemClass).index() === this._core.current()) {
						this.update();
					}
				}, this)
			};

			// set default options
			this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

			// register event handlers
			this._core.$element.on(this._handlers);
			this._intervalId = null;
			var refThis = this;

			// These changes have been taken from a PR by gavrochelegnou proposed in #1575
			// and have been made compatible with the latest jQuery version
			$(window).on('load', function () {
				if (refThis._core.settings.autoHeight) {
					refThis.update();
				}
			});

			// Autoresize the height of the carousel when window is resized
			// When carousel has images, the height is dependent on the width
			// and should also change on resize
			$(window).resize(function () {
				if (refThis._core.settings.autoHeight) {
					if (refThis._intervalId != null) {
						clearTimeout(refThis._intervalId);
					}

					refThis._intervalId = setTimeout(function () {
						refThis.update();
					}, 250);
				}
			});

		};

		/**
		 * Default options.
		 * @public
		 */
		AutoHeight.Defaults = {
			autoHeight: false,
			autoHeightClass: 'owl-height'
		};

		/**
		 * Updates the view.
		 */
		AutoHeight.prototype.update = function () {
			var start = this._core._current,
				end = start + this._core.settings.items,
				lazyLoadEnabled = this._core.settings.lazyLoad,
				visible = this._core.$stage.children().toArray().slice(start, end),
				heights = [],
				maxheight = 0;

			$.each(visible, function (index, item) {
				heights.push($(item).height());
			});

			maxheight = Math.max.apply(null, heights);

			if (maxheight <= 1 && lazyLoadEnabled && this._previousHeight) {
				maxheight = this._previousHeight;
			}

			this._previousHeight = maxheight;

			this._core.$stage.parent()
				.height(maxheight)
				.addClass(this._core.settings.autoHeightClass);
		};

		AutoHeight.prototype.destroy = function () {
			var handler, property;

			for (handler in this._handlers) {
				this._core.$element.off(handler, this._handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] !== 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

	})(window.Zepto || window.jQuery, window);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the video plugin.
		 * @class The Video Plugin
		 * @param {Owl} carousel - The Owl Carousel
		 */
		var Video = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * Cache all video URLs.
			 * @protected
			 * @type {Object}
			 */
			this._videos = {};

			/**
			 * Current playing item.
			 * @protected
			 * @type {jQuery}
			 */
			this._playing = null;

			/**
			 * All event handlers.
			 * @todo The cloned content removale is too late
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'initialized.owl.carousel': $.proxy(function (e) {
					if (e.namespace) {
						this._core.register({
							type: 'state',
							name: 'playing',
							tags: ['interacting']
						});
					}
				}, this),
				'resize.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.video && this.isInFullScreen()) {
						e.preventDefault();
					}
				}, this),
				'refreshed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.is('resizing')) {
						this._core.$stage.find('.cloned .owl-video-frame').remove();
					}
				}, this),
				'changed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && e.property.name === 'position' && this._playing) {
						this.stop();
					}
				}, this),
				'prepared.owl.carousel': $.proxy(function (e) {
					if (!e.namespace) {
						return;
					}

					var $element = $(e.content).find('.owl-video');

					if ($element.length) {
						$element.css('display', 'none');
						this.fetch($element, $(e.content));
					}
				}, this)
			};

			// set default options
			this._core.options = $.extend({}, Video.Defaults, this._core.options);

			// register event handlers
			this._core.$element.on(this._handlers);

			this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function (e) {
				this.play(e);
			}, this));
		};

		/**
		 * Default options.
		 * @public
		 */
		Video.Defaults = {
			video: false,
			videoHeight: false,
			videoWidth: false
		};

		/**
		 * Gets the video ID and the type (YouTube/Vimeo/vzaar only).
		 * @protected
		 * @param {jQuery} target - The target containing the video data.
		 * @param {jQuery} item - The item containing the video.
		 */
		Video.prototype.fetch = function (target, item) {
			var type = (function () {
					if (target.attr('data-vimeo-id')) {
						return 'vimeo';
					} else if (target.attr('data-vzaar-id')) {
						return 'vzaar'
					} else {
						return 'youtube';
					}
				})(),
				id = target.attr('data-vimeo-id') || target.attr('data-youtube-id') || target.attr('data-vzaar-id'),
				width = target.attr('data-width') || this._core.settings.videoWidth,
				height = target.attr('data-height') || this._core.settings.videoHeight,
				url = target.attr('href');

			if (url) {

				/*
						Parses the id's out of the following urls (and probably more):
						https://www.youtube.com/watch?v=:id
						https://youtu.be/:id
						https://vimeo.com/:id
						https://vimeo.com/channels/:channel/:id
						https://vimeo.com/groups/:group/videos/:id
						https://app.vzaar.com/videos/:id

						Visual example: https://regexper.com/#(http%3A%7Chttps%3A%7C)%5C%2F%5C%2F(player.%7Cwww.%7Capp.)%3F(vimeo%5C.com%7Cyoutu(be%5C.com%7C%5C.be%7Cbe%5C.googleapis%5C.com)%7Cvzaar%5C.com)%5C%2F(video%5C%2F%7Cvideos%5C%2F%7Cembed%5C%2F%7Cchannels%5C%2F.%2B%5C%2F%7Cgroups%5C%2F.%2B%5C%2F%7Cwatch%5C%3Fv%3D%7Cv%5C%2F)%3F(%5BA-Za-z0-9._%25-%5D*)(%5C%26%5CS%2B)%3F
				*/

				id = url.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

				if (id[3].indexOf('youtu') > -1) {
					type = 'youtube';
				} else if (id[3].indexOf('vimeo') > -1) {
					type = 'vimeo';
				} else if (id[3].indexOf('vzaar') > -1) {
					type = 'vzaar';
				} else {
					throw new Error('Video URL not supported.');
				}
				id = id[6];
			} else {
				throw new Error('Missing video URL.');
			}

			this._videos[url] = {
				type: type,
				id: id,
				width: width,
				height: height
			};

			item.attr('data-video', url);

			this.thumbnail(target, this._videos[url]);
		};

		/**
		 * Creates video thumbnail.
		 * @protected
		 * @param {jQuery} target - The target containing the video data.
		 * @param {Object} info - The video info object.
		 * @see `fetch`
		 */
		Video.prototype.thumbnail = function (target, video) {
			var tnLink,
				icon,
				path,
				dimensions = video.width && video.height ? 'width:' + video.width + 'px;height:' + video.height + 'px;' : '',
				customTn = target.find('img'),
				srcType = 'src',
				lazyClass = '',
				settings = this._core.settings,
				create = function (path) {
					icon = '<div class="owl-video-play-icon"></div>';

					if (settings.lazyLoad) {
						tnLink = $('<div/>', {
							"class": 'owl-video-tn ' + lazyClass,
							"srcType": path
						});
					} else {
						tnLink = $('<div/>', {
							"class": "owl-video-tn",
							"style": 'opacity:1;background-image:url(' + path + ')'
						});
					}
					target.after(tnLink);
					target.after(icon);
				};

			// wrap video content into owl-video-wrapper div
			target.wrap($('<div/>', {
				"class": "owl-video-wrapper",
				"style": dimensions
			}));

			if (this._core.settings.lazyLoad) {
				srcType = 'data-src';
				lazyClass = 'owl-lazy';
			}

			// custom thumbnail
			if (customTn.length) {
				create(customTn.attr(srcType));
				customTn.remove();
				return false;
			}

			if (video.type === 'youtube') {
				path = "//img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
				create(path);
			} else if (video.type === 'vimeo') {
				$.ajax({
					type: 'GET',
					url: '//vimeo.com/api/v2/video/' + video.id + '.json',
					jsonp: 'callback',
					dataType: 'jsonp',
					success: function (data) {
						path = data[0].thumbnail_large;
						create(path);
					}
				});
			} else if (video.type === 'vzaar') {
				$.ajax({
					type: 'GET',
					url: '//vzaar.com/api/videos/' + video.id + '.json',
					jsonp: 'callback',
					dataType: 'jsonp',
					success: function (data) {
						path = data.framegrab_url;
						create(path);
					}
				});
			}
		};

		/**
		 * Stops the current video.
		 * @public
		 */
		Video.prototype.stop = function () {
			this._core.trigger('stop', null, 'video');
			this._playing.find('.owl-video-frame').remove();
			this._playing.removeClass('owl-video-playing');
			this._playing = null;
			this._core.leave('playing');
			this._core.trigger('stopped', null, 'video');
		};

		/**
		 * Starts the current video.
		 * @public
		 * @param {Event} event - The event arguments.
		 */
		Video.prototype.play = function (event) {
			var target = $(event.target),
				item = target.closest('.' + this._core.settings.itemClass),
				video = this._videos[item.attr('data-video')],
				width = video.width || '100%',
				height = video.height || this._core.$stage.height(),
				html,
				iframe;

			if (this._playing) {
				return;
			}

			this._core.enter('playing');
			this._core.trigger('play', null, 'video');

			item = this._core.items(this._core.relative(item.index()));

			this._core.reset(item.index());

			html = $('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>');
			html.attr('height', height);
			html.attr('width', width);
			if (video.type === 'youtube') {
				html.attr('src', '//www.youtube.com/embed/' + video.id + '?autoplay=1&rel=0&v=' + video.id);
			} else if (video.type === 'vimeo') {
				html.attr('src', '//player.vimeo.com/video/' + video.id + '?autoplay=1');
			} else if (video.type === 'vzaar') {
				html.attr('src', '//view.vzaar.com/' + video.id + '/player?autoplay=true');
			}

			iframe = $(html).wrap('<div class="owl-video-frame" />').insertAfter(item.find('.owl-video'));

			this._playing = item.addClass('owl-video-playing');
		};

		/**
		 * Checks whether an video is currently in full screen mode or not.
		 * @todo Bad style because looks like a readonly method but changes members.
		 * @protected
		 * @returns {Boolean}
		 */
		Video.prototype.isInFullScreen = function () {
			var element = document.fullscreenElement || document.mozFullScreenElement ||
				document.webkitFullscreenElement;

			return element && $(element).parent().hasClass('owl-video-frame');
		};

		/**
		 * Destroys the plugin.
		 */
		Video.prototype.destroy = function () {
			var handler, property;

			this._core.$element.off('click.owl.video');

			for (handler in this._handlers) {
				this._core.$element.off(handler, this._handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.Video = Video;

	})(window.Zepto || window.jQuery, window, document);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the animate plugin.
		 * @class The Navigation Plugin
		 * @param {Owl} scope - The Owl Carousel
		 */
		var Animate = function (scope) {
			this.core = scope;
			this.core.options = $.extend({}, Animate.Defaults, this.core.options);
			this.swapping = true;
			this.previous = undefined$1;
			this.next = undefined$1;

			this.handlers = {
				'change.owl.carousel': $.proxy(function (e) {
					if (e.namespace && e.property.name == 'position') {
						this.previous = this.core.current();
						this.next = e.property.value;
					}
				}, this),
				'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function (e) {
					if (e.namespace) {
						this.swapping = e.type == 'translated';
					}
				}, this),
				'translate.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
						this.swap();
					}
				}, this)
			};

			this.core.$element.on(this.handlers);
		};

		/**
		 * Default options.
		 * @public
		 */
		Animate.Defaults = {
			animateOut: false,
			animateIn: false
		};

		/**
		 * Toggles the animation classes whenever an translations starts.
		 * @protected
		 * @returns {Boolean|undefined}
		 */
		Animate.prototype.swap = function () {

			if (this.core.settings.items !== 1) {
				return;
			}

			if (!$.support.animation || !$.support.transition) {
				return;
			}

			this.core.speed(0);

			var left,
				clear = $.proxy(this.clear, this),
				previous = this.core.$stage.children().eq(this.previous),
				next = this.core.$stage.children().eq(this.next),
				incoming = this.core.settings.animateIn,
				outgoing = this.core.settings.animateOut;

			if (this.core.current() === this.previous) {
				return;
			}

			if (outgoing) {
				left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
				previous.one($.support.animation.end, clear)
					.css({
						'left': left + 'px'
					})
					.addClass('animated owl-animated-out')
					.addClass(outgoing);
			}

			if (incoming) {
				next.one($.support.animation.end, clear)
					.addClass('animated owl-animated-in')
					.addClass(incoming);
			}
		};

		Animate.prototype.clear = function (e) {
			$(e.target).css({
					'left': ''
				})
				.removeClass('animated owl-animated-out owl-animated-in')
				.removeClass(this.core.settings.animateIn)
				.removeClass(this.core.settings.animateOut);
			this.core.onTransitionEnd();
		};

		/**
		 * Destroys the plugin.
		 * @public
		 */
		Animate.prototype.destroy = function () {
			var handler, property;

			for (handler in this.handlers) {
				this.core.$element.off(handler, this.handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

	})(window.Zepto || window.jQuery);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the autoplay plugin.
		 * @class The Autoplay Plugin
		 * @param {Owl} scope - The Owl Carousel
		 */
		var Autoplay = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * The autoplay timeout id.
			 * @type {Number}
			 */
			this._call = null;

			/**
			 * Depending on the state of the plugin, this variable contains either
			 * the start time of the timer or the current timer value if it's
			 * paused. Since we start in a paused state we initialize the timer
			 * value.
			 * @type {Number}
			 */
			this._time = 0;

			/**
			 * Stores the timeout currently used.
			 * @type {Number}
			 */
			this._timeout = 0;

			/**
			 * Indicates whenever the autoplay is paused.
			 * @type {Boolean}
			 */
			this._paused = true;

			/**
			 * All event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'changed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && e.property.name === 'settings') {
						if (this._core.settings.autoplay) {
							this.play();
						} else {
							this.stop();
						}
					} else if (e.namespace && e.property.name === 'position' && this._paused) {
						// Reset the timer. This code is triggered when the position
						// of the carousel was changed through user interaction.
						this._time = 0;
					}
				}, this),
				'initialized.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.autoplay) {
						this.play();
					}
				}, this),
				'play.owl.autoplay': $.proxy(function (e, t, s) {
					if (e.namespace) {
						this.play(t, s);
					}
				}, this),
				'stop.owl.autoplay': $.proxy(function (e) {
					if (e.namespace) {
						this.stop();
					}
				}, this),
				'mouseover.owl.autoplay': $.proxy(function () {
					if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
						this.pause();
					}
				}, this),
				'mouseleave.owl.autoplay': $.proxy(function () {
					if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
						this.play();
					}
				}, this),
				'touchstart.owl.core': $.proxy(function () {
					if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
						this.pause();
					}
				}, this),
				'touchend.owl.core': $.proxy(function () {
					if (this._core.settings.autoplayHoverPause) {
						this.play();
					}
				}, this)
			};

			// register event handlers
			this._core.$element.on(this._handlers);

			// set default options
			this._core.options = $.extend({}, Autoplay.Defaults, this._core.options);
		};

		/**
		 * Default options.
		 * @public
		 */
		Autoplay.Defaults = {
			autoplay: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: false,
			autoplaySpeed: false
		};

		/**
		 * Transition to the next slide and set a timeout for the next transition.
		 * @private
		 * @param {Number} [speed] - The animation speed for the animations.
		 */
		Autoplay.prototype._next = function (speed) {
			this._call = window.setTimeout(
				$.proxy(this._next, this, speed),
				this._timeout * (Math.round(this.read() / this._timeout) + 1) - this.read()
			);

			if (this._core.is('interacting') || document.hidden) {
				return;
			}
			this._core.next(speed || this._core.settings.autoplaySpeed);
		};

		/**
		 * Reads the current timer value when the timer is playing.
		 * @public
		 */
		Autoplay.prototype.read = function () {
			return new Date().getTime() - this._time;
		};

		/**
		 * Starts the autoplay.
		 * @public
		 * @param {Number} [timeout] - The interval before the next animation starts.
		 * @param {Number} [speed] - The animation speed for the animations.
		 */
		Autoplay.prototype.play = function (timeout, speed) {
			var elapsed;

			if (!this._core.is('rotating')) {
				this._core.enter('rotating');
			}

			timeout = timeout || this._core.settings.autoplayTimeout;

			// Calculate the elapsed time since the last transition. If the carousel
			// wasn't playing this calculation will yield zero.
			elapsed = Math.min(this._time % (this._timeout || timeout), timeout);

			if (this._paused) {
				// Start the clock.
				this._time = this.read();
				this._paused = false;
			} else {
				// Clear the active timeout to allow replacement.
				window.clearTimeout(this._call);
			}

			// Adjust the origin of the timer to match the new timeout value.
			this._time += this.read() % timeout - elapsed;

			this._timeout = timeout;
			this._call = window.setTimeout($.proxy(this._next, this, speed), timeout - elapsed);
		};

		/**
		 * Stops the autoplay.
		 * @public
		 */
		Autoplay.prototype.stop = function () {
			if (this._core.is('rotating')) {
				// Reset the clock.
				this._time = 0;
				this._paused = true;

				window.clearTimeout(this._call);
				this._core.leave('rotating');
			}
		};

		/**
		 * Pauses the autoplay.
		 * @public
		 */
		Autoplay.prototype.pause = function () {
			if (this._core.is('rotating') && !this._paused) {
				// Pause the clock.
				this._time = this.read();
				this._paused = true;

				window.clearTimeout(this._call);
			}
		};

		/**
		 * Destroys the plugin.
		 */
		Autoplay.prototype.destroy = function () {
			var handler, property;

			this.stop();

			for (handler in this._handlers) {
				this._core.$element.off(handler, this._handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

	})(window.Zepto || window.jQuery, window, document);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the navigation plugin.
		 * @class The Navigation Plugin
		 * @param {Owl} carousel - The Owl Carousel.
		 */
		var Navigation = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * Indicates whether the plugin is initialized or not.
			 * @protected
			 * @type {Boolean}
			 */
			this._initialized = false;

			/**
			 * The current paging indexes.
			 * @protected
			 * @type {Array}
			 */
			this._pages = [];

			/**
			 * All DOM elements of the user interface.
			 * @protected
			 * @type {Object}
			 */
			this._controls = {};

			/**
			 * Markup for an indicator.
			 * @protected
			 * @type {Array.<String>}
			 */
			this._templates = [];

			/**
			 * The carousel element.
			 * @type {jQuery}
			 */
			this.$element = this._core.$element;

			/**
			 * Overridden methods of the carousel.
			 * @protected
			 * @type {Object}
			 */
			this._overrides = {
				next: this._core.next,
				prev: this._core.prev,
				to: this._core.to
			};

			/**
			 * All event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'prepared.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.dotsData) {
						this._templates.push('<div class="' + this._core.settings.dotClass + '">' +
							$(e.content).find('[data-dot]').addBack('[data-dot]').attr('data-dot') + '</div>');
					}
				}, this),
				'added.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.dotsData) {
						this._templates.splice(e.position, 0, this._templates.pop());
					}
				}, this),
				'remove.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.dotsData) {
						this._templates.splice(e.position, 1);
					}
				}, this),
				'changed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && e.property.name == 'position') {
						this.draw();
					}
				}, this),
				'initialized.owl.carousel': $.proxy(function (e) {
					if (e.namespace && !this._initialized) {
						this._core.trigger('initialize', null, 'navigation');
						this.initialize();
						this.update();
						this.draw();
						this._initialized = true;
						this._core.trigger('initialized', null, 'navigation');
					}
				}, this),
				'refreshed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._initialized) {
						this._core.trigger('refresh', null, 'navigation');
						this.update();
						this.draw();
						this._core.trigger('refreshed', null, 'navigation');
					}
				}, this)
			};

			// set default options
			this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

			// register event handlers
			this.$element.on(this._handlers);
		};

		/**
		 * Default options.
		 * @public
		 * @todo Rename `slideBy` to `navBy`
		 */
		Navigation.Defaults = {
			nav: false,
			navText: [
				'<span aria-label="' + 'Previous' + '">&#x2039;</span>',
				'<span aria-label="' + 'Next' + '">&#x203a;</span>'
			],
			navSpeed: false,
			navElement: 'button type="button" role="presentation"',
			navContainer: false,
			navContainerClass: 'owl-nav',
			navClass: [
				'owl-prev',
				'owl-next'
			],
			slideBy: 1,
			dotClass: 'owl-dot',
			dotsClass: 'owl-dots',
			dots: true,
			dotsEach: false,
			dotsData: false,
			dotsSpeed: false,
			dotsContainer: false
		};

		/**
		 * Initializes the layout of the plugin and extends the carousel.
		 * @protected
		 */
		Navigation.prototype.initialize = function () {
			var override,
				settings = this._core.settings;

			// create DOM structure for relative navigation
			this._controls.$relative = (settings.navContainer ? $(settings.navContainer) :
				$('<div>').addClass(settings.navContainerClass).appendTo(this.$element)).addClass('disabled');

			this._controls.$previous = $('<' + settings.navElement + '>')
				.addClass(settings.navClass[0])
				.html(settings.navText[0])
				.prependTo(this._controls.$relative)
				.on('click', $.proxy(function (e) {
					this.prev(settings.navSpeed);
				}, this));
			this._controls.$next = $('<' + settings.navElement + '>')
				.addClass(settings.navClass[1])
				.html(settings.navText[1])
				.appendTo(this._controls.$relative)
				.on('click', $.proxy(function (e) {
					this.next(settings.navSpeed);
				}, this));

			// create DOM structure for absolute navigation
			if (!settings.dotsData) {
				this._templates = [$('<button role="button">')
					.addClass(settings.dotClass)
					.append($('<span>'))
					.prop('outerHTML')
				];
			}

			this._controls.$absolute = (settings.dotsContainer ? $(settings.dotsContainer) :
				$('<div>').addClass(settings.dotsClass).appendTo(this.$element)).addClass('disabled');

			this._controls.$absolute.on('click', 'button', $.proxy(function (e) {
				var index = $(e.target).parent().is(this._controls.$absolute) ?
					$(e.target).index() : $(e.target).parent().index();

				e.preventDefault();

				this.to(index, settings.dotsSpeed);
			}, this));

			/*$el.on('focusin', function() {
				$(document).off(".carousel");

				$(document).on('keydown.carousel', function(e) {
					if(e.keyCode == 37) {
						$el.trigger('prev.owl')
					}
					if(e.keyCode == 39) {
						$el.trigger('next.owl')
					}
				});
			});*/

			// override public methods of the carousel
			for (override in this._overrides) {
				this._core[override] = $.proxy(this[override], this);
			}
		};

		/**
		 * Destroys the plugin.
		 * @protected
		 */
		Navigation.prototype.destroy = function () {
			var handler, control, property, override, settings;
			settings = this._core.settings;

			for (handler in this._handlers) {
				this.$element.off(handler, this._handlers[handler]);
			}
			for (control in this._controls) {
				if (control === '$relative' && settings.navContainer) {
					this._controls[control].html('');
				} else {
					this._controls[control].remove();
				}
			}
			for (override in this.overides) {
				this._core[override] = this._overrides[override];
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		/**
		 * Updates the internal state.
		 * @protected
		 */
		Navigation.prototype.update = function () {
			var i, j, k,
				lower = this._core.clones().length / 2,
				upper = lower + this._core.items().length,
				maximum = this._core.maximum(true),
				settings = this._core.settings,
				size = settings.center || settings.autoWidth || settings.dotsData ?
				1 : settings.dotsEach || settings.items;

			if (settings.slideBy !== 'page') {
				settings.slideBy = Math.min(settings.slideBy, settings.items);
			}

			if (settings.dots || settings.slideBy == 'page') {
				this._pages = [];

				for (i = lower, j = 0, k = 0; i < upper; i++) {
					if (j >= size || j === 0) {
						this._pages.push({
							start: Math.min(maximum, i - lower),
							end: i - lower + size - 1
						});
						if (Math.min(maximum, i - lower) === maximum) {
							break;
						}
						j = 0, ++k;
					}
					j += this._core.mergers(this._core.relative(i));
				}
			}
		};

		/**
		 * Draws the user interface.
		 * @todo The option `dotsData` wont work.
		 * @protected
		 */
		Navigation.prototype.draw = function () {
			var difference,
				settings = this._core.settings,
				disabled = this._core.items().length <= settings.items,
				index = this._core.relative(this._core.current()),
				loop = settings.loop || settings.rewind;

			this._controls.$relative.toggleClass('disabled', !settings.nav || disabled);

			if (settings.nav) {
				this._controls.$previous.toggleClass('disabled', !loop && index <= this._core.minimum(true));
				this._controls.$next.toggleClass('disabled', !loop && index >= this._core.maximum(true));
			}

			this._controls.$absolute.toggleClass('disabled', !settings.dots || disabled);

			if (settings.dots) {
				difference = this._pages.length - this._controls.$absolute.children().length;

				if (settings.dotsData && difference !== 0) {
					this._controls.$absolute.html(this._templates.join(''));
				} else if (difference > 0) {
					this._controls.$absolute.append(new Array(difference + 1).join(this._templates[0]));
				} else if (difference < 0) {
					this._controls.$absolute.children().slice(difference).remove();
				}

				this._controls.$absolute.find('.active').removeClass('active');
				this._controls.$absolute.children().eq($.inArray(this.current(), this._pages)).addClass('active');
			}
		};

		/**
		 * Extends event data.
		 * @protected
		 * @param {Event} event - The event object which gets thrown.
		 */
		Navigation.prototype.onTrigger = function (event) {
			var settings = this._core.settings;

			event.page = {
				index: $.inArray(this.current(), this._pages),
				count: this._pages.length,
				size: settings && (settings.center || settings.autoWidth || settings.dotsData ?
					1 : settings.dotsEach || settings.items)
			};
		};

		/**
		 * Gets the current page position of the carousel.
		 * @protected
		 * @returns {Number}
		 */
		Navigation.prototype.current = function () {
			var current = this._core.relative(this._core.current());
			return $.grep(this._pages, $.proxy(function (page, index) {
				return page.start <= current && page.end >= current;
			}, this)).pop();
		};

		/**
		 * Gets the current succesor/predecessor position.
		 * @protected
		 * @returns {Number}
		 */
		Navigation.prototype.getPosition = function (successor) {
			var position, length,
				settings = this._core.settings;

			if (settings.slideBy == 'page') {
				position = $.inArray(this.current(), this._pages);
				length = this._pages.length;
				successor ? ++position : --position;
				position = this._pages[((position % length) + length) % length].start;
			} else {
				position = this._core.relative(this._core.current());
				length = this._core.items().length;
				successor ? position += settings.slideBy : position -= settings.slideBy;
			}

			return position;
		};

		/**
		 * Slides to the next item or page.
		 * @public
		 * @param {Number} [speed=false] - The time in milliseconds for the transition.
		 */
		Navigation.prototype.next = function (speed) {
			$.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
		};

		/**
		 * Slides to the previous item or page.
		 * @public
		 * @param {Number} [speed=false] - The time in milliseconds for the transition.
		 */
		Navigation.prototype.prev = function (speed) {
			$.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
		};

		/**
		 * Slides to the specified item or page.
		 * @public
		 * @param {Number} position - The position of the item or page.
		 * @param {Number} [speed] - The time in milliseconds for the transition.
		 * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
		 */
		Navigation.prototype.to = function (position, speed, standard) {
			var length;

			if (!standard && this._pages.length) {
				length = this._pages.length;
				$.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
			} else {
				$.proxy(this._overrides.to, this._core)(position, speed);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

	})(window.Zepto || window.jQuery);
	(function ($, window, document, undefined$1) {

		/**
		 * Creates the hash plugin.
		 * @class The Hash Plugin
		 * @param {Owl} carousel - The Owl Carousel
		 */
		var Hash = function (carousel) {
			/**
			 * Reference to the core.
			 * @protected
			 * @type {Owl}
			 */
			this._core = carousel;

			/**
			 * Hash index for the items.
			 * @protected
			 * @type {Object}
			 */
			this._hashes = {};

			/**
			 * The carousel element.
			 * @type {jQuery}
			 */
			this.$element = this._core.$element;

			/**
			 * All event handlers.
			 * @protected
			 * @type {Object}
			 */
			this._handlers = {
				'initialized.owl.carousel': $.proxy(function (e) {
					if (e.namespace && this._core.settings.startPosition === 'URLHash') {
						$(window).trigger('hashchange.owl.navigation');
					}
				}, this),
				'prepared.owl.carousel': $.proxy(function (e) {
					if (e.namespace) {
						var hash = $(e.content).find('[data-hash]').addBack('[data-hash]').attr('data-hash');

						if (!hash) {
							return;
						}

						this._hashes[hash] = e.content;
					}
				}, this),
				'changed.owl.carousel': $.proxy(function (e) {
					if (e.namespace && e.property.name === 'position') {
						var current = this._core.items(this._core.relative(this._core.current())),
							hash = $.map(this._hashes, function (item, hash) {
								return item === current ? hash : null;
							}).join();

						if (!hash || window.location.hash.slice(1) === hash) {
							return;
						}

						window.location.hash = hash;
					}
				}, this)
			};

			// set default options
			this._core.options = $.extend({}, Hash.Defaults, this._core.options);

			// register the event handlers
			this.$element.on(this._handlers);

			// register event listener for hash navigation
			$(window).on('hashchange.owl.navigation', $.proxy(function (e) {
				var hash = window.location.hash.substring(1),
					items = this._core.$stage.children(),
					position = this._hashes[hash] && items.index(this._hashes[hash]);

				if (position === undefined$1 || position === this._core.current()) {
					return;
				}

				this._core.to(this._core.relative(position), false, true);
			}, this));
		};

		/**
		 * Default options.
		 * @public
		 */
		Hash.Defaults = {
			URLhashListener: false
		};

		/**
		 * Destroys the plugin.
		 * @public
		 */
		Hash.prototype.destroy = function () {
			var handler, property;

			$(window).off('hashchange.owl.navigation');

			for (handler in this._handlers) {
				this._core.$element.off(handler, this._handlers[handler]);
			}
			for (property in Object.getOwnPropertyNames(this)) {
				typeof this[property] != 'function' && (this[property] = null);
			}
		};

		$.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

	})(window.Zepto || window.jQuery, window);
	(function ($, window, document, undefined$1) {

		var style = $('<support>').get(0).style,
			prefixes = 'Webkit Moz O ms'.split(' '),
			events = {
				transition: {
					end: {
						WebkitTransition: 'webkitTransitionEnd',
						MozTransition: 'transitionend',
						OTransition: 'oTransitionEnd',
						transition: 'transitionend'
					}
				},
				animation: {
					end: {
						WebkitAnimation: 'webkitAnimationEnd',
						MozAnimation: 'animationend',
						OAnimation: 'oAnimationEnd',
						animation: 'animationend'
					}
				}
			},
			tests = {
				csstransforms: function () {
					return !!test('transform');
				},
				csstransforms3d: function () {
					return !!test('perspective');
				},
				csstransitions: function () {
					return !!test('transition');
				},
				cssanimations: function () {
					return !!test('animation');
				}
			};

		function test(property, prefixed) {
			var result = false,
				upper = property.charAt(0).toUpperCase() + property.slice(1);

			$.each((property + ' ' + prefixes.join(upper + ' ') + upper).split(' '), function (i, property) {
				if (style[property] !== undefined$1) {
					result = prefixed ? property : true;
					return false;
				}
			});

			return result;
		}

		function prefixed(property) {
			return test(property, true);
		}

		if (tests.csstransitions()) {
			/* jshint -W053 */
			$.support.transition = new String(prefixed('transition'));
			$.support.transition.end = events.transition.end[$.support.transition];
		}

		if (tests.cssanimations()) {
			/* jshint -W053 */
			$.support.animation = new String(prefixed('animation'));
			$.support.animation.end = events.animation.end[$.support.animation];
		}

		if (tests.csstransforms()) {
			/* jshint -W053 */
			$.support.transform = new String(prefixed('transform'));
			$.support.transform3d = tests.csstransforms3d();
		}

	})(window.Zepto || window.jQuery);

	$(document).ready(function () {
		$("#toggle-menu").click(function () {
			if ($(window).width() < 768) {
				$(".menu.mobile").toggleClass("show");

				if (!$(".menu.mobile").hasClass("show")) {
					$(".menu.mobile .menu-dropdown").slideUp();
					$('body').css({
						overflow: 'auto'
					});
				} else {
					$('body').css({
						overflow: 'hidden'
					});
					$(this).next(".menu-dropdown").slideToggle();
				}
			}
		});
		$(".menu-dropdown-link.dropdown").click(function () {
			if ($(window).width() < 768) {
				$(this).next(".menu-dropdown").slideDown();
			}
		});
		$(".menu-back").click(function () {
			$(this).parent(".menu-dropdown").slideUp();
		});
		$(".search-show").click(function () {
			$(".top-nav").addClass("search-open");
		});
		$(".search-close").click(function () {
			$(".top-nav").removeClass("search-open");
		});
		$(".autocomplete-placeholder").click(function () {
			$(".autocomplete-dropdown").hide();
			$('.processor-typing').hide();
			$('.autocomplete-placeholder').show();
			$(".autocomplete").removeClass("autocomplete-open");

			$(this).hide();
			$(this).prev().show().focus();
			$(this).next().show();
			$(this).parent().addClass("autocomplete-open");
		});
		// $(".autocomplete-input").focusout(function () {
		//   $(this).hide();
		//   $(this).next().next(".autocomplete-dropdown").hide();
		//   $(this).next().show();
		//   $(this).parent().removeClass("autocomplete-open");
		// });
		$("#slayder").owlCarousel({
			margin: 30,
			items: 3,
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1200: {
					items: 3
				}
			}
		});
		$('.footer-title').click(function () {
			$(this).toggleClass('active');
			$(this).next('.toggle').slideToggle();
		});
		$('.content-nav a').click(function () {
			$('.content-nav a').removeClass('active');
			$(this).addClass('active');
		});
	});

	$("a.to_scroll").click(function () {
		$("html, body").animate({
			scrollTop: $($(this).attr("href")).offset().top + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
		return false;
	});

}());