@extends('layouts.app')

@section('content')

<form action="{{route('users.store')}}" method="post">
    <div class="row">
        @csrf
        <div class="form-group mb-3 col-4">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name">
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
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-success">Salvar</button>
    <button type="submit" class="btn btn-lg btn-light">Cancelar</button>
</form>

@push('js')
<script>
    $('form').submit(function(e){
        e.preventDefault();

        let form = $(this);
        let url = $(this).attr('action');
        var formData = {
            _token: "{{ csrf_token() }}",
            name: $("#name").val(),
            email: $("#email").val(),
            date: $("#dob").val(),
            password: $("#password").val(),
            password_confirmation: $("#password_confirmation").val(),
        };

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            //contentType: "application/json",
            success: function(data)
            {
                let url = '/users/'+data.id+'/edit';

                window.location.href = url;

                // edit -> show session value (flash)
                /*Swal.fire(
                    'Sucesso!',
                    'Usuário cadastrado com sucesso!',
                    'success'
                )*/
            },
            error: function (data) {
                // verify if has validation errors
                if (data.status == 422) {
                    let errors = JSON.parse(data.responseText);

                    console.log(errors);
                    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo deu errado!',
                    });
                }
            },
        });
    })
</script>
@endpush
@endsection