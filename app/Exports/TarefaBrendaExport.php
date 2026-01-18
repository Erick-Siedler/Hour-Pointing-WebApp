<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TarefaBrendaExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tarefas = Tarefa::with('apontamentos')->get();

        return $tarefas->map(function ($tarefa) {
            return [
                'status' => $tarefa->status,
                'dia' => $tarefa->created_at->format('Y-m-d'),
                'nome' => $tarefa->nome,
                'horas' => 0,
                'observacao' => $tarefa->observacao,
                'horas_tarefa' => $tarefa->apontamentos->sum('horas'),
                'cliente' => $tarefa->cliente,
                'Gp_realizar' => $tarefa->GP_realizar,
                'tipo' => $tarefa->tipo,
                'projeto' => $tarefa->projeto,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Status',
            'Dia',
            'Atividade',
            'Horas',
            'Observacao',
            'Horas da tarefa',
            'Cliente',
            'GP realizar',
            'Tarefa do que?',
            'Projeto',
        ];
    }
}
