<?php echo $this->Html->docType('html5');?>

<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>

    <title><?php echo $title_for_layout; ?></title>


    <!--  meta info -->
    <?php
    echo $this->Html->meta(array("name"    => "viewport",
                                 "content" => "width=device-width,  initial-scale=1.0"));
    ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- styles -->
    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('style');
    ?>

    <!-- scripts -->
    <?php

        echo $this->Html->meta('favicon.ico','/favicon.ico', array('type' => 'icon'));

        echo $this->Html->script(
            array(
                'http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js',
                'bootstrap.min'
            ));

        echo $this->Html->script('main');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body>
	<div id="container" class="container">

        <!-- Navbar ============================================= -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container1">
                    <a class="btn btn-navbar" data-toggle="collapse"
                       data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/">PhotoLotto</a>
                    <a href="/users/logout" class="pull-right">Logout</a>
                </div>
            </div>
        </div>

        <div id="row">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        
        <footer id="footer">
            <address id="address">
                Sydney, Australia
            </address>
        </footer>
	</div>


    <?php echo $this->element('sql_dump'); ?>

</body>
</html>
