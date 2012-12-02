<?php echo $this->Form->create('Post');?>

<? echo $this->Form->input('email', array('label' => 'Email')); ?>
<? echo $this->Form->input('password', array('label' => 'Password')); ?>

<?php echo $this->Form->end(__('Submit'));?>

<?php echo $this->Html->link('Forgot password','#', array('class' => 'forgot_password')); ?>


<div id="password" >
    <? echo $this->Form->input('email_password', array('label' => 'Email')); ?>
</div>