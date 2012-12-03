<? echo $this->Form->create('Event', array('type' => 'file')); ?>

<? echo $this->Form->input('name', array('label' => 'Name')); ?>
<?php $eventtype = array('generic'=>'generic', 'location-based'=>'location-based');
echo $this->Form->input('eventtype', array('options'=>$eventtype, 'default'=>'generic'));
?>
<? echo $this->Form->input('company_id'); ?>
<? echo $this->Form->input('shortdescription', array('label' => 'Short Description')); ?>
<? echo $this->Form->input('gpslat', array('label' => 'Latitude')); ?>
<? echo $this->Form->input('gpslong', array('label' => 'Longitude')); ?>
<input name="data[Event][date_start]" type="date" />
<input name="data[Event][date_end]" type="date" />

<? echo $this->Form->input('filter', array('label' => 'Filter')); ?>
<? echo $this->Form->input('facebook_msg', array('label' => 'Facebook Message')); ?>
<? echo $this->Form->input('facebook_url', array('label' => 'Facebook URL')); ?>
<? echo $this->Form->input('twitter_msg', array('label' => 'Twitter Message')); ?>
<?// echo $tinymce->input('html_before'); ?>
<? echo $this->Form->input('html_before', array('label' => 'HTML Before')); ?>
<? echo $this->Form->input('html_after', array('label' => 'HTML After')); ?>
<? echo $this->Form->input('stage', array('label' => 'Stage')); ?>

<img src="<?=$this->data['Event']['img_thumb']?>">
<? echo $this->Form->file('img_thumb'); ?>
<img src="<?=$this->data['Event']['img_overlay_1']?>">
<? echo $this->Form->file('img_overlay_1'); ?>

<? echo $this->Form->end('Add'); ?>



