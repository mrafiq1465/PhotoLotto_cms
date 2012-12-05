<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Create New Company"
));?>

    <? echo $this->Form->create('Company'); ?>
    <section id="form-container">
        <h3>Company Details</h3>
    <? echo $this->Form->input('name', array('label' => FALSE, 'placeholder' => 'Name')); ?>
    <div class="control-group">
        <? echo $this->Form->input('address1', array('label' => FALSE, 'div' => FALSE, 'placeholder' => 'Address 1')); ?>
        <? echo $this->Form->input('postcode', array('label' => FALSE, 'div' => FALSE, 'class' => 'span2', 'placeholder' => 'Postcode')); ?>
    </div>
    
    <? echo $this->Form->input('address2', array('label' => FALSE, 'placeholder' => 'Address 2')); ?>
    <? echo $this->Form->input('phone', array('label' => FALSE, 'placeholder' => 'Phone')); ?>
    <?php $states = array('nsw' => 'NSW', 'vic' => 'VIC', 'qld' => 'QLD', 'wa' => 'WA', 'nt' => 'NT', 'tas' => 'TAS', 'act' => 'ACT');
    echo $this->Form->input('states', array('options' => $states, 'default' => 'nsw'));
    ?>
    </section>
    <? echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Create',)); ?>      


</section>