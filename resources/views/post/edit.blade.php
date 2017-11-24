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

        <div class="w3-panel">
            <h1>Post
                <small> Criação de post</small>
            </h1>
        </div>
        <div class="w3-panel">
                <button class="btn btn-default" id="salvar">Salvar</button>
        </div>
        <form class="w3-container" id="newPost">

            <label>Title</label>
            <input type="text" class="w3-input" name="title" value="{{$post->title}}">


            <label>Status</label>
            <select class="w3-input" name="status_post_id" value="{{$post->status_post_id}}">
                @forelse($status_post as $status)
                    <option value="{{$status->id}}">{{$status->status}}</option>
                    @empty
                @endforelse
            </select>

            <label>Imagem de destaque</label>
            <input type="file" class="w3-input" name="featured">

            <div class="col-md-12 " style="border: 2px black ridge;border-radius: 5px;">
                <div class="editable" style="padding: 5px 5px 400px 5px">
                    {!! $post->content !!}
                </div>
            </div>
        </form>

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
                processData: false,
                contentType: false,
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
                            messagem += item + "<br>";
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
            $('#salvar').click(function () {
                button = $(this);
                button.prop('disabled', true);
                button.text('processando...');
                var data = new FormData($('#newPost').get(0));
                data.append('content',editor.getContent());
                console.log(data);
                request('/post/{{$post->id}}','post',data).then(function (response) {
                    //$('#newPost')[0].reset();
                    //$('.editable').text('');
                    swal({
                        title: 'Salvo',
                        text: 'O post foi salvo, em cinco segundos essa tela será fechada',
                        timer: 5000,
                    }).then(function (result) {
                        if (result.dismiss === 'timer') {
                            window.frames.closewindow();
                        }
                    },function () {
                        window.frames.closewindow();
                    })
                    button.prop('disabled', false);
                    button.text('Salvar');

                },function (response) {
                        console.log(response);
                        button.prop('disabled', false);
                        button.text('Salvar');


                })

            });
        });
    </script>


@endsection