@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')


    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif


        <div class="col-md-11">
            <form action="{{route('search')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="search_name"
                           placeholder="Search Students"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
                    </span>
                </div>
            </form><br>
        </div>


            <div class="col-md-1">
                <form action="{{route('student_register')}}" method="POST" role="search">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default" >show all</button>
                </form>
            </div>
            <br>
    </div>

    <div class="row">
        <form action=""></form>

        <div class="col-md-4">
            <form action="{{route('add')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="profilepicture">Profile Picture: </label>
                    <input type="file" name="profilepicture" id="image" class="btn btn-default">
                    <a href="" style="color: red;">{{$errors->first('profilepicture')}}</a>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{old('name')}}"
                           id="name" class="form-control">
                    <a href="" style="color: red;">{{$errors->first('name')}}</a>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="email">Email:</label>--}}
{{--                    <input type="text" name="email"--}}
{{--                           value="{{old('email')}}"id="email" class="form-control">--}}
{{--                    <a href="" style="color: red;">{{$errors->first('email')}}</a>--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="password">Password:</label>--}}
{{--                    <input type="password" name="password" id="password"--}}
{{--                           class="form-control">--}}
{{--                    <a href="" style="color: red;">{{$errors->first('password')}}</a>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="cpassword">Confirm Password:</label>--}}
{{--                    <input type="password" name="password_confirmation"--}}
{{--                           id="cpassword" class="form-control">--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="DOB">DOB (AD):</label>
                    <input type="date" name="DOB" value="{{old('DOB')}}"
                           id="name" class="form-control">
                    <a href="" style="color: red;">{{$errors->first('DOB')}}</a>
                </div>

                <div class="form-group">
                    <label for="guardian">Select Guardian</label>
                    <select name="guardian" class="form-control" id="guardian">
                        <option value="" disabled selected>--select guardian--</option>
                        @foreach ($guardians as $guardian)
                            @if($guardian->role=='parent')

                        <option value="{{$guardian->id}}">{{$guardian->name}}</option>
                            @endif

                        @endforeach

                    </select>

                </div>

                <div class="form-group">
                    <label for="Guardian Contact_no">Guardian Contact_no:</label>
                    <input type="text" name="Contact_no" value="{{old('Guardian Contact_no')}}"
                           id="name" class="form-control">
                    <a href="" style="color: red;">{{$errors->first('Contact_no')}}</a>
                </div>

                <div class="form-group">
                    <label for="Address">Gender:</label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="Gender">--select an option--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-primary">Add Record</button>
                </div>
            </form>
        </div>



        <div class="col-md-8">
            <table class="table table-hover">
                <tr>
                    <th>P.Picture</th>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Guardian Name</th>
                    <th>Action</th>
                    <th>Created At</th>
                </tr>
                @foreach($userData as $key=>$userDatum)
                    <tr>
                        <td>
                            <img src="{{url('lib/images/'.$userDatum->image)}}"
                                 alt="photo" height="100" width="170">
                        </td>
                        <td>{{++$key}}</td>
                        <td>{{$userDatum->name}}</td>
                        <td>{{$userDatum->parent['name']}}</td>

                        <td>
                            <a href="{{route('updateUser').'/'.$userDatum->id}}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="{{route('delete').'/'.$userDatum->id}}" class="btn btn-danger btn-xs">Delete</a>
                        </td>
                        <td>{{$userDatum->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>


@stop
