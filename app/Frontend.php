<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Storage as Storage;

class Frontend extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = "frontend_contents";
    protected $guarded = [];

    public function addRemoveImage(Array $newImages, $removeImage = '', $removeImages = [])
    {
        $name = [];
        $finalImages = '';

        for ($i = count($newImages) - 1; $i >= 0; $i--)
        {
            if ($newImages[$i])
            {
                $name[$i] = 'frontend-content-' . time() . '.' . $newImages[$i]->getClientOriginalExtension();
                Storage::disk('frontend')->put($name[$i], File::get($newImages[$i]));
            }
        }

        if(isset($removeImage))
        {
            Storage::disk('frontend')->delete($removeImages);
        }
        else if (isset($removeImages))
        {
            $images = explode('|', $removeImages);
            for ($i = count($images) - 1; $i >= 0; $i--)
            {
                if (!isEmpty($images[$i]))
                {
                    Storage::disk('frontend')->delete($images[$i]);
                }
            }
        }

        for ($i = count($name); $i >= 0; $i--)
        {
            $finalImages .= $name[$i];
            if ($i)
            {
                $finalImages .= '|';
            }
        }

        return $finalImages;
    }
}