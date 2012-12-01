<? echo $this->Form->create('Event'); ?>

<? echo $this->Form->input('name', array('label' => 'Name')); ?>
<? echo $this->Form->input('company_id', array('label' => 'Company')); ?>
<? echo $this->Form->input('shortdescription', array('label' => 'Short Description')); ?>
<? echo $this->Form->input('gpslat', array('label' => 'Latitude')); ?>
<? echo $this->Form->input('gpslong', array('label' => 'Longitude')); ?>
<? echo $this->Form->input('date_start', array('label' => 'Start Date')); ?>
<? echo $this->Form->input('date_end', array('label' => 'End Date')); ?>
<? echo $this->Form->input('filter', array('label' => 'Filter')); ?>
<? echo $this->Form->input('updated_by', array('label' => 'Updated By')); ?>
<? echo $this->Form->input('facebook_msg', array('label' => 'Facebook Message')); ?>
<? echo $this->Form->input('facebook_url', array('label' => 'Facebook URL')); ?>
<? echo $this->Form->input('twitter_msg', array('label' => 'Twitter Message')); ?>
<? echo $this->Form->input('html_before', array('label' => 'HTML Before')); ?>
<? echo $this->Form->input('html_after', array('label' => 'HTML After')); ?>
<? echo $this->Form->input('stage', array('label' => 'Stage')); ?>
<? echo $this->Form->input('img_thumb', array('label' => 'Thumbnail')); ?>
<? echo $this->Form->input('img_overlay_1', array('label' => 'Overlay Image')); ?>



<? echo $this->Form->end('Add'); ?>



