<?php

// Gets the average difficulties for all the algorithms
function get_avg_diffs($avg)
{

	$num_avg = $avg;
	
	// Establish connection to the database
	$con = mysqli_connect("127.0.0.1", "root", "peanutbutteronmyballs", "myriadcoin");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	// Query database for difficulties
	$result = mysqli_query($con, "SELECT * FROM `difficulties`");
	
	// Obtain the number of rows from the result of the query
	$num_rows = mysqli_num_rows($result);
	
	// Will be storing all the rows in here
	$array_of_rows = array();
	
	// Get all the rows
	for($i = 0; $i < $num_rows; $i++)
	{
		$array_of_rows[$i] = mysqli_fetch_array($result);
	}

	$size_of_array_of_rows = $num_rows - 1;
	
	$sha_values = array();
	$scrypt_values = array();
	$skein_values = array();
	$groestl_values = array();
	$qubit_values = array();

	// Get an array of the past N difficulties for each algorithm
	for($i = ($size_of_array_of_rows - $num_avg); $i < $size_of_array_of_rows; $i++)
	{
		$sha_values[$i] = $array_of_rows[$i]["sha"];
		$scrypt_values[$i] = $array_of_rows[$i]["scrypt"];
		$skein_values[$i] = $array_of_rows[$i]["skein"];
		$groestl_values[$i] = $array_of_rows[$i]["groestl"];
		$qubit_values[$i] = $array_of_rows[$i]["qubit"];
	}

	// Calculate the average value of all values in each array, stick the results in an array and return results
	$diffs = array();
	$diffs[0] = array_sum($sha_values)/$num_avg;
	$diffs[1] = array_sum($scrypt_values)/$num_avg;
	$diffs[2] = array_sum($skein_values)/$num_avg;
	$diffs[3] = array_sum($groestl_values)/$num_avg;
	$diffs[4] = array_sum($qubit_values)/$num_avg;
	
	mysqli_close($con);
	
	return $diffs;
}

function get_myr_price()
{
	$myr_price = 0;
	
	$url = fopen("http://pubapi.cryptsy.com/api.php?method=singlemarketdata&marketid=200", "r");
	
	$json = json_decode(stream_get_contents($url));
	
	$myr_price = $json->{"return"}->{"markets"}->{"MYR"}->{"lasttradeprice"};
	
	return $myr_price;
}

function get_btc_price()
{
	$btc_price = 0;
	
	$url = fopen("https://www.bitstamp.net/api/ticker/", "r");
	
	$json = json_decode(stream_get_contents($url));
	
	$btc_price = $json->{"ask"};
	
	return $btc_price;
}
	
?>
