
$(document).ready(function() {

    $(".forgot_password").click(function(e) {
        alert('test');
        //$("#password").overlay().load();
    });
/*
    $("#password").overlay({
        top: 260,
        mask: {
            color: '#fff',
            loadSpeed: 200,
            opacity: 0.5
        },
        closeOnClick: false,
        load: true
    });
*/
    $('#send_password').click(function(e){

        var email = $('#email_password').val();

        $.ajax({
            type:"POST",
            url:'/users/send_password',
            data:{'data[email]':email },
            dataType:"json",
            success:function (json) {
                if (json.status == 'success') {

                }
            }
        });
    });

    $(":date").dateinput({
        format: 'yyyy-mm-dd',	// the format displayed for the user
        selectors: true,             	// whether month/year dropdowns are shown
        min: 0,                    // min selectable day (100 days backwards)
        max: 100,                    	// max selectable day (100 days onwards)
        offset: [10, 20],            	// tweak the position of the calendar
        speed: 'fast',               	// calendar reveal speed
        firstDay: 1                  	// which day starts a week. 0 = sunday, 1 = monday etc..
    });

});