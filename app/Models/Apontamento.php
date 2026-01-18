<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tarefa;

class Apontamento extends Model
{
    protected $fillable =[
        'tarefa_id',
        'horas'
    ];

    public function tarefa(){
        return $this->belongsTo(Tarefa::class);
    }
}
