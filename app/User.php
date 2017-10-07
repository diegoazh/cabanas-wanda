<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\MyTraits\TranslateDates;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Storage as Storage;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Sluggable, TranslateDates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'lastname', 'dateOfBirth', 'country_id', 'dni', 'passport', 'email', 'celphone', 'phone', 'address', 'destination', 'password', 'type', 'imageProfile', 'slug', 'genre', 'confirmed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Sluggable()
    {
        return [
            'slug' => [
                'source' => ['lastname', 'name']
            ]
        ];
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function rentals()
    {
        return $this->hasMany('App\Rental');
    }

    public function isAdmin()
    {
        return ($this->type === 'administrador' || $this->type === 'sysadmin');
    }

    public function isEmployed()
    {
        return ($this->type === 'empleado');
    }

    public function isAdminOrEmployed()
    {
        return $this->isAdmin() || $this->isEmployed();
    }

    public function displayName()
    {
        return $this->lastname . ', ' . $this->name;
    }

    public function addAndRemoveImageProfile($newImage, User $user)
    {
        $name = $user->name . '-' . $user->lastname . '-' . time() . '.' . $newImage->getClientOriginalExtension();
        $pattern = '/(chica-carre)|(chica-hombros)|(chica-rodete)|(rubia)|(chico-barba)|(hombre-bigote)|(pelado1)|(pelado2)|(chico-jopo)/i';
        Storage::disk('profiles')->put($name, File::get($newImage));
        if (preg_match($pattern, $user->imageProfile) === 0)
            Storage::disk('profiles')->delete($user->imageProfile);
        return $name;
    }
}
