<?php

namespace App\Http\Controllers\Administration;

use App\Cottage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\RequestCottage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        }
        $attributes = $request->all();
        $cottage->name = $attributes['name'];
        $cottage->type = $attributes['type'];
        $cottage->accommodation = $attributes['accommodation'];
        $cottage->description = $attributes['description'];
        $cottage->price = $attributes['price'];
        $cottage->images = $cottage->addOrRemoveImages($attributes['images'], $attributes['actualImages'], $attributes['removedImages']);
        $cottage->save();
        return redirect()->route('cottages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cottage = Cottage::find($id);
        $cottage->delete();
        return redirect()->route('cottages.index');
    }
}
