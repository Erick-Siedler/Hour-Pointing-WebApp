<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Apontamento;
use App\Exports\TarefaHorasExport;
use App\Exports\TarefaBrendaExport;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    function index(){

        $apontamentos = Apontamento::all();

        return view('tarefa/index-tarefa', [
            'apontamentos' => $apontamentos
        ]);
    }

    function add(Request $request){
        $data = $request->validate([
            'nome' => 'required|min:3',
            'cliente' => 'required|min:3|max:255',
            'observacao' => 'required|min:3',
            'GP_realizar' => 'required|min:3|max:255',
            'tipo' => 'required|min:3|max:255',
            'projeto' => 'required|min:3|max:255',
            'status' => 'required|in:Apontada,Pendente,Criada'
        ]);

        Tarefa::create([
            'nome' => $data['nome'],
            'cliente' => $data['cliente'],
            'observacao' => $data['observacao'],
            'GP_realizar' => $data['GP_realizar'],
            'tipo' => $data['tipo'],
            'projeto' => $data['projeto'],
            'status' => $data['status']
        ]);

        return redirect()->route('home');
    }

    function delete(Tarefa $task){

        $task->apontamentos()->delete();
        $task->delete();

        return redirect()->route('home');
    }

    function indexEdit($task){

        $tarefa = Tarefa::where('id', $task)->first();

        return view('tarefa/index-tarefa-edit', [
            'tarefa' => $tarefa
        ]);
    }

    function edit($task, Request $request){
        $data = $request->validate([
            'nome' => 'required|min:3',
            'cliente' => 'required|min:3|max:255',
            'observacao' => 'required|min:3',
            'GP_realizar' => 'required|min:3|max:255',
            'tipo' => 'required|min:3|max:255',
            'projeto' => 'required|min:3|max:255',
            'status' => 'required|in:Apontada,Pendente,Criada'
        ]);

        $tarefa = Tarefa::where('id', $task)->first();

        $tarefa->update([
            'nome' => $data['nome'],
            'cliente' => $data['cliente'],
            'observacao' => $data['observacao'],
            'GP_realizar' => $data['GP_realizar'],
            'tipo' => $data['tipo'],
            'projeto' => $data['projeto'],
            'status' => $data['status']
        ]);

        return redirect()->route('home');
    }
    public function exportTodas()
    {
        return Excel::download(
            new TarefaHorasExport(),
            'Apontamento Pendente.xlsx'
        );
    }

    public function exportBrenda(){

        return excel::download(
            new TarefaBrendaExport(),
            'Controle Tarefas.xlsx'
        );
    }
}
