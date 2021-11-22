<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Business extends Model
{
    //

    //
    use SoftDeletes;

    protected $fillable = [
        'id','name','image' ,'status',
    ];
    protected $table = 'business';




}
