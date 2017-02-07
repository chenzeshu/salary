<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected  $primaryKey = 'job_id';
    public $timestamps = false;
    protected $guarded =[];
}
