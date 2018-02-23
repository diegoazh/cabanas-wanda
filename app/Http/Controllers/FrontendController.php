<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmailSuccess;
use App\Mail\ContactFromApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function showHome()
    {
        return view('frontend.home');
    }

    public function userContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'content' => 'required|string',
            'phone' => 'numeric'
        ], [
            'name.required' => 'Necesitamos saber su nombre.',
            'name.string' => 'Su nombre debe ser una cadena de texto.',
            'eamil.required' => 'Necesitamos saber su email para poder responderle.',
            'eamil.email' => 'El email debe tener un formato válido.',
            'subject.required' => 'Por favor indiquenos cual es el asunto del mail.',
            'subject.string' => 'El asunto debe ser una cadena de texto.',
            'content.required' => 'Por favor expliquenos en el cuerpo del mensaje lo que necesite o desee consultar.',
            'content.string' => 'El contenido debe ser texto.',
            'phone.numeric' => 'El número de telefono debe contener solo dígitos.'
        ]);

        $info = $request->all();

        Mail::to('cabaniasdewanda@gmail.com', 'Administradores Hotel Cabañas de Wanda')->send(new ContactFromApp($info['name'], $info['email'], $info['subject'], $info['content'], $info['phone']));
        Mail::to($info['email'], $info['name'])->send(new ConfirmEmailSuccess($info['name']));

        flash('<h3>¡El mensaje se envió correctamente!</h3>')->success();

        return redirect(route('home'));
    }

    public function ourLocation()
    {
        return view('frontend.our-location');
    }

    public function touristAttractions()
    {
        return view('frontend.tourist-attractions');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function policiesPrivacy()
    {
        return view('frontend.policies-privacy');
    }

    public function basesTerms()
    {
        return view('frontend.bases-terms');
    }

    public function termsConditions()
    {
        return view('frontend.terms-conditions');
    }

}
