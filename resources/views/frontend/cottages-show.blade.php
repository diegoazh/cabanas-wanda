@extends('templates.frontend-layout')

@section('title')
    Caba&ntilde;a {{ strtoupper($cottage->name) }}
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cottages.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 offeset-md-2">
            <div class="cottage-number">
                <i class="fa fa-hashtag" aria-hidden="true"></i> {{ $cottage->number }}
            </div>
            <h1 class="text-center page-header"><i class="fa fa-home" aria-hidden="true"></i> Caba&ntilde;a <span>{{ $cottage->name }}</span></h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for($a = 0; $a <= count($images) -1; $a++)
                        @if(!empty($images[$a]))
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $a }}" class="@if($a === 0) active @endif"></li>
                        @endif
                    @endfor
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @for($b = 0; $b <= count($images) -1; $b++)
                        @if(!empty($images[$b]))
                            <div class="carousel-item @if($b === 0) active @endif">
                                <img src="{{ preg_match('/https?:\/\//',$images[$b]) ? $images[$b] : asset('images/cabanias/' . $images[$b]) }}" alt="{{ $images[$b] }}" class="d-block w-100">
                            </div>
                        @endif
                    @endfor
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <h2 class="title-sections" style="cursor:pointer;"><i role="button" class="fa fa-caret-down" aria-hidden="true"></i> Informaci&oacute;n de la caba&ntilde;a</h2>
            <div id="cottage_description" class="element-slide">
                <table class="table table-responsive table-striped table-hover">
                    <thead class="thead-dark">
                    <tr class="info">
                        <th scope="col"><i class="fa fa-check-square-o" aria-hidden="true"></i> Categor&iacute;a</th>
                        <th scope="col"><i class="fa fa-check-square-o" aria-hidden="true"></i> Detalle</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><i class="fa fa-bed" aria-hidden="true"></i> Tipo</th>
                            <td><span class="badge @if($cottage->type === 'simple') badge-info @else badge-success @endif text-capitalize">{{ $cottage->type }}</span></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa fa-users" aria-hidden="true"></i> Capacidad</th>
                            <td><span class="badge badge-secondary"><i class="fa fa-hashtag" aria-hidden="true"> {{ $cottage->accommodation }}</i></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa fa-usd" aria-hidden="true"></i> Precio</th>
                            <td><span class="badge badge-danger"><i class="fa fa-dollar" aria-hidden="true"> {{ $cottage->price }}</i></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa fa-commenting-o" aria-hidden="true"></i> Calificación</th>
                            <td>
                                @if($cottage->voters)
                                    @for($a = 0; $a < ($cottage->stars / $cottage->voters); $a++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                @else
                                    Sin calificaci&oacute;n
                                @endif
                            </td>
                        </tr>
                        <tr class="text-left info">
                            <th colspan="2"><i class="fa fa-check-square-o" aria-hidden="true"></i> Servicios de la caba&ntilde;a</th>
                        </tr>
                        <tr>
                            <th><i class="fa fa-thermometer-half" aria-hidden="true"></i></th>
                            <td>Aire acondicionado frio/calor</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-shower" aria-hidden="true"></i></th>
                            <td>Agua caliente a trav&eacute;s de ducha el&eacute;ctrica</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-bed" aria-hidden="true"></i></th>
                            <td>Ropa de cama</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-wifi" aria-hidden="true"></i></th>
                            <td>WiFi</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-television" aria-hidden="true"></i></th>
                            <td>TV por cable</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-coffee" aria-hidden="true"></i></th>
                            <td>Desayuno express</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-cutlery" aria-hidden="true"></i></th>
                            <td>Restaurante abierto domingo a jueves de 07:00 a 24:00 hs, viernes de 07:00 a 18:00 hs y Sabados de 20:00 a 24:00 hs</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-child" aria-hidden="true"></i></th>
                            <td>Predio cerrado para seguridad de los ni&ntilde;os</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-car" aria-hidden="true"></i></th>
                            <td>Estacionamiento cubierto</td>
                        </tr>
                        <tr class="info">
                            <td colspan="2"><i class="fa fa-check-square-o" aria-hidden="true"></i> Descripci&oacute;n</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-file-text-o" aria-hidden="true"></i></th>
                            <td>{{ $cottage->description }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-right"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            {{-- TODO (Diego) Revisar el calendario. <div class="row justify-content-center reservation-section">
                <h2 class="title-sections text-left" style="cursor: pointer;"><i role="button" class="fa fa-caret-down" aria-hidden="true"></i> Reservas</h2>
                <div id="calendar" class="col-12 col-md-8 my-5 element-slide"></div>
            </div> --}}
            <div class="w-100"></div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
