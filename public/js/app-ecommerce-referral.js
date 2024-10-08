"use strict";
$(function () {
  let t, a, s;
  s = (
    isDarkStyle
      ? ((t = config.colors_dark.borderColor),
        (a = config.colors_dark.bodyBg),
        config.colors_dark)
      : ((t = config.colors.borderColor),
        (a = config.colors.bodyBg),
        config.colors)
  ).headingColor;
  var e = $(".datatables-referral"),
    n = {
      1: { title: "Paid", class: "bg-label-success" },
      2: { title: "Unpaid", class: "bg-label-warning" },
      3: { title: "Rejected", class: "bg-label-danger" },
    };
  e.length &&
    (e.DataTable({
      ajax: assetsPath + "json/ecommerce-referral.json",
      columns: [
        { data: "" },
        { data: "id" },
        { data: "user" },
        { data: "referred_id" },
        { data: "status" },
        { data: "value" },
        { data: "earning" },
      ],
      columnDefs: [
        {
          className: "control",
          searchable: !1,
          orderable: !1,
          responsivePriority: 2,
          targets: 0,
          render: function (e, t, a, s) {
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
            selectAllRender: '<input type="checkbox" class="form-check-input">',
          },
          render: function () {
            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          },
        },
        {
          targets: 2,
          responsivePriority: 1,
          render: function (e, t, a, s) {
            var n = a.user,
              r = a.email,
              o = a.avatar;
            return (
              '<div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper me-3"><div class="avatar avatar-sm">' +
              (o
                ? '<img src="' +
                  assetsPath +
                  "img/avatars/" +
                  o +
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
                  (o = (
                    ((o = (n = a.user).match(/\b\w/g) || []).shift() || "") +
                    (o.pop() || "")
                  ).toUpperCase()) +
                  "</span>") +
              '</div></div><div class="d-flex flex-column"><a href="app-ecommerce-customer-details-overview.html"><span class="text-heading fw-medium text-truncate">' +
              n +
              '</span></a><small class="text-nowrap">' +
              r +
              "</small></div></div>"
            );
          },
        },
        {
          targets: 3,
          render: function (e, t, a, s) {
            return '<span class="text-heading">' + a.referred_id + "</span>";
          },
        },
        {
          targets: 4,
          render: function (e, t, a, s) {
            a = a.status;
            return (
              '<span class="badge rounded-pill ' +
              n[a].class +
              '" text-capitalized>' +
              n[a].title +
              "</span>"
            );
          },
        },
        {
          targets: 5,
          render: function (e, t, a, s) {
            return '<span  class="text-heading">' + a.value + "</span>";
          },
        },
        {
          targets: 6,
          render: function (e, t, a, s) {
            return '<span  class="text-heading">' + a.earning + "</span > ";
          },
        },
      ],
      order: [[2, "asc"]],
      dom: '<"card-header d-flex flex-column flex-sm-row pb-md-0 align-items-start align-items-sm-center pt-md-2"<"head-label"><"d-flex align-items-sm-center justify-content-end mt-2 mt-sm-0 gap-3"l<"dt-action-buttons"B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      language: { sLengthMenu: "_MENU_" },
      buttons: [
        {
          className: "btn btn-primary",
          text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Export</span>',

        },
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (e) {
              return "Details of " + e.data().user;
            },
          }),
          type: "column",
          renderer: function (e, t, a) {
            a = $.map(a, function (e, t) {
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
            return !!a && $('<table class="table"/><tbody />').append(a);
          },
        },
      },
    }),
    $("div.head-label").html(
      '<h5 class="card-title text-nowrap mb-2 mb-sm-0">Referred users</h5>'
    ),
    $(".dataTables_length").addClass("mt-0 mt-md-3"),
    $(".dt-action-buttons").addClass("pt-0")),
    setTimeout(() => {
      $(".dataTables_filter .form-control").removeClass("form-control-sm"),
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
