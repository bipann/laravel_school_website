@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger">
                {{session('fail')}}
            </div>
        @endif
        <div class="col-md-12">
        <form action="{{route('searchAttendance')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-12">
                <table class="table table-hover">
                    <tr>
                        <th >Student Name</th>
                        <th >Start Date</th>
                        <th >End Date</th>
                        <th></th>
                    </tr>

                    <input type="hidden" id="absentValue" class="form-control" name="search_name"  value="{{$absentLength}}" >
                    <tr>
                        <td><input type="text" class="form-control" name="search_name" placeholder="Search Students" ></td>
                        <td><input type="date" name="start_date" class="form-control" ></td>
                        <td><input type="date" name="end_date" class="form-control" ></td>
                        <td><button type="submit" class="btn btn-default" id="clickbait"><span class="glyphicon glyphicon-search"></span></button></td>
                    </tr>

                    <style>
                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 1;
                            padding-top: 100px;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgb(0,0,0);
                            background-color: rgba(0,0,0,0.4);
                        }

                        .modal-content {
                            background-color: #fefefe;
                            margin: auto;
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%;
                            text-align: center;
                            color: red;
                            font-size: 20px;
                            font-weight: bold;
                        }
                        .close {
                            color: #aaaaaa;
                            float: right;
                            font-size: 28px;
                            font-weight: bold;
                            text-align: right;
                        }
                        .close:hover,
                        .close:focus {
                            color: #000;
                            text-decoration: none;
                            cursor: pointer;
                        }
                    </style>






                    <div id="myModal" class="modal">

                        <div class="modal-content">
                            <span class="close" id="close">&times;</span>
                            <p id="parentID"></p>
                        </div>

                    </div>

                    <script>
                        let button = document.getElementById('absentValue').value;
                        let modal = "";
                        let close = "";
                        if(button != 0)
                        {
                            document.getElementById("parentID").innerHTML+= 'The Student has been absent for ' +button +" days."
                            //alert('The Student has been absent for ' +button +" days.");

                            modal = document.getElementById("myModal");
                            close = document.getElementById("close");
                            modal.style.display = "block";
                            window.onclick = function(event) {
                                if (event.target === modal) {
                                    modal.style.display = "none";
                                }
                                if(event.target === close){
                                    modal.style.display = "none";
                                }
                            }
                        }else{
                            modal.style.display = "none";
                        }
                    </script>


                </table>
                <br>
            </div>

        </form>
        </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <tr>

                        <th>S.No.</th>
                        <th>Name</th>

                        <th>Attendance</th>
                        <th>Date</th>

                    </tr>

                    @foreach($userData as $key=>$userDatum)
                        <tr>

                            <td>{{++$key}}</td>
                            <td>{{$userDatum->name}}</td>

                            <td>{{$userDatum->attendance}}</td>
                            <td>{{$userDatum->date}}</td>
                        </tr>
                    @endforeach
                </table>

            </div>





    </div>
@stop

