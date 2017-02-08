<?php

namespace App\Http\Controllers;

use App\Cottage as Cottage;

class CottagesController extends Controller
{
    public function index()
    {
        $customContent = true;
        $cottages = Cottage::orderBy('number', 'asc')->paginate(10);
        return view('frontend.cottages-index')->with(['customContent' => $customContent, 'cottages' => $cottages]);
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
        return view('frontend.cottages-show')->with('cottage', $cottage);
    }
}
