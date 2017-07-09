<?php

	$debug = false;
	
	//set form output and error text vars
	$output_form = true;
	$error_text = "";
	
	
	$first_name = '';
	$valid_fname = 0;
	$fname_regex = '/^([A-Z]|[a-z]){2,15}$/';
	$fname_error_msg = 'First name must be 2-15 letters.';
	
	$last_name = '';
	$valid_lname = 0;
	$lname_regex = '/^([A-Z]|[a-z]){2,15}$/';
	$lname_error_msg = 'Last name must be 2-15 letters.';
		
	$phone = '';
	$valid_phone = 0;
	$phone_regex = '/^\d{3}-\d{3}-\d{4}$/';
	$phone_error_msg = 'Phone number must be in XXX-XXX-XXXX format, with only numbers.';
	
	$city = '';
	$valid_city = 0;
	$city_regex = '/^([A-Z]|[a-z]){3,20}$/';
	$city_error_msg = 'City must be 3 to 30 letters.';
	
	$state = '';
	$valid_state = 0;
	$state_regex = '/^([A-Z]|[a-z]){2}$/';
	$state_error_msg = 'State must be 2 letters only.';

if (isset($_POST['submit'])) {
	
	if ($debug) {
		echo "<pre>";
		print_r($POST);
		echo "<pre>";
	}
	
	$first_name = trim($_POST['fname']);
	$last_name = trim($_POST['lname']);
	$phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
	
	//validate first name
	if (preg_match($fname_regex, $first_name)) {
		$valid_fname = 1;
	} else {
		$error_text .= "$fname_error_msg<br />\n\r";
	}
	
	//validate last name
	if (preg_match($lname_regex, $last_name)) {
		$valid_lname = 1;
	} else {
		$error_text .= "$lname_error_msg<br />\n\r";
	}
	
	//validate phone number
	if (preg_match($phone_regex, $phone)) {
		$valid_phone = 1;
	} else {
		$error_text .= "$phone_error_msg<br />\n\r";
	}
	
	//validate city
	if (preg_match($city_regex, $city)) {
		$valid_city = 1;
	} else {
		$error_text .= "$city_error_msg<br />\n\r";
	}	
	
	//validate state
	if (preg_match($state_regex, $state)) {
		$valid_state = 1;
	} else {
		$error_text .= "$state_error_msg<br />\n\r";
	}	
	
	
	if ($valid_fname && $valid_lname && $valid_phone && $valid_city && $valid_state) {
		$output_form = 0;
		}
		else {$error_text = "<p>$error_text</p>\n\r";}
	
} // end if/else form output

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css">
<title>Lesson 7 Homework</title>
</head>

<body>
<?php
	if ($output_form) {
?>

    <form action="<?= $_SERVER['sarahyoder_l6/PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    	<div class="error_text"><?= $error_text ?></div>
    	First Name:
    	<input name="fname" type="text" value="<?=$first_name ?>" /><br />
    	Last Name:
   	  <input name="lname" type="text" value="<?=$last_name ?>" /><br />
   		Phone Number:
   	  <input name="phone" type="text" value="<?=$phone ?>"  /><br />
    	City:
   	  <input name="city" type="text" value="<?=$city ?>" /><br />
    	State:
   	  <input name="state" type="text" value="<?=$state ?>" /><br />
     	<input name="submit" type="submit" />
    </form>

<?php
	} else {
?>

	<div class="output_text">
    	<p><?= $user_lname ?>, <?= $user_fname ?></p>
        <p>Phone Number: <?= $phone_output ?></p>
        <p><?= $user_city ?>, <?= $user_state ?></p>
   </div>
   
<?php
	} // end if/else form output
?>

</body>
</html>