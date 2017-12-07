@extends('emails.templates.layout')

@section('title-page', 'Confirmación de cuenta')

@section('super-title', 'HOTEL')

@section('title-mail', 'Cabañas de Wanda')

@section('hi', '¡Gracias por registrarte!')

@section('content')
    <h1 class="text-center">{{ $user->fullname }}</h1>
    <p>Desde el equipo de Cabañas de Wanda, queremos agradecerte por confiar en nostros y elegirnos. <br>
    Queremos que sepas, desde el primer día, que es un placer para nosotros contar con tu compañia y poder compartir la belleza de nuestra provincia. Trataremos siempre que tu estadía sea placentera y que tengas que preocuparte únicamente en organizar tu agenda para conecer los maravillos paisajes que te ofrece nuestra querida tierra colorada. <br>
    Para nosotros será un honor ser tus anfitriones y poder hacer de tu estadía un verdadero tiempo de descanso. <br>
    Nuevamente gracias por elegirnos.</p>
@endsection

@section('content2')
    <p>Tu registro está casi completo. <br>
    solo debes confirmar tu cuenta copiando, en tu navegador favorito, el link que te adjuntamos abajo o también puedes hacer clic en el botón "confirmar mi cuenta".
    <br>
    Una vez que hayas confirmado tu cuenta podrás comenzar a operar en nuestro sitio utilizando todas sus funcionalidades de reservas y promociones. <br>
    Una vez más gracias por registrarte y esperamos tenerte pronto como huesped. <br>
    <br>
    Copia en tu navegador favorito el siguiente link: <br></p>
    <p>{{ url("/confirm_account?email=$user->email&token=$user->confirmation_code") }}</p>
@endsection

@section('button-text', 'Confirmar mi cuenta')

@section('button-link', url("/confirm_account?email=$user->email&token=$user->confirmation_code"))

@section('image-brand')
    @parent
@endsection

@section('content3')
    <p class="text-justify text-muted"><small>Este email no te ha suscripto a ninguna lista de emails ni lo hará. Tu información únicamente será usada en nuestro sitio y no se la proporcionaremos a nadie sin tu expreso consentimiento. Cuando te enviemos un email siempre sera desde este remitente y solo lo haremos para informarte de alguna promoción o sobre algún cambio que se haya realizado o este programado a futuro. No avalamos el spam en ninguna de sus formas por lo cual nunca recibirás correo basura de nuestra parte. Si en algún momento llegara a suceder por favor informanos de la situación a la brevedad. Este mail fué generado automaticamente por la aplicación web de nuestro sitio pero si tienes alguna duda o necesitas información puedes responderlo y te responderemos a la brevedad vía mail.</small></p>
@endsection

@section('footer')
    @parent
@endsection