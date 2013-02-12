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
</style>
<nav id="view_nav" class="inactive clearfix">
    
    <ul>
        <li><a href="#" id="navtoggle"></a></li>
        <li><a href="#" id="detail"></a></li>
        <li><a href="#" id="grid"></a></li>
    </ul>
</nav>
<div id="top">
    <img src="<?php echo $event['Event']['public_logo']; ?>" alt="" />

    <?php
    //var_dump($event);
    echo $event['Event']['public_description'];
    ?>

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
        function defaultTask(e) {
            e.preventDefault();
            $("#view_nav").toggleClass('inactive active');
        } 
        
        var slides = $('.row.detail');
        
        $("#navtoggle").on('click', defaultTask);
        
        $("#detail, #grid").on('click', function (e) {
            var detail = $(".row.detail");
            var grid = $(".row.grid");
            var _id = $(this).attr('id');
            defaultTask(e);

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