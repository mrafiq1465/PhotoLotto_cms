
<!--<nav id="view_nav" class="inactive clearfix">
    
    <ul>
        <li><a href="#" id="navtoggle"></a></li>
        <li><a href="#" id="detail"></a></li>
        <li><a href="#" id="grid"></a></li>
    </ul>
</nav>
<div id="top" class="bs">
    <div id="logo">
        <img src="<?php /*echo $event['Event']['public_logo']; */?>" alt="" />
    </div>
    <div class="mid" style="overflow:hidden;margin-left:176px;">
        <div id="heading">
            <ul>
                <li class="name"><?php /*echo $event['Event']['public_event_name']; */?>
                </li>
                <li class="fb">
                    <fb:like href="http://<?/*= $_SERVER['HTTP_HOST'] . $this->here; */?>?utm_campaign=facebooksharebtn&utm_source=facebook&utm_medium=social" send="false" width="160" data-layout="button_count" show_faces="false" font=""></fb:like>
                </li>
                <li class="tw">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="" data-via="pixta" data-text="Check out this subject:" data-hashtags="pixta">Tweet</a>
                </li>

            </ul>
        </div>
        <div id="desc">
            <ul>
                <li><?php /*echo $event['Event']['public_description']; */?></li>
            </ul>
        </div>
        <div id="phone">
            <ul>
                <li>
                    <b>p.</b> <?php /*echo $event['Event']['public_phone_number']; */?>
                </li>
                <li><b>e.</b> <?php /*echo $event['Event']['public_email']; */?>
                </li>
                <li><b>a.</b> <?php /*echo $event['Event']['public_address']; */?>
                </li>
            </ul>

        </div>
        <div id="app_store">
            <ul>
                <li>
                    <a href="#"><img src="/img/app_store.png" alt="Apple store"></a>
                </li>
                <li>
                    <a href="#"><img src="/img/google_play.png" alt="google play"></a>
                </li>
            </ul>
        </div>
    </div>    
</div>-->
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
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId=<?/*= $FB['appId']; */?>"></script>
<script type="text/javascript">_ga.trackFacebook();</script>

<!-- Twitter Scripts -->
<script>twttr = function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript">
    (function($){
        $(window).load(function() {
            twttr.ready(function (twttr) {
                //event bindings
                _ga.trackTwitter();
            });
        });
    })(jQuery);
</script>