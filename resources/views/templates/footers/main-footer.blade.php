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
        <h2><i class="fa fa-youtube-square" aria-hidden="true"></i> Una peque&ntilde;a muestra</h2>
        <iframe width="560" height="315" src="@if(isset($content)) {{ $content->link_video }} @else https://www.youtube.com/embed/GktQFL-jAvs @endif" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="col-md- col-md-3">
        <h2><i class="fa fa-user-circle" aria-hidden="true"></i> Redes Sociales</h2>
        <a href="@if(isset($content)) {{ $content->facebook }} @endif" @if(isset($content)) @if(!$content->show_facebook) class="hidden" @endif @endif>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-facebook fa-stack-1x"></i>
                </span>
            ¡Dejanos un me gusta en nuestra fan page!
        </a>
        <a href="@if(isset($content)) {{ $content->twitter }} @endif" @if(isset($content)) @if(!$content->show_twitter) class="hidden" @endif @endif>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x"></i>
                </span>
            ¡Siguenos en Twitter!
        </a>
        <a href="@if(isset($content)) {{ $content->instagram }} @endif" @if(isset($content)) @if(!$content->show_instagram) class="hidden" @endif @endif>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-instagram fa-stack-1x"></i>
                </span>
            ¡Siguenos en Instagram!
        </a>
        <a href="@if(isset($content)) {{ $content->youtube }} @endif" @if(isset($content)) @if(!$content->show_youtube) class="hidden" @endif @endif>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-youtube fa-stack-1x"></i>
                </span>
            ¡Suscribete a nuestro canal!
        </a>
        <a href="@if(isset($content)) {{ $content->googleplus }} @endif" @if(isset($content)) @if(!$content->show_googleplus) class="hidden" @endif @endif>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-google-plus fa-stack-1x"></i>
                </span>
            ¡Dejanos un +1 en Google+!
        </a>
        <a href="#" id="mail" data-toggle="modal" data-target="#msg_modals_frontend" data-tt-modal="¡Escribenos un e-mail!" data-body-modal="cabaniasdewanda">
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
    </div>
</section>