@extends('adminlte::page')

@section('title', 'Loket')

@section('content_header')
    <h1>Lokasi</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="label label-success" href="{{ URL::to('location/create') }}">Create</a>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th width="5%">Id</th>
                <th width="25%">Nama</th>
                <th width="40%">Alamat</th>
                <th width="20%">Aksi</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach($locations as $key => $value)
                <tr>
                    <td class="table-text">
                        <div>{{$key+1}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$value->name}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$value->address}}</div>
                    </td>
                    <td>
                        {{--<a class="label label-success">Details</a>--}}
                        <a class="label label-warning" href="{{ URL::to('location/' . $value->id . '/edit') }}">Edit</a>
                        {{--<a class="label label-danger" onclick=" return confirm('Are you sure to delete?')">Delete</a>--}}
                        <form id="delete-location-{{$value->id}}" method="post" action="{{url('/location/delete', $value->id)}}" >
                            <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <input type="hidden" name="_method" value="delete" />
                            <a class="label label-danger" type="submit"
                               onclick="document.getElementById('delete-location-{{$value->id}}').submit()">
                                Delete
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop