<?php

Route::get('/', function () {
		  return view('index', compact('name', 'age')); 
})->name('home');


Route::get('/txns/', 'TxnsController@index')->name('txns');
Route::get('/txns/payment', 'TxnsController@payment');
Route::post('/txns/', 'TxnsController@store');


Route::post('/txns/mobile/', 'TxnsController@mobile');

Route::get('/privacypolicy', function () {
    return view('privacypolicy');
});
  
Route::get('/friend/{friend}', 'FriendsController@index');
Route::get('/friends-list/', 'FriendsController@friendslist');

Route::get('/send/', 'UserBalancesController@index');

Route::get('/update', 'UserInfosController@update');
Route::post('/update','UserInfosController@store');

//Route::get('/register', 'AuthController@register');
//Route::post('/register', 'AuthController@store');

//Route::get('/login', 'AuthController@login'); 
//Route::post('/login', 'AuthController@signin'); 
//Route::post('/logout', 'AuthController@logout'); 


Auth::routes();

/* Your options

GET /posts

GET /posts/create

POST /posts

GET /posts/{id}

PATCH /posts/{id}

DELETE /posts/{id}

*/

















Route::get('/workingtest', function () {

  $txns= DB::table('txns')->latest()->get();
    echo($txns);
      $name= 'tempName';
      $age= '31';
      $tasks= [
        'solve problems',
        'get to work',
        'dont be weak'
      ]; 


 $txns= App\Txn::all();
    echo($txns);
 

  /*  return view('privacypolicy');*/
    $user_balance_table= DB::table('user_balance')->latest()->get();
    echo($user_balance_table);

    /*  get user_id;*/
    $get_user= DB::table('user_balance')->where('user_id', 1 )->get();
    echo($get_user);
    echo("</br>");

    /*  get user_id;*/
    $user_id= DB::table('user_balance')->where('user_id', 1 )->value('user_id');
    echo($user_id);
    echo("</br>");

    /*  get myspy_balance from user_balance table;*/
    $myspy_balance= DB::table('user_balance')->where('user_id', 1 )->value('myspy_balance');
    echo($myspy_balance);
    echo("</br>");

    /*  get entire friends list using plunk;*/
    $friends= DB::table('friends')->where('user_id', 1)->pluck('friend_id');
    echo($friends);
    echo("</br>");

    /*  Loop through friends*/
    foreach ($friends as $friend_id => $friend_user_id) {
    
    /*  find friend name using friend info in the user_info table*/
    $friend_name= DB::table('user_info')->where('user_id', $friend_user_id )->value('first_name');
    echo($friend_name);
    echo("</br>");
    /*  find friend name using friend info in the user_info table*/
    $friend_nickname= DB::table('user_info')->where('user_id', $friend_user_id )->value('nickname');
    echo($friend_nickname);
    echo("</br>");
    /*  find friend name using friend info in the user_info table*/
    $friend_transactions= DB::table('user_info')->where('user_id', $friend_user_id )->value('first_name');
    echo($friend_name);
    echo("</br>");
  };
});


