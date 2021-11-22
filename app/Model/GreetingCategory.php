<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GreetingCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','name','image' ,'status','language',
    ];
    protected $appends = ['image_url'];
    protected $table = 'greeting_categories';


    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }
    public function greeting_images(){
        return $this->hasMany('App\Model\GreetingImage','greeting_id');
    }


    protected static function boot() {
        parent::boot();
        static::deleted(function($business_category) {
            $business_category->greeting_images()->delete();

        });
    }

}
