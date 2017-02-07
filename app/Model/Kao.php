<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kao extends Model
{
    protected $table = 'kao';
    protected  $primaryKey = 'kao_id';
    public $timestamps = false;
    protected $guarded =[];
}
