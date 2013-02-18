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
        margin-top: 30px;
        float: left;
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
        width: 940px;
    }
     #logo {
       float: left;
       width: 270px;
    }
    #desc {
        float: left;
        width: 300px;
    }
    #desc ul {

    }
    #desc ul li.name{
       font-size: 14px;
       font-weight: bold;
    }
    #desc ul li.desc{
        font-size: 12px;
    }
    #phone{
        float: left;
        position: relative;
        top:20px;
        width: 350px;
    }

    #phone ul {

    }
    #phone ul li{

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
    <div id="desc">
        <ul>
            <li class="name"><?php echo $event['Event']['public_event_name']; ?></li>
            <li class="desc"><?php echo $event['Event']['public_description']; ?></li>
        </ul>
    </div>
    <div id="phone">
        <ul>
            <li><b>p.</b> <?php echo $event['Event']['public_phone_number']; ?></li>
            <li><b>e.</b> <?php echo $event['Event']['public_email']; ?></li>
            <li><b>a.</b> <?php echo $event['Event']['public_address']; ?></li>
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