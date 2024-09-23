!(function (e, t) {
  if ("object" == typeof exports && "object" == typeof module)
    module.exports = t();
  else if ("function" == typeof define && define.amd) define([], t);
  else {
    var o = t();
    for (var r in o) ("object" == typeof exports ? exports : e)[r] = o[r];
  }
})(self, function () {
  return (function () {
    var e = {
        9367: function (e) {
          e.exports = (function () {
            var e = new Map();
            function t(t) {
              if (t && t.nodeName && "TEXTAREA" === t.nodeName && !e.has(t)) {
                var o,
                  r = null,
                  n = window.getComputedStyle(t),
                  i =
                    ((o = t.value),
                    function () {
                      a({
                        testForHeightReduction:
                          "" === o || !t.value.startsWith(o),
                        restoreTextAlign: null,
                      }),
                        (o = t.value);
                    }),
                  l = function (o) {
                    t.removeEventListener("autosize:destroy", l),
                      t.removeEventListener("autosize:update", s),
                      t.removeEventListener("input", i),
                      window.removeEventListener("resize", s),
                      Object.keys(o).forEach(function (e) {
                        return (t.style[e] = o[e]);
                      }),
                      e.delete(t);
                  }.bind(t, {
                    height: t.style.height,
                    resize: t.style.resize,
                    textAlign: t.style.textAlign,
                    overflowY: t.style.overflowY,
                    overflowX: t.style.overflowX,
                    wordWrap: t.style.wordWrap,
                  });
                t.addEventListener("autosize:destroy", l),
                  t.addEventListener("autosize:update", s),
                  t.addEventListener("input", i),
                  window.addEventListener("resize", s),
                  (t.style.overflowX = "hidden"),
                  (t.style.wordWrap = "break-word"),
                  e.set(t, { destroy: l, update: s }),
                  s();
              }
              function a(e) {
                var o,
                  i,
                  l = e.restoreTextAlign,
                  s = void 0 === l ? null : l,
                  u = e.testForHeightReduction,
                  d = void 0 === u || u,
                  f = n.overflowY;
                if (
                  0 !== t.scrollHeight &&
                  ("vertical" === n.resize
                    ? (t.style.resize = "none")
                    : "both" === n.resize && (t.style.resize = "horizontal"),
                  d &&
                    ((o = (function (e) {
                      for (
                        var t = [];
                        e && e.parentNode && e.parentNode instanceof Element;

                      )
                        e.parentNode.scrollTop &&
                          t.push([e.parentNode, e.parentNode.scrollTop]),
                          (e = e.parentNode);
                      return function () {
                        return t.forEach(function (e) {
                          var t = e[0],
                            o = e[1];
                          (t.style.scrollBehavior = "auto"),
                            (t.scrollTop = o),
                            (t.style.scrollBehavior = null);
                        });
                      };
                    })(t)),
                    (t.style.height = "")),
                  (i =
                    "content-box" === n.boxSizing
                      ? t.scrollHeight -
                        (parseFloat(n.paddingTop) + parseFloat(n.paddingBottom))
                      : t.scrollHeight +
                        parseFloat(n.borderTopWidth) +
                        parseFloat(n.borderBottomWidth)),
                  "none" !== n.maxHeight && i > parseFloat(n.maxHeight)
                    ? ("hidden" === n.overflowY &&
                        (t.style.overflow = "scroll"),
                      (i = parseFloat(n.maxHeight)))
                    : "hidden" !== n.overflowY && (t.style.overflow = "hidden"),
                  (t.style.height = i + "px"),
                  s && (t.style.textAlign = s),
                  o && o(),
                  r !== i &&
                    (t.dispatchEvent(
                      new Event("autosize:resized", { bubbles: !0 })
                    ),
                    (r = i)),
                  f !== n.overflow && !s)
                ) {
                  var c = n.textAlign;
                  "hidden" === n.overflow &&
                    (t.style.textAlign = "start" === c ? "end" : "start"),
                    a({ restoreTextAlign: c, testForHeightReduction: !0 });
                }
              }
              function s() {
                a({ testForHeightReduction: !0, restoreTextAlign: null });
              }
            }
            function o(t) {
              var o = e.get(t);
              o && o.destroy();
            }
            function r(t) {
              var o = e.get(t);
              o && o.update();
            }
            var n = null;
            return (
              "undefined" == typeof window
                ? (((n = function (e) {
                    return e;
                  }).destroy = function (e) {
                    return e;
                  }),
                  (n.update = function (e) {
                    return e;
                  }))
                : (((n = function (e, o) {
                    return (
                      e &&
                        Array.prototype.forEach.call(
                          e.length ? e : [e],
                          function (e) {
                            return t(e);
                          }
                        ),
                      e
                    );
                  }).destroy = function (e) {
                    return (
                      e && Array.prototype.forEach.call(e.length ? e : [e], o),
                      e
                    );
                  }),
                  (n.update = function (e) {
                    return (
                      e && Array.prototype.forEach.call(e.length ? e : [e], r),
                      e
                    );
                  })),
              n
            );
          })();
        },
      },
      t = {};
    function o(r) {
      var n = t[r];
      if (void 0 !== n) return n.exports;
      var i = (t[r] = { exports: {} });
      return e[r].call(i.exports, i, i.exports, o), i.exports;
    }
    (o.n = function (e) {
      var t =
        e && e.__esModule
          ? function () {
              return e.default;
            }
          : function () {
              return e;
            };
      return o.d(t, { a: t }), t;
    }),
      (o.d = function (e, t) {
        for (var r in t)
          o.o(t, r) &&
            !o.o(e, r) &&
            Object.defineProperty(e, r, { enumerable: !0, get: t[r] });
      }),
      (o.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }),
      (o.r = function (e) {
        "undefined" != typeof Symbol &&
          Symbol.toStringTag &&
          Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }),
          Object.defineProperty(e, "__esModule", { value: !0 });
      });
    var r = {};
    return (
      (function () {
        "use strict";
        o.r(r),
          o.d(r, {
            autosize: function () {
              return e;
            },
          });
        var e = o(9367);
      })(),
      r
    );
  })();
});
