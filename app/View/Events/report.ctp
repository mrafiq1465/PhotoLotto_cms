<section class="list">
    <?=$this->element('menu', array("heading" => "Event Report"));?>
    <section id="form-container">
        <ul>
            <li>Event name:<?=$event['Event']['name']?></li>
            <form action="/events/reports/<?=$event['Event']['id']?>" method="post">
                <li>Start date: <input name="data[Event][date_start]" type="date" value=""/></li>
                <li>End date: <input name="data[Event][date_end]" type="date" value=""/></li>
                <input type="submit" value="Filter" name="submit"/>
            </form>
            <li>Status: <?=$event['Event']['status']?></li>
            <li><?=count($event_actions)?> Submissions</li>
            <li><a href="/events/download_submissions/<?=$event['Event']['id']?>">Export all</a></li>
        </ul>
    </section>
    <div class="submission_list">
        <ul>
            <? foreach($event_actions as $event_action) { ?>
            <li>
                <?="<pre>" . print_r($event_action, true) . "</pre>"; ?>
                <a href="/events/download_submissions/<?=$event['Event']['id']?>/<?=$event_action['EventAction']['id']?>">Export</a>
            </li>
            <? } ?>
        </ul>
    </div>
</section>


