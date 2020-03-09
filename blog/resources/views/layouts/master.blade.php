<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0,
maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <title>@yield('title',$title)</title>--}}
    <link rel="stylesheet" href="{{url('lib/bootstrap/css/bootstrap.css')}}">
</head>
<body>

<div class="container" style="margin-left: 280px">

    <div class="row">
        <div class="col-md-12">
            <h1><i class="glyphicon glyphicon-user"></i>Student Registration System</h1>
        </div>
    </div>
    <hr>
    @yield('container')
</div>


</body>
</html>
