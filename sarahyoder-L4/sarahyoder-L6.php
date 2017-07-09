<?php

	$output_form = true;
	$error_text = "";
	
	$user_fname = "";
	$user_number = "";
	$user_sentence = "";
	function welcome($fname) {
		if (!empty($fname)) {
			$msg = "Welcome, $fname!";
			$output_form = false;
			return $msg;
		}
		else {
			return false;
		}
	} // end welcome fcn
	
	function process_number($number) {
		
		if ($number >= 100 && $number <= 200) {
			$output_form = false;
			$sq_root = sqrt($number);
			$cubed = pow($number, 3);
			$msg = "The square root of your number - $number - is $sq_root, and $number cubed equals $cubed.";
			return $msg;
		}
		else {
			return false;
		}
	} // end number fcn
		
	function process_sentence($sentence) {
		$length = strlen($sentence);
		if ($length > 20) {
			$output = '';
			$msg = substr($sentence, -9);
			$output_form = false;
			return $msg;
		}
		else {
			return false;
		}
	} // end sentence fcn


	if (isset($_POST['submit'])) { //data posted
	
   		/* echo "<pre>";
         print_r($_POST);
        echo "</pre>";    */
        
        $user_fname = trim($_POST['fname']);
        $user_number = trim($_POST['number']);
        $user_sentence = trim($_POST['sentence']); 
	}// end submit if statement 

		$user_greeting = welcome($user_fname);
		$number_output = process_number($user_number);
		$sentence_output = process_sentence($user_sentence);

   		echo "<pre>";
         print_r($user_greeting);
		 print_r($number_output);
		 print_r($sentence_output);
		 print_r($error_text);
        echo "</pre>";
		
if ($user_greeting = false) {
	$output_form = true;
	$error_text .= "<p>Please enter your name!</p>";
	}
	
if ($number_output = false) {
	$output_form = true;
	$error_text .= "<p>Your number wasn't in the correct range. Please input a number from 100 to 200.</p>";
}
if ($sentence_output = false) {
	$output_form = true;
	$error_text .= "<p>Your sentence was too short! Please input at least 20 characters.</p>";
}

	
/*	if (isset($_POST['submit'])) { // data posted
		
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		
		
		// check for empty fields and proper file info
		if (empty($_POST['fname']) ||
			empty($_POST['lname'])){
			
			$error_text .= "<p>All fields are mandatory.</p>";
			$output_form = 1;
		} 
					else {
						$output_form = 0;
					} // end if/else final checks
	} // end if/else  */
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Homework 4</title>
</head>
<body>

<?php
	if ($output_form = true) {
?>

	<h2>User Photo Entry Form</h2>
    
    	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        	<?=$error_text ?>
            <table>
            <tr>
            	<td>First Name: </td><td><input name="fname" type="text" value="<?=$fname ?>" /></td>
            </tr>
            <tr>
            	<td>Number: </td><td><input name="number" type="text" value="<?=$lname ?>" /></td>
            </tr>
            <tr>
            	<td>Sentence: </td><td><input name="sentence" type="text" value="<?=$lname ?>" /></td>
            </tr>
            </table>
            <input name="submit" type="submit" />
        </form>
<?php
	} else {
?>

	<h2>Thank you for adding your photo!</h2>
    <p>
    	Name: <?= $fname.' '.$lname ?><br />
    </p>
    
<?php
	} // end if/else form output
?>

</body>
</html>