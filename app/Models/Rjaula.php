<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rjaula extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'id_paciente',
        'id_jaula',
    ];


    public function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function pacientes(){
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function jaulas(){
        return $this->belongsTo(Jaula::class, 'id_jaula');
    }
}
