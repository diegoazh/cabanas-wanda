@extends('templates.frontend-layout')

@section('title')
    Modificar o cancelar reserva
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
@endsection

@section('content')
    <div id="vue-rentals-edit-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-rentals-edit.js') }}"></script>
@endsection