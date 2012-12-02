

<ul class="company_list">
<?php
foreach($companies as $company){
    ?>
<li class="name"><?php echo $company['Company']['name'];  ?> </li>


<li>
    <?php echo $this->Html->link('Edit','/companies/edit/'.$company['Company']['id'], array('class' => '')); ?>
</li>
<li>
    <?php echo $this->Html->link('Delete','/companies/delete/'.$company['Company']['id'], array('class' => '')); ?>
</li>
<?php
}
?>
</ul>