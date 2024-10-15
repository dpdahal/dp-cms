@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="card">
                <div class="container mb-5">
                    <div class="row">
                        <div class="coll-md-12 p-3">
                            <h2><i class="bi bi-pencil-square"></i> Edit Image
                                <a href="{{route('manage-media.index')}}" class="btn btn-success btn-sm pull-right">Back to Gallery</a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-sm-between mb-2">
                                    <button type="button" id="move" title="Move Mode" class="btn btn-primary">
                                        <i class="bi bi-arrows-move"></i>
                                    </button>
                                    <button type="button" id="dragMode" title="Drag Mode"
                                            class="btn btn-primary">
                                        <i class="bi bi-crop"></i>
                                    </button>
                                    <button id="zoomIn" title="Zoom In" class="btn btn-primary"><i
                                            class="bi bi-zoom-in"></i></button>
                                    <button id="zoomOut" title="Zoom Out" class="btn btn-primary"><i
                                            class="bi bi-zoom-out"></i>
                                    </button>
                                    <button id="leftMove" title="Left Move" class="btn btn-primary"><i
                                            class="bi bi-arrow-left-circle-fill"></i></button>
                                    <button id="rightMove" title="Right Move" class="btn btn-primary"><i
                                            class="bi bi-arrow-right-circle-fill"></i>
                                    </button>
                                    <button id="topMove" title="Top Move" class="btn btn-primary"><i
                                            class="bi bi-arrow-up-circle-fill"></i></button>
                                    <button id="bottomMove" title="Bottom Mode" class="btn btn-primary"><i
                                            class="bi bi-arrow-down-circle-fill"></i>
                                    </button>
                                    <button id="rotateLeft" title="Rotate Left" class="btn btn-primary"><i
                                            class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                    <button id="rotateRight" title="Rotate Right" class="btn btn-primary"><i
                                            class="bi bi-arrow-clockwise"></i></button>
                                    <button id="scaleXCustom" title="Scale X" class="btn btn-primary"><i
                                            class="bi bi-arrows"></i>
                                    </button>
                                    <button id="scaleYCustom" title="Scale Y" class="btn btn-primary"><i
                                            class="bi bi-arrows-vertical"></i></button>
                                    <button id="crop" title="Crop" class="btn btn-primary"><i
                                            class="bi bi-check"></i>
                                    </button>
                                    <button id="clear" title="Clear" class="btn btn-primary"><i
                                            class="bi bi-x-circle-fill"></i>
                                    </button>
                                    <button id="disable" title="Disable" class="btn btn-primary"><i
                                            class="bi bi-lock"></i></button>
                                    <button id="enable" title="Enable" class="btn btn-primary"><i
                                            class="bi bi-unlock"></i></button>
                                    <button id="reset" title="Reset" class="btn btn-primary"><i
                                            class="bi bi-arrow-repeat"></i></button>
                                    <button id="destroy" title="Destroy" class="btn btn-primary"><i
                                            class="bi bi-power"></i></button>

                                </div>
                                <div class="col-md-12">
                                    <div id="image-container">
                                        <input type="hidden" id="file_id" value="{{$galleryData->id}}">
                                        <img src="{{url($galleryData->url)}}" id="image" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="infoList">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button id="applyCrop" class="btn btn-success btn-sm">
                                        Apply to crop
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    @if($galleryData->edit_url)
                                        <form action="{{route('restore-image')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$galleryData->id}}">
                                            <button class="btn btn-primary btn-sm pull-right">Restore Original Image
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="x">X</label>
                                <input type="text" readonly class="form-control" id="x" name="x">
                            </div>
                            <div class="form-group mb-3">
                                <label for="y">Y</label>
                                <input type="text" readonly class="form-control" id="y" name="y">
                            </div>
                            <div class="form-group mb-3">
                                <label for="width">Width</label>
                                <input type="text" readonly class="form-control" id="width" name="width">
                            </div>
                            <div class="form-group mb-3">
                                <label for="height">Height</label>
                                <input type="text" readonly class="form-control" id="height" name="height">
                            </div>
                            <div class="form-group mb-3">
                                <label for="rotate">Rotate</label>
                                <input type="text" readonly class="form-control" id="rotate" name="rotate">
                            </div>
                            <div class="form-group mb-3">
                                <label for="scaleX">ScaleX</label>
                                <input type="text" readonly class="form-control" id="scaleX" name="scaleX">
                            </div>
                            <div class="form-group mb-3">
                                <label for="scaleY">ScaleY</label>
                                <input type="text" readonly class="form-control" id="scaleY" name="scaleY">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- preview -->


            </div>
        </section>
    </main>

@endsection


@section('scripts')
    <script>
        function dpSelector(id) {
            const element = document.getElementById(id);
            const click = function (callback) {
                if (element) {
                    element.addEventListener('click', callback);
                }
            };
            return {click};
        }

        let image = document.getElementById('image');

        var cropper = new Cropper(image, {
            crop(event) {
                document.getElementById('x').value = Math.round(event.detail.x);
                document.getElementById('y').value = Math.round(event.detail.y);
                document.getElementById('width').value = Math.round(event.detail.width);
                document.getElementById('height').value = Math.round(event.detail.height);
                document.getElementById('rotate').value = event.detail.rotate;
                document.getElementById('scaleX').value = event.detail.scaleX;
                document.getElementById('scaleY').value = event.detail.scaleY;
            },

        });


        dpSelector('dragMode').click(function () {
            cropper.setDragMode("crop");
        });

        dpSelector('zoomIn').click(function () {
            cropper.zoom(0.1);
        });
        dpSelector('zoomOut').click(function () {
            cropper.zoom(-0.1);
        });
        dpSelector('move').click(function () {
            cropper.setDragMode("move");
        });
        dpSelector('leftMove').click(function () {
            cropper.move(-10, 0);
        });
        dpSelector('rightMove').click(function () {
            cropper.move(10, 0);
        });
        dpSelector('topMove').click(function () {
            cropper.move(0, -10);
        });
        dpSelector('bottomMove').click(function () {
            cropper.move(0, 10);
        });
        dpSelector('rotateLeft').click(function () {
            cropper.rotate(-45);
        });
        dpSelector('rotateRight').click(function () {
            cropper.rotate(45);
        });
        dpSelector('scaleXCustom').click(function () {
            cropper.scaleX(-1);
        });
        dpSelector('scaleYCustom').click(function () {
            cropper.scaleY(-1);
        });
        dpSelector('crop').click(function () {
            cropper.crop();
        });
        dpSelector('clear').click(function () {
            cropper.clear();
        });
        dpSelector('disable').click(function () {
            cropper.disable();
        });
        dpSelector('enable').click(function () {
            cropper.enable();
        });
        dpSelector('reset').click(function () {
            cropper.reset();
        });
        dpSelector('destroy').click(function () {
            cropper.destroy();
        });

        dpSelector('applyCrop').click(function () {

            var imgurl = cropper.getCroppedCanvas().toDataURL();

            let data = cropper.getData();
            let url = "";
            let id = document.getElementById('file_id').value;
            let formData = new FormData();
            formData.append('x', data.x);
            formData.append('y', data.y);
            formData.append('width', data.width);
            formData.append('height', data.height);
            formData.append('rotate', data.rotate);
            formData.append('scaleX', data.scaleX);
            formData.append('scaleY', data.scaleY);
            formData.append('image', imgurl);
            formData.append('id', id);
            let token = "{{csrf_token()}}";
            axios.post(url, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': token
                }
            }).then((res) => {
                location.reload();
            }).catch((e) => {
                console.log(e);
            })
        });


    </script>
@endsection

