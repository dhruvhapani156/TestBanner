<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BusinessCategoryImageUpload extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'business_category_id','language','title','image' ,'status','description',
    ];
    protected $appends = ['image_url'];
     protected $table = 'business_category_image_upload';

    public function business_category(){
        return $this->belongsTo(BusinessCategory::class,'business_category_id','id');
    }

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }

}
