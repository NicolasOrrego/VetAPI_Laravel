<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paciente',
        'id_usuario',
        'receta',
    ];

    public function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function pacientes(){
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }
}
