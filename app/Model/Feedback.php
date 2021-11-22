<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Feedback extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name','contact' ,'status','description','user_id',
    ];

    protected $table = 'feedback';


}
