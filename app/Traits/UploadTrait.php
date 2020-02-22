<?php

namespace App\Traits;

use App\Image;
use Dotenv\Regex\Success;
use Images;
use Illuminate\Support\Facades\File;

trait UploadTrait
{
  public function uploadPhoto($image, $filename = null, $imageable_type, $imageable_id)
  {
    $width = 800;
    $height = 800;
    $location = public_path('images/') . $filename;
    $imag=Images::make($image);
    $imag->width() > $imag->height() ? $width=null : $height=null;
    $imag->resize($width, $height, function ($constraint) {
      $constraint->aspectRatio();
    });
    $imag->save($location);
            $image = new Image;
            $image->url = 'images/'.$filename;
            $image->imageable_type = $imageable_type;
            $image->imageable_id = $imageable_id;
            $image->save();

            return true;
  }
  public function deletePhoto($id)
  {
     $image = Image::findOrFail($id);
     $path = public_path($image->url);
     unlink($path);
     $image->delete();
  }
}
