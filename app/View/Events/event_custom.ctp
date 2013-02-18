<style type="text/css">
    #view_nav {
        height: 76px;
    }

    #view_nav li a {
        display: block;
        width: 82px;
        height: 76px;
    }
    #view_nav ul {
        float: right;
        width: 82px;
        margin: 0;
        height: 76px;
    }

    #detail {
        background: transparent url("/img/event-singleimage.gif");
    }
    #grid {
        background: transparent url("/img/event-grid.gif");
    }
    #detail,
    #grid {        
        opacity: 0;
        -webkit-transition: all .8s ease-out
        transition: all .8s ease-out
    }

    .inactive #detail,
    .inactive #grid {
        display: none;
    }
    
    .inactive #navtoggle {
        background: transparent url("/img/event-arrowoff.gif");
    }
    .active #navtoggle {
        background: transparent url("/img/event-arrowon.gif");
    }
    .active #detail,
    .active #grid {
        opacity: 1;
        display: block;
        z-index: 10;
    }
    #gallery {
        padding: 30px;
        float: left;
        background-color: #f2f2f2;
        width: 880px;
        height: auto;
    }
    .grid img{
        width: 172px;
        height: 172px;
    }

    .grid .span2 {
        width: 172px;
        margin-bottom: 20px;
    }
    
    #gallery .detail{
        display: none;
    }

    #gallery .span12 {
        text-align: center;
    }

    .detail img {
        width: 640px;
        height: 640px;
    }
    #top {
        clear: both;
        float: left;
        height: 125px;
        width: 880px;
        background-color: #363533;
        color: #fff;
        padding: 20px 30px 20px 30px;
        z-index: -1;
    }
     #logo {
       float: left;
       width: 176px;
       height: 176px;
       position: relative;
       top: -60px;
    }
    #logo img {
        width: 176px !important;
        height: 176px !important;
    }
    #heading {
        width: 550px;
        float: left;
    }
    #heading ul li.name {
        width: auto;
        margin-right: 20px;
        float: left;
        font-size: 15px;
        font-weight: bold;
    }
    #heading ul li.fb {
        width:100px;
        float: left;
    }
    #heading ul li.tw {
        width:100px;
        float: left;
    }

    #desc {
        float: left;
        width: 300px;
        margin-top: 10px;
    }
    #desc ul {

    }

    #desc ul li{
        font-size: 12px;
    }
    #phone{
        float: left;
        width: 240px;
        margin-top: 10px;
    }

    #phone ul {

    }
    #phone ul li{

    }
    #app_store {
        float: left;
        position: relative;
        top:-20px;
        left: 0px;
    }
    #app_store ul {

    }
    #app_store ul li{
        margin-top: 10px;
    }

</style>
<nav id="view_nav" class="inactive clearfix">
    
    <ul>
        <li><a href="#" id="navtoggle"></a></li>
        <li><a href="#" id="detail"></a></li>
        <li><a href="#" id="grid"></a></li>
    </ul>
</nav>
<div id="top">
    <div id="logo">
        <img src="<?php echo $event['Event']['public_logo']; ?>" alt="" />
    </div>
    <div id="heading">
        <ul>
            <li class="name"><?php echo $event['Event']['public_event_name']; ?>
            </li>
            <li class="fb">
                <fb:like href="http://<?= $_SERVER['HTTP_HOST'] . $this->here; ?>?utm_campaign=facebooksharebtn&utm_source=facebook&utm_medium=social" send="false" width="160" data-layout="button_count"  show_faces="false" font=""></fb:like>
            </li>
            <li class="tw">
            <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="" data-via="pixta" data-text="Check out this subject:" data-hashtags="pixta">Tweet</a>
            </li>

        </ul>
    </div>
    <div id="desc">
        <ul>
            <li><?php echo $event['Event']['public_description']; ?></li>
        </ul>
    </div>
    <div id="phone">
        <ul>
            <li><b>p.</b> <?php echo $event['Event']['public_phone_number']; ?></li>
            <li><b>e.</b> <?php echo $event['Event']['public_email']; ?></li>
            <li><b>a.</b> <?php echo $event['Event']['public_address']; ?></li>
        </ul>

    </div>
    <div id="app_store">
        <ul>
            <li><a href="#"><img src="/img/app_store.jpeg" alt="Apple store"></a>
            </li>
            <li>
                <a href="#"><img src="/img/google_play.jpeg" alt="google play">
            </li>
        </ul>
    </div>
</div>

<div id="gallery">
    <div class="grid row">
        
    <?php

    foreach ($event['EventAction'] as $ev) {
        if ($ev['blacklist'] != 1) {
            ?>
                <div class="span2">
                    <img src="<?php echo S3_IMG_URL . '/' . $ev['photo']; ?>" alt="" /></div>                
            <?php
        }
    }
    ?>
    </div> <!--grid-->
    <div class="detail row">
        <?php

        foreach ($event['EventAction'] as $ev) {
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
        var $viewNav = $("#view_nav");        
        var slides = $('.row.detail');
        
        $("#view_nav > ul").on({
            mouseenter : function () {                
                $viewNav.removeClass().addClass('active');
            },
            mouseleave : function () {
                $viewNav.removeClass().addClass('inactive');
            }
        });
        
        $("#detail, #grid").on('click', function (e) {
            var detail = $(".row.detail");
            var grid = $(".row.grid");
            var _id = $(this).attr('id');
            
            e.preventDefault();
            $viewNav.removeClass().addClass('inactive');

            if ($("#gallery").find("." + _id).is(':visible')) return;

            if (_id === 'detail') {
                detail.show();
                grid.hide();
                slides.cycle();
            } else {                
                slides.cycle('stop');
                grid.show();
                detail.hide();
            }
        });
    });
</script>

<? $FB = Configure::read('facebook'); ?>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId=<?= $FB['appId']; ?>"></script>
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