<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Koubu extends Model
{
    protected $table = 'koubu';
    protected  $primaryKey = 'kb_id';
    public $timestamps = false;
    protected $guarded =[];
}
