<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public function image()
    {
        return $this->morphMany('App\Image','imageable');
    }
    /* public function image_selected()
    {
        return $this->hasOne('App\Image_selected');
    }  */
}
