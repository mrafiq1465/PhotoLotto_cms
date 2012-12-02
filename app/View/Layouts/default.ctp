<?php echo $this->Html->docType('html5');?>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		PhotoLotto Admin
	</title>
    <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
    <?php

        echo $this->Html->meta('favicon.ico','/favicon.ico', array('type' => 'icon'));

		echo $this->Html->css('reset');
		echo $this->Html->css('style');

		//echo $this->Html->script('jquery.tools.min');
        echo $this->Html->script('main');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body>
	<div id="container">
		<header >
			<div id="logo">

			</div>
            <nav id="top_nav">
                <ul>
                    <li><a href="#">New Company</a></li>
                    <li><a href="#">Manage Companies</a></li>
                    <li><a href="#">New Event</a></li>
                    <li><a href="#">Manage Events</a></li>
                </ul>
            </nav>
		</header>


			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>


	</div>
    <footer>
          <section>
              <address id="address">
                  Sydney, Australia
              </address>
              <address id="phone">
              </address>
              <div id="copyright">

              </div>

          </section>

    </footer>

</body>
</html>
