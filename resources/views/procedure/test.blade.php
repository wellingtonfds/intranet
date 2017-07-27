@extends('layouts.app')
@section('styles')
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/editor.css')}}" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="{{asset('js/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.min.css')}}" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="{{asset('js/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin-frontend.min.css')}}" type="text/css" media="screen" charset="utf-8">
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
    {{--<link href="{{ asset('vendors/content-tools/content-tools.min.css') }}" rel="stylesheet">--}}
@endsection
@section('content')
    <div class="container">
        <div data-editable data-name="main-content" class="editable">
            <div class="medium-insert-images medium-insert-active">
                Imagens
                <blockquote>
                    Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where
                    you
                    live.
                </blockquote>
                <p>John F. Woods</p>
                <br><hr>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/handlebars/dist/handlebars.runtime.min.js')}}"></script>
    <script src="{{asset('js/jquery-sortable/source/js/jquery-sortable-min.js')}}"></script>

    <script src="{{asset('js/editor.js')}}"></script>


    <script>
        var editor = new MediumEditor('.editable', {
            buttonLabels: 'fontawesome',
            extensions: {
                table: new MediumEditorTable()
            },
            toolbar: {
                buttons: [
                    'bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote',
                    'unorderedlist','orderedlist','table','justifyLeft','justifyCenter',
                    'justifyRight','justifyFull','html','removeFormat'
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
                                added: function ($el) {
                                    $el
                                            .data('cycle-center-vert', true)
                                            .cycle({
                                                slides: 'figure'
                                            });
                                },
                                removed: function ($el) {
                                    $el.cycle('destroy');
                                }
                            }
                        },
                        actions: null
                    }
                }
            });
        });


    </script>
    {{--<script src="{{ asset('vendors/content-tools/content-tools.min.js') }}"></script>--}}
    {{--<script src="{{ asset('vendors/content-tools/content-edit.js') }}"></script>--}}
    {{--<script>--}}
    {{--window.addEventListener('load', function () {--}}
    {{--var editor = ContentTools.EditorApp.get();--}}
    {{--editor.init('*[data-editable]', 'data-name');--}}

    {{--editor.addEventListener('saved', function (ev) {--}}
    {{--var name, payload, regions, xhr;--}}

    {{--// Check that something changed--}}
    {{--regions = ev.detail().regions;--}}
    {{--if (Object.keys(regions).length == 0) {--}}
    {{--return;--}}
    {{--}--}}

    {{--// Set the editor as busy while we save our changes--}}
    {{--this.busy(true);--}}

    {{--// Collect the contents of each region into a FormData instance--}}
    {{--payload = new FormData();--}}
    {{--payload.append('page', window.location.pathname);--}}
    {{--payload.append('images', JSON.stringify(getImages()));--}}
    {{--payload.append('regions', JSON.stringify(regions));--}}

    {{--for (name in regions) {--}}
    {{--if (regions.hasOwnProperty(name)) {--}}
    {{--payload.append(name, regions[name]);--}}
    {{--}--}}
    {{--}--}}

    {{--// Send the update content to the server to be saved--}}
    {{--function onStateChange(ev) {--}}
    {{--// Check if the request is finished--}}
    {{--if (ev.target.readyState == 4) {--}}
    {{--editor.busy(false);--}}
    {{--if (ev.target.status == '200') {--}}
    {{--// Save was successful, notify the user with a flash--}}
    {{--new ContentTools.FlashUI('ok');--}}
    {{--} else {--}}
    {{--// Save failed, notify the user with a flash--}}
    {{--new ContentTools.FlashUI('no');--}}
    {{--}--}}
    {{--}--}}
    {{--};--}}

    {{--xhr = new XMLHttpRequest();--}}
    {{--xhr.addEventListener('readystatechange', onStateChange);--}}
    {{--xhr.open('POST', '/save-my-page');--}}
    {{--xhr.send(payload);--}}
    {{--})--}}


    {{--}, ContentTools.StylePalette.add(--}}
    {{--[--}}
    {{--new ContentTools.Style("Definition", "definition", ["p"]),--}}
    {{--new ContentTools.Style("Note", "note", ["p"]),--}}
    {{--new ContentTools.Style("Vertical header", "v-head", ["table"])]),--}}
    {{--ContentTools.Tools.Heading.tagName = "h2", ContentTools.Tools.Subheading.tagName = "h3",--}}
    {{--ContentTools.IMAGE_UPLOADER = function (dialog) {--}}
    {{--var imagePath, imageSize, rotate, uploadingTimeout;--}}
    {{--return imagePath = "/images/pages/demo/landscape-in-eire.jpg", imageSize = [780, 366], uploadingTimeout = null, rotate = function () {--}}
    {{--var clearBusy;--}}
    {{--return dialog.busy(!0), clearBusy = function (_this) {--}}
    {{--return function () {--}}
    {{--return dialog.busy(!1)--}}
    {{--}--}}
    {{--}(this), setTimeout(clearBusy, 1500)--}}
    {{--}, dialog.addEventListener("imageuploader.cancelupload", function () {--}}
    {{--return clearTimeout(uploadingTimeout), dialog.state("empty")--}}
    {{--}), dialog.addEventListener("imageuploader.clear", function () {--}}
    {{--return dialog.clear()--}}
    {{--}), dialog.addEventListener("imageuploader.fileready", function (ev) {--}}
    {{--var upload;--}}
    {{--return dialog.progress(0), dialog.state("uploading"), upload = function (_this) {--}}
    {{--return function () {--}}
    {{--var progress;--}}
    {{--return progress = dialog.progress(), progress += 1, 100 >= progress ? (dialog.progress(progress), uploadingTimeout = setTimeout(upload, 25)) : dialog.populate(imagePath, imageSize)--}}
    {{--}--}}
    {{--}(this), uploadingTimeout = setTimeout(upload, 25)--}}
    {{--}), dialog.addEventListener("imageuploader.rotateccw", function () {--}}
    {{--return rotate()--}}
    {{--}), dialog.addEventListener("imageuploader.rotatecw", function () {--}}
    {{--return rotate()--}}
    {{--}), dialog.addEventListener("imageuploader.save", function () {--}}
    {{--var clearBusy;--}}
    {{--return dialog.busy(!0), clearBusy = function (_this) {--}}
    {{--return function () {--}}
    {{--return dialog.busy(!1), dialog.save(imagePath, imageSize, {--}}
    {{--alt: "Landscape in Eire"--}}
    {{--})--}}
    {{--}--}}
    {{--}(this), setTimeout(clearBusy, 1e3)--}}
    {{--})--}}
    {{--});--}}


    {{--</script>--}}

@endsection