@extends('clients.layouts.app')
@section("title", "User Profile")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">User Profile</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route("dashboard.index")}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">User Profile</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <form action="{{route('dashboard.profile.update')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body">
                    <div class="form-col">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label text-right">Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" required/>
                              @error('name')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-right">E-mail</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" required/>
                              @error('email')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label text-right">Company Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{$user->company_name}}" required/>
                              @error('company_name')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label text-right">Phone/WhatsApp</label>
                            <div class="col-sm-9">
                              <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}" required/>
                              @error('phone')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                            <div class="col-sm-9">
                              <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{$user->address}}" required/>
                              @error('address')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label text-right">Password</label>
                            <div class="col-sm-9">
                              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"/>
                              @error('password')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label text-right">Confirm Password</label>
                            <div class="col-sm-9">
                              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                              @error('password_confirmation')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right">&nbsp;</label>
                            <div class="col-sm-9">
                                <button class="btn btn-sm btn-primary" type="submit">Save</button>
                            </div>                                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection