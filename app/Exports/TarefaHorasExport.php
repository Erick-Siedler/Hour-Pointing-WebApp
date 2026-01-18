<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class TarefaHorasExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tarefas = Tarefa::with('apontamentos')->get();

        return $tarefas->map(function ($tarefa) {
            return [
                'nome' => $tarefa->nome,
                'soma_horas' => $tarefa->apontamentos->sum('horas'),
                'cliente' => $tarefa->cliente,
                'GP_realizar' => $tarefa->GP_realizar,
                'tipo' => $tarefa->tipo,
                'projeto' => $tarefa->projeto,
                'observacao' => $tarefa->observacao,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Chamado',
            'Horas da tarefa',
            'Cliente',
            'GP realizar',
            'Tarefa do que?',
            'Projeto',
            'Observação',
        ];
    }
}
