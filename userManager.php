<?php

function read_users()
{
	// Establish connection to the database
	$con = mysqli_connect("127.0.0.1", "root", "peanutbutteronmyballs", "myriadcoin");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		print "Query Successful. <br/>";
	}
	
	// Query database for users
	$result = mysqli_query($con, "SELECT * FROM `myriadcoin`.`users`");
	
	// Obtain the number of rows from the result of the query
	$num_rows = mysqli_num_rows($result);
	
	// Will be storing all the rows in here
	$array_of_rows = array();
	
	// Get all the rows
	for($i = 0; $i < $num_rows; $i++)
	{
		$array_of_rows[$i] = mysqli_fetch_array($result);
	}
	
	mysqli_close($con);
	
	return $array_of_rows;
}

// -----------------------------------------------------------------------------------------

// Returns -1 if the ip address supplied cannot be found in the user array.
// If successful, the number of the user is returned (will always be > 0).
function search_ip_address($array, $ip_address)
{
	$FAILURE = -1;
	
	$user_count = count($array);
	
	print $user_count;
	
	$searchResult = $FAILURE;
	
	// Loop through the user array, and look for a match with $ip_address Result. Returns the number of the user in
	// the array.
	for($i = 0; $i <= $user_count; $i++)
	{
		
		if ((strcmp(stristr($array[$i]["ip_address"], $ip_address), $array[$i]["ip_address"]) == 0))
		{	
			$searchResult = $i;
		}
	}
	
	return $searchResult;
}

// -----------------------------------------------------------------------------------------

// Display a list of the ip addresss of all the users, formatted in HTML.
function display_ip_addresses($array)
{
	
	$user_count = count_users($filename);
	
	for($i = 0; $i <= $user_count; $i++)
	{
		print $i . ") " . $array[$i]["user"] . "\n <br/>";
	}
}

// -----------------------------------------------------------------------------------------

// A plain text version of the above function, which displays all info about a given user.
function display_ip_info($filename, $array)
{
	
	$user_count = count_users($filename);
	
	for($i = 1; $i <= $user_count; $i++)
	{
		print "<b> IP: " . $array[$i]->get_ip_address() . "</b>" . "<br>";
		print "sha: " . $array[$i]->get_sha_hashrate() . "<br>";
		print "scrypt: " . $array[$i]->get_scrypt_hashrate() . "<br>";
		print "skein: " . $array[$i]->get_skein_hashrate() . "<br>";
		print " groestl: " . $array[$i]->get_groestl_hashrate() . "<br>";
		print "qubit: " . $array[$i]->get_qubit_hashrate() . "<br>";
		print "power consumption: " . $array[$i]->get_power_consumption() . "<br>";
		print "power use: " . $array[$i]->get_power_cost() . "<br>";
		print "pool fee: " . $array[$i]->get_pool_fee() . "<br>";
		print "<hr/>";
	}
}

// -----------------------------------------------------------------------------------------

function add_user($ip_address, $sha_hash, $scrypt_hash, $skein_hash, $groestl_hash, $qubit_hash, $sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, $scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, $skein_poolfee, $groestl_poolfee, $qubit_poolfee, $power_cost)
{
	// Establish connection to the database
	$con = mysqli_connect("127.0.0.1", "root", "peanutbutteronmyballs", "myriadcoin");
	
$add = "INSERT INTO `myriadcoin`.`users` (`ip_address`, `sha_hash`, `scrypt_hash`, `skein_hash`, `groestl_hash`, `qubit_hash`, `sha_power`, `scrypt_power, `skein_power`, `groestl_power`, `qubit_power`, `sha_hardware`, `scrypt_hardware`, `skein_hardware`, `groestl_hardware`, `qubit_hardware`, `sha_poolfee`, `scrypt_poolfee`, `skein_poolfee`, `groestl_poolfee`, `qubit_poolfee`, `power_cost`) VALUES ('" . $ip_address . "', '" . $sha_hash . "', '" . $scrypt_hash . "', '" . $skein_hash . "', '" . $groestl_hash . "', '" . $qubit_hash . "', '" . $sha_power . "', '" . $scrypt_power . "', '" . $groestl_power . "', '" . $qubit_power . "', '" . $sha_hardware . "', '" . $scrypt_hardware . "', '" . $skein_hardware . "', '" . $groestl_hardware . "', '" . $qubit_hardware . "', '" . $sha_poolfee . "', '" . $scrypt_poolfee . "', '" . $skein_poolfee . "', '" . $groestl_poolfee . "', '" . $qubit_poolfee . "', '" . $power_cost . "')";	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		print "Query Successful. <br/>";
		print $ip_address;
	}
	
	// Query database for users
	mysqli_query($con, $add);
	
	mysqli_close($con);
}
// -----------------------------------------------------------------------------------------

function update_user($ip_address, $sha_hash, $scrypt_hash, $skein_hash, $groestl_hash, $qubit_hash, $sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, $scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, $skein_poolfee, $groestl_poolfee, $qubit_poolfee, $power_cost)
{
	// Establish connection to the database
	$con = mysqli_connect("127.0.0.1", "root", "peanutbutteronmyballs", "myriadcoin");
	
	$update = "UPDATE `myriadcoin`.`users` SET sha_hash=" . $sha_hash . ", scrypt_hash=" . $scrypt_hash . ", skein_hash=" . $skein_hash . ", groestl_hash=" . $groestl_hash . ", qubit_hash=" . $qubit_hash . ", sha_power=" . $sha_power . ", scrypt_power=" . $scrypt_power . ", groestl_power=" . $groestl_power . ", qubit_power=" . $qubit_power . ", sha_hardware=" . $sha_hardware . ", scrypt_hardware=" . $scrypt_hardware . ", skein_hardware=" . $skein_hardware . ", groestl_hardware=" . $groestl_hardware . ", qubit_hardware=" . $qubit_hardware . ", sha_poolfee=" . $sha_poolfee . ", scrypt_poolfee=" . $scrypt_poolfee . ", skein_poolfee=" . $skein_poolfee . ", groestl_poolfee=" . $groestl_poolfee . ", qubit_poolfee=" . $qubit_poolfee . ", power_cost=" . $power_cost . " WHERE ip_address=" . $ip_address;

	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		print "Query Successful. <br/>";
	}
	
	// Query database to update user
	mysqli_query($con, $update);
	
	mysqli_close($con);
}
// -----------------------------------------------------------------------------------------

function remove_user($ip_address)
{
	// Establish connection to the database
	$con = mysqli_connect("127.0.0.1", "root", "peanutbutteronmyballs", "myriadcoin");
	
	$delete = "DELETE * FROM `myriadcoin`.`users` WHERE ip_address=". $ip_address;
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		print "Query Successful. <br/>";
	}
	
	// Query database for users
	mysqli_query($con, $delete);
	
	mysqli_close($con);
}
// -----------------------------------------------------------------------------------------

?>
