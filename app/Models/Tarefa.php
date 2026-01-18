<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Apontamento;

class Tarefa extends Model
{

     protected $fillable = [
        'nome',
        'cliente',
        'observacao',
        'GP_realizar',
        'tipo',
        'projeto',
        'status'
    ];

    public function apontamentos(){
        return $this->hasMany(Apontamento::Class);
    }
}
