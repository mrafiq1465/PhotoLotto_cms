<table cellpadding="0" cellspacing="0" background="<?php echo $image_bg; ?>" style="background:#000000 url('<?php echo $image_bg; ?>') ;max-width:650px;padding: 0 20px;">
    <tr><td>
        <div style="max-width:650px;text-align:center;">
            <a href="<?php echo $image_header_href; ?>"><img src="<?php echo $image_header; ?>" alt="header"></a>
        </div>
        <div style="float:left;width:290px;">
            <img src="<?php echo $image_columnA; ?>" alt="PIXTA" width="290" height="290" style="display: block;margin: 0;padding: 0;">
            <a href="<?php echo $fb_share; ?>&new=6" style="margin: 0;padding: 0;color: #2BA6CB;"><img alt="Share on Facebook" src="http://www.pixta.com.au/img/email_image/def-fb-share.png" style="display: block;width:290px;"></a>
            <a href="<?php echo $host.'/events/trace_share/'.$event_email_id.'/?media=tw&share_url='.$tw_share. '&image_url='.$share_url; ?>" style="margin: 0;padding: 0;color: #2BA6CB;"><img alt="Share on Twitter" src="http://www.pixta.com.au/img/email_image/def-tw-share.png" style="display: block;width:290px;"></a>
        </div>
        <div style="float:left;width:300px;">
            <?php echo $image_columnB; ?>
        </div>
        <div style="clear:both;display:block;"></div>
        <div style="max-width:600px;text-align:center;">
            <a href="<?php echo $image_footer_href; ?>"><img src="<?php echo $image_footer; ?>" alt="footer"></a>
        </div>
        <div style="clear:both;display:block;height:50px;"></div>
        </td></tr>
</table>