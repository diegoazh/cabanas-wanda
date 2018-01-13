<?php

namespace App\Http\ViewComposers;

use App\Frontend;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class FooterFrontViewComposer
{
    public function compose(View $view)
    {
        $content = Frontend::find(1);
        $carbon = new Carbon();
        $year = $carbon->year;

        $view->with([
            'year' => $year,
            'content' => $content
        ]);
    }
}
