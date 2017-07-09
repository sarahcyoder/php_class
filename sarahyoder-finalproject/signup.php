<?php
$error_msg = "";

	require_once('./inc/connectvars.php');
	
	$dbc = mysqli_connect(HOST, USER, PW, DBNAME);
	
	if (isset($_POST['submit'])) {
    // Get data from signup form
	$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
	$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $pw1 = mysqli_real_escape_string($dbc, trim($_POST['pw1']));
    $pw2 = mysqli_real_escape_string($dbc, trim($_POST['pw2']));
	
		if (!empty($firstName) && !empty($lastName) && !empty($username) && !empty($pw1) && !empty($pw2) && ($pw1 == $pw2)) {
			
      		// Make sure username not already taken
      		$query = "SELECT * FROM employees WHERE username = '$username'";
     		$data = mysqli_query($dbc, $query);
	  
      		if (mysqli_num_rows($data) == 0) { // The username is unique so add to database
        		$query = "INSERT INTO employees (username, password, lastName, firstName, email) VALUES ('$username', MD5('$pw1'), '$lastName', '$firstName', '$email')";
        		mysqli_query($dbc, $query);

				//send to login page
        		$login_url = 'http://findingbulgaria.com/php-class/sarahyoder-finalproject/index.php';
          		header('Location: ' . $login_url);
		  		mysqli_close($dbc);
				
        	} else {
        		// The username chosen already exists
        		$error_msg = '<p>That username already exists! Please try a different one.</p>';
        		$username = "";
      		}
		}
		else { // a field was missed
			$error_msg = '<p class="error_text">Whoops, you missed a field! Please be sure to input data into all of the fields, including both password fields.</p>';
    	}
	}
	
require_once('./inc/header.php');
require_once('./inc/public-nav.php');
?>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
<?php
	echo $error_msg;
?>

	<h1>Employee Signup</h1>

 	<p>Please fill out this form to sign up!</p>
  		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      		First Name:
      		<input type="text" id="firstName" name="firstName" value="<?php if (!empty($firstName)) echo $firstName; ?>" /><br />
      		Last Name:
      		<input type="text" id="lastName" name="lastName" value="<?php if (!empty($lastName)) echo $lastName; ?>" /><br />
     		 Email:
     		 <input type="email" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
     		 Username:
     		 <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
		     Password:
  		     <input type="password" id="pw1" name="pw1" /><br />
   		     Password (retype):
      		 <input type="password" id="pw2" name="pw2" /><br />
    		<input type="submit" value="Sign Up" name="submit" />
  		</form>
    </div>
  </div>
</div>
<?php
require_once('./inc/footer.php');
?>