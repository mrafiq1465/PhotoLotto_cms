
<?php
//print "<pre>";
//print_r($events);
//print "<pre>";

//echo $this->Html->nestedList($events);
?>
<ul class="event_list">
<?php
foreach($events as $event){
?>
   <li><img src="<?php echo $event['Event']['img_thumb']; ?>" alt="image thumb" width="90px" height="60px" /></li>
   <li>
    <ul>
        <li><?php echo $event['Event']['name'];  ?> </li>
        <li><?php echo $event['Event']['shortdescription'];  ?> </li>
   </ul>
   </li>
   <li>
    <ul>
        <li><?php echo $event['Event']['stage'];  ?> </li>
        <li><?php echo $event['Event']['date_start'];  ?> </li>
    </ul>
   </li>
   <li>
       <?php echo $this->Html->link('Export','/events/export/'.$event['Event']['id'], array('class' => '')); ?>
   </li>
    <li>
        <?php echo $this->Html->link('Edit','/events/edit/'.$event['Event']['id'], array('class' => '')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Delete','/events/delete/'.$event['Event']['id'], array('class' => '')); ?>
    </li>
<?php
}
?>
</ul>