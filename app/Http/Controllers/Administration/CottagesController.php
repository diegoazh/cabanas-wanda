<?php

namespace App\Http\Controllers\Administration;

use App\Cottage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\RequestCottage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Storage as Storage;
use Illuminate\Support\Facades\Auth;

class CottagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('isEmployed')->except(['index', 'show']);
    }

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
        try
        {
            $filename = 'testText.txt';
            $contents = Storage::disk('public')->get($filename);
        }
        catch (\Illuminate\Filesystem\FileNotFoundException $exception)
        {
            die("No existe el archivo");
        }
        return view('backend.cottage-create')->with('contents', $contents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RequestCottage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCottage $request)
    {
        $v = Validator::make($request->all(), [
            'number' => [
                'required',
                'numeric',
                Rule::unique('cottages')->where(function ($query) {
                    $query->where('deleted_at', null);
                })
            ]
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        $files = $request->file('images'); // seleccionamos las imágenes del request.
        $cottage = new Cottage($request->all()); // creamos el nuevo objeto cottage
        $cottage->images = $cottage->addOrRemoveImages($files); // Ver el metodo del modelo allí se procesan las imágenes.
        $cottage->save(); // guardamos el objeto en la DB

        $check = $request->all();
        $check = (isset($check['create_other'])) ? $check['create_other'] : 0; // chequeamos si desea crear otra cabaña
        return (boolval($check)) ? redirect()->route('cottages.create') : redirect()->route('cottages.index'); // deacuerdo a su elección lo redirigimos
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cottage = Cottage::where('slug', $slug)->first();
        $images = explode('|', $cottage->images);
        return view('frontend.cottages-show')->with(compact('cottage', 'images'));
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
        $v = Validator::make($request->all(), [
            'number' => [
                'required',
                'numeric',
                Rule::unique('cottages')->ignore($cottage->id)
            ]
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
            flash('<h3>Ha ocurrido un error por favor verifique la información enviada.</h3>', 'warning');
        }

        $attributes = $request->all();
        $cottage->name = $attributes['name'];
        $cottage->type = $attributes['type'];
        $cottage->state = $attributes['state'];
        $cottage->accommodation = $attributes['accommodation'];
        $cottage->description = $attributes['description'];
        $cottage->price = $attributes['price'];
        $cottage->images = $cottage->addOrRemoveImages((isset($attributes['images'])) ? $attributes['images'] : null, $attributes['actualImages'], $attributes['removedImages']);
        $cottage->save();

        flash('<h3>La cabaña se actualizó correctamente.</h3>', 'success');

        return redirect()->route('cottages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $cottage = Cottage::find($id);
        $cottage->delete();

        flash('<h3>La cabaña se eliminó correctamente.</h3>', 'success');

        if ($request->ajax()) {
            return response()->json([
                'message' => 'La cabaña se eliminó correctamente.'
            ]);
        }

        return redirect()->route('cottages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function cottagesBulkActions(Request $request)
    {
        $info = $request->all();
        $cottages = Cottage::all();

        if (isset($info['action'])) {

            if ($info['action'] === 'enable') {

                foreach ($cottages as $cottage) {
                    $cottage->state = 'enabled';
                    $cottage->save();
                }

            } else if ($info['action'] === 'disable') {

                foreach ($cottages as $cottage) {
                    $cottage->state = 'disabled';
                    $cottage->save();
                }

            } else {

                flash('<h3>No se envió la información necesaria, por favor verifique y reintente.</h3>')->warning();
                return redirect(route('cottages.index'));

            }

        } else if (isset($info['cottages']) && !empty($info['cottages'])) {

            if (isset($info['bulkState']) && $info['bulkState'] && isset($info['state']) && !empty($info['state'])) {

                foreach ($info['cottages'] as $number) {

                    foreach ($cottages as $cottage) {

                        if ($cottage->number === (integer)$number) {

                            $cottage->state = $info['state'];
                            $cottage->save();

                        }
                    }

                }

            } else if (isset($info['bulkType']) && $info['bulkType'] && !empty($info['type'])) {

                foreach ($info['cottages'] as $number) {

                    foreach ($cottages as $cottage) {

                        if ($cottage->number === (integer)$number) {

                            $cottage->type = $info['type'];
                            $cottage->save();

                        }
                    }

                }

            } else if (isset($info['bulkAccommodation']) && $info['bulkAccommodation'] && isset($info['accommodationCottages']) && !empty($info['accommodationCottages'])) {

                foreach ($info['cottages'] as $number) {

                    foreach ($cottages as $cottage) {

                        if ($cottage->number === (integer)$number) {

                            $cottage->accommodation = $info['accommodationCottages'];
                            $cottage->save();

                        }
                    }

                }

            } else if (isset($info['bulkPrice']) && $info['bulkPrice'] && isset($info['priceCottages']) && !empty($info['priceCottages'])) {

                foreach ($info['cottages'] as $number) {

                    foreach ($cottages as $cottage) {

                        if ($cottage->number === (integer)$number) {

                            $cottage->price = $info['priceCottages'];
                            $cottage->save();

                        }
                    }

                }

            } else {

                flash('<h3>No se envió la información necesaria, por favor verifique y reintente.</h3>')->warning();
                return redirect(route('cottages.index'));

            }

        } else {

            flash('<h3>La información no llegó correctamente, por favor verifique y reintente.</h3>')->warning();
            return redirect(route('cottages.index'));

        }

        flash('<h3>Las operaciones se procesaron con éxito.</h3>')->success();

        return redirect(route('cottages.index'));
    }
}
