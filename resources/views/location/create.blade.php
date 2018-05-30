@extends('adminlte::page')

@section('title', 'Loket')

@section('content_header')
    <h1>Create Location</h1>
    <a class="label label-warning" href="{{URL::to('location')}}" >Back</a>
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

    <form method="post" action="{{url('location/store')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Nama Lokasi :</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Alamat :</label>
            <input type="text" class="form-control" name="address"/>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@stop