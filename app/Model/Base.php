<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table = 'base';
    protected  $primaryKey = 'base_id';
    public $timestamps = false;
    protected $guarded =[];
}
