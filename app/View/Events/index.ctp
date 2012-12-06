<section class="list">
    <?=$this->element('menu', array(
        "heading" => "Manage Events"
    ));?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Thumb</th>
            <th>Details</th>
            <th>Status</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($events as $k => $event) { ?>
        <tr class="<?=($k % 2 == 0) ? 'odd' : 'even'?>">
            <td class="span3">
                <img src="<?=$event['Event']['img_thumb']; ?>" alt="Image thumb" width="90px" height="60px" />
            </td>
            <td class="span5">
                <div class="details">
                    <h5><?=$event['Event']['name'];  ?> </h5>

                    <div class="info">
                        <?=$event['Event']['shortdescription'];  ?>
                    </div>
                </div>
            </td>
            <td class="span2">
                <div class="event_status"><?=$event['Event']['stage'];  ?></div>
                <div class="event_start_date"><?=  date('M, d, Y', strtotime($event['Event']['date_start']));  ?></div>
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-share"></i> ', '/events/export/' . $event['Event']['id'], array('class' => '', 'escape' => FALSE)); ?>
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-pencil"></i> ', '/events/edit/' . $event['Event']['id'], array('class' => '', 'escape' => FALSE)); ?>
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-trash"></i> ', '/events/delete/' . $event['Event']['id'], array('class' => 'del-btn', 'item_name'=> $event['Event']['name'], 'escape' => FALSE)); ?>
            </td>
        </tr>
            <? } ?>
        </tbody>
    </table>
</section>