<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Txn;
use App\UserInfo;
use App\UserBalance;
use App\Friend;

//make sure there is the ISSET command
function generateRandomString($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


class TxnsController extends Controller
{

  public function __construct() 
  {
    //this doesnt allow guests to view. Only logged in users
    //$this->middleware('auth');
  }

  public function index() {

    $txns= Txn::all();
    /*  set useridd*/
    $use_this_id=1;
    $txn_note=Txn::get_txn_note(2);
    $txn_credit= Txn::get_txn_credit(2);
    $myspy= Txn::get_myspy(1);
    $user_id=Txn::get_user_id(1);
    $all_txn_nums=Txn::get_all_txn_nums(1);
 
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

    return view('txns.index', compact('all_txn_nums', 'txns'));

  }



public function payment() {

  return view('payment');

}


public function store() 
{

$this->validate(request(), 
  [
  'nickname'=>'required',
  'myspy_to_send'=> 'required'
]);
//need to stop txn if they dont have enough money
$user_id= auth()->id();
$nickname=request('nickname');

$user_myspy=Txn::get_myspy($user_id);
$myspy_hold= request('myspy_to_send');


if ($user_myspy>$myspy_hold) {


//Need better friend rules, double entry is happening
$friend_id= UserInfo::get_id_from_nickname($nickname);

$Friend= new Friend;
$Friend->user_id=$user_id;
$Friend->friend_id=$friend_id;
$Friend->save();

$Friend= new Friend;
$Friend->user_id=$friend_id;
$Friend->friend_id=$user_id;
$Friend->save();




$txn_number=generateRandomString();
/*send money*/
$Txn = new Txn;
$Txn->user_id=$user_id;
$Txn->friend_id=$friend_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= -1*abs($myspy_hold);
$Txn->note="pls work";
$Txn->type="storetxn";
$Txn->device="michaelPC";
$Txn->save();

/*recieve money*/
$Txn = new Txn;
$Txn->user_id=$friend_id;
$Txn->friend_id=$user_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= $myspy_hold;
$Txn->note="pls work";
$Txn->type="storetxn";
$Txn->device="mandyPC";
$Txn->save();

/*need an undo if postdata is resubmitted



/*Check Double Entry*/
$double_entry= Txn::test_double_entry($txn_number);
if($double_entry==0) 
{

  //update user balance
  $spyConversion=273;

  $UserBalance= new UserBalance;
  $UserBalance->user_id=$user_id;
  $UserBalance->myspy_balance=Txn::get_myspy($user_id);
  $UserBalance->last_transaction=$txn_number;
  $UserBalance->last_transaction_usd_value=$spyConversion;
  $UserBalance->instant_total_usd=$myspy_hold*$spyConversion;
  $UserBalance->save();


    //add later, "all or nothing". SQL calls this a 'transaction'


  //update friend's user balance
  $UserBalance= new UserBalance;
  $UserBalance->user_id=$friend_id;
  $UserBalance->myspy_balance=Txn::get_myspy($friend_id);
  $UserBalance->last_transaction=$txn_number;
  $UserBalance->last_transaction_usd_value=$spyConversion;
  $UserBalance->instant_total_usd=$myspy_hold*$spyConversion;
  $UserBalance->save();

   return view('txns.success');
}
else
{
/*refund send money*/
$Txn = new Txn;
$Txn->user_id=$user_id;
$Txn->friend_id=$friend_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= Txn::get_txn_credit($txn_number);
$Txn->note="Error: double entry mismatch REFUND";
$Txn->type="storetxn";
$Txn->device="michaelPC";
$Txn->save();

/*refund send money*/
$Txn = new Txn;
$Txn->user_id=$friend_id;
$Txn->friend_id=$user_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= (-1 * get_txn_credit($txn_number));
$Txn->note="Error: double entry mismatch REFUND";
$Txn->type="storetxn";
$Txn->device="mandyPC";
$Txn->save();

return view('txns.problem');

}
}

else {

  //need correct error to be documented to user
  return view('txns.insufficient');

}
}


//The following is for react native testing
//*************************************************************************



public function mobile() 
{


$this->validate(request(), 
  [
  
  'nickname'=>'required',
  'myspy_to_send'=> 'required'
]);

$token_id=request('Authorization');

//need to stop txn if they dont have enough money

//$user_id= DB::table('oauth_access_tokens')->where('id', $token_id)->value('user_id');
$user_id= DB::select('select user_id from oauth_access_tokens where id='.$token_id);


$nickname=request('nickname');

//error_log(request('nickname'), 0);

$user_myspy=Txn::get_myspy($user_id);
$myspy_hold= request('myspy_to_send');


if ($user_myspy>$myspy_hold) {




$friend_id= UserInfo::get_id_from_nickname($nickname);

$Friend= new Friend;
$Friend->user_id=$user_id;
$Friend->friend_id=$friend_id;
$Friend->save();

$Friend= new Friend;
$Friend->user_id=$friend_id;
$Friend->friend_id=$user_id;
$Friend->save();




$txn_number=generateRandomString();
/*send money*/
$Txn = new Txn;
$Txn->user_id=$user_id;
$Txn->friend_id=$friend_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= -1*abs($myspy_hold);
$Txn->note="pls work";
$Txn->type="storetxn";
$Txn->device="michaelPC";
$Txn->save();

/*recieve money*/
$Txn = new Txn;
$Txn->user_id=$friend_id;
$Txn->friend_id=$user_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= $myspy_hold;
$Txn->note="pls work";
$Txn->type="storetxn";
$Txn->device="mandyPC";
$Txn->save();

/*need an undo if postdata is resubmitted



/*Check Double Entry*/
$double_entry= Txn::test_double_entry($txn_number);
if($double_entry==0) 
{

  //update user balance
  $spyConversion=273;

  $UserBalance= new UserBalance;
  $UserBalance->user_id=$user_id;
  $UserBalance->myspy_balance=Txn::get_myspy($user_id);
  $UserBalance->last_transaction=$txn_number;
  $UserBalance->last_transaction_usd_value=$spyConversion;
  $UserBalance->instant_total_usd=$myspy_hold*$spyConversion;
  $UserBalance->save();

  //update friend's user balance
  $UserBalance= new UserBalance;
  $UserBalance->user_id=$friend_id;
  $UserBalance->myspy_balance=Txn::get_myspy($user_id);
  $UserBalance->last_transaction=$txn_number;
  $UserBalance->last_transaction_usd_value=$spyConversion;
  $UserBalance->instant_total_usd=$myspy_hold*$spyConversion;
  $UserBalance->save();

   return view('txns.success');
}
else
{
/*refund send money*/
$Txn = new Txn;
$Txn->user_id=$user_id;
$Txn->friend_id=$friend_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= Txn::get_txn_credit($txn_number);
$Txn->note="Error: double entry mismatch REFUND";
$Txn->type="storetxn";
$Txn->device="michaelPC";
$Txn->save();

/*refund send money*/
$Txn = new Txn;
$Txn->user_id=$friend_id;
$Txn->friend_id=$user_id;
$Txn->txn_number=$txn_number;
$Txn->myspy_credit= (-1 * get_txn_credit($txn_number));
$Txn->note="Error: double entry mismatch REFUND";
$Txn->type="storetxn";
$Txn->device="mandyPC";
$Txn->save();

return view('txns.problem');

}
}

else {

  //need correct error to be documented to user
  return view('txns.insufficient');

}
}


}