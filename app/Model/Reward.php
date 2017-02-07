<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'reward';
    protected  $primaryKey = 're_id';
    public $timestamps = false;
    protected $guarded =[];
}
