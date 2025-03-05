<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Turma extends Model
{
    protected $fillable = ['nome', 'curso_id'];

    // Relacionamento com Professores (muitos para muitos)
    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class, 'professor_turma', 'turma_id', 'professor_id');
    }

    // Relacionamento com Disciplinas (muitos para muitos)
    public function disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(Disciplina::class, 'turma_has_disciplinas', 'turma_id', 'disciplina_id');
    }

        // Relação com o curso
        public function curso()
        {
            return $this->belongsTo(Curso::class);
        }

    public $timestamps = false;
}
