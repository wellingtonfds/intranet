@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="page-header">
            <h1>Procedimentos
                <small> Lista de procedimentos</small>
            </h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#newCategory">Novo</button>
            </div>
        </div>
        <table class="table table-striped hover">
            <thead>
            <th>Name</th>
            <th>Categoria</th>
            <th>Publicação</th>
            <th>Final publicação</th>
            <th>Download</th>
            </thead>
            <tbody>
            @forelse($procedures as $procedure)
                <tr>
                    <td>{{$procedure->name}}</td>
                    <td></td>
                    <td>
                        <input type="hidden" class="id-category" value="{{$procedure->id}}">
                        <button class="btn btn-primary btn-xs editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button class="btn btn-danger btn-xs excluir">
                            <span class="glyphicon glyphicon-trash"></span>
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
        {{$procedures->links()}}
    </div>

    <!-- Modal New Category-->
    <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nova procedimento</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Data final publicação</label>
                                    <input type="text" class="form-control" name="date_publish_finish"
                                           id="date_publish_finish" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select type="text" class="form-control" name="category_id"
                                            id="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Arquivo</label>
                                    <input type="file" class="form-control" name="file" id="file" required>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="publish"> Publicar
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="download"> Permitir download
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary insertCategory">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Category-->
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="nameEdit" id="nameEdit" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea type="text" class="form-control" name="descriptionEdit"
                                              id="descriptionEdit">
                                        </textarea>
                                    <input type="hidden" id="idEdit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary updateCategory">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function request(url, method, data) {
            return $.ajax({
                url: url,
                data: data,
                dataType: 'json',
                method: method,
                statusCode: {
                    404: function () {
                        swal(
                                'Oops...',
                                'Endereço não encontrado!',
                                'error'
                        )

                    },
                    403: function () {
                        swal(
                                'Oops...',
                                'Acesso não autorizado!',
                                'error'
                        )
                    },
                    500: function () {
                        swal(
                                'Oops...',
                                'Erro interno do servidor!',
                                'error'
                        )

                    },
                    422: function (response) {

                        var messagem = "";
                        $.each(response.responseJSON, function (index, item) {
                            messagem += item + "\n";
                        });
                        swal(
                                'Oops...',
                                messagem,
                                'error'
                        )
                    }
                }
            })
        }
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.insertCategory').click(function () {
                var category = {
                    name: $('#name').val(),
                    description: $('#description').val().trim()
                }
                request('categories', 'post', category).done(function (response) {
                    swal({
                        title: 'Categoria inserida!',
                        text: 'A tela irá se recarregar em 2 segundos.',
                        timer: 2000
                    }).then(
                            function () {
                                location.reload();
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    location.reload();
                                }
                            }
                    )
                })
            });

            $(document).on('click', '.editar', function () {
                var id = $(this).parent().find('.id-category').val();
                request('categories/' + id + '/edit', 'get').done(function (response) {
                    $('#nameEdit').val(response.name);
                    $('#descriptionEdit').val(response.description)
                    $('#idEdit').val(response.id);
                    $('#editCategory').modal('show');
                })
            });
            $(document).on('click', '.excluir', function () {
                var id = $(this).parent().find('.id-category').val();
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


                    request('categories/' + id, 'delete').done(function (response) {
                        swal({
                            title: 'Apagado!',
                            text: 'A categoria foi deletada',
                            type: 'success'
                        }).then(function () {
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


            })
            $(".updateCategory").click(function () {
                var category = {
                    name: $('#nameEdit').val(),
                    description: $('#descriptionEdit').val(),
                    id: $('#idEdit').val()
                }
                request('categories/' + category.id, 'put', category).done(function (response) {

                    swal({
                        title: 'Categoria atualizada!',
                        text: 'A tela irá se recarregar em 2 segundos.',
                        timer: 2000
                    }).then(
                            function () {
                                location.reload();
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    location.reload();
                                }
                            }
                    )
                });

            })
        });
    </script>

@endsection