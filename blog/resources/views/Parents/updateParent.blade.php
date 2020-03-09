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


            <div class="col-md-6">
                <form action="{{route('updateParentRecord')}}" method="post" enctype="multipart/form-data">
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
                            <label for="email">Email:</label>
                            <input type="text" name="email"
                                   value="{{$userDatum->email}}"id="email" class="form-control">
                            <a href="" style="color: red;">{{$errors->first('email')}}</a>
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



            <div class="col-md-6">
                <table class="table table-hover">

                    @foreach($userData as $key=>$userDatum)
                        <tr>
                            <img src="{{url('lib/images/'.$userDatum->image)}}"
                                 alt="photo" height="400" width="660">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                        <tr>


                            <td>{{$userDatum->name}}</td>
                            <td>{{$userDatum->email}}</td>
                            <td>

                                <a href="{{route('deleteParent').'/'.$userDatum->id}}" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                            <td>{{$userDatum->created_at}}</td>
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>



@stop
