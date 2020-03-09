@extends('layouts.master')
@section('container')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-danger">
                {{session('success')}}
            </div>

        @endif
        <div class="col-md-6">
            <form action="{{route('parentLogme')}}" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                <h1>login</h1>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email"
                           value="{{old('email')}}"id="email" class="form-control">
                    <a href="" style="color: red;">{{$errors->first('email')}}</a>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password"
                           class="form-control">
                    <a href="" style="color: red;">{{$errors->first('password')}}</a>
                </div>

                <div>
                    <button class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>


    </div>

@stop
