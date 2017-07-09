
<?php

	$host = "gator3258.hostgator.com";
	$dbname = "syoder_php_class_sample";
	$dbuser = "syoder_webUser5";
	$pwd = "3?+5._=o5T7a";
	$dbc = 0;
	
	$dbc = mysqli_connect($host, $dbuser, $pwd, $dbname)
		or die ('Cannot connect to database');
	
	$query = "SELECT `customerNumber` , `customerName` , `city` , `country` FROM `customers` ORDER BY customerNumber ASC LIMIT 20";
	
	$result = mysqli_query($dbc, $query)
		or die ('Error querying database');

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css.css">
<title>PHP Homework 2</title>
</head>

<body>
	<h1>Customers</h1>
    
    <table>
    		<tr>
        		<td class="first">Customer ID</td>
           		<td class="first">Customer Name</td>
				<td class="first">City</td>
				<td class="first">Country</td>
        	</tr>
<?php

	$row_count = 1;

	while ($row = mysqli_fetch_array($result)) {
		$customer_id = $row['customerNumber'];
		$customer_name = $row['customerName'];
		$city = $row['city'];
		$country = $row['country'];	
		
		$row_count++;
		
		if ($row_count%2 == 0) { // even row
		
			echo
				"\t\t\t<tr>
					<td class='color_row'>$customer_id</td>
					<td class='color_row'>$customer_name</td>
					<td class='color_row'>$city</td>
					<td class='color_row'>$country</td>
				</tr>\r\n";
		} else {
				
			echo
				"\t\t\t<tr>
					<td>$customer_id</td>
					<td>$customer_name</td>
					<td>$city</td>
					<td>$country</td>
				</tr>\r\n";
			
		} // end if/else
		
	}//end while loop
?>
        
        
    </table>

<?php
	mysqli_close($dbc);
?>

</body>
</html>