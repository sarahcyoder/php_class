<?php
    // Start the session
  require_once('./inc/startsession.php');
  
  // function draw graph
  function draw_bar_graph($width, $height, $data, $max_value, $graph_name) {
    
	// Create img
    $img = imagecreatetruecolor($width, $height);
	
	// Set a colors  
	$bg_color = imagecolorallocate($img, 200, 250, 250);       // soft cyan   
	$text_color = imagecolorallocate($img, 255, 255, 255);     // white    
	$bar_color = imagecolorallocate($img, 6, 72, 71);            // dark cyan
    $border_color = imagecolorallocate($img, 192, 192, 192);   // light gray

    // Fill the background
    imagefilledrectangle($img, 0, 0, $width, $height, $bg_color);
	
    // Draw the bars
    $bar_width = $width / ((count($data) * 2) + 1);
    for ($i = 0; $i < count($data); $i++) {
      	imagefilledrectangle($img, ($i * $bar_width * 2) + $bar_width, $height, ($i * $bar_width * 2) + ($bar_width * 2), $height - (($height / $max_value) * ($data[$i][1])), $bar_color);
    	imagestringup($img, 5, ($i * $bar_width * 2) + ($bar_width), $height - 5, $data[$i][0], $text_color);
    }
	
    // Draw a rectangle around the whole thing
    imagerectangle($img, 0, 0, $width - 1, $height - 1, $border_color);

    // Draw the range up the left side of the graph
    for ($i = 0; $i <= $max_value; $i+=5) {
      imagestring($img, 5, 0, $height - ($i * ($height / $max_value)), $i, $bar_color);
    }

    // Write the graph image to a file
    imagepng($img, $graph_name, 5);
	imagedestroy($img);
	
  } // End of draw_bar_graph() function

  require_once('./inc/connectvars.php');

  // Insert the page header and nav
  require_once('./inc/header.php');
  require_once('./inc/check-login.php');
  require_once('./inc/private-nav.php');

  // Connect to the database
  $dbc = mysqli_connect(HOST, USER, PW, DBNAME);

  $query0 = "SELECT * FROM `customers` WHERE creditLimit = 0";
  $result0 = mysqli_query($dbc, $query0);
  $bar0 =  mysqli_num_rows($result0);
  
  $query1 = "SELECT * FROM `customers` WHERE creditLimit BETWEEN 1 AND 50001 ";
  $result1 = mysqli_query($dbc, $query1);
  $bar1 =  mysqli_num_rows($result1);
  
  $query2 = "SELECT * FROM `customers` WHERE creditLimit BETWEEN 50000 AND 75001";
  $result2 = mysqli_query($dbc, $query2);
  $bar2 =  mysqli_num_rows($result2);
  
  $query3 = "SELECT * FROM `customers` WHERE creditLimit BETWEEN 75000 AND 100001";
  $result3 = mysqli_query($dbc, $query3);
  $bar3 =  mysqli_num_rows($result3);
  
  $query4 = "SELECT * FROM `customers` WHERE creditLimit > 100000";
  $result4 = mysqli_query($dbc, $query4);
  $bar4 =  mysqli_num_rows($result4);
  
  $bars = array(
  	array("Credit Limit = 0", $bar0), 
	array("1 to 50,000", $bar1),
	array("50,001 to 75,000", $bar2),
	array("75,000 to 100,000", $bar3),
	array("Over 100,000", $bar4),
	);
  
  $graph_name = "./charts/creditlimit.png";
?>
<div class="container">
  	<div class="row">
    	<div class="col-sm-12">
<?php
        // Generate and display the bar graph image
        echo "\t\t\t<h4>Credit Limits</h4>\n";
        draw_bar_graph(600, 500, $bars, 40, $graph_name);
        echo "\t\t\t<img src='./charts/creditlimit.png' alt='Customer Credit Limit Graph' />
		<br /><br />
		</div>
	</div>
</div>\n\r";
  mysqli_close($dbc);

  // footer
  require_once('./inc/footer.php');
?>