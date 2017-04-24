@extends('templates.frontend-layout')

@section('title')
    Bienvenido
@endsection

@section('content')
    <section class="row">
        <div class="col-md-8 col-md-offset-2 description">
            <div id="main_message" class="row">
                <div class="col-md-4 col-md-offset-2">
                    <h2>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit"</h2>
                </div>
                <div class="col-md-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel pharetra libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas feugiat condimentum congue. Praesent eleifend sodales justo, a dictum ipsum. Praesent vel gravida massa. Praesent tempor odio sed sem pulvinar pulvinar. Maecenas vulputate risus eu erat condimentum, sit amet auctor ante pretium. Sed tempor nec massa placerat elementum.</p>
                </div>
                <div class="col-md-12 text-center">
                    <div class="link-button" role="button"><a href="#">Lorem ipsum dolor</a></div>
                </div>
            </div>
            <hr class="division">
            <div id="short_messeges" class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div id="first_slogan">
                        <img src="/images/cabanias/cabanas13.jpg" alt="" class="img-responsive">
                        <h2>ed quam nulla, faucibus at velit ac, pretium vestibulum erat.</h2>
                        <p>Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium. Nullam suscipit sapien non enim pulvinar rhoncus.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div id="second_slogan">
                            <h2>ed quam nulla, faucibus at velit ac, pretium vestibulum erat.</h2>
                            <p>Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="third_slogan">
                            <h2>ed quam nulla, faucibus at velit ac, pretium vestibulum erat.</h2>
                            <p>Cras molestie neque elit, quis gravida elit blandit vel. Fusce leo augue, vehicula vel cursus sed, tristique non massa. Aenean varius laoreet elementum. Nullam suscipit sapien non enim pulvinar rhoncus. Morbi tristique, nunc quis semper dignissim, augue sapien condimentum ante, at interdum tellus massa pretium magna. Cras varius lacus vitae mauris iaculis pretium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="division handicon">
            <div id="short_messages_2" class="row">
                <div class="col-md-offset-1 col-md-11">
                    <div id="fourth_slogan">
                        <h2>Donec vitae molestie magna. Pellentesque nec odio congue, cursus velit in, lacinia lorem.</h2>
                        <p>Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas. Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas. Nunc lobortis ut magna tristique consectetur. Ut maximus ultricies ullamcorper. Etiam a risus lorem. Mauris condimentum ex nunc, eu suscipit lacus tristique at. Donec condimentum dui id porttitor pellentesque. Phasellus maximus non ex et eleifend. Pellentesque facilisis scelerisque turpis sed tristique. Praesent viverra egestas mi. Nam efficitur pulvinar arcu quis egestas.</p>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-5">
                    <div id="fifth_slogan">
                        <img src="/images/cabanias/cabanas5.jpg" alt="" class="img-responsive">
                        <h2>Donec lobortis sit amet nunc sit amet venenatis.</h2>
                        <p>Mauris a velit suscipit, malesuada nunc quis, faucibus eros. Aliquam tincidunt nisi id erat dapibus, in vulputate urna consequat. Nam accumsan at lectus sit amet dapibus. Nam eget dui sapien. Nulla ac ligula accumsan, egestas enim ut, ultrices mauris. Donec a eros vel metus lobortis blandit.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="sixth_slogan">
                        <img src="/images/cabanias/cabanas2.jpg" alt="" class="img-responsive">
                        <h2>Donec lobortis sit amet nunc sit amet venenatis.</h2>
                        <p>Mauris a velit suscipit, malesuada nunc quis, faucibus eros. Aliquam tincidunt nisi id erat dapibus, in vulputate urna consequat. Nam accumsan at lectus sit amet dapibus. Nam eget dui sapien. Nulla ac ligula accumsan, egestas enim ut, ultrices mauris. Donec a eros vel metus lobortis blandit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonies" class="row">
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
    <section id="terms_and_conditions" class="row">
        <div class="col-md-offset-1 col-md-3">
            <h2><i class="fa fa-info-circle" aria-hidden="true"></i> Información para el usuario</h2>
            <ul class="fa-ul">
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Acerca de nosotros</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Cómo llegar</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Atracciónes turísticas de la zona</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Bases y condiciones en promociones</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Política de privacidad</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Términos y condiciones</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h2><i class="fa fa-youtube-square" aria-hidden="true"></i> Nuestro canal</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/GktQFL-jAvs" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-md- col-md-3">
            <h2><i class="fa fa-user-circle" aria-hidden="true"></i> Redes Sociales</h2>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-facebook fa-stack-1x"></i>
                </span>
                ¡Dejanos un me gusta en nuestra fan page!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x"></i>
                </span>
                ¡Siguenos en Twitter!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-instagram fa-stack-1x"></i>
                </span>
                ¡Siguenos en Instagram!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-youtube fa-stack-1x"></i>
                </span>
                ¡Suscribete a nuestro canal!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-google-plus fa-stack-1x"></i>
                </span>
                ¡Dejanos un +1 en Google+!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-envelope fa-stack-1x"></i>
                </span>
                ¡Escribenos un e-mail!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-phone fa-stack-1x"></i>
                </span>
                ¡Contactanos a nuestro fijo (0054) 03757-471272!
            </a>
            <a href="">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-whatsapp fa-stack-1x"></i>
                </span>
                ¡Envianos un Whatsapp o llama al (+549) 3757-675651!
            </a>
        </div>
    </section>
@endsection