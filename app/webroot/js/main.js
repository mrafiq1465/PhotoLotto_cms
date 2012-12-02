
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

});