<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Tarefa;
use App\Models\Apontamento;
use Carbon\Carbon;

class HomeController extends Controller
{
    function index(){
        $apontamentos = Apontamento::all();

        $apontamentosHoje = $apontamentos->sum('horas');

        $anos = $apontamentos->pluck('create_at')
        ->map(function($data) {
            return Carbon::parse($data)->year;
        })
        ->unique()
        ->sort()
        ->values();

        $dadosPorAno = [];
        foreach($anos as $ano) {
            $meses = [];
            
            for ($i = 1; $i <= 12; $i++) {
                $data = Carbon::create($ano, $i, 1);
                $diasNoMes = $data->daysInMonth;
                
                $dias = [];
                
                for ($dia = 1; $dia <= $diasNoMes; $dia++) {

                    $horasDoDia = $apontamentos->filter(function($apontamento) use ($ano, $i, $dia) {
                        $dataApontamento = Carbon::parse($apontamento->created_at);
                        return $dataApontamento->year == $ano 
                            && $dataApontamento->month == $i 
                            && $dataApontamento->day == $dia;
                    })->sum('horas');
                    
                    $dias[$dia] = $horasDoDia;
                }
                
                $meses[$i] = [
                    'nome' => $data->locale('pt_BR')->translatedFormat('F'),
                    'dias' => $dias
                ];
            }
            
            $dadosPorAno[$ano] = $meses;
        }

        $tarefas = Tarefa::all();

        return view('home/index-home', [
            'tarefas' => $tarefas,
            'apontamentos' => $apontamentos,
            'anos' => $anos,
            'dadosPorAno' => $dadosPorAno,
            'apontamentosHoje' => $apontamentosHoje
        ]);
    }
}
