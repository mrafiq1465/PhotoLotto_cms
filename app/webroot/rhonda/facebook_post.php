<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('facebook/facebook.php');

  $config = array(
    'appId' => '241617555995425',
    'secret' => '7fe3b35d150a813141c4c4e0967e6ff2',
    'fileUpload' => true,
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
if($_GET['vote']=="trent"){
  $photo = 'AAMI-Trent.png'; // Path to the photo on the local filesystem
    $message = 'I voted for Who’s Right for Rhonda! #teamtrent';
} elseif($_GET['vote']=="ketut"){
    $photo = 'AAMI-Ketut.png'; // Path to the photo on the local filesystem
    $message = 'I voted for Who’s Right for Rhonda! #teamketut';
}
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        // Upload to a user's profile. The photo will be in the
        // first album in the profile. You can also upload to
        // a specific album by using /ALBUM_ID as the path 
        $ret_obj = $facebook->api('/me/photos', 'POST', array(
                                         'source' => '@' . $photo,
                                         'message' => $message,
                                         )
                                      );
        //echo '<pre>Photo ID: ' . $ret_obj['id'] . '</pre>';
        //echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
        header( "Location: http://www.facebook.com");
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'photo_upload'
                       )); 
        //echo 'Please <a href="' . $login_url . '">login.</a>';
        header( "Location: ".$login_url);
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      // To upload a photo to a user's wall, we need photo_upload  permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'photo_upload') );
      //echo 'Please <a href="' . $login_url . '">login.</a>';
      header( "Location: ".$login_url);

    }

  ?>