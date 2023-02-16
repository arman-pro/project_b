@extends('admin.layouts.app')
@section("title", "Create Admin")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Create Admin</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route("admin.index")}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route("admin.users.index")}}">Admin List</a>
        </li>
        <li class="breadcrumb-item active">Create Admin</li>
      </ol>
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-12">
     <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-warning">Back</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Admin User Create</h4>
        </div>
        <div class="card-body">
            <form action="{{route("admin.users.store")}}" method="post">
                @csrf 
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">Name*</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required/>
                      @error('name')
                        <div class="invalid-feedback">{{$message }}</div>  
                      @enderror
                    </div>                                   
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">E-mail*</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required/>
                      @error('email')
                        <div class="invalid-feedback">{{$message }}</div>  
                      @enderror
                    </div>                                   
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label text-right">Password*</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required/>
                      @error('password')
                        <div class="invalid-feedback">{{$message }}</div>  
                      @enderror
                    </div>                                   
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label text-right">Confirm Password*</label>
                    <div class="col-sm-9">
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required/>
                      @error('password_confirmation')
                        <div class="invalid-feedback">{{$message }}</div>  
                      @enderror
                    </div>                                   
                </div>

                <div class="form-group row">
                    <label for="role" class="col-sm-3 col-form-label text-right">Role*</label>
                    <div class="col-sm-5">
                      <select name="role" id="role" class="form-control" required>
                        <option value="" hidden>Select a Role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                    </div>                                   
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-3 col-form-label text-right">&nbsp;</label>
                    <div class="col-sm-9">
                        <button class="btn btn-sm btn-success" type="submit">Save</button>
                    </div>                                   
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#user_lists').dataTable({
            columnDefs: [
                {targets: -1, orderable: false, searchable: false}
            ],
        });

        $(document).on('click', '.delete_btn', function(){
            let link = $(this).data('link');
            Swal.fire({
                title: 'Are you sure to delete?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete It!'
            }).then((result) => {
                if(result.isConfirmed) {
                    $("#delete_form").attr('action', link);
                    $('#delete_form').submit();
                }else {
                    return;
                }
            });
        })
    });
</script>
@endpush