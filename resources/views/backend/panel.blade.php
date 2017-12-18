@extends('templates.backend-layout')

@section('title', 'Panel de Administración')

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/editor.md/css/editormd.css') }}">
@endsection

@section('content')
    {{-- vue toma al <div class="card"></div> como el elemento raiz --}}
@endsection

@section('scripts')
    <script src="{{ asset('lib/editor.md/editormd.min.js') }}"></script>
    <script src="{{ asset('lib/editor.md/languages/en.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vue-dash.js') }}"></script>
@endsection