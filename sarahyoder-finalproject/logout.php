<?php
  session_start();
  
    // If user is logged in, delete the session vars to log them out
  if (isset($_SESSION['employeeNumber'])) {
	  
    // Delete the session vars by clearing the session array
    $_SESSION = array();

    // Delete the session cookie by setting its expiration to the past
    if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 4200);
	}

    // Destroy the session
    session_destroy();
  }

  // Redirect to the login page
  $login_url = 'http://findingbulgaria.com/php-class/sarahyoder-finalproject/index.php';
  header("refresh: 8; url=$login_url");
  
  require_once('./inc/header.php');
?>

  <div class="container">
  	<div class="row">
  	  <div class="col-sm-6">
      	You have successfully logged out and will be redirected to the login page after 8 seconds.
      	<br />
      	<br />
      </div>
    </div>
  </div>

<?php
	require_once('./inc/footer.php');
?>