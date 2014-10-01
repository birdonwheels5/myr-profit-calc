<?php

// This class is used for neatly storing the user data in memory so we can manipulate it after reading from file.
class User
{
  private $ip_address = "";
  private $sha_hashrate = 0;
  private $scrypt_hashrate = 0;
  private $skein_hashrate = 0;
  private $groestl_hashrate = 0;
  private $qubit_hashrate = 0;
  private $power_consumption = 0;
  private $power_cost = 0;
  private $pool_fees = 0;
  
  
  
  function __construct($new_ip_address, $new_sha_hashrate, $new_scrypt_hashrate, $new_skein_hashrate, $new_groestl_hashrate, $new_qubit_hashrate, $new_power_consumption, $new_power_cost, $new_pool_fees)
  {
    $this->ip_address = $new_ip_address;
    $this->sha_hashrate = $new_sha_hashrate;
    $this->scrypt_hashrate = $new_scrypt_hashrate;
    $this->skein_hashrate = $new_skein_hashrate;
    $this->groestl_hashrate = $new_groestl_hashrate;
    $this->qubit_hashrate = $new_qubit_hashrate;
    $this->power_consumption = $new_power_consumption;
    $this->power_cost = $new_power_cost;
    $this->pool_fees = $new_pool_fees;
  }
  
  
  function get_ip_address()
  {
    return $this->ip_address;
  }
  
  function get_sha_hashrate()
  {
    return $this->sha_hashrate;
  }
  
  function get_scrypt_hashrate()
  {
    return $this->scrypt_hashrate;
  }
  
  function get_skein_hashrate()
  {
    return $this->skein_hashrate;
  }
  
  function get_groestl_hashrate()
  {
    return $this->groestl_hashrate;
  }
  
  function get_qubit_hashrate()
  {
    return $this->qubit_hashrate;
  }
  
  function get_power_consumption()
  {
    return $this->power_consumption;
  }
  
  function get_power_cost()
  {
    return $this->power_cost;
  }
  
  function get_pool_fees()
  {
    return $this->pool_fees;
  }
  
  
}


?>
