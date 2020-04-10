<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserBalance;
use App\Friend;
use App\UserInfo;

class UserBalancesController extends Controller
{
    //


    public function index() 
    {
    $user_id=1;
    /*  set useridd*/
    $user_balance=UserBalance::get_user_balance($user_id);
    $past_balance_list= UserBalance::get_past_balances($user_id);
    $past_txns_list=UserBalance::get_past_txn_list($user_id);
    $past_txns_usd_list= UserBalance::get_past_txns_usd($user_id);
    $past_balance_usd_list= UserBalance::get_past_balance_usd($user_id);
    echo ("Current Balance: ".$user_balance."</br> All previous balances: ".$past_balance_list."</br>");
    echo ("Past transactions: ".$past_txns_list."</br>");
    echo ("Past transactions USD Value: ".$past_txns_usd_list."</br>". "Past USD Balances: ".$past_balance_usd_list);
	}


	


}
