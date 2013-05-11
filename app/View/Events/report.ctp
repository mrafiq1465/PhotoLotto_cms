<section class="list">
    <?=$this->element('menu', array("heading" => "Event Report"));?>
    <section id="form-container">
        <ul>
            <li>Event name:<?=$event['Event']['name']?></li>
            <li>Status: <?=$event['Event']['status']?></li>
            <li><?=count($event_actions)?> Submissions</li>

            <!--<li>
                <input class="blacklist_all" id="<?php /*echo $event['Event']['id']; */?>" type="checkbox" />
                Blacklist all images below
            </li>
            <li>
                <input class="approve_all" id="<?php /*echo $event['Event']['id']; */?>" type="checkbox" />
                Approve (remove from Blacklist) all images below
            </li>-->
            <li>
                <label class="radio" for="blacklistAll"><input type="radio" checked="checked" name="blacklistToggle" id="blacklistAll" value="1" />Blacklist all images below</label>
                <label class="radio" for="approveAll"><input type="radio" name="blacklistToggle" id="approveAll" value="0" />Approve (remove from Blacklist) all images below</label>
                <button data-event-id="<?php echo $event['Event']['id']; ?>" class="btn btn-primary blacklistToggle">Submit</button>
            </li>
            <li>
                <a href="/events/download_image/<?=$event['Event']['id']?>">Download all images as ZIP file</a>
            </li>
            <li>
                <a href="/events/download_submissions/<?=$event['Event']['id']?>">Export as CSV file</a>
            </li>
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


