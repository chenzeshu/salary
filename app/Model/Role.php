<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function isRole($name,$role)
    {
        $user = User::where('user_name',$name)->first();
        return $user->hasRole($role);
    }
}
