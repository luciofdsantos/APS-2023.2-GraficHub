@extends('nav')

@section('content')

    <div class="container">
        <h2><strong>Título:</strong> {{ $project->titulo }} </h2>
        <p><strong>Descricao:</strong> {{ $project->descricao }}</p>
        <p><strong>Ferramentas:</strong> {{ $project->ferramentas }}</p>
        <p><strong>Privado:</strong> {{ $project->arquivo_publico }}</p>
        <img src="{{ asset('storage/arquivos/'. auth()->id() . '/' . $project->id . '/' . $project->imagem_capa) }}" alt="Logo">

        <a href="{{ route('project.edit', $project->id) }}">Editar</a>
        <a href="">Excluir</a>
    </div>

@endsection


