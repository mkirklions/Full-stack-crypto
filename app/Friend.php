<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //


  public static function get_all_friends($user_id)
  {
/*  get entire friends list using plunk;*/
  	return static::where('user_id', 1)->pluck('friend_id');
    
} 






}