@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{route('users.create')}}" class="btn btn-lg btn-success mb-4">
            Criar Usuário
        </a>
    </div>
    <table class="table yajra-datatable">
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
        </tbody>
    </table>


@push('js')

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>


@endpush

@endsection