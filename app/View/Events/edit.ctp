<section class="list">
    <?=$this->element('menu', array("heading" => "Edit Event"));?>
    <? echo $this->Form->create('Event', array('type' => 'file')); ?>

    <? echo $this->Form->input('name', array('label' => 'Name')); ?>
    <?php $eventtype = array('generic' => 'generic', 'location-based' => 'location-based');
    echo $this->Form->input('eventtype', array('options' => $eventtype, 'default' => 'generic'));
    ?>
    <? echo $this->Form->input('company_id'); ?>
    <? echo $this->Form->input('shortdescription', array('label' => 'Short Description')); ?>
    <? echo $this->Form->input('gpslat', array('label' => 'Latitude')); ?>
    <? echo $this->Form->input('gpslong', array('label' => 'Longitude')); ?>
    <input name="data[Event][date_start]" value="<?=$this->data['Event']['date_start']?>" type="date"/>
    <input name="data[Event][date_end]" value="<?=$this->data['Event']['date_end']?>" type="date"/>

    <? echo $this->Form->input('filter', array('label' => 'Filter')); ?>
    <? echo $this->Form->input('facebook_msg', array('label' => 'Facebook Message')); ?>
    <? echo $this->Form->input('facebook_url', array('label' => 'Facebook URL')); ?>
    <? echo $this->Form->input('twitter_msg', array('label' => 'Twitter Message')); ?>
    <? // echo $tinymce->input('html_before'); ?>
    <? echo $this->Form->input('html_before', array('label' => 'HTML Before')); ?>
    <? echo $this->Form->input('html_after', array('label' => 'HTML After')); ?>
    <? echo $this->Form->select('stage', array('' => '---Select Stage---', 'Running' => 'Running', 'Scheduled' => 'Scheduled', 'Draft' => 'Draft')); ?>

    <label class="control-label">Thumbnail</label>
    <? if (!empty($this->data['Event']['img_thumb'])) { ?>
    <img src="<?=$this->data['Event']['img_thumb']?>" data-name="img_thumb" style="max-height: 100px;">
    <a href="javascript:void(0);" data-name="img_thumb" class="delete_image"></a><br>
    <? } ?>
    <? echo $this->Form->file('img_thumb'); ?><br>
    <label class="control-label">Overlay Images</label>
    <? for ($i = 1; $i <= 5; $i++) { ?>
    <? if (!empty($this->data['Event']["img_overlay_$i"])) { ?>
        <img src="<?=$this->data['Event']["img_overlay_$i"]?>" data-name="<?="img_overlay_$i"?>"
             style="max-height: 100px;">
        <a href="javascript:void(0);" data-name="<?="img_overlay_$i"?>" class="delete_image"></a><br>
        <? } ?>
        <? if($i <=2) { ?>
        <? echo $this->Form->file("img_overlay_$i"); ?><br>
        <? } ?>
    <? } ?>
    <a href="javascript:void(0);" id="add_more_image"></a>


    <? echo $this->Form->end('Save'); ?>



