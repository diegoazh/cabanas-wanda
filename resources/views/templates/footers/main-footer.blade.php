<section id="terms_and_conditions" class="col col-12">
    <div class="row">
        <div class="col-12 col-md-4 pl-md-5">
            <h2><i class="fa fa-info-circle" aria-hidden="true"></i> Información para el usuario</h2>
            <ul class="fa-ul">
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Acerca de nosotros</a></li>
                <li><a href="{{ route('home.front.ourLocation') }}"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Cómo llegar</a></li>
                <li><a href="{{ route('home.front.touristAttractions') }}"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Atracciónes turísticas de la zona</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Bases y condiciones en promociones</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Política de privacidad</a></li>
                <li><a href="#"><i class="fa-li fa fa-check-square-o" aria-hidden="true"></i> Términos y condiciones</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-4 pl-md-5">
            <h2><i class="fa fa-youtube-square" aria-hidden="true"></i> Una peque&ntilde;a muestra</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe width="560" height="315" src="@if(isset($content) && !empty($content->link_video)) {{ $content->link_video }} @else https://www.youtube.com/embed/GktQFL-jAvs @endif" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-12 col-md-4 pl-md-5">
            <h2><i class="fa fa-user-circle" aria-hidden="true"></i> Redes Sociales</h2>
            @if(isset($content) && !empty($content->show_facebook))
                @if($content->show_facebook)
                    <a href="@if(isset($content) && !empty($content->facebook)) {{ $content->facebook }} @endif">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square-o fa-stack-2x"></i>
                          <i class="fa fa-facebook fa-stack-1x"></i>
                        </span>
                        ¡Dejanos un me gusta en nuestra fan page!
                    </a>
                @endif
            @endif
            @if(isset($content) && !empty($content->show_twitter))
                @if($content->show_twitter)
                    <a href="@if(isset($content) && !empty($content->twitter)) {{ $content->twitter }} @endif">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square-o fa-stack-2x"></i>
                          <i class="fa fa-twitter fa-stack-1x"></i>
                        </span>
                        ¡Siguenos en Twitter!
                    </a>
                @endif
            @endif
            @if(isset($content) && !empty($content->show_instagram))
                @if($content->show_instagram)
                    <a href="@if(isset($content) && !empty($content->instagram)) {{ $content->instagram }} @endif">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square-o fa-stack-2x"></i>
                          <i class="fa fa-instagram fa-stack-1x"></i>
                        </span>
                        ¡Siguenos en Instagram!
                    </a>
                @endif
            @endif
            @if(isset($content) && !empty($content->show_youtube))
                @if($content->show_youtube)
                    <a href="@if(isset($content) && !empty($content->youtube)) {{ $content->youtube }} @endif">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square-o fa-stack-2x"></i>
                          <i class="fa fa-youtube fa-stack-1x"></i>
                        </span>
                        ¡Suscribete a nuestro canal!
                    </a>
                @endif
            @endif
            @if(isset($content) && !empty($content->show_googleplus))
                @if($content->show_googleplus)
                    <a href="@if(isset($content) && !empty($content->googleplus)) {{ $content->googleplus }} @endif">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square-o fa-stack-2x"></i>
                          <i class="fa fa-google-plus fa-stack-1x"></i>
                        </span>
                        ¡Dejanos un +1 en Google+!
                    </a>
                @endif
            @endif
            <a href="#" id="mail" data-toggle="modal" data-target="#modalEmailContact">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-envelope fa-stack-1x"></i>
                    </span>
                ¡Escribenos un e-mail!
            </a>
            <a href="#" id="phone" data-toggle="modal" data-target="#msg_modals_frontend" data-tt-modal="¡Contactanos a nuestro fijo!" data-body-modal="(0054) 03757-471272">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-phone fa-stack-1x"></i>
                    </span>
                ¡Contactanos a nuestro fijo!
            </a>
            <a href="#" id="cel" data-toggle="modal" data-target="#msg_modals_frontend" data-tt-modal="¡Envianos un Whatsapp!" data-body-modal="(+549) 3757-675651">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-whatsapp fa-stack-1x"></i>
                    </span>
                ¡Envianos un Whatsapp!
            </a>
            @include('frontend.modals.modal-email')
        </div>
    </div>
</section>