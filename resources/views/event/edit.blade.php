@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Event</h1>
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

    <form method="post" action="{{url('event/update',$event->id)}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Nama :</label>
            <input type="text" class="form-control" name="name" value="{{$event->name}}"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Kategori :</label>
            <input type="text" class="form-control" name="category" value="{{$event->category}}"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Tanggal Event :</label>
            <input type="date" class="form-control" name="event_date" value="{{$event->event_date}}"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Lokasi Event :</label>
            <select class="form-control" name="location">
                @foreach($locations as $aKey => $location)
                    <option value="{{$location->id}}" @if($event->location_id == $location->id)selected="selected"@endif>{{$location->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Tiket Event (Hold down the Ctrl (windows) / Command (Mac) button to select multiple options) :</label>
            <select class="form-control" multiple="multiple" name="ticket[]" multiple size="{{ $locations->count() }}" required>
            @foreach($event->tickets as $selectedTicket)
                {{--<p>{{$selectedTicket->name}}}</p>--}}
                @foreach($tickets as $key => $ticket)
                    <option value="{{$ticket->id}}" @if($selectedTicket->id == $ticket->id)selected="selected"@endif >
                        {{$ticket->name}}
                    </option>
                @endforeach
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Description :</label>
            <textarea type="text" class="form-control" name="description" >{{$event->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@stop

