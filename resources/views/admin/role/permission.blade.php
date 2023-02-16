@extends('admin.layouts.app')
@section("title", "Assign Permission")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Assign Permission</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Assign Permission</li>
      </ol>
    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Assign Permission ({{ucfirst($role->name)}})</h4>
        </div>
        <div class="card-body">
            <form action="{{route("admin.permission_store", ['role' => $role->id])}}" method="post">
                @csrf
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Module</th>
                        <th>All</th>
                        <th>Read</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permission_list as $item)
                    <tr class="text-center">
                        <td>
                            {{ucfirst($item)}}
                        </td>
                        <td>
                            <input 
                                type="checkbox" 
                                id="{{$item . '-checked'}}"
                                data-item="{{$item}}"
                                data-toggle="toggle" data-size="small"
                                data-onstyle="success"                                               
                                data-offstyle="warning"   
                                @if(in_array(
                                    $item.'-index', $permissions) && 
                                    in_array($item.'-create', $permissions) && 
                                    in_array($item.'-update', $permissions) && 
                                    in_array($item.'-destroy', $permissions)
                                ) 
                                    checked 
                                @endif
                                data-width="60px"
                            />
                        </td>
                        <td>
                            <input 
                                type="checkbox" 
                                name="{{'permission['.$item.'][]'}}" 
                                value="{{$item.'-index'}}" 
                                id="{{$item.'-index'}}" 
                                data-toggle="toggle" data-size="small"
                                data-onstyle="success"                                               
                                data-offstyle="warning"   
                                @if(in_array($item.'-index', $permissions)) checked @endif
                                data-width="60px"
                            />
                            
                        </td>
                        <td>
                            <input 
                                type="checkbox" 
                                name="{{'permission['.$item.'][]'}}" 
                                value="{{$item.'-create'}}" 
                                id="{{$item.'-create'}}" 
                                data-toggle="toggle" data-size="small"
                                data-onstyle="success"   
                                data-offstyle="warning"   
                                @if(in_array($item.'-create', $permissions)) checked @endif
                                data-width="60px"
                            />
                        </td>
                        <td>
                            <input 
                                type="checkbox" 
                                name="{{'permission['.$item.'][]'}}" 
                                value="{{$item.'-update'}}" 
                                id="{{$item.'-update'}}" 
                                data-toggle="toggle" data-size="small"
                                data-onstyle="success"   
                                data-offstyle="warning"   
                                @if(in_array($item.'-update', $permissions)) checked @endif
                                data-width="60px"
                            />
                        </td>
                        <td>
                            <input 
                                type="checkbox" 
                                name="{{'permission['.$item.'][]'}}" 
                                value="{{$item.'-destroy'}}" 
                                id="{{$item.'-destroy'}}" 
                                data-toggle="toggle" data-size="small"
                                data-onstyle="success"   
                                data-offstyle="warning" 
                                @if(in_array($item.'-destroy', $permissions)) checked @endif  
                                data-width="60px"
                            />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Save</button>    
            </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
{{-- page extra css cdn --}}
@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
@endpush

{{-- page extra js cdn --}}
@push('js')
    <!-- Bootstrap Switch -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush

@push('js')
<script>
    $(document).ready(function(){
        var roles = <?php echo json_encode($permission_list); ?>;
        roles.forEach(function(role){
            $('#'+role+'-checked').on('change', function(){
                var list = ['index', 'create', 'update', 'destroy'];
                if($(this).is(':checked')) {
                    list.forEach(function(item) {
                        if(!$('#'+role+'-'+item).is(':checked')) {
                            $('#'+role+'-'+item).bootstrapToggle('on');
                        }
                    });
                }else {
                    list.forEach(function(item) {
                        if($('#'+role+'-'+item).is(':checked')) {
                            $('#'+role+'-'+item).bootstrapToggle('off');
                        }
                    });
                }
            })
        });
    });
</script>
@endpush