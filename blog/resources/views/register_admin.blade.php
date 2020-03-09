@extends('layouts.master')
@include ('layouts.navContainer')
@section('container')
    <h1>Register Admin</h1><br>
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

        <div class="col-md-11">
            <form action="" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="search_name"
                           placeholder="Search Controllers"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
                    </span>
                </div>
            </form><br>
        </div>


        <div class="col-md-1">
            <form action="{{route('register_admin')}}" method="POST" role="search">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default" href="{{route('register_admin')}}">show all</button>
            </form>
        </div><br><br>
    </div>



        <div class="row">

            <div class="col-md-4">
                <form action="{{route('addAdmin')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="{{old('name')}}"
                               id="name" class="form-control">
                        <a href="" style="color: red;">{{$errors->first('name')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email"
                               value="{{old('email')}}"id="email" class="form-control">
                        <a href="" style="color: red;">{{$errors->first('email')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="Contact_no">Contact_no:</label>
                        <input type="text" name="Contact_no"
                               value="{{old('Contact_no')}}" id="Contact_no" class="form-control">
                        <a href="" style="color: red;">{{$errors->first('Contact_no')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="Address">Address:</label>
                        <input type="text" name="Address"
                               value="{{old('Address')}}" id="Address" class="form-control">
                        <a href="" style="color: red;">{{$errors->first('Address')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="profilepicture">Profile Picture: </label>
                        <input type="file" name="profilepicture" id="image" class="btn btn-default">
                        <a href="" style="color: red;">{{$errors->first('profilepicture')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password"
                               class="form-control">
                        <a href="" style="color: red;">{{$errors->first('password')}}</a>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password:</label>
                        <input type="password" name="password_confirmation"
                               id="cpassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" class="form-control" id="role">
                            <option value="role">--select an option--</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>

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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>

                    </tr>

                    @foreach($userData as $key=>$userDatum)
                            @if($userDatum->role=='superadmin')
                        <tr>
                            <td>
                                <img src="{{url('lib/images/'.$userDatum->image)}}"
                                     alt="photo" height="100" width="170">
                            </td>
                            <td>{{++$key}}</td>
                            <td>{{$userDatum->name}}</td>
                            <td>{{$userDatum->email}}</td>
                            <td>{{$userDatum->role}}</td>
                            <td>
                                @if(Auth::user()->id==$userDatum->id)
                                <a href="{{route('updateAdmin').'/'.$userDatum->id}}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('deleteAdmin').'/'.$userDatum->id}}" class="btn btn-danger btn-xs">Delete</a>
                                    @endif
                            </td>

                        </tr>
                            @endif
                    @endforeach

                </table>
            </div>


        </div>
    </div>

    @stop
