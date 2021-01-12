$(function (){
    let violation_select = $("select[name=violation_id]");
    let minutesLate = $("#minutes_late");
    let absenceDays = $("#absence_days");

    getType(violation_select.val());
    violation_select.change(function (){
        let violation_id = violation_select.val();
        getType(violation_id);
    });

    function getType(violation_id) {
        if(violation_select.val() != null && violation_select.val() !== ''){
            $.ajax({
                url: '/dashboard/violations/' + violation_id + '/additions',
                success: function (data){
                    switch (data.additions){
                        case 'minutes_deduc': // lateness
                            minutesLate.fadeIn();
                            minutesLate.prop('required', true);
                            absenceDays.fadeOut();
                            break;
                        case 'leave_days': // leave work
                            absenceDays.fadeIn();
                            absenceDays.prop('required', true);
                            minutesLate.fadeOut();
                            break;
                        default :
                            absenceDays.fadeOut();
                            minutesLate.fadeOut();
                            absenceDays.prop('required', false);
                            minutesLate.prop('required', false);
                            break;
                    }
                },
            });

        }
    }
});
