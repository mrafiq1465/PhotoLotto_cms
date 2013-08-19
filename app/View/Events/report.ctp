

<section class="list">
    <?=$this->element('menu', array("heading" => "Event Report"));?>
    <section id="form-container">
        <ul>
            <li><a href="/events/report/<?=$event['Event']['id']?>">Today</a> &nbsp;&nbsp;&nbsp;<a href="/events/report/<?=$event['Event']['id']?>/?date=all">All</a></li>
        </ul>
        <? echo $this->Form->create('Event'); ?>
        <div class="row-fluid" >
            <div class="span7">
                <div class="row-fluid">
                    <?=$this->Form->input('date_start', array('empty' => false, 'div' => false, 'minYear'=>date('Y'), 'maxYear'=>date('Y')+10, 'placeholder' => 'Please choose a start date', 'type' => "date"));?>
                </div>
                <div class="row-fluid">
                    <?=$this->Form->input('date_end', array('empty' => false, 'minYear'=>date('Y'), 'maxYear'=>date('Y')+10, 'div' => false, 'placeholder' => 'Please choose a start date', 'type' => "date"));?>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <?=$this->Form->end(array('id' => 'submitBtn', 'class' => 'btn btn-large btn-block btn-primary', 'label' => 'Search',))?>
        </div>


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
                <a href="/events/download_image/<?=$event['Event']['id']?>/?date=all">Download all images as ZIP file</a><br>
                <a id="export_image" href="#">Download images by date as ZIP file</a>
            </li>
            <li>
                <a href="/events/download_submissions/<?=$event['Event']['id']?>/?date=all">Export as CSV file</a><br>
                <a id="export_submission" href="#">Export as CSV file by date</a>
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
                <a  href="/events/download_submissions/<?=$event['Event']['id']?>/<?=$event_action['EventAction']['id']?>">Export</a>
            </li>
            <? } ?>
        </ul>
    </div>
</section>

<style>
        .row-fluid {
            padding-left: 15px;
        }
        select {
            width: 100px;;
        }
        #submitBtn {
            width:150px;
            margin-left: 15px;
            height: 30px;
            padding: 0;
        }

    </style>

<script type="text/javascript">

    $(document).ready(function() {
        $('#submitBtn').click(function(e){
            var start_date = $('#EventDateStartYear').val() + '-' + $('#EventDateStartMonth').val() + '-' + $('#EventDateStartDay').val() ;
            var end_date = $('#EventDateEndYear').val() + '-' + $('#EventDateEndMonth').val() + '-' + $('#EventDateEndDay').val() ;
            window.location.search = 'start_date='+start_date+'&end_date='+end_date;
            return false;
        });

        $('#export_image').click(function(e){
            var start_date = $('#EventDateStartYear').val() + '-' + $('#EventDateStartMonth').val() + '-' + $('#EventDateStartDay').val() ;
            var end_date = $('#EventDateEndYear').val() + '-' + $('#EventDateEndMonth').val() + '-' + $('#EventDateEndDay').val() ;
            //console.log(start_date);
            window.location.href= '/events/download_image/<?=$event['Event']['id']?>/?start_date='+start_date + "&end_date=" + end_date;
            e.preventDefault();
        });

        $('#export_submission').click(function(e){
            var start_date = $('#EventDateStartYear').val() + '-' + $('#EventDateStartMonth').val() + '-' + $('#EventDateStartDay').val() ;
            var end_date = $('#EventDateEndYear').val() + '-' + $('#EventDateEndMonth').val() + '-' + $('#EventDateEndDay').val() ;
            window.location.href= '/events/download_submissions/<?=$event['Event']['id']?>/?start_date='+start_date + "&end_date=" + end_date;
            e.preventDefault();
        });
    });
</script>
