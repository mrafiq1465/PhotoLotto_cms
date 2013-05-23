
<nav id="view_nav_section" class="inactive clearfix">
    <a href="#" id="detail">detail</a>
    <a href="#" id="grid">grid</a>
</nav>
<div id="event_info" class="bs">
    <div id="company_info">
        <div id="elogo">
            <img src="<?php echo $event['Event']['public_logo']; ?>"
                 alt="<?php echo $event['Event']['public_event_name']; ?>"/>
        </div>
        <div id="desc">
            <?php echo $event['Event']['public_description']; ?>
        </div>
    </div>
    <div id="app_store">
        <ul class="clearfix">
            <li>
                <a href="#"><img src="/img/app_store.png" alt="Apple store"></a>
            </li>
            <li>
                <a href="#"><img src="/img/google_play.png" alt="google play"></a>
            </li>
        </ul>
    </div>
</div>

<div id="gallery" class="bs">
    <div class="grid row active">
        <div class="gradient"></div>
        
    <?php
    $top_id = false;
    $photo_id = '';
    if(count($event['EventAction']) > 1){
        foreach (Set::sort($event['EventAction'], '{n}.id', 'desc') as $ev) {
            if ($ev['blacklist'] != 1) {

                if(!$top_id){
                    $photo_id = $ev['id'];
                    $top_id = true;
                }
                ?>
                    <div class="item">
                        <img src="<?php echo S3_IMG_URL . '/' . $ev['photo']; ?>" alt="" /></div>
                <?php
            }
        }
    }
    ?>
        <input type="hidden" id="event_id" value="<?php echo $event['Event']['id']; ?>" />
        <input type="hidden" id="top_image" value="<? echo  $photo_id?>" />
    </div> <!--grid-->
    <div class="detail row">
        <?php

        foreach (Set::sort($event['EventAction'], '{n}.id', 'desc') as $ev) {
            if ($ev['blacklist'] != 1) {
                ?>
                <div class="span12">
                    <img src="<?php echo S3_IMG_URL . '/' . $ev['photo']; ?>" alt="" />
                </div>
                <?php
            }
        }
        ?>
    </div> <!--details-->

</div>
<script type="text/javascript" src="/js/jquery.cycle.js"></script>
<script type="text/javascript">
    $(function () {
        var slides = $('.row.detail');
        
        $("#detail, #grid").on('click', function (e) {
            var detail = $(".row.detail");
            var gallery = detail.parent();
            var grid = $(".row.grid");
            var _id = $(this).attr('id');
            
            e.preventDefault();

            if ($("#gallery").find("." + _id).is(':visible')) return;

            if (_id === 'detail') {
                detail.show();
                grid.removeClass('active').hide();
                gallery.css('height', '680');
                slides.cycle();
            } else {
                slides.cycle('stop');
                grid.addClass('active').show();
                gallery.css('height', 'auto');
                detail.hide();
            }
        });

        var isWorking = false;

        setInterval(function () {
            if (isWorking) return;
            update_image();
        },10000);

        function update_image() {
            isWorking = true;
            var event_action_id = $('#top_image').val();
            var event_id = $('#event_id').val();
            var S3_IMG_URL = '<?php echo S3_IMG_URL; ?>/';
            $.ajax({
                type: "POST",
                url: "/events/action_image",
                data: { 'data[event_id]' : event_id, 'data[event_action_id]' : event_action_id},
                success: function (response) {
                    var eventActions = response.response;
                    var latest = '';
                    var grid='', detail='';
                    if (eventActions && eventActions.length) {
                        $.each(eventActions, function (index, item) {
                            grid += "<div class='item'>" +
                                "<img src='" + S3_IMG_URL + item.EventAction.photo +
                                "'/>" +
                                "</div>";
                            detail += "<div class='span12'>" +
                                "<img src='" + S3_IMG_URL + item.EventAction.photo +
                                "'/>" +
                                "</div>";

                            latest = item.EventAction.id;

                        });
                        //add to grid
                        $(grid).hide().prependTo($(".grid")).fadeIn();
                        //add to detail
                        $(detail).hide().prependTo($(".detail")).fadeIn();
                        isWorking = false;
                        if (latest) {
                            $('#top_image').val(latest);
                        }
                    } else {
                        isWorking = false;
                    }
                }
            });
        }
    });
</script>

<? $FB = Configure::read('facebook');?>
<!--div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId=<?/*= $FB['appId']; */?>"></script>
<script type="text/javascript">_ga.trackFacebook();</script>

<!-- Twitter Scripts -->
<script>
  //  twttr = function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>
<script type="text/javascript">
   /*
    (function($){
        $(window).load(function() {
            twttr.ready(function (twttr) {
                //event bindings
                _ga.trackTwitter();
            });
        });
    })(jQuery);
    */
</script-->