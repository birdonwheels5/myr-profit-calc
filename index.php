
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>MYR Profit Calculator</title>
		<link rel="stylesheet" href="http://birdonwheels5.no-ip.org/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "userManager.php"; 
		      include "calcHelper.php"; ?>
	</head>
	
	<body style="background-color:#f4f4f4;float:left;background-color:white">
	
	<?php
		
		
		// Determine if the user loading the page has been here before.
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_array = array();
		$user_array = read_users();
		$avg = 24;
		
		// Declare variables
		$diff = array();
		$diff = get_avg_diffs($avg);
		
		$sha_hashrate;
		$scrypt_hashrate;
		$skein_hashrate;
		$groestl_hashrate;
		$qubit_hashrate;
			
		$sha_power;
		$scrypt_power;
		$skein_power;
		$groestl_power;
		$qubit_power;
		
		$sha_hardware;
		$scrypt_hardware;
		$skein_hardware;
		$groestl_hardware;
		$qubit_hardware;
			
		$sha_poolfee;
		$scrypt_poolfee;
		$skein_poolfee;
		$groestl_poolfee;
		$qubit_poolfee;
			
		$power_cost;
		
		
		
		$user_position_in_array = search_ip_address($user_array, $ip);
		$is_ip_unique = true;

		
		if($user_position_in_array >= 0)
		{
			$is_ip_unique = false;
			$sha_hashrate = $user_array[$user_position_in_array]["sha_hash"];
			$scrypt_hashrate = $user_array[$user_position_in_array]["scrypt_hash"];
			$skein_hashrate = $user_array[$user_position_in_array]["skein_hash"];
			$groestl_hashrate = $user_array[$user_position_in_array]["groestl_hash"];
			$qubit_hashrate = $user_array[$user_position_in_array]["qubit_hash"];
			
			$sha_power = $user_array[$user_position_in_array]["sha_power"];
			$scrypt_power = $user_array[$user_position_in_array]["scrypt_power"];
			$skein_power = $user_array[$user_position_in_array]["skein_power"];
			$groestl_power = $user_array[$user_position_in_array]["groestl_power"];
			$qubit_power = $user_array[$user_position_in_array]["qubit_power"];
			
			$sha_hardware = $user_array[$user_position_in_array]["sha_hardware"];
			$scrypt_hardware = $user_array[$user_position_in_array]["scrypt_hardware"];
			$skein_hardware = $user_array[$user_position_in_array]["skein_hardware"];
			$groestl_hardware = $user_array[$user_position_in_array]["groestl_hardware"];
			$qubit_hardware = $user_array[$user_position_in_array]["qubit_hardware"];
			
			$sha_poolfee = $user_array[$user_position_in_array]["sha_poolfee"];
			$scrypt_poolfee = $user_array[$user_position_in_array]["scrypt_poolfee"];
			$skein_poolfee = $user_array[$user_position_in_array]["skein_poolfee"];
			$groestl_poolfee = $user_array[$user_position_in_array]["groestl_poolfee"];
			$qubit_poolfee = $user_array[$user_position_in_array]["qubit_poolfee"];
			
			$power_cost = $user_array[$user_position_in_array]["power_cost"];
		}
		
		$sha_diff = number_format($diff[0], 2, '.', ',');
		
		$scrypt_diff = number_format($diff[1], 2, '.', ',');
		
		$skein_diff = number_format($diff[2], 2, '.', ',');
		
		$groestl_diff = number_format($diff[3], 2, '.', ',');
		
		$qubit_diff = number_format($diff[4], 2, '.', ',');
		
		
		calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			
			
			if(is_numeric($_POST["sha"]) == false or empty($_POST["sha"]))
			{
				$sha_hashrate = "";
			}
			else
			{
				$sha_hashrate = $_POST["sha"]; // Multiplied later to be in GH/s
				$sha_input = $sha_hashrate;
			}
			

			if(is_numeric($_POST["scrypt"]) == false or empty($_POST["scrypt"]))
			{
				$scrypt_hashrate = "";
			}
			else
			{
				$scrypt_hashrate = $_POST["scrypt"];
				$scrypt_input = $scrypt_hashrate;
			}
			

			if(is_numeric($_POST["skein"]) == false or empty($_POST["skein"]))
			{
				$skein_hashrate = "";
			}
			else
			{
				$skein_hashrate = $_POST["skein"];
				$skein_input = $skein_hashrate;
			}
			

			if(is_numeric($_POST["groestl"]) == false or empty($_POST["groestl"]))
			{
				$groestl_hashrate = "";
			}
			else
			{
				$groestl_hashrate = $_POST["groestl"];
				$groestl_input = $groestl_hashrate;
			}
			

			if(is_numeric($_POST["qubit"]) == false or empty($_POST["qubit"]))
			{
				$qubit_hashrate = "";
			}
			else
			{
				$qubit_hashrate = $_POST["qubit"];
				$qubit_input = $qubit_hashrate;
			}
			
		calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
		
		
		if(is_ip_unique == false)
		{
		if($sha_hashrate != $users[$user_position_in_array]["sha_hash"] or $scrypt_hashrate != $users[$user_position_in_array]->get_scrypt_hashrate() or $skein_hashrate != $users[$user_position_in_array]->get_skein_hashrate() or $groestl_hashrate != $users[$user_position_in_array]->get_groestl_hashrate() or $qubit_hashrate != $users[$user_position_in_array]->get_qubit_hashrate())
		{
			if(search_ip_address($user_array, $ip) >= 0)
			{
				update_user($ip_address, $sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate, $sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, $scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, $skein_poolfee, $groestl_poolfee, $qubit_poolfee, $power_cost);
			}
		}
		}
		else
		{
			add_user($ip_address, $sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate, $sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, $scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, $skein_poolfee, $groestl_poolfee, $qubit_poolfee, $power_cost);
		}
		
		if($_POST["clear"])
		{
			$sha_hashrate = "";
			$scrypt_hashrate = "";
			$skein_hashrate = "";
			$groestl_hashrate = "";
			$qubit_hashrate = "";
			
			calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
		}
}

		function calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate)
		{
			global $sha_profit, $scrypt_profit, $skein_profit, $groestl_profit, $qubit_profit, $diff;
			
			$hash_multiplier = 1000000; // Gives you hashrate in hashes/sec for calculations
			$coins_per_block = 1000; // Current block reward.
		
					// 		  Units:     Sec	Diff	   ???	   hashrate MH/s
			$sha_profit = number_format((86400 / (($diff[0] * pow(2, 32)) / (($sha_hashrate * 1000) * $hash_multiplier))) * $coins_per_block, 1, '.', ',');
			$scrypt_profit = number_format((86400 / (($diff[1] * pow(2, 32)) / ($scrypt_hashrate * $hash_multiplier))) * $coins_per_block, 1, '.', ',');
			$skein_profit = number_format((86400 / (($diff[2] * pow(2, 32)) / ($skein_hashrate * $hash_multiplier))) * $coins_per_block, 1, '.', ',');
			$groestl_profit = number_format((86400 / (($diff[3] * pow(2, 32)) / ($groestl_hashrate * $hash_multiplier))) * $coins_per_block, 1, '.', ',');
			$qubit_profit = number_format((86400 / (($diff[4] * pow(2, 32)) / ($qubit_hashrate * $hash_multiplier))) * $coins_per_block, 1, '.', ',');
		}
	?>
	
		<div class="container" style="width:100%;float:left;">
			
			<article>
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
						
		<h2> <a href="http://myriadplatform.org" target="_blank"><img src="http://birdspool.no-ip.org:5567/static/img/logo.png" style="width:8%;"</img>  Myriadcoin </a></h2>
        <p>
	<strong>Myriadcoin</strong> is the first multi-PoW cryptocurrency that uses 5 concurrent hashing algorithms, each of which have an equal chance of solving the next block. 
