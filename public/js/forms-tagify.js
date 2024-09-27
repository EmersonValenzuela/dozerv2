"use strict";
!(function () {
    var e = document.querySelector("#TagifyCustomListSuggestion"),
        t = ["A# .NET", "A# (Axiom)", "A-0 System", "A+"],
        a = new Tagify(e, {
            whitelist: t,
            maxTags: 30,
            dropdown: {
                maxItems: 50,
                classname: "",
                enabled: 0,
                closeOnSelect: !1,
            },
        });
})();
