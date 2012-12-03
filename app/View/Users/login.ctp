<?php echo $this->Form->create('User');?>

<? echo $this->Form->input('email', array('label' => 'Email')); ?>
<? echo $this->Form->input('password', array('label' => 'Password')); ?>

<?php echo $this->Form->end(__('Submit'));?>

<?php echo $this->Html->link('Forgot password','#', array('class' => 'forgot_password')); ?>

