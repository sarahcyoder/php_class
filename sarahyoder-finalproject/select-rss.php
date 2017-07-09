<?php
session_start();
	
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
    <div class="col-sm-3">
	   <h1>RSS Feeds</h1>
       
<?php
  require_once('./inc/connectvars.php');
  $dbc = mysqli_connect(HOST, USER, PW, DBNAME);
  $query = "SELECT * FROM `productlines`";
    	
  $result = mysqli_query($dbc, $query)
			or die ('Error querying database');
			
  while ($newArray = mysqli_fetch_array($result)) { //loop through and print out records
		$productLine = $newArray[productLine];
		$productLineLink = str_replace(' ', '+', $productLine);

?>
		<a href="http://findingbulgaria.com/php-class/sarahyoder-finalproject/rss.php?productLine=<?= $productLineLink ?>"><?= $productLine ?></a><br />
<?php
   } // end while loop
?>
	<br />
    </div>
  </div>
</div>
<?php
require_once('./inc/footer.php');
?>