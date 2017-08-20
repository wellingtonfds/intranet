@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="page-header">
            <h1>Sugestões [ {{ count($suggestions) }} ]
                <small> Lista de sugestões</small>
            </h1>
        </div>

        <table class="table table-striped hover">
            <thead>
            <th>Usuário</th>
            <th>Prodecimento</th>
            <th>Data</th>
            <th>Lido</th>

            </thead>
            <tbody>
            @forelse($suggestions as $suggestion)
                <tr>
                    <td>{{$suggestion->user->name}}</td>
                    <td>{{ $suggestion->procedure->name }}</td>
                    <td>{{$suggestion->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{$suggestion->read?"Sim":"Não"}}</td>
                    <td>
                        <input type="hidden" class="id-suggestion" value="{{$suggestion->id}}">
                        <button class="btn btn-danger btn-xs excluir">
                            <span class="glyphicon glyphicon-trash"></span>
                            Excluir
                        </button>
                        <button class="btn btn-default btn-xs view">
                            <span class="glyphicon glyphicon-eye-open"></span>
                            Visualizar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td rowspan="3">
                        Sem registros
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$suggestions->links()}}
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.excluir', function () {
                var id = $(this).parent().find('.id-suggestion').val();
                swal({
                    title: 'Você tem certeza?',
                    text: "Não será possível reverter",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, faça isso!',
                    cancelButtonText: 'Não, cancelar!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    request('suggestions/' + id, 'delete').done(function (response) {
                        swal({
                            title:'Apagado!',
                            text:'A sugestão foi deletada',
                            type:'success'
                        }).then(function(){
                            location.reload();
                        })
                    });

                }, function (dismiss) {
                    // dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelado',
                                'Nenhum dado foi removido',
                                'error'
                        )
                    }
                })


            });
        });
    </script>

@endsection