@extends('layout')

@section('content')
    <h1>Selling your home?</h1>
    <hr>
    <form method="post" action="/flyers" enctype="multipart/form-data">
        @include('flyers.form')

        @include('errors')
    </form>
@stop