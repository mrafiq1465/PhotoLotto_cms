<?php
$options = array(
    'type'          => 'file',
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
);
?>

<section class="list">
    <!--Menu-->
    <?=$this->element('menu', array("heading" => "Edit Event"));?>

    <? echo $this->Form->create('Event', $options); ?>
    <fieldset class="controlGroup">
        <h4>Event Details</h4>
        <div class="control-group row">

            <div class="span4">
                <h5>Event Name</h5>
                <? echo $this->Form->input('name', array('label' => false, 'div' => false,'placeholder' => 'Event Name', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <? if (!empty($this->data['Event']['img_thumb'])) { ?>
                <img src="<?=$this->data['Event']['img_thumb']?>" data-name="img_thumb" style="max-height: 100px;">
                <a href="javascript:void(0);" data-name="img_thumb" class="delete_image"></a><br>
                <? } ?>
                <? echo $this->Form->file('img_thumb', array('class' => 'span5')); ?>
                <a data-content="Image Dimensions: 300 x 250  Image Type: jpg/gif"
                   data-placement="bottom" rel="popover" class="pop" href="#"
                   data-original-title="Image Requirements">
                    <i class="icon-question-sign"></i>
                </a>
            </div>
        </div>
        <div class="control-group">
            <h5>Latitude</h5>
            <? echo $this->Form->input('gpslat', array('div' => false,'placeholder' => 'Latitude', 'class' => '')); ?>
            <h5>Longitude</h5>
            <? echo $this->Form->input('gpslong', array('div' => false,'placeholder' => 'Longitude', 'class' => '')); ?>
        </div>
        <div class="control-group row">
            <div class="span4">
                <div class="control-group">
                    <h5>Start Date</h5>
                    <input name="data[Event][date_start]" value="<?=$this->data['Event']['date_start']?>" type="date" placeholder="Start Date" class="span4" />
                </div>
                <div class="control-group">
                    <h5>End Date</h5>
                    <input name="data[Event][date_end]" value="<?=$this->data['Event']['date_end']?>" type="date" placeholder="End Date" class="span4" />
                </div>
            </div>
            <div class="span7">
                <h5>Description Line 1 (60 character Limit)</h5>
                <?= $this->Form->textarea('shortdescription_line_1', array('placeholder' => 'Description Line 1 (60 character Limit)', 'class' => 'span7','row' => 1 ));?>
                <h5>Description Line 2 (60 character Limit)</h5>
                <?= $this->Form->textarea('shortdescription_line_2', array('placeholder' => 'Description Line 2 (60 character Limit)', 'class' => 'span7','row' => 1 ));?>
            </div>
        </div>
        <div class="control- row">
            <div class="span4">
                <div class="control-group">
                    <h5>Event Type</h5>
                    <?=$this->Form->input('eventtype', array('options' => array('generic' => 'Generic', 'location-based' => 'Location-based'), 'default' => 'generic'));
                    ?>
                </div>
                <div class="control-group">
                   <h5>Company Name</h5>
                    <? echo $this->Form->input('company_id'); ?>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>Custom Event Page Details</h4>
        <div class="control-group row">
            <div class="span4">
                <h5>Public Event Name</h5>
                <? echo $this->Form->input('public_event_name', array('label' => false, 'div' => false,'placeholder' => 'Public Event Name', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <h5>Public Event Logo</h5>
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
                <h5>Phone Number</h5>
                <? echo $this->Form->input('public_phone_number', array('div' => false,'placeholder' => 'Phone Number', 'class' => 'span4')); ?>
            </div>
            </div>
            <div class="control-group row">
                <div class="span4">
                <h5>Email</h5>
                    <? echo $this->Form->input('public_email', array('div' => false,'placeholder' => 'Email', 'class' => 'span4')); ?>
                </div>
                </div>
                <div class="control-group row">
                    <div class="span4">
                <h5>Address</h5>
                        <? echo $this->Form->input('public_address', array('div' => false,'placeholder' => 'Addressr', 'class' => 'span4')); ?>
                    </div>
            </div>
                    <div class="control-group row">
                        <div class="span4">
                <h5>Description</h5>
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
        <? for ($i = 1; $i <= 5; $i++) { ?>
            <? if (!empty($this->data['Event']["img_overlay_$i"])) { ?>
                <img src="<?=$this->data['Event']["img_overlay_$i"]?>" data-name="<?="img_overlay_$i"?>"
                     style="max-height: 100px;">
                <a href="javascript:void(0);" data-name="<?="img_overlay_$i"?>" class="delete_image"></a>
                <? echo $this->Form->file("img_overlay_$i", array('style' => 'display:none;')); ?><br>
            <? } else {?>
            <? echo $this->Form->file("img_overlay_$i"); ?><br>
            <? } ?>
        <? } ?>
        <a href="javascript:void(0);" id="add_more_image" class="pull-right"></a>
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
        <? echo $this->Form->select('stage', array('' => '---Select Status---', 'Scheduled' => 'Scheduled', 'Draft' => 'Draft')); ?>
    </fieldset>
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Update',)); ?>

</section>
