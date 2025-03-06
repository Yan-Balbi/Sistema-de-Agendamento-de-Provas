<?php

// app/Models/Professor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professors';

    protected $fillable = ['nome'];

    // Relacionamento muitos para muitos com Turmas
    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'professor_turma', 'professor_id', 'turma_id');
    }

    public $timestamps = true;
}
