<?php

	$sha_avg_diff = 0;
	$scrypt_avg_diff = 0;
	$skein_avg_diff = 0;
	$groestl_avg_diff = 0;
	$qubit_avg_diff = 0;

	$num_avg = 12;
	
	// Establish connection to the database
	$con=mysqli_connect("127.0.0.1", "root", "pass", "myriadcoin");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($con, "SELECT * FROM `difficulties`");
	
	$num_rows = mysqli_num_rows($result);
	
	
	$array_of_rows = array();
	
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

	for($i = ($size_of_array_of_rows - $num_avg); $i < $size_of_array_of_rows; $i++)
	{
		$sha_values[$i] = $array_of_rows[$i]["sha"];
		$scrypt_values[$i] = $array_of_rows[$i]["scrypt"];
		$skein_values[$i] = $array_of_rows[$i]["skein"];
		$groestl_values[$i] = $array_of_rows[$i]["groestl"];
		$qubit_values[$i] = $array_of_rows[$i]["qubit"];
	}

	
	$sha_avg_diff = array_sum($sha_values)/$num_avg;
	$scrypt_avg_diff = array_sum($scrypt_values)/$num_avg;
	$skein_avg_diff = array_sum($skein_values)/$num_avg;
	$groestl_avg_diff = array_sum($groestl_values)/$num_avg;
	$qubit_avg_diff = array_sum($qubit_values)/$num_avg;

	print $sha_avg_diff . "<br/>";
	print $scrypt_avg_diff . "<br/>";
	print $skein_avg_diff . "<br/>";
	print $groestl_avg_diff . "<br/>";
	print $qubit_avg_diff . "<br/>";
	
	// Gives us the most current difficulties
	/*$row = $array_of_rows[$num_rows - 1];
		
	$sha_diff = $row["sha"];
	$scrypt_diff = $row["scrypt"];
	$skein_diff = $row["skein"];
	$groestl_diff = $row["groestl"];
	$qubit_diff = $row["qubit"];*/

	
?>
