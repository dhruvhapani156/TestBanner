<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BusinessVideoUpload extends Model
{
    //

    //
    use SoftDeletes;

    protected $fillable = [
        'business_id','title','video' ,'status','description','language',
    ];
    protected $appends = ['video_url'];
    protected $table = 'business_video_upload';

    public function videocategory(){
        return $this->belongsTo(BusinessCategory::class,'business_id','id');
    }

    public function getVideoUrlAttribute($value)
    {
        return  !empty($this->attributes['video']) && Storage::exists($this->attributes['video'])? Storage::url($this->attributes['video']):null;
    }

}
