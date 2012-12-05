<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Create New Company"
));?>
<section id="form-container">
    <? echo $this->Form->create('Company'); ?>
    <? echo $this->Form->input('name', array('label' => false, 'placeholder' => 'Name')); ?>
    <? echo $this->Form->input('address1', array('label' => 'Address1')); ?>
    <? echo $this->Form->input('address2', array('label' => 'Address2')); ?>
    <? echo $this->Form->input('phone', array('label' => 'Phone')); ?>
    <? echo $this->Form->input('postcode', array('label' => 'Postcode')); ?>
    <?php $states = array('nsw' => 'NSW', 'vic' => 'VIC', 'qld' => 'QLD', 'wa' => 'WA', 'nt' => 'NT', 'tas' => 'TAS', 'act' => 'ACT');
    echo $this->Form->input('states', array('options' => $states, 'default' => 'nsw'));
    ?>
    <? echo $this->Form->end('Add'); ?>      
</section>

</section>