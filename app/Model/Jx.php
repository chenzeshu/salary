<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jx extends Model
{
    protected $table = 'jx';
    protected  $primaryKey = 'jx_id';
    public $timestamps = false;
    protected $guarded =[];
}
