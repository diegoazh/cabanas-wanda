@extends('templates.backend-layout')

@section('title', 'Administración de comidas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/editor.md/css/editormd.css') }}">
@endsection

@section('content')

@endsection

@section('scripts')
    <script src="{{ asset('lib/editor.md/editormd.min.js') }}"></script>
    <script src="{{ asset('lib/editor.md/languages/en.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vue-admin-food.js') }}"></script>
    <script>
        window.adminInfo = {};
        window.adminInfo.token = '{{ $token }}';
    </script>
@endsection