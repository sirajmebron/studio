@extends('layouts.admin')
@section('content')
<div class="card mb-3">
  <div class="card-header">
    <h2>Customer Form</h2>
  </div>
  <div class="card-body">
<form action="/customers/update/{{ $customers->id }}" method="POST">
    @csrf
    {{-- @method('PUT') --}}
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Name</label>
    <div class="col-8">
      <input id="text" name="name" type="text" class="form-control" required="required" value="{{ $customers->name }}" aria-describedby="textHelpBlock">
      <span id="textHelpBlock" class="form-text text-muted"></span>
    </div>
  </div>
  {{-- <div class="form-group row">
    <label for="business_type" class="col-4 col-form-label">Business Type</label>
    <div class="col-8">
      <select id="business_type" name="business_type" class="custom-select" required="required">
        <option value="proprietorship" {{ old('business_type',$customers->business_type)=='proprietorship'? 'selected':''}}>Proprietorship</option>
        <option value="partnership" {{ old('business_type',$customers->business_type)=='partnership'? 'selected':''}}>Partnership</option>
        <option value="company" {{ old('business_type',$customers->business_type)=='company'? 'selected':''}}>Company</option>
      </select>
    </div>
  </div> --}}
  <div class="form-group row">
    <label for="mobile" class="col-4 col-form-label">Mobile</label>
    <div class="col-8">
      <input id="mobile" name="mobile" placeholder="Mobile Number" value="{{ $customers->mobile }}" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="secondary_mobile" class="col-4 col-form-label">Secondary Mobile</label>
    <div class="col-8">
      <input id="secondary_mobile" name="secondary_mobile" placeholder="Secondary Mobile Number" value="{{ $customers->secondary_mobile }}" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-4 col-form-label">Email</label>
    <div class="col-8">
      <input id="email" name="email" placeholder="Email" value="{{ $customers->email }}" type="email" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="username" class="col-4 col-form-label">Username</label>
    <div class="col-8">
      <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" required="required" value="{{ $customers->user->username }}" >
      @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
      <span id="textHelpBlock" class="form-text text-muted"></span>
    </div>
  </div> 
  <div class="form-group row">
    <label for="password" class="col-4 col-form-label">Password</label>
    <div class="col-8">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $customers->user->password }}" required autocomplete="new-password">

      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="confirm_password" class="col-4 col-form-label">Confirm Password</label>
    <div class="col-8">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $customers->user->password }}" required autocomplete="new-password">
    </div>
  </div>
  <div class="form-group row">
    <label for="confirm_password" class="col-4 col-form-label">Role</label>

   <div class="col-md-8">
       <select class="form-control" name="role_id" required="required">
           <option value=""></option>
           @foreach($roles as $role)
           {{-- {{ old('business_type',$customers->business_type)=='proprietorship'? 'selected':''}} --}}
           <option value="{{ $role->id}}" {{ old('role_id',$customers->user->roles[0]->id)==$role->id ? 'selected':''}}>{{ $role->name}}</option>
           @endforeach
       </select>
   </div>
</div>
  <div class="form-group row">
    <label for="address" class="col-4 col-form-label">Address</label>
    <div class="col-8">
      <textarea id="address" name="address" cols="40" rows="5" class="form-control" required="required" aria-describedby="addressHelpBlock">{{ $customers->address }}</textarea>
      <span id="addressHelpBlock" class="form-text text-muted"></span>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</div>
@endsection
