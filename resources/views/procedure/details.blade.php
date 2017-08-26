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

    <div class="container">
        <div class="row">

            <div class="panel panel-default col-md-10 col-md-offset-1">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <span><label>Procedimento:</label>{{$procedure->name}}</span>
                        </div>
                        <div class="col-md-4">
                            <span><label>Categoria:</label>{{$procedure->category->name}}</span>
                        </div>
                        <div class="col-md-4">
                            <span><label>Versão:</label>{{ $procedure->lastRevision()[0]->version }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span><label>Criador:</label>{{$details['lastRevision']['users']['elaborate']->name}}</span>
                        </div>
                        <div class="col-md-4">
                            <span><label>Revisor:</label>{{$details['lastRevision']['users']['reviewed']->name}}</span>
                        </div>
                        <div class="col-md-4">
                            <span><label>Aprovado por:</label>{{ $details['lastRevision']['users']['approved']->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="editable" style="padding: 5px 5px 400px 5px">
                    {!!  $procedure->text !!}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script>
    $(function(){
        window.print();
    });
</script>
@endsection