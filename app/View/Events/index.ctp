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
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <? echo $this->Form->input('company_id', array('options' => $companies, 'default' => !empty($_GET['company'])?$_GET['company']:'')); ?>
            </td>

            <td>
                <?=$this->Form->input('eventtype',
                array(
                    'options' => array(
                        '0' => 'Please select',
                        'pixta-play' => 'PIXTA Play',
                        'National' => 'Personal',
                        'location-based' => 'Brands'),
                    'default' => !empty($_GET['eventtype'])?$_GET['eventtype']:'0'
                ));?>

            </td>

            <td>
                <?=$this->Html->link('All', '/events/', array('class' => '', 'escape' => FALSE)); ?>

            </td>
            <td colspan="10">
               &nbsp;
            </td>
        </tr>

        <? foreach ($events as $k => $event) { ?>
        <tr class="<?=($k % 2 == 0) ? 'odd' : 'even'?>">
            <td class="span3">
                <img src="<?=$event['Event']['public_logo']; ?>" alt="Image thumb" width="90px" height="60px" />
            </td>
            <td class="span5">
                <div class="details">
                    <h5><?=$event['Event']['name'];  ?> </h5>

                    <div class="info">
                        <?=$event['Event']['shortdescription_line_1'];  ?><br>
                        <?=$event['Event']['shortdescription_line_2'];  ?>
                    </div>
                </div>
            </td>
            <td class="span2">
                <?
                    $now = time();
                    if(strtoupper($event['Event']['stage']) == 'SCHEDULED'){
                        if($now > strtotime($event['Event']['date_start']) && $now < strtotime($event['Event']['date_end']) ){
                            $status = 'RUNNING';
                        } elseif ($now < strtotime($event['Event']['date_start']) ){
                            $status = 'SCHEDULED';
                        } else {
                            $status = 'CLOSED';
                        }
                    } else {
                        $status = 'DRAFT';
                    }
                ?>
                <div class="event_status"><?=$status?></div>
                <div class="event_start_date"><?
                    if($status != 'DRAFT'){
                        echo date('d/m/y', strtotime($event['Event']['date_end']));
                    }
                    ?></div>
            </td>

            <td>
                <?=$this->Html->link('<i class="icon-pencil"></i>', '/events/edit/' . $event['Event']['id'], array('class' => '', 'escape' => FALSE)); ?>
                <br>edit
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-trash"></i> ', '/events/delete/' . $event['Event']['id'], array('class' => 'del-btn', 'item_name'=> $event['Event']['name'], 'escape' => FALSE)); ?>
                <br>delete
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-rss"></i> ', '/events/rss/' . $event['Event']['id'], array('target' => '_blank', 'class' => '', 'escape' => FALSE)); ?>
                <br>RSS
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-folder-open"></i> ', '/events/report/' . $event['Event']['id'], array('class' => '', 'escape' => FALSE)); ?>
                <br>images
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-share"></i> ', '/' . $event['Event']['event_url'], array('class' => '', 'escape' => FALSE)); ?>
                <br>event page
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-share"></i> ', '/events/duplicate/' . $event['Event']['id'], array('class' => '', 'escape' => FALSE)); ?>
                <br>duplicate this event
            </td>
            <td>
                <a id="<?= $event['Event']['id']?>" class="icon-circle-arrow-up" href="#"></a><br>
                <a id="<?= $event['Event']['id']?>" class="icon-circle-arrow-down" href="#"></a>
            </td>
        </tr>
            <? } ?>
        </tbody>
    </table>
</section>

<script type="text/javascript">
$(function(){
    $('#company_id').change(function(){
        if($(this).val() != ''){
            window.location.href= '/events/?company=' + $(this).val();
        } else {
            window.location.href= '/events/';
        }
    });
    $('#eventtype').change(function(){
        if($(this).val() != ''){
            window.location.href= '/events/?eventtype=' + $(this).val();
        } else {
            window.location.href= '/events/';
        }
    });
});
</script>