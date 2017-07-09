<?php
	require_once('./inc/connectvars.php');
	
	$error_msg = "";
	
	session_start();
	
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect(HOST, USER, PW, DBNAME);
	
		// get login data
      	$user_username = trim($_POST['username']);
      	$user_pw = trim($_POST['pw']);
			
		if(!empty($user_username) && !empty($user_pw)) {
			
			$query = "SELECT employeeNumber, username FROM employees WHERE username = '$user_username' AND password = MD5('$user_pw')";
			$data = mysqli_query($dbc, $query);
				
        	if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the employeeNumber/username session vars and redirect to the welcome page
          $row = mysqli_fetch_array($data);
          $_SESSION['employeeNumber'] = $row['employeeNumber'];
          $_SESSION['username'] = $row['username'];
		  
          $welcome_url = 'http://findingbulgaria.com/php-class/sarahyoder-finalproject/welcome.php';
          header('Location: ' . $welcome_url);
		  
		  mysqli_close($dbc);
        	}
       			else {
          			// Login info isn't valid
          			$error_msg = '<p class="error_text">Whoops, that didn\'t match our records! Please enter a valid username and password to log in.</p>';
        		}
      	}
      	else {
        	// Login info wasn't entered
        	$error_msg = '<p class="error_text">You forgot to enter your info! Please enter your username and password to log in.</p>';
      	}
	}
require_once('./inc/header.php');
require_once('./inc/public-nav.php');
?>				
<div class="container">
  <div class="row">
    <div class="col-sm-3">
	   <h1>Employee Login</h1>
  
<?php
  // error msg, if needed
	echo $error_msg;
?>

  		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      		Username:
      		<input type="text" name="username" value="<?php echo $user_username; ?>" /><br />
      		Password:
      		<input type="password" name="pw" /><br />
      		<input type="submit" value="Log In" name="submit" />
 		 </form>
    </div>
  </div>
</div>
<?php
require_once('./inc/footer.php');
?>