<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bu extends Model
{
    protected $table = 'bu';
    protected  $primaryKey = 'bu_id';
    public $timestamps = false;
    protected $guarded =[];
}
