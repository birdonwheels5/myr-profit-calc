
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
					<p><a href ="http://birdonwheels5.no-ip.org">Back to Block Explorer</a></p>
				</div>
				
			</header>

	
	<?php
		
		
		// Determine if the user loading the page has been here before.
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_array = array();
		$user_array = read_users();
		
		$avg = 24;
		$average_string = "(24 hr average)";
		
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
		
		$coins_per_block = get_block_value();
		
		$results = array();
		
		
		
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
			
			$results = calculate();
		}
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$sha_diff = check_post($_POST["sha_diff"], $sha_diff);
			$scrypt_diff = check_post($_POST["scrypt_diff"], $scrypt_diff);
			$skein_diff = check_post($_POST["skein_diff"], $skein_diff);
			$groestl_diff = check_post($_POST["groestl_diff"], $groestl_diff);
			$qubit_diff = check_post($_POST["qubit_diff"], $qubit_diff);
			
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
			
			$coins_per_block = check_post($_POST["coins_per_block"], $coins_per_block);
			
			$results = calculate();
		
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
			$diff = get_avg_diffs($avg);
			
			$average_string = "(24 hr average)";
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
			
			$coins_per_block = get_block_value();
			
			$results = calculate();
		}
		
		if($_POST["refresh"])
		{
			$average_string = "(24 hr average)";
			
			$diff = get_avg_diffs($avg);
			
			$sha_diff = number_format($diff[0], 2, '.', '');
			$scrypt_diff = number_format($diff[1], 2, '.', '');
			$skein_diff = number_format($diff[2], 2, '.', '');
			$groestl_diff = number_format($diff[3], 2, '.', '');
			$qubit_diff = number_format($diff[4], 2, '.', '');
			
			$myr_price = get_myr_price();
			
			$btc_price = get_btc_price();
			
			$coins_per_block = get_block_value();
			
			$results = calculate();
		}
		
		if($_POST["24_hr"])
		{
			$average_string = "(24 hr average)";
			
			$diff = get_avg_diffs($avg);
			
			$sha_diff = number_format($diff[0], 2, '.', '');
			$scrypt_diff = number_format($diff[1], 2, '.', '');
			$skein_diff = number_format($diff[2], 2, '.', '');
			$groestl_diff = number_format($diff[3], 2, '.', '');
			$qubit_diff = number_format($diff[4], 2, '.', '');
			
			$results = calculate();
		}
		
		if($_POST["3_day"])
		{
			$average_string = "(3 day average)";
			
			$diff = get_avg_diffs(72);
			
			$sha_diff = number_format($diff[0], 2, '.', '');
			$scrypt_diff = number_format($diff[1], 2, '.', '');
			$skein_diff = number_format($diff[2], 2, '.', '');
			$groestl_diff = number_format($diff[3], 2, '.', '');
			$qubit_diff = number_format($diff[4], 2, '.', '');
			
			$results = calculate();
		}
		
		if($_POST["week"])
		{
			$average_string = "(1 week average)";
			
			$diff = get_avg_diffs(168);
			
			$sha_diff = number_format($diff[0], 2, '.', '');
			$scrypt_diff = number_format($diff[1], 2, '.', '');
			$skein_diff = number_format($diff[2], 2, '.', '');
			$groestl_diff = number_format($diff[3], 2, '.', '');
			$qubit_diff = number_format($diff[4], 2, '.', '');
			
			$results = calculate();
		}
}

		function calculate()
		{
			global $sha_diff, $scrypt_diff, $skein_diff, $groestl_diff, $qubit_diff, 
			$sha_hashrate, $scrypt_hashrate, $skein_hashrate, $groestl_hashrate, $qubit_hashrate, 
			$sha_power, $scrypt_power, $skein_power, $groestl_power, $qubit_power, 
			$sha_hardware, $scrypt_hardware, $skein_hardware, $groestl_hardware, $qubit_hardware, 
			$sha_poolfee, $scrypt_poolfee, $skein_poolfee, $groestl_poolfee, $qubit_poolfee, 
			$power_cost, $myr_price, $btc_price, $coins_per_block;
			
			$hash_multiplier = 1000000; // Gives you hashrate in hashes/sec for calculations
			
			// Put the values into percents before we do our calculations
			$sha_fee = $sha_poolfee/100;
			$scrypt_fee = $scrypt_poolfee/100;
			$skein_fee = $skein_poolfee/100;
			$groestl_fee = $groestl_poolfee/100;
			$qubit_fee = $qubit_poolfee/100;
			
			$array_package = array();
			
			// What the values are, in order:
			// time to find block, MYR total, BTC total, USD total, power consumption, power cost in USD, profit made in USD, time to ROI
			$sha_values = array();
			$scrypt_values = array();
			$skein_values = array();
			$groestl_values = array();
			$qubit_values = array();
			
				// 		  Units:     Sec    	Diff	   ???	       hashrate MH/s
			$sha_blocks_per_day = (86400 / (($sha_diff * pow(2, 32)) / (($sha_hashrate * 1000) * $hash_multiplier)));
			$scrypt_blocks_per_day = (86400 / (($scrypt_diff * pow(2, 32)) / ($scrypt_hashrate * $hash_multiplier)));
			$skein_blocks_per_day = (86400 / (($skein_diff * pow(2, 32)) / ($skein_hashrate * $hash_multiplier)));
			$groestl_blocks_per_day = (86400 / (($groestl_diff * pow(2, 32)) / ($groestl_hashrate * $hash_multiplier)));
			$qubit_blocks_per_day = (86400 / (($qubit_diff * pow(2, 32)) / ($qubit_hashrate * $hash_multiplier)));
			
			// Time to find one block
			$sha_values[0] = number_format(1/$sha_blocks_per_day, 2, '.', ',');
			$scrypt_values[0] = number_format(1/$scrypt_blocks_per_day, 2, '.', ',');
			$skein_values[0] = number_format(1/$skein_blocks_per_day, 2, '.', ',');
			$groestl_values[0] = number_format(1/$groestl_blocks_per_day, 2, '.', ',');
			$qubit_values[0] = number_format(1/$qubit_blocks_per_day, 2, '.', ',');
			
			// Total MYR made
			$sha_values[1] = number_format((($sha_blocks_per_day * $coins_per_block) - (($sha_blocks_per_day * $coins_per_block) * $sha_fee)), 2, '.', ',');
			$scrypt_values[1] = number_format((($scrypt_blocks_per_day * $coins_per_block) - (($scrypt_blocks_per_day * $coins_per_block) * $scrypt_fee)), 2, '.', ',');
			$skein_values[1] = number_format((($skein_blocks_per_day * $coins_per_block) - (($skein_blocks_per_day * $coins_per_block) * $skein_fee)), 2, '.', ',');
			$groestl_values[1] = number_format((($groestl_blocks_per_day * $coins_per_block) - (($groestl_blocks_per_day * $coins_per_block) * $groestl_fee)), 2, '.', ',');
			$qubit_values[1] = number_format((($qubit_blocks_per_day * $coins_per_block) - (($qubit_blocks_per_day * $coins_per_block) * $qubit_fee)), 2, '.', ',');
			
			// Total BTC made
			$sha_values[2] = number_format((($sha_blocks_per_day * $coins_per_block) - (($sha_blocks_per_day * $coins_per_block) * $sha_fee)) * $myr_price, 8, '.', ',');
			$scrypt_values[2] = number_format((($scrypt_blocks_per_day * $coins_per_block) - (($scrypt_blocks_per_day * $coins_per_block) * $scrypt_fee)) * $myr_price, 8, '.', ',');
			$skein_values[2] = number_format((($skein_blocks_per_day * $coins_per_block) - (($skein_blocks_per_day * $coins_per_block) * $skein_fee)) * $myr_price, 8, '.', ',');
			$groestl_values[2] = number_format((($groestl_blocks_per_day * $coins_per_block) - (($groestl_blocks_per_day * $coins_per_block) * $groestl_fee)) * $myr_price, 8, '.', ',');
			$qubit_values[2] = number_format((($qubit_blocks_per_day * $coins_per_block) - (($qubit_blocks_per_day * $coins_per_block) * $qubit_fee)) * $myr_price, 8, '.', ',');
			
			// Total USD made
			$sha_values[3] = number_format((($sha_blocks_per_day * $coins_per_block) - (($sha_blocks_per_day * $coins_per_block) * $sha_fee)) * $myr_price * $btc_price, 4, '.', ',');
			$scrypt_values[3] = number_format((($scrypt_blocks_per_day * $coins_per_block) - (($scrypt_blocks_per_day * $coins_per_block) * $scrypt_fee)) * $myr_price * $btc_price, 4, '.', ',');
			$skein_values[3] = number_format((($skein_blocks_per_day * $coins_per_block) - (($skein_blocks_per_day * $coins_per_block) * $skein_fee)) * $myr_price * $btc_price, 4, '.', ',');
			$groestl_values[3] = number_format((($groestl_blocks_per_day * $coins_per_block) - (($groestl_blocks_per_day * $coins_per_block) * $groestl_fee)) * $myr_price * $btc_price, 4, '.', ',');
			$qubit_values[3] = number_format((($qubit_blocks_per_day * $coins_per_block) - (($qubit_blocks_per_day * $coins_per_block) * $qubit_fee)) * $myr_price * $btc_price, 4, '.', ',');
			
			// Total power consumption
			$sha_values[4] = number_format(($sha_power * 24)/1000, 2, '.', ',');
			$scrypt_values[4] = number_format(($scrypt_power * 24)/1000, 2, '.', ',');
			$skein_values[4] = number_format(($skein_power * 24)/1000, 2, '.', ',');
			$groestl_values[4] = number_format(($groestl_power * 24)/1000, 2, '.', ',');
			$qubit_values[4] = number_format(($qubit_power * 24)/1000, 2, '.', ',');
			
			// Total power cost
			$sha_values[5] = number_format((($sha_power * 24)/1000) * $power_cost, 2, '.', ',');
			$scrypt_values[5] = number_format((($scrypt_power * 24)/1000) * $power_cost, 2, '.', ',');
			$skein_values[5] = number_format((($skein_power * 24)/1000) * $power_cost, 2, '.', ',');
			$groestl_values[5] = number_format((($groestl_power * 24)/1000) * $power_cost, 2, '.', ',');
			$qubit_values[5] = number_format((($qubit_power * 24)/1000) * $power_cost, 2, '.', ',');
			
			// Total profit made
			$sha_values[6] = number_format($sha_values[3] - $sha_values[5], 4, '.', ',');
			$scrypt_values[6] = number_format($scrypt_values[3] - $scrypt_values[5], 4, '.', ',');
			$skein_values[6] = number_format($skein_values[3] - $skein_values[5], 4, '.', ',');
			$groestl_values[6] = number_format($groestl_values[3] - $groestl_values[5], 4, '.', ',');
			$qubit_values[6] = number_format($qubit_values[3] - $qubit_values[5], 4, '.', ',');
			
			// Time to ROI
			$sha_values[7] = number_format($sha_hardware/$sha_values[6], 2, '.', ',');
			$scrypt_values[7] = number_format($scrypt_hardware/$scrypt_values[6], 2, '.', ',');
			$skein_values[7] = number_format($skein_hardware/$skein_values[6], 2, '.', ',');
			$groestl_values[7] = number_format($groestl_hardware/$groestl_values[6], 2, '.', ',');
			$qubit_values[7] = number_format($qubit_hardware/$qubit_values[6], 2, '.', ',');
			
			$array_package[0] = $sha_values;
			$array_package[1] = $scrypt_values;
			$array_package[2] = $skein_values;
			$array_package[3] = $groestl_values;
			$array_package[4] = $qubit_values;
			
			return $array_package;
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
	<div class="inputHolder">			
	<div class="welcome">
		<center><h2><img src="http://birdspool.no-ip.org:5567/static/img/logo.png" style="width:2%;"</img>  Myriadcoin Profitability Calculator</h2></center>
        <p>
	Welcome! This tool lets you figure out mining profitability for all the MYR algorithms. 
	You don't need to fill out all the fields. The default difficulty is 
	calculated from the average of difficulties taken every hour over the past 24 hours, so it is  
	resistant to difficulty fluctuations. Alternatively, you can choose to use the 
	 average over a longer period of time for even more resistance. Enjoy!<br/>
	For more information regarding Myriadcoin, visit <a href="http://myriadplatform.org" target="_blank">MyriadPlatform.org</a>
	</div>
        	    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<center>
		<div class="inputBox">
		<hr/>
		<center><table class="mainTable">
			<tr>
				<td>
					<b>Algorithm: </b>
				<td/>
				<td>
					<b>Sha256d</b>
				<td/>
				<td>
					<b>Scrypt</b>
				<td/>
				<td>
					<b>Skein</b>
				<td/>
				<td>
					<b>Groestl</b>
				<td/>
				<td>
					<b>Qubit</b>
				<td/>
			</tr>
			<tr>
				<td>
					 <?php print "Difficulty: " . $average_string ?>
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
					<input type="text" name="sha_hardware" value="<?php echo $sha_hardware;?>" size="5"> $
				<td/>
				<td>
					<input type="text" name="scrypt_hardware" value="<?php echo $scrypt_hardware;?>" size="5"> $
				<td/>
				<td>
					<input type="text" name="skein_hardware" value="<?php echo $skein_hardware;?>" size="5"> $
				<td/>
				<td>
					<input type="text" name="groestl_hardware" value="<?php echo $groestl_hardware;?>" size="5"> $
				<td/>
				<td>
					<input type="text" name="qubit_hardware" value="<?php echo $qubit_hardware;?>" size="5"> $
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
				<td>
					MYR/Block &nbsp;
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
				<td>
					<input type="text" name="coins_per_block" value="<?php echo $coins_per_block;?>" size="5"> MYR
				<td/>
			<tr/>
		</table>
		<table class="mainTable">
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					<center><input type="submit" name="submit" value="Submit"></center>
				</td>
				<td>
					<center><input type="submit" name="clear" value="Clear"></center>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="refresh" value="Reset Price/Diff">
				</td>
				<td>
					<input type="submit" name="24_hr" value="24 Hour Avg Diff">
				</td>
				<td>
					<input type="submit" name="3_day" value="3 Day Avg Diff">
				</td>
				<td>
					<input type="submit" name="week" value="1 Week Avg Diff">
				</td>
			</tr>
		</table>
		</div>
		
		<div class="resultsBox">
		
			<div class="smallBox">
				<hr/>
				<center><b>Results (per day): </b></center>
				<hr/>
			</div>
		
		<table class="resultsTable">
			<tr>
				<td>
					<p> </p>
				<td/>
				<td>
					<b>Sha256d</b>
				<td/>
				<td>
					<b>Scrypt</b>
				<td/>
				<td>
					<b>Skein</b>
				<td/>
				<td>
					<b>Groestl</b>
				<td/>
				<td>
					<b>Qubit</b>
				<td/>
			</tr>
			<tr>
				<td>
					MYR Mined: 
				<td/>
				<td>
					<?php print $results[0][1]; ?> MYR
				<td/>
				<td>
					<?php print $results[1][1]; ?> MYR
				<td/>
				<td>
					<?php print $results[2][1]; ?> MYR
				<td/>
				<td>
					<?php print $results[3][1]; ?> MYR
				<td/>
				<td>
					<?php print $results[4][1]; ?> MYR
				<td/>
			</tr>
			<tr>
				<td>
					BTC Equivalent: 
				<td/>
				<td>
					<?php print $results[0][2]; ?> &#x0E3F <!-- BTC symbol -->
				<td/>
				<td>
					<?php print $results[1][2]; ?> &#x0E3F
				<td/>
				<td>
					<?php print $results[2][2]; ?> &#x0E3F
				<td/>
				<td>
					<?php print $results[3][2]; ?> &#x0E3F
				<td/>
				<td>
					<?php print $results[4][2]; ?> &#x0E3F
				<td/>
			</tr>
			<tr>
				<td>
					USD Equivalent: 
				<td/>
				<td>
					<?php print $results[0][3]; ?> $
				<td/>
				<td>
					<?php print $results[1][3]; ?> $
				<td/>
				<td>
					<?php print $results[2][3]; ?> $
				<td/>
				<td>
					<?php print $results[3][3]; ?> $
				<td/>
				<td>
					<?php print $results[4][3]; ?> $
				<td/>
			</tr>
			<tr>
				<td>
					Total Power Consumption: 
				<td/>
				<td>
					<?php print $results[0][4]; ?> Kwh
				<td/>
				<td>
					<?php print $results[1][4]; ?> Kwh
				<td/>
				<td>
					<?php print $results[2][4]; ?> Kwh
				<td/>
				<td>
					<?php print $results[3][4]; ?> Kwh
				<td/>
				<td>
					<?php print $results[4][4]; ?> Kwh
				<td/>
			</tr>
			<tr>
				<td>
					Total Power Cost: 
				<td/>
				<td>
					<?php print $results[0][5]; ?> $
				<td/>
				<td>
					<?php print $results[1][5]; ?> $
				<td/>
				<td>
					<?php print $results[2][5]; ?> $
				<td/>
				<td>
					<?php print $results[3][5]; ?> $
				<td/>
				<td>
					<?php print $results[4][5]; ?> $
				<td/>
			</tr>
			<tr>
				<td>
					Total Profit: 
				<td/>
				<td>
					<?php print $results[0][6]; ?> $
				<td/>
				<td>
					<?php print $results[1][6]; ?> $
				<td/>
				<td>
					<?php print $results[2][6]; ?> $
				<td/>
				<td>
					<?php print $results[3][6]; ?> $
				<td/>
				<td>
					<?php print $results[4][6]; ?> $
				<td/>
			</tr>
			<tr>
				<td>
					Time to find one block: 
				<td/>
				<td>
					<?php print $results[0][0]; ?> days
				<td/>
				<td>
					<?php print $results[1][0]; ?> days
				<td/>
				<td>
					<?php print $results[2][0]; ?> days
				<td/>
				<td>
					<?php print $results[3][0]; ?> days
				<td/>
				<td>
					<?php print $results[4][0]; ?> days
				<td/>
			</tr>
			<tr>
				<td>
					Time to ROI: 
				<td/>
				<td>
					<?php 
						if($results[0][7] > 0)
						{
							print $results[0][7]; 
						}
						else
						{
							print "&#8734";
						}
					?> days
				<td/>
				<td>
					<?php 
						if($results[1][7] > 0)
						{
							print $results[1][7]; 
						}
						else
						{
							print "&#8734";
						}
					?> days
				<td/>
				<td>
					<?php 
						if($results[2][7] > 0)
						{
							print $results[2][7]; 
						}
						else
						{
							print "&#8734";
						}
					?> days
				<td/>
				<td>
					<?php 
						if($results[3][7] > 0)
						{
							print $results[3][7]; 
						}
						else
						{
							print "&#8734";
						}
					?> days
				<td/>
				<td>
					<?php 
						if($results[4][7] > 0)
						{
							print $results[4][7]; 
						}
						else
						{
							print "&#8734";
						}
					?> days
				<td/>
			</tr>
		</table></center>

		</div>
		
	</div>
	  
	</form>
			</article> </p>
			
			<footer>
				Mining profitability calculator by birdonwheels5. Want to show some love? Donate some MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm
			</footer>
			
		</div>
	</body>
	
</html>
