@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{route('users.create')}}" class="btn btn-lg btn-success mb-4">
            Criar Usuário
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->formatedDate()}}</td>
                <td>
                    <a href="{{route('users.show', $user->id)}}" class="btn btn-primary" role="button">
                        Editar
                    </a>
                    <a href="{{route('users.destroy', $user->id)}}" class="btn btn-danger" role="button">
                        Excluir
                    </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td collspan="3">
                        <h2>Nenhum usuário encontrado</h2>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}

@endsection