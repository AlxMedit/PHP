<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCivico extends Model
{
    use HasFactory;
    protected $table = 'centros_civicos'; // Asegura que usa la tabla correcta
    protected $fillable = ['nombre', 'direccion', 'telefono', 'horario', 'foto'];
}
