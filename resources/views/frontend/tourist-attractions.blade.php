@extends('templates.frontend-layout')

@section('title', 'Atracciones turísticas')

@section('styles')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-7">
            <h2 class="text-center bg-dark text-light py-2 rounded"><i class="fa fa-map-signs" aria-hidden="true"></i> Atracciones turísticas</h2>
            <p>A continuación te dejamos un mapa con algunas de las atracciones turísticas de Misiones, la linda, para que puedas planear tus recorridos mientras estes en nuestra hermosa provincia.</p>
            <p>También puedes visitar el sitio <a href="https://www.tripadvisor.com.ar/Attractions-g312803-Activities-Province_of_Misiones_Litoral.html" target="_blank">TripAdvisor.com.ar</a> donde encontrarás un detalle aún más amplio de los lugares turísiticos en toda la provincia de Misiones, ordenado por categorías y lugares.</p>
            <p>Te recomendamos que le heches un vistaso antes de preparar tu agenda.</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.google.com/maps/d/embed?mid=1iawNw8FNbKBOGyAClxGlIlV2GQY&hl=en_US" width="640" height="480"></iframe>
            </div>
            <p>Esperamos que los disfrutes. <br> <b>Hotel cabañas de wanda</b>.</p>
        </div>
    </div>
@endsection

@section('scripts')
@endsection