
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


