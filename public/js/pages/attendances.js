"use strict";

// Class definition
var KTContactsAdd = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;


    let messages = {
        'ar': {
            "please fill the required data":"الرجاء مليء الحقول المطلوبة",
            "The operation has been done successfully !":"لقد تمت العملية بنجاح !",
            "You have been already record your attendance today":"لقد تمت عملية تسجيل حضورك وانصرافك اليوم بالفعل",
        }
    };

    let locator = new KTLocator(messages);

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_contacts_add', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                name_arabic: {
                    required: true
                },

                name_english: {
                    required: true
                },
                from_date: {
                    required: true,
                    date:true
                },
                to_date: {
                    required: true,
                    date:true
                },
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": locator.__("please fill the required data"),
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function(response) {
                        KTApp.unprogress(btn);
                        //KTApp.unblock(formEl);
                        if(response.status === false){
                            swal.fire({
                                "title": "",
                                "text": locator.__(response.message),
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else {
                            swal.fire({
                                "title": "",
                                "text": locator.__("The operation has been done successfully !"),
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }

                    }
                });
            }
        });
    }

    var initAvatar = function() {
        avatar = new KTAvatar('kt_contacts_add_avatar');
    }

    return {
        // public functions
        init: function() {
            formEl = $('#kt_contacts_add_form');

            initWizard();
            initValidation();
            initSubmit();
            initAvatar();
        }
    };
}();

jQuery(document).ready(function() {
    var timeDisplay = $("#time");
    function refreshTime() {
        var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Riyadh"});
        var formattedString = dateString.replace(", ", " - ");
        timeDisplay.val(formattedString);
    }
    setInterval(refreshTime, 1000);
    // $('.kt-selectpicker').selectpicker();
    var messages = {
        'ar': {
            'Check in': "تسجيل حضور",
            'Check out': "تسجيل انصراف",
            'Attendance and leave have been recorded': "لقد تمت عملية تسجيل حضورك وانصرافك",
        }
    };
    var locator = new KTLocator(messages);
    let select_employee = $("select[name='employee_id']");
    let operation_show = $("input[name='operation_show']");
    let operation = $("input[name='operation']");
    select_employee.change(function() {
        let id = select_employee.val();
        attendanceStatus(id);
    });
    /*employees*/
    $('#kt_select2_1, #kt_select2_1_validate').select2({
        placeholder: locator.__('Choose'),
        allowClear: true
    });

    function attendanceStatus (id){
        if(id != null){
            $.ajax({
                method: "get",
                url: "/dashboard/attendances/check/" + id,
                success:function(data){
                    operation.val('');
                    operation.val(data.value);
                    operation_show.val(locator.__(data.value));
                }
            })
        }
    }
    KTContactsAdd.init();
});
