@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')

    <style>
        .division {color: black;text-align:center;border-style: solid;
            border-width: 1px;
            height: 280px;background-color: white;display: block;width: 500px;
            margin-bottom: 20px; margin-left: 45px; text-decoration: none;position: relative;}
        a :hover{
            transform: scale(1.080);
            z-index: 1;
        }
        #admin h1{margin-top: 100px;}
        #student h1{margin-top: 100px;}
        #attendance h1{margin-top: 100px;}
        #parent h1{margin-top: 100px;}
    </style>
    <div class="row">
        <a href="{{route('register_admin')}}" style="text-decoration: none"><div class="division" id="admin"><h1>The Controllers</h1></div></a>
        <a href="{{route('student_register')}}" style="text-decoration: none"><div class="division" id="student"><h1>Student register</h1></div></a>
        <br>
        <a href="{{route('attendanceHome')}}" style="text-decoration: none"><div class="division" id="attendance"><h1>Attendance</h1></div></a>
        <a href="{{route('parent_register')}}" style="text-decoration: none"><div class="division" id="parent"><h1>Guardian</h1></div></a>

    </div>

@stop
