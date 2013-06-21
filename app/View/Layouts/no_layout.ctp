<!DOCTYPE html>
<html>
<head>
    <title>Pixta</title>
    <link href="http://www.pixta.com.au/app/favicon.ico" type="image/x-icon" rel="icon" ><link href="http://www.pixta.com.au/app/favicon.ico" type="image/x-icon" rel="shortcut icon" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://www.pixta.com.au/app/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://www.pixta.com.au/app/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="http://www.pixta.com.au/app/css/screen.css" rel="stylesheet">
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-41513336-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</head>
<body>
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>
</body>
</html>