Each algorithm has an independent difficulty, and a block time of 2.5 minutes, which averages out to 30 seconds per block across all the algorithms. 
The 5 algorithms that comprise Myriadcoin are Sha256, Scrypt, Groestl, Skein, and Qubit. 
For more information, visit <a href="http://myriadplatform.org" target="_blank">MyriadPlatform.org</a></p>

        <p><h3>Algorithm Statistics:</h3> 
        	    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		    <input type="submit" name="refresh_values" value="Refresh Values">
		    
	  <table class="table">	
	    <tr>
		<td>Algorithm: </td>
		<td><b>Sha256</b></td>
		<td><b>Scrypt</b></td>
		<td><b>Skein</b></td>
		<td><b>Groestl</b></td>
		<td><b>Qubit</b></td>
	    </tr>
	    <tr>
		<th>Average Difficulty:</th>
		<td ><?php print $sha_diff; ?></td>
		<td><?php print $scrypt_diff; ?></td>
		<td><?php print $skein_diff; ?></td>
		<td><?php print $groestl_diff; ?></td>
		<td><?php print $qubit_diff; ?></td>
	    </tr>
	   <tr>
		<th>Profitability/Day:<br/>
		    (Defaults to MYR per MH/s of the algo.)</th>
		<td><?php print $sha_profit; ?> MYR/GH/s</td>
		<td><?php print $scrypt_profit; ?> MYR/Scrypt MH/s</td>
		<td><?php print $skein_profit; ?> MYR/Skein MH/s</td>
		<td><?php print $groestl_profit; ?> MYR/Groestl MH/s</td>
		<td><?php print $qubit_profit; ?> MYR/Qubit MH/s</td>
	    </tr>
	    
	    <tr>
		<th>
		    Profitability/Day:<br/>Enter your Hashrate<br/>
		    <input type="submit" name="submit" value="Submit"><input type="submit" name="clear" value="Clear"></th>
		<td>
		    <input type="text" name="sha" value="<?php echo $sha_input;?>" size="4"><br/>
		    MYR <br/> (GH/s)
		    </td>
		<td>
		    <input type="text" name="scrypt" value="<?php echo $scrypt_input;?>" size="4"><br/>
		    MYR <br/> (MH/s)
		    </td>
		<td>
		    <input type="text" name="skein" value="<?php echo $skein_input;?>" size="4"><br/>
		    MYR <br/> (MH/s)
		    </td>
		<td>
		    <input type="text" name="groestl" value="<?php echo $groestl_input;?>" size="4"><br/>
		    MYR <br/> (MH/s)
		    </td>
		<td>
		    <input type="text" name="qubit" value="<?php echo $qubit_input;?>" size="4"><br/>
		    MYR <br/> (MH/s)
		    </form></td>
	    </tr>
<!--	    <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	    </tr> -->
	</table>

</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
		</div>
	</body>
	
</html>
