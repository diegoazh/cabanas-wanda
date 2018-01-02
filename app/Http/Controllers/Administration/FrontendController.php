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
        $front = Frontend::where('deleted_at', null)->first();
        if (!empty($front->id) && $front->id > 0) {
            return view('backend.frontend')->with('front', $front);
        }
        return view('backend.frontend');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $f = Frontend::where('deleted_at', null)->first();
        if (!empty($f->id) && $f->id > 0) {
            $f->delete();
        }
        $front = new Frontend();
        $params = $request->all();
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
        $front->show_testimonies = (isset($params['show_testimonies'])) ? $params['show_testimonies'] : false;
        $front->show_slogans_456 = (isset($params['show_slogans_456'])) ? $params['show_slogans_456'] : false;
        $front->show_facebook = (isset($params['show_facebook'])) ? $params['show_facebook'] : false;
        $front->show_twitter = (isset($params['show_twitter'])) ? $params['show_twitter'] : false;
        $front->show_instagram = (isset($params['show_instagram'])) ? $params['show_instagram'] : false;
        $front->show_youtube = (isset($params['show_youtube'])) ? $params['show_youtube'] : false;
        $front->show_googleplus = (isset($params['show_googleplus'])) ? $params['show_googleplus'] : false;
        if (isset($params['imgs_header']))
            $front->images_header = $front->addRemoveImage($params['imgs_header'], '', ($params['remove_olds_imgs_header']) ? ((!empty($front->images_header)) ? explode('|', $front->images_header) : []) : []);
        else
            $front->images_header = '';
        if (isset($params['img_slogan_one']))
            $front->img_slogan_one = $front->addRemoveImage(array($params['img_slogan_one']), (isset($params['remove_olds_slogan1'])) ? $front->img_slogan_one : '');
        else
            $front->img_slogan_one = '';
        if (isset($params['img_slogan_two']))
            $front->img_slogan_two = $front->addRemoveImage(array($params['img_slogan_two']), (isset($params['remove_olds_slogan2'])) ? $front->img_slogan_two : '');
        else
            $front->img_slogan_two = '';
        if (isset($params['img_slogan_three']))
            $front->img_slogan_three = $front->addRemoveImage(array($params['img_slogan_three']), (isset($params['remove_olds_slogan3'])) ? $front->img_slogan_three : '');
        else
            $front->img_slogan_three = '';
        if (isset($params['img_slogan_four']))
            $front->img_slogan_four = $front->addRemoveImage(array($params['img_slogan_four']), (isset($params['remove_olds_slogan4'])) ? $front->img_slogan_four : '');
        else
            $front->img_slogan_four = '';
        if (isset($params['img_slogan_five']))
            $front->img_slogan_five = $front->addRemoveImage(array($params['img_slogan_five']), (isset($params['remove_olds_slogan5'])) ? $front->img_slogan_five : '');
        else
            $front->img_slogan_five = '';
        if (isset($params['img_slogan_six']))
            $front->img_slogan_six = $front->addRemoveImage(array($params['img_slogan_six']), (isset($params['remove_olds_slogan6'])) ? $front->img_slogan_six : '');
        else
            $front->img_slogan_six = '';
        $front->save();

        flash('El contenido de la página principal fué guardado correctamente.', 'success');
        return view('backend.frontend')->with('front', $front);
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
        $front = Frontend::find($id);
        $params = $request->all();
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
        $front->show_testimonies = (isset($params['show_testimonies'])) ? $params['show_testimonies'] : false;
        $front->show_slogans_456 = (isset($params['show_slogans_456'])) ? $params['show_slogans_456'] : false;
        $front->show_facebook = (isset($params['show_facebook'])) ? $params['show_facebook'] : false;
        $front->show_twitter = (isset($params['show_twitter'])) ? $params['show_twitter'] : false;
        $front->show_instagram = (isset($params['show_instagram'])) ? $params['show_instagram'] : false;
        $front->show_youtube = (isset($params['show_youtube'])) ? $params['show_youtube'] : false;
        $front->show_googleplus = (isset($params['show_googleplus'])) ? $params['show_googleplus'] : false;
        if (isset($params['imgs_header']))
            $front->images_header = $front->addRemoveImage($params['imgs_header'], '', isset($params['remove_olds_imgs_header']) && $params['remove_olds_imgs_header'] ? ((!empty($front->images_header)) ? explode('|', $front->images_header) : []) : []);
        if (isset($params['img_slogan_one']))
            $front->img_slogan_one = $front->addRemoveImage(array($params['img_slogan_one']), isset($params['remove_olds_slogan1']) && $params['remove_olds_slogan1'] ? $front->img_slogan_one : '');
        if (isset($params['img_slogan_two']))
            $front->img_slogan_two = $front->addRemoveImage(array($params['img_slogan_two']), isset($params['remove_olds_slogan2']) && $params['remove_olds_slogan2'] ? $front->img_slogan_two : '');
        if (isset($params['img_slogan_three']))
            $front->img_slogan_three = $front->addRemoveImage(array($params['img_slogan_three']), isset($params['remove_olds_slogan3']) && $params['remove_olds_slogan3'] ? $front->img_slogan_three : '');
        if (isset($params['img_slogan_four']))
            $front->img_slogan_four = $front->addRemoveImage(array($params['img_slogan_four']), isset($params['remove_olds_slogan4']) && $params['remove_olds_slogan4'] ? $front->img_slogan_four : '');
        if (isset($params['img_slogan_five']))
            $front->img_slogan_five = $front->addRemoveImage(array($params['img_slogan_five']), isset($params['remove_olds_slogan5']) && $params['remove_olds_slogan5'] ? $front->img_slogan_five : '');
        if (isset($params['img_slogan_six']))
            $front->img_slogan_six = $front->addRemoveImage(array($params['img_slogan_six']), isset($params['remove_olds_slogan6']) && $params['remove_olds_slogan6'] ? $front->img_slogan_six : '');
        $front->save();

        flash('El contenido de la página principal se actualizó correctamente.', 'success');
        return view('backend.frontend')->with('front', $front);
    }
}
