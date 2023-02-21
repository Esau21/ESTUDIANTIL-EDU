<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['nota1','nota2','nota3','nota4','promedio','estudiante_id','profesor_id','materia_id','carrera_id'];
}
