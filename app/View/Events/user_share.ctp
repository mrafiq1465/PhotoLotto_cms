<div id="fb_area_boarder">
    <form name="post_to_face" method="GET" action="/events/share_from_form/" id="fbpost">
        <img src='<?php echo "http://appevent.s3.amazonaws.com/" . $Photo ?>' id="img_for_post">

        <div id="info_text">
            <div>
                <p id="heading_text_fb">Share this photo on Facebook</p>
            </div>
            
            <div>
                <p id="body_text_fb">Add your custom status update and click 'share' to post to your Facebook Timeline Instantly:</p>
            </div>
            
        </div>
        <textarea rows="5" cols="35" name="message_to_fb" class="message_to_fb" id="message"><?php echo $FbMsg ?></textarea>
        <input type="hidden" name="photo" value="<?php echo $Photo ?>" />
        <input type="hidden" name="event_email_id" value="<?php echo $EmailID ?>" />
        <input type="hidden" name="email_config_id" value="<?php echo $EventEmailId ?>" />
        <div>
            <p><a href="#" class="share_fb"></a></p>
        </div>

    </form>
</div>
<div class="clear">&nbsp;</div>

<script>
$(document).ready(function () 
{ 
    $(".pull-right").css('display','none')
});   
</script>
