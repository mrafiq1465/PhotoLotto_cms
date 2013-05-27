
$(document).ready(function() {

    $('.blacklist').change(function(e){
        var id = $(this).attr('id');
        var blacklist = 0;
        if($(this).attr('checked') == 'checked') {
            blacklist =1;
        }
        $.ajax({
            type:"POST",
            url:'/events/photo_update',
            data:{'data[id]':id, 'data[blacklist]':blacklist},
            dataType:"json",
            success:function (json) {
                if (json.status == 'success') {
                }
            }
        });
    });

    var $formContainer = $("#form-container");

    $(".blacklistToggle", $formContainer).on('click', function () {
        // which blacklistToggle radio button is selected
        var blacklistOption = $("[name=blacklistToggle]:checked", $formContainer).val(),
            checkAll = !!(blacklistOption == "1"),
            eventId = $(this).data('event-id');

        //update the option via ajax
        $.ajax({
            type     : "POST",
            url      : '/events/photo_update_all',
            data     : {'data[event_id]' : eventId, 'data[blacklist]' : blacklistOption},
            dataType : "json",
            success  : function (json) {
                if (json.response == true) {
                    $('.blacklist').prop('checked', checkAll);
                }
            }
        });
    });

    $('.blacklist_all').change(function(e){
        var id = $(this).attr('id');
        var blacklist = 0;
        if($(this).attr('checked') == 'checked') {

            $('.approve_all').prop('checked', false);
            $('.blacklist').prop('checked', true);
            blacklist =1;

            $.ajax({
                type:"POST",
                url:'/events/photo_update_all',
                data:{'data[event_id]':id, 'data[blacklist]':blacklist},
                dataType:"json",
                success:function (json) {
                    if (json.status == 'success') {
                    }
                }
            });
        }
        else {
            $('.blacklist').prop('checked', false);
        }

    });

    $('.approve_all').change(function(e){
        var id = $(this).attr('id');
        var blacklist = 0;

        if($(this).attr('checked') == 'checked') {
            $('.blacklist_all').prop('checked', false);
            $('.blacklist').prop('checked', false);
            blacklist =0;
             $.ajax({
                 type:"POST",
                 url:'/events/photo_update_all',
                 data:{'data[event_id]':id, 'data[blacklist]':blacklist},
                 dataType:"json",
                 success:function (json) {
                     if (json.status == 'success') {
                        }
                     }
              });
        }
    });

    $('.icon-circle-arrow-up').click(function(e){
        var id = $(this).attr('id');

        $.ajax({
           type:"POST",
                url:'/events/rank_update',
                data:{'data[id]':id, 'data[rank]':'up'},
                dataType:"json",
                success:function (json) {
                    window.location.href= "/events";
                }
            });
    });

    $('.icon-circle-arrow-down').click(function(e){
        var id = $(this).attr('id');

        $.ajax({
            type:"POST",
            url:'/events/rank_update',
            data:{'data[id]':id, 'data[rank]':'down'},
            dataType:"json",
            success:function (json) {
                window.location.href= "/events";
            }
        });
    });

    $('#resetPassword').click(function(e){
        var email = $('#email').val();
        $.ajax({
            type:"POST",
            url:'/users/send_password',
            data:{'data[email]':email },
            dataType:"json",
            success:function (json) {
                if (json.success !== undefined) {
                    $('#loginModal .modal-body .error').text(json.success).show();
                } else {
                    $('#loginModal .modal-body .error').text(json.error).show();
                }
            }
        });

    });

    /*$(":date").dateinput({
        format: 'yyyy-mm-dd',	// the format displayed for the user
        selectors: true,             	// whether month/year dropdowns are shown
        min: -100,                    // min selectable day (100 days backwards)
        max: 2000,                    	// max selectable day (100 days onwards)
        offset: [-10, 0],            	// tweak the position of the calendar
        speed: 'fast',               	// calendar reveal speed
        firstDay: 1                  	// which day starts a week. 0 = sunday, 1 = monday etc..
    });*/

    var num = $('[id^=EventImgOverlay]').length;
    if(num == 5) {
        $('#add_more_image').remove();
    }

    $('.del-btn').each(function(){
        $(this).click(function(){
            var ans = confirm('Do you want to delete ' + $(this).attr('item_name') + ' from list?');
            if(!ans){
                return false;
            }
        });
    });

    $('.delete_image').each(function(){
        $(this).click(function(){
            var dataName = $(this).attr('data-name');
            $("img[data-name="+ dataName + "]").remove();
            $(this).before('<input type="hidden" name=data[Event]['+ dataName+ '_delete]" value="delete" />');
            var overlayNumber = dataName.substr(12);
            $('#EventImgOverlay'+ overlayNumber).show();
            $(this).remove();
        });
    })

    //Popover control
    var $form = $("#EventAddForm, #EventEditForm");
    $('a.pop', $form).click(function(){
        return false;
    });

    $('a.pop', $form).mouseenter(function(){
        $(this).popover('show');
    });

    $('a.pop', $form).mouseout(function(){
        $(this).popover('hide');
    });

    $('select:not(#EventEventtype)', $form).addClass('span4');

    $('#event-menu a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    //tooltips on event add and edit
    if ($('.icon-query').length) {
        $('.icon-query').qtip({
            content: {
                text: function (api) {
                    return $(this).siblings().html();
                }
            },
            style: {
                classes: 'myCustomClass qtip-tipsy qtip-shadow',
                tip: {
                    corner: true,
                    width: 10,
                    height: 10,
                    offset: 10 // Give it 5px offset from the side of the tooltip
                }
            },
            position: {
                my: 'top right',  // Position my top left...
                at: 'bottom center' // at the bottom right of...
            }
        });
    }
});

var validateElement = {
    isValid: function (element) {
        var isValid = true;
        var $element = $(element);
        var id = $element.attr('id');
        var name = $element.attr('name');
        var value = $element.val();
        var corners = ['left center', 'right center'];

        // <input> uses type attribute as written in tag
        // <textarea> has intrinsic type of 'textarea'
        // <select> has intrinsic type of 'select-one' or 'select-multiple'
        var type = $element[0].type.toLowerCase();

        switch (type) {
            case 'text':
            case 'textarea':
            case 'password':
                if (value.length == 0 ||
                    value.replace(/\s/g, '').length == 0) {
                    isValid = false;
                    if ($element.attr('id') === 'EventShortdescriptionLine2') {
                        isValid = true;
                    }
                }
                break;
            case 'select-one':
            case 'select-multiple':
                if (!value) {
                    isValid = false;
                }
                break;
            case 'checkbox':
            case 'radio':
                if ($('input[name="' + name +
                    '"]:checked').length == 0) {
                    isValid = false;
                }
                break;
        } // close switch()

        if (!isValid) {
            $element.qtip('destroy');
            var errorTxt = "This field is required";
            // Apply the tooltip only if it isn't valid
            $element.qtip({
                overwrite: false,
                content: errorTxt,
                position: {
                    my: corners[ 0 ],
                    at: corners[ 1],
                    viewport: $(window)
                },
                show: {
                    event: false,
                    ready: true
                },
                hide: {
                    target: $('#event-menu li:not(.active)'),
                    event: 'click'
                },
                style: {
                    classes: 'qtip-red' // Make it red... the classic error colour!
                }
            })

                // If we have a tooltip on this element already, just update its content
                .qtip('option', 'content.text', errorTxt);
        }

        // If the error is empty, remove the qTip
        else {
            $element.qtip('destroy');
        }/*
        // instead of $(selector).method we are going to use $(selector)[method]
        // choose the right method, but choose wisely
        var method = isValid ? 'removeClass' : 'addClass';
        // show error message [addClass]
        // hide error message [removeClass]
        $('#errorMessage_' + name)[method]('showErrorMessage');
        if (type == 'checkbox' || type == 'radio') {
            // if radio button or checkbox, find all inputs with the same name
            $('input[name="' + name + '"]').each(function () {
                // update each input elements <label> tag, (this==<input>)
                $('label[for="' + this.id + '"]')[method]('error');
            });
        } else {
            // all other elements just update one <label>
            $('label[for="' + id + '"]')[method]('error');
        }*/
        // after initial validation, allow elements to re-validate on change
        $element
            .off('change.isValid')
            .on('change.isValid', function () {
                validateElement.isValid(this);
            });
        return isValid;
    }
};