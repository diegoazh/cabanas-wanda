@extends('templates.frontend-layout')

@section('title')
    Bienvenido
@endsection

@section('content')
    <hr class="division">
    <section class="row">
        <div class="col-md-8 col-md-offset-2 description">
            <hr>
            <img src="{{ asset('images/frontend/cabanas9.jpg') }}" alt="" class="img-responsive img-circle">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquet ipsum id ex blandit sodales. Vestibulum id hendrerit lorem. Ut commodo dui ante, nec mollis magna pharetra a. Nullam pellentesque sagittis ullamcorper. Ut sit amet eros eu nisi tempor elementum. Donec sollicitudin aliquam nibh, ac laoreet elit dapibus mollis. Nullam venenatis justo vitae vestibulum lobortis. Duis non nulla a orci aliquet tincidunt vitae ac nisl. Nulla vitae nibh ac ante commodo luctus nec nec eros. Etiam non turpis sed tortor congue sagittis ac quis urna. Vestibulum vel rutrum mauris. </p>
        </div>
    </section>
    <hr class="division">
    <section class="row">
        <div class="col-md-4 col-md-offset-2 description-paralel">
            <img src="{{ asset('images/frontend/cabanas9.jpg') }}" alt="" class="img-responsive img-rounded img-thumbnail">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquet ipsum id ex blandit sodales. Vestibulum id hendrerit lorem. Ut commodo dui ante, nec mollis magna pharetra a. Nullam pellentesque sagittis ullamcorper. Ut sit amet eros eu nisi tempor elementum. Donec sollicitudin aliquam nibh, ac laoreet elit dapibus mollis. Nullam venenatis justo vitae vestibulum lobortis. Duis non nulla a orci aliquet tincidunt vitae ac nisl. Nulla vitae nibh ac ante commodo luctus nec nec eros. Etiam non turpis sed tortor congue sagittis ac quis urna. Vestibulum vel rutrum mauris. </p>
        </div>
        <div class="col-md-4 description-paralel">
            <img src="{{ asset('images/frontend/cabanas9.jpg') }}" alt="" class="img-responsive img-rounded img-thumbnail">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquet ipsum id ex blandit sodales. Vestibulum id hendrerit lorem. Ut commodo dui ante, nec mollis magna pharetra a. Nullam pellentesque sagittis ullamcorper. Ut sit amet eros eu nisi tempor elementum. Donec sollicitudin aliquam nibh, ac laoreet elit dapibus mollis. Nullam venenatis justo vitae vestibulum lobortis. Duis non nulla a orci aliquet tincidunt vitae ac nisl. Nulla vitae nibh ac ante commodo luctus nec nec eros. Etiam non turpis sed tortor congue sagittis ac quis urna. Vestibulum vel rutrum mauris. </p>
        </div>
    </section>
    <section id="testimonies" class="row">
        <hr class="division">
        <div class="col-md-offset-2 col-md-8">
            <h2 class="text-center">{{ strtoupper('testimonios') }}</h2>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{asset('images/profiles/pelado2.png')}}" class="img-responsive img-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/profiles/chica-rodete.png')}}" class="img-responsive img-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/profiles/chico-barba.png')}}" class="img-responsive img-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/profiles/rubia.png')}}" class="img-responsive img-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/profiles/pelado1.png')}}" class="img-responsive img-circle" alt="">
                        <blockquote class="text-left">In condimentum nulla congue dui pretium mollis. Integer dui ante, rhoncus a nunc quis, rhoncus condimentum arcu. Duis maximus aliquam mauris a hendrerit. Nunc maximus cursus enim ac convallis. Aenean nec mi neque. Nam vulputate quis mi tempor commodo. Curabitur augue nisl, finibus nec turpis vulputate, convallis tincidunt nulla. Nam eros orci, tristique vitae ultrices quis, laoreet et velit. Fusce posuere, elit nec imperdiet euismod, magna erat venenatis risus, id accumsan nisi nisl ac magna. </blockquote>
                    </div>
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
        </div>
    </section>
@endsection