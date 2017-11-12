@extends('layouts.app')
@section('styles')
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/editor.css')}}" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet"
          href="{{asset('js/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.min.css')}}"
          type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet"
          href="{{asset('js/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin-frontend.min.css')}}"
          type="text/css" media="screen" charset="utf-8">
    <style>
        .medium-insert-images figure figcaption,
        .mediumInsert figure figcaption,
        .medium-insert-embeds figure figcaption,
        .mediumInsert-embeds figure figcaption {
            font-size: 12px;
            line-height: 1.2em;
        }

        .medium-insert-images-slideshow figure {
            width: 100%;
        }

        .medium-insert-images-slideshow figure img {
            margin: 0;
        }

        .medium-insert-images.medium-insert-images-grid.small-grid figure {
            width: 12.5%;
        }

        @media (max-width: 750px) {
            .medium-insert-images.medium-insert-images-grid.small-grid figure {
                width: 25%;
            }
        }

        @media (max-width: 450px) {
            .medium-insert-images.medium-insert-images-grid.small-grid figure {
                width: 50%;
            }
        }
    </style>
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="page-header">
            <h1>Post
                <small> Lista de posts</small>
            </h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#newCategory">Novo</button>
            </div>
        </div>

            <form class="form">

                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group col-md-6">
                    <label>Status</label>
                    <select class="form-control" name="status"></select>
                </div>
                <div class="form-group col-md-12">
                    <label>Imagem de destaque</label>
                    <input type="file" class="form-control" name="title">
                </div>
                <div class="col-md-12 " style="border: 2px black ridge;border-radius: 5px;">
                    <div class="editable" style="padding: 5px 5px 400px 5px">




                    </div>
                </div>
            </form>

    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/all.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>

    <script src="{{asset('js/handlebars/dist/handlebars.runtime.min.js')}}"></script>
    <script src="{{asset('js/jquery-sortable/source/js/jquery-sortable-min.js')}}"></script>

    <script src="{{asset('js/editor.js')}}"></script>


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
        function save(content) {
            console.log(content);
        }
        var editor = new MediumEditor('.editable', {
            buttonLabels: 'fontawesome',
            imageDragging: true,
            placeholder: {
                /* This example includes the default options for placeholder,
                 if nothing is passed this is what it used */
                text: 'Digite seu texto',
                hideOnClick: true
            },
            extensions: {
                table: new MediumEditorTable()
            },
            toolbar: {
                buttons: [
                    'bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote',
                    'unorderedlist', 'orderedlist', 'table', 'justifyLeft', 'justifyCenter',
                    'justifyRight', 'justifyFull', 'html', 'removeFormat'
                ],
                static: true,
                sticky: true,
                autoLink: true
            }
        });
        $(function () {
            $('.editable').mediumInsert({
                editor: editor,
                addons: {
                    images: {
                        uploadScript: null,
                        deleteScript: null,
                        captionPlaceholder: 'Type caption for image',
                        styles: {
                            slideshow: {
                                label: '<span class="fa fa-play"></span>',
                            }
                        },
                        actions: null,
                        fileUploadOptions: { // (object) File upload configuration. See https://github.com/blueimp/jQuery-File-Upload/wiki/Options
                            url: 'teste/lalala/', // (string) A relative path to an upload script
                            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i // (regexp) Regexp of accepted file types
                        },
                    }
                }
            });
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.save').click(function () {
                button = $(this);
                button.prop('disabled', true);
                button.text('processando...');
                request(window.location.href,'POST',{text: editor.getContent()}).then(function(response){
                    swal({
                        title: 'Salvo!',
                        text: 'O procedimento foi salvo.',
                        type: 'success'
                    });
                    button.prop('disabled', false);
                    button.text('Salvar');
                }).error(function(){
                    button.prop('disabled', false);
                    button.text('Salvar');
                });
            });
        });
    </script>


@endsection