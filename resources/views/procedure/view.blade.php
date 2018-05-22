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
    @component('components.menuleft')

    @endcomponent


    <div class="w3-col m8 w3-margin-left">
        <div class="w3-container w3-card-2 w3-white w3-round ">
            <span><b><label>{{$procedure->category->name}} </label> - {{$procedure->name}}</b></span>
            <hr>
            @if(empty($procedure->file))
                <div class="content-procedure">
                    {!!  $procedure->text !!}
                </div>
            @else
                <a href="{{str_replace('/public/','/storage/',asset($procedure->file))}}" class="media"></a>
            @endif
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>
    <script src="{{asset('js/handlebars/dist/handlebars.runtime.min.js')}}"></script>
    <script src="{{asset('js/jquery-sortable/source/js/jquery-sortable-min.js')}}"></script>
    <script src="{{ asset('/js/jquery.media.js') }}"></script>
    <script src="{{asset('js/editor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.media').media({
                width: 885,
                height: 800,
            });
            if (response.procedure.file != null) {
                $('.content-procedure').addClass('hide');
                $('.media').removeClass('hide');
                $('.media').attr('href', url);
                $('.media').media({
                    width: 885,
                    height: 800,
                });
            } else {
                $('.media').addClass('hide');
                $('.content-procedure').removeClass('hide');
                $('.content-procedure').append(response.procedure.text);

            }
        });
    </script>




@endsection