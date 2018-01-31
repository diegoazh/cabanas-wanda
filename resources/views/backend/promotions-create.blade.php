@extends('templates.backend-layout')

@section('title')
    {{ 'Crear promociones' }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/docs/4.0/examples/floating-labels/floating-labels.css') }}">
@endsection

@section('content')
    {{-- Utiliza el div.card --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/vue-promotions-create.js') }}"></script>
@endsection