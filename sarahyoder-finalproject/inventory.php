<?php
  require_once('./inc/connectvars.php');
  
  // Start the session
  require_once('./inc/startsession.php');
  
  require_once('./inc/header.php');
  require_once('./inc/check-login.php');

  // Make sure the user is logged in
  if (!isset($_SESSION['employeeNumber'])) {
    echo '<p>Please <a href="index.php">log in</a> to access this page.</p>';
    exit();
  }
  
  require_once('./inc/private-nav.php');
  
?>
<div class="container">
  <div class="row">
    <div class="col-sm-3">

	<h1>Product Line</h1>
    
    <h5>Choose a product line to view a report</h5>
		<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    		<select name="productLine">
            	<option disabled selected value>Select a product line</option>
<?php
  $dbc = mysqli_connect(HOST, USER, PW, DBNAME);
  $query = "SELECT * FROM `productlines`";
    	
  $result = mysqli_query($dbc, $query)
			or die ('Error querying database');
			
  while ($newArray = mysqli_fetch_array($result)) { //loop through and print out records
		$productLine = $newArray[productLine];

?>
				<option value="<?= $productLine ?>"><?= $productLine ?></option>
<?php
   } // end while loop
?>                
			</select><br />
    	  <input type="submit" value="SUBMIT" />
		</form>
    </div>
  </div>
</div>
<div class='container'>
  <div class='row'>
    <div class='col-sm-9'>
<?php
  // Calculate pagination information
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $recordLmt = 10;  // number of results per page
  $skip = (($currentPage - 1) * $recordLmt);
		
  // Get data from form
  $productLine = $_GET['productLine'];
?>
		<h3><?= $productLine ?></h3>
		<table>
			<tr>
        		<td class='first'>Code</td>
           		<td class='first'>Name</td>
				<td class='first'>Scale</td>
				<td class='first'>Vendor</td>
				<td class='first'>Description</td>
				<td class='first'>Quantity in Stock</td>
				<td class='first'>Buy Price</td>
				<td class='first'>MSRP</td>
        	</tr>
<?php
		
  $query = "SELECT * FROM `products` WHERE `productLine` = '$productLine' ORDER BY `buyPrice` ASC";
    	
  $result = mysqli_query($dbc, $query)
			or die ('Error querying database');
	
  $total = mysqli_num_rows($result);
  $numberPages = ceil($total / $recordLmt);

  // Query again to get subset of results
  $query =  $query . " LIMIT $skip, $recordLmt";
  $result = mysqli_query($dbc, $query);
	
  $row_count = 1;
				
  while ($row = mysqli_fetch_array($result)) {
	$productCode = $row['productCode'];
	$productName = $row['productName'];
	$productScale = $row['productScale'];
	$productVendor = $row['productVendor'];
	$productDescription = $row['productDescription'];	
	$quantityInStock = $row['quantityInStock'];
	$buyPrice = money_format("%i", $row['buyPrice']);
	$msrp = money_format("%i", $row['MSRP']);
	
	$row_count++;
		
	if ($row_count%2 == 0) { // every other row has bg color
		
		echo
			"\t\t\t<tr>
				<td class='color_row'>$productCode</td>
				<td class='color_row'>$productName</td>
				<td class='color_row'>$productScale</td>
				<td class='color_row'>$productVendor</td>
				<td class='color_row'>$productDescription</td>
				<td class='color_row'>$quantityInStock</td>
				<td class='color_row'>$$buyPrice</td>
				<td class='color_row'>$$msrp</td>
			</tr>\r\n";
	} else {
				
		echo
			"\t\t\t<tr>
				<td>$productCode</td>
				<td>$productName</td>
				<td>$productScale</td>
				<td>$productVendor</td>
				<td>$productDescription</td>
				<td>$quantityInStock</td>
				<td>$$buyPrice</td>
				<td>$$msrp</td>
			</tr>\r\n";
		
	} // end if/else for colored rows
		
  }//end while loop

?>
    	</table>
<?php
  function generate_page_links($currentPage, $numberPages, $productLine) {
    $pageLinks = '';
	$productLine = str_replace(' ', '+', $productLine);

    // If current page is not the first page, add the <- link
    if ($currentPage > 1) {
      $pageLinks .= '<a href="' . $_SERVER['PHP_SELF'] . '?productLine=' . $productLine . '&amp;page=' . ($currentPage - 1) . '">&lt;-</a> ';
    }

    // Generate the page number links
    for ($i = 1; $i <= $numberPages; $i++) {
      if ($currentPage == $i) {
        $pageLinks .= ' ' . $i;
      }
      else {
        $pageLinks .= ' <a href="' . $_SERVER['PHP_SELF'] . '?productLine=' . $productLine . '&amp;page=' . $i . '"> ' . $i . '</a>';
      }
    }

    // If current page isn't the last page, add the -> link
    if ($currentPage < $numberPages) {
      $pageLinks .= ' <a href="' . $_SERVER['PHP_SELF'] . '?productLine=' . $productLine . '&amp;page=' . ($currentPage + 1) . '">-></a>';
    }

    return $pageLinks;
  }
  
    // Generate navigational page links if we have more than one page
  if ($numberPages > 1) {
    echo generate_page_links($currentPage, $numberPages, $productLine);
  }
  
?>
    <br />
    <br />
	</div>
  </div>
</div>

<?php
	mysqli_close($dbc);
	require_once('./inc/footer.php');
?>