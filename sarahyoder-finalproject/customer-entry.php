<?php
	// Start the session
	require_once('./inc/startsession.php');
  
	$error_msg = "";
	$output_form = true;

	require_once('./inc/connectvars.php');
	$dbc = mysqli_connect(HOST, USER, PW, DBNAME);
	
	if (isset($_POST['submit'])) {// Get data from signup form
		$companyName = mysqli_real_escape_string($dbc, trim($_POST['companyName']));
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
		$tel = mysqli_real_escape_string($dbc, trim($_POST['tel']));
		$address1 = mysqli_real_escape_string($dbc, trim($_POST['address1']));
    		$address2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
	    	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
		$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
		$postalCode = mysqli_real_escape_string($dbc, trim($_POST['postalCode']));
		$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
		$employeeNumber = mysqli_real_escape_string($dbc, trim($_POST['employeeNumber']));
		$creditLimit = mysqli_real_escape_string($dbc, trim($_POST['creditLimit']));
	
			if (!empty($companyName) && !empty($firstName) && !empty($lastName) && !empty($tel) && !empty($address1) && !empty($city) && !empty($postalCode) && !empty($country) && !empty($employeeNumber) && !empty($creditLimit)) {
			
      			// Make sure customer not already in database
      			$query1 = "SELECT * FROM customers WHERE customerName = '$companyName'";
     			$data = mysqli_query($dbc, $query1)
	  				or die ('Error querying database 1');
					
      			if (mysqli_num_rows($data) == 0) { // The customer is unique so add to database
				$query2 = "INSERT INTO `customers` (`customerName`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`) VALUES ('$companyName', '$lastName', '$firstName', '$tel', '$address1', '$address2', '$city', '$state', '$postalCode', '$country', '$employeeNumber', '$creditLimit')";

        			$data = mysqli_query($dbc, $query2)
							or die ('Error querying database 2');
							
					$output_form = false;
				
        		} else {
        			// The customer already exists
        			$error_msg = '<p class="error_text">That company is already in the database!</p>';
        			$companyName = "";
      			}
			}
			else { // a field was missed
			$error_msg = '<p class="error_text">Whoops, you missed a field or two! Please be sure to input data into all of the fields.</p>';
    	}
	}
	
require_once('./inc/header.php');
require_once('./inc/check-login.php');	
require_once('./inc/private-nav.php');
?>

<div class="container">
  <div class="row">
    <div class="col-sm-6">
    
<?php
	echo $error_msg;
	if ($output_form) {
?>
	<h1>Add a Customer</h1>

 	<p>Please fill out this form to add a new customer to the database!</p>
  		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      		Company Name:
      		<input type="text" id="companyName" name="companyName" value="<?php if (!empty($companyName)) echo $companyName; ?>" /><br />
      		Contact's First Name:
      		<input type="text" id="firstName" name="firstName" value="<?php if (!empty($firstName)) echo $firstName; ?>" /><br />
            Contact's Last Name:
      		<input type="text" id="lastName" name="lastName" value="<?php if (!empty($lastName)) echo $lastName; ?>" /><br />
     		Phone Number:
     		 <input type="tel" id="tel" name="tel" value="<?php if (!empty($tel)) echo $tel; ?>" /><br />
     		 Address 1:
     		 <input type="text" id="address1" name="address1" value="<?php if (!empty($address1)) echo $address1; ?>" /><br />
			Address 2:
     		 <input type="text" id="address2" name="address2" value="<?php if (!empty($address2)) echo $address2; ?>" /><br />
			City:
     		 <input type="text" id="city" name="city" value="<?php if (!empty($city)) echo $city; ?>" /><br />
             State:
     		 <input type="text" id="state" name="state" value="<?php if (!empty($state)) echo $state; ?>" /><br />
             Postal Code:
     		 <input type="number" id="postalCode" name="postalCode" value="<?php if (!empty($postalCode)) echo $postalCode; ?>" /><br />
             Country:
     		 <input type="text" id="country" name="country" value="<?php if (!empty($country)) echo $country; ?>" /><br />
             Employee Number:
             <select name="employeeNumber" id="employeeNumber">
	        	<option disabled selected value>Select an employee number</option>
<?php
  $query3 = "SELECT * FROM `employees`";
    	
  $result = mysqli_query($dbc, $query3)
			or die ('Error querying database');
			
			
  while ($newArray = mysqli_fetch_array($result)) { //loop through and print out records
		$employeeNumber = $newArray[employeeNumber];

?>
				<option value="<?= $employeeNumber ?>"><?= $employeeNumber ?></option>
<?php
   } // end while loop
?>                
				</select><br />
             Credit Limit:
     		 <input type="number" id="creditLimit" name="creditLimit" value="<?php if (!empty($creditLimit)) echo $creditLimit; ?>" /><br />
    		<input type="submit" value="SUBMIT" name="submit" />
  		</form>
<?php
	} else {
?>

	<div class="output_text">
    Thank you for adding a customer!
   		<p>Company: <?= $companyName ?></p>
    	<p>Contact: <?= $firstName ?> <?= $first_name ?></p>
        <p>Phone Number: <?= $tel ?>, <?= $phone_compact ?></p>
        <p>Address: <?= $address1 ?><br /><?= $address2 ?></p>
        <p>City: <?= $city ?></p>
   		<p>Country: <?= $country?></p>
        <p>Postal Code: <?= $postalCode?></p>
        <p>Sales Rep Employee Number: <?= $employeeNumber?></p>
        <p>Credit Limit: <?= $creditLimit?></p>
   </div>
   
<?php
	} // end if/else form output
?>
    </div>
  </div>
</div>
<br />
<br />
<?php
require_once('./inc/footer.php');
?>
