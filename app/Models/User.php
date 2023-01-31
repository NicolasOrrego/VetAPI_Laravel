<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'password',
        'roles',
        'estado'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }

    public function rjaulas()
    {
        return $this->hasMany(Rjaula::class);
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
    
}
