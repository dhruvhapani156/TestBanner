<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FestivalVideoUpload extends Model
{
    //

    //
    use SoftDeletes;

    protected $fillable = [
        'festival_id','title','video' ,'status','description','language',
    ];
    protected $appends = ['video_url'];
    protected $table = 'festival_video_upload';

    public function videocategory(){
        return $this->belongsTo(Category::class,'festival_id','id');
    }

    public function getVideoUrlAttribute($value)
    {
        return  !empty($this->attributes['video']) && Storage::exists($this->attributes['video'])? Storage::url($this->attributes['video']):null;
    }

}
