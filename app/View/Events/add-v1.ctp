<?php
$options = array(
    'type'          => 'file',
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
);
?>

<section class="list" xmlns="http://www.w3.org/1999/html">
    <!--Menu-->
    <?=$this->element('menu', array("heading" => "Create New Event"));?>

    <? echo $this->Form->create('Event', $options); ?>
    <fieldset class="controlGroup">
        <h4>Event Details</h4>
        <div class="control-group row">
            <div class="span4">
                <? echo $this->Form->input('name', array('label' => false, 'div' => false,'placeholder' => 'Event Name', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <? echo $this->Form->file('img_thumb', array('class' => 'span5')); ?>
                <a data-content="Image Dimensions: 300 x 250  Image Type: jpg/gif"
                           data-placement="bottom" rel="popover" class="pop" href="#"
                           data-original-title="Image Requirements">
                            <i class="icon-question-sign"></i>
                        </a>
            </div>

        </div>
        <div class="control-group row">
            <div class="span4">
                <? echo $this->Form->input('geo_address', array('label' => false, 'div' => false,'placeholder' => 'Geo Address', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <? echo $this->Form->input('gpslat', array('div' => false,'placeholder' => 'Latitude', 'class' => 'span2')); ?>
                <? echo $this->Form->input('gpslong', array('div' => false,'placeholder' => 'Longitude', 'class' => 'span2')); ?>
            </div>
        </div>
        <div class="control-group row">
            <div class="span4">
                <div class="control-group">
                    <input name="data[Event][date_start]" type="date" placeholder="Start Date" class="span4" />
                </div>
                <div class="control-group">
                    <input name="data[Event][date_end]" type="date" placeholder="End Date" class="span4" />
                </div>
            </div>
            <div class="span7">
                <?= $this->Form->textarea('shortdescription_line_1', array('placeholder' => 'Description Line 1 (60 character Limit)', 'class' => 'span7','row' => 1 ));?>
                <?= $this->Form->textarea('shortdescription_line_2', array('placeholder' => 'Description Line 2 (60 character Limit)', 'class' => 'span7','row' => 1 ));?>
            </div>


        </div>
        <div class="control- row">
            <div class="span4">
                <div class="control-group">
                    <?=$this->Form->input('eventtype', array('options' => array('pixta-play' => 'PIXTA Play','National' => 'National' ,'location-based' => 'Location Based'), 'default' => 'pixta-play'));
                    ?>
                </div>
                <div class="control-group">
                    <? echo $this->Form->input('company_id'); ?>
                </div>
         </div>

        </div>

    </fieldset>
    <fieldset class="controlGroup">
        <h4>Custom Event Page Details</h4>
        <div class="control-group row">
            <div class="span4">
                <? echo $this->Form->input('public_event_name', array('label' => false, 'div' => false,'placeholder' => 'Public Event Name', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <? echo $this->Form->file('public_logo', array('class' => 'span5')); ?>
                <a data-content="Image Dimensions: 176 x 196  Image Type: jpg/gif"
                   data-placement="bottom" rel="popover" class="pop" href="#"
                   data-original-title="Image Requirements">
                    <i class="icon-question-sign"></i>
                </a>
            </div>
        </div>

            <div class="control-group row">
                <div class="span4">
                <input name="data[Event][public_phone_number]" type="text" placeholder="Phone Number" class="span4" />
                </div>
            </div>
            <div class="control-group row">
                <div class="span4">
                <input name="data[Event][public_email]" type="text" placeholder="Email" class="span4" />
                </div>
            </div>
            <div class="control-group row">
                <div class="span4">
                <input name="data[Event][public_address]" type="text" placeholder="Address" class="span4" />
                </div>
            </div>
            <div class="control-group row">
                <div class="span4">
                <?= $this->Form->textarea('public_description', array('placeholder' => 'Public Description', 'class' => 'span7','row' => 4 ));?>
                </div>
            </div>


    </fieldset>
    <fieldset class="controlGroup">
        <h4>Overlay Images <span>(maximum 5)</span></h4>
        <a data-content="Image Dimensions: 640 x 640  Image Type: png"
           data-placement="bottom" rel="popover" class="pop" href="#"
           data-original-title="Image Requirements">
            <i class="icon-question-sign"></i>
        </a>
        <? for ($i=1; $i<=5; $i++) { ?>
        <? echo $this->Form->file("img_overlay_$i"); ?><br/>
        <? } ?>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>Auto Moderate</h4>

        <div class="switch pull-right">
            <input type="radio" checked="checked" id="auto_moderate_on" value="1" name="data[Event][auto_moderate]" class="switch-input">
            <label class="switch-label switch-label-off" for="auto_moderate_on">On</label>
            <input type="radio" id="auto_moderate_off" value="0" name="data[Event][auto_moderate]" class="switch-input">
            <label class="switch-label switch-label-on" for="auto_moderate_off">Off</label>
            <span class="switch-selection"></span>
        </div>

    </fieldset>
    <fieldset class="controlGroup controls-row">
        <h4>Social Media</h4>
        <?= $this->Form->input('facebook_msg', array('placeholder' => 'Facebook Message: maxlength 420 chars','label' => false, 'div' => false, 'class' => 'span6')); ?>
        <?= $this->Form->input('facebook_url', array('placeholder' => 'Facebook Link','label' => false, 'div' => false, 'class' => 'span5')); ?>
        <?= $this->Form->input('twitter_msg', array('placeholder' => 'Twitter Message: maxlength 120 chars','label' => false, 'div' => false, 'class' => 'span6')); ?>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>HTML Before Upload (a link to your mobile friendly web page to appear BEFORE sharing)</h4>
        <?= $this->Form->textarea('html_before', array('placeholder' => 'HTML Before', 'class' => 'span6','row' => 2 ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="html_before_on" value="1" name="data[Event][html_before_on]" class="switch-input">
            <label class="switch-label switch-label-off" for="html_before_on">On</label>
            <input type="radio" id="html_before_off" value="0" name="data[Event][html_before_on]" class="switch-input">
            <label class="switch-label switch-label-on" for="html_before_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>HTML After Upload (a link to your mobile friendly web page to appear AFTER sharing)</h4>
        <?= $this->Form->textarea('html_after', array('placeholder' => 'HTML After', 'class' => 'span6', 'row' => 2 ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="html_after_on" value="1" name="data[Event][html_after_on]" class="switch-input">
            <label class="switch-label switch-label-off" for="html_after_on">On</label>
            <input type="radio" id="html_after_off" value="0" name="data[Event][html_after_on]" class="switch-input">
            <label class="switch-label switch-label-on" for="html_after_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>Terms & Conditions (paste in your Terms and Conditions here)</h4>
        <?= $this->Form->textarea('t_c', array('placeholder' => 'Terms and Conditions', 'class' => 'span6', 'row' => 2 ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="t_c_on" value="1" name="data[Event][t_c_on]" class="switch-input">
            <label class="switch-label switch-label-off" for="t_c_on">On</label>
            <input type="radio" id="t_c_off" value="0" name="data[Event][t_c_off]" class="switch-input">
            <label class="switch-label switch-label-on" for="t_c_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>Event Status</h4>
        <? echo $this->Form->select('stage', array('options' => array('' => '---Select Stage---','Scheduled' => 'Scheduled', 'Draft' => 'Draft'))); ?>
    </fieldset>
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Add',)); ?>

</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#EventGeoAddress').change(function(){
            var geocoder = new google.maps.Geocoder();

            var address = $('#EventGeoAddress').val();
            var location = '';
            geocoder.geocode( { 'address': address}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK)
                {
                    $('#EventGpslat').val(results[0].geometry.location.lat());
                    $('#EventGpslong').val(results[0].geometry.location.lng());
                }
                else {
                    alert('Address is not right. Please use right adrees to convert.');
                }
            });
        });

        $('#EventHtmlBefore').change(function(){
            if(!url_validation($('#EventHtmlBefore').val())){
                alert('Please add http:// with the url');
                $('#EventHtmlBefore').val('');
            }
        });
        $('#EventHtmlAfter').change(function(){
            if(!url_validation($('#EventHtmlAfter').val())){
                alert('Please add http:// with the url');
                $('#EventHtmlAfter').val('');
            }
        });


        function url_validation(url){
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                return true;
            }
            return false;
        }
    });

</script>