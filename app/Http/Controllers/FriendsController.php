<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\UserInfo;
Use App\Txn;

class FriendsController extends Controller
{
    //


	public function index($nickname) {

		/*  set useridd*/
		$friend_id=UserInfo::get_id_from_nickname($nickname);
		$friend_first_name= UserInfo::get_first_name_from_nickname($nickname);
		$all_friend_txns=Txn::get_all_friend_txns($friend_id);

		echo ($nickname.$friend_first_name.$all_friend_txns);

		$total_exchanged=0;
		/*  Loop through transactions*/
		foreach ($all_friend_txns as $txn_number => $friend_txns_list) {
			/*  get all transaction costs*/
			echo("<h2>Transaction #".$friend_txns_list.": ");
			$friend_credit_list= Txn::get_txn_credit($friend_txns_list);
			echo($friend_credit_list);
			echo(" MySPY</h2>");
			/*include Friend Note*/
			$friend_txn_note= Txn::get_txn_note($friend_txns_list);
			echo("Note:".$friend_txn_note."</br>");
			/*  sum all transaction costs*/
			$total_exchanged += $friend_credit_list;
		}
		echo("<h2> Total Balance of Exchange: ");
		echo($total_exchanged);
		echo(" MySPY </h2></br>");
	}
	
	public function friendslist() 
	{
			  return view('friends-list', compact('name', 'age')); 
	}
}
