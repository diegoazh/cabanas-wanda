@extends('templates.frontend-layout')

@section('title')
    Nuestras caba&ntilde;as
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cottages.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-center page-header"><i class="fa fa-home" aria-hidden="true"></i> Nuestras Caba&ntilde;as</h1>
        </div>
    </div>
    @for($i = 0; $i < count($cottages);)
        <div class="row content">
            @for($j = 2; $j >= 0; $j--)
                @if(isset($cottages[$i]))
                    @php $images = explode('|', $cottages[$i]->images); @endphp
                    <div class="col-12 col-md-4">
                        <div class="row m-3 pt-3 thumbnail">
                            <div class="cottage-number">
                                <i class="fa fa-hashtag" aria-hidden="true"></i> {{ $cottages[$i]->number }}
                            </div>
                            <div class="col-12">
                                <img role="button" src="{{ preg_match('/https?:\/\//',$images[0]) ? $images[0] : asset('images/cabanias/' . $images[0]) }}" alt="{{ $images[0] }}" class="img-fluid rounded">
                            </div>
                            <div class="col-12">
                                <br>
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Categor&iacute;a</th>
                                            <th scope="col">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fa fa-bed" aria-hidden="true"></i> Tipo</th>
                                            <td><span class="badge @if($cottages[$i]->type === 'simple') badge-info @else badge-success @endif">{{ $cottages[$i]->type }}</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fa fa-users" aria-hidden="true"></i> Capacidad</th>
                                            <td><span class="badge badge-secondary"><i class="fas fa-hashtag" aria-hidden="true"> {{ $cottages[$i]->accommodation }}</i></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fas fa-dollar-sign" aria-hidden="true"></i> Precio</th>
                                            <td><span class="badge badge-danger"><i class="fas fa-dollar-sign" aria-hidden="true"> {{ $cottages[$i]->price }}</i></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Estado</th>
                                            <td><span class="badge @if($cottages[$i]->state === 'enabled') badge-success @else badge-danger @endif">{{ $cottages[$i]->state === 'enabled' ? 'Habilitada' : 'Deshabilitada' }}</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fas fa-comment-alt" aria-hidden="true"></i> Calificación</th>
                                            <td>
                                                @if($cottages[$i]->voters)
                                                    @for($a = 0; $a < ($cottages[$i]->stars / $cottages[$i]->voters); $a++)
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                    @endfor
                                                @else
                                                    Sin calificaci&oacute;n
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <a href="{{ route('home.cottages.show', $cottages[$i]->slug) }}" class="btn btn-outline-info"><i class="fa fa-eye" aria-hidden="true"></i> m&aacute;s informaci&oacute;n...</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                @php $i++ @endphp
            @endfor
        </div>        
    @endfor
@endsection