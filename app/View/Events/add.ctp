<? echo $this->Form->create('Event', array('type' => 'file')); ?>

<? echo $this->Form->input('name', array('label' => 'Name')); ?>
<?php $eventtype = array('generic'=>'generic', 'location-based'=>'location-based');
echo $this->Form->input('eventtype', array('options'=>$eventtype, 'default'=>'generic'));
?>
<? echo $this->Form->input('company_id'); ?>
<? echo $this->Form->input('shortdescription', array('label' => 'Short Description')); ?>
<? echo $this->Form->input('gpslat', array('label' => 'Latitude')); ?>
<? echo $this->Form->input('gpslong', array('label' => 'Longitude')); ?>
<input name="data[Event][date_start]" type="date"  value="Today" />
<input name="data[Event][date_end]" type="date"  value="Today" />

<? echo $this->Form->input('filter', array('label' => 'Filter')); ?>
<? echo $this->Form->input('facebook_msg', array('label' => 'Facebook Message')); ?>
<? echo $this->Form->input('facebook_url', array('label' => 'Facebook URL')); ?>
<? echo $this->Form->input('twitter_msg', array('label' => 'Twitter Message')); ?>
<?// echo $tinymce->input('html_before'); ?>
<? echo $this->Form->input('html_before', array('label' => 'HTML Before')); ?>
<? echo $this->Form->input('html_after', array('label' => 'HTML After')); ?>
<? echo $this->Form->select('stage', array('' => '---Select One---','a' => 'a', 'b' => 'b', 'c' => 'c')); ?>
<? echo $this->Form->input('status', array('label' => 'Status')); ?>

<label class="control-label">Thumbnail</label>
<? echo $this->Form->file('img_thumb'); ?><br>
<label class="control-label">Overlay Images</label>
<? echo $this->Form->file('img_overlay_1'); ?>
<a href="javascript:void(0);" id="add_more_image"></a>

<? echo $this->Form->end('Add'); ?>

