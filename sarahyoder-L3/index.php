<?php
    
	$output_form = true;
	$error_text = "";

	if (isset($_POST['submit'])) { //data posted
	
   	/*	echo "<pre>";
         print_r($_POST);
        echo "</pre>";   */
        
        $user_fname = trim($_POST['fname']);
        $user_number = trim($_POST['number']);
        $user_sentence = trim($_POST['sentence']);  
	
	function welcome($fname) {
		if (!empty($fname)) {
			$msg = "Welcome, $fname!";
			$output_form = false;
			return($msg);
		}
		else {
			return(false);
		}
	}
	
	function process_number($number) {
		
		if ($number >= 100 && $number <= 200) {
			$output_form = false;
			$sq_root = sqrt($number);
			$cubed = pow($number, 3);
			$msg = "The square root of your number - $number - is $sq_root, and $number cubed equals $cubed";
			return($msg);
		}
		else {
			return(false);
		}
	}
		
	function process_sentence($sentence) {
		$length = strlen($sentence);
		if ($length > 20) {
			$output = '';
			$msg = substr($sentence, -9);
			$output_form = false;
			return($msg);
		}
		else {
			return(false);
		}
	}

$user_greeting = welcome($user_fname);
$number_output = process_number($user_number);
$sentence_output = process_sentence($user_sentence);

   		echo "<pre>";
         print_r($user_greeting);
		 print_r($sentence_output);
		 print_r($number_output);
		 print_r($error_text);
        echo "</pre>";
		
if ($user_greeting = false) {
	$output_form = true;
	$error_text .= "<p>Please enter your name!</p>";
	}
	else if ($number_output = false) {
	$output_form = true;
	$error_text .= "<p>Your number wasn't in the correct range. Please input a number from 100 to 200.</p>";
	}
		else if ($sentence_output = false) {
	$output_form = true;
	$error_text .= "<p>Your sentence was too short! Please input at least 20 characters.</p>";
	
	} 

}// end submit if statement

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lesson 6 Homework</title>
</head>

<body>
<?php
	if ($output_form) {
?>
<p>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <?= $error_text ?>
    <table>
    	<tr>
        	<td>First Name:</td><td><input name="fname" type="text" value="<?=$user_fname ?>" /></td>
        </tr>
    	<tr>
        	<td>Number:</td><td><input name="number" type="text" value="<?=$user_number ?>"  /></td>
        </tr>
        <tr>
        	<td>Sentence:</td><td><input name="sentence" type="text" value="<?=$user_sentence ?>" /></td>
        </tr>
        </table>
       	<input name="submit" type="submit" />
    </form>
<?php
	} else {
?>

    <p>
    	<?= $user_greeting ?><br />
        <?= $number_output ?><br />
        <?= $sentence_output ?><br />
    </p>
    
<?php
	} // end if/else form output
?>

</body>
</html>