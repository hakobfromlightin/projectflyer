@extends('layout')

@section('content')
    <h1>Selling your home?</h1>
    <hr>
    <form method="post" action="{{ action('FlyersController@store') }}">
        @include('flyers.form')

        @include('errors')
    </form>
@stop