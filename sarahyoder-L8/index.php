<?php
	$debug = false;

	$output_form = true;
	$error_text = '';

	$user_input = '';
	$regex = '/^([^\W_]|\$|\^|@){5}$/';
	$error_msg = '';

if (isset($_POST['submit'])) { //on form submission
	
	if ($debug) { //only if in debug mode
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
	}
	
	$user_input = trim($_POST['userInput']);
	
	//validate input
	if (preg_match($regex, $user_input)) {
		$output_form = false;
	} else {
		$error_msg = "<p>Please enter 5 characters, which can be letters, numbers, $, ^, or @.</p>";
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css">
<title>Lesson 8 Homework</title>
</head>
<body>
<?php
	if ($output_form) {
?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    	<div class="error_text"><?= $error_msg ?></div>
    	Enter 5 characters (letters, numbers, $,^, or @):
    	<input name="userInput" type="text" value="<?=$user_input ?>" /><br />
     	<input name="submit" type="submit" />
    </form>

<?php
	} else {
?>

	<p>Your number in CAPTCHA style looks like this:
    <br />
    <img src="captcha.php?uInput=<?=$user_input ?>" alt="user generated captcha" ></p>
    <p><a href="<?= $_SERVER['PHP_SELF'] ?>">Try Again</a></p>
   
<?php
	} // end if/else form output
?>
</body>
</html>