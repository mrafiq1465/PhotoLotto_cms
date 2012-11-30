<?php

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Systax Perfect home page
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('style');

		echo $this->Html->script('jquery.tools.min');
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Works</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
		</header>


			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>


	</div>
    <footer>
          <section>
              <address id="address">
                  suite#3203, 695 Tasman Drive,
                  Sunnyvale, CA-94089, USA
              </address>
              <address id="phone">
              </address>
              <div id="copyright">

              </div>
              <nav id="social">
                <ul>
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a></a>
                    </li>
                </ul>
              </nav>
          </section>

    </footer>

	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
