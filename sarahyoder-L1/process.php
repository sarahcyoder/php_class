
<?php
	
	$uname = $_POST['name'];
	$uage = $_POST['age'];
	$unewage = $uage + 10;
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lesson 1 Homework</title>
</head>

<body>

    <?php
		//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
	?>
    
    <h1>Hello <strong><?php echo "$uname"; ?></strong></h1>
    
    <p>In 10 years, you will be <?php echo "$unewage"; ?> years old.</p>

</body>
</html>