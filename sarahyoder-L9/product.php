<?php 

$debug = 0;

require_once "./includes/variables.inc.php";

$output = 'No product information';

	if (isset($_GET['pid'])) {
		
		$product_number = trim($_GET['pid']);
		
		  // Connect to the database 
  		$dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME);
		
		$query = "SELECT * FROM products WHERE productCode = '$product_number'";
		$result = mysqli_query($dbc, $query)
		or die ("Error querying database => $query");
		
		$num_rows = mysqli_num_rows($result);
		
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_array($result)) {
				$product_code = $row['productCode'];
				$name = $row['productName'];
				$line = $row['productLine'];
				$scale = $row['productScale'];
				$vendor = $row['productVendor'];
				$description = $row['productDescription'];
				$buyPrice = money_format("%i", $row['buyPrice']);
				
				$output = "<p>Name: $name</p>
							<p>Product Line: $line </p>
							<p>Product Scale: $scale </p>
							<p>Vendor: $vendor</p>
							<p>Description: $description</p>
							<p>Buy Price: $$buyPrice</p>";
							
			}// end while
			
		} else {$output = 'No match found';}
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $name ?></title>
</head>

<body>

	<h2>Product Page</h2>

	<?= $output ?>
    
</body>
</html>