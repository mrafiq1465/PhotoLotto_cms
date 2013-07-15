<section class="list">
    <?=$this->element('menu', array("heading" => "Email Stat"));?>
    <section id="form-container">

        <ul>
            <li>Total share emails sent:<?=count($event_emails); ?></li>
            <li>Total Facebook shares: <? echo $fb_share; ?></li>
            <li>Total Twitter shares:<? echo $tw_share; ?></li>
            <li>
                <a href="/events/download_email_post/<?=$event['Event']['id']?>">Download CSV of all emails sent</a>
            </li>
        </ul>
    </section>
</section>

