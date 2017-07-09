<?php
  session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome Page</title>
</head>
<body>
	<?php echo '<h1>Welcome, ' . $_SESSION['username'] . '</h1>';
    echo '<a href="logout.php">Log Out</a>';
?>

</body> 
</html>