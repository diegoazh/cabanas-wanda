@extends('templates.frontend-layout')

@section('title')
    Realizar reserva
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
@endsection

@section('content')
    <div id="vue-rentals-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-rentals.js') }}"></script>
@endsection