@include ('layouts.NavContainerParent')
<link rel="stylesheet" href="{{url('lib/bootstrap/css/bootstrap.css')}}">
<div class="container">

    <br>
    <div style="text-align: center">
<h1>Welcome {{Auth::user()->name}}</h1><br> Your Child's Profile</div><br>

    <div class="col-md-12">
        <table class="table table-hover" style="margin-left: 5%">

            @foreach(Auth::user()->childrens as $children)
                <tr style="margin-left: 25%">
                    <img src="{{url('lib/images/'.$children->image)}}"
                         alt="photo" height="400" width="660" style="margin-left: 18%">
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Guardian</th>
                    <th>Contact no</th>
                    <th>Gender</th>
                    {{--                            <th>Action</th>--}}
                    <th>Created At</th>
                </tr>
                <tr style="margin-left: 25%">


                    <td >{{$children->name}}</td>
                    <td>{{$children->DOB}}</td>
                    <td>{{$children->Guardian}}</td>
                    <td>{{$children->Contact_no}}</td>
                    <td>{{$children->gender}}</td>
                    {{--                            <td>--}}

                    {{--                                <a href="{{route('delete').'/'.$userDatum->id}}" class="btn btn-danger btn-xs">Delete</a>--}}
                    {{--                            </td>--}}
                    <td>{{$children->created_at}}</td>
                </tr>
            @endforeach

        </table>
    </div>



</div>
