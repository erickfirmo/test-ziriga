@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{route('users.create')}}" class="btn btn-lg btn-success mb-4">
            Criar Usuário
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
                alert(data);
            }
        });
    }
}

//
var table = $('.yajra-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('users.list') }}",
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