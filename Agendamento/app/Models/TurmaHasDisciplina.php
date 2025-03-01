<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurmaHasDisciplina extends Model
{
    protected $table = 'turma_has_disciplinas';

    protected $fillable = ['turma_id','disciplina_id'];

    public $timestamps = false;
}
