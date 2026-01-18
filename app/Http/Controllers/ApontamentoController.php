<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apontamento;
use App\Models\Tarefa;
use Carbon\Carbon;

class ApontamentoController extends Controller
{
    function index($task){

        $tarefa = Tarefa::findOrFail($task);

        $apontamentosAgrupados = $tarefa->apontamentos
            ->groupBy(function ($apontamento) {
                return $apontamento->created_at->format('Y-m-d');
            });

        return view('apontamentos/index-apontamentos', [
            'tarefa' => $tarefa,
            'apontamentosPorData' => $apontamentosAgrupados
        ]);
    }   

    function add(Request $request, $tarefa){
        $data = $request->validate([
            'horas' => 'required',
            'data' => 'nullable|date'
        ]);

        Apontamento::create([
            'tarefa_id' => $tarefa,
            'horas' => $data['horas'],
            'created_at' => isset($data['data'])
        ]);

        return redirect()->route('apontamentos', $tarefa);
    }
}
