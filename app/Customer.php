<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function user()
    {
       return $this->belongsTo('App\User');
    }
    public function gallery()
    {
       return $this->hasMany('App\Gallery');
    }
    public function image_selected()
    {
        return $this->hasMany('App\Image_selected');
    }
    public function customer_user()
    {
       return $this->hasOne('App\User');
    } 
    
}
