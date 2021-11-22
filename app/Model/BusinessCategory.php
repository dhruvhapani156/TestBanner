<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BusinessCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','name','image' ,'status','language',
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }
    public function business_category_images(){
        return $this->hasMany('App\Model\BusinessCategoryImageUpload','business_category_id');
    }
    public function business_category_videos(){
        return $this->hasMany('App\Model\BusinessVideoUpload','business_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleted(function($business_category) {
            $business_category->business_category_images()->delete();
            $business_category->business_category_videos()->delete();
        });
    }

}
