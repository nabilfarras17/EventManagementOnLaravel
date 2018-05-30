@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Create Tiket</h1>
    <a class="label label-warning" href="{{URL::to('ticket')}}" >Back</a>
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

    <form method="post" action="{{url('ticket/store')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Nama :</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Jenis Tiket:</label>
            <select class="form-control" name="type">
                <option>Free</option>
                <option>Berbayar</option>
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Amount :</label>
            <input type="number" class="form-control" name="amount"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Price :</label>
            <input type="number" class="form-control" name="price"/>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Description :</label>
            <textarea type="text" class="form-control" name="description" ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@stop