<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Txn extends Model
{

  public static function get_txn_id_from_txn($txn_number)
  {
    return static::where('txn_number',$txn_number)->pluck('id');
  }

  public static function test_double_entry($txn_number)
  {
    $txn_ids=static::where('txn_number',$txn_number)->pluck('id');
     $credit_and_debit =static::where('txn_number',$txn_number)->pluck('myspy_credit');

     $sum = 0;
    foreach($credit_and_debit as $id=>$txn_ids){
    if(isset($credit_and_debit->commission))
      $sum += $credit_and_debit->commission;
      }

     return $sum;
   }
     

  public static function get_user_id($user_id)
  {
  	return static::where('user_id', $user_id )->value('user_id');
  }


public static function get_user_credit_from_row($id)
  {
    return static::where('id', $id )->value('myspy_credit');
  }
public static function get_friend_credit_from_row($id)
  {
    return static::where('id', $id )->value('myspy_credit');
  }


   public static function get_user_id_from_txn($txn_number)
  {
    return static::where('txn_number', $txn_number )->value('user_id');
  }

  public static function get_friend_id_from_txn($txn_number)
  {
    return static::where('txn_number', $txn_number )->value('friend_id');
  }




  public static function get_all_txn_nums($user_id)
  {
    return static::where('user_id', $user_id )->pluck('txn_number');
  }

  public static function get_txn_credit($txn_number)
  {
    return static::where('txn_number', $txn_number )->value('myspy_credit');
  }

  public static function get_myspy($user_id)
  {
    $total_user_myspy=0;
    $user_transactions= static::where('user_id', $user_id )->pluck('id');
    /*  Loop through transactions*/
    foreach ($user_transactions as $txn_number => $user_txns_list) 
    {
      //need to go from txn number to id number
      $user_credit_list= static::where('id', $user_txns_list )->value('myspy_credit');
      $total_user_myspy += $user_credit_list;
    }
    return $total_user_myspy;
  }

  public static function get_txn_note($txn_number)
  {
    return static::where('txn_number', $txn_number )->value('note');
  }


    public static function get_all_friend_txns($friend_id)
  {
    return static::where('user_id', $friend_id)->pluck('txn_number');
  }




}


