<html>
    <head>
        <title>Confirmación de cuenta</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
                <div class="panel panel-body">
                    <h1 class="text-center">Gracias por registrarte {{ $user->fullname }}</h1>
                    <p class="text-justify">Tu registro en nuestro sitio está casi completo.</p>
                    <p class="text-justify">Solo debes confirmar tu cuenta  haciendo clic en el siguiente botón</p>
                    <div class="text-center">
                        <a href="{{ url("/confirm_account?email=$user->email&token=$user->confirm_code") }}" class="btn btn-lg btn-success">Confirmar mi cuenta</a>
                    </div>
                    <p class="text-justify">Si lo deseas también pude copiar el siguiente enlace en tu navegador favorito para confirmar tu cuenta.</p>
                    <p class="text-center text-primary">{{ url("/confirm_account?email=$user->email&token=$user->confirmation_code") }}</p>
                    <p class="text-justify">Una vez que hayas confirmado tu cuenta ya puedes operar en nuestro sitio como usuario.</p>
                    <p class="text-justify">Nuevamente gracias por registrarte y te esperamos pronto como huesped en nuestras cabañas.</p>
                    <p class="text-right">Atte. El equipo de Caba&ntilde;as de Wanda.</p>
                    <hr>
                    <p class="text-justify text-muted"><small>Este email no te ha suscripto a ninguna lista de emails ni lo hará. Tu información únicamente será usada en nuestro sitio y no se la proporcionaremos a nadie sin tu expreso consentimiento. Cuando te enviemos un email siempre sera desde este remitente y solo lo haremos para informarte de alguna promoción o sobre algún cambio que se haya realizado o este programado a futuro. No avalamos el spam en ninguna de sus formas por lo cual nunca recibirás correo basura de nuestra parte. Si en algún momento llegara a suceder por favor informanos de la situación a la brevedad. Este mail fué generado automaticamente por la aplicación web de nuestro sitio pero si tienes alguna duda o necesitas información puedes responderlo y te estaresmos contactando a la brevedad vía mail.</small></p>
                </div>
            </div>
        </div>
    </body>
</html>