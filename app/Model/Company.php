<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    //
    use SoftDeletes;
    protected $table = 'company';
    protected $fillable = [
        'name','email','address','contact','logo','user_id','website'
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute($value)
    {
        return  !empty($this->attributes['logo']) && Storage::exists($this->attributes['logo'])? Storage::url($this->attributes['logo']):null;
    }
}
