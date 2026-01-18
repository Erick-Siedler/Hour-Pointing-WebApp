<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apontamentos</title>
    <link rel="stylesheet" href="{{ asset('design/apontamento.css') }}">
</head>
<body>
    <form class="form-apoint" method="POST" action="{{ route('apontamento-adicionar', $tarefa) }}">
        @csrf
        <a href="{{ route('home') }}">Voltar</a>
        <button type="submit" class="add-bt">Criar apontamento</button>
        <div class="hour-input">
            <p>Quantidade de horas:</p>
            <input name="horas" type="number" value="1" min="1" step="1">
        </div>
        <div class="date-input">
            <p>Data:</p>
            <input name="data" type="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
        </div>
    </form>

    <div class="container-data">

    @foreach ($apontamentosPorData as $data => $apontamentos)
        
        <div class="data-group">
            <h3 class="data-title">
                {{ \Carbon\Carbon::parse($data)->isToday() ? 'Hoje' : \Carbon\Carbon::parse($data)->format('d/m/Y') }}
            </h3>

            <div class="container-apoint">
                @foreach ($apontamentos as $apontamento)
                    <div class="apoint-card" id="apoint-{{ $apontamento->id }}">
                        <div class="apoint-info">
                            <p><strong>Horas:</strong> <span class="horas-display">{{ $apontamento->horas }}</span></p>
                            <p><strong>Criado em:</strong> <span class="data-display">{{ $apontamento->created_at->format('d/m/Y') }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endforeach

    </div>

    <script>
        function toggleEdit(id) {
            const card = document.getElementById('apoint-' + id);
            const info = card.querySelector('.apoint-info');
            const form = document.getElementById('edit-form-' + id);
            const actions = card.querySelector('.apoint-actions');
            
            if (form.style.display === 'none') {
                info.style.display = 'none';
                actions.style.display = 'none';
                form.style.display = 'block';
            } else {
                info.style.display = 'block';
                actions.style.display = 'flex';
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>