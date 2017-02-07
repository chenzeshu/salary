<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jia extends Model
{
    protected $table = 'jia';
    protected  $primaryKey = 'jia_id';
    public $timestamps = false;
    protected $guarded =[];
}
