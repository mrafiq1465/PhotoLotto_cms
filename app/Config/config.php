<?php

define('S3_IMG_URL', 'http://appevent.s3.amazonaws.com');

$config['Settings'] = array(
  'S3_IMG_URL' => 'http://appevent.s3.amazonaws.com',
  'title' => 'My Application'
);


$config['s3_img_url'] = 'http://appevent.s3.amazonaws.com/';


$config['facebook'] = array(
    'appId'  => '165468560247620',
    'secret' => 'd00549727fd053873a6ebc648b1a8b7e',
    'domain' => 'http://www.pixta.com',
    'login_callback' => '/users/fb_login_callback',
    'logout_callback' => 'social/facebook//controllers/logout_callback.php',

);

$config['email_config'] = array(
    'image_header' => 'http://www.pixta.com.au/img/email_image/def-header.png',
    'image_bg' => 'http://www.pixta.com.au/img/email_image/def-bg.png',
    'image_footer' => 'http://www.pixta.com.au/img/email_image/def-footer.png',
    'image_columnA' => 'http://www.pixta.com.au/img/email_image/def-app.png',
    'image_columnB' => 'http://www.pixta.com.au/img/email_image/def-columnb.png',
    'email_from' => 'info@pixta.com.au'
);


