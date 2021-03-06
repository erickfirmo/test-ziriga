@extends('layouts.app')

@section('content')

<h3>Lista de Usuários</h3>
<hr>
    <div class="col-12">
        <a href="{{route('customers.create')}}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;Novo Usuário
        </a>
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
    </div>
@push('js')

<script type="text/javascript">
// 
function submitAction(a) {
    let accepted_methods = ['POST', 'DELETE', 'PUT', 'PATCH'];
    let method = $(a).data('method');
    let url = $(a).data('url');

    if (accepted_methods.includes(method))
    {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Esta ação não pode ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, deletar',
            cancelButtonText: 'Cancelar'

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: method
                    },
                    success: function(data)
                    {
                        table.row( $(this).parents('tr')).remove().draw();
                        Swal.fire(
                            'Deletado!',
                            'Usuaŕio deletado com sucesso.',
                            'success'
                        );
                    }
                });
            }
        });
    }
}

//
var table = $('.yajra-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('customers.list') }}",
    columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'date', name: 'date'},
        {
            data: 'action', 
            name: 'action',
            orderable: true, 
            searchable: true
        },
        
    ],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
    }
});
</script>
@endpush
@endsection