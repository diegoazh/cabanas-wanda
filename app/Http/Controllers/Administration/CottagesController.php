<?php

namespace App\Http\Controllers\Administration;

use App\Cottage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CottagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = public_path();
        dd($a);
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

        $files = $request->file('images');
        $names;
        foreach ($files as $key => $value) {
            $names[$key] = 'user_' . time() . '_' . $value->getClientOriginalName();
        }
        $path = public_path() . '/images/cabanias';
        for ($i = count($files) - 1; $i >= 0; $i--) {
            $files[$i]->move($path, $names[$i]);
        }

        $cottage = new Cottage($request->all());
        $cottage->images = '';
        foreach ($names as $name) {
            $cottage->images .= ($name . '|');
        }
        $cottage->save();

        $check = $request->all();
        $check = (isset($check['create_other'])) ? $check['create_other'] : 0;
        return (boolval($check)) ? redirect()->route('cottages.create') : redirect()->route('cottages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cottage  $cottage
     * @return \Illuminate\Http\Response
     */
    public function show(Cottage $cottage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cottage  $cottage
     * @return \Illuminate\Http\Response
     */
    public function edit(Cottage $cottage)
    {
        //
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
