<?php

	$debug = false;
	
	//set form output and error text vars
	$output_form = true;
	$error_text = "";
	
	//set input and regex vars
	$first_name = '';
	$valid_fname = false;
	$fname_regex = '/^([A-Z]|[a-z]){2,15}$/';
	$fname_error_msg = 'First name must be 2-15 letters.';
	
	$last_name = '';
	$valid_lname = false;
	$lname_regex = '/^([A-Z]|[a-z]){2,15}$/';
	$lname_error_msg = 'Last name must be 2-15 letters.';
		
	$phone = '';
	$valid_phone = false;
	$phone_regex = '/^\(\d{3}\)\d{3}-\d{4}$/';
	$phone_error_msg = 'Phone number must be in (XXX)XXX-XXXX format, with only numbers.';
	//set phone replace vars
	$phone_compact = '';
	$phone_remove = '/[^\d]/';
	$phone_replace = '';
	
	$city = '';
	$valid_city = false;
	$city_regex = '/^([A-Z]|[a-z]){3,20}$/';
	$city_error_msg = 'City must be 3 to 20 letters.';
	
	$state = '';
	$valid_state = false;
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
		$valid_fname = true;
	} else {
		$error_text .= "$fname_error_msg<br />";
	}
	
	//validate last name
	if (preg_match($lname_regex, $last_name)) {
		$valid_lname = true;
	} else {
		$error_text .= "$lname_error_msg<br />";
	}
	
	//validate phone number
	if (preg_match($phone_regex, $phone)) {
		$valid_phone = true;
	} else {
		$error_text .= "$phone_error_msg<br />";
	}
	
	//validate city
	if (preg_match($city_regex, $city)) {
		$valid_city = true;
	} else {
		$error_text .= "$city_error_msg<br />";
	}	
	
	//validate state
	if (preg_match($state_regex, $state)) {
		$valid_state = true;
	} else {
		$error_text .= "$state_error_msg<br />";
	}
	
	// reformat phone number
	$phone_compact = preg_replace($phone_remove, $phone_replace, $phone);
	
	
	if ($valid_fname && $valid_lname && $valid_phone && $valid_city && $valid_state) {
		$output_form = false;
		}
		else {$error_text = "<p>$error_text</p>";}
	
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

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    	<div class="error_text"><?= $error_text ?></div>
    	First Name:
    	<input name="fname" type="text" value="<?=$first_name ?>" /><br />
    	Last Name:
   	  <input name="lname" type="text" value="<?=$last_name ?>" /><br />
   		Phone Number in (XXX)XXX-XXXX format:
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
    	<p><?= $last_name ?>, <?= $first_name ?></p>
        <p>Phone Number: <?= $phone ?>, <?= $phone_compact ?></p>
        <p><?= $city ?>, <?= $state ?></p>
   </div>
   
<?php
	} // end if/else form output
?>

</body>
</html>