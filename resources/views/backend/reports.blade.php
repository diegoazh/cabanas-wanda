@extends('templates.backend-reports-layout')

@section('title', 'Reportes')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
@endsection

@section('content')
    <div id="vue-reports-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-reports.js') }}"></script>
@endsection