
<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Update User"
));?>
<? echo $this->Form->create('User'); ?>

<? echo $this->Form->input('name', array('label' => 'Name')); ?>
<? echo $this->Form->input('password', array('label' => 'Old Password')); ?>
<? echo $this->Form->input('password', array('label' => 'New Password')); ?>
<? echo $this->Form->input('password', array('label' => 'Confirm New Password')); ?>
<? echo $this->Form->input('role_id'); ?>
<? echo $this->Form->input('company_id'); ?>

<? echo $this->Form->end('Edit'); ?>
