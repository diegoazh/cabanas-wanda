@extends('templates.frontend-layout')

@section('title')
    {{ 'Reservas de ' . $user->formalFullname }}
@endsection

@section('styles')
@endsection

@section('content')
    <div id="profile-rentals"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/vue-profile-rentals.js') }}" type="text/javascript"></script>
@endsection
