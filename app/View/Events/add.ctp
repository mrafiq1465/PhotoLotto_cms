<?php
$options = array(
    'type'          => 'file',
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
);
?>
<style type="text/css">
    #EventAddForm > .control-group {
        padding: 10px 20px;
            text-align: right;
    }
    .switch {
      position: relative;
      margin: -10px auto 20px;
      height: 26px;
      width: 120px;
      background: rgba(0, 0, 0, 0.25);
      border-radius: 3px;
      -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
    }
    textarea + .switch {
        margin-top: 10px;
    }

    .switch-label {
      position: relative;
      z-index: 2;
      float: left;
      width: 58px;
      line-height: 26px;
      font-size: 11px;
      color: rgba(255, 255, 255, 1);
      text-align: center;
      text-shadow: 0 1px 1px rgba(0, 0, 0, 0.45);
      cursor: pointer;
    }
    .switch-label:active {
      font-weight: bold;
    }

    .switch-label-off {
      padding-left: 2px;
    }

    .switch-label-on {
      padding-right: 2px;
    }

    /*
     * Note: using adjacent or general sibling selectors combined with
     *       pseudo classes doesn't work in Safari 5.0 and Chrome 12.
     *       See this article for more info and a potential fix:
     *       http://css-tricks.com/webkit-sibling-bug/
     */
    .switch-input {
      display: none;
    }
    .switch-input:checked + .switch-label {
      font-weight: bold;
      color: rgba(0, 0, 0, 0.65);
      text-shadow: 0 1px rgba(255, 255, 255, 0.25);
      -webkit-transition: 0.15s ease-out;
      -moz-transition: 0.15s ease-out;
      -o-transition: 0.15s ease-out;
      transition: 0.15s ease-out;
    }
    .switch-input:checked + .switch-label-on ~ .switch-selection {
      left: 60px;
      /* Note: left: 50% doesn't transition in WebKit */
    }

    .switch-selection {
      display: block;
      position: absolute;
      z-index: 1;
      top: 2px;
      left: 2px;
      width: 58px;
      height: 22px;
      background: #65bd63;
      border-radius: 3px;
      background-image: -webkit-linear-gradient(top, #fff, #eee);
      background-image: -moz-linear-gradient(top, #fff, #eee);
      background-image: -o-linear-gradient(top, #fff, #eee);
      background-image: linear-gradient(to bottom, #fff, #eee);
      -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
      box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
      -webkit-transition: left 0.15s ease-out;
      -moz-transition: left 0.15s ease-out;
      -o-transition: left 0.15s ease-out;
      transition: left 0.15s ease-out;
    }
    .switch-blue .switch-selection {
      background: #3aa2d0;
      background-image: -webkit-linear-gradient(top, #4fc9ee, #3aa2d0);
      background-image: -moz-linear-gradient(top, #4fc9ee, #3aa2d0);
      background-image: -o-linear-gradient(top, #4fc9ee, #3aa2d0);
      background-image: linear-gradient(to bottom, #4fc9ee, #3aa2d0);
    }
    .switch-yellow .switch-selection {
      background: #c4bb61;
      background-image: -webkit-linear-gradient(top, #e0dd94, #c4bb61);
      background-image: -moz-linear-gradient(top, #e0dd94, #c4bb61);
      background-image: -o-linear-gradient(top, #e0dd94, #c4bb61);
      background-image: linear-gradient(to bottom, #e0dd94, #c4bb61);
    }
</style>
<section class="list">
    <!--Menu-->
    <?=$this->element('menu', array("heading" => "Create New Event"));?>

    <? echo $this->Form->create('Event', $options); ?>
    <fieldset class="controlGroup">

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
                <?= $this->Form->textarea('description', array('placeholder' => 'Description (60 character Limit)', 'class' => 'span7' ));?>
            </div>
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

        <div class="switch pull-right">
            <input type="radio" checked="checked" id="filter_on" value="filter_on" name="data[Event][filter]" class="switch-input">
            <label class="switch-label switch-label-off" for="filter_on">On</label>
            <input type="radio" id="filter_off" value="filter_off" name="data[Event][filter]" class="switch-input">
            <label class="switch-label switch-label-on" for="filter_off">Off</label>
            <span class="switch-selection"></span>
        </div>

    </fieldset>
    <fieldset class="controlGroup controls-row">
        <h4>Facebook</h4>
        <?= $this->Form->input('facebook_msg', array('placeholder' => 'Message Text','label' => false, 'div' => false, 'class' => 'span6')); ?>
        <?= $this->Form->input('facebook_url', array('placeholder' => 'Link','label' => false, 'div' => false, 'class' => 'span5')); ?>
    </fieldset>
    <fieldset class="controlGroup">
        <h4>HTML Before Upload</h4>
        <?= $this->Form->textarea('html_before', array('placeholder' => 'HTML Before', 'class' => 'span6' ));?>
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
        <?= $this->Form->textarea('html_after', array('placeholder' => 'HTML After', 'class' => 'span6' ));?>
        <div class="switch pull-right">
            <input type="radio" checked="checked" id="html_after_on" value="html_after_on" name="data[Event][html_after]" class="switch-input">
            <label class="switch-label switch-label-off" for="html_after_on">On</label>
            <input type="radio" id="html_after_off" value="html_after_off" name="data[Event][html_after]" class="switch-input">
            <label class="switch-label switch-label-on" for="html_after_off">Off</label>
            <span class="switch-selection"></span>
        </div>
    </fieldset>
    <!--
        <? echo $this->Form->input('name', array('label' => 'Name')); ?>
        <?php $eventtype = array('generic' => 'generic', 'location-based' => 'location-based');
        echo $this->Form->input('eventtype', array('options' => $eventtype, 'default' => 'generic'));
        ?>
        <? echo $this->Form->input('company_id'); ?>
        <? echo $this->Form->input('shortdescription', array('label' => 'Short Description')); ?>
        <? echo $this->Form->input('gpslat', array('label' => 'Latitude')); ?>
        <? echo $this->Form->input('gpslong', array('label' => 'Longitude')); ?>
        <input name="data[Event][date_start]" type="date" value="Today" />
        <input name="data[Event][date_end]" type="date" value="Today" />

        <? echo $this->Form->input('filter', array('label' => 'Filter')); ?>
        <? echo $this->Form->input('facebook_msg', array('label' => 'Facebook Message')); ?>
        <? echo $this->Form->input('facebook_url', array('label' => 'Facebook URL')); ?>
        <? echo $this->Form->input('twitter_msg', array('label' => 'Twitter Message')); ?>
        <?// echo $tinymce->input('html_before'); ?>
        <? echo $this->Form->input('html_before', array('label' => 'HTML Before')); ?>
        <? echo $this->Form->input('html_after', array('label' => 'HTML After')); ?>
        <? echo $this->Form->select('stage', array('' => '---Select One---', 'Running' => 'Running', 'Scheduled' => 'Scheduled', 'Draft' => 'Draft')); ?>
        <? echo $this->Form->input('status', array('label' => 'Status')); ?>

        <label class="control-label">Thumbnail</label>
        <? echo $this->Form->file('img_thumb'); ?><br>
        <label class="control-label">Overlay Images</label>
        <? echo $this->Form->file('img_overlay_1'); ?>
        <a href="javascript:void(0);" id="add_more_image"></a>
-->
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Add',)); ?>

</section>
<script type="text/javascript">
    (function ($) {
        $(function () {
            $('a.pop')
                    .popover({
                        html : true
                    })
                    .on('click', function (e) {
                        e.preventDefault();
                    });
        });
    }(jQuery));
</script>