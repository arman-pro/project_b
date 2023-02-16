@extends('admin.layouts.app')
@section("title", "Category List")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Category List</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Category List</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-sm-12">
      <div class="card">
        <div class="card-header bg-success">
          <h4 class="card-title">Category List</h4>
        </div>
        <div class="card-body">
          <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($categories->isNotEmpty())
                @foreach($categories as $category)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->slug}}</td>
                  <td>
                    @if($category->is_active)  
                      <span class="badge badge-success">Active</span>
                    @else 
                    <span class="badge badge-danger">Deactive</span>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group dropstart">
                      <button type="button" class="btn btn-success btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          Action <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                          <a 
                            class="dropdown-item edit_btn" 
                            data-link="{{route('admin.category.update', ['category' => $category->id])}}" 
                            data-name="{{$category->name}}"
                            data-is_active="{{$category->is_active}}"
                            href="javascript:void(0)">Edit</a>
                          <a 
                            class="dropdown-item delete_btn"
                            data-link="{{route("admin.category.destroy", ['category' => $category->id])}}" 
                            href="javascript:void(0)">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12">
      <div class="card">
        <div class="card-header bg-success">
          <h4 class="card-title">Add Category</h4>
        </div>
        <div class="card-body">
          <form action="{{route('admin.category.store')}}" method="post">
            @csrf 
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required />
              @error('name')<p class="p-0">{{$message}}</p>@enderror
            </div>
            <div class="form-group">
              <label for="status">Active Status</label>
              <select name="is_active" id="status" class="form-control @error('is_active') is-invalid @enderror">
                <option value="" hidden>Select Active Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              @error('is_active')<p class="p-0">{{$message}}</p>@enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="edit_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="update_form" method="post">
              @csrf @method('PUT')
              <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="status">Active Status</label>
                <select name="is_active" id="status" class="form-control">
                  <option value="" hidden>Select Active Status</option>
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- delete form --}}
    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>

</div>
@endsection


@push("js")
<script>
  $(document).ready(function() {
    $(document).on('click', ".edit_btn", function(){      
      let update_link = $(this).data('link');
      let category_name = $(this).data('name');
      let is_active = $(this).data('is_active');
      $('#edit_modal').modal('show');
      $('#update_form').attr('action', update_link);
      $('#update_form input[name="name"]').val(category_name);
      $('#update_form select[name="is_active"] option[value="'+is_active+'"]').prop('selected', true).trigger('change');
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