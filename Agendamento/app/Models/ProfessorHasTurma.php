<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorHasTurma extends Model
{
    protected $table = 'professor_has_turmas';

    protected $fillable = ['professor_id', 'turma_id'];

    public $timestamps = false;
}
