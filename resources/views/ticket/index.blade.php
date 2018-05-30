@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Tiket</h1>
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

    <a class="label label-success" href="{{ URL::to('ticket/create') }}">Create</a>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped task-table">
                <thead>
                <th width="5%">Id</th>
                <th width="15%">Nama</th>
                <th width="15%">Jenis</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Harga</th>
                <th width="10%">Deskripsi</th>
                <th width="10%">Aksi</th>
                </thead>

                <tbody>
                @foreach($tickets as $key => $value)
                    <tr>
                        <td class="table-text">
                            <div>{{$key+1}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->name}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->type}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->amount}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->price}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$value->description}}</div>
                        </td>
                        <td>
                            <a class="label label-warning" href="{{ URL::to('ticket/' . $value->id . '/edit') }}">Edit</a>
                            <form id="delete-ticket-{{$value->id}}" method="post" action="{{url('/ticket/delete', $value->id)}}" >
                                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                                <input type="hidden" name="_method" value="delete" />
                                <a class="label label-danger" type="submit"
                                   onclick="document.getElementById('delete-ticket-{{$value->id}}').submit()">
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