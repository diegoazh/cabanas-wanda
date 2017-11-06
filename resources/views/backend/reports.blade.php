@extends('templates.backend-reports-layout')

@section('title', 'Reportes')

@section('content')
    <div id="vue-reports-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-reports.js') }}"></script>
@endsection