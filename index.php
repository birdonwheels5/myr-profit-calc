
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>MYR Profit Calculator</title>
		<!-- link rel="stylesheet" href="http://birdonwheels5.no-ip.org/css/main.min.css" -->
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "userManager.php"; 
		      include "calcHelper.php"; ?>
	</head>
	
	<body style="background-color:#f4f4f4;float:left;background-color:white" link="#E2E2E2" vlink="#ADABAB">
	
	<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="index.html">Home</a></p>
				</div>
				
				<div class="button">
					<p><a href ="CryptoHub.html">Crypto Hub</a></p>
				</div>
				
				<div class="button">
					<p><a href ="http://birdstekkit.enjin.com" target="_blank">Minecraft Servers</a></p>
				</div>
				
				<div class="button">
					<p><a href ="https://birdonwheels5.no-ip.org/index.php">Cloud Server</a></p>
				</div>
				
			</header>

	
	<?php
		
		
		// Determine if the user loading the page has been here before.
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_array = array();
		$user_array = read_users();
		
		$avg = 24;
		
		// Declare variables
		$diff = array();
		$diff = get_avg_diffs($avg);
		
		$sha_hashrate = "";
		$scrypt_hashrate = "";
		$skein_hashrate = "";
		$groestl_hashrate = "";
		$qubit_hashrate = "";
			
		$sha_power = "";
		$scrypt_power = "";
		$skein_power = "";
		$groestl_power = "";
		$qubit_power = "";
		
		$sha_hardware = "";
		$scrypt_hardware = "";
		$skein_hardware = "";
		$groestl_hardware = "";
		$qubit_hardware = "";
			
		$sha_poolfee = "";
		$scrypt_poolfee = "";
		$skein_poolfee = "";
		$groestl_poolfee = "";
		$qubit_poolfee = "";
			
		$power_cost = "";
		
		
		
		$user_position_in_array = search_ip_address($user_array, $ip);
		
		if($user_position_in_array >= 0)
		{
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
			
			
			if(is_numeric($_POST["sha_hash"]) == false or empty($_POST["sha_hash"]))
			{
				$sha_hashrate = "";
			}
			else
			{
				$sha_hashrate = $_POST["sha_hash"]; // Multiplied later to be in GH/s
				$sha_input = $sha_hashrate;
			}
			

			if(is_numeric($_POST["scrypt_hash"]) == false or empty($_POST["scrypt_hash"]))
			{
				$scrypt_hashrate = "";
			}
			else
			{
				$scrypt_hashrate = $_POST["scrypt_hash"];
				$scrypt_input = $scrypt_hashrate;
			}
			

			if(is_numeric($_POST["skein_hash"]) == false or empty($_POST["skein_hash"]))
			{
				$skein_hashrate = "";
			}
			else
			{
				$skein_hashrate = $_POST["skein_hash"];
				$skein_input = $skein_hashrate;
			}
			

			if(is_numeric($_POST["groestl_hash"]) == false or empty($_POST["groestl_hash"]))
			{
				$groestl_hashrate = "";
			}
			else
			{
				$groestl_hashrate = $_POST["groestl_hash"];
				$groestl_input = $groestl_hashrate;
			}
			

			if(is_numeric($_POST["qubit_hash"]) == false or empty($_POST["qubit_hash"]))
			{
				$qubit_hashrate = "";
			}
			else
			{
				$qubit_hashrate = $_POST["qubit_hash"];
				$qubit_input = $qubit_hashrate;
			}
			
		calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
		
		
		if(search_ip_address($user_array, $ip) >= 0)
		{
			update_user($ip, $sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate, 
			$sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, $scrypt_hardware, 
			$skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, $skein_poolfee, 
			$groestl_poolfee, $qubit_poolfee, $power_cost);
		}
		else
		{
			add_user($ip, $sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate, 
			$sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, $sha_hardware, 
			$scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, $sha_poolfee, $scrypt_poolfee, 
			$skein_poolfee, $groestl_poolfee, $qubit_poolfee, $power_cost);
		}
		
		if($_POST["clear"])
		{
			$sha_hashrate = "";
			$scrypt_hashrate = "";
			$skein_hashrate = "";
			$groestl_hashrate = "";
			$qubit_hashrate = "";
			
			calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, 
			$qubit_hashrate);
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
	
		<center><div class="container" style="width:100%;float:left;">
			
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

	<center><div class="inputHolder">
	
		<center><table>
			<tr>
				<td>
					Algorithm: 
				<td/>
				<td>
					Sha256d
				<td/>
				<td>
					Scrypt
				<td/>
				<td>
					Skein
				<td/>
				<td>
					Groestl
				<td/>
				<td>
					Qubit
				<td/>
			</tr>
			<tr>
				<td>
					 Difficulty: (24 hr average)
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
			</tr>
			<tr>
				<td>
					 Hashrate: 
				<td/>
				<td>
					<input type="text" name="sha_hash" value="<?php echo $sha_hashrate;?>" size="4"> GH/s
				<td/>
				<td>
					<input type="text" name="scrypt_hash" value="<?php echo $scrypt_hashrate;?>" size="4"> MH/s
				<td/>
				<td>
					<input type="text" name="skein_hash" value="<?php echo $skein_hashrate;?>" size="4"> MH/s
				<td/>
				<td>
					<input type="text" name="groestl_hash" value="<?php echo $groestl_hashrate;?>" size="4"> MH/s
				<td/>
				<td>
					<input type="text" name="qubit_hash" value="<?php echo $qubit_hashrate;?>" size="4"> MH/s
				<td/>
			<tr/>
			<tr>
				<td>
					 Power Usage: (Watts)
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
			<tr/>
			<tr>
				<td>
					 Hardware Cost: (In US dollars)
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
			</tr>
			<tr>
				<td>
					 Pool fees: (Percentage)
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
				<td>
					
				<td/>
			<tr/>
		</table>
		<table>
			<br/>
			<tr>
				<td>
					Power Cost: ($/Kwh)
				<td/>
				<td>
					MYR/BTC: 
				<td/>
				<td>
					BTC/USD: 
				<td/>
			<tr/>
			<tr>
				<td>
					num
				<td/>
				<td>
					num
				<td/>
				<td>
					numb
				<td/>
			<tr/>
		</table></center>
		
		
	</div>
	  
	</form>

</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
		</div>
	</body>
	
</html>
