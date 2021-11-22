<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Test extends Model
{
    //use SoftDeletes;
    protected $table = "ccdb";

    protected $fillable = [
        'author','title','type' ,'publisher','version','year','remarks'
    ];

}
