<?php

namespace App\Http\Controllers\Administration;

use App\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.home-page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $front = new Frontend();
        $params = $request->all();
        dd($params);
        $front->tt_presentation = $params['tt_presentation'];
        $front->msg_presentation = $params['msg_presentation'];
        $front->txt_btn_presentation = $params['txt_btn_presentation'];
        $front->lnk_btn_presentation = $params['lnk_btn_presentation'];
        $front->tt_slogan_one = $params['tt_slogan_one'];
        $front->desc_slogan_one = $params['desc_slogan_one'];
        $front->tt_slogan_two = $params['tt_slogan_two'];
        $front->desc_slogan_two = $params['desc_slogan_two'];
        $front->tt_slogan_three = $params['tt_slogan_three'];
        $front->desc_slogan_three = $params['desc_slogan_three'];
        $front->tt_slogan_four = $params['tt_slogan_four'];
        $front->desc_slogan_four = $params['desc_slogan_four'];
        $front->tt_slogan_five = $params['tt_slogan_five'];
        $front->desc_slogan_five = $params['desc_slogan_five'];
        $front->tt_slogan_six = $params['tt_slogan_six'];
        $front->desc_slogan_six = $params['desc_slogan_six'];
        $front->link_video = $params['link_video'];
        $front->facebook = $params['facebook'];
        $front->twitter = $params['twitter'];
        $front->instagram = $params['instagram'];
        $front->youtube = $params['youtube'];
        $front->googleplus = $params['googleplus'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
