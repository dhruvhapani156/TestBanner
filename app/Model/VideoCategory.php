<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class VideoCategory extends Model
{
    //
    use SoftDeletes;
    protected $table = 'categories_video';
    protected $fillable = [
        'sequence','name','image' ,'status','language',
    ];
    protected $appends = ['image_url'];

    public static $languages = [
        'Gujarati'=>'Gujarati',
        'Hindi'=>'Hindi',
        'English'=>'English',

    ];

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }
    public function category_videos(){
        return $this->hasMany('App\Model\VideoUpload','category_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleted(function($category) {
            $category->category_videos()->delete();
        });
    }
}
