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

    public function addRemoveImage($addImages, $removeImages = '')
    {
        $name = 'frontend-content-' . time() . '.' . $addImages->getClientOriginalExtension();
        Storage::disk('frontend')->put($name, File::get($addImages));

        if(isset($removeImages))
        {
            Storage::disk('frontend')->delete($removeImages);
        }

        return $name;
    }
}