<?php
$bodyclass = $this->params['controller'] . '_' . $this->params['action'];
?>
<?php echo $this->Html->docType('html5'); ?>

<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
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
    echo $this->Html->css('main');
    echo $this->Html->css('bootstrap-fileupload.min');
    ?>

    <!-- scripts -->
    <?php

    echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));

    echo $this->Html->script(
        array(
            'http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js',
            'bootstrap.min',
            'bootstrap-fileupload.min',
            'modernizr.min.js'
        ));

    echo $this->Html->script('main');


    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

</head>
<body style="padding: 0px;" id="event">

<section id="header">
    <div class="container">
        <div class="row">
            <div class="span4"><a href="/"><img src="/images/logo.png" alt="Logo" /></a></div>
        </div>
    </div>
</section>
<section id="main">
<div class="container clearfix">
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>

</div>
</section>
</body>
</html>
