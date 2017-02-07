<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bukou extends Model
{
    protected $table = 'bukou';
    protected  $primaryKey = 'bk_id';
    public $timestamps = false;
    protected $guarded =[];
}
