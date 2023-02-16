<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@hasSection ('title')
    @yield('title')
  @else
    {{config('app.name')}}
  @endif</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="hold-transition">
<div class="container-fluid" style="background-color: #f4f6f9;"">
  <!-- Content Wrapper. Contains page content -->
    <div class="position-relative" style="height: 100vh;">
    {{-- main content area --}}
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="alert alert-success">@yield('message')</div> <br/>
            <a href="{{url("/")}}" class="btn btn-outline-success">Go to Home</a>&nbsp;
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
    </div>
</div>
</body>
</html>
