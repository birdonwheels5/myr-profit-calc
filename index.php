
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
		
		$sha_diff = number_format($diff[0], 2, '.', '');
		$scrypt_diff = number_format($diff[1], 2, '.', '');
		$skein_diff = number_format($diff[2], 2, '.', '');
		$groestl_diff = number_format($diff[3], 2, '.', '');
		$qubit_diff = number_format($diff[4], 2, '.', '');
		
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
		
		$myr_price = get_myr_price();
		
		$btc_price = get_btc_price();
		
		
		
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
			
			// Now to set fields to blank if they are 0...
			
			$sha_hashrate = check_zero($sha_hashrate);
			$scrypt_hashrate = check_zero($scrypt_hashrate);
			$skein_hashrate = check_zero($skein_hashrate);
			$groestl_hashrate = check_zero($groestl_hashrate);
			$qubit_hashrate = check_zero($qubit_hashrate);
			
			$sha_power = check_zero($sha_power);
			$scrypt_power = check_zero($scrypt_power);
			$skein_power = check_zero($skein_power);
			$groestl_power = check_zero($groestl_power);
			$qubit_power = check_zero($qubit_power);
			
			$sha_hardware = check_zero($sha_hardware);
			$scrypt_hardware = check_zero($scrypt_hardware);
			$skein_hardware = check_zero($skein_hardware);
			$groestl_hardware = check_zero($groestl_hardware);
			$qubit_hardware = check_zero($qubit_hardware);
			
			$sha_poolfee = check_zero($sha_poolfee);
			$scrypt_poolfee = check_zero($scrypt_poolfee);
			$skein_poolfee = check_zero($skein_poolfee);
			$groestl_poolfee = check_zero($groestl_poolfee);
			$qubit_poolfee = check_zero($qubit_poolfee);
			
			$power_cost = check_zero($power_cost);
		}
		
		calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			
			$sha_hashrate = check_post($_POST["sha_hash"], $sha_hashrate);
			$scrypt_hashrate = check_post($_POST["scrypt_hash"], $scrypt_hashrate);
			$skein_hashrate = check_post($_POST["skein_hash"], $skein_hashrate);
			$groestl_hashrate = check_post($_POST["groestl_hash"], $groestl_hashrate);
			$qubit_hashrate = check_post($_POST["qubit_hash"], $qubit_hashrate);
			
			$sha_power = check_post($_POST["sha_power"], $sha_power);
			$scrypt_power = check_post($_POST["scrypt_power"], $scrypt_power);
			$skein_power = check_post($_POST["skein_power"], $skein_power);
			$groestl_power = check_post($_POST["groestl_power"], $groestl_power);
			$qubit_power = check_post($_POST["qubit_power"], $qubit_power);
			
			$sha_hardware = check_post($_POST["sha_hardware"], $sha_hardware);
			$scrypt_hardware = check_post($_POST["scrypt_hardware"], $scrypt_hardware);
			$skein_hardware = check_post($_POST["skein_hardware"], $skein_hardware);
			$groestl_hardware = check_post($_POST["groestl_hardware"], $groestl_hardware);
			$qubit_hardware = check_post($_POST["qubit_hardware"], $qubit_hardware);
			
			$sha_poolfee = check_post($_POST["sha_poolfee"], $sha_poolfee);
			$scrypt_poolfee = check_post($_POST["scrypt_poolfee"], $scrypt_poolfee);
			$skein_poolfee = check_post($_POST["skein_poolfee"], $skein_poolfee);
			$groestl_poolfee = check_post($_POST["groestl_poolfee"], $groestl_poolfee);
			$qubit_poolfee = check_post($_POST["qubit_poolfee"], $qubit_poolfee);
			
			
			$power_cost = check_post($_POST["power_cost"], $power_cost);
			
			$myr_price = check_post($_POST["myr_price"], $myr_price);
			
			$btc_price = check_post($_POST["btc_price"], $btc_price);
			
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
		
		// Used to replace 0's with an empty string for ease of user input
		function check_zero($number)
		{
			if($number == 0)
			{
				$number = "";
			}
			
			return $number;
		}
		
		// Validates POST input
		function check_post($post, $value)
		{
			if(is_numeric($post) == false or empty($post))
			{
				$value = "";
			}
			else
			{
				$value = $post;
			}
			return $value;
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
	
		<center><table class="mainTable">
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
					<input type="text" name="sha_diff" value="<?php echo $sha_diff;?>" size="5">
				<td/>
				<td>
					<input type="text" name="scrypt_diff" value="<?php echo $scrypt_diff;?>" size="5">
				<td/>
				<td>
					<input type="text" name="skein_diff" value="<?php echo $skein_diff;?>" size="5">
				<td/>
				<td>
					<input type="text" name="groestl_diff" value="<?php echo $groestl_diff;?>" size="5">
				<td/>
				<td>
					<input type="text" name="qubit_diff" value="<?php echo $qubit_diff;?>" size="5">
				<td/>
			</tr>
			<tr>
				<td>
					 Hashrate: 
				<td/>
				<td>
					<input type="text" name="sha_hash" value="<?php echo $sha_hashrate;?>" size="5"> GH/s
				<td/>
				<td>
					<input type="text" name="scrypt_hash" value="<?php echo $scrypt_hashrate;?>" size="5"> MH/s
				<td/>
				<td>
					<input type="text" name="skein_hash" value="<?php echo $skein_hashrate;?>" size="5"> MH/s
				<td/>
				<td>
					<input type="text" name="groestl_hash" value="<?php echo $groestl_hashrate;?>" size="5"> MH/s
				<td/>
				<td>
					<input type="text" name="qubit_hash" value="<?php echo $qubit_hashrate;?>" size="5"> MH/s
				<td/>
			<tr/>
			<tr>
				<td>
					 Power Usage: 
				<td/>
				<td>
					<input type="text" name="sha_power" value="<?php echo $sha_power;?>" size="5"> watts
				<td/>
				<td>
					<input type="text" name="scrypt_power" value="<?php echo $scrypt_power;?>" size="5"> watts
				<td/>
				<td>
					<input type="text" name="skein_power" value="<?php echo $skein_power;?>" size="5"> watts
				<td/>
				<td>
					<input type="text" name="groestl_power" value="<?php echo $groestl_power;?>" size="5"> watts
				<td/>
				<td>
					<input type="text" name="qubit_power" value="<?php echo $qubit_power;?>" size="5"> watts
				<td/>
			<tr/>
			<tr>
				<td>
					 Hardware Cost: 
				<td/>
				<td>
					$ <input type="text" name="sha_hardware" value="<?php echo $sha_hardware;?>" size="5">
				<td/>
				<td>
					$ <input type="text" name="scrypt_hardware" value="<?php echo $scrypt_hardware;?>" size="5">
				<td/>
				<td>
					$ <input type="text" name="skein_hardware" value="<?php echo $skein_hardware;?>" size="5">
				<td/>
				<td>
					$ <input type="text" name="groestl_hardware" value="<?php echo $groestl_hardware;?>" size="5">
				<td/>
				<td>
					$ <input type="text" name="qubit_hardware" value="<?php echo $qubit_hardware;?>" size="5">
				<td/>
			</tr>
			<tr>
				<td>
					 Pool fees: 
				<td/>
				<td>
					<input type="text" name="sha_poolfee" value="<?php echo $sha_poolfee;?>" size="5"> %
				<td/>
				<td>
					<input type="text" name="scrypt_poolfee" value="<?php echo $scrypt_poolfee;?>" size="5"> %
				<td/>
				<td>
					<input type="text" name="skein_poolfee" value="<?php echo $skein_poolfee;?>" size="5"> %
				<td/>
				<td>
					<input type="text" name="groestl_poolfee" value="<?php echo $groestl_poolfee;?>" size="5"> %
				<td/>
				<td>
					<input type="text" name="qubit_poolfee" value="<?php echo $qubit_poolfee;?>" size="5"> %
				<td/>
			<tr/>
		</table>
		<table class="subTable">
			<br/>
			<tr>
				<td>
					Power Cost &nbsp;
				<td/>
				<td>
					MYR/BTC &nbsp;
				<td/>
				<td>
					BTC/USD &nbsp;
				<td/>
			<tr/>
			<tr>
				<td>
					<input type="text" name="power_cost" value="<?php echo $power_cost;?>" size="5"> $/Kwh
				<td/>
				<td>
					<input type="text" name="myr_price" value="<?php echo $myr_price;?>" size="7"> BTC
				<td/>
				<td>
					<input type="text" name="btc_price" value="<?php echo $btc_price;?>" size="5"> USD
				<td/>
			<tr/>
		</table>
		<table class="mainTable">
			<tr>
				<td>
					<input type="submit" name="submit" value="Submit"><input type="submit" name="clear" value="Clear">
				</td>
			</tr>
		</table></center>
		
		<table class="resultsTable">
			<?php calculate_profit($sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate);
			print $sha_profit . " " . $scrypt_profit . " " . $skein_profit . " " . $groestl_profit . " " . $qubit_profit; ?>
		</table>
		
		
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
