@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Detail Event</h1>
    <a class="label label-warning" href="{{URL::to('event')}}" >Back</a>
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
        <div class="form-group">
            <label for="title">Nama :</label>
            <input disabled type="text" class="form-control" value="{{$event->name}}"/>
        </div>
        <div class="form-group">
            <label for="title">Kategori :</label>
            <input disabled type="text" class="form-control" value="{{$event->category}}"/>
        </div>
        <div class="form-group">
            <label for="title">Tanggal Event :</label>
            <input disabled type="date" class="form-control"  value="{{$event->event_date}}"/>
        </div>
        <div class="form-group">
            <label for="title">Lokasi Event :</label>
            <select disabled class="form-control" name="location">
                @foreach($locations as $aKey => $location)
                    <option value="{{$location->id}}" @if($event->location_id == $location->id)selected="selected"@endif>{{$location->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Description :</label>
            <textarea disabled type="text" class="form-control"  >{{$event->description}}</textarea>
        </div>
        <label for="title">Tiket Event :</label>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped task-table">
                <thead>
                <th width="5%">Id</th>
                <th width="25%">Nama</th>
                <th width="40%">Tipe</th>
                <th width="20%">Jumlah Tiket</th>
                <th width="20%">Harga Tiket</th>
                <th width="20%">Deskripsi</th>
                </thead>
                <tbody>
                @foreach($event->tickets as $key => $ticket)
                    <tr>
                        <td class="table-text">
                            <div>{{$key+1}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$ticket->name}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$ticket->type}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$ticket->amount}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$ticket->price}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{$ticket->description}}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@stop

