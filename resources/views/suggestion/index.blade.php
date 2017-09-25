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
    <!-- Modal -->
    <div class="modal fade" id="viewSuggestions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sugestão</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="suggestionId" value="">
                            <p>Procedimento: <span id="procedureSuggestion"></span></p>
                            <p>Categoria: <span id="categorySuggestion"></span></p>
                            <p>Usuário: <span id="userSuggestion"></span></p>
                            <p>Data sugestão: <span id="dateSuggestion"></span></p>
                            <p>Etapa: <span id="stateSuggestion"></span></p>
                        </div>
                        <div class="col-md-12" style="border: ridge 2px black;border-radius: 5px;padding-bottom: 50px;">
                            <p id="suggestionStage" style="margin: 5px 5px"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="seen">Visto</button>
                </div>
            </div>
        </div>
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
            $(document).on('click','.view',function () {
                var id = $(this).parent().find('.id-suggestion').val();
                request('/suggestions/'+id,'get').done(function (response) {
                    $('#procedureSuggestion').text(response.procedure.name);
                    $('#categorySuggestion').text(response.procedure.category.name);
                    $('#userSuggestion').text(response.user.name);
                    $('#dateSuggestion').text(response.created_at);
                    $('#stateSuggestion').text(response.stage);
                    $('#suggestionStage').text(response.suggestion);
                    $('#suggestionId').val(response.id);
                });
                $('#viewSuggestions').modal('show');
            });
            $('#seen').click(function () {
                var id = $('#suggestionId').val();
                request('/suggestions/'+id,'put',{id:id,read:1}).done(function (response) {
                    swal({
                        title: 'Visto',
                        text: 'A sugestão foi marcada como visualizada!',
                        type: 'success'
                    }).then(function () {
                        location.reload();
                    });
                });
            });
        });
    </script>

@endsection