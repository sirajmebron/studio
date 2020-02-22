<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class CustomerController extends Controller
{
    //
    use RegistersUsers;
    public function index()
    {
        $customers = Customer::whereHas('user', function ($query) {
            $query->whereHas('roles',function($roles){
                $roles->where('name', '=' , 'client');
            });
        })->get();
        //dd($customers);
        /* foreach($customers as $customer)
        {
            dd($customer->user->roles);
        } */
        $active_mn='customers';
        $active_sub_mn='view_customer';
        return view('admin.customers.customer', compact('customers','active_mn','active_sub_mn'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $active_mn='customers';
        $active_sub_mn='create_customer';
        return view('admin.customers.create',compact('roles','active_mn','active_sub_mn'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);
        $role = Role::find($request->input('role_id'));
        $user->roles()->attach($role);
        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->user_id = $user->id;
        $customer->mobile = $request->input('mobile');
        $customer->secondary_mobile = $request->input('secondary_mobile');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->save(); 
        Alert::toast('Registered Successfully', 'success');
        return redirect('/customers');
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
         $customers = Customer::findOrFail($id);
         $roles = Role::get();
         $active_mn='customers';
         $active_sub_mn='edit_customer';
         return view('admin.customers.edit', compact('customers','roles','active_mn','active_sub_mn'));
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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
        $customer = Customer::findOrFail($id);
        $user = User::where('id','=',$customer->user_id)->first();
        $user->username = $request->input('username');
        $user->username = $request->input('username');
        $user->save();
        $updating_role_id = User::find($customer->user_id)->roles()->sync([$request->role_id]);
        // or
        /*$user->roles()->updateExistingPivot($user->role_id,array('role_id' => $request->input('role_id'))); */
        //dd($user->roles[0]->id);
        $customer->name = $request->input('name');
        $customer->mobile = $request->input('mobile');
        $customer->secondary_mobile = $request->input('secondary_mobile');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->user->username = $request->input('username');
        $customer->save();
        Alert::toast('Updated Successfully', 'success');
        return redirect('/customers'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $customers = Customer::findOrFail($id);
            $customers->delete();
            $user = User::where('name','=',$customers->user_id)->first();
            $user->delete();
            DB::commit();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }   */
     public function destroy($id)
    {
        //
        DB::beginTransaction();
        try {
        $customers = Customer::findOrFail($id);
        //dd($customers->image_selected);
        /* foreach($customers->gallery as $ly)
        {
            dd($ly->image);
            //dd($ly->image_selected);
        } */
        $customers->delete();
        $user = User::where('id','=',$customers->user_id)->first();
        $user->delete();
        $user->roles()->detach();
        foreach($customers->gallery as $gly)
        {
            $gly->image()->delete();
            File::delete($gly->url);
           
        }
        $customers->gallery()->delete(); 
        $customers->image_selected()->delete(); 
        Alert::toast('Deleted Successfully', 'success');
        return redirect('/customers');
        }
        catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            throw $e;
        }
    } 
}
