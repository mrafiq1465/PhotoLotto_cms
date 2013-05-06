<section class="list">
    <?=$this->element('menu', array("heading" => "Event Report"));?>
    <section id="form-container">
        <ul>
            <li>Event name:<?=$event['Event']['name']?></li>
            <li>Status: <?=$event['Event']['status']?></li>
            <li><?=count($event_actions)?> Submissions</li>
            <li><a href="/events/download_submissions/<?=$event['Event']['id']?>">Export all</a></li>
        </ul>
    </section>
    <div class="submission_list">
        <ul>
            <? foreach($event_actions as $event_action) {
              $blacklist = '';
            if($event_action['EventAction']['blacklist']){
                $blacklist = "checked";
              }
            ?>
            <li>
                <img src="<?php echo S3_IMG_URL.'/'.$event_action['EventAction']['photo']; ?>" width="300px" height="300px"  alt="" />
                <input class="blacklist" id="<?php echo $event_action['EventAction']['id']; ?>" type="checkbox" <?php echo $blacklist; ?>  /> BlackList
                <br /><br />
                <a href="/events/download_submissions/<?=$event['Event']['id']?>/<?=$event_action['EventAction']['id']?>">Export</a>
            </li>
            <? } ?>
        </ul>
    </div>
</section>


