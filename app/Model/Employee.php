<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected  $primaryKey = 'e_id';
    public $timestamps = false;
    protected $guarded =[];
}
