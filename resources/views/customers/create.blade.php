@extends('layouts.app')

@section('content')

<form action="{{route('users.store')}}" method="post">
    <div class="row">
        @csrf
        <div class="form-group mb-3 col-4">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name">
            <div id="name-error" class="col-form-label form-txt-danger d-none"></div>

        </div>
        <div class="form-group mb-3 col-4">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email">
            <div id="email-error" class="col-form-label form-txt-danger d-none"></div>

        </div>
        <div class="form-group mb-3 col-4">
            <label for="dob">Data de Nascimento</label>
            <input type="date" class="form-control" name="dob" id="dob">
            <div id="dob-error" class="col-form-label form-txt-danger d-none"></div>

        </div>
        <div class="form-group mb-3 col-6">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
            <div id="password-error" class="col-form-label form-txt-danger d-none"></div>

        </div>
        <div class="form-group mb-3 col-6">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            <div id="password_confirmation-error" class="col-form-label form-txt-danger d-none"></div>

        </div>
    </div>
    <a href="{{ route('users.index') }}" type="button" class="btn btn-lg btn-light">Cancelar</a>
    <button type="submit" class="btn btn-lg btn-success">Salvar</button>
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

                    for (let field in errors) {
                        console.log(field + ": "+ errors[field]);

                        $('#'+field+'-error').text(errors[field]);
                        $('#'+field).addClass('border-danger');

                        $('#'+field+'-error').removeClass('d-none');

                    }
                    
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

    // remove message error from invalid fields on change
    $('input').on('change', function() {
        $(this).removeClass('border-danger');
        $(this).parent().find('.form-txt-danger').text('');
        $(this).parent().find('.form-txt-danger').addClass('d-none');
    });

</script>
@endpush
@endsection