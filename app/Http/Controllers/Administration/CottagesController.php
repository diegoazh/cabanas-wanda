<?php

namespace App\Http\Controllers\Administration;

use App\Cottage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as Auth;

class CottagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cottages = Cottage::orderBy('number', 'asc')->paginate(10);
        return view('backend.cottages')->with('cottages', $cottages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cottage-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'unique:cottages|required|numeric',
            'name' => 'unique:cottages|required|string|max:10',
            'type' => 'required|string',
            'accommodation' => 'required|numeric|min:1|max:6',
            'description' => 'string|max:255',
            'price' => 'required|numeric'
        ]);

        $files = $request->file('images'); // seleccionamos las imágenes del request.
        $names;
        foreach ($files as $key => $value) {
            $names[$key] = Auth::user()->slug . '_' . time() . '.' . $value->getClientOriginalExtension(); // creamos un nombre único
        }
        // $path = public_path() . '/images/cabanias'; // determinamos la ruta donde se guardan, necesario para la primera forma
        for ($i = count($files) - 1; $i >= 0; $i--) {
            // $files[$i]->move($path, $names[$i]); // primera forma con el objeto $file movemos cada imagen al directorio con su nuevo nombre
            \Storage::disk('cabanias')->put($names[i], \File::get($files[i])); // segunda forma con la clase storage y el filesistem de laravel
        }

        $cottage = new Cottage($request->all()); // creamos el nuevo objeto cottage
        $cottage->images = ''; // limpiamos la propiedad images que era un array
        foreach ($names as $name) {
            $cottage->images .= ($name . '|'); // concatenamos los nombres ya que debe ser un string
        }
        $cottage->save(); // guardamos el objeto en la DB

        $check = $request->all();
        $check = (isset($check['create_other'])) ? $check['create_other'] : 0; // chequeamos si desea crear otra cabaña
        return (boolval($check)) ? redirect()->route('cottages.create') : redirect()->route('cottages.index'); // deacuerdo a su elección lo redirigimos
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $cottage
     * @return \Illuminate\Http\Response
     */
    public function show($cottage)
    {
        $cottage = Cottage::where('slug', $cottage)->first();
        dd($cottage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cottage  $cottage
     * @return \Illuminate\Http\Response
     */
    public function edit(Cottage $cottage)
    {
        return view('backend.cottage-create')->with('cottage', $cottage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cottage  $cottage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cottage $cottage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cottage  $cottage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cottage $cottage)
    {
        //
    }
}
