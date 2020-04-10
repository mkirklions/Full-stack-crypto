<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    //

    public static function get_user_balance($user_id)
  {
  	return static::where('user_id', $user_id )->latest()->value('myspy_balance');
  
}

public static function get_past_balances($user_id)
  {
  	return static::where('user_id', $user_id )->pluck('myspy_balance');
  
}

public static function get_past_txn_list($user_id)
  {
  	return static::where('user_id', $user_id )->pluck('last_transaction');
  
}

public static function get_past_txns_usd($user_id)
  {
  	return static::where('user_id', $user_id )->pluck('last_transaction_usd_value');
  
}

public static function get_past_balance_usd($user_id)
  {
  	return static::where('user_id', $user_id )->pluck('instant_total_usd');
  
}


 



}
