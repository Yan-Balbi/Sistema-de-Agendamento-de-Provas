<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = ['disciplina_id', 'data', 'sala_id', 'intervalo_de_hora_de_agendamento_id'];

    public $timestamps = false;
}
