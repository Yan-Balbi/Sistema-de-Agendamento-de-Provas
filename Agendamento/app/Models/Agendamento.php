<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = ['data', 'sala_id', 'intervalo_de_hora_de_agentamento_id', 'intervalo_de_data_de_agentamento_id'];

    public $timestamps = false;
}
