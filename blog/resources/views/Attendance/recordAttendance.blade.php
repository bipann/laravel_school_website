@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="row">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="col-md-12">
      <form action="{{route('addrecordAttendance')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="col-md-8"><h1 style="text-align: center;">Record Attendance </h1></div>
            <div class="col-md-4"><input id="idFdate" type="date" name="date" class="form-control"  style="margin-top: 25px;" value="<?php echo date('Y-m-d'); ?>">

            </div> <br>

        <div>
            <table class="table table-hover">
                <tr>
                    <th>P.Picture</th>
                    <th>S.No.</th>
                    <th>Name</th>

                    <th>Attendance</th>

                </tr>

                @foreach($userData as $key=>$userDatum)
                    <tr>
                        <td>
                            <img src="{{url('lib/images/'.$userDatum->image)}}"
                                 alt="photo" height="100" width="170">
                        </td>
                        <td>{{++$key}}</td>
                        <td>

                            <input type="text" name="{{'name'.$userDatum->id}}" value="{{$userDatum->name}}"
                                   id="name" class="form-control"></td>

                        <td>
                            <select name="{{'attendance'.$userDatum->id}}" class="form-control" id="name">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </table>
            <button class="btn btn-success">Add record</button>
        </div>
        </form>
    </div>

</div>

    @stop
