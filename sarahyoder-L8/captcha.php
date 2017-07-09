<?php
  $user_input = $_GET['uInput'];
  
  //create array from user input
  $captcha_chars = str_split($user_input);
  
  //image vars
  $image_width = 200;
  $image_height = 50;
  
  //initialize vars for writing captcha from user input
  $angle = 10;
  $text_x = "15";

  //create the image
  $img = imagecreatetruecolor($image_width, $image_height);
  
  //colors
  $bg_color = imagecolorallocate($img, 224, 255, 255); //cyan  
  $text_color = imagecolorallocate($img, 0, 0, 0);     // black   
  $line_color = imagecolorallocate($img, 255, 105, 180);// pink
  $dot_color = imagecolorallocate($img, 0, 100, 0);   //green

  // background fill
  imagefilledrectangle($img, 0, 0, $image_width, $image_height, $bg_color);
  
  // draw lines
  for ($i = 0; $i < 5; $i++) {
    imageline($img, 0, rand() % $image_height, $image_width, rand() % $image_height, $line_color);
  }

  // add dots
  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($img, rand() % $image_width, rand() % $image_height, $dot_color);
  }
  
  // Draw user generated captcha with increasing angle
  for ($i = 0; $i <= 4; $i++) {
  	imagettftext($img, 42, $angle, $text_x, $image_height - 5, $text_color, '/fonts/LuxuryImport.ttf', $captcha_chars[$i]);
	$angle+=10;
	$text_x+=40;
  }

  // Output the image as a PNG
  header("Content-type: image/png"); imagepng($img);

  // Destroy!
  imagedestroy($img);
?>