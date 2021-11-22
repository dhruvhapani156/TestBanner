<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GreetingImage extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'greeting_id','language','title','image' ,'status','description',
    ];
    protected $appends = ['image_url'];
    protected $table = 'greeting_image';

    public function greeting_category(){
        return $this->belongsTo(GreetingCategory::class,'greeting_id','id');
    }

    public function getImageUrlAttribute($value)
    {
        return  !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])? Storage::url($this->attributes['image']):null;
    }

}
