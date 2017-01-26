<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Storage as Storage;

class Cottage extends Model
{
  use SoftDeletes;
  use Sluggable;

  protected $table = 'cottages';
  protected $dates = ['deleted_at'];
  protected $fillable = ['number', 'name', 'type', 'accommodation', 'description', 'images', 'price', 'slug'];

  public function Sluggable()
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
  public function rentals()
  {
    return $this->hasMany('App\Rental');
  }

/**
 * Store new images and remove old images.
 *
 * @param object $request->file()  $newImages
 * @param string $actualImages
 * @param string $removedImages
 * @return string
 */
  public function addOrRemoveImages($newImages, $actualImages = null, $removedImages = null)
  {
      $names = [];
      $nameToDB = '';
      for ($a = count($newImages) - 1; $a >= 0; $a--) {
          $names[$a] = 'cabania' . '-' . time() . '_' . $a . '.' . $newImages[$a]->getClientOriginalExtension(); // creamos un nombre único
      }
      // $path = public_path() . '/images/cabanias'; // determinamos la ruta donde se guardan, necesario para la primera forma
      for ($i = count($newImages) - 1; $i >= 0; $i--) {
          // $files[$i]->move($path, $names[$i]); // primera forma con el objeto $file movemos cada imagen al directorio con su nuevo nombre
          Storage::disk('cabanias')->put($names[$i], File::get($newImages[$i])); // segunda forma con la clase storage y el filesistem de laravel
      }
      if(isset($actualImages)) {
          $nameToDB = $actualImages;
      }
      foreach ($names as $name) {
          $nameToDB .= ($name . '|'); // concatenamos los nombres ya que debe ser un string
      }
      if (isset($removedImages)) {
          $removed = explode('|', $removedImages);
          for ($i = count($removed) - 1; $i >= 0; $i--) {
              if(!empty($removed[$i])) {
                  Storage::disk('cabanias')->delete($removed[$i]);
              }
          }
      }
      return $nameToDB;
  }
}
