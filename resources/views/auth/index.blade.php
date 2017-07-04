@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="page-header">
            <h1>Usuários
                <small> Lista de usuários</small>
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
            <th>E-mail</th>
            <th>Permissão</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role()}}</td>
                    <td>
                        <input type="hidden" class="id-category" value="{{$user->id}}">
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
        {{$users->links()}}
    </div>

    <!-- Modal New Category-->
    <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Novo Usuário</h4>
                </div>
                <form id="newUser">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email" id="description">
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-6 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-sm-6 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Permissão</label>
                                    <select name="permission" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
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
                    <h4 class="modal-title" id="myModalLabel">Editar Usuário</h4>
                </div>
                <form id="editUser">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="name" id="nameEdit" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email" id="emailEdit">
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-6 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="passwordEdit" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-sm-6 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control"
                                           name="password_confirmation" id="password_confirmationEdit">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Permissão</label>
                                    <select name="permission" class="form-control" id="permissionEdit">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="userIdEdit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#newUser').submit(function (e) {
                e.preventDefault();
                formData = new FormData(this);
                console.log('ok');
                $.ajax({
                    url: 'users',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
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
                    },
                    success: function (data) {
                        swal({
                            title: 'Inserido',
                            text: 'O usuário foi inserido',
                            type: 'success'
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            });
            $(document).on('click', '.editar', function () {
                var id = $(this).parent().find('.id-category').val();
                request('users/' + id + '/edit', 'get').done(function (response) {
                    $('#nameEdit').val(response.name);
                    $('#emailEdit').val(response.email)
                    $('#userIdEdit').val(response.id);
                    $('#permissionEdit').val(response.roles[0].id);
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


                    request('users/' + id, 'delete').done(function (response) {
                        swal({
                            title: 'Apagado!',
                            text: 'O Usuário foi deletado',
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
            $("#editUser").submit(function (e) {
                e.preventDefault();
                var user = {};
                if ($('#passwordEdit').val() === '') {
                    user = {
                        name: $('#nameEdit').val(),
                        email: $('#emailEdit').val(),
                        id: $('#userIdEdit').val(),
                        permission: $('#permissionEdit').val(),

                    }
                } else {
                    user = {
                        name: $('#nameEdit').val(),
                        email: $('#emailEdit').val(),
                        id: $('#userIdEdit').val(),
                        permission: $('#permissionEdit').val(),
                        password: $('#passwordEdit').val(),
                        password_confirmation: $('#password_confirmationEdit').val()

                    }
                }
                request('users/' + $('#userIdEdit').val(),'PUT',user).then(function(){
                    swal({
                        title: 'Inserido',
                        text: 'O usuário foi atualizado',
                        type: 'success'
                    }).then(function () {
                        location.reload();
                    })
                });
            })
        });
    </script>

@endsection