@extends('templates.frontend-layout')

@section('title')
    Como llegar
@endsection

@section('styles')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-7">
            <h2 class="text-center bg-dark text-light py-2 rounded"><i class="fa fa-map-marker" aria-hidden="true"></i> Nuestra ubicación</h2>
            <p>En el mapa de abajo <i class="fa fa-hand-o-down" aria-hidden="true"></i> encontrarás nuestra ubicación. Este mapa utiliza la api de google que te ayudará a encontrar la mejor ruta para que puedas llegar lo antes posible a nuestras cabañas, <b>a descansar</b>.</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3587.1807999644443!2d-54.58153668437022!3d-25.962110160481185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f6e2e4557f92f7%3A0x9f92ad804c0680bf!2sHotel+Caba%C3%B1as+De+Wanda!5e0!3m2!1ses!2sar!4v1514989608714" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <p>Te esperamos pronto. <br> <b>Hotel cabañas de wanda</b>.</p>
        </div>
    </div>
@endsection

@section('scripts')
@endsection