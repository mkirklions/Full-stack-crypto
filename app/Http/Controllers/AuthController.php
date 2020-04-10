<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserInfo;

class AuthController extends Controller
{

	public function __construct() {
		$this->middlewear('guest');
	}



    public function register() {


  		return view('register');


    }


    public function store() {



    	$this->validate(request(), [

    		'nickname'=> 'required',
    		'email'=>  'required|email',
    		'password'=>'required|confirmed',
    	]);

    	$user= User::create(
    		[
    			'nickname'=>request('nickname'),
    			'email'=>request('email'),
    			'password'=>bcrypt('password')
    		]);

    	$nickname= request('nickname');

    	$user_id=User::get_id_from_nickname($nickname);

    	$userInfo= UserInfo::create(
    		[
    			'user_id'=>$user_id,
    			'nickname'=>request('nickname'),
    			'email'=>request('email'),
    			
    		]);

    	auth()->login($user);
    	return redirect()->home();

    }

    public function login() {
    	return view("login");

    }

    public function signin() {

    	if  (! 	auth()->attempt(request(['email','password']))   )
    	{
    		return back();
    	} 
    	; 

    	return redirect()->home();

    }

    public function logout() {

    	auth()->logout();

    	return redirect()->home();


    }


}
