<?php
//print "<pre>";
//print_r($events);
//print "<pre>";

//echo $this->Html->nestedList($events);
?>
<div class="list">
    <table>
        <? foreach ($events as $k => $event) { ?>
        <tr class="<?=($k%2==0)?'odd':'even'?>">
            <td>
                <img src="<?=$event['Event']['img_thumb']; ?>" alt="Image thumb" width="90px" height="60px"/>
            </td>
            <td>
                <table>
                    <tr>
                        <td><?=$event['Event']['name'];  ?> </td>
                        <td><?=$event['Event']['shortdescription'];  ?> </td>
                    </tr>
                </table>
            </td>
            <td>
                <ul>
                    <td><?=$event['Event']['stage'];  ?> </td>
                    <td><?=$event['Event']['date_start'];  ?> </td>
                </ul>
            </td>
            <td>
                <?=$this->Html->link('Export', '/events/export/' . $event['Event']['id'], array('class' => '')); ?>
            </td>
            <td>
                <?=$this->Html->link('Edit', '/events/edit/' . $event['Event']['id'], array('class' => '')); ?>
            </td>
            <td>
                <?=$this->Html->link('Delete', '/events/delete/' . $event['Event']['id'], array('class' => '')); ?>
            </td>
        </tr>
        <? } ?>
    </table>
</div>