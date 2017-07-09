<?php
require_once "./includes/variables.inc.php";
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="utf-8"?>';
	$builddate = gmdate(DATE_RSS, time());
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
    	<title>Trains and Vintage Cars</title>
       <atom:link href="http://<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ?>" rel="self" type="application/rss+xml" />
        <link>http://findingbulgaria.com/php-class/sarahyoder-L9/autorss.php</link>
        <description>The latest trains and vintage car models</description>
        <lastBuildDate><?= $builddate ?></lastBuildDate>
        <language>en-us</language>
        
<?

  // Connect to the database 
  	$dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME);
	$query = "SELECT * FROM products WHERE productLine IN ('Vintage Cars', 'Trains') ORDER BY dateAdded DESC LIMIT 10";
	
	$result = mysqli_query($dbc, $query)
		or die ('Error querying database');
		
	while ($newArray = mysqli_fetch_array($result)) { //loop through and print out records
		$product_code = $newArray[productCode];
		$name = $newArray[productName];
		$line = $newArray[productLine];
		$scale = $newArray[productScale];
		$vendor = $newArray[productVendor];
		$description = $newArray[productDescription];
		$buyPrice = money_format("%i", $newArray[buyPrice]);
		
		
		
		$dateAdded = $newArray[dateAdded];
		
		$pubdate = date(DATE_RSS, strtotime($dateAdded));
?>
	<item>
    	<title><?= $name ?></title>
        <description>From <?= $vendor ?> in our <?= $line ?> collection, this item, a <?= $scale ?> replica, costs $<?= $buyPrice ?>. <?= $description ?></description>
        <link>http://findingbulgaria.com/php-class/sarahyoder-L9/product.php?pid=<?= $product_code ?></link>
        <guid isPermaLink="false">http://findingbulgaria.com/php-class/sarahyoder-L9/product.php?pid=<?= $product_code ?></guid>
        <pubDate><?= $pubdate ?></pubDate>
    </item>
    
<?
	}// end while
?>
	</channel>
</rss>