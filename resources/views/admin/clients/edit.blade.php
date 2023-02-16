@extends('admin.layouts.app')
@section("title", "Edit Client")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit Client</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('admin.clients.index')}}">Client List</a>
        </li>
        <li class="breadcrumb-item active">Edit Client</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Edit Client</h4>
        </div>
        <div class="card-body overflow-auto">
            <form action="{{route("admin.clients.update", ['client' => $user->id])}}" method="post">
                @csrf @method("PUT")
                {{-- name --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">Name*</label>
                    <div class="col-sm-9">
                    <input type="text" name="name" id="title" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" required/>
                    @error('name')
                        <div class="invalid-feedback">{{$message }}</div>  
                    @enderror
                    </div>                                   
                </div>
                {{-- email --}}
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">E-mail*</label>
                    <div class="col-sm-9">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" required/>
                    @error('email')
                        <div class="invalid-feedback">{{$message }}</div>  
                    @enderror
                    </div>                                   
                </div>

                {{-- company name --}}
                <div class="form-group row">
                    <label for="company_name" class="col-sm-3 col-form-label text-right">Company Name*</label>
                    <div class="col-sm-9">
                    <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{$user->company_name}}" required/>
                    @error('company_name')
                        <div class="invalid-feedback">{{$message }}</div>  
                    @enderror
                    </div>                                   
                </div>

                {{-- address name --}}
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                    <div class="col-sm-9">
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{$user->address}}" required/>
                    @error('address')
                        <div class="invalid-feedback">{{$message }}</div>  
                    @enderror
                    </div>                                   
                </div>

                {{-- company name --}}
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-right">Phone</label>
                    <div class="col-sm-9">
                    <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}" />
                    @error('phone')
                        <div class="invalid-feedback">{{$message }}</div>  
                    @enderror
                    </div>                                   
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-right">&nbsp;</label>
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


@push('js')
<script>
    $(document).ready(function() {

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