@extends('layouts.dashboard')

@section('content')
    <style>
        .space-line {
            line-height: 0.2
        }

        .hide {
            display: none;
        }
    </style>
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
            <th>Nome</th>
            <th>Versão</th>
            <th>Categoria</th>
            <th>Final publicação</th>
            <th></th>
            </thead>
            <tbody>
            @forelse($procedures as $procedure)
                <tr>
                    <td>{{$procedure->name}}</td>
                    <td>{{ $procedure->revisions()->count()}}</td>
                    <td>{{$procedure->category->name}}</td>

                    <td>{{empty($procedure->date_publish_finish) ? 'Sem limite' : $procedure->date_publish_finish->format('d/m/Y')}}</td>
                    <td>
                        <input type="hidden" class="id-procedure" value="{{$procedure->id}}">
                        <input type="hidden" class="url-procedure"
                               value="{{str_replace('/public/','/storage/',asset($procedure->file))}}">
                        <button class="btn btn-success btn-xs view">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                        <button class="btn btn-warning btn-xs" title="Revisões do procedimento">
                            <span class="glyphicon glyphicon-file"></span>
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

    {{--View Files--}}
    <div class="modal fade bs-example-modal-lg" id="view-files" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="idDetails">
                    <div class="">
                        <p class="space-line"><label>Publicado :</label> <span id="publishDetails"></span></p>
                        <p class="space-line"><label>Versão :</label> <span id="versionDetails"></span></p>
                        <p class="space-line"><label>Status:</label> <span class="label label-warning"><span
                                        id="stateDetails"></span></span></p>
                        <p class="space-line"><label>Categoria:</label> <span id="categoryDetails"></span></p>
                        <p class="space-line"><label>Data final publicação:</label> <span
                                    id="datePublishFinishDetails"></span></p>

                    </div>
                    <div class="elaborate">
                        <p class="space-line"><label>Elaborado por:</label> <span id="elaborateDetails"></span></p>
                        <p class="space-line"><label>Data Elaboração:</label> <span id="elaborateDateDetails"></span>
                        </p>
                    </div>
                    <div class="revision hide">
                        <p class="space-line"><label>Revisado por:</label> <span id="revisionDetails"></span></p>
                        <p class="space-line"><label>Data Revisão:</label> <span id="revisionDateDetails"></span></p>
                    </div>
                    <div class="approved hide">
                        <p style="line-height:0"><label>Aprovado por :</label> <span id="approvedDetails"></span></p>
                        <p style="line-height:0"><label>Data Aprovação:</label> <span id="approvedDateDetails"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <a href="" class="media"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function dateBrToUs(date) {
            if (date !== '') {
                aux = date.split('/');
                return aux[2] + '-' + aux[1] + '-' + aux[0];


            }
            return date;
        }
        function dateUsToBr(date) {
            if (date !== null) {
                date = date.replace('00:00:00', '').trim();
                aux = date.split('-');
                return aux[2] + '/' + aux[1] + '/' + aux[0];
            }
            return date;
        }
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
            $('#date_publish_finish').datepicker();
            $('#date_publish_finishEdit').datepicker();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#newFormProcedure').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                formData.set('date_publish_finish', dateBrToUs(formData.get('date_publish_finish')));

                $.ajax({
                    url: 'procedures', // Url do lado server que vai receber o arquivo
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    statusCode: {
                        422: function (response) {
                            console.log(response.responseJSON)

                        },
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            });

            $('#editFormProcedure').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.set('date_publish_finish', dateBrToUs(formData.get('date_publish_finishEdit')));
                $.ajax({
                    url: 'procedures/' + $('#idEdit').val(),
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    statusCode: {
                        422: function (response) {
                            console.log(response.responseJSON)

                        },
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            });

        });
        $(document).on('click', '.editar', function () {
            var id = $(this).parent().find('.id-procedure').val();

            request('procedures/' + id + '/edit', 'get').done(function (response) {

                $('#nameEdit').val(response.name);
                $('#idEdit').val(response.id);
                $('#date_publish_finishEdit').val(dateUsToBr(response.date_publish_finish))
                $('#category_idEdit').val(response.categories_id);
                if (response.step == 'Aprovado') {
                    $('input[name=publishEdit]').removeAttr('disabled');
                } else {
                    $('input[name=publishEdit]').prop('disabled', true);
                }
                $('#editProcedure').modal('show');
            })
        });
        $(document).on('click', '.view', function () {
            var url = $(this).parent().find('.url-procedure').val();
            var id = $(this).parent().find('.id-procedure').val();
            request('/procedure/details/' + id, 'get').then(function (response) {
                $('#idDetails').val(response.procedure.id);
                $('#publishDetails').text(response.procedure.publish === '1' ? "Sim" : "Não");
                $('#versionDetails').text(response.lastRevision.lastVersion.version);
                $('#stateDetails').text(response.step);
                $('#categoryDetails').text(response.category);
                $('#datePublishFinishDetails').text(response.date_publish_finish != null ? response.date_publish_finish : "Sem data.");
                $('#elaborateDetails').text(response.lastRevision.users.elaborate.name);
                $('#elaborateDateDetails').text(response.lastRevision.lastVersion.elaborate_date);
                $('#revisionDetails').text(response.lastRevision.users.reviewed.name);
                $('#revisionDateDetails').text(response.lastRevision.lastVersion.reviewed_date);
                $('#approvedDetails').text(response.lastRevision.users.approved.name);
                $('#approvedDateDetails').text(response.lastRevision.lastVersion.approved_date);
                if (response.step == 'revisão pendente') {
                    $('.revisionButton').removeClass('hide');
                } else if (response.step == 'Aprovação pendente') {
                    $('.revision').removeClass('hide');
                    $('.approvedButton').removeClass('hide');
                } else {
                    $('.revision').removeClass('hide');
                    $('.approved').removeClass('hide');
                }

                $('.media').attr('href', url);
                $('.media').media({
                    width: 885,
                    height: 800,
                });
                $('#view-files').modal('show');
            })

        });
        $('#view-files').on('hidden.bs.modal', function (e) {
            $('.revision').addClass('hide');
            $('.approved').addClass('hide');
            $('.approvedButton').addClass('hide');
            $('.revisionButton').addClass('hide');
        });
        $(document).on('click', '.excluir', function () {
            var id = $(this).parent().find('.id-procedure').val();
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


        });
        $(".stepButton").click(function () {
            var id = $('#idDetails').val();
            request('procedure/state/' + id, 'PUT').then(function (response) {
                console.log(response);
            });
        });
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

        });
    </script>

@endsection