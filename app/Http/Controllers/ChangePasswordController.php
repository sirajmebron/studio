<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Alert;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
  
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $active_mn = '';
        $active_sub_mn = '';
        $roles=Auth::user()->roles;
        foreach($roles as $role){
         if($role->name == 'admin'){
             $role_name = $role->name;
          }
          else
          {
            $role_name = $role->name;
          }
        }
        return view('changepassword',compact('active_mn','active_sub_mn','role_name'));
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        Alert::toast('Password Updated Successfully', 'success');
        $roles=Auth::user()->roles;
        foreach($roles as $role){
         if($role->name == 'admin'){
           return redirect('admin/dashboard');
          }
          else
          {
           return redirect('client/dashboard');
          }
        }

    }
}