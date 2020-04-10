<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserInfo;

class UserInfosController extends Controller
{
    //
     public function index() {

    /*  set useridd*/
    $use_this_id=1;
    $txn_note=Txn::get_txn_note(2);
    $txn_credit= Txn::get_txn_credit(2);



    $myspy= Txn::get_myspy(1);
    $user_id=Txn::get_user_id(1);

    $all_txn_nums=Txn::get_all_txn_nums(1);

    echo("<h2> Welcome ");
       /* first name
    $first_name= DB::table('user_info')->where('user_id', $use_this_id )->value('first_name');
    echo($first_name);
*/
    echo("</h2></br>");

    /*  get all transaction values*/
    echo("<h2> Previous Transaction Numbers: ");
    echo($all_txn_nums);
    echo("</h2></br>");

    /*set total_exchanged to 0 to declare the variable*/
    $total_user_myspy=0;
    /*  Loop through transactions*/
    foreach ($all_txn_nums as $txn_number => $user_txns_list) {
      /*  get all transaction costs*/
      echo("<h2>Transaction #".$txn_number.": ");
      $txn_credit= Txn::get_txn_credit($user_txns_list);
      echo($txn_credit);
      echo(" MySPY</h2>");

      /*include Friend Note*/
      $txn_note=Txn::get_txn_note($user_txns_list);
      echo("Note:".$txn_note."</br>");
      /*  sum all transaction costs*/
      $total_user_myspy += $txn_credit;
    }
    
    echo("<h2> Total Balance of Exchange: ");
    echo($total_user_myspy);
    echo(" MySPY </h2></br>");


}


    public function update() {
      return view("update");

    }

    public function store() {

      $this->validate(request(), 
  [
  'first_name'=>'required',
  'last_name'=> 'required',
  'street_address'=> 'required',
  'city'=> 'required',
  'postal_code'=> 'required',
  'associated_number'=> 'required',
  'phone_number'=> 'required',
]);

      $user_id= auth()->id();

      
      
      $first_name= request('first_name');
      $last_name= request('last_name');
      $street_address= request('street_address');
      $city= request('city');
      $postal_code= request('postal_code');
      $associated_number= request('associated_number');
      $phone_number= request('phone_number');

    

      $UserInfo = UserInfo::find($user_id);

      $UserInfo->first_name=$first_name;
      $UserInfo->last_name=$last_name;
      $UserInfo->street_address=$street_address;
      $UserInfo->city=$city;
      $UserInfo->postal_code=$postal_code;
      $UserInfo->associated_number=$associated_number;
      $UserInfo->phone_number=$phone_number;
     

      $UserInfo->save();

      }




}
