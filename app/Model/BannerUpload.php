<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BannerUpload extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title','image' ,'status','description',
    ];
    protected $appends = ['image_url'];
    protected $table = 'banner_upload';

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }

}
