@extends('layouts.app')

@section('content')

    <form action="{{route('users.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="form-group mb-3 col-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name">
                <div class="col-form-label form-txt-danger"></div>
            </div>

            <div class="form-group mb-3 col-4">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <div class="form-group mb-3 col-4">
                <label for="dob">Data de Nascimento</label>
                <input type="date" class="form-control" name="dob" id="dob">
            </div>

            <div class="form-group mb-3 col-6">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group mb-3 col-6">
                <label for="confirm_password">Confirmar Senha</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            </div>
        </div>

        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        <button type="submit" class="btn btn-lg btn-light">Cancelar</button>

    </form>

@push('js')
    @if(session()->exists("message"))
    <script>
        $(function() {
            Swal.fire(
                'Sucesso!',
                '{{ session()->get("success") }}',
                'success'
            )
        });
    </script>
    @endif
@endpush

@endsection