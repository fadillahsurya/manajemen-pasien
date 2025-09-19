<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Optional helper untuk mendapatkan URL foto profil
    public function profilePhotoUrl()
    {
        return $this->profile_photo ? Storage::url($this->profile_photo) : null;
    }
}
