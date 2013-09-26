<div id="inside">
    
        <div class="pop-close">&nbsp;</div>

    <form name="post_to_face" method="GET" action="/events/share_from_form/" id="fbpost" >
        <h3>Post to Facebook</h3>
        <img src='<?php echo "http://appevent.s3.amazonaws.com/" . $Photo ?>' style="width: 200px; float: left;">

        <div style="float: left;margin-left: 10px;">
            <h style="margin-top:-15px;font-size: 16px">Post this message to your Facebook Timeline</p>
            <div>
                <textarea rows="5" cols="35" name="message_to_fb" id="message" style="width: 500px;margin-bottom: 20px;height: 115px;"></textarea>
                <input type="hidden" name="photo" value="<?php echo $Photo ?>" />
                <input type="hidden" name="event_email_id" value="<?php echo $EmailID ?>" />
                <input type="hidden" name="email_config_id" value="<?php echo $EventEmailId ?>" />
                <p><input type="submit" value="share now" /></p>
            </div>
        </div>
    </form>

<div class="clear">&nbsp;</div>

<script>
$(document).ready(function () 
{ 
    $(".pull-right").css('display','none')
});   
</script>
