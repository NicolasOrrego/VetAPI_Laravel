<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'nombre',
        'sexo',
        'especie',
    ];

    public function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
