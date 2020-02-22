<?php
namespace App\Http\Controllers\Admin;
use App\Gallery;
use App\Image;
use App\Customer;
use App\User;
use App\Image_selected;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
Use Alert;
class GalleryController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$gallery = Gallery::get();
        /* $gallery = Gallery::leftJoin('image_selecteds', function($join) {
            $join->on('galleries.id', '=', 'image_selecteds.gallery_id');
          })
          ->get(); */
          $gallery = Gallery::select('galleries.*','image_selecteds.id as image_selected_id','image_selecteds.image')
    ->leftJoin('image_selecteds', 'galleries.id', '=', 'image_selecteds.gallery_id')->orderBy('id', 'DESC')
    ->get();
        //dd($gallery);
        $active_mn = 'gallery';
        $active_sub_mn = 'view_gallery';
        return view('admin.gallery.view_gallery',compact('gallery','active_mn','active_sub_mn'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$customers = Customer::get();
        $customers = Customer::whereHas('user',function($query){
            $query->whereHas('roles',function($roles){
                $roles->where('name', '=' ,'client');
            });
        })->get();
        $active_mn = 'gallery';
        $active_sub_mn = 'create_gallery';
        return view('admin.gallery.add_gallery',compact('customers','active_mn','active_sub_mn'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        
        $gallery = new Gallery;
        $gallery->customer_id = $request->post('customer_id');
        $gallery->title = $request->post('title');
        $gallery->description = $request->post('description');
        $gallery->save();
        $gallery_id = $gallery->id;
        if($request->hasfile('image'))
        {
            $files = $request->file('image');
            foreach($files as $file){
                $name = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                //echo $name;
                /* $filename = $file->getClientOriginalName();
                   $extension = $file->getClientOriginalExtension();
                   $fileName = str_random(5)."-".date('his')."-".str_random(3).".".$extension;
                   $destinationPath = 'images/';
                   $file->move($destinationPath, $fileName);  */
                $image = $file;
                $filename = time(). '-'.$name.'.'.$file->getClientOriginalExtension();
                $this->uploadPhoto($image, $filename, 'App\gallery', $gallery_id); 
            }
         // This would ideally be in a job, triggered by the user created event
          //Image::make($path)->resize(100,100)->save($path);
          /* $image = $request->file('image');
           $filename = time(). '.' .$image->getClientOriginalExtension();
           $this->uploadPhoto($image, $filename, 'App\gallery', $gallery_id); */
        }
        Alert::toast('Inserted Successfully', 'success');
        
        if(!$request->hasfile('image'))
        {
            return redirect('/admin/gallery');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gallery = Gallery::findOrFail($id);
        
        //$customers = Customer::get();
        $customers = Customer::whereHas('user',function($query){
            $query->whereHas('roles',function($roles){
                $roles->where('name', '=' ,'client');
            });
        })->get();
        $active_mn = 'gallery';
        $active_sub_mn = 'create_gallery';
        return view('admin.gallery.edit_gallery',compact('gallery','customers','active_mn','active_sub_mn'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $gallery = Gallery::findOrFail($id);
        $gallery->customer_id = $request->post('customer_id');
        $gallery->title = $request->post('title');
        $gallery->description = $request->post('description');
        $gallery->save();
        $gallery_id = $gallery->id;
        if($request->hasfile('image'))
        {
           $files = $request->file('image');
           foreach($files as $file){
           $name = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
           $image = $file;
           $filename = time(). '-'.$name.'.'.$file->getClientOriginalExtension();
           $this->uploadPhoto($image, $filename, 'App\gallery', $gallery_id);
           }
        }
        Alert::toast('Updated Successfully','success');
        if(!$request->hasfile('image'))
        {
            return redirect('/admin/gallery');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findorFail($id);
        foreach($gallery->image as $gly)
        {
            File::delete($gly->url);
        }
        $gallery->delete();
        $gallery->image()->delete();
        $selected = Image_selected::where('gallery_id','=',$gallery->id)->first();
        if ($selected != null) {
        $selected->delete();
        }
        Alert::toast('Deleted Successfully','success');
        return redirect('/admin/gallery'); 
    }
    public function destroy_image($id)
    {
        $gallery = Gallery::find($id);
        if($gallery->image)
        {
            $this->deletePhoto($gallery->image->id);
        }
    }
    public function ajax_gallery_view_more_image(Request $request)
    {
       $file_id=$request->post('file_id');
       $gallery = Gallery::findOrFail($file_id);
       if($gallery->image)
       {
        foreach($gallery->image as $gly)
         {
            $path ="/$gly->url";
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />';
            echo '<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>';
            echo "<li class='col-md-4'>
          <img src='$path' alt='{{ $gly->url }}'  class='img-responsive img-thumbnail control-image'>
          <a data-fancybox='gallery' class='img-popup' href='$path' title='fdgfg'><i class='fa fa-plus'></i></a>
          </li>"; 
                      
        }
      } 
    }
    public function ajax_gallery_selected_view_more_image(Request $request)
    {
       $image_selected_id=$request->post('image_selected_id');
       if(!empty($image_selected_id))
       {
       $gallery = Image_selected::findOrFail($image_selected_id);
       if($gallery->image)
       {
        $images = json_decode($gallery->image);
        //dd($images);
        foreach($images as $gly)
         {
            //dd($gly);
            $path ="/images/$gly";
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />';
            echo '<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>';
           echo "<li class='col-md-4'>
          <img src='$path' alt='{{ $gly }}' style='width: 100%;height: 155px; object-fit: cover;' class='img-responsive img-thumbnail'>
          <a data-fancybox='gallery' class='img-popup' href='$path' title='fdgfg'><i class='fa fa-plus'></i></a>
          </li>"; 
        }
      }
    } 
      else{
         
          echo "No photos selected";
      }
    }
    public function destroy_gallery_upload_image()
    {
        $im='images/'.$_POST['image'];
        $image = Image::where('url','=',$im)->first();
        File::delete($im);
        $image->delete(); 
    }
}
