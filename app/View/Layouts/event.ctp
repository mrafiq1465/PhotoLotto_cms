<?php
$bodyclass = $this->params['controller'] . '_' . $this->params['action'];
?>
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
    echo $this->Html->css('reset');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('style');
    echo $this->Html->css('style1');
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
<body style="padding: 0px;" >
<div id="container" class="container">

    <div id="row">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>

    <footer id="footer">
        <address id="address">

        </address>
    </footer>
</div>
</body>
</html>
