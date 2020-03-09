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

        #admin{display: block;}
        #admin h1{margin-top: 100px;}
        #student h1{margin-top: 100px;}
    </style>
    <div class="row">
        <a href="{{route('recordAttendance')}}" style="text-decoration: none"><div class="division" id="admin"><h1>Record Attendance</h1></div></a>
        <a href="{{route('viewAttendance')}}" style="text-decoration: none"><div class="division" id="student"><h1>View Attendance</h1></div></a>
    </div>


@stop