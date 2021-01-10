"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Full Name': "الاسم بالكامل",
            'Created': "تاريخ اﻹنشاء",
            "Email": "البريد اﻹلكتروني",
            "Role": "الصلاحية",
            "Salary": "الراتب",
            "Show Info": "عرض البيانات",
            "Job Number": "الرقم الوظيفي",
            "Actions": "الاجراءات",
            "Not Activated": "غير فعال",
            "Activated": "فعال",
            "Account Status": "حالة الحساب",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Yes, Delete!': "نعم امسح!",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'Edit Info': "تعديل البيانات",
            'Delete': "مسح",
        }
    };

    var locator = new KTLocator(messages);

    // basic demo
    var demo = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/dashboard/employees',
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: false,
                serverSorting: true,
                saveState: {
                    cookie: true,
                    webstorage: true,
                },
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
                delay: 400,
            }, rows: {
                afterTemplate: function (row, data, index) {
                    row.find('.delete-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to delete this item?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Delete!"),
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                            showCancelButton: true,
                            cancelButtonText: locator.__("No, cancel"),
                            cancelButtonClass: "btn btn-sm btn-bold btn-default"
                        }).then(function (result) {
                            if (result.value) {
                                swal.fire({
                                    title: locator.__('Loading...'),
                                    onOpen: function () {
                                        swal.showLoading();
                                    }
                                });
                                $.ajax({
                                    method: 'DELETE',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/employees/' + data.id,
                                    error: function (err) {
                                        if (err.hasOwnProperty('responseJSON')) {
                                            if (err.responseJSON.hasOwnProperty('message')) {
                                                swal.fire({
                                                    title: locator.__('Error!'),
                                                    text: locator.__(err.responseJSON.message),
                                                    type: 'error'
                                                });
                                            }
                                        }
                                        console.log(err);
                                    }
                                }).done(function (res) {
                                    swal.fire({
                                        title: locator.__('Deleted!'),
                                        text: locator.__(res.message),
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: locator.__("OK"),
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                    datatable.reload();
                                });
                            }
                        });
                    });
                    row.find('.print-item').on('click', function () {
                        var mywindow = window.open('', 'PRINT', 'height=600,width=800');
                        var content = '\
                                <style>\
                                    @media print {\
                                        @page {\
                                            size: 30mm 21mm;\
                                            margin: 0;\
                                            padding: 0;\
                                        }\
                                        html, body {\
                                            position: relative;\
                                            width: 100%;\
                                            height: 100%;\
                                            max-width: 100%;\
                                            max-height: 100%;\
                                            margin: 0;\
                                            padding: 0;\
                                        }\
                                        svg {\
                                            width: 100%;\
                                            height: 100%;\
                                            max-width: 100%;\
                                            max-height: 100%;\
                                        }\
                                    }\
                                </style>'
                        content += '<svg id="code128" jsbarcode-value="123456789012" onload="print()"></svg>'
                        content += '<script src="https://cdn.jsdelivr.net/jsbarcode/3.3.16/barcodes/JsBarcode.code128.min.js"></script>'
                        content += '<script>JsBarcode("#code128", "' + data.barcode + '", { format: "CODE128", displayValue: true});</script>';
                        mywindow.document.write(content);
                        mywindow.document.close(); // necessary for IE >= 10
                        mywindow.focus(); // necessary for IE >= 10*/

                        // mywindow.print();
                        // mywindow.close();
                    });
                }
            },

            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                }, {
                    field: 'name_in_arabic',
                    title: locator.__('Full Name'),
                    textAlign: 'center',
                    template:function (row){
                        return  employeeName(row);
                    }
                }, {
                    field: 'job_number',
                    title: locator.__('Job Number'),
                    textAlign: 'center',
                }, {
                    field: 'salary',
                    title: locator.__('Salary'),
                    textAlign: 'center',
                }
                , {
                    field: 'roles',
                    title: locator.__('Role'),
                    textAlign: 'center',
                    template:function (row){
                        return row.roles[0].name_arabic
                    }
                }
                , {
                    field: 'bar_code',
                    title: locator.__('Barcode'),
                    template: function(raw) {
                        return '<a class="h5 print-item" href="#"><i class="flaticon-reply"></i>Print ID</a>';
                    },
                }
                , {
                    field: 'email_verified_at',
                    title: locator.__('Account Status'),
                    textAlign: 'center',
                    template: function(row) {
                        var status = {
                            'title': (!row.email_verified_at)?locator.__('Not Activated'):locator.__('Activated'),
                            'class':(!row.email_verified_at)?locator.__(' kt-badge--danger'):locator.__(' kt-badge--success')
                        };
                        return '<span class="kt-badge ' + status.class + ' kt-badge--inline kt-badge--pill">' + status.title + '</span>';
                    },
                },{
                    field: 'created_at',
                    title: locator.__('Created'),
                    textAlign: 'center',

                }, {
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template:function (row){
                        return '\
		                  <div class="dropdown">\
		                      <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
		                          <i class="la la-ellipsis-h"></i>\
		                      </a>\
		                      <div class="dropdown-menu dropdown-menu-right">\
		                          <a class="dropdown-item" href="/dashboard/employees/' + row.id + '/edit"><i class="la la-pencil-square-o"></i>' + locator.__('Edit Info') + '</a>\
		                          <a class="dropdown-item" href="/dashboard/employees/' + row.id + '"><i class="la la-eye"></i>' + locator.__('Show Info') + '</a>\
		                      </div>\
		                  </div>\
                        ';
                    }
                }],
        });

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });
        $('#kt_form_status,#kt_form_type').selectpicker();

    };

    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableLocalSortDemo.init();
});
