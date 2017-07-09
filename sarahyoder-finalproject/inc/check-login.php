<?php
// Make sure the user is logged in
if (!isset($_SESSION['employeeNumber'])) {
	echo
		'<div class="container">
  			<div class="row">
    			<div class="col-sm-6">
					<p class="error_text">Please <a href="index.php">log in</a> to access this page.</p>
				</div>
			</div>
		</div>';
		exit();
	}
?>