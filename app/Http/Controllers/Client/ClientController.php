<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;
use App\Gallery;
use App\Customer;
use App\Image;
use App\Image_selected;
//use App\Listing;
//use App\Member;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:client');
    }
    public function index()
    {
        //$data['board_count'] = Board::count();
        //$data['listing_count'] = Listing::count();
        //$data['members_count'] = Member::count();
        //return view('admin.dashboard', compact('data'));
        $active_mn = '';
        return view('client.dashboard',compact('active_mn'));
    }
    public function albums()
    {
        
        $active_mn = 'albums';
        $id = Auth::id();
        $customer = Customer::where('user_id','=',$id)->first();
        $gallery = Gallery::select('galleries.*','image_selecteds.id as image_selected_id','image_selecteds.image')
        ->leftJoin('image_selecteds', 'galleries.id', '=', 'image_selecteds.gallery_id')->orderBy('id', 'DESC')
        ->where('galleries.customer_id','=',$customer->id)->get();
        return view('client.albums',compact('gallery','active_mn'));
    }
    public function gallery($gallery_id)
    {
        //$data['board_count'] = Board::count();
        //$data['listing_count'] = Listing::count();
        //$data['members_count'] = Member::count();
        //return view('admin.dashboard', compact('data'));
        /* $id = Auth::id();
        $customer = Customer::where('user_id','=',$id)->first(); */
        //dd($customer->gallery->image);
        $gallery = Gallery::where('id','=',$gallery_id)->first();
        /* dd($gallery->id);
        $images = Image::where('imageable_id','=',$gallery->id)->get(); */
        if($gallery)
        {
            $images = Image::where('imageable_id','=',$gallery->id)->get();
        }
        else
        {
            $images = '';
        }
        
        //dd($images);
        $image_selected = Image_selected::where(array('gallery_id' => $gallery_id))->first();
        //dd($image_selected);
        $active_mn = 'gallery';
        return view('client.gallery',compact('images','image_selected','active_mn'));
    }

    public function store_selected_image(Request $request)
    {
        $images =  $request->post('images');
        //dd($images);
        
        $id = Auth::id();
        $customer = Customer::where('user_id','=',$id)->first();
        $customer_id =  $customer->id;
        $image_selected = Image_selected::firstOrNew(array('gallery_id' => $request->post('gallery_id')));
        
        //$image_selected = Image_selected::findOrFail($request->post('gallery_id'));
        //$gallery = Gallery::findOrFail($id);
        $image_selected->customer_id = $customer_id;
        $image_selected->gallery_id = $request->post('gallery_id');
        
        $image_selected->image = json_encode(str_replace('images/','',$request->post('images')));
        $image_selected->save();
        Alert::toast('Inserted Successfully', 'success');
        return redirect('client/gallery');

        
    }
}
