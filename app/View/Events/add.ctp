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
    <?=$this->element('menu', array("heading" => "Create New Event"));?>

    <? echo $this->Form->create('Event', $options); ?>
    <fieldset class="controlGroup">
        <div class="control-group row">
            <div class="span4"> <!--#TODO generate it via CakePHP-->
                <select name="what" id="what">
                    <option value="some value">Polite in public 1</option>
                    <option value="some value">Polite in public 2</option>
                    <option value="some value">Polite in public 3</option>
                </select>
            </div>
            <div class="span7">
                <div class="switch span3">
                    <input type="radio" class="switch-input" name="data[Event][whatever]" value="whatever_on" id="whatever_on" checked="checked">
                    <label for="whatever_on" class="switch-label switch-label-off">On</label>
                    <input type="radio" class="switch-input" name="data[Event][whatever]" value="whatever_off" id="whatever_off">
                    <label for="whatever_off" class="switch-label switch-label-on">Off</label>
                    <span class="switch-selection"></span>
                </div>
                <div class="switch span3" style="margin-left:100px;">
                    <input type="radio" class="switch-input" name="data[Event][whatever1]" value="whatever1_on" id="whatever1_on" checked="checked">
                    <label for="whatever1_on" class="switch-label switch-label-off">Dedicated</label>
                    <input type="radio" class="switch-input" name="data[Event][whatever1]" value="whatever1_off" id="whatever1_off">
                    <label for="whatever1_off" class="switch-label switch-label-on">Generic</label>
                    <span class="switch-selection"></span>
                </div>
            </div>
        </div>

    </fieldset>
    <fieldset class="controlGroup">
        <h4>Event Details</h4>
        <div class="control-group row">
            <div class="span4">
                <? echo $this->Form->input('name', array('label' => false, 'div' => false,'placeholder' => 'Event Name', 'class' => 'span4')); ?>
            </div>
            <div class="span7">
                <? echo $this->Form->file('img_thumb', array('class' => 'span5')); ?>
            </div>
        </div>
        <div class="control-group">
            <? echo $this->Form->input('gpslat', array('div' => false,'placeholder' => 'Latitude', 'class' => 'span2')); ?>
            <? echo $this->Form->input('gpslong', array('div' => false,'placeholder' => 'Longitude', 'class' => 'span2')); ?>
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
                <?= $this->Form->textarea('description', array('placeholder' => 'Description (60 character Limit)', 'class' => 'span7','row' => 2 ));?>
            </div>


        </div>
        <div class="control-group">
            <?php $eventtype = array('generic' => 'generic', 'location-based' => 'location-based');
            echo $this->Form->input('eventtype', array('options' => $eventtype, 'default' => 'generic'));
            ?>
            <? echo $this->Form->input('company_id'); ?>
        </div>

    </fieldset>
    <fieldset class="controlGroup">
        <h4>Overlay Images <span>(maximum 5)</span></h4>
        <? echo $this->Form->file('img_overlay_1'); ?>
        <a data-content="- Image Dimentions: <br>- Image Type: JPG, GIF."
           data-placement="bottom" rel="popover" class="pop" href="#"
           data-original-title="Image Requirements">
            <i class="icon-question-sign"></i>
        </a>
        <a href="javascript:void(0);" id="add_more_image" class="pull-right"></a>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>Filters</h4>
        <? echo $this->Form->select('stage', array('' => '---Select Stage---','Running' => 'Running', 'Scheduled' => 'Scheduled', 'Draft' => 'Draft')); ?>

        <div class="switch pull-right">
            <input type="radio" checked="checked" id="filter_on" value="filter_on" name="data[Event][filter]" class="switch-input">
            <label class="switch-label switch-label-off" for="filter_on">On</label>
            <input type="radio" id="filter_off" value="filter_off" name="data[Event][filter]" class="switch-input">
            <label class="switch-label switch-label-on" for="filter_off">Off</label>
            <span class="switch-selection"></span>
        </div>

    </fieldset>
    <fieldset class="controlGroup controls-row">
        <h4>Social Media</h4>
        <?= $this->Form->input('facebook_msg', array('placeholder' => 'Facebook Message','label' => false, 'div' => false, 'class' => 'span6')); ?>
        <?= $this->Form->input('facebook_url', array('placeholder' => 'Facebook Link','label' => false, 'div' => false, 'class' => 'span5')); ?>
        <?= $this->Form->input('twitter_msg', array('placeholder' => 'Twitter Message','label' => false, 'div' => false, 'class' => 'span6')); ?>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>HTML Before Upload</h4>
        <?= $this->Form->textarea('html_before', array('placeholder' => 'HTML Before', 'class' => 'span6','row' => 2 ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="html_before_on" value="html_before_on" name="data[Event][html_before]" class="switch-input">
            <label class="switch-label switch-label-off" for="html_before_on">On</label>
            <input type="radio" id="html_before_off" value="html_before_off" name="data[Event][html_before]" class="switch-input">
            <label class="switch-label switch-label-on" for="html_before_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>HTML After Upload</h4>
        <?= $this->Form->textarea('html_after', array('placeholder' => 'HTML After', 'class' => 'span6', 'row' => 2 ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="html_after_on" value="html_after_on" name="data[Event][html_after]" class="switch-input">
            <label class="switch-label switch-label-off" for="html_after_on">On</label>
            <input type="radio" id="html_after_off" value="html_after_off" name="data[Event][html_after]" class="switch-input">
            <label class="switch-label switch-label-on" for="html_after_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Add',)); ?>

</section>