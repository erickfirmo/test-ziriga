@extends('layouts.app')

@section('content')

{!! Form::model($customer, ['route' => ['users.update', $customer->id]]) !!}

@include('customers.partials.form')

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