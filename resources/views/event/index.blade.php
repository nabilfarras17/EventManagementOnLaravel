@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Event</h1>
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

    <a class="label label-success" href="{{ URL::to('event/create') }}">Create</a>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped task-table">
                <thead>
                <th width="5%">Id</th>
                <th width="15%">Nama</th>
                <th width="15%">Category</th>
                <th width="10%">Tanggal Event</th>
                <th width="10%">Lokasi</th>
                <th width="10%">Deskripsi</th>
                <th width="10%">Aksi</th>
                <th width="10%">Post Twitter</th>
                </thead>

                <tbody>
                @foreach($events as $key => $value)
                    <tr>
                        <td class="table-text">
                            <div>{{$key+1}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->name}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->category}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->event_date}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->getLocation->name}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->description}}</div>
                        </td>
                        <td>
                            <a class="label label-warning" href="{{ URL::to('event/show', $value->id) }}">Show</a>
                            <a class="label label-warning" href="{{ URL::to('event/' . $value->id . '/edit') }}">Edit</a>

                            <form id="delete-event-{{$value->id}}" method="post" action="{{url('/event/delete', $value->id)}}" >
                                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                                <input type="hidden" name="_method" value="delete" />
                                <a class="label label-danger" type="submit"
                                   onclick="document.getElementById('delete-event-{{$value->id}}').submit()">
                                    Delete
                                </a>
                            </form>
                        </td>
                        <td>
                            <a class="label label-warning" href="{{ URL::to('event/post-twitter', $value->id) }}">Post Twitter</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
