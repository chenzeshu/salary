<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    protected $table = 'manager';
    protected  $primaryKey = 'mg_id';
    public $timestamps = false;
    protected $guarded =[];
}
