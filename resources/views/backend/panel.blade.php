@extends('templates.backend-layout')

@section('title', 'Panel de Administración')

@section('content')
    {{-- vue toma al <div class="panel"></div> como el elemento raiz --}}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-dash.js') }}"></script>
@endsection