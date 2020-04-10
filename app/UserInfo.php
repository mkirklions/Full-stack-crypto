<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

	 protected $fillable = [
        'nickname', 'user_id', 'email',
    ];
    //
 public static function get_id_from_nickname($nickname)
  {
    return static::where('nickname', $nickname )->value('user_id');
}

 public static function get_nickname_from_id($user_id)
  {
    return static::where('user_id', $user_id )->value('nickname');
}

 public static function get_first_name_from_id($user_id)
  {
    return static::where('user_id', $user_id )->value('first_name');
}

 public static function get_first_name_from_nickname($nickname)
  {
    return static::where('nickname', $nickname )->value('first_name');
}





}
