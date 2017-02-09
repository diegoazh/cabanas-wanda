@extends('templates.frontend-layout')

@section('estilos')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/cottages.css') }}">
@endsection

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1 class="text-center"><i class="fa fa-home" aria-hidden="true"></i> Caba&ntilde;a <span>{{ $cottage->name }}</span></h1>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @for($a = 0; $a <= count($images) -1; $a++)
                    @if(!empty($images[$a]))
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $a }}" class="@if($a === 0) active @endif"></li>
                    @endif
                @endfor
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @for($b = 0; $b <= count($images) -1; $b++)
                    @if(!empty($images[$b]))
                        <div class="item @if($b === 0) active @endif">
                            <img src="{{ asset('images/cabanias/' . $images[$b]) }}" alt="{{ $images[$b] }}" class="img-responsive">
                        </div>
                    @endif
                @endfor
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="table-responsive">
            <h2>Informaci&oacute;n de la caba&ntilde;a</h2>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Categor&iacute;a</th>
                    <th scope="col">Detalle</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><i class="fa fa-bed" aria-hidden="true"></i> Tipo</th>
                        <td><span class="label @if($cottage->type === 'simple') label-info @else label-success @endif">{{ $cottage->type }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fa fa-users" aria-hidden="true"></i> Capacidad</th>
                        <td><span class="label label-default"><i class="fa fa-hashtag" aria-hidden="true"> {{ $cottage->accommodation }}</i></span></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fa fa-usd" aria-hidden="true"></i> Precio</th>
                        <td><span class="label label-danger"><i class="fa fa-dollar" aria-hidden="true"> {{ $cottage->price }}</i></span></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fa fa-commenting-o" aria-hidden="true"></i>Calificación</th>
                        <td>
                            @for($a = 0; $a < 5; $a++)
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="text-right"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
