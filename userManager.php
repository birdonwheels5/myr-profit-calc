<?php

include "User.php";

function read_users($filename)
{
	$debug_mode = false;
	$separator = "qpwoeiruty";

	$ip_address = "";
	$sha_hashrate = 0;
	$scrypt_hashrate = 0;
	$skein_hashrate = 0;
	$groestl_hashrate = 0;
	$qubit_hashrate = 0;
	
	$index = 0;
	
	$users = array();
	
  $handle = fopen($filename, "r") or print ("Error loading users!");
    	while (($line = fgets($handle)) !== false) 
    	{
		
		// Fetch user information line-by-line, construct the user, then add 1 to user count
		
		if (strcmp(stristr($line,"ip: "), $line) == 0)
		{
			$ip_address = trim(str_ireplace("ip: ", "", $line));
		}
		
		if (strcmp(stristr($line,"sha: "), $line) == 0)
		{
			$sha_hashrate = trim(str_ireplace("sha: ", "", $line));
		}
	
		if (strcmp(stristr($line,"scrypt: "), $line) == 0)
		{
			$scrypt_hashrate = trim(str_ireplace("scrypt: ", "", $line));
		}
	
		if (strcmp(stristr($line,"skein: "), $line) == 0)
		{
			$skein_hashrate = trim(str_ireplace("skein: ", "", $line));
		}
		
		if (strcmp(stristr($line,"groestl: "), $line) == 0)
		{
			$groestl_hashrate = trim(str_ireplace("groestl: ", "", $line));
		}
		
		if (strcmp(stristr($line,"qubit: "), $line) == 0)
		{
			$qubit_hashrate = trim(str_ireplace("qubit: ", "", $line));
		}

		// Check the current line for "qpwoeiruty" which separates users, and create users
		if (strcmp(stristr($line, $separator), $line) == 0)
		{
			// Debug info
			if ($debug_mode == true)
			{
				echo $ip_address;
    				echo "<br>";
				echo $sha_hashrate;
				echo "<br>";
				echo $scrypt_hashrate;
				echo "<br>";
				echo $skein_hashrate;
				echo "<br>";
				echo $groestl_hashrate;
				echo "<br>";
				echo $qubit_hashrate;
				echo "<br>";
				echo "---------";
				echo "<br>";	
			}
			
			$index++;
			$user = new User($ip_address, $sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
			$users[$index] = $user;
		}
	}
	fclose($handle);
	return $users;
}

// -----------------------------------------------------------------------------------------

function count_users($filename)
{
  $separator = "qpwoeiruty";
  $index = 0;
	
  $handle = fopen($filename, "r") or print ("Error loading users!");
    	while (($line = fgets($handle)) !== false) 
    	{
		// Count the number of $separator's in the users file, as that determines where the user ends
		if (strcmp(stristr($line, $separator), $line) == 0)
		{
			$index++;
		}
	}
	fclose($handle);
	return $index;
}

// -----------------------------------------------------------------------------------------

// Returns -1 if the ip address supplied cannot be found in the user array.
// If successful, the number of the user is returned (will always be > 0).
function search_ip_address($filename, $array, $ip_address)
{
	$separator = "qpwoeiruty";
	
	$FAILURE = -1;
	
	$user_count = count_users($filename);
	
	$searchResult = $FAILURE;
	
	// Loop through the user array, and look for a match with $ip_address Result. Returns the number of the user in
	// the array.
	for($i = 1; $i <= $user_count; $i++)
	{
		if ($debug_mode == true)
		{
			print "User: " . $array[$i]->get_ip_address() . "<br>";
		}
		
		if ((strcmp(stristr($array[$i]->get_ip_address(), $ip_address), $array[$i]->get_ip_address()) == 0))
		{
			if ($debug_mode == true)
			{
				print "<br>IP match!<br>" . $array[$i]->get_ip_address();
			}
			
			$searchResult = $i;
		}
	}
	
	return $searchResult;
}

// -----------------------------------------------------------------------------------------

// Display a list of the ip addresss of all the users, formatted in HTML.
function display_ip_addresses($filename, $array)
{
	
	$user_count = count_users($filename);
	
	for($i = 1; $i <= $user_count; $i++)
	{
		print $i . ") " . $array[$i]->get_ip_address() . "\n <br/>";
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
		print "<hr/>";
	}
}

// -----------------------------------------------------------------------------------------

function remove_user($filename, $array, $user_number)
{
	$user_number = (int)$user_number;
	$debug_mode = false;
	$separator = "qpwoeiruty";
	
	$line_number = 0;
	
	$SUCCESS = 0;
	$FAILURE = 1;
	
	if ($debug_mode == true)
	{
		print "<br> Getting user ip_address...";
		print $user_number;
	}
	
	// Get the ip_address of the user we're working with
	$ip_address = $array[$user_number]->get_ip_address();
	
	if ($debug_mode == true)
	{
		print "<br> User IP address is: " . $ip_address;
	}
	
	if ($debug_mode == true)
	{
		print "<br> Opening file...";
	}
	
	// Search for the line number where the user's ip_address resides
	$file = file($filename);
	
	if ($debug_mode == true)
	{
		print "<br> File Opened!";
	}
	
	// Special case for when the first user needs to be deleted
	if ($user_number == 1)
	{
		$line_number = 0; // This will always be true since the user is at the start of the file
	}
	else
	{
	for ($i = 0; $i < count($file); $i++)
	{
		if ($debug_mode == true)
		{
			print "<br> Looking for line number... Current line:  <br>" . $file[$i];
		}
		
		if ((strcmp(stristr($file[$i], $separator), $file[$i]) == 0))
		{
			if ($debug_mode == true)
			{
				print "<br> Separator found";
			}
			
			if ($debug_mode == true)
			{
				print "<br> " . $line_number;
			}
			
			$line_number++; // Keeping track of the separators
			
			if ($line_number == ($user_number - 1)) // We want the separator count to equal the user #
			{
				$line_number = $i + 1; // Replacing the separator count with the line count of the ip_address
				if ($debug_mode == true)
				{
					print "<br> " . $line_number;
				}
				
				break;
			}
		}
		
		
	}
	}
	fclose($file);
	
	
	$lines = file($filename);

 		$content;
		
		// If the starting line number is not 0, then read the lines up until the line
		// number into the temp file ($content)
 		if ($line_number != 0)
 		{
 			for ($i = 0; $i < $line_number; $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}
 		
 		$lastLine;
 		
 		// Special case for when we remove the first user entry from our users.dat file
 		if ($line_number == 0)
 		{
 			for($i = 0; $i < count($lines); $i++) 
 		
 			{ 
 			
 				$content .= str_ireplace($lines[$i], "", $lines[$i]);
 				
 				if ((strcmp(stristr($lines[$i], $separator), $lines[$i]) == 0))
 				{
 					$content .= str_ireplace($lines[$i], "", $lines[$i]);
 					$lastLine = $i;
 					break;
 				}
 			}
 			
 			// Pick up reading into temp file after we've stopped changing the file's contents
 			for($i = ($lastLine + 1); $i < count($lines); $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}
 		else // Same thing, just with changed separator rules for users that are not at line 0
 		{
 			for($i = ($line_number); $i < count($lines); $i++) 
 		
 			{ 
 				if ((strcmp(stristr($lines[$i], $separator), $lines[$i]) == 0))
 				{
 					$content .= str_ireplace($lines[$i], "", $lines[$i]);
 					$lastLine = $i;
 					break;
 				}
 				
 				$content .= str_ireplace($lines[$i], "", $lines[$i]);
 			}
 			
 			for($i = ($lastLine + 1); $i < count($lines); $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}

 		fclose($lines);
 		
 		// Overwrite main file with temp file
 		$fi = fopen($filename, "w");
 		fwrite($fi, $content);
 		fclose($fi);
	
	return;
}

// -----------------------------------------------------------------------------------------

?>
