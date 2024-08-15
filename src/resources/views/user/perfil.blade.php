@extends('nav')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Barra lateral à esquerda -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Informações do Usuário
                    </div>
                    <div class="card-body">
                        <p><strong>Foto:</strong> </p>
                        <p><strong>Nome:</strong> {{ $user['nome'] }} </p>
                        <p><strong>Email:</strong> {{ $user['email'] }} </p>
                        <p><strong>Telefone:</strong> {{ $user['numero_telefone'] }} </p>
                        <a href="{{ route('user.edit', $user['apelido']) }}" class="btn btn-primary">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

