
<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Edit User"
));?>
<? echo $this->Form->create('User'); ?>
    <section id="form-container">
        <h3>User Details</h3>
        <? echo $this->Form->input('name', array('label' => FALSE, 'placeholder' => 'Name')); ?>
        <? echo $this->Form->input('role_id'); ?>
        <? echo $this->Form->input('company_id'); ?>
    </section>
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Edit',)); ?>

</section>