<? echo $this->Form->create('User'); ?>

<? echo $this->Form->input('name', array('label' => 'Name')); ?>
<? echo $this->Form->input('password', array('label' => 'Old Password')); ?>
<? echo $this->Form->input('password', array('label' => 'New Password')); ?>
<? echo $this->Form->input('password', array('label' => 'Confirm New Password')); ?>


<? echo $this->Form->end('Edit'); ?>
