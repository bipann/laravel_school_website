<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0,
maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{url('lib/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="sidenav">
    <a href="{{route('home')}}">Home</a>
    <a href="{{route('register_admin')}}">The Controller</a>
    <a href="{{route('student_register')}}">Student Register</a>
    <a href="{{route('parent_register')}}">Guardian </a>

        <a href="{{route('attendanceHome')}}">Attendance
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
            style="margin-top: -43px; margin-left: 160px"></a>
        </a>
        <div class="dropdown-menu" style="margin-left: 20px;">
            <a class="dropdown-item" href="{{route('recordAttendance')}}" style="text-align: center; font-size: 15px;color: black ">Record Attendance</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('viewAttendance')}}" style="text-align: center; font-size: 15px; color: black">View Attendance</a>

        </div>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        Logout
    </a>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

    </div>
</div>

</body>
<style>
.sidenav{
height: 100%;
width: 210px;
position: fixed;
z-index: 1;
top: 0;
left: 0;
background-color: #111;
overflow-x: hidden;
padding-top: 20px;
text-align: center;

}

.sidenav a {
    padding: 6px 6px 6px ;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
    text-decoration: none;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>
</html>
