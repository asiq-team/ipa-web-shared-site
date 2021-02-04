<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKey extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getAppKey($username){
        $data = UserKey::where("users.username",$username)->orWhere("users.email",$username)
        ->leftJoin("user_has_role","user_has_role.user_id","=","users.id")
        ->leftJoin("roles","roles.role_key","=","user_has_role.role_key")
        ->leftJoin("role_has_application","role_has_application.role_id","=","roles.id")
        ->leftJoin("applications","applications.id","=","role_has_application.application_id")
        ->selectRaw("applications.application_key")
        ->first();

        return $data;
    }
}
