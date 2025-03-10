<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplinas';

    protected $fillable = ['nome'];

    public $timestamps = false;

        // Relacionamento muitos para muitos com Turmas
        public function turmas()
        {
            return $this->belongsToMany(Turma::class, 'turma_has_disciplinas', 'disciplina_id', 'turma_id');
        }

        // Relacionamento muitos para muitos com Professores
        public function professors()
        {
            return $this->belongsToMany(Turma::class, 'professor_has_disciplinas', 'professor_id', 'disciplina_id');
        }
}
