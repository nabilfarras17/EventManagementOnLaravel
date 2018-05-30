@extends('adminlte::page')

@section('title', 'Loket')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>You are logged in! </p>
    <p> Hello , {{Auth::User()->name}}</p>
@stop