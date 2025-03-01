<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervaloDeDataDeAgentamento extends Model
{
    protected $table = 'intervalo_de_data_de_agendamentos';

    protected $fillable = ['data_inicial', 'data_final'];

    public $timestamps = false;
}
