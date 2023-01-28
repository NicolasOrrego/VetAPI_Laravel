<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha', 
        'hora', 
        'motivo', 
        'id_usuario'
    ];

    public function usuarios(){
        return $this->belongsTo(User::class, 'Id_Usuario');
    }
}
