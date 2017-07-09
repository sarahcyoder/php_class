<?php
  // Start session
  require_once('./inc/startsession.php');
  
  require_once('./inc/header.php');
  require_once('./inc/check-login.php');
  require_once('./inc/private-nav.php');
?>
<div class="container">
  <div class="row">
    <div class="col-sm-6">

	<?php echo '<h1>Welcome, ' . $_SESSION['username'] . '</h1>';
	?>
    
    <ul>
    	<li><a href="inventory.php">Product Inventory Report</a></li>
    	<li><a href="customer-entry.php">Customer Entry</a></li>
    	<li><a href="bar-chart.php">Bar Chart Report</a></li>
    	<li><a href="select-rss.php">RSS Feed</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
   
	</div>
  </div>
</div>
<?php
require_once('./inc/footer.php');
?>