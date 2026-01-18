<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefa Editar</title>
    <link rel="stylesheet" href="{{ asset('design/tarefa.css') }}">
</head>
<body>
    <form class="form-tarefa" method="POST" action="{{ route('tarefa-editar', $tarefa->id) }}">
        @csrf
        @method('PUT')

        <h1>Formulário Tarefa</h1>
        <input name="nome" value="{{ $tarefa->nome }}" placeholder="Nome da tarefa" type="text">
        <input name="cliente" value="{{ $tarefa->cliente }}" placeholder="Cliente" type="text">
        <input name="observacao" value="{{ $tarefa->observacao }}" placeholder="Observação" type="text">
        <input name="GP_realizar" value="{{ $tarefa->GP_realizar }}" placeholder="GP-realizar"  type="text">
        <input name="tipo" value="{{ $tarefa->tipo }}" placeholder="Tipo de tarefa" type="text">
        <input name="projeto" value="{{ $tarefa->projeto }}" placeholder="Projeto" type="text">
        <select name="status">
            <option value="" disabled>Selecione uma opção</option>
            <option value="Apontada" {{ $tarefa->status == 'Apontada' ? 'selected' : '' }}>Apontada</option>
            <option value="Pendente" {{ $tarefa->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="Criada" {{ $tarefa->status == 'Criada' ? 'selected' : '' }}>Criada</option>
        </select>
        <div class="container-bts">
        <a href="{{ route('home') }}">Voltar</a>
        <button type="submit">Atualizar tarefa</button>
        </div>
    </form>
</body>
</html>