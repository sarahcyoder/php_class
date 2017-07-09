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
  $login_url = 'http://findingbulgaria.com/php-class/sarahyoder-L5/login.php';
  header('Location: ' . $login_url);
?>