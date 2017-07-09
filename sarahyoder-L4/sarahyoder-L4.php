<?php

	$output_form = 1;
	$error_text = "";
	
	$fname = "";
	$lname = "";
	$user_file = "";
	
	if (isset($_POST['submit'])) { // data posted
		
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
	} // end if/else (isset($_POST['submit']))
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Homework 4</title>
</head>
<body>

<?php
	if ($output_form) {
?>

	<h2>User Photo Entry Form</h2>
    
    	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        	<?=$error_text ?>
            <table>
            <tr>
            	<td>First Name: </td><td><input name="fname" type="text" value="<?=$fname ?>" /></td>
            </tr>
            <tr>
            	<td>Last Name: </td><td><input name="lname" type="text" value="<?=$lname ?>" /></td>
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