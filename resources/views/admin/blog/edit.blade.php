@extends('admin.layouts.app')
@section("title", "Edit Blog")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit New Blog</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('admin.blogs.index')}}">Blog List</a>
        </li>
        <li class="breadcrumb-item active">Edit Blog</li>
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
            <h4 class="card-title">Edit Blog</h4>
        </div>
        <div class="card-body">
          <form action="{{route("admin.blogs.update", ["blog" => $blog->id])}}" method="post" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group row">
              <label for="title" class="col-sm-3 col-form-label text-right">Title*</label>
              <div class="col-sm-9">
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$blog->title}}" required/>
                @error('title')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- category --}}
            <div class="form-group row">
              <label for="categories" class="col-sm-3 col-form-label text-right">Category*</label>
              <div class="col-sm-9">
                <select 
                    name="categories[]" id="categories" 
                    multiple="multiple"
                    data-placeholder="Select a Category"
                    data-allowClear="true"
                    class="form-control select2 select2-primary"
                    required
                >
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach                                
                </select>
                @error('categories')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- image --}}
            <div class="form-group row">
              <label for="image" class="col-sm-3 col-form-label text-right">Image</label>
              <div class="col-sm-9">
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" />
                @error('image')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- shrot description --}}
            <div class="form-group row">
              <label for="short_description" class="col-sm-3 col-form-label text-right">Short Description*</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="short_description" id="short_description" 
                  class="form-control @error('short_description') is-invalid @enderror" value="{{$blog->short_description}}" required/>
                @error('short_description')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- description --}}
            <div class="form-group row">
              <label for="description" class="col-sm-3 col-form-label text-right">Description</label>
              <div class="col-sm-9">
                <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="10">{!!html_entity_decode($blog->description)!!}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>
            
            {{-- meta title --}}
            <div class="form-group row">
              <label for="meta_title" class="col-sm-3 col-form-label text-right">Meta Title</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="meta_title" id="meta_title" 
                  class="form-control @error('meta_title') is-invalid @enderror" value="{{$blog->meta_title}}"/>
                @error('meta_title')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- meta description --}}
            <div class="form-group row">
              <label for="meta_description" class="col-sm-3 col-form-label text-right">Meta Description</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="meta_description" id="meta_description" 
                  class="form-control @error('meta_description') is-invalid @enderror" value="{{$blog->meta_description}}"/>
                @error('meta_description')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- meta description --}}
            <div class="form-group row">
              <label for="meta_keyword" class="col-sm-3 col-form-label text-right">Meta Keyword</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="meta_keyword" id="meta_keyword" 
                  class="form-control @error('meta_keyword') is-invalid @enderror" value="{{$blog->meta_keyword}}"/>
                @error('meta_keyword')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- meta description --}}
            <div class="form-group row">
              <label for="img_alt_text" class="col-sm-3 col-form-label text-right">Image Alt Text</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="img_alt_text" id="img_alt_text" 
                  class="form-control @error('img_alt_text') is-invalid @enderror" value="{{$blog->img_alt_text}}"/>
                @error('img_alt_text')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- meta robots tags --}}
            <div class="form-group row">
              <label for="meta_robots_tags" class="col-sm-3 col-form-label text-right">Meta Robots Tags</label>
              <div class="col-sm-9">
                <input 
                  type="text" name="meta_robots_tags" id="meta_robots_tags" 
                  class="form-control @error('meta_robots_tags') is-invalid @enderror" value="{{$blog->meta_robots_tags}}"/>
                @error('meta_robots_tags')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            {{-- status --}}
            <div class="form-group row">
              <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
              <div class="col-sm-4">
                <select name="status" id="status" class="form-control">
                  <option value="" hidden>Select a Status</option>
                  <option value="1" @if($blog->status == 1) selected @endif>Draft</option>
                  <option value="2" @if($blog->status == 2) selected @endif>Publish</option>
                  <option value="0" @if($blog->status == 0) selected @endif>Unpublish</option>
                </select>
                @error('status')
                  <div class="invalid-feedback">{{$message }}</div>  
                @enderror
              </div>                                   
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label text-right">&nbsp;</label>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
              </div>                                   
            </div>

          </form>
        </div>
      </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push("js")
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(function() {
    $('.select2').select2({
      theme: 'bootstrap4',
    });

    $("#categories").val(@json($categories->pluck('id'))).trigger('change');

    // summer note init
    $('#description').summernote();
  });
</script>
@endpush