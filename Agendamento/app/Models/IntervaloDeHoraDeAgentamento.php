<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervaloDeHoraDeAgentamento extends Model
{
    protected $table = 'intervalo_de_hora_de_agendamentos';

    protected $fillable = ['hora_inicial', 'hora_final'];

    public $timestamps = false;
}
