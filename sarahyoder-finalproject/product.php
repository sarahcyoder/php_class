<?php 
session_start();
require_once('./inc/connectvars.php');

$debug = 0;
$output = 'No product information';

	if (isset($_GET['pid'])) {
		
		$product_number = trim($_GET['pid']);
		
		  // Connect to the database 
  		$dbc = mysqli_connect(HOST, USER, PW, DBNAME);
		
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
				
				$output =
				"<p>Name: $name</p>
				<p>Product Line: $line </p>
				<p>Product Scale: $scale </p>
				<p>Vendor: $vendor</p>
  				<p>Description: $description</p>
				<p>Buy Price: $$buyPrice</p>\r\n";
							
			}// end while
			
		} else {$output = 'No match found';}
	}
	
require_once('./inc/header.php');
// Check if the user is logged in
if (!isset($_SESSION['employeeNumber'])) {
	require_once('./inc/public-nav.php');;
	}
		else {
		require_once('./inc/private-nav.php');
		}
?>
<div class="container">
  <div class="row">
    <div class="col-sm-9">
	  <h2>Product Page</h2>

	<?= $output ?>
    </div>
  </div>
</div>
<?php
require_once('./inc/footer.php');
?>