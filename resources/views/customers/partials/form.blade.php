<div class="row">
    @csrf
    <div class="form-group mb-3 col-4">
        {!! Form::label('name', 'Nome', ['for' => 'name']) !!}
        {!! Form::text('name', $customer->name ?? null,['class' => 'form-control custom-validator', 'id' => 'name', 'required' => 'required']) !!}
        <div id="name-error" class="col-form-label form-txt-danger d-none"></div>
    </div>

    <div class="form-group mb-3 col-4">
        {!! Form::label('email', 'E-mail', ['for' => 'email']) !!}
        {!! Form::email('email', $customer->email ?? null, ['class' => 'form-control custom-validator', 'id' => 'email', 'required' => 'required']) !!}
        <div id="email-error" class="col-form-label form-txt-danger d-none"></div>
    </div>

    <div class="form-group mb-3 col-4">
        {!! Form::label('dob', 'Data de Nascimento', ['for' => 'dob']) !!}
        {!! Form::date('dob', $customer->dob ?? null, ['class' => 'form-control custom-validator', 'id' => 'dob']) !!}
        <div id="dob-error" class="col-form-label form-txt-danger d-none"></div>
    </div>

    <div class="form-group mb-3 col-6">
        {!! Form::label('password', 'Senha', ['for' => 'password']) !!}
        {!! Form::password('password', ['class' => 'form-control custom-validator', 'id' => 'password', 'required' => 'required']) !!}
        <div id="password-error" class="col-form-label form-txt-danger d-none"></div>
    </div>

    <div class="form-group mb-3 col-6">
        {!! Form::label('password_confirmation', 'Confirmar Senha', ['for' => 'password_confirmation']) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control custom-validator', 'id' => 'password_confirmation', 'required' => 'required']) !!}
        <div id="password_confirmation-error" class="col-form-label form-txt-danger d-none"></div>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ !isset($customer) ? 'Salvar' : 'Atualizar' }}</button>
<a href="{{ route('users.index') }}" type="button" class="btn btn-light">Cancelar</a>


{!! Form::close() !!}