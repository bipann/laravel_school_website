@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')


    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif




        <div class="row">


            <div class="col-md-5">
                <form action="{{route('updateRecord')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @foreach($userData as $key=>$userDatum)
                    <input type="hidden" name="userid" value="{{$userDatum->id}}">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="{{$userDatum->name}}"
                               id="name" class="form-control">
                        <a href="" style="color: red;">{{$errors->first('name')}}</a>
                    </div>
                    <div class="form-group">
                            <label for="DOB">DOB:</label>
                            <input type="text" name="DOB"
                                   value="{{$userDatum->DOB}}" id="DOB" class="form-control">
                            <a href="" style="color: red;">{{$errors->first('DOB')}}</a>
                        </div>
                        <div class="form-group">
                            <label for="Guardian">Guardian:</label>
                            <input type="text" name="Guardian"
                                   value="{{$userDatum->Guardian}}" id="Guardian" class="form-control">
                            <a href="" style="color: red;">{{$errors->first('Guardian')}}</a>
                        </div>

                        <div class="form-group">
                            <label for="Contact_no">Contact_no:</label>
                            <input type="text" name="Contact_no"
                                   value="{{$userDatum->Contact_no}}" id="Contact_no" class="form-control">
                            <a href="" style="color: red;">{{$errors->first('Contact_no')}}</a>
                        </div>

                        <div class="form-group">
                            <label for="gender">gender:</label>
                            <input type="text" name="gender"
                                   value="{{$userDatum->gender}}"id="gender" class="form-control">
                            <a href="" style="color: red;">{{$errors->first('gender')}}</a>
                        </div>

                    <div class="form-group">
                        <label for="profilepicture">Profile Picture: </label>
                        <input type="file" name="profilepicture" id="image" class="btn btn-default">
                        <a href="" style="color: red;">{{$errors->first('profilepicture')}}</a>
                    </div>

                    <div>
                        <button class="btn btn-primary">Update Record</button>
                    </div>
                    @endforeach
                </form>
            </div>



            <div class="col-md-7">
                <table class="table table-hover">

                    @foreach($userData as $key=>$userDatum)
                        <tr>
                            <img src="{{url('lib/images/'.$userDatum->image)}}"
                                 alt="photo" height="400" width="660">
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Guardian</th>
                            <th>Contact no</th>
                            <th>Gender</th>
{{--                            <th>Action</th>--}}
                            <th>Created At</th>
                        </tr>
                        <tr>


                            <td >{{$userDatum->name}}</td>
                            <td>{{$userDatum->DOB}}</td>
                            <td>{{$userDatum->Guardian}}</td>
                            <td>{{$userDatum->Contact_no}}</td>
                            <td>{{$userDatum->gender}}</td>
{{--                            <td>--}}

{{--                                <a href="{{route('delete').'/'.$userDatum->id}}" class="btn btn-danger btn-xs">Delete</a>--}}
{{--                            </td>--}}
                            <td>{{$userDatum->created_at}}</td>
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>



@stop
