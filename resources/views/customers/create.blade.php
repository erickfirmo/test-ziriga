@extends('layouts.app')

@section('content')

<h3>Cadastrar Usuário</h3>
<hr>

{!! Form::open(['url' => route('customers.store'), 'method' => 'post']) !!}

@include('customers.partials.form')

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
                let url = '/usuarios/'+data.id+'/editar';
                window.location.href = url;
            },
            error: function (data) {
                // verify if has validation errors
                if (data.status == 422) {
                    let errors = JSON.parse(data.responseText);

                    for (let field in errors) {
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


</script>
@endpush
@endsection