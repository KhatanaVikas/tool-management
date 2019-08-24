@extends('layouts.app')
@section('assets')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- app css -->
    <link rel="stylesheet" href="{{ URL::asset('css/toolmanager.css') }}">
    <!-- bootbox and jquery code -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <!-- App js -->
    <script type="text/javascript" src="{!! asset('js/toolmanager.js') !!}"></script>
@endsection
@section('content')
    <div class="container">
        @yield("content-2")
    </div>
    @yield("modals")
@endsection
