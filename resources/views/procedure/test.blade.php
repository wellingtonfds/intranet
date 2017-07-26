@extends('layouts.app')
@section('styles')
    <link href="{{ asset('vendors/content-tools/content-tools.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div data-editable data-name="main-content">
        <blockquote>
            Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you
            live.
        </blockquote>
        <p>John F. Woods</p>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('vendors/content-tools/content-tools.min.js') }}"></script>
    <script src="{{ asset('vendors/content-tools/content-edit.js') }}"></script>
    <script>
        window.addEventListener('load', function () {
            var editor = ContentTools.EditorApp.get();
            editor.init('*[data-editable]', 'data-name');

            editor.addEventListener('saved', function (ev) {
                var name, payload, regions, xhr;

                // Check that something changed
                regions = ev.detail().regions;
                if (Object.keys(regions).length == 0) {
                    return;
                }

                // Set the editor as busy while we save our changes
                this.busy(true);

                // Collect the contents of each region into a FormData instance
                payload = new FormData();
                payload.append('page', window.location.pathname);
                payload.append('images', JSON.stringify(getImages()));
                payload.append('regions', JSON.stringify(regions));

                for (name in regions) {
                    if (regions.hasOwnProperty(name)) {
                        payload.append(name, regions[name]);
                    }
                }

                // Send the update content to the server to be saved
                function onStateChange(ev) {
                    // Check if the request is finished
                    if (ev.target.readyState == 4) {
                        editor.busy(false);
                        if (ev.target.status == '200') {
                            // Save was successful, notify the user with a flash
                            new ContentTools.FlashUI('ok');
                        } else {
                            // Save failed, notify the user with a flash
                            new ContentTools.FlashUI('no');
                        }
                    }
                };

                xhr = new XMLHttpRequest();
                xhr.addEventListener('readystatechange', onStateChange);
                xhr.open('POST', '/save-my-page');
                xhr.send(payload);
            })


        }, ContentTools.StylePalette.add(
                [
                    new ContentTools.Style("Definition", "definition", ["p"]),
                    new ContentTools.Style("Note", "note", ["p"]),
                    new ContentTools.Style("Vertical header", "v-head", ["table"])]),
                ContentTools.Tools.Heading.tagName = "h2", ContentTools.Tools.Subheading.tagName = "h3",
                ContentTools.IMAGE_UPLOADER = function (dialog) {
            var imagePath, imageSize, rotate, uploadingTimeout;
            return imagePath = "/images/pages/demo/landscape-in-eire.jpg", imageSize = [780, 366], uploadingTimeout = null, rotate = function () {
                var clearBusy;
                return dialog.busy(!0), clearBusy = function (_this) {
                    return function () {
                        return dialog.busy(!1)
                    }
                }(this), setTimeout(clearBusy, 1500)
            }, dialog.addEventListener("imageuploader.cancelupload", function () {
                return clearTimeout(uploadingTimeout), dialog.state("empty")
            }), dialog.addEventListener("imageuploader.clear", function () {
                return dialog.clear()
            }), dialog.addEventListener("imageuploader.fileready", function (ev) {
                var upload;
                return dialog.progress(0), dialog.state("uploading"), upload = function (_this) {
                    return function () {
                        var progress;
                        return progress = dialog.progress(), progress += 1, 100 >= progress ? (dialog.progress(progress), uploadingTimeout = setTimeout(upload, 25)) : dialog.populate(imagePath, imageSize)
                    }
                }(this), uploadingTimeout = setTimeout(upload, 25)
            }), dialog.addEventListener("imageuploader.rotateccw", function () {
                return rotate()
            }), dialog.addEventListener("imageuploader.rotatecw", function () {
                return rotate()
            }), dialog.addEventListener("imageuploader.save", function () {
                var clearBusy;
                return dialog.busy(!0), clearBusy = function (_this) {
                    return function () {
                        return dialog.busy(!1), dialog.save(imagePath, imageSize, {
                            alt: "Landscape in Eire"
                        })
                    }
                }(this), setTimeout(clearBusy, 1e3)
            })
        });


    </script>

@endsection