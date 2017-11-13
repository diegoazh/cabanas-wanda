@extends('templates.frontend-layout')

@section('title')
    Ordernar
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
@endsection

@section('content')
    <div id="vue-order-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-orders.js') }}"></script>
@endsection