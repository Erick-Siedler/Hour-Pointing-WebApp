<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('design/home.css') }}">
</head>
<body>

<div class="header">
    <h1>Controle de Tarefas</h1>
    <input type="text" id="searchInput" placeholder="Procurar tarefa">
</div>

<div class="layout">

    <aside class="container-bts">
        
        @if ($apontamentosHoje < 8)
        <a class="item down box">
        Apontamentos pendentes: {{8 - $apontamentosHoje}} @if ( 8 - $apontamentosHoje == 1 ) hora @else horas @endif
        </a>
        @elseIf ($apontamentosHoje == 8)
        <a class="item meta box">
        Apontamento em dia: {{$apontamentosHoje}} horas
        </a>
        @elseif ($apontamentosHoje > 8)
        <a class="item extra box">
        Horas adicionais: {{$apontamentosHoje - 8}} @if ( $apontamentosHoje - 8 == 1 ) hora @else horas @endif
        </a>
        @else 
        <a class="item none box">
        Sem apontamentos: {{$apontamentosHoje}} hrs
        </a>
        @endif
        
        <a href="{{ route('tarefa') }}" class="add-bt">
            + Nova tarefa
        </a>
        <a href="{{ route('tarefas-export') }}" class="add-bt">
            + Exportar GP
        </a>
        <a href="{{ route('brenda-export') }}" class="add-bt">
            + Exportar Brenda
        </a>
        
    </aside>

    <main class="cards-wrapper">
        

        <div class="cards-tarefa" id="contCards">
            @foreach ($tarefas as $tarefa)
            <div class="card-tarefa"
                data-name="{{ strtolower($tarefa->nome) }}"
                data-type="{{ strtolower($tarefa->tipo) }}"
                data-project="{{ strtolower($tarefa->projeto) }}"
                data-status="{{ strtolower($tarefa->status) }}">
                <div class="container-top">
                <div class="card-top">
                    @if ($tarefa->status === 'Apontada')
                        <span class="status-apontado">Apontada</span>
                    @elseif ($tarefa->status === 'Pendente')
                        <span class="status-pendente">Pendente</span>
                    @else
                        <span class="status-criado">Criada</span>
                    @endif
                    <h3>{{ $tarefa->nome }}</h3>
                </div>
                <div class="container-del">
                    <a href="{{ route('tarefa-form', $tarefa->id) }}"><button class="edit-bt">Editar Tarefa</button></a>
                    <form  method="POST" action="{{ route('tarefa-deletar', $tarefa->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="del-bt">Deletar tarefa</button>
                    </form>
                </div>  
                </div>
                <div class="card-bottom">
                    <span class="span-tarefa">Tipo: {{ $tarefa->tipo }}</span> 
                    <span class="span-tarefa">Projeto: {{ $tarefa->projeto }}</span> 
                    <span class="span-tarefa">Observação: {{ $tarefa->observacao }}</span> 
                    <span class="span-tarefa">Cliente: {{ $tarefa->cliente }}</span>
                    <span class="span-tarefa">GP-realizar: {{ $tarefa->GP_realizar }}</span>
                </div>

                <a href="{{ route('apontamentos', $tarefa->id) }}" class="apoint-bt">
                    Visualizar apontamentos
                </a>
            </div>
            @endforeach
        </div>
        
    </main>
    <div class="calendar" id="calendar">
        <h3>Legenda</h3>
        <div class="legenda">
            <span class="item none"title="sem apontamento"></span>
            <span class="item down"title="abaixo da meta"></span>
            <span class="item meta"title="bateu a meta"></span>
            <span class="item extra"title="acima da meta"></span>
        </div>
        @foreach ($dadosPorAno as $ano => $meses)
        <div class="year-cont">
            <h3>{{ $ano }}</h3>
            @foreach ($meses as $numeroMes => $mes)
                <div class="month-cont" data-month="{{ $numeroMes }}">
                    <span class="month-label">{{ $mes['nome'] }}</span>
                    @foreach ($mes['dias'] as $dia => $horas)
                        <span class="day {{ $horas == 0 ? '' : ($horas < 8 ? 'abaixo-meta' : ($horas == 8 ? 'meta' : 'extra')) }}" 
                            data-day="{{ $dia }}" 
                            data-horas="{{ $horas }}"
                            title="{{ $horas }} horas">
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
        @endforeach
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const cards = document.querySelectorAll(".card-tarefa");
    const contCards = document.getElementById('contCards')
    searchInput.addEventListener("input", () => {
        const value = searchInput.value.toLowerCase();
        let hasVisibleCard = false;

        cards.forEach(card => {
            const match =
                card.dataset.name.includes(value) ||
                card.dataset.type.includes(value) ||
                card.dataset.project.includes(value) ||
                card.dataset.status.includes(value);

            if (match) {
                card.style.display = "flex";

                hasVisibleCard = true;
            } else {
                card.style.display = "none";
            }
        });

        contCards.style.display = hasVisibleCard ? "flex" : "none";
    });
});
</script>

</body>
</html>
