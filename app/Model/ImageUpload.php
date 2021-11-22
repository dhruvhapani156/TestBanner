<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ImageUpload extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'category_id','title','image' ,'status','description','language',
    ];
    protected $appends = ['image_url'];
     protected $table = 'image_upload';

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }

}
