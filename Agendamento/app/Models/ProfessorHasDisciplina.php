<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorHasDisciplina extends Model
{
    protected $table = 'professor_has_disciplinas';

    protected $fillable = ['professor_id', 'disciplina_id'];

    public $timestamps = false;
}
