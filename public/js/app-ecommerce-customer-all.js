"use strict";
$(function () {
  let t, s, n;
  n = (
    isDarkStyle
      ? ((t = config.colors_dark.borderColor),
        (s = config.colors_dark.bodyBg),
        config.colors_dark)
      : ((t = config.colors.borderColor),
        (s = config.colors.bodyBg),
        config.colors)
  ).headingColor;
  var e = $(".datatables-customers"),
    a = $(".select2");
  a.length &&
    ((a = a),
    select2Focus(a),
    a
      .wrap('<div class="position-relative"></div>')
      .select2({ placeholder: "United States ", dropdownParent: a.parent() })),
    e.length &&
      (e.DataTable({
        ajax: assetsPath + "json/ecommerce-customer-all.json",
        columns: [
          { data: "" },
          { data: "id" },
          { data: "customer" },
          { data: "customer_id" },
          { data: "country" },
          { data: "order" },
          { data: "total_spent" },
        ],
        columnDefs: [
          {
            className: "control",
            searchable: !1,
            orderable: !1,
            responsivePriority: 2,
            targets: 0,
            render: function (e, t, s, n) {
              return "";
            },
          },
          {
            targets: 1,
            orderable: !1,
            searchable: !1,
            responsivePriority: 3,
            checkboxes: !0,
            checkboxes: {
              selectAllRender:
                '<input type="checkbox" class="form-check-input">',
            },
            render: function () {
              return '<input type="checkbox" class="dt-checkboxes form-check-input">';
            },
          },
          {
            targets: 2,
            responsivePriority: 1,
            render: function (e, t, s, n) {
              var a = s.customer,
                o = s.email,
                r = s.image;
              return (
                '<div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper me-3"><div class="avatar avatar-sm">' +
                (r
                  ? '<img src="' +
                    assetsPath +
                    "img/avatars/" +
                    r +
                    '" alt="Avatar" class="rounded-circle">'
                  : '<span class="avatar-initial rounded-circle bg-label-' +
                    [
                      "success",
                      "danger",
                      "warning",
                      "info",
                      "dark",
                      "primary",
                      "secondary",
                    ][Math.floor(6 * Math.random())] +
                    '">' +
                    (r = (
                      ((r = (a = s.customer).match(/\b\w/g) || []).shift() ||
                        "") + (r.pop() || "")
                    ).toUpperCase()) +
                    "</span>") +
                '</div></div><div class="d-flex flex-column"><a href="app-ecommerce-customer-details-overview.html"><span class="text-heading fw-medium text-truncate">' +
                a +
                '</span></a><small class="text-truncate">' +
                o +
                "</small></div></div>"
              );
            },
          },
          {
            targets: 3,
            render: function (e, t, s, n) {
              return '<span class="text-heading">#' + s.customer_id + "</span>";
            },
          },
          {
            targets: 4,
            render: function (e, t, s, n) {
              var a = s.country,
                s = s.country_code;
              return (
                '<div class="d-flex justify-content-start align-items-center customer-country"><div>' +
                (s
                  ? `<i class ="fis fi fi-${s} rounded-circle me-2 fs-3"></i>`
                  : '<i class ="fis fi fi-xx rounded-circle me-2 fs-3"></i>') +
                "</div><div><span>" +
                a +
                "</span></div></div>"
              );
            },
          },
          {
            targets: 5,
            render: function (e, t, s, n) {
              return "<span>" + s.order + "</span>";
            },
          },
          {
            targets: 6,
            render: function (e, t, s, n) {
              return '<h6 class="mb-0">' + s.total_spent + "</h6>";
            },
          },
        ],
        order: [[2, "desc"]],
        dom: '<"card-header d-flex rounded-0 flex-wrap py-md-0"<"me-5 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0 gap-3"lB>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          sLengthMenu: "_MENU_",
          search: "",
          searchPlaceholder: "Search Order",
        },
        buttons: [
          {
            extend: "collection",
            className:
              "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
            text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [
              {
                extend: "print",
                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, s) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("customer-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
                customize: function (e) {
                  $(e.document.body)
                    .css("color", n)
                    .css("border-color", t)
                    .css("background-color", s),
                    $(e.document.body)
                      .find("table")
                      .addClass("compact")
                      .css("color", "inherit")
                      .css("border-color", "inherit")
                      .css("background-color", "inherit");
                },
              },
              {
                extend: "csv",
                text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, s) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("customer-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "excel",
                text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, s) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("customer-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "pdf",
                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, s) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("customer-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
              {
                extend: "copy",
                text: '<i class="mdi mdi-content-copy me-1"></i>Copy',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (e, t, s) {
                      var n;
                      return e.length <= 0
                        ? e
                        : ((e = $.parseHTML(e)),
                          (n = ""),
                          $.each(e, function (e, t) {
                            void 0 !== t.classList &&
                            t.classList.contains("customer-name")
                              ? (n += t.lastChild.firstChild.textContent)
                              : void 0 === t.innerText
                              ? (n += t.textContent)
                              : (n += t.innerText);
                          }),
                          n);
                    },
                  },
                },
              },
            ],
          },
          {
            text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add Customer</span>',
            className: "add-new btn btn-primary ms-n1 waves-effect waves-light",
            attr: {
              "data-bs-toggle": "offcanvas",
              "data-bs-target": "#offcanvasUserAdd",
            },
          },
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (e) {
                return "Details of " + e.data().customer;
              },
            }),
            type: "column",
            renderer: function (e, t, s) {
              s = $.map(s, function (e, t) {
                return "" !== e.title
                  ? '<tr data-dt-row="' +
                      e.rowIndex +
                      '" data-dt-column="' +
                      e.columnIndex +
                      '"><td>' +
                      e.title +
                      ":</td> <td>" +
                      e.data +
                      "</td></tr>"
                  : "";
              }).join("");
              return !!s && $('<table class="table"/><tbody />').append(s);
            },
          },
        },
      }),
      $(".dataTables_length").addClass("mt-0 mt-md-3"),
      $(".dt-action-buttons").addClass("pt-0"),
      $(".dataTables_filter input").addClass("ms-0"),
      $(".dt-buttons").addClass("d-flex flex-wrap")),
    setTimeout(() => {
      $(".dataTables_filter .form-control").removeClass("form-control-sm"),
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
}),
  (function () {
    var e = document.querySelectorAll(".phone-mask"),
      t = document.getElementById("eCommerceCustomerAddForm");
    e &&
      e.forEach(function (e) {
        new Cleave(e, { phone: !0, phoneRegionCode: "US" });
      }),
      FormValidation.formValidation(t, {
        fields: {
          customerName: {
            validators: { notEmpty: { message: "Please enter fullname " } },
          },
          customerEmail: {
            validators: {
              notEmpty: { message: "Please enter your email" },
              emailAddress: {
                message: "The value is not a valid email address",
              },
            },
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: "",
            rowSelector: function (e, t) {
              return ".mb-4";
            },
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          autoFocus: new FormValidation.plugins.AutoFocus(),
        },
      });
  })();
