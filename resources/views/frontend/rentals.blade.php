@extends('templates.frontend-layout')

@section('title')
    Realizar reserva
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
@endsection

@section('content')
    <div id="vue-rentals-app"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        (function () {
            window.myInfo = {};
            window.myInfo.basicOne = {{ $administration }};
            window.myInfo.basicTwo = "{{ $user }}";
        })();
    </script>
@endsection