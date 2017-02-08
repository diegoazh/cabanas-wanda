@extends('templates.frontend-layout')

@section('estilos')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/cottages.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center"><i class="fa fa-home" aria-hidden="true"></i> Nuestras Caba&ntilde;as</h1>
        </div>
    </div>
    @for($i = 0; $i < count($cottages);)
        <div class="row content">
            @for($j = 2; $j >= 0; $j--)
                @if(isset($cottages[$i]))
                    @php $images = explode('|', $cottages[$i]->images); @endphp
                    <div class="col-md-4">
                        <div class="row thumbnail">
                            <div class="cottage-number">
                                <i class="fa fa-hashtag" aria-hidden="true"></i> {{ $cottages[$i]->number }}
                            </div>
                            <div class="col-md-12">
                                <img src="{{ asset('images/cabanias/' . $images[0]) }}" alt="{{ $images[0] }}" class="img-responsive img-rounded">
                            </div>
                            <div class="col-md-12">
                                <br>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Categor&iacute;a</th>
                                            <th scope="col">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><i class="fa fa-bed" aria-hidden="true"></i></th>
                                        <td><span class="label @if($cottages[$i]->type === 'simple') label-info @else label-success @endif">{{ $cottages[$i]->type }}</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-users" aria-hidden="true"></i></th>
                                        <td><span class="label label-default"><i class="fa fa-hashtag" aria-hidden="true"> {{ $cottages[$i]->accommodation }}</i></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-usd" aria-hidden="true"></i></th>
                                        <td><span class="label label-danger"><i class="fa fa-dollar" aria-hidden="true"> {{ $cottages[$i]->price }}</i></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-commenting-o" aria-hidden="true"></i></th>
                                        <td>
                                            @for($a = 0; $a < 5; $a++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <a href="{{ route('home.cottages.show', $cottages[$i]->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> m&aacute;s informaci&oacute;n...</a>
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