@extends('admin.layouts.app')
@section("title", "User Profile")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">User Profile</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route("admin.index")}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">User Profile</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <form action="{{route('admin.users.update', ['user' => $admin->id])}}" method="post">
            @csrf @method('PUT')
            <input type="hidden" name="role" value="{{$admin->roles->first()->id}}" />
            <input type="hidden" name="redirect" value="1" />
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body">
                    <div class="form-col">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label text-right">Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$admin->name}}" required/>
                              @error('name')
                                <div class="invalid-feedback">{{$message }}</div>  
                              @enderror
                            </div>                                                
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-right">E-mail</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$admin->email}}" required/>
                              @error('email')
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