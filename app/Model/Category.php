<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sequence','name','image' ,'status','language','active_from',
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }
    public function category_images(){
        return $this->hasMany('App\Model\ImageUpload','category_id');
    }
    public function category_videos(){
        return $this->hasMany('App\Model\FestivalVideoUpload','festival_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleted(function($category) {
           $category->category_images()->delete();
           $category->category_videos()->delete();

        });
    }

}
