<?php

namespace App\Http\Controllers;

use App\Cottage as Cottage;
use Illuminate\Http\Request;

class CottagesController extends Controller
{
    public function index()
    {
        $customContent = true;
        $cottages = Cottage::where('state', 'enabled')->orderBy('number', 'asc')->paginate(10);
        return view('frontend.cottages-index')->with(compact('customContent', 'cottages'));
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
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cottagesEnabled(Request $request)
    {
        $cottages = Cottage::where('state', '!=', 'disabled')->orderBy('number')->get();

        return response()->json(compact('cottages'), 200);
    }
}
