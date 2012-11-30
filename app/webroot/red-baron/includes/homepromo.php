
<!-- styles needed by jScrollPane -->
<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />

<script src="/js/jquery.tools.min.js"></script>
<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>

<style>
        /* main vertical scroll */
    #main {
        position:relative;
        overflow:hidden;
        height: 355px;
    }

        /* root element for pages */
    #pages {
        position:absolute;
        height:20000em;
    }

        /* single page */
    .page {
        padding:0px;
        width: 670px;
        height: 355px;
    }

        /* root element for horizontal scrollables */
    .scrollable {
        position:relative;
        overflow:hidden;
        width: 670px;
        height: 355px;
    }

        /* root element for scrollable items */
    .scrollable .items {
        width:20000em;
        position:absolute;
        clear:both;
    }

        /* single scrollable item */
    .item {
        float:left;
        cursor:pointer;
        width: 670px;
        height: 355px;
        padding:0px;
    }

        /* main navigator */
    #main_navi {
        float:left;
        padding:0px !important;
        margin:0 0 0 0 !important;
    }

    #main_navi li {
        background-color:#3C4043;
        border-top:1px solid #666;
        clear:both;
        color:#FFFFFF;
        font-size:12px;
        min-height:30px;
        list-style-type:none;
        padding:5px 5px 5px 20px ;
        width:220px;
        cursor:pointer;
    }

    #main_navi li:hover {
        background-color:#333;
    }

    #main_navi li.active {
        background-color:#333;
    }

    #main_navi li span.name {
       width:150px;
       float: left;
    }
    #main_navi li span.price {
       width:50px;
       float: right;
       position: relative;
       top: 10px;
        font-size: 14px;
    }

    #main div.navi {
        margin-left:250px;
        cursor:pointer;
    }
    .book_flight_header {
        position: relative;
        top: -35px;
        left: -3px;

    }

    #scrollwrap {
        position:relative;
        overflow:hidden;
        width: 245px;
        height:270px;
        margin-top: 60px;

    }

        /* the element that moves forward/backward */
    #scroll {
        position:relative;
        width:245px;
        color:#fff;
        left:0px;
    }

</style>


<div class="homepromoleft">
	<!--the div to hold the images-->
    <div id="main">
        <div id="pages">
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                       <a href="http://www.google.com"> <img src="images/homepromo/image1.jpg" /></a>
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/image2.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/rb3.jpeg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                            <img src="images/homepromo/image1.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                     <div class="items">
                        <img src="images/homepromo/image2.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                            <img src="images/homepromo/rb3.jpeg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/image1.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/image2.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/rb3.jpeg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/image1.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/image2.jpg" />
                    </div>
                </div>
            </div>
            <div class="page">
                <div class="scrollable">
                    <div class="items">
                        <img src="images/homepromo/rb3.jpeg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="homepromoright ">
	<!--div class="book_flight_header">
        <img src="images/homepromo/book-direct.png" alt="flight header" />
	</div-->
    <!--the div to hold the flights, clickable to other pages in the site-->
    <div id="scrollwrap" class="scroll-pane">
        <div id="scroll">
    <ul id="main_navi">
        <li class="active">
            <span class="name">flight 1, this one is longer and should wrap</span>
            <span class="price">$150</span>

        </li>
        <li>
            <span class="name">flight 2, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 3, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 4, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 5, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 6, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 7, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 8, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 9, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 10, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 11, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
        <li>
            <span class="name">flight 12, this one is longer and should wrap</span>
            <span class="price">$150</span>
        </li>
    </ul>
        </div>
        </div>
</div>

<div class="clear"></div>

<script>
    $(document).ready(function() {

        $('#scrollwrap').css({"overflow": "auto"});
        $('.scroll-pane').jScrollPane({animateScroll: true});

        $("#main").scrollable({
            circular: true,
            vertical: true,
            mousewheel: true,
            onBeforeSeek: function(event, i) {
                var cur = $('#main_navi li:eq('+i+')');
                if (cur.length!=0) {
                    var api = $('#scrollwrap').data('jsp');
                    api.scrollToElement(cur, false);
                }
//                $('#scrollwrap').animate({
//                    scrollTop: cur.position().top + cur.outerHeight() - $('#scrollwrap').height()
//                }, 400);

//                $('#scrollwrap').scrollTop(
//                        $('#main_navi li.active').position().top + $('#main_navi li.active').outerHeight() - $('#scrollwrap').height()
//                );
            }
        }).navigator("#main_navi").autoscroll(2000);

    });
</script>

