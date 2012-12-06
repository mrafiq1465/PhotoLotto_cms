<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Edit Event"
));?>
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
<? echo $this->Form->select('stage', array('a' => 'a','b' => 'b','c' => 'c',)); ?>

<label class="control-label">Thumbnail</label>
<img src="<?=$this->data['Event']['img_thumb']?>" style="max-height: 100px;"><br>
<? echo $this->Form->file('img_thumb'); ?><br>
<label class="control-label">Overlay Images</label>
<? for ($i = 1; $i <= 5; $i++) {
    if (isset($this->data['Event']["img_overlay_$i"])) {
        ?>
    <img src="<?=$this->data['Event']["img_overlay_$i"]?>" style="max-height: 100px;"><br>
    <? echo $this->Form->file("img_overlay_$i"); ?><br>
    <? } ?>
<? } ?>
<a href="javascript:void(0);" id="add_more_image"></a>


<? echo $this->Form->end('Save'); ?>



