@extends('frontend.template.main')

@include('frontend.headers.main-header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        You aren't logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('frontend.footer.main-footer')