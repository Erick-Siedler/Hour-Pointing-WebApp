<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefa Adicionar</title>
    <link rel="stylesheet" href="{{ asset('design/tarefa.css') }}">
</head>
<body>
    <form class="form-tarefa" method="POST" action="{{ route('tarefa-adicionar') }}">
        @csrf

        <h1>Formulário Tarefa</h1>
        <input name="nome" placeholder="Nome da tarefa" value="{{ old('nome') }}" type="text">
        <input name="cliente" placeholder="Cliente" value="{{ old('cliente') }}" type="text">
        <input name="observacao" placeholder="Observação" value="{{ old('observacao') }}" type="text">
        <input name="GP_realizar" placeholder="GP-realizar" value="{{ old('GP_realizar') }}" type="text">
        <input name="tipo" placeholder="Tipo de tarefa" value="{{ old('tipo') }}"type="text">
        <input name="projeto" placeholder="Projeto" value="{{ old('projeto') }}" type="text">
        <select name="status">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Apontada">Apontada</option>
            <option value="Pendente">Pendente</option>
            <option value="Criada">Criada</option>
        </select>
        <div class="container-bts">
        <a href="{{ route('home') }}">Voltar</a>
        <button type="submit">Criar tarefa</button>
        </div>
    </form>
</body>
</html>