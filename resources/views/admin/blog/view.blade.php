@extends('admin.layouts.app')
@section("title", "View Blog Details")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Blog Details</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('admin.blogs.index')}}">Blog List</a>
        </li>
        <li class="breadcrumb-item active">Blog Details</li>
      </ol>
    </div>
</div>

<div class="row mb-2">
    <div class="col-sm-12">
        <a href="{{route("admin.blogs.index")}}" class="btn btn-sm btn-success">Back</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Blog Details</h4>
        </div>
        <div class="card-body">
          @if($blog->image)
            <img src="{{asset("storage/blogs/".$blog->image)}}" class="img-thumbnail" alt="Responsive image"/>            
          @endif
          <table class="table table-sm">
            <tbody>
              <tr>
                <th style="width:180px;">Title</th>
                <td>{{$blog->title}}</td>
              </tr>
              <tr>
                <th>Author</th>
                <td>{{$blog->user->name}}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  @if($blog->status == 0)
                    <span class="badge badge-danger">Unpublish</span>
                  @elseif($blog->status == 1) 
                    <span class="badge badge-info">Draft</span>
                  @else
                    <span class="badge badge-success">Publish</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Date</th>
                <td>{{date("d/m/y", strtotime($blog->created_at))}}</td>
              </tr>
              <tr>
                <th>Slug</th>
                <td>{{$blog->slug}}</td>
              </tr>
              <tr>
                <th>Categories</th>
                <td>
                  @foreach($blog->categories as $category)  
                    <span class="badge badge-primary">{{$category->category->name}}</span>
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Short Description</th>
                <td>{{$blog->short_description}}</td>
              </tr>
              <tr>
                <th>Description</th>
                <td>{!! html_entity_decode($blog->description) !!}</td>
              </tr>
              <tr>
                <th>Meta Title</th>
                <td>{{$blog->meta_title ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Meta Description</th>
                <td>{{$blog->meta_description ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Meta Keyword</th>
                <td>{{$blog->meta_keyword ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Img Alt Text</th>
                <td>{{$blog->img_alt_text ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Meta Robots Tags</th>
                <td>{{$blog->meta_robots_tags ?? "N/A"}}</td>
              </tr>
            </tbody>
          </table>
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
        $('#blog_list').dataTable({
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